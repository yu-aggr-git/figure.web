<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Contact extends Model{

  use HasFactory;

  // テーブル名
  protected $table = 'contact';

  // 主キー
  protected $primaryKey = 'id';

  // // タイムスタンプ無効
  // public $timestamps = false;

  // 登録・更新可能なカラム
  protected $fillable = [
    'id',
    'name',
    'user_name',
    'email',
    'body',
    'created_at',
    'updated_at'
  ];

  // テーブルのデータを全件取得
  public function allContact(){
    return $this->all();
  }

  // ─── 新規登録 ────────────────────────
  public function insertContact($name,$user_name,$email,$body,$created_at){
    return $this->create([
      'name' => $name,
      'user_name' => $user_name,
      'email' => $email,
      'body' => $body,
      'created_at' => $created_at
    ]);
  }

  // ─── 削除 ────────────────────────
  public function deleteContact($id){
    return $this->where('id',$id)->delete();
  }



}
