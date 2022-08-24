<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;
use Illuminate\Support\Facades\Hash;
use Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class InfosController extends Controller{

  private $Info;

  public function __construct(){
    $this->info = new Info();
  }

  // ─── 一覧(get) ────────────────────────
  public function info(Request $request){
    $session = $request->session()->get("input");
    $allInfo = $this->info->allInfo();
    return view('figures/infos.info',["session" => $session, "allInfo" => $allInfo]);
  }


  // ─── 一覧(post) ────────────────────────
  public function info_post(Request $request){
    $id = $request->id;

    // 編集
    if ($request->has("editInfo")) {
      $request->session()->forget("newInfo");
      return redirect()->route('infoEdit_post');
    }

    // 削除
    elseif ($request->has("deleteInfo")) {
      $this->info->deleteInfo($id);
      return redirect()->route('info');
    }
  }


  // ─── 編集(get) ────────────────────────
  public function infoEdit(Request $request){

    // ログイン状態
    if ($request->session()->has('input')) {
      $myUser = $request->session()->get("input.id");

      if ($myUser == 1) {
        $session = $request->session()->get("input");
        $allInfo = $this->info->allInfo();
        return view('figures/infos.info_edit',["session" => $session, "allInfo" => $allInfo]);
      }
      else {
        return redirect()->route('top');
      }
    }

    // ゲストリダイレクト
    else {
      return redirect()->route('top');
    }
    
  }


  // ─── 編集(post) ────────────────────────
  public function infoEdit_post(Request $request){

    $id = $request->id;
    $title = $request->title;
    $body = $request->body;
    $status = $request->status;
    $created_at = Carbon::now();
    $updated_at = Carbon::now();

    $input = $request->only($this->info->fillable);

    // 新規投稿
    if ($request->has("new_info")) {
      $request->session()->put("newInfo", $input);

      $validator = Validator::make($request->all(), [
        'title' => ['required'],
        'body' => ['required'],
        'status' => ['required']
      ],
      [
        'title.required' => 'タイトルは必須入力です。',
        'body.required' => '内容は必須入力です。',
        'status.required' => 'どちらかを選択して下さい。',
      ]);

      // バリデーション失敗
      if ($validator->fails()) {
        return redirect()->route('infoEdit_post')
        ->withErrors($validator)
        ->withInput();
      }
      // バリデーション成功・投稿
      else {
        $this->info->insertInfo($title,$body,$status,$created_at);
        return redirect()->route('info');
      }
    }

    // 編集
    elseif ($request->has("edit_info")) {

      $validator = Validator::make($request->all(), [
        'title' => ['required'],
        'body' => ['required'],
        'status' => ['required']
      ],
      [
        'title.required' => 'タイトルは必須入力です。',
        'body.required' => '内容は必須入力です。',
        'status.required' => 'どちらかを選択して下さい。',
      ]);

      // バリデーション失敗
      if ($validator->fails()) {
        return redirect()->route('infoEdit_post')
        ->withErrors($validator)
        ->withInput();
      }
      // バリデーション成功・投稿
      else {
        $this->info->updateInfo($id,$title,$body,$status,$updated_at);
        return redirect()->route('info');
      }
    }
  }
}

// webmaster
// test@test.com

// var_dump($session);
