<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Validator;

class LoginController extends Controller{

  private $user;

  public function __construct(){
    $this->user = new User();
  }

  // ─── ログイン画面(get) ────────────────────────
  public function login(Request $request){
    $request->session()->forget("input");
    return view('figures.login');
  }


  // ─── ログイン画面(post) ────────────────────────
  public function login_post(Request $request){
    $user_name = $request->user_name;
    $password = $request->password;
    $password_check = $request->password_check;
    $email = $request->email;
    $created_at = Carbon::now();

    $input = $request->only($this->user->fillable);

    // ─── ログイン ────────────────────────
    if($request->has("login")){

      $validator = Validator::make($request->all(), [
        'user_name' => ['required', 'exists:users'],
        'password' => ['required'],
      ],
      [
        'user_name.required' => 'ユーザ名は必須入力です。',
        'user_name.exists' => 'このユーザ名は登録されていません。',
        'password.required' => 'パスワードは必須入力です。',
      ]);

      // バリデーション失敗
      if ($validator->fails()) {
        return view('figures.login',["input" => $input])
        ->withErrors($validator)
        ->withInput($input);
      }
      // バリデーション成功
      else {
        $user = $this->user->loginUser($user_name,$password);

        // ログイン失敗
        if (!empty($user['pass_error'])) {
          return view('figures.login',["input" => $input,"user" => $user]);
        }
        // ログイン成功
        else {
          $request->session()->put("input", $user);
          $session = $request->session()->get("input");
          return redirect()->route('user');
        }
      }
    }

    // ─── 新規登録 ────────────────────────
    if($request->has("signup")){
      $input['signup'] = "signup";

      $validator = Validator::make($request->all(), [
        'user_name' => ['required', 'unique:users'],
        'password' => ['required'],
        'password_check' => ['required', 'same:password'],
        'email' => ['required', 'email']
      ],
      [
        'user_name.required' => 'ユーザ名は必須入力です。',
        'user_name.unique' => '登録済みユーザ名の為、使用できません。',
        'password.required' => 'パスワードは必須入力です。',
        'password_check.required' => 'パスワード(確認用)は必須入力です。',
        'password_check.same' => 'パスワードが一致していません。',
        'email.required' => 'メールアドレスは必須入力です。',
        'email.email' => 'メールアドレスが正しくありません。'
      ]);

      // バリデーション失敗
      if ($validator->fails()) {
        return view('figures.login',["input" => $input])
        ->withErrors($validator)
        ->withInput($input);
      }
      // バリデーション成功・ログイン
      else {
        $insertUser = $this->user->insertUser($user_name,$password,$email,$created_at);
        $user = $this->user->loginUser($user_name,$password);
        $request->session()->put("input", $user);
        $session = $request->session()->get("input");
        return redirect()->route('user');
      }
    }


    // ─── パスリセット ────────────────────────
    if($request->has("reset")){
      $input['reset'] = "reset";

      $validator = Validator::make($request->all(), [
        'user_name' => ['required', 'exists:users'],
        'password' => ['required'],
        'password_check' => ['required', 'same:password'],
        'email' => ['required', 'email']
      ],
      [
        'user_name.required' => 'ユーザ名は必須入力です。',
        'user_name.exists' => 'このユーザ名は登録されていません。',
        'password.required' => 'パスワードは必須入力です。',
        'password_check.required' => 'パスワード(確認用)は必須入力です。',
        'password_check.same' => 'パスワードが一致していません。',
        'email.required' => 'メールアドレスは必須入力です。',
        'email.email' => 'メールアドレスが正しくありません。'
      ]);

      // バリデーション失敗
      if ($validator->fails()) {
        return view('figures.login',["input" => $input])
        ->withErrors($validator)
        ->withInput($input);
      }
      // バリデーション成功・ログイン
      else {
        $user = $this->user->insertPassword($user_name,$password,$email);

        // ログイン失敗
        if (!empty($user['email_error'])) {
          return view('figures.login',["input" => $input,"user" => $user]);
        }
        // ログイン成功
        else {
          $user = $this->user->loginUser($user_name,$password);
          $request->session()->put("input", $user);
          $session = $request->session()->get("input");
          return redirect()->route('user');
        }
      }
    }
  }
}

// webmaster
// test@test.com

// var_dump($session);
