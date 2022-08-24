<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Hash;
use Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class ContactsController extends Controller{

  private $Contact;

  public function __construct(){
    $this->contact = new Contact();
  }

  // ─── 新規(get) ────────────────────────
  public function contactNew(Request $request){
    $session = $request->session()->get("input");
    return view('figures/contacts.contact_new',["session" => $session]);
  }


  // ─── 新規(post) ────────────────────────
  public function contactNew_post(Request $request){
    $session = $request->session()->get("input");

    $name = $request->name;
    $user_name = $request->user_name;
    $email = $request->email;
    $body = $request->body;
    $created_at = Carbon::now();

    // 新規
    if ($request->has("confirm") || $request->has("complete")){
      $validator = Validator::make($request->all(), [
        'name' => ['required_without:user_name'],
        'email' => ['required', 'email'],
        'body' => ['required'],
      ],
      [
        'name.required_without' => '氏名かユーザー名のどちらかを入力して下さい。',
        'email.required' => 'メールアドレスは必須入力です。',
        'email.email' => 'メールアドレスが正しくありません。',
        'body.required' => '内容は必須入力です。',
      ]);

      // バリデーション失敗
      if ($validator->fails()) {
        $request->session()->forget("contact");
        return redirect()->route('contactNew_post')
        ->withErrors($validator)
        ->withInput();
      }

      // バリデーション成功
      else {
        $request->session()->put("contact", "<br>内容に誤りがない場合は送信ボタンを押して下さい。<br>修正をする場合は確認ボタンを押して下さい。");

        // 投稿
        if ($request->has("complete")) {
          $this->contact->insertContact($name,$user_name,$email,$body,$created_at);
          $request->session()->forget("contact");
          return redirect()->route('main');
        }

        // 再確認
        elseif ($request->has("confirm")) {
          return redirect()->route('contactNew_post')
          ->withErrors($validator)
          ->withInput();
        }
      }
    }
  }


  // ─── 一覧(get) ────────────────────────
  public function contactView(Request $request){

    // ログイン状態
    if ($request->session()->has('input')) {
      $myUser = $request->session()->get("input.id");

      if ($myUser == 1) {
        $session = $request->session()->get("input");
        $allContact = $this->contact->allContact();
        return view('figures/contacts.contact',["session" => $session, "allContact" => $allContact]);
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


  // ─── 一覧(post) ────────────────────────
  public function contactView_post(Request $request){
    // 削除
    if ($request->has("delete_contact")) {
      $id = $request->id;
      $this->contact->deleteContact($id);
      return redirect()->route('contactView');
    }
  }
}
