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


    <!-- ─── 投稿詳細 ──────────────────────── -->
    <div class="calendar wrap main">

      <h2>Detail</h2>

      <div class="ctr">
        <!-- サムネイル -->
        <img src="{{ asset('storage/calendar/'.$findCalendar['thumbnail']) }}" alt="">

        <!-- リンク -->
        <div class="links">
            <a href="{{ $findCalendar['link'] }}">詳細はこちら</a>

            <!-- ポストID取得用 -->
            <span>
              @foreach ($likeUsercalendar as $data)
                {{ $calendarId[$data['calendar_id']] = $data['calendar_id'] }}
              @endforeach
            </span>

            <!-- いいね -->
            @if(session()->has('input'))
            <div class="likeCalendar" data-calendar-id="{{ $findCalendar['id'] }}" >
              @if(!empty($likeUsercalendar))
                @if(isset($calendarId[$findCalendar['id']]) && $calendarId[$findCalendar['id']] == $findCalendar['id'])
                  <p id="likeCalendarId{{ $findCalendar['id'] }}" class="liked">♥</p>
                @else
                  <p id="likeCalendarId{{ $findCalendar['id'] }}" >♥</p>
                @endif
              @else
                <p id="likeCalendarId{{ $findCalendar['id'] }}" class="liked">♥</p>
              @endif
            </div>
            @else
            <div class="like">
              <p>♥</p>
            </div>
            @endif
        </div>

        <table class="data">
          <tr>
            <th>Company</th>
            <td>{{ $findCalendar['maker'] }}</td>
          </tr>

          <tr>
            <th>Brand</th>
            <td>{{ $findCalendar['brand'] }}</td>
          </tr>

          <tr>
            <th>Nmae</th>
            <td>{{ $findCalendar['item'] }}</td>
          </tr>

          <tr>
            <th>Series</th>
            <td>{{ $findCalendar['series'] }}</td>
          </tr>

          <tr>
            <th>Release Month</th>
            <td>{{ $findCalendar['releaseMonth'] }}</td>
          </tr>

          <tr>
            <th>Release Date</th>
            <td>{{ $findCalendar['releaseDate'] }}</td>
          </tr>
        </table>


        <!-- ─── 管理者用 ──────────────────────── -->
        @if(isset($session['role']) && $session['role'] == '0')
        <form action="" method="post">
          @csrf
          <div class="edit">
            <dd>
                <button type="submit" name="editCalendar">編集</button>
            </dd>
            <dd>
              <button type="submit" name="deleteCalendar" onclick="return confirm('本当に削除しますか？')">削除</button>
            </dd>
          </div>
        </form>
        @endif


        <!-- 戻る -->
        <div class="back">
          <a href="{{ route('main') }}">トップページへ戻る</a>
        </div>
      </div>
    </div>


    <!-- ─── フッター ──────────────────────── -->
    <div class="footer">
      @include('figures/include.footer')
    </div>

  </body>
</html>
