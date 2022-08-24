<!DOCTYPE html>
<html lang="jp">
  <head>
    @include('figures/include.head')

  <body>
    <!-- ─── 背景 ──────────────────────── -->
    <div class="back_img">
      <img src="
      @if(isset($findUser['icon']))
       {{ asset('storage/icon/'.$findUser['icon']) }}
      @else
       {{ asset('img/main/back1.jpg') }}
      @endif
      ">
    </div>


    <!-- ─── ヘッダー ──────────────────────── -->
    <div class="header">
      @include('figures/include.header')
    </div>


    <!-- ─── ステータス ──────────────────────── -->
    <div class="user_page wrap">

      <!-- アイコン -->
      <div class="icon">
        @if(isset($findUser['icon']))
          <img src="{{ asset('storage/icon/'.$findUser['icon']) }}" alt="">
        @else
          <img src="{{ asset('img/test.png') }}" alt="">
        @endif
      </div>

      <!-- ユーザー名 -->
      <div class="name">
        @if(isset($findUser['user_name']))
          <form action="" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ $findUser['id'] }}">
            <button type="submit" name="sub_user">{{ $findUser['user_name'] }}</button>
          </form>
        @else
         guest
        @endif
      </div>

      <!-- コメント -->
      <div class="comment">
        @if(isset($findUser['comment']))
         <p>{{ $findUser['comment'] }}</p>
        @endif
      </div>

      <!-- 新着投稿 -->
      <div class="new">
        @if(isset($session['id']) && $session['id'] == $findUser['id'])
        <form class="" action="" method="post">
          @csrf
          <input type="hidden" name="id" value="@if(isset($findUser['id'])){{ $findUser['id']; }}@endif">
          <button type="submit" name="sub_postNew">新規投稿</button>
        </form>
        @endif
      </div>
    </div>


    <!-- ─── 投稿一覧(新着順) ──────────────────────── -->
    <div class="post_top wrap">

      <h2>NEW</h2>

      <div class="ctr">
        @foreach ($findUserPost as $data)
        <a href="{{ route('postDetail', $data['id']) }}">
          <img src="{{ asset('storage/post/'.$data['thumbnail']) }}">
        </a>
        @endforeach
      </div>

      <div class="more">
        <a href="{{ route('post') }}">more</a>
      </div>
    </div>


    <!-- ─── 投稿一覧(お気に入り) ──────────────────────── -->
    <div class="post_top wrap">
      <h2>♥</h2>

      <div class="ctr">
        @foreach ($findFavorite_posts as $data)
        <a href="{{ route('postDetail', $data['id']) }}">
          <img src="{{ asset('storage/post/'.$data['thumbnail']) }}">
        </a>
        @endforeach
      </div>

      <div class="more">
        <a href="{{ route('post') }}">more</a>
      </div>
    </div>


    <!-- ─── 発売日 ──────────────────────── -->
    <div class="release wrap" id="calendar">
      <h2>Release Date</h2>

      <!-- 並び替え -->
      <form action="" method="get">
        @csrf
        <div class="sort">
          <select name="releaseMonth">
            <option value="">all</option>
            @foreach ($allCalendar->unique('releaseMonth') as $data)
             <option value="{{ $data['releaseMonth'] }}">{{ $data['releaseMonth']}}</option>
            @endforeach
          </select>

          <input type="text" name="tag">
        </div>

        <div class="submit">
          <button type="submit" name="sub_orderBy">送信</button>
        </div>
      </form>


      <!-- カレンダー -->
      <h3>{{ $releaseMonth }}</h3>

      <div class="data">
        <!-- ポストID取得用 -->
        <span>
          @foreach ($likeUsercalendar as $data)
            {{ $calendarId[$data['calendar_id']] = $data['calendar_id'] }}
          @endforeach
        </span>

        @foreach ($sortCalendar as $data)
        <table>

          <!-- メーカー名 -->
          <tr>
            <th colspan="2">{{ $data['maker'] }}</th>
          </tr>

          <!-- ブランド名 -->
          <tr>
            <th colspan="2">{{ $data['brand'] }}</th>
          </tr>

          <!-- サムネイル -->
          <tr>
            <td colspan="2" class="calendar_img">
              <a href="{{ route('calendarDetail', $data['id']) }}">
              <img src="{{ asset('storage/calendar/'.$data['thumbnail']) }}" alt="">
              </a>
            </td>
          </tr>

          <!-- いいね -->
          <tr>
            <!-- 発売日 -->
            <td>
              {{ $data['releaseMonth'] }}@if(!empty($data['releaseDate']))/{{ $data['releaseDate'] }}@endif
            </td>

            <!-- いいね -->
            @if(session()->has('input'))
            <td class="likeCalendar" data-calendar-id="{{ $data['id'] }}" >
              @if(!empty($likeUsercalendar))
                @if(isset($calendarId[$data['id']]) && $calendarId[$data['id']] == $data['id'])
                  <p id="likeCalendarId{{ $data['id'] }}" class="liked">♥</p>
                @else
                  <p id="likeCalendarId{{ $data['id'] }}" >♥</p>
                @endif
              @else
                <p id="likeCalendarId{{ $data['id'] }}" class="liked">♥</p>
              @endif
            </td>
            @else
            <td class="like">
              <p>♥</p>
            </td>
            @endif
          </tr>
        </table>
        @endforeach
      </div>
    </div>


    <!-- ─── 管理者用 ──────────────────────── -->
    <div class="webmaster_edit wrap">
      @if(isset($session['role']) && $session['role'] == '0' && $session['id'] == $findUser['id'])
      <p>
        <a href="{{ route('calendarNew') }}">カレンダー登録</a>
      </p>

      <p>
        <a href="{{ route('info') }}">お知らせ登録</a>
      </p>
      <p>

        <a href="{{ route('contactView') }}">お問い合わせ確認</a>
      </p>
      @endif
    </div>

    <!-- 戻る -->
    <div class="user_page_back">
      <a href="{{ route('main') }}">トップへ戻る</a>
    </div>

    <!-- ─── フッター ──────────────────────── -->
    <div class="footer">
      @include('figures/include.footer')
    </div>

  </body>
</html>
