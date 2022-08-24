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

    <!-- ─── 投稿一覧(新着順) ──────────────────────── -->
    <div class="post_top wrap">

      <h2>NEW</h2>

      <div class="ctr">
        @foreach ($allPost10 as $data)
        <a href="{{ route('postDetail', $data['id']) }}">
          <img src="{{ asset('storage/post/'.$data['thumbnail']) }}">
        </a>
        @endforeach
      </div>

      <div class="more">
        <a href="{{ route('post') }}">more</a>
      </div>
    </div>


    <!-- ─── 投稿一覧(人気順) ──────────────────────── -->
    <div class="post_top wrap">
      <h2>♥</h2>

      <div class="ctr">
        @foreach ($sortPopular10 as $data)
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

          <!--お気に入り -->
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


    <!-- ─── お知らせ ──────────────────────── -->
    <div class="info wrap">
      <h2>Information</h2>

      @foreach ($allInfo as $data)
      <!-- 非公開 -->
      @if($data['status'] == 0)
        <table>
          <tr>
            <th>{{ $data['created_at'] }}</th>
            <td>{{ $data['title'] }}</td>
          </tr>
        </table>
      @endif
      @endforeach

      <div class="more">
        <a href="{{ route('info') }}">more</a>
      </div>
    </div>


    <!-- ─── フッター ──────────────────────── -->
    <div class="footer">
      @include('figures/include.footer')
    </div>

  </body>
</html>
