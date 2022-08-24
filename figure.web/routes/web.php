<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FiguresController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CalendarsController;
use App\Http\Controllers\InfosController;
use App\Http\Controllers\ContactsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



// ─── Figuresコントローラー ────────────────────────
 // トップ
 Route::get('/figure.web', [FiguresController::class, 'top'])->name('top');

 // メイン
 Route::get('/main',[FiguresController::class,'main'])->name('main');
 Route::post('/main',[FiguresController::class,'main_post'])->name('main_post');



// ─── loginコントローラー ────────────────────────
 // ログイン
 Route::get('/login',[LoginController::class,'login'])->name('login');
 Route::post('/login',[LoginController::class,'login_post'])->name('login_post');



// ─── usersコントローラー ────────────────────────
 // ユーザー
 Route::get('/user',[UsersController::class,'user'])->name('user');
 Route::post('/user',[UsersController::class,'user_post'])->name('user_post');

 // ユーザー(詳細)
 Route::get('/user/detail',[UsersController::class,'userDetail'])->name('userDetail');
 Route::post('/user/detail',[UsersController::class,'userDetail_post'])->name('userDetail_post');

 // ユーザー(編集)
 Route::get('/user/edit',[UsersController::class,'userEdit'])->name('userEdit');
 Route::post('/user/edit',[UsersController::class,'userEdit_post'])->name('userEdit_post');



// ─── postsコントローラー ────────────────────────
 // ─── 記事（新規） ────────────────────────
 Route::get('/post/new',[PostsController::class,'postNew'])->name('postNew');
 Route::post('/post/new',[PostsController::class,'postNew_post'])->name('postNew_post');

 // ─── 記事（詳細） ────────────────────────
 Route::get('/post/detail/{id}',[PostsController::class,'postDetail'])->name('postDetail');
 Route::post('/post/detail/{id}',[PostsController::class,'postDetail_post'])->name('postDetail_post');

 // ─── 記事（編集） ────────────────────────
 Route::get('/post/edit/{id}',[PostsController::class,'postEdit'])->name('postEdit');
 Route::post('/post/edit/{id}',[PostsController::class,'postEdit_post'])->name('postEdit_post');

 // ─── 記事(一覧) ────────────────────────
 Route::get('/post',[PostsController::class,'post'])->name('post');
 Route::post('/post',[PostsController::class,'post_post'])->name('post_post');


 // お気に入り
 Route::get('/like',[PostsController::class,'like'])->name('like');
 Route::post('/like',[PostsController::class,'like'])->name('like');


// ─── calendarsコントローラー ────────────────────────
  // ─── カレンダー（新規） ────────────────────────
  Route::get('/calendar/new',[CalendarsController::class,'calendarNew'])->name('calendarNew');
  Route::post('/calendar/new',[CalendarsController::class,'calendarNew_post'])->name('calendarNew_post');

  // ─── カレンダー（詳細） ────────────────────────
  Route::get('/calendar/detail/{id}',[CalendarsController::class,'calendarDetail'])->name('calendarDetail');
  Route::post('/calendar/detail/{id}',[CalendarsController::class,'calendarDetail_post'])->name('calendarDetail_post');

  // ─── カレンダー（編集） ────────────────────────
  Route::get('/calendar/edit/{id}',[CalendarsController::class,'calendarEdit'])->name('calendarEdit');
  Route::post('/calendar/edit/{id}',[CalendarsController::class,'calendarEdit_post'])->name('calendarEdit_post');

  // お気に入り
  Route::get('/likecalendar',[CalendarsController::class,'likecalendar'])->name('likecalendar');
  Route::post('/likecalendar',[CalendarsController::class,'likecalendar'])->name('likecalendar');


// ─── infosコントローラー ────────────────────────
  // ─── お知らせ ────────────────────────
  Route::get('/info',[InfosController::class,'info'])->name('info');
  Route::post('/info',[InfosController::class,'info_post'])->name('info_post');

  // ─── お知らせ(編集) ────────────────────────
  Route::get('/info/edit',[InfosController::class,'infoEdit'])->name('infoEdit');
  Route::post('/info/edit',[InfosController::class,'infoEdit_post'])->name('infoEdit_post');


// ─── contactsコントローラー ────────────────────────
  // お問い合わせ
  Route::get('/contact/view',[ContactsController::class,'contactView'])->name('contactView');
  Route::post('/contact/view',[ContactsController::class,'contactView_post'])->name('contactView_post');

  // 問い合わせ(入力)
  Route::get('/contact',[ContactsController::class,'contactNew'])->name('contactNew');
  Route::post('/contact',[ContactsController::class,'contactNew_post'])->name('contactNew_post');
