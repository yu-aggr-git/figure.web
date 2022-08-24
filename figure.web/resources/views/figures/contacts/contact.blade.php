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
    <div class="contact_view wrap main">

      <h2>Contact</h2>

      @foreach ($allContact as $data)
      <form action="" method="post">
        @csrf
        <dl class="ctr">

          <!-- ID -->
          <input type="hidden" name="id" value="{{ $data['id'] }}">

          <!-- 日時 -->
          <div class="user">
            <dd>
              <h3>日時</h3>
              <p>{{ $data['created_at'] }}</p>
            </dd>
          </div>

          <!-- 氏名 -->
          <div class="name">
            <dd>
              <h3>氏名</h3>
              <p>{{ $data['name'] }}</p>
            </dd>
          </div>

          <!-- ユーザー名 -->
          <div class="user">
            <dd>
              <h3>ユーザー名</h3>
              <p>{{ $data['user_name'] }}</p>
            </dd>
          </div>

          <!-- メールアドレス -->
          <div class="email">
            <dd>
              <h3>アドレス</h3>
              <p>{{ $data['email'] }}</p>
            </dd>
          </div>

          <!-- 内容 -->
          <div class="body">
            <dd>
              <h3>内容</h3>
              <p>{{ $data['body'] }}</p>
            </dd>
          </div>

          <!-- 削除 -->
          <div class="submit">
            <dd>
              <!-- <select name= "">
                <option value = "未対応">未対応</option>
                <option value = "対応中">対応中</option>
                <option value = "対応済">対応済</option>
              </select> -->

              <button type="submit" name="delete_contact" onclick="return confirm('本当に削除しますか？')">削除</button>
            </dd>
          </div>
        </dl>
      </form>
      @endforeach

      <!-- 戻る -->
      <div class="back">
        <a href="{{ route('user') }}">戻る</a>
      </div>


    </div>

    <!-- ─── フッター ──────────────────────── -->
    <div class="footer">
      @include('figures/include.footer')
    </div>

  </body>
</html>
