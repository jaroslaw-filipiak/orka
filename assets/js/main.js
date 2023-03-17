$(function () {
  var wh = $(window).height(),
    ww = $(window).width(),
    scrolled = $(window).scrollTop(),
    lastScrollTop = 0,
    rtime,
    timeout = false,
    delta = 200,
    page = 2,
    loading = false;

  function run() {
    // lazyLoad();
    //hamburger();
    // animate();
    // videoPlayer();
    scrollEvents();
  }
  run();

  $('[data-id]').each(function () {
    var vimeoID = $(this).attr('data-id');
    //console.log(vimeoID);
    $.getJSON(
      'http://www.vimeo.com/api/v2/video/' + vimeoID + '.json?callback=?',
      { format: 'json' },
      function (data) {
        console.log(data[0].thumbnail_large);
      }
    );
  });

  /* Resize events */
  $(window).resize(function (e) {
    wh = $(window).height();
    scrolled = $(window).scrollTop();
    rtime = new Date();
    if (timeout === false) {
      timeout = true;
      setTimeout(resizeend, delta);
    }
    $('body').addClass('resizing');
  });

  /* Scroll events */
  $(window).scroll(function (e) {
    wh = $(window).height();
    scrolled = $(window).scrollTop();
    $('body').addClass('scrolled');
    scrollEvents();
  });

  function scrollEvents() {
    if (scrolled > 0) {
      $('body').removeClass('top');
    } else {
      $('body').addClass('top');
    }

    if (scrolled > lastScrollTop) {
      $('body').removeClass('scrolled-up');
    } else {
      $('body').addClass('scrolled-up');
    }
    lastScrollTop = scrolled <= 0 ? 0 : scrolled;

    if (scrolled > 100) {
      $('body').addClass('scrolled');
    } else {
      $('body').removeClass('scrolled');
    }
    if ($('.portfolio').length) {
      var headerH = $('header').height();
      var offsetTop = $('.page_content .container').offset().top;
      if (scrolled >= offsetTop - headerH) {
        $('.portfolio').addClass('sticky');
      } else {
        $('.portfolio').removeClass('sticky');
      }
    }
  }

  function resizeend() {
    if (new Date() - rtime < delta) {
      setTimeout(resizeend, delta);
    } else {
      timeout = false;
      $('body').removeClass('resizing');
    }
  }

  function cookies() {
    var cookieValue = Cookies.get('cookie');
    $('.gdpr-button-accept').click(function (e) {
      e.preventDefault();
      $('#gdpr-box').fadeOut();
      Cookies.set('cookie', 'accepted', { expires: 60 });
    });
    if (cookieValue != 'accepted') {
      $('#gdpr-box').show(0);
    } else {
      $('#gdpr-box').hide(0);
    }
  }
});
