<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Post;
use App\Models\Calendar;
use App\Models\Favorite_posts;
use App\Models\Favorite_calendar;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller{

  private $user;
  private $post;
  private $Calendar;
  private $favorite_posts;
  private $favorite_calendar;

  public function __construct(){
    $this->user = new User();
    $this->post = new Post();
    $this->calendar = new Calendar();
    $this->favorite_posts = new Favorite_posts();
    $this->favorite_calendar = new Favorite_calendar();
  }


  // ─── ユーザー画面(get) ────────────────────────
  public function user(Request $request){
    $session = $request->session()->get("input");
    $data = $request->old('user_id');

    if (empty($data)) {
      $user_id = $request->session()->get("input.id");
      $id = $request->session()->get("input.id");
    }
    elseif (!empty($data)) {
      $user_id = $data;
      $id = $data;
    }

    $user_id_calendar = $request->session()->get("input.id");

    $releaseMonth = $request->releaseMonth;
    $tag = $request->tag;
    $findUser = $this->user->findUser($id);
    $allCalendar = $this->favorite_calendar->findFavorite_calendar($user_id);
    $sortCalendar = $this->favorite_calendar->sortFavorite_calendar($user_id,$releaseMonth,$tag);
    $likeUsercalendar = $this->favorite_calendar->likeUsercalendar($user_id_calendar);
    $findUserPost = $this->post->findUserPost($user_id)->take(10);
    $findFavorite_posts = $this->favorite_posts->findFavorite_posts($user_id)->take(10);

    return view('figures/users.user',[
      "session" => $session,
      "findUser" => $findUser,
      "findUserPost" => $findUserPost,
      "findFavorite_posts" => $findFavorite_posts,
      "releaseMonth" => $releaseMonth,
      "allCalendar" => $allCalendar,
      "sortCalendar" => $sortCalendar,
      "likeUsercalendar" => $likeUsercalendar,
    ]);
  }


  // ─── ユーザー画面(post) ────────────────────────
  public function user_post(Request $request){
    $session = $request->session()->get("input");
    $id = $request->session()->get("input.id");

    $findUser = $this->user->findUser($id);

    // 新規投稿へ
    if ($request->has("sub_postNew")) {
      $request->session()->forget("thumbnail");
      $request->session()->forget("image1");
      $request->session()->forget("image2");
      $request->session()->forget("image3");
      return redirect()->route('postNew_post');
    }

    // ユーザー詳細へ
    elseif ($request->has("sub_user")) {
      $data = ['user_id' => $request->user_id];
      return redirect()->route('userDetail')->withInput($data);
    }

    else{
      return view('figures/users.user',["session" => $session, "findUser" => $findUser]);
    }
  }


  // ─── 詳細(get) ────────────────────────
  public function userDetail(Request $request){
    $session = $request->session()->get("input");
    $data = $request->old('user_id');

    if (empty($data)) {
      $id = $request->session()->get("input.id");
    }
    elseif (!empty($data)) {
      $id = $data;
    }

    $countUserid = $request->session()->get("input.id");

    $findUser = $this->user->findUser($id);
    $allUserPosts = $this->post->allUserPosts($countUserid);

    return view('figures/users.user_detail',["session" => $session, "findUser" => $findUser, "allUserPosts" => $allUserPosts]);
  }


  // ─── 詳細(post) ────────────────────────
  public function userDetail_post(Request $request){
    $session = $request->session()->get("input");

    // 編集へ
    if ($request->has("sub_edit")) {
      return redirect()->route('userEdit_post');
    }

    // 削除
    elseif ($request->has("delete")) {
      // アイコン削除
      $deleteImg = $request->session()->get("input.icon");
      Storage::delete('public/icon/' . $deleteImg);

      $id = $request->id;
      $this->user->deleteUser($id);
      $request->session()->flush();
      return redirect()->route('top');
    }

    else {
      return view('figures/users.user_detail',["session" => $session]);
    }
  }


  // ─── 編集(get) ────────────────────────
  public function userEdit(Request $request){

    // ログイン状態
    if ($request->session()->has('input')) {
      $session = $request->session()->get("input");
      return view('figures/users.user_edit',["session" => $session]);
    }

    // ゲストリダイレクト
    else {
      return redirect()->route('top');
    }

  }


  // ─── 編集(post) ────────────────────────
  public function userEdit_post(Request $request){

    $id = $request->id;
    $user_name = $request->user_name;
    $comment = $request->comment;
    $password = $request->password;
    $password_check = $request->password_check;
    $email = $request->email;
    $updated_at = Carbon::now();

    $input = $request->only($this->user->fillable);


    // 画像を送信
    $deleteImg = $request->session()->get("input.icon");
    if ($request->has("upload")) {
      if ($request->has("icon")) {
        // 画像を登録
        $image = $request->file('icon')->store('public/icon');

        $icon = str_replace('public/icon/', '', $image);;
        $this->user->iconUser($id,$icon);

        $user = $this->user->findUser($id);
        $request->session()->put("input", $user);
        $session = $request->session()->get("input");

        // 画像削除
        if (session()->has("input.icon")) {
          Storage::delete('public/icon/' . $deleteImg);
        }
      }
      return redirect()->route('userEdit_post');
    }


    // ユーザー情報を更新
    elseif ($request->has("edit")) {

      $validator = Validator::make($request->all(), [
        'user_name' => ['required',  Rule::unique('users')->ignore($request->id, 'id')],
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
        $user = $this->user->findUser($id);

        $request->session()->put("input", $user);
        $session = $request->session()->get("input");

        return view('figures/users.user_edit',["session" => $session])
        ->withErrors($validator)
        ->withInput($session);
      }

      // バリデーション成功・編集
      else {
        $this->user->updateUser($id,$user_name,$comment,$password,$email,$updated_at);
        $user = $this->user->findUser($id);

        $request->session()->put("input", $user);
        $session = $request->session()->get("input");
        return redirect()->route('userDetail');
      }
    }

  }
}

// webmaster
// test@test.com

// var_dump($session);
