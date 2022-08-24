<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Calendar;
use App\Models\Info;
use App\Models\Post;
use App\Models\Favorite_posts;
use App\Models\Favorite_calendar;

class FiguresController extends Controller{

  private $user;
  private $calendar;
  private $info;
  private $post;
  private $favorite_posts;
  private $favorite_calendar;

  public function __construct(){
    $this->user = new User();
    $this->calendar = new Calendar();
    $this->info = new Info();
    $this->post = new Post();
    $this->favorite_posts = new Favorite_posts();
    $this->favorite_calendar = new Favorite_calendar();
  }


  // ─── トップ ────────────────────────
  public function top(){
    $user_id = 1;
    $findUserPost = $this->post->findUserPost($user_id);
    return view('figures.top',["findUserPost" => $findUserPost]);
  }

  // ─── メイン（get） ────────────────────────
  public function main(Request $request){
    $session = $request->session()->get("input");
    $user_id = $request->session()->get("input.id");

    // カレンダー
    $user_id_calendar = $request->session()->get("input.id");

    $releaseMonth = $request->releaseMonth;
    $tag = $request->tag;
    $allCalendar = $this->calendar->allCalendar();
    $sortCalendar = $this->calendar->sortCalendar($releaseMonth,$tag);
    $likeUsercalendar = $this->favorite_calendar->likeUsercalendar($user_id_calendar);

    // インフォ
    $allInfo = $this->info->allInfo();

    // ポスト
    $allPost10 = $this->post->allPost10();
    $sortPopular10 = $this->favorite_posts->sortPopular10();

    return view('figures.main',[
      "session" => $session,
      "releaseMonth" => $releaseMonth,
      "allCalendar" => $allCalendar,
      "sortCalendar" => $sortCalendar,
      "likeUsercalendar" => $likeUsercalendar,
      "allInfo" => $allInfo,
      "allPost10" => $allPost10,
      "sortPopular10" => $sortPopular10
    ]);
  }



}
