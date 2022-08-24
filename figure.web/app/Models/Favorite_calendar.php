<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Favorite_calendar	 extends Model{

  use HasFactory;

  // テーブル名
  protected $table = 'favorite_calendar';

  // 主キー
  protected $primaryKey = 'id';

  // // タイムスタンプ無効
  // public $timestamps = false;

  // 登録・更新可能なカラム
  protected $fillable = [
    'id',
    'user_id',
    'calendar_id',
    'created_at',
    'updated_at'
  ];

  public function calendar(){
    return $this->belongsTo('App\Calendar');
  }

  public function user(){
    return $this->belongsTo('App\User');
  }

  // ユーザーのお気に入り
  public function findFavorite_calendar($user_id){
    return $favorite_posts = $this
    ->join('calendar', 'favorite_calendar.calendar_id', '=', 'calendar.id')
    ->selectRaw('
    calendar.id,
    calendar.thumbnail,
    calendar.link,
    calendar.maker,
    calendar.brand,
    calendar.item,
    calendar.series,
    calendar.releaseMonth,
    calendar.releaseDate')
    ->orderByRaw('releaseMonth asc, releaseDate asc')
    ->where('favorite_calendar.user_id',$user_id)
    ->get();
  }


  // ユーザーの並び替え
  public function sortFavorite_calendar($user_id,$releaseMonth,$tag){
    return $favorite_posts = $this
    ->join('calendar', 'favorite_calendar.calendar_id', '=', 'calendar.id')
    ->selectRaw('
    favorite_calendar.user_id,
    calendar.id,
    calendar.thumbnail,
    calendar.link,
    calendar.maker,
    calendar.brand,
    calendar.item,
    calendar.series,
    calendar.releaseMonth,
    calendar.releaseDate')
    ->having('favorite_calendar.user_id',$user_id)
    ->having('calendar.releaseMonth','like',"$releaseMonth%")
    ->where('calendar.maker','like',"%$tag%")
    ->orwhere('calendar.brand','like',"%$tag%")
    ->orwhere('calendar.item','like',"%$tag%")
    ->orwhere('calendar.series','like',"%$tag%")
    ->orderByRaw('calendar.releaseMonth asc, calendar.releaseDate asc')
    ->get();
  }



  // ─── いいね有無の確認 ────────────────────────
  public function likedcalendar($user_id,$calendar_id){
    return $exsit = $this->where('user_id',$user_id)->where('calendar_id',$calendar_id)->first();
  }


  // ─── ユーザーのいいね確認 ────────────────────────
  public function likeUsercalendar($user_id_calendar){
    return $exsit = $this->select('calendar_id')->where('user_id',$user_id_calendar)->get();
  }


  // ─── 新規投稿 ────────────────────────
  public function insertFavorite_calendar($user_id,$calendar_id){
    return $this->create([
      'user_id'=> $user_id,
      'calendar_id'=> $calendar_id
    ]);
  }


  // ─── 削除 ────────────────────────
  public function deleteFavorite_calendar($user_id,$calendar_id){
    return $this->where('user_id',$user_id)->where('calendar_id',$calendar_id)->delete();
  }




}
