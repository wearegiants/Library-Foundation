/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {

      //var lwheight = $('#logo-wrapper').height();

      $(window).resize(function() {
        var lwheight = $('#logo-wrapper').height();
        $('#logo-wrapper').css({marginTop:-(lwheight/2)});
      }).resize();

      $('.navbar-nav a').click(function(){
        $('.navbar-nav a').removeClass();
        $(this).addClass('active');
      });

      $('.zoom-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        closeOnContentClick: false,
        closeBtnInside: false,
        mainClass: 'mfp-with-zoom mfp-img-mobile',
        image: {
          verticalFit: true,
          titleSrc: function(item) {
            //return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
          }
        },
        gallery: {
          enabled: true
        },
        zoom: {
          enabled: true,
          duration: 300, // don't foget to change the duration also in CSS
          opener: function(element) {
            return element.find('img');
          }
        }
        
      });
      

      

      

      var si = $('#vase-photos').royalSlider({
        addActiveClass: true,
        arrowsNav: true,
        controlsInside: true,
        // controlNavigation: 'none',
        autoScaleSlider: true, 
        autoScaleSliderWidth: 450,     
        autoScaleSliderHeight: 700,
        loop: true,
        fadeinLoadedSlide: false,
        globalCaption: true,
        keyboardNavEnabled: true,
        globalCaptionInside: false,
        
        autoPlay: {
          enabled: true,
          //pauseOnHover: false,
          delay: 2000,
        },

        
      }).data('royalSlider');

      // link to fifth slide from slider description.
      $('.slide4link').click(function(e) {
        si.goTo(4);
        return false;
      });

      // Random Positions

      var instaTitleHeight = $('#instagram .section_title').height();
      $('#instagram .section_title').css({ marginTop: -(instaTitleHeight/2)});

      // Hover Effects

      $("#instagram").hover(
        function(){
          $('.section-header', this).stop(true,true).velocity({opacity:0});
          $('.section_title', this).stop(true,true).velocity({marginTop:(-(instaTitleHeight/2)+10)});
        },
        function(){
          $('.section-header', this).stop(true,true).velocity({opacity:1});
          $('.section_title', this).stop(true,true).velocity({marginTop:-(instaTitleHeight/2)});
        }
      );

      $(function($) {

        var headerHeight = $('.banner').height();

      var scrollElement = 'html, body';
      $('html, body').each(function () {
      var initScrollTop = $(this).attr('scrollTop');
      $(this).attr('scrollTop', initScrollTop + 1);
      if ($(this).attr('scrollTop') === initScrollTop + 1) {
      scrollElement = this.nodeName.toLowerCase();
      $(this).attr('scrollTop', initScrollTop);
      return false;
      }    
      });

      // Smooth scrolling for internal links
      $("a[href^='#']").click(function(event) {
      event.preventDefault();

      var $this = $(this),
      target = this.hash,
      $target = $(target);

      $(scrollElement).stop().animate({
      'scrollTop': $target.offset().top - headerHeight
      }, 300, 'swing', function() {
      window.location.hash = target;
      });

      });
      });

      // Skroller Thangs
      
      if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
       
      }else {
      	skrollr.init({
      	  forceHeight: false
      	});
      	$(".banner").waypoint('sticky');
      }
      
      var wh = $(window).height();
      var bh = $('header.banner').height();
     

      $("#home-graphic").css({
        maxHeight : wh-bh,
        minHeight : 500,
      });
      
      $(window).resize(function() {
      
        var sh = $('#simpsons article').height();
        var vh = $('#gallery article').height();
        
      	$("#gallery article").css({
      	  minHeight : sh,
      	});
      	
      	$("#simpsons article").css({
      	  minHeight : vh,
      	});
      }).resize();
      
      

      // Instagram

      function createPhotoElement(photo) {
      var innerHtml = $('<img class="img-responsive">')
        .addClass('instagram-image')
        .attr('src', photo.images.standard_resolution.url);

      innerHtml = $('<a>')
        .attr('target', '_blank')
        .attr('href', photo.link)
        .append(innerHtml);

      return $('<div>')
        .addClass('instagram-placeholder col-md-3')
        .attr('id', photo.id)
        .append(innerHtml);
    }

    function didLoadInstagram(event, response) {
      var that = this;

      $.each(response.data, function(i, photo) {
        $(that).append(createPhotoElement(photo));
      });
    }

    $(document).ready(function() {
      var clientId = 'baee48560b984845974f6b85a07bf7d9';
      
      $('.instagram').on('didLoadInstagram', didLoadInstagram);
      $('.instagram').instagram({
        hash: 'laodyssey',
        count: 10,
        clientId: clientId
      });
      
    });
    
    $('#home-graphic-slider .slidersituation').royalSlider({
      autoPlay: {
        enabled: true,
        //pauseOnHover: false,
        delay: 2000,
      },
      arrowsNav: true,
      loop: true,
      keyboardNavEnabled: true,
      controlsInside: true,
      imageScaleMode: 'fill',
      //arrowsNavAutoHide: false,
      autoScaleSlider: false, 
      autoScaleSliderWidth: 960,     
      autoScaleSliderHeight: 350,
      //controlNavigation: 'bullets',
      //thumbsFitInViewport: true,
      navigateByClick: true,
      transitionSpeed: 800,
      //startSlideId: 0,
      transitionType:'fade',
      slidesSpacing: 0,
      imgWidth: 1400,
      imgHeight: 900,
      
    });
    

      // Slick Scroller

      $('.center').slick({
        draggable: false,
        infinite: false,
        lazyload: 'ondemand',
        dots: true,
        //autoplay: true,
        arrows: true,
        speed: 800
      });

    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
    }
  },
  // About us page, note the change from about-us to about_us.
  about_us: {
    init: function() {
      // JavaScript to be fired on the about us page
    }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
