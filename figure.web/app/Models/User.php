<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class User extends Model{

  use HasFactory;

  // テーブル名
  protected $table = 'users';

  // 主キー
  protected $primaryKey = 'id';

  // 登録・更新可能なカラム
  protected $fillable = [
    'id',
    'user_name',
    'email',
    'password',
    'icon',
    'comment',
    'created_at',
    'updated_at',
    'role'
  ];

  // テーブルのデータを全件取得
  public function AllUser(){
    return $this->all();
  }

  // テーブルのデータを個別取得
  public function findUser($id){
    return $user = $this->where('id',$id)->first();
  }


  // ─── ログイン ────────────────────────
  public function loginUser($user_name,$password) {
    $user = $this->where('user_name',$user_name)->first();
    $pass = password_verify($password, $user['password']);

    // パスワードミス
    if ($pass != $user['password']) {
      $error = ['pass_error' => "パスワードが違います。"];
      return $error;
    }
    return $user;
  }


  // ─── 新規登録 ────────────────────────
  public function insertUser($user_name,$password,$email,$created_at){
    return $this->create([
      'user_name' => $user_name,
      'password' => Hash::make($password),
      'email' => $email,
      'created_at' => $created_at
    ]);
  }


  // ─── パスワードリセット ────────────────────────
  public function insertPassword($user_name,$password,$email){
    $user = $this->where('user_name',$user_name)->first();

    // アドレス不一致
    if ($email != $user['email']) {
      $error = ['email_error' => "ユーザー名と登録アドレスが不一致です。"];
      return $error;
    }
    else {
      return $this->where('user_name',$user_name)->update(['password' => Hash::make($password)]);
    }
  }


  // ─── アイコン ────────────────────────
  public function iconUser($id,$icon){
    return $this->where('id',$id)->update([
      'id' => $id,
      'icon' => $icon,
    ]);
  }


  // ─── 編集 ────────────────────────
  public function updateUser($id,$user_name,$comment,$password,$email,$updated_at){
    return $this->where('id',$id)->update([
      'id' => $id,
      'user_name' => $user_name,
      'comment' => $comment,
      'password' => Hash::make($password),
      'email' => $email,
      'updated_at' => $updated_at
    ]);
  }


  // ─── 削除 ────────────────────────
  public function deleteUser($id){
    return $this->where('id',$id)->delete();
  }


  // ─── 投稿お気に入り ────────────────────────
  public function likes(){
    return $this->hasMany('App\Favorite_posts');
  }

  // ─── カレンダーお気に入り ────────────────────────
  public function likes_calendar(){
    return $this->hasMany('App\Favorite_calendar');
  }



}
