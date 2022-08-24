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
    <div class="user_page wrap main">

      <h2>User Detail</h2>

      <div class="icon">
        @if(isset($findUser['icon']))
          <img src="{{ asset('storage/icon/'.$findUser['icon']) }}" alt="">
        @else
          <img src="{{ asset('img/test.png') }}" alt="">
        @endif
      </div>

      <div class="name">
        @if(isset($findUser['user_name']))
         <p>{{ $findUser['user_name'] }}</p>
        @endif
      </div>

      <div class="comment">
        @if(isset($findUser['comment']))
         <p>{{ $findUser['comment'] }}</p>
        @endif
      </div>

      <table class="data">
        <tr>
          <th>利用開始日</th>
          <td>
            @if(isset($findUser['created_at']))
             {{ $findUser['created_at'] }}
            @endif
          </td>
        </tr>

        <tr>
          <th>投稿数</th>
          <td>
            @if(isset($allUserPosts))
              {{ $allUserPosts }}件
            @else
              0件
            @endif
          </td>
        </tr>
      </table>

      <div class="edit">
        @if(isset($session['id']) && $session['id'] == $findUser['id'])
        <form class="" action="" method="post">
          @csrf
          <input type="hidden" name="id" value="@if(isset($session['id'])){{ $session['id']; }}@endif">
          <button type="submit" name="sub_edit">編集</button>
          <button type="submit" name="delete" onclick="return confirm('本当に削除しますか？')">削除</button>
        </form>
        @endif
      </div>

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
