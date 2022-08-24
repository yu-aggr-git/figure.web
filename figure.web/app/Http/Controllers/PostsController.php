<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Favorite_posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller{

  private $Post;
  private $User;
  private $Favorite_posts;

  public function __construct(){
    $this->post = new Post();
    $this->user = new User();
    $this->favorite_posts = new Favorite_posts();
  }

  // ─── お気に入り(post) ────────────────────────
  public function like(Request $request){
    $user_id = $request->session()->get("input.id");
    $posts_id = $request->post_id;
    $liked = $this->favorite_posts->liked($user_id,$posts_id);

    // いいね未だ
    if (!$liked) {
      $this->favorite_posts->insertFavorite_posts($user_id,$posts_id);
    }

    // いいね済み
    else {
      $this->favorite_posts->deleteFavorite_posts($user_id,$posts_id);
    }

    // カウント
    $count = $this->favorite_posts->countLike($user_id);
  }


  // ─── 一覧(get) ────────────────────────
  public function post(Request $request){
    $session = $request->session()->get("input");

    $user_id = $request->session()->get("input.id");
    $allPost = $this->post->allPost();
    $likeUser = $this->favorite_posts->likeUser($user_id);

    return view('figures/posts.post',["session" => $session, "allPost" => $allPost, "likeUser" => $likeUser]);

  }


  // ─── 一覧(post) ────────────────────────
  public function post_post(Request $request){
    $session = $request->session()->get("input");
    $user_id = $request->session()->get("input.id");
    $likeUser = $this->favorite_posts->likeUser($user_id);

    // マイポスト
    if ($request->has("myPost")) {
      $allPost = $this->post->findUserPost($user_id);
    }

    // お気に入り
    elseif ($request->has("myLike")) {
      $allPost = $this->favorite_posts->findFavorite_posts($user_id);
    }

    // 新着
    elseif ($request->has("newPost")) {
      $allPost = $this->post->allPost();
    }

    // 人気
    elseif ($request->has("popular")) {
      $allPost = $this->favorite_posts->sortPopular()->unique();
    }

    // 検索
    elseif ($request->has("sort_Post")) {
      $tag = $request->tag;
      $allPost = $this->post->sortTagPost($tag);
    }

    return view('figures/posts.post',["session" => $session, "allPost" => $allPost, "likeUser" => $likeUser]);
  }


  // ─── 1詳細(get) ────────────────────────
  public function postDetail(Request $request){
    $session = $request->session()->get("input");

    $id = $request->id;
    $findIdPost = $this->post->findIdPost($id);

    $posts_id = $request->id;
    $user_id = $request->session()->get("input.id");
    $count = $this->favorite_posts->countLike($posts_id);
    $liked = $this->favorite_posts->liked($user_id,$posts_id);

    return view('figures/posts.post_detail',["session" => $session,"findIdPost" => $findIdPost, "count" => $count, "liked" => $liked]);
  }


  // ─── 1詳細(post) ────────────────────────
  public function postDetail_post(Request $request){
    $id = $request->id;
    $findIdPost = $this->post->findIdPost($id);

    // 編集
    if ($request->has("editPost")) {
      $request->session()->forget("thumbnail");
      $request->session()->forget("image1");
      $request->session()->forget("image2");
      $request->session()->forget("image3");
      return redirect()->route('postEdit',['id' => $id]);
    }

    // 削除
    elseif ($request->has("deletePost")) {
      $this->post->deletePost($id);
      return redirect()->route('user');
    }

    // 他ユーザーへ
    elseif ($request->has("sub_user")) {
      $data = ['user_id' => $request->user_id];
      return redirect()->route('user')->withInput($data);
    }
  }


  // ─── 2編集(get) ────────────────────────
  public function postEdit(Request $request){

    // ログイン状態
    if ($request->session()->has('input')) {
      $session = $request->session()->get("input");
      $id = $request->id;
      $findIdPost = $this->post->findIdPost($id);

      $myUser = $request->session()->get("input.id");
      $postUser = $findIdPost['user_id'];

      if ($myUser == $postUser) {
        return view('figures/posts.post_edit',[
          "session" => $session,
          "findIdPost" => $findIdPost
        ]);
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


  // ─── 2編集(post) ────────────────────────
  public function postEdit_post(Request $request){
    $id = $request->id;
    $findIdPost = $this->post->findIdPost($id);

    // サムネイル
    if ($request->has("edit_thumbnail")) {
      if ($request->has("thumbnail")) {
        $image = $request->file('thumbnail')->store('public/post');
        $thumbnail = str_replace('public/post/', '', $image);
        $request->session()->put("thumbnail", $thumbnail);
      }
      return redirect()->route('postEdit_post',['id' => $id]);
    }

    // イメージ
    elseif ($request->has("edit_images")) {
      if ($request->has("image1")) {
        $image1 = $request->file('image1')->store('public/post');
        $image1_name = str_replace('public/post/', '', $image1);
        $request->session()->put("image1", $image1_name);
      }
      if ($request->has("image2")) {
        $image2 = $request->file('image2')->store('public/post');
        $image2_name = str_replace('public/post/', '', $image2);
        $request->session()->put("image2", $image2_name);
      }
      if ($request->has("image3")) {
        $image3 = $request->file('image3')->store('public/post');
        $image3_name = str_replace('public/post/', '', $image3);
        $request->session()->put("image3", $image3_name);
      }
      return redirect()->route('postEdit_post',['id' => $id]);
    }

    // イメージ(削除)
    elseif ($request->has("delete_image1")){
      $request->session()->put("image1", "");
      return redirect()->route('postEdit_post',['id' => $id]);
    }

    elseif ($request->has("delete_image2")){
      $request->session()->put("image2", "");
      return redirect()->route('postEdit_post',['id' => $id]);
    }

    elseif ($request->has("delete_image3")){
      $request->session()->put("image3", "");
      return redirect()->route('postEdit_post',['id' => $id]);
    }

    // 編集
    elseif ($request->has("edit_Post")) {

      $thumbnail = $request->thumbnail;
      $image1 = $request->image1;
      $image2 = $request->image2;
      $image3 = $request->image3;
      $id = $request->id;
      $comment = $request->comment;
      $tag1 = $request->tag1;
      $tag2 = $request->tag2;
      $tag3 = $request->tag3;
      $tag4 = $request->tag4;
      $tag5 = $request->tag5;
      $status = $request->status;
      $updated_at = Carbon::now();

      $input = $request->only($this->post->fillable);

      $validator = Validator::make($request->all(), [
        'thumbnail' => ['required'],
        'status' => ['required']
      ],
      [
        'thumbnail.required' => 'サムネイルは必須入力です。',
        'status.required' => 'どちらか選択して下さい。',
      ]);

      // バリデーション失敗
      if ($validator->fails()) {
        return redirect()->route('postEdit_post',['id' => $id])
        ->withErrors($validator)
        ->withInput();
      }
      // バリデーション成功・投稿
      else {
        // 画像削除
        if (session()->has("thumbnail")) {
          $deleteThumbnail = $findIdPost['thumbnail'];
          Storage::delete('public/post/' . $deleteThumbnail);
        }
        if (session()->has("image1")) {
          $deleteImage1 = $findIdPost['image1'];
          Storage::delete('public/post/' . $deleteImage1);
        }
        if (session()->has("image2")) {
          $deleteImage2 = $findIdPost['image2'];
          Storage::delete('public/post/' . $deleteImage2);
        }
        if (session()->has("image3")) {
          $deleteImage3 = $findIdPost['image3'];
          Storage::delete('public/post/' . $deleteImage3);
        }

        $this->post->updatePost($id,$comment,$thumbnail,$tag1,$tag2,$tag3,$tag4,$tag5,$status,$image1,$image2,$image3,$updated_at);
        $request->session()->forget("thumbnail");
        $request->session()->forget("image1");
        $request->session()->forget("image2");
        $request->session()->forget("image3");

        return redirect()->route('postDetail',['id' => $id]);
      }
    }
  }


  // ─── 新規登録(get) ────────────────────────
  public function postNew(Request $request){

    // ログイン状態
    if ($request->session()->has('input')) {
      $session = $request->session()->get("input");
      return view('figures/posts.post_new',["session" => $session]);
    }

    // ゲストリダイレクト
    else {
      return redirect()->route('top');
    }

  }


  // ─── 新規投稿(post) ────────────────────────
  public function postNew_post(Request $request){

    // サムネイル
    if ($request->has("up_thumbnail")) {
      if ($request->has("thumbnail")) {
        $image = $request->file('thumbnail')->store('public/post');
        $thumbnail = str_replace('public/post/', '', $image);
        $request->session()->put("thumbnail", $thumbnail);
      }
      return redirect()->route('postNew_post');
    }

    // イメージ(編集)
    elseif ($request->has("up_images")) {
      if ($request->has("image1")) {
        $image1 = $request->file('image1')->store('public/post');
        $image1_name = str_replace('public/post/', '', $image1);
        $request->session()->put("image1", $image1_name);
      }
      if ($request->has("image2")) {
        $image2 = $request->file('image2')->store('public/post');
        $image2_name = str_replace('public/post/', '', $image2);
        $request->session()->put("image2", $image2_name);
      }
      if ($request->has("image3")) {
        $image3 = $request->file('image3')->store('public/post');
        $image3_name = str_replace('public/post/', '', $image3);
        $request->session()->put("image3", $image3_name);
      }
      return redirect()->route('postNew_post');
    }

    // 新規投稿
    elseif ($request->has("newPost")) {

      $thumbnail = $request->thumbnail;
      $image1 = $request->image1;
      $image2 = $request->image2;
      $image3 = $request->image3;
      $user_id = $request->user_id;
      $comment = $request->comment;
      $tag1 = $request->tag1;
      $tag2 = $request->tag2;
      $tag3 = $request->tag3;
      $tag4 = $request->tag4;
      $tag5 = $request->tag5;
      $status = $request->status;
      $created_at = Carbon::now();

      $input = $request->only($this->post->fillable);

      $validator = Validator::make($request->all(), [
        'thumbnail' => ['required'],
        'status' => ['required']
      ],
      [
        'thumbnail.required' => 'サムネイルは必須入力です。',
        'status.required' => 'どちらか選択して下さい。',
      ]);

      // バリデーション失敗
      if ($validator->fails()) {
        return redirect()->route('postNew_post')
        ->withErrors($validator)
        ->withInput();
      }
      // バリデーション成功・投稿
      else {
        $this->post->insertPost($user_id,$comment,$thumbnail,$tag1,$tag2,$tag3,$tag4,$tag5,$status,$image1,$image2,$image3,$created_at);
        $request->session()->forget("thumbnail");
        $request->session()->forget("image1");
        $request->session()->forget("image2");
        $request->session()->forget("image3");

        return redirect()->route('user');
      }
    }
  }
}

// webmaster
// test@test.com

// var_dump($session);
