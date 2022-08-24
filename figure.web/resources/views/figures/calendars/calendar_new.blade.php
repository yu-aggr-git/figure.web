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

      <h2>Calendar New</h2>

      <dl class="calendar_new">

        <!-- サムネイル -->
        <form action="" method="post" enctype="multipart/form-data">
          @csrf
          <div class="thumbnail">
              @if(session()->has("thumbnail"))
               <img src="{{ asset('storage/calendar/'.session()->get('thumbnail')) }}" alt="">
              @endif
            <dd>
              <p>Thumbnail：</p>
              <input type="file" name="thumbnail">
              <button type="submit" name="up_thumbnail">送信</button>
            </dd>
            <span>
              @if($errors->has('thumbnail'))
               <p>※{{ $errors->first('thumbnail') }}</p>
              @endif
            </span>
          </div>
        </form>


        <form action="" method="post">
          @csrf
          <!-- 引き継ぎ -->
          <div class="hidden_data">
            <!-- サムネイル -->
            <input type="hidden" name="thumbnail" value="@if(session()->has('thumbnail')){{ session()->get('thumbnail') }}@endif">
          </div>


          <!-- リンク -->
          <div class="link">
            <dd>
              <p>Link：</p>
              <input type="text" name="link" value="{{ old('link') }}">
            </dd>
          </div>


          <!-- メーカー -->
          <div class="company">
            <dd>
              <p>Company：</p>
              <input type="text" name="maker" value="{{ old('maker') }}">
            </dd>
            <span>
              @if($errors->has('maker'))
               <p>※{{ $errors->first('maker') }}</p>
              @endif
            </span>
          </div>


          <!-- ブランド -->
          <div class="brand">
            <dd>
              <p>Brand：</p>
              <input type="text" name="brand" value="{{ old('brand') }}">
            </dd>
          </div>


          <!-- 商品名 -->
          <div class="nmae">
            <dd>
              <p>Nmae：</p>
              <input type="text" name="item" value="{{ old('item') }}">
            </dd>
            <span>
              @if($errors->has('item'))
               <p>※{{ $errors->first('item') }}</p>
              @endif
            </span>
          </div>


          <!-- 作品名 -->
          <div class="series">
            <dd>
              <p>Series：</p>
              <input type="text" name="series" value="{{ old('series') }}">
            </dd>
          </div>


          <!-- 発売月 -->
          <div class="releaseMonth">
            <dd>
              <p>Month：</p>
              <input type="text" name="releaseMonth" value="{{ old('releaseMonth') }}">
            </dd>
            <span>
              @if($errors->has('releaseMonth'))
               <p>※{{ $errors->first('releaseMonth') }}</p>
              @endif
            </span>
          </div>


          <!-- 発売日 -->
          <div class="releaseDate">
            <dd>
              <p>Date：</p>
              <input type="text" name="releaseDate" value="{{ old('releaseDate') }}">
            </dd>
          </div>


          <!-- 編集 -->
          <div class="submit">
            <button type="submit" name="new_Calendar">登　録</button>
          </div>


          <!-- 戻る -->
          <div class="back">
            <a href="{{ route('user') }}">戻る</a>
          </div>
        </form>

      </dl>
    </div>


    <!-- ─── フッター ──────────────────────── -->
    <div class="footer">
      @include('figures/include.footer')
    </div>

  </body>
</html>
