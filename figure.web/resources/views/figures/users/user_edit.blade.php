<!DOCTYPE html>
<html lang="jp">
  <head>
    @include('figures/include.head')

  <body>
    <!-- ─── 背景 ──────────────────────── -->
    <div class="back_img">
      <img src="{{ asset('img/main/back1.jpg') }}">
    </div>


    <!-- ─── ヘッダー ──────────────────────── -->
    <div class="header">
      @include('figures/include.header')
    </div>


    <!-- ─── ステータス ──────────────────────── -->
    <div class="user_page wrap main">

      <h2>User Edit</h2>

      <dl class="ctr">

        <!-- 画像を送信 -->
        <form action="" method="post" enctype="multipart/form-data">
          @csrf
          <!-- id -->
          <input type="hidden" name="id" value="@if(isset($session['id'])){{ $session['id']; }}@endif">

          <!-- アイコン -->
          <div class="icon">
            @if(isset($session['icon']))
            <img src="{{ asset('storage/icon/'.$session['icon']) }}" alt="">
            @endif
            <dd>
              <p>Icon：</p>
              <input type="file" name="icon">
              <button type="submit" name="upload">投　稿</button>
            </dd>
          </div>
        </form>


        <!-- ユーザー情報を更新 -->
        <form action="{{ route('userEdit_post') }}" method="post">
          @csrf
          <!-- id -->
          <input type="hidden" name="id" value="@if(isset($session['id'])){{ $session['id']; }}@endif">

          <!-- ユーザー名 -->
          <div class="user">
            <dd>
              <p>User：</p>
              <input type="text" name="user_name" value="@if(isset($session['user_name'])){{ $session['user_name']; }}@endif">
            </dd>
            <span>
              @if($errors->has('user_name'))
               <p>※{{ $errors->first('user_name') }}</p>
              @endif
            </span>
          </div>

          <!-- 説明文 -->
          <div class="text">
            <dd>
              <p>text：</p>
              <input type="text" name="comment" value="@if(isset($session['comment'])){{ $session['comment']; }}@endif">
            </dd>
          </div>

          <!-- パスワード -->
          <div class="password">
            <dd>
              <p>Pass：</p>
              <input type="password" name="password" placeholder="パスワードを入力して下さい。">
            </dd>
            <span>
              @if($errors->has('password'))
               <p>※{{ $errors->first('password') }}</p>
              @endif
            </span>
          </div>

          <!-- パスワード（確認） -->
          <div class="password_check">
            <dd>
              <p>Check：</p>
              <input type="password" name="password_check" placeholder="パスワードを再入力して下さい。">
            </dd>
            <span>
              @if($errors->has('password_check'))
               <p>※{{ $errors->first('password_check') }}</p>
              @endif
            </span>
          </div>

          <!-- メールアドレス -->
          <div class="email">
            <dd>
              <p>Email：</p>
              <input type="text" name="email" value="@if(isset($session['email'])){{ $session['email']; }}@endif">
            </dd>
            <span>
              @if($errors->has('email'))
               <p>※{{ $errors->first('email') }}</p>
              @endif
            </span>
          </div>

          <!-- 編集 -->
          <div class="submit">
            <button type="submit" name="edit">編　集</button>
          </div>

          <!-- 戻る -->
          <div class="back">
            <a href="{{ route('userDetail') }}">戻る</a>
          </div>
        </dl>
      </form>
    </div>

    <!-- ─── フッター ──────────────────────── -->
    <div class="footer">
      @include('figures/include.footer')
    </div>

  </body>
</html>
