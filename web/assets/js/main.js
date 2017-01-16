(function($) {
  "use strict";

  var $body = $('html, body');

	var blogIsotope = function() {
    var imgLoad = imagesLoaded($('.blog-masonry'));

    imgLoad.on('done', function(){
      $('.blog-masonry').isotope({
        "itemSelector": ".post-masonry",
      });
     });
   
   imgLoad.on('fail', function(){
      $('.blog-masonry').isotope({
        "itemSelector": ".post-masonry",
      });
   });  
     
  };
  blogIsotope();
             
  

  if ($('.back-to-top').length) {
    var scrollTrigger = 100, // px
    backToTop = function () {
      var scrollTop = $(window).scrollTop();
      if (scrollTop > scrollTrigger) {
        $('.back-to-top').addClass('show');
      } else {
        $('.back-to-top').removeClass('show');
      }
    };
    
    $(window).on('scroll', function () {
        backToTop();
    });
    $('.back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
          scrollTop: 0
        }, 700);
    });
  }



  var initSuperFish = function() {
    
    $(".sf-menu").superfish({
      delay: 400,
      animation: {opacity:'show', height:'show'},
      speed: 'fast',
      autoArrows: true,
      speedOut: 'fast',
      disableHI: true
    });
    
    // Replace SuperFish CSS Arrows to Font Awesome Icons
    $('.main-nav > ul.sf-menu > li').each(function(){
      $(this).find('.sf-with-ul').append('<i class="fa fa-angle-down"></i>');
    });
  }
  
  initSuperFish();



  // Filter Projects
  var projectsFilter = function() {
    var filter = $('.projects-filter'),
      portfolioGrid = $('.projects-grid');

    portfolioGrid.imagesLoaded(function(){
        portfolioGrid.isotope({
          itemSelector: '.project-item',
          layoutMode: 'masonry',
          masonry: { 
            columnWidth: '.project-item',
            //isFitWidth: true
          }
      });
    });

    var filterFns = {
        // show if number is greater than 50
        numberGreaterThan50: function() {
          var number = $(this).find('.number').text();
          return parseInt( number, 10 ) > 50;
        },
        // show if name ends with -ium
        ium: function() {
          var name = $(this).find('.name').text();
          return name.match( /ium$/ );
        }
    };

    filter.on('click', 'a', function() {
      var filterValue = $( this ).attr('data-filter');
      // use filterFn if matches value
      filterValue = filterFns[ filterValue ] || filterValue;
      portfolioGrid.isotope({ filter: filterValue });
      return false;
    });

    filter.each( function( i, buttonGroup ) {
      var $buttonGroup = $( buttonGroup );
      $buttonGroup.on('click', 'a', function() {
          $buttonGroup.find('.active').removeClass('active');
          $( this ).addClass('active');
      });
    });

  }

  projectsFilter();


  var owlSlider = function() {

    var sliders = $('.owl-slider');
    if (sliders.length) {
      sliders.each(function(){
        var slider = $(this);
        slider.owlCarousel({
          singleItem:true,
          loop: true,
          autoplay: false,
          autoHeight: true,
          pagination: false,
          navigation : true,
          navigationText: [
            '<span class="prev-icon"><i class="fa fa-angle-left"></i></span>',
            '<span class="next-icon"><i class="fa fa-angle-right"></i></span>'
          ]
        });
      });
    }
  }

  owlSlider();

  $('.lightbox').nivoLightbox({
    keyboardNav: true,
  }); 

  $(".video-content").fitVids();

  $('textarea').autogrow(); 

  new WOW().init();

  $(".animsition").animsition({
    inClass               :   'fade-in',
    outClass              :   'fade-out',
    inDuration            :    800,
    outDuration           :    500,
    // linkElement           :   '.animsition-link',
    // linkElement           :   'a:not([target="_blank"]):not([href^=#]):not([data-rel*="lightcase"]):not([class*="no-redirect"])',
    loading               :    true,
    loadingParentElement  :   'body', //animsition wrapper element
    loadingClass          :   'animsition-loading',
    unSupportCss          : [ 'animation-duration',
                  '-webkit-animation-duration',
                  '-o-animation-duration'
                ],
    overlay               :   false,
    overlayClass          :   'animsition-overlay-slide',
    overlayParentElement  :   'body'
  });



  var mobileHeader = function() {
    var navigationToggle = $('.mobile-header .mobile-menu-toggle'),
      navToggleLink = navigationToggle.find('a'),
      mobileNav = $('.mobile-header .mobile-navigation'),
      dropToggle = $(".mobile-navigation .expander, .mobile-navigation a[href*='#']"),
      animTime = 200;


    var $nav = $('.mobile-navigation'),
      $button = $('#toggle-nav');

    $button.on('click', function (e) {
      var isActivating = !$nav.hasClass('active');

      $(this).toggleClass('active', isActivating);

      $nav.toggleClass('active').fadeToggle(300, function () {
          $nav.scrollTop(0);
      });

      $body.trigger(isActivating ? 'lock' : 'unlock');
    });

    if(dropToggle.length) {
      dropToggle.each(function() {
        $(this).on('tap click', function(e) {
          var dropToggleOpen = $(this).nextAll('ul').first();

          if(dropToggleOpen.length) {
            e.preventDefault();

            var dropParent = $(this).parent('li');

            if(dropToggleOpen.is(':visible')) {
              dropToggleOpen.slideUp(animTime);
              dropParent.removeClass('dropdown-open');
            } else {
              dropToggleOpen.slideDown(animTime);
              dropParent.addClass('dropdown-open');
            }

          }

        });
      });
    }

  }

  mobileHeader();



  // Mobile Header Scroller
  var mobileNavScroller = function() {
    var mobileMenuWrapper = $('.mobile-nav-content');
    if(mobileMenuWrapper.length){    
      mobileMenuWrapper.niceScroll({ 
        scrollspeed: 60,
        mousescrollstep: 40,
        cursorwidth: 0, 
        cursorborder: 0,
        cursorborderradius: 0,
        cursorcolor: "#eee",
        autohidemode: false, 
        horizrailenabled: false 
      });
    }
  }

  mobileNavScroller();




})(jQuery);
