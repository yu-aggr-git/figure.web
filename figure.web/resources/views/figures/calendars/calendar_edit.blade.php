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
               @elseif(isset($findCalendar['thumbnail']))
                <img src="{{ asset('storage/calendar/'.$findCalendar['thumbnail']) }}" alt="">
              @endif
            <dd>
              <p>Thumbnail：</p>
              <input type="file" name="thumbnail">
              <button type="submit" name="edit_thumbnail">送信</button>
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
            <input type="hidden" name="thumbnail" value="@if(session()->has('thumbnail')){{ session()->get('thumbnail') }}@elseif(isset($findCalendar['thumbnail'])){{ $findCalendar['thumbnail'] }}@endif">
          </div>


          <!-- リンク -->
          <div class="link">
            <dd>
              <p>Link：</p>
              <input type="text" name="link" value="@if(old('link')){{ old('link') }}@elseif(isset($findCalendar['link'])){{ $findCalendar['link'] }}@endif">
            </dd>
          </div>


          <!-- メーカー -->
          <div class="company">
            <dd>
              <p>Company：</p>
              <input type="text" name="maker" value="@if(old('maker')){{ old('maker') }}@elseif(isset($findCalendar['maker'])){{ $findCalendar['maker'] }}@endif">
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
              <input type="text" name="brand" value="@if(old('brand')){{ old('brand') }}@elseif(isset($findCalendar['brand'])){{ $findCalendar['brand'] }}@endif">
            </dd>
          </div>


          <!-- 商品名 -->
          <div class="nmae">
            <dd>
              <p>Nmae：</p>
              <input type="text" name="item" value="@if(old('item')){{ old('item') }}@elseif(isset($findCalendar['item'])){{ $findCalendar['item'] }}@endif">
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
              <input type="text" name="series" value="@if(old('series')){{ old('series') }}@elseif(isset($findCalendar['series'])){{ $findCalendar['series'] }}@endif">
            </dd>
          </div>


          <!-- 発売月 -->
          <div class="releaseMonth">
            <dd>
              <p>Month</p>
              <input type="text" name="releaseMonth" value="@if(old('releaseMonth')){{ old('releaseMonth') }}@elseif(isset($findCalendar['releaseMonth'])){{ $findCalendar['releaseMonth'] }}@endif">
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
              <p>Date</p>
              <input type="text" name="releaseDate" value="@if(old('releaseDate')){{ old('releaseDate') }}@elseif(isset($findCalendar['releaseDate'])){{ $findCalendar['releaseDate'] }}@endif">
            </dd>
          </div>


          <!-- 編集 -->
          <div class="submit">
            <button type="submit" name="edit_Calendar">登　録</button>
          </div>


          <!-- 戻る -->
          <div class="back">
            <a href="{{ route('calendarDetail', $findCalendar['id']) }}">戻る</a>
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
