<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Info extends Model{

  use HasFactory;

  // テーブル名
  protected $table = 'info';

  // 主キー
  protected $primaryKey = 'id';

  // タイムスタンプ無効
  public $timestamps = false;

  // 登録・更新可能なカラム
  protected $fillable = [
    'id',
    'title',
    'body',
    'status',
    'created_at',
    'updated_at'
  ];

  // テーブルのデータを全件取得
  public function allInfo(){
    return $this->all();
  }

  // テーブルのデータを個別取得
  public function findInfo($id){
    return $this->where('id',$id)->first();
  }

  // ─── 新規投稿 ────────────────────────
  public function insertInfo($title,$body,$status,$created_at){
    return $this->create([
      'title'=> $title,
      'body'=> $body,
      'status' => $status,
      'created_at' => $created_at,
    ]);
  }

  // ─── 編集 ────────────────────────
  public function updateInfo($id,$title,$body,$status,$updated_at){
    return $this->where('id',$id)->update([
      'id' => $id,
      'title'=> $title,
      'body'=> $body,
      'status' => $status,
      'updated_at' => $updated_at,
    ]);
  }

  // ─── 削除 ────────────────────────
  public function deleteInfo($id){
    return $this->where('id',$id)->delete();
  }


}
