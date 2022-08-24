<!DOCTYPE html>
<html lang="jp">
  <head>
    @include('figures/include.head')
  </head>

  <body>
    <!-- ─── 背景 ──────────────────────── -->
    <div class="back_img">
      <img src="{{ asset('img/main/back1.jpg') }}">
    </div>

    <!-- ─── ヘッダー ──────────────────────── -->
    <div class="header">
      @include('figures/include.header')
    </div>

    <!-- ─── ログイン ──────────────────────── -->
    <div class="login wrap main">

      <h2>Login</h2>

      <dl class="ctr">
        @if(isset($input['reset']))
          <p>登録時のユーザー名とメールアドレスを入力した上で、新しいパスワードを入力して下さい。</p>
        @else
          <p>ユーザー登録をすると、<br>
            記事の投稿・お気に入り機能、発売予定日をマイカレンダーに追加する機能などをご利用出来ます。</p>
        @endif

          <form action="" method="post">
            @csrf

            <!-- ユーザー名 -->
            <div class="user">
              <dd>
                <p>User：</p>
                <input type="text" name="user_name" value="@if(isset($input['user_name'])){{ $input['user_name']; }}@endif">

              </dd>
              <span>
                @if($errors->has('user_name'))
                 <p>※{{ $errors->first('user_name') }}</p>
                @endif
              </span>
            </div>

            <!-- パスワード -->
            <div class="password">
              <dd>
                <p>Pass：</p>
                <input type="password" name="password">
              </dd>
              <span>
                @if($errors->has('password'))
                 <p>※{{ $errors->first('password') }}</p>
                @elseif(isset($user['pass_error']))
                 <p>※{{ $user['pass_error'] }}</p>
                @endif
              </span>
            </div>

            <!-- パスワード（確認） -->
            <div class="password_check">
              @if(isset($input['signup']) || isset($input['reset']))
              <dd>
                <p>Check：</p>
                <input type="password" name="password_check" placeholder="パスワードを再入力して下さい。">
              </dd>
              @endif
              <span>
                @if($errors->has('password_check'))
                 <p>※{{ $errors->first('password_check') }}</p>
                @endif
              </span>
            </div>

            <!-- メールアドレス -->
            <div class="email">
              @if(isset($input['signup']) || isset($input['reset']))
              <dd>
                <p>Email：</p>
                <input type="text" name="email" value="@if(isset($input['email'])){{ $input['email']; }}@endif">
              </dd>
              @endif
              <span>
                @if($errors->has('email'))
                 <p>※{{ $errors->first('email') }}</p>
                @elseif(isset($user['email_error']))
                  <p>※{{ $user['email_error'] }}</p>
                @endif
              </span>
            </div>


            <!-- ログイン -->
            <div class="submit">
              <dd>
                <button type="submit" name="login">ログイン</button>
                <button type="submit" name="signup">新規登録</button>
              </dd>
            </div>

            <div class="password_reset">
              <dd>
                @if(isset($input['reset']))
                  <button type="submit" name="reset" class="resetComp">パスワードリセット</button>
                @else
                  <button type="submit" name="reset" class="reset">パスワードリセット</button>
                @endif
              </dd>
            </div>
          </form>

        <!-- ゲスト -->
        <div class="back">
          <dd>
            <a href="{{ route('top') }}">GUEST</a>
          </dd>
        </div>

      </dl>
    </div>


    <!-- ─── フッター ──────────────────────── -->
    <div class="footer">
      @include('figures/include.footer')
    </div>

  </body>
</html>
