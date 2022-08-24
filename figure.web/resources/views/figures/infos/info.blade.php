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

    <!-- ─── お知らせ ──────────────────────── -->
    <div class="infos wrap main">

      <h2>Information</h2>

      <!-- ─── 管理者用 ──────────────────────── -->
      @if(isset($session['role']) && $session['role'] == '0')
      <div class="submit">
        <form action="" method="post">
          @csrf
          <button type="submit" name="editInfo">新規登録 / 編集</button>
        </form>
      </div>
      @endif

      <!-- ─── 一覧 ──────────────────────── -->
      @foreach ($allInfo as $data)
      <form action="" method="post">
        @csrf

        <!-- 非公開 -->
        @if($data['status'] == 1)
          @if(isset($session['role']) && $session['role'] == '0')
          <table>
            <tr>
              <th rowspan="2">{{ $data['created_at'] }}</th>
              <td colspan="2" class="title">{{ $data['title'] }}</td>

              @if(isset($session['role']) && $session['role'] == '0')
              <td>
                @if($data['status'] == 0)
                  公開
                @elseif($data['status'] == 1)
                  非公開
                @endif
              </td>
              <td>
                <input type="hidden" name="id" value="{{ $data['id'] }}">
                <button type="submit" name="deleteInfo" onclick="return confirm('本当に削除しますか？')">削　除</button>
              </td>
              @endif

            </tr>
            <tr>
              <td>{{ $data['body'] }}</td>
            </tr>
          </table>
          @endif

        <!-- 公開 -->
        @else
        <table>
          <tr>
            <th rowspan="2">{{ $data['created_at'] }}</th>
            <td colspan="2" class="title">{{ $data['title'] }}</td>

            @if(isset($session['role']) && $session['role'] == '0')
            <td>
              @if($data['status'] == 0)
                公開
              @elseif($data['status'] == 1)
                非公開
              @endif
            </td>
            <td>
              <input type="hidden" name="id" value="{{ $data['id'] }}">
              <button type="submit" name="deleteInfo" onclick="return confirm('本当に削除しますか？')">削　除</button>
            </td>
            @endif

          </tr>
          <tr>
            <td>{{ $data['body'] }}</td>
          </tr>
        </table>
        @endif
      </form>
      @endforeach

      <!-- 戻る -->
      <div class="back">
        <a href="{{ route('main') }}">戻る</a>
      </div>
    </div>

    <!-- ─── フッター ──────────────────────── -->
    <div class="footer">
      @include('figures/include.footer')
    </div>

  </body>
</html>
