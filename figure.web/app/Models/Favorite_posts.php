<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Favorite_posts extends Model{

  use HasFactory;

  // テーブル名
  protected $table = 'favorite_posts';

  // 主キー
  protected $primaryKey = 'id';

  // // タイムスタンプ無効
  // public $timestamps = false;

  // 登録・更新可能なカラム
  protected $fillable = [
    'id',
    'user_id',
    'posts_id',
    'created_at',
    'updated_at'
  ];

  public function post(){
    return $this->belongsTo('App\Post');
  }

  public function user(){
    return $this->belongsTo('App\User');
  }


  // ユーザーのお気に入り
  public function findFavorite_posts($user_id){
    return $favorite_posts = $this
    ->join('users', 'favorite_posts.user_id', '=', 'users.id')
    ->join('posts', 'favorite_posts.posts_id', '=', 'posts.id')
    ->selectRaw('
    posts.id,
    posts.user_id,
    posts.comment,
    posts.thumbnail,
    posts.tag1,
    posts.tag2,
    posts.tag3,
    posts.tag3,
    posts.tag4,
    posts.tag5,
    posts.status,
    posts.image1,
    posts.image2,
    posts.image3,
    posts.created_at,
    users.user_name')
    ->orderBy('created_at','desc')
    ->where('favorite_posts.user_id',$user_id)->get();
  }


  // 人気順
  public function sortPopular(){
    return $favorite_posts = $this
    ->join('users', 'favorite_posts.user_id', '=', 'users.id')
    ->join('posts', 'favorite_posts.posts_id', '=', 'posts.id')
    ->selectRaw('
    favorite_posts.posts_id,
    COUNT(favorite_posts.posts_id) as count,
    posts.id,
    posts.user_id,
    posts.comment,
    posts.thumbnail,
    posts.tag1,
    posts.tag2,
    posts.tag3,
    posts.tag3,
    posts.tag4,
    posts.tag5,
    posts.status,
    posts.image1,
    posts.image2,
    posts.image3,
    posts.created_at,
    users.user_name')
    ->groupBy('favorite_posts.posts_id')
    ->orderBy('count','desc')
    ->get();
  }


  // 人気順(10件)
  public function sortPopular10(){
    return $favorite_posts = $this
    ->join('users', 'favorite_posts.user_id', '=', 'users.id')
    ->join('posts', 'favorite_posts.posts_id', '=', 'posts.id')
    ->selectRaw('
    favorite_posts.posts_id,
    COUNT(favorite_posts.posts_id) as count,
    posts.id,
    posts.user_id,
    posts.comment,
    posts.thumbnail,
    posts.tag1,
    posts.tag2,
    posts.tag3,
    posts.tag3,
    posts.tag4,
    posts.tag5,
    posts.status,
    posts.image1,
    posts.image2,
    posts.image3,
    posts.created_at,
    users.user_name')
    ->groupBy('favorite_posts.posts_id')
    ->orderBy('count','desc')
    ->take(10)
    ->get();
  }


  // ─── いいね有無の確認 ────────────────────────
  public function liked($user_id,$posts_id){
    return $exsit = $this->where('user_id',$user_id)->where('posts_id',$posts_id)->first();
  }


  // ─── ユーザーのいいね確認 ────────────────────────
  public function likeUser($user_id){
    return $exsit = $this->select('posts_id')->where('user_id',$user_id)->get();
  }


  // ─── いいね数 ────────────────────────
  public function countLike($posts_id){
    $count = $this->selectRaw('COUNT(posts_id) as count')->where('posts_id',$posts_id)->groupBy('posts_id')->first();

    if (empty($count)) {
      return 0;
    }
    else {
      return $count['count'];
    }
  }


  // ─── 新規投稿 ────────────────────────
  public function insertFavorite_posts($user_id,$posts_id){
    return $this->create([
      'user_id'=> $user_id,
      'posts_id'=> $posts_id
    ]);
  }


  // ─── 削除 ────────────────────────
  public function deleteFavorite_posts($user_id,$posts_id){
    return $this->where('user_id',$user_id)->where('posts_id',$posts_id)->delete();
  }



}
