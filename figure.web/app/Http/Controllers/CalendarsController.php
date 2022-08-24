<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Models\Favorite_calendar;
use Illuminate\Support\Facades\Hash;
use Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class CalendarsController extends Controller{

  private $Calendar;
  private $Favorite_calendar;

  public function __construct(){
    $this->calendar = new Calendar();
    $this->favorite_calendar = new Favorite_calendar();
  }

  // ─── お気に入り(post) ────────────────────────
  public function likecalendar(Request $request){
    $user_id = $request->session()->get("input.id");
    $calendar_id = $request->postcalendar_id;
    $likedcalendar = $this->favorite_calendar->likedcalendar($user_id,$calendar_id);

    // いいね未だ
    if (!$likedcalendar) {
      $this->favorite_calendar->insertFavorite_calendar($user_id,$calendar_id);
    }

    // いいね済み
    else {
      $this->favorite_calendar->deleteFavorite_calendar($user_id,$calendar_id);
    }
  }


  // ─── 新規登録(get) ────────────────────────
  public function calendarNew(Request $request){

    // ログイン状態
    if ($request->session()->has('input')) {
      $myUser = $request->session()->get("input.id");

      if ($myUser == 1) {
        $session = $request->session()->get("input");
        return view('figures/calendars.calendar_new',["session" => $session]);
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


  // ─── 新規投稿(post) ────────────────────────
  public function calendarNew_post(Request $request){

    // サムネイル
    if ($request->has("up_thumbnail")) {
      if ($request->has("thumbnail")) {
        $image = $request->file('thumbnail')->store('public/calendar');
        $thumbnail = str_replace('public/calendar/', '', $image);
        $request->session()->put("thumbnail", $thumbnail);
      }
      return redirect()->route('calendarNew_post');
    }

    // 新規投稿
    elseif ($request->has("new_Calendar")) {

      $thumbnail = $request->thumbnail;
      $link = $request->link;
      $maker = $request->maker;
      $brand = $request->brand;
      $item = $request->item;
      $series = $request->series;
      $releaseMonth = $request->releaseMonth;
      $releaseDate = $request->releaseDate;

      $input = $request->only($this->calendar->fillable);

      $validator = Validator::make($request->all(), [
        'thumbnail' => ['required'],
        'maker' => ['required'],
        'item' => ['required'],
        'releaseMonth' => ['date_format:Y/m']
      ],
      [
        'thumbnail.required' => 'サムネイルは必須入力です。',
        'maker.required' => 'メーカー名は必須入力です。',
        'item.required' => '商品名は必須入力です。',
        'releaseMonth.date_format' => 'YYYY/mmの形で入力して下さい。',
      ]);

      // バリデーション失敗
      if ($validator->fails()) {
        return redirect()->route('calendarNew_post')
        ->withErrors($validator)
        ->withInput();
      }
      // バリデーション成功・投稿
      else {
        $this->calendar->insertCalendar($thumbnail,$link,$maker,$brand,$item,$series,$releaseMonth,$releaseDate);
        $request->session()->forget("thumbnail");

        return redirect()->route('user');
      }
    }
  }


  // ─── 詳細(get) ────────────────────────
  public function calendarDetail(Request $request){
    $id = $request->id;
    $user_id = $request->session()->get("input.id");
    $user_id_calendar = $request->session()->get("input.id");

    $session = $request->session()->get("input");
    $findCalendar = $this->calendar->findCalendar($id);
    $likeUsercalendar = $this->favorite_calendar->likeUsercalendar($user_id_calendar);

    return view('figures/calendars.calendar_detail',["session" => $session, "findCalendar" => $findCalendar, "likeUsercalendar" => $likeUsercalendar,]);
  }


  // ─── 詳細(post) ────────────────────────
  public function calendarDetail_post(Request $request){
    $id = $request->id;

    // 編集
    if ($request->has("editCalendar")) {
      $request->session()->forget("thumbnail");
      return redirect()->route('calendarEdit',['id' => $id]);
    }

    // 削除
    elseif ($request->has("deleteCalendar")) {
      $this->calendar->deleteCalendar($id);
      return redirect()->route('main');
    }
  }


  // ─── 編集(get) ────────────────────────
  public function calendarEdit(Request $request){

    // ログイン状態
    if ($request->session()->has('input')) {
      $myUser = $request->session()->get("input.id");

      if ($myUser == 1) {
        $id = $request->id;
        $findCalendar = $this->calendar->findCalendar($id);
        return view('figures/calendars.calendar_edit',["findCalendar" => $findCalendar]);
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
  public function calendarEdit_post(Request $request){
    $id = $request->id;
    $findCalendar = $this->calendar->findCalendar($id);

    // サムネイル
    if ($request->has("edit_thumbnail")) {
      if ($request->has("thumbnail")) {
        $image = $request->file('thumbnail')->store('public/calendar');
        $thumbnail = str_replace('public/calendar/', '', $image);
        $request->session()->put("thumbnail", $thumbnail);
      }
      return redirect()->route('calendarEdit_post',['id' => $id]);
    }

    // 編集
    elseif ($request->has("edit_Calendar")) {

      $thumbnail = $request->thumbnail;
      $link = $request->link;
      $maker = $request->maker;
      $brand = $request->brand;
      $item = $request->item;
      $series = $request->series;
      $releaseMonth = $request->releaseMonth;
      $releaseDate = $request->releaseDate;

      $input = $request->only($this->calendar->fillable);

      $validator = Validator::make($request->all(), [
        'thumbnail' => ['required'],
        'maker' => ['required'],
        'item' => ['required'],
        'releaseMonth' => ['date_format:Y/m']
      ],
      [
        'thumbnail.required' => 'サムネイルは必須入力です。',
        'maker.required' => 'メーカー名は必須入力です。',
        'item.required' => '商品名は必須入力です。',
        'releaseMonth.date_format' => 'YYYY/mmの形で入力して下さい。',
      ]);

      // バリデーション失敗
      if ($validator->fails()) {
        return redirect()->route('calendarEdit_post',['id' => $id])
        ->withErrors($validator)
        ->withInput();
      }
      // バリデーション成功・投稿
      else {
        // 画像削除
        if (session()->has("thumbnail")) {
          $deleteImg = $findCalendar['thumbnail'];
          Storage::delete('public/calendar/' . $deleteImg);
        }

        $this->calendar->updateCalendar($id,$thumbnail,$link,$maker,$brand,$item,$series,$releaseMonth,$releaseDate);
        $request->session()->forget("thumbnail");

        return redirect()->route('main');
      }
    }


  }
}

// webmaster
// test@test.com

// var_dump($session);
