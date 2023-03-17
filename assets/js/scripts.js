window.addEventListener('DOMContentLoaded', () => {
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
      lazyLoad();
      //hamburger();
      animate();
      videoPlayer();
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

    /*** AJAX ***/
    window.history.replaceState({ path: window.location.href }, '');

    window.addEventListener('popstate', function (e) {
      if (e.state) pageLoad(location.href);
    });

    $(document).on('click', '.rsArrow', function () {
      $('body').addClass('scrolled');
    });

    $(document).on('click', '.menu a,.link,.logo', function (e) {
      e.preventDefault();
      if (!$(this).parent('.menu-item-has-children').length) {
        var targetUrl = $(this).attr('href');
        pageLoad(e, targetUrl);
        window.history.pushState({ path: targetUrl }, '', targetUrl);
        return false;
      }
    });

    function pageLoad(e, href) {
      var targetUrl = href;
      $.ajax({
        type: 'POST',
        url: targetUrl,
        cache: true,
        dataType: 'html',
        beforeSend: function () {
          $('html').removeClass('modal-open');
          $('.lightbox').removeClass('active');
          $('body').addClass('loading').removeClass('scrolled menu-open');
          $('.hamburger').removeClass('is-active');
          $('.menu_holder').stop().slideUp(500);

          const selectedActiveLink =
            document.querySelector('.current-menu-item');

          if (selectedActiveLink) {
            selectedActiveLink.classList.remove('current_page_item');
            selectedActiveLink.classList.remove('current-menu-item');
          }
        },
        success: function (data) {
          var docTitle = $(data).filter('title').text();
          $('title').text(docTitle);
          $('body,html').animate({ scrollTop: 0 }, 0);
          var mainClasses = $(data).find('#content').attr('class');
          $('#content').attr('class', '');
          if (mainClasses != undefined) {
            $('#content').attr('class', mainClasses);
          }
          $('header h1').replaceWith($(data).find('header h1'));
          $('main').replaceWith($(data).find('main'));

          const clicked = e.target.parentNode;
          clicked.classList.add('current_page_item');
          clicked.classList.add('current-menu-item');
        },
        complete: function (data) {
          page = 2;
          $('body').removeClass('loading');
          run();
        },
      });
    }

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
      animate();
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

    function lazyLoad() {
      window.ll = new LazyLoad({
        elements_selector: '.lazy',
        threshold: 300,
        load_delay: 0,
        callback_loaded: function (el) {},
      });
    }

    function hamburger() {
      $('.menu-trigger').click(function () {
        $('body').toggleClass('menu-open');
        $(this).toggleClass('is-active');
        if ($(this).hasClass('is-active')) {
          $('.menu_holder').stop().slideDown(500);
        } else {
          $('.menu_holder').stop().slideUp(500);
        }
      });
    }

    function animate() {
      if ($('.animate').length) {
        $('.animate').each(function () {
          if (!$(this).hasClass('animated')) {
            var $this = $(this);
            var thisOffset = $this.offset().top;
            if (scrolled > thisOffset - wh + 75) {
              $this.addClass('animated');
            }
          }
        });
      }
    }

    function videoPlayer() {
      $('.video').click(function () {
        var $this = $(this);
        $this.addClass('loaded');
        var iframe = $this.find('iframe');
        var player = new Vimeo.Player(iframe);
        player.play();
        player.on('play', function () {
          $this.addClass('active');
        });
      });
    }

    /* Load posts */
    $(window).scroll(function () {
      if ($('.infinite_scroll').length) {
        var $container = $('.infinite_scroll');
        var container_offset = $container.offset();
        if (!loading) {
          if (!$('.no_more_load').length) {
            if (
              $(window).scrollTop() + $(window).height() >
              $container.scrollTop() +
                $container.height() +
                container_offset.top -
                60
            ) {
              loading = true;
              postsLoad();
              page++;
            }
          } else {
            //page=3;
          }
        }
      }
    });

    var postsLoad = function () {
      loading = true;
      var catVals = [];
      var lang = $('#orka').attr('data-lang');
      $('.projects_container').addClass('loading');
      if ($('.cat.active').length) {
        $('.cat.active').each(function () {
          catVal = $(this).children().attr('data-cat');
          catVals.push(catVal);
        });
      }
      $.ajax({
        type: 'GET',
        data: { pageNumber: page, catID: catVals, language: lang },
        dataType: 'html',
        cache: true,
        url: templateUrl + '/postsLoad.php',
        success: function (data) {
          $data = $(data);
          if ($data.length) {
            $data.css({ opacity: 0 });
            $('.infinite_scroll .project_asset').last().after($data);
          }
        },
        complete: function () {
          lazyLoad();
          $('.projects_container').removeClass('loading');
          $data.animate({ opacity: 1 }, 500, function () {
            loading = false;
            animate();
          });
        },
      });
    };

    $(document).on('click', '.cat:not(.clear_filters) a', function (e) {
      e.preventDefault();
      if (!loading) {
        page = 2;
        if ($(this).parent().hasClass('active')) {
          $(this).parent().removeClass('active');
          if (!$('.cat').hasClass('active')) {
            $('.clear_filters').addClass('active');
          }
        } else {
          $(this).parent().addClass('active');
          $('.clear_filters').removeClass('active');
        }
        filter();
      }
    });

    $(document).on('click', '.clear_filters', function (e) {
      e.preventDefault();
      if (!loading) {
        page = 2;
        $('.cat').removeClass('active');
        $('.clear_filters').addClass('active');
        filter();
      }
    });

    function filter() {
      if (!loading) {
        loading = true;
        $('.projects').addClass('loading');
        var lang = $('#orka').attr('data-lang');
        var catVals = [];
        if ($('.cat.active').length) {
          $('.cat.active').each(function () {
            catVal = $(this).children().attr('data-cat');
            catVals.push(catVal);
          });
        }
        $.ajax({
          type: 'GET',
          data: { catID: catVals, language: lang },
          url: templateUrl + '/postsFilter.php',
          cache: true,
          dataType: 'html',
          success: function (data) {
            var $data = $(data);
            if ($data.length) {
              $('.projects').replaceWith($data);
            }
          },
          complete: function () {
            loading = false;
            $('body,html').animate({ scrollTop: 0 }, 400);
            $('.projects').removeClass('loading');
            lazyLoad();
            animate();
          },
        });
      }
    }
  });
});
