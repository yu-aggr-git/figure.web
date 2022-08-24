<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Post extends Model{

  use HasFactory;

  // テーブル名
  protected $table = 'posts';

  // 主キー
  protected $primaryKey = 'id';

  // // タイムスタンプ無効
  // public $timestamps = false;

  // 登録・更新可能なカラム
  protected $fillable = [
    'id',
    'user_id',
    'comment',
    'thumbnail',
    'tag1',
    'tag2',
    'tag3',
    'tag4',
    'tag5',
    'status',
    'image1',
    'image2',
    'image3',
    'created_at',
    'updated_at'
  ];


  // ─── マイポスト(ユーザーIDで取得) ────────────────────────
  public function findUserPost($user_id){
    return $post = $this
    ->join('users', 'posts.user_id', '=', 'users.id')
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
    ->where('posts.user_id',$user_id)->get();
  }


  // ─── テーブルのデータを全件取得（10件） ────────────────────────
  public function allPost10(){
    return $this
    ->where('status','0')
    ->orderBy('created_at','desc')
    ->take(10)
    ->get();
  }


  // ─── 並び替え（新着順） ────────────────────────
  public function allPost(){
    return $post = $this
    ->join('users', 'posts.user_id', '=', 'users.id')
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
    ->where('status','0')
    ->orderBy('created_at','desc')
    ->get();
  }


  // ─── 並び替え（検索） ────────────────────────
  public function sortTagPost($tag){
    return $this
    ->join('users', 'posts.user_id', '=', 'users.id')
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
    ->where('status','0')
    ->where('tag1','like',"%$tag%")
    ->orwhere('tag2','like',"%$tag%")
    ->orwhere('tag3','like',"%$tag%")
    ->orwhere('tag4','like',"%$tag%")
    ->orwhere('tag5','like',"%$tag%")
    ->get();
  }


  // ─── 記事詳細(IDで取得) ────────────────────────
  public function findIdPost($id){
    return $post = $this
    ->join('users', 'posts.user_id', '=', 'users.id')
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
    ->where('posts.id',$id)
    ->first();
  }


  // ─── ポストの総数────────────────────────
  public function allUserPosts($countUserid){
    $count = $this->selectRaw('COUNT(id) as count')->where('user_id',$countUserid)->first();
    return $count['count'];
  }


  // ─── 新規投稿 ────────────────────────
  public function insertPost($user_id,$comment,$thumbnail,$tag1,$tag2,$tag3,$tag4,$tag5,$status,$image1,$image2,$image3,$created_at){
    return $this->create([
      'user_id'=> $user_id,
      'comment'=> $comment,
      'thumbnail' => $thumbnail,
      'tag1' => $tag1,
      'tag2' => $tag2,
      'tag3' => $tag3,
      'tag4' => $tag4,
      'tag5' => $tag5,
      'status' => $status,
      'image1' => $image1,
      'image2' => $image2,
      'image3' => $image3,
      'created_at' => $created_at,
    ]);
  }


  // ─── 編集 ────────────────────────
  public function updatePost($id,$comment,$thumbnail,$tag1,$tag2,$tag3,$tag4,$tag5,$status,$image1,$image2,$image3,$updated_at){
    return $this->where('id',$id)->update([
      'id' => $id,
      'comment'=> $comment,
      'thumbnail' => $thumbnail,
      'tag1' => $tag1,
      'tag2' => $tag2,
      'tag3' => $tag3,
      'tag4' => $tag4,
      'tag5' => $tag5,
      'status' => $status,
      'image1' => $image1,
      'image2' => $image2,
      'image3' => $image3,
      'updated_at' => $updated_at
    ]);
  }


  // ─── 削除 ────────────────────────
  public function deletePost($id){
    return $this->where('id',$id)->delete();
  }

  // ─── 投稿お気に入り ────────────────────────
  public function likes(){
    return $this->hasMany('App\Favorite_posts');
  }



}
