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

    <!-- ─── お問い合わせ ──────────────────────── -->
    <div class="contact_new wrap main">

      <h2>Contact</h2>

      <form action="" method="post">
        @csrf

        <dl class="ctr">
          <!-- 氏名 -->
          <div class="name">
            <label>
              <dd>
                <h3>氏名</h3>
                <input type="text" name="name" value="{{ old('name') }}">
              </dd>
            </label>
            <span>
              @if($errors->has('name'))
               <p>※{{ $errors->first('name') }}</p>
              @endif
            </span>
          </div>


          <!-- ユーザー名 -->
          <div class="user">
            <label>
              <dd>
                <h3>ユーザー名</h3>
                <input type="text" name="user_name" value="{{ old('user_name') }}">
              </dd>
            </label>
            <span>
              @if($errors->has('user_name'))
               <p>※{{ $errors->first('user_name') }}</p>
              @endif
            </span>
          </div>


          <!-- メールアドレス -->
          <div class="email">
            <label>
              <dd>
                <h3>アドレス</h3>
                <input type="text" name="email" value="{{ old('email') }}">
              </dd>
            </label>
            <span>
              @if($errors->has('email'))
               <p>※{{ $errors->first('email') }}</p>
              @endif
            </span>
          </div>


          <!-- 内容 -->
          <div class="body">
            <label>
              <dd>
                <h3>内容</h3>
                <textarea name="body">{{ old('body') }}</textarea>
              </dd>
            </label>
            <span>
              @if($errors->has('body'))
               <p>※{{ $errors->first('body') }}</p>
              @endif
            </span>
          </div>


          <!-- 送信 -->
          @if(session()->has('contact'))
           <p>{!! session()->get('contact') !!}</p>
          @endif

          <div class="submit">
            <dd>
              <button type="submit" name="confirm">確認</button>
            </dd>

            @if(session()->has('contact'))
            <dd>
              <button type="submit" name="complete">送信</button>
            </dd>
            @endif

            <dd>
              <a href="{{ route('main') }}">戻る</a>
            </dd>
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
