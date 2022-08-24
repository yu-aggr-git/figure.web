<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Calendar extends Model{

  use HasFactory;

  // テーブル名
  protected $table = 'calendar';

  // 主キー
  protected $primaryKey = 'id';

  // タイムスタンプ無効
  public $timestamps = false;

  // 登録・更新可能なカラム
  protected $fillable = [
    'id',
    'thumbnail',
    'link',
    'maker',
    'brand',
    'item',
    'series',
    'releaseMonth',
    'releaseDate'
  ];

  // テーブルのデータを全件取得（日付順）
  public function allCalendar(){
    return $this->orderByRaw('releaseMonth asc, releaseDate asc')->get();
  }


  // 並び替え
  public function sortCalendar($releaseMonth,$tag){
    return $this
    ->having('releaseMonth','like',"$releaseMonth%")
    ->where('maker','like',"%$tag%")
    ->orwhere('brand','like',"%$tag%")
    ->orwhere('item','like',"%$tag%")
    ->orwhere('series','like',"%$tag%")
    ->orderByRaw('releaseMonth asc, releaseDate asc')
    ->get();
  }


  // テーブルのデータを個別取得
  public function findCalendar($id){
    return $this->where('id',$id)->first();
  }


  // ─── 新規投稿 ────────────────────────
  public function insertCalendar($thumbnail,$link,$maker,$brand,$item,$series,$releaseMonth,$releaseDate){
    return $this->create([
      'thumbnail'=> $thumbnail,
      'link' => $link,
      'maker' => $maker,
      'brand' => $brand,
      'item' => $item,
      'series' => $series,
      'releaseMonth' => $releaseMonth,
      'releaseDate' => $releaseDate,
    ]);
  }


  // ─── 編集 ────────────────────────
  public function updateCalendar($id,$thumbnail,$link,$maker,$brand,$item,$series,$releaseMonth,$releaseDate){
    return $this->where('id',$id)->update([
      'id' => $id,
      'thumbnail'=> $thumbnail,
      'link' => $link,
      'maker' => $maker,
      'brand' => $brand,
      'item' => $item,
      'series' => $series,
      'releaseMonth' => $releaseMonth,
      'releaseDate' => $releaseDate,
    ]);
  }


  // ─── 削除 ────────────────────────
  public function deleteCalendar($id){
    return $this->where('id',$id)->delete();
  }


  // ─── カレンダーお気に入り ────────────────────────
  public function likes_calendar(){
    return $this->hasMany('App\Favorite_calendar');
  }
}
