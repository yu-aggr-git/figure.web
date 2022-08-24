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

      <!-- ─── 新規 ──────────────────────── -->
      <form action="" method="post">
        @csrf
        <h3>新規登録</h3>

        <table class="new">
          <tr>
            <th rowspan="2"></th>

            <!-- タイトル -->
            <td colspan="3" class="titleEdit" >
              <input type="text" name="title" value="@if(session()->has('newInfo')){{ session()->get('newInfo.title') }}@endif">
            </td>

            <!-- ステータス -->
            <td class="statusEdit">
              <label><input type="radio" name="status" value="0">公開</label>
              <label><input type="radio" name="status" value="1">非公開</label>
            </td>

            <!-- 編集 -->
            <td class="editEdit">
              <button type="submit" name="new_info">登録</button>
            </td>
          </tr>

          <!-- 内容 -->
          <tr>
            <td colspan="5">
              <textarea name="body">@if(session()->has('newInfo')){{ session()->get('newInfo.body') }}@endif</textarea>
            </td>
          </tr>
        </table>
      </form>

      <!-- エラー -->
      <table>
        <span>
          @if(isset($errors))
           @foreach ($errors->all() as $error)
           <p>※{{ $error }}</p>
           @endforeach
          @endif
        </span>
      </table>

      <!-- ─── 編集 ──────────────────────── -->
        <h3>編集</h3>

        @foreach ($allInfo as $data)
        <form action="" method="post">
          @csrf
          <table>
            <!-- ID -->
            <input type="hidden" name="id" value="{{ $data['id'] }}">

            <tr>
              <th rowspan="2">{{ $data['created_at'] }}</th>
              <td colspan="2" class="titleEdit">
                <input type="text" name="title" value="@if(isset($data['title'])){{ $data['title'] }}@endif">
              </td>

              <td class="statusEdit">
                <label><input type="radio" name="status" value="0">公開</label>
                <label><input type="radio" name="status" value="1">非公開</label>
              </td>

              <!-- 編集 -->
              <td class="editEdit">
                <button type="submit" name="edit_info">編集</button>
              </td>
            </tr>

            <tr>
              <td colspan="4">
                <textarea name="body">@if(isset($data['body'])){{ $data['body'] }}@endif</textarea>
              </td>
            </tr>
          </table>
        </form>
        @endforeach


      <!-- 戻る -->
      <div class="back">
        <a href="{{ route('info') }}">戻る</a>
      </div>
    </div>

    <!-- ─── フッター ──────────────────────── -->
    <div class="footer">
      @include('figures/include.footer')
    </div>

  </body>
</html>
