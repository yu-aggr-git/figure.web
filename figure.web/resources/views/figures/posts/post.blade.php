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


    <!-- ─── 投稿一覧 ──────────────────────── -->
    <div class="posts wrap main">

      <!-- 検索 -->
      <h2>Posts</h2>
      <form action="" method="post">
        @csrf
        <div class="sort">
          <button type="submit" name="myPost">My Posts</button>

          <button type="submit" name="myLike">お気に入り</button>

          <button type="submit" name="newPost">新着</button>

          <button type="submit" name="popular">人気</button>

          <div class="submit">
            <input type="text" name="tag">
            <button type="submit" name="sort_Post">送信</button>
          </div>
        </div>
      </form>


      <!-- 一覧 -->
      <div class="data">

        <!-- ポストID取得用 -->
        <span>
          @foreach ($likeUser as $data)
            {{ $postsId[$data['posts_id']] = $data['posts_id'] }}
          @endforeach
        </span>

        @foreach ($allPost as $data)
        <table>
          <!-- サムネイル -->
          <tr>
            <th colspan="2">
              <a href="{{ route('postDetail', $data['id']) }}">
              <img src="{{ asset('storage/post/'.$data['thumbnail']) }}" alt="">
              </a>
            </th>
          </tr>

          <!-- いいね -->
          <tr>
            <td>{{ $data['user_name'] }}</td>

            @if(session()->has('input'))
            <td class="likePost" data-post-id="{{ $data['id'] }}">
              @if(!empty($likeUser))
                @if(isset($postsId[$data['id']]) && $postsId[$data['id']] == $data['id'])
                  <p id="likeId{{ $data['id'] }}" class="liked">♥</p>
                @else
                  <p id="likeId{{ $data['id'] }}" >♥</p>
                @endif
              @else
                <p id="likeId{{ $data['id'] }}" class="liked">♥</p>
              @endif
            </td>
            @else
            <td class="like">
              <p>♥</p>
            </td>
            @endif
          </tr>


          <!-- 時間 -->
          <tr>
            <td>{{ $data['created_at']->format('Y/m/d') }}</td>
            <td></td>
          </tr>
        </table>
        @endforeach
      </div>
    </div>


    <!-- ─── フッター ──────────────────────── -->
    <div class="footer">
      @include('figures/include.footer')
    </div>

  </body>
</html>
