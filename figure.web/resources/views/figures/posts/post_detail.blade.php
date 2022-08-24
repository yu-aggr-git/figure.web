<!DOCTYPE html>
<html lang="jp">
  <head>
    @include('figures/include.head')
  </head>

  <body>

    <!-- ─── 背景 ──────────────────────── -->
    <div class="back_img">
      <img src="{{ asset('storage/post/'.$findIdPost['thumbnail']) }}">
    </div>

    <!-- ─── ヘッダー ──────────────────────── -->
    <div class="header">
      @include('figures/include.header')
    </div>


    <!-- ─── 投稿詳細 ──────────────────────── -->
    <div class="post_detail wrap main">

      <h2>Detail</h2>

      <dl class="ctr">
        <!-- トップイメージ -->
        <dd>
          <img src="{{ asset('storage/post/'.$findIdPost['thumbnail']) }}" alt="">
        </dd>

        <!-- ステータス -->
        <div class="status">
          <form action="" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ $findIdPost['user_id'] }}">
            <dd class="user">
              <button type="submit" name="sub_user">
                {{ $findIdPost['user_name'] }}
              </button>
            </dd>
          </form>

          <div class="ctr">

            <!-- 公開 -->
            @if(isset($session['id']) && $session['id'] == $findIdPost['user_id'])
            <dd>
              @if($findIdPost['status'] == 0)
               公開
              @elseif($findIdPost['status'] == 1)
               非公開
              @endif
            </dd>
            @endif

            <!-- 日時 -->
            <dd class="data">
              {{ $findIdPost['created_at']->format('Y/m/d') }}
            </dd>

            <!-- お気に入り -->
            @if(session()->has('input'))
            <dd class="likePost" data-post-id="{{ $findIdPost['id'] }}">
              @if(empty($liked))
                <p id="likeId{{ $findIdPost['id'] }}">♥</p>
              @else
                <p id="likeId{{ $findIdPost['id'] }}" class="liked">♥</p>
              @endif
            </dd>
            @else
            <dd class="like">
              <p>♥</p>
            </dd>
            @endif


            <!-- 件数 -->
            <dd  class="likeCounter" data-count="{{ $count }}">
              <p>
                {{ $count }}
              </p>
            </dd>
          </div>
        </div>

        <!-- 説明文 -->
        <div class="comment">
          <dt>comment</dt>
          <dd>
            {{ $findIdPost['comment'] }}
          </dd>
        </div>

        <!-- タグ -->
        <div class="tag">
          <dt>tag</dt>
          <dd>
            {{ $findIdPost['tag1'] }}
            {{ $findIdPost['tag2'] }}
            {{ $findIdPost['tag3'] }}
            {{ $findIdPost['tag4'] }}
            {{ $findIdPost['tag5'] }}
          </dd>
        </div>

        <!-- エディット -->
        @if(isset($session['id']) && $session['id'] == $findIdPost['user_id'])
        <form action="" method="post">
          @csrf
          <div class="edit">
            <dd><button type="submit" name="editPost">編集</button></dd>
            <dd><button type="submit" name="deletePost" onclick="return confirm('本当に削除しますか？')">削除</button></dd>
          </div>
        </form>
        @endif

        <!-- イメージ -->
        @if(!empty($findIdPost['image1']))
        <dd>
          <img src="{{ asset('storage/post/'.$findIdPost['image1']) }}" alt="">
        </dd>
        @endif
        @if(!empty($findIdPost['image2']))
        <dd>
          <img src="{{ asset('storage/post/'.$findIdPost['image2']) }}" alt="">
        </dd>
        @endif
        @if(!empty($findIdPost['image3']))
        <dd>
          <img src="{{ asset('storage/post/'.$findIdPost['image3']) }}" alt="">
        </dd>
        @endif
      </dl>

      <!-- 戻る -->
      <div class="back">
        <a href="{{ route('post') }}">ポスト一覧へ</a>
      </div>

      <form action="" method="post">
        @csrf
        <div class="back">
          <input type="hidden" name="user_id" value="{{ $findIdPost['user_id'] }}">
          <button type="submit" name="sub_user">ユーザーページへ</button>
        </div>
      </form>
    </div>


    <!-- ─── フッター ──────────────────────── -->
    <div class="footer">
      @include('figures/include.footer')
    </div>

  </body>
</html>
