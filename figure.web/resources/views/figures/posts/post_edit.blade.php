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
    <div class="post_new wrap main">

      <h2>Post Edit</h2>

      <dl class="ctr">

        <!-- サムネイル -->
        <form action="" method="post" enctype="multipart/form-data">
          @csrf
          <div class="thumbnail">
            <dt>Thumbnail</dt>
            <dd>
              @if(session()->has("thumbnail"))
               <img src="{{ asset('storage/post/'.session()->get('thumbnail')) }}" alt="">
              @elseif(isset($findIdPost['thumbnail']))
               <img src="{{ asset('storage/post/'.$findIdPost['thumbnail']) }}" alt="">
              @endif
            </dd>
            <dd>
              <input type="file" name="thumbnail">
            </dd>
            <dd>
              <button type="submit" name="edit_thumbnail">送信</button>
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
              @elseif(isset($findIdPost['image1']))
               <img src="{{ asset('storage/post/'.$findIdPost['image1']) }}" alt="">
              @endif
            </dd>
            <dd>
              @if(isset($findIdPost['image1']))
                <input type="submit" name="delete_image1" value="削除">
              @endif
              <input type="file" name="image1">
            </dd>

            <dd>
              @if(session()->has("image2"))
               <img src="{{ asset('storage/post/'.session()->get('image2')) }}" alt="">
              @elseif(isset($findIdPost['image2']))
               <img src="{{ asset('storage/post/'.$findIdPost['image2']) }}" alt="">
              @endif
            </dd>
            <dd>
              @if(isset($findIdPost['image2']))
                <input type="submit" name="delete_image2" value="削除">
              @endif
              <input type="file" name="image2">
            </dd>

            <dd>
              @if(session()->has("image3"))
               <img src="{{ asset('storage/post/'.session()->get('image3')) }}" alt="">
              @elseif(isset($findIdPost['image3']))
               <img src="{{ asset('storage/post/'.$findIdPost['image3']) }}" alt="">
              @endif
            </dd>
            <dd>
              @if(isset($findIdPost['image3']))
                <input type="submit" name="delete_image3" value="削除">
              @endif
              <input type="file" name="image3">
            </dd>
            <dd>
              <button type="submit" name="edit_images">送信</button>
            </dd>
          </div>
        </form>


        <form action="" method="post">
          @csrf
          <!-- 引き継ぎ -->
          <div class="hidden_data">
            <!-- ID -->
            <input type="hidden" name="id" value="@if(isset($findIdPost['id'])){{ $findIdPost['id'] }}@endif">

            <!-- サムネイル -->
            <input type="hidden" name="thumbnail" value="@if(session()->has('thumbnail')){{ session()->get('thumbnail') }}@elseif(isset($findIdPost['thumbnail'])){{ $findIdPost['thumbnail'] }}@endif">

            <!-- イメージ 1-->
            <input type="hidden" name="image1" value="@if(session()->has('image1')){{ session()->get('image1') }}@elseif(isset($findIdPost['image1'])){{ $findIdPost['image1'] }}@endif">

            <!-- イメージ 2-->
            <input type="hidden" name="image2" value="@if(session()->has('image2')){{ session()->get('image2') }}@elseif(isset($findIdPost['image2'])){{ $findIdPost['image2'] }}@endif">

            <!-- イメージ 3-->
            <input type="hidden" name="image3" value="@if(session()->has('image3')){{ session()->get('image3') }}@elseif(isset($findIdPost['image3'])){{ $findIdPost['image3'] }}@endif">
          </div>


          <!-- 説明文 -->
          <div class="comment">
            <dt>Comment</dt>
            <dd>
              <textarea name="comment">@if(old('comment')){{ old('comment') }}@elseif(isset($findIdPost['comment'])){{ $findIdPost['comment'] }}@endif</textarea>
            </dd>
          </div>


          <!-- タグ -->
          <div class="tag">
            <dt>Tag</dt>
            <div class="tag_ctr">
              <dd>
                <textarea name="tag1">@if(old('tag1')){{ old('tag1') }}@elseif(isset($findIdPost['tag1'])){{ $findIdPost['tag1'] }}@endif</textarea>
              </dd>
              <dd>
                <textarea name="tag2">@if(old('tag2')){{ old('tag2') }}@elseif(isset($findIdPost['tag2'])){{ $findIdPost['tag2'] }}@endif</textarea>
              </dd>
              <dd>
                <textarea name="tag3">@if(old('tag3')){{ old('tag3') }}@elseif(isset($findIdPost['tag3'])){{ $findIdPost['tag3'] }}@endif</textarea>
              </dd>
              <dd>
                <textarea name="tag4">@if(old('tag4')){{ old('tag4') }}@elseif(isset($findIdPost['tag4'])){{ $findIdPost['tag4'] }}@endif</textarea>
              </dd>
              <dd>
                <textarea name="tag5">@if(old('tag5')){{ old('tag5') }}@elseif(isset($findIdPost['tag5'])){{ $findIdPost['tag5'] }}@endif</textarea>
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


          <!-- 編集 -->
          <div class="newPost">
            <dd>
              <button type="submit" name="edit_Post">編　集</button>
            </dd>
          </div>


          <!-- 戻る -->
          <div class="back">
            <dd>
              <a href="{{ route('postDetail', $findIdPost['id']) }}">戻る</a>
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
