<!-- ─── ヘッダー ──────────────────────── -->
<div class="navi wrap">

  <!-- トップへ戻るロゴ -->
  <div class="logo">
    <a href="{{ route('top') }}">figure.web</a>
  </div>

  <!-- ハンバーガーボタン -->
  <div class="hamburger">
    <img src="{{ asset('img//main/icon1.png') }}" class="on">
    <img src="{{ asset('img//main/icon2.png') }}" class="off">
  </div>
</div>

<!-- ハンバーガーメニュー -->
<div class="menu">

  <div class="user">
    <!-- アイコン -->
    <div class="icon">
      @if(isset($session['icon']))
       <a href="{{ route('user') }}">
         <img src="{{ asset('storage/icon/'.$session['icon']) }}" alt="">
       </a>
      @else
       <img src="{{ asset('img/test.png') }}" alt="">
      @endif

    </div>

    <!-- ユーザー -->
    <div class="name">
      @if(isset($session['user_name']))
       <a href="{{ route('userDetail') }}">{{ $session['user_name'] }}</a>
      @else
       guest
      @endif
    </div>

    <!-- ログイン -->
    <div class="login">
      <a href="{{ route('login') }}">
        @if(isset($session['user_name']))
        Logout
        @else
        Login
        @endif
      </a>
    </div>
  </div>

  <!-- ナビ -->
  <div class="navi">
    <ul>
      <li>
        <a href="{{ route('post') }}"><p>Posts</p></a>
      </li>

      <li>
        <a href="{{ route('main') }}#calendar"><p>Release Date</p></a>
      </li>

      <li>
        <a href="{{ route('info') }}"><p>Information</p></a>
      </li>

      <li>
        <a href="{{ route('contactNew') }}"><p>Contact</p></a>
      </li>
    </ul>
  </div>

</div>
