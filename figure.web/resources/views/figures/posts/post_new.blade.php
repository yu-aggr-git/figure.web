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
    <div class="post_new wrap main">

      <h2>Post New</h2>

      <dl class="ctr">

        <!-- サムネイル -->
        <form action="" method="post" enctype="multipart/form-data">
          @csrf
          <div class="thumbnail">
            <dt>Thumbnail</dt>
            <dd>
              @if(session()->has("thumbnail"))
               <img src="{{ asset('storage/post/'.session()->get('thumbnail')) }}" alt="">
              @endif
            </dd>
            <dd>
              <input type="file" name="thumbnail">
            </dd>
            <dd>
              <button type="submit" name="up_thumbnail">送信</button>
            </dd>
            <span>
              @if($errors->has('thumbnail'))
               <p>※{{ $errors->first('thumbnail') }}</p>
              @endif
            </span>
          </div>
        </form>


        <!-- イメージ -->
        <form action="" method="post" enctype="multipart/form-data">
          @csrf
          <div class="images">
            <dt>Images</dt>

            <dd>
              @if(session()->has("image1"))
               <img src="{{ asset('storage/post/'.session()->get('image1')) }}" alt="">
              @endif
            </dd>
            <dd>
              <input type="file" name="image1">
            </dd>

            <dd>
              @if(session()->has("image2"))
               <img src="{{ asset('storage/post/'.session()->get('image2')) }}" alt="">
              @endif
            </dd>
            <dd>
              <input type="file" name="image2">
            </dd>

            <dd>
              @if(session()->has("image3"))
               <img src="{{ asset('storage/post/'.session()->get('image3')) }}" alt="">
              @endif
            </dd>
            <dd>
              <input type="file" name="image3">
            </dd>
            <dd>
              <button type="submit" name="up_images">送信</button>
            </dd>
          </div>
        </form>


        <form action="" method="post">
          @csrf
          <!-- 引き継ぎ -->
          <div class="hidden_data">
            <!-- ユーザーID -->
            <input type="hidden" name="user_id" value="@if(isset($session['id'])){{ $session['id']; }}@endif">

            <!-- サムネイル -->
            <input type="hidden" name="thumbnail" value="@if(session()->has('thumbnail')){{ session()->get('thumbnail') }}@endif">

            <!-- イメージ 1-->
            <input type="hidden" name="image1" value="@if(session()->has('image1')){{ session()->get('image1') }}@endif">

            <!-- イメージ 2-->
            <input type="hidden" name="image2" value="@if(session()->has('image2')){{ session()->get('image2') }}@endif">

            <!-- イメージ 3-->
            <input type="hidden" name="image3" value="@if(session()->has('image3')){{ session()->get('image3') }}@endif">
          </div>

          <!-- 説明文 -->
          <div class="comment">
            <dt>Comment</dt>
            <dd>
              <textarea name="comment">{{ old('comment') }}</textarea>
            </dd>
          </div>

          <!-- タグ -->
          <div class="tag">
            <dt>Tag</dt>
            <div class="tag_ctr">
              <dd>
                <textarea name="tag1">{{ old('tag1') }}</textarea>
              </dd>
              <dd>
                <textarea name="tag2">{{ old('tag2') }}</textarea>
              </dd>
              <dd>
                <textarea name="tag3">{{ old('tag3') }}</textarea>
              </dd>
              <dd>
                <textarea name="tag4">{{ old('tag4') }}</textarea>
              </dd>
              <dd>
                <textarea name="tag5">{{ old('tag5') }}</textarea>
              </dd>
            </div>
          </div>

          <!-- 公開 -->
          <div class="status">
            <dt>Public / Private</dt>
            <dd>
              <label><input type="radio" name="status" value="0">公開</label>
              <label><input type="radio" name="status" value="1">非公開</label>
            </dd>
            <span>
              @if($errors->has('status'))
               <p>※{{ $errors->first('status') }}</p>
              @endif
            </span>
          </div>

          <!-- 登録 -->
          <div class="newPost">
            <dd>
              <button type="submit" name="newPost">登　録</button>
            </dd>
          </div>

          <!-- 戻る -->
          <div class="back">
            <dd>
              <a href="{{ route('user') }}">戻る</a>
            </dd>
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
