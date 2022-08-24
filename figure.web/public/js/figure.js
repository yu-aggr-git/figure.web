$(function() {

  // ─── ハンバーガーメニュー ────────────────────────
  $(".hamburger").on('click', function(){
    $(".header .menu").toggleClass("open");
  });

  $(".hamburger").on('click', function(){
    $("body").toggleClass("fixed");
  });

  $(".hamburger").on('click', function(){
    $(".on").toggle();
    $(".off").toggle();
  });


  // ─── ジャンプトップ ────────────────────────
  $(window).on("load scroll", function() {

    var box = $("#jump");
    var scrollPos = $(window).scrollTop();

    box.each(function() {
      if (scrollPos >= 300) {
        $('.top').addClass("top-anime");
        $('.line').addClass("line-anime");
      } else {
        $('.top').removeClass("top-anime");
        $('.line').removeClass("line-anime");
      }
    });
  });

  $("#jump").on("click", function() {
    $("body,html").animate({
      scrollTop: 0
    }, "slow");
  });


  // ─── お気に入り（投稿） ────────────────────────
  $('.likePost').on('click', function (){
    var postId = $(this).data('post-id');
    var count = $('.likeCounter').data('count');

    //通信
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: '/like',
      method: 'POST',
      data: { 'post_id': postId },
    })

    //ajax処理スタート
    .done(function (data) {
      $('#likeId' + postId).toggleClass('liked');

      // いいね済み
      if ($('#likeId' + postId).hasClass('liked')) {
        if ($('.likeCounter').text() == count) {
          $('.likeCounter').text(count + 1);
        }
        else {
          $('.likeCounter').text(count);
        }
      }

      // いいね未だ
      else {
        if ($('.likeCounter').text() == count) {
          $('.likeCounter').text(count - 1);
        }
        else {
          $('.likeCounter').text(count);
        }
      }

      // 419なのでリダイレクト
      if(xhr.status == 419) {
        location.href = location.href;
      }

    })

    //通信失敗した時の処理
    .fail(function () {
      console.log('fail');

      // 419なのでリダイレクト
        if(xhr.status == 419) {
            location.href = location.href;
        }
    });
  });


  // ─── お気に入り（カレンダー） ────────────────────────
  $('.likeCalendar').on('click', function (){
    var calendarId = $(this).data('calendar-id');

    //通信
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: '/likecalendar',
      method: 'POST',
      data: { 'postcalendar_id': calendarId },
    })

    //ajax処理スタート
    .done(function (data) {
      $('#likeCalendarId' + calendarId).toggleClass('liked');

      // 419なのでリダイレクト
      if(xhr.status == 419) {
        location.href = location.href;
      }

    })

    //通信失敗した時の処理
    .fail(function () {
      console.log('fail');

      // 419なのでリダイレクト
        if(xhr.status == 419) {
            location.href = location.href;
        }
    });
  });


});
