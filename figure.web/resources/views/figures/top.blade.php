<!DOCTYPE html>
<html lang="jp">
  <head>
    @include('figures/include.head')

    <!-- 5秒後にメインページへ遷移 -->
    <meta http-equiv="refresh" content=" 3; {{ route('main') }}">

  </head>

  <body>

    <div class="top_title">
      <p>figure.web</p>
    </div>

    <div class="top_img">

      <!-- トップイメージをランダムで表示 -->
      <?php
      foreach ($findUserPost as $data){
        $imgs[] = $data['thumbnail'];
      }

      $count = count($imgs);
      $number = rand(0, $count - 1);
      $img = $imgs[$number];
      ?>
      <img src="storage/post/{{ $img }}">
    </div>





  </body>
</html>
