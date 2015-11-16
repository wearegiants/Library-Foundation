

//SmartAjax_load('/assets/javascripts/', function(){
  /* Pre-Define HTML5 Elements in IE */
  (function() {
    var els =
    "source|address|article|aside|audio|canvas|command|datalist|details|dialog|figure|figcaption|footer|header|hgroup|keygen|mark|meter|menu|nav|picture|progress|ruby|section|time|video"
    .split('|');
    for (var i = 0; i < els.length; i++) {
      document.createElement(els[i]);
    }
  })();

  function thangs() {

    $( ".item.format-gallery .title a" ).click(function( event ) {
      event.preventDefault();
      //alert('boom');
      $(this).parent().parent().parent().parent().find('figure.show a').click();
    });

    $.shifter({
      maxWidth: '960px'
    });

    $('#archive--wrapper .search-btn').click(function(){
      $('#search-box').toggle();
    });

    //$('a[href^="http://"]').not('a[href*=#]').attr('target','_blank');

    // $('a').each(function() {
    //   var a = new RegExp('/' + window.location.host + '/');
    //   if (!a.test(this.href)) {
    //     $(this)
    //     .click(function(event) {
    //       event.preventDefault();
    //       event.stopPropagation();
    //       window.open(this.href, '_blank');
    //     });
    //   }
    // });

    $('a').not('[href*="mailto:"],[href*="#"]').each(function () {
      var a = new RegExp('/' + window.location.host + '/');
      var href = this.href;
      if ( ! a.test(href) ) {
        $(this).attr('target', '_blank');
      }
    });


    var initPhotoSwipeFromDOM = function(gallerySelector) {
    // parse slide data (url, title, size ...) from DOM elements
    // (children of gallerySelector)
    var parseThumbnailElements = function(el) {
      var thumbElements = el.childNodes,
      numNodes = thumbElements.length,
      items = [],
      figureEl,
      childElements,
      linkEl,
      size,
      item;
      for (var i = 0; i < numNodes; i++) {
        figureEl = thumbElements[i]; // <figure> element
        // include only element nodes
        if (figureEl.nodeType !== 1) {
          continue;
        }
        linkEl = figureEl.children[0]; // <a> element
        size = linkEl.getAttribute('data-size')
        .split('x');
        // create slide object
        item = {
          src: linkEl.getAttribute('href'),
          w: parseInt(size[0], 10),
          h: parseInt(size[1], 10)
        };
        if (figureEl.children.length > 1) {
          // <figcaption> content
          item.title = figureEl.children[1].innerHTML;
        }
        if (linkEl.children.length > 0) {
          // <img> thumbnail element, retrieving thumbnail url
          item.msrc = linkEl.children[0].getAttribute('src');
        }
        item.el = figureEl; // save link to element for getThumbBoundsFn
        items.push(item);
      }
      return items;
    };
    // find nearest parent element
    var closest = function closest(el, fn) {
      return el && (fn(el) ? el : closest(el.parentNode, fn));
    };
    // triggers when user clicks on thumbnail
    var onThumbnailsClick = function(e) {
      e = e || window.event;
      e.preventDefault ? e.preventDefault() : e.returnValue = false;
      var eTarget = e.target || e.srcElement;
      var clickedListItem = closest(eTarget, function(el) {
        return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
      });
      if (!clickedListItem) {
        return;
      }
      // find index of clicked item
      var clickedGallery = clickedListItem.parentNode,
      childNodes = clickedListItem.parentNode.childNodes,
      numChildNodes = childNodes.length,
      nodeIndex = 0,
      index;
      for (var i = 0; i < numChildNodes; i++) {
        if (childNodes[i].nodeType !== 1) {
          continue;
        }
        if (childNodes[i] === clickedListItem) {
          index = nodeIndex;
          break;
        }
        nodeIndex++;
      }
      if (index >= 0) {
        openPhotoSwipe(index, clickedGallery);
      }
      return false;
    };
    // parse picture index and gallery index from URL (#&pid=1&gid=2)
    var photoswipeParseHash = function() {
      var hash = window.location.hash.substring(1),
      params = {};
      if (hash.length < 5) {
        return params;
      }
      var vars = hash.split('&');
      for (var i = 0; i < vars.length; i++) {
        if (!vars[i]) {
          continue;
        }
        var pair = vars[i].split('=');
        if (pair.length < 2) {
          continue;
        }
        params[pair[0]] = pair[1];
      }
      if (params.gid) {
        params.gid = parseInt(params.gid, 10);
      }
      if (!params.hasOwnProperty('pid')) {
        return params;
      }
      params.pid = parseInt(params.pid, 10);
      return params;
    };
    var openPhotoSwipe = function(index, galleryElement, disableAnimation) {
      var pswpElement = document.querySelectorAll('.pswp')[0],
      gallery,
      options,
      items;
      items = parseThumbnailElements(galleryElement);
      // define options (if needed)
      options = {
        index: index,
        // define gallery index (for URL)
        galleryUID: galleryElement.getAttribute('data-pswp-uid'),
        getThumbBoundsFn: function(index) {
          // See Options -> getThumbBoundsFn section of docs for more info
          var thumbnail = items[index].el.getElementsByTagName('img')[
              0], // find thumbnail
              pageYScroll = window.pageYOffset || document.documentElement
              .scrollTop,
              rect = thumbnail.getBoundingClientRect();
              return {
                x: rect.left,
                y: rect.top + pageYScroll,
                w: rect.width
              };
            },
        // history & focus options are disabled on CodePen
        // remove these lines in real life:
        historyEnabled: false,
        focus: false
      };
      if (disableAnimation) {
        options.showAnimationDuration = 0;
      }
      // Pass data to PhotoSwipe and initialize it
      gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items,
        options);
      gallery.init();
    };
    // loop through all gallery elements and bind events
    var galleryElements = document.querySelectorAll(gallerySelector);
    for (var i = 0, l = galleryElements.length; i < l; i++) {
      galleryElements[i].setAttribute('data-pswp-uid', i + 1);
      galleryElements[i].onclick = onThumbnailsClick;
    }
    // Parse URL and open gallery if it contains #&pid=3&gid=1
    var hashData = photoswipeParseHash();
    if(hashData.pid && hashData.gid) {
        openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
    }

  };
  // execute above function
  initPhotoSwipeFromDOM('.event-gallery');
  // Superfish
  $('.toolbar .sf-menu')
  .superfish({
    delay: 0,
    autoArrows: false,
    speed: 'fast',
    animation: {
      height: 'show'
    },
    disableHI: true
  });
  // Tabber
  $(".tabbed").tabber({
    maxWidth: '100px'
  });
  // Sizer
  $("#sized, #staff, #sponsors, #page-list.quadrant").sizer();

  // Accordion
  $('#faq-accordion').accordion();
  // Stepper
  $("input[type='number']").stepper();
  // Selecter
  $(".sidebar select").selecter({
      //label: "All Categories",
      cover: true,
      customClass: "blog-select"
    });


  $("#search-events-mobile").click(function(e){
    e.preventDefault();
    $('#event-bar').toggle({
      //height: 'auto',
      //overflow: 'visible'
    })
  });

  // $(".widget_categories select").selecter({
  //   label: "All Categories",
  //   cover: true,
  //   customClass: "blog-select"
  // });
$(".selected").selecter();
$("#donation-module select").selecter({
      //label: "Archive",
      cover: true,
      label: "Make a Donation",
      customClass: "blog-select"
    });
$("#home-upcoming select")
.selecter({
  label: "Jump to Month",
  cover: true,
  links: true,
  customClass: "blog-select"
});
$('#home-upcoming .selecter-selected')
.addClass('ss-glypish ss-calendar');
$('.tribe-bar-filters .tribe-events-button')
.addClass('ss-glypish ss-calendar');
  // Image Slider
  $(".royalslider").royalSlider({
    keyboardNavEnabled: true,
    autoScaleSlider: true,
    autoScaleSliderWidth: 1200,
    autoScaleSliderHeight: 700,
    imageScaleMode: 'fill',
    slidesSpacing: 0,
    loop: true,
    transitionSpeed: 1200,
    transitionType: 'fade'
  });
  $("#calendar-header .slider")
  .royalSlider({
    keyboardNavEnabled: true,
    imageScaleMode: 'fill',
    slidesSpacing: 0,
    loop: true,
    transitionSpeed: 1200,
    transitionType: 'fade',
    arrowsNav: false,
    controlNavigation: 'none',
    imageAlignCenter: false,
  });
  $("#past-events-slider.slider")
  .royalSlider({
    keyboardNavEnabled: true,
    imageScaleMode: 'fill',
    slidesSpacing: 0,
    autoScaleSlider: true,
    autoScaleSliderWidth: 1200,
    autoScaleSliderHeight: 500,
    loop: true,
    transitionSpeed: 1200,
    transitionType: 'fade',
    arrowsNav: false,
    controlNavigation: 'none',
  });

  if ($(window).width() > 500) {

  $("#home-carousel")
  .royalSlider({
    keyboardNavEnabled: true,
      // autoScaleSlider : true,
      // autoScaleSliderWidth: 1200,
      // autoScaleSliderHeight: 600,
      imageScaleMode: 'fill',
      navigateByClick: false,
      slidesSpacing: 0,
      fadeinLoadedSlide: false,
      addActiveClass: true,
      loop: true,
      slidesSpacing: 35,
      transitionSpeed: 600,
      autoPlay: {
        // autoplay options go gere
        enabled: true,
        pauseOnHover: true,
        delay: 5000,
      },
      visibleNearby: {
        enabled: true,
        centerArea: 0.85,
        center: true,
        breakpoint: 1000,
        breakpointCenterArea: 1,
        navigateByCenterClick: true
      }
    });
  }

  $(document).ready(function($) {
    var si = $('.module-slider').royalSlider({
      addActiveClass: true,
      arrowsNav: false,
      controlNavigation: 'none',
      autoScaleSlider: true,
      autoScaleSliderWidth: 960,
      autoScaleSliderHeight: 340,
      loop: true,
      fadeinLoadedSlide: false,
      globalCaption: true,
      keyboardNavEnabled: true,
      globalCaptionInside: false,

      visibleNearby: {
        enabled: true,
        centerArea: 0.5,
        center: true,
        breakpoint: 650,
        breakpointCenterArea: 0.64,
        navigateByCenterClick: true
      }
    }).data('royalSlider');

    // link to fifth slide from slider description.

  });




    $("#home-featured .slider")
    .royalSlider({
      keyboardNavEnabled: true,
      imageScaleMode: 'fill',
      slidesSpacing: 0,
      fadeinLoadedSlide: false,
      addActiveClass: true,
      loop: true,
      navigateByClick: false,
    });



  $("#event-spotlight-slider .slider")
  .royalSlider({
    keyboardNavEnabled: true,
    imageScaleMode: 'fill',
    slidesSpacing: 0,
    fadeinLoadedSlide: false,
    addActiveClass: true,
    loop: true,
    autoScaleSlider: true,
    autoScaleSliderWidth: 1200,
    autoScaleSliderHeight: 800,
    navigateByClick: false,
    transitionType: 'fade',
    controlNavigation: 'none'
  });
  $('#upcoming-events-carousel')
  .slick({
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 2,
    accessibility: false,
    autoplay: false,
    speed: 600,
    autoplaySpeed: 5000,
    responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 3,
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
    ]
  });
  $("#home-upcoming .prevBtn, #archive--newest .prevBtn")
  .click(function() {
    $('#upcoming-events-carousel')
    .slick('slickPrev');
  });
  $("#home-upcoming .nextBtn, #archive--newest .nextBtn")
  .click(function() {
    $('#upcoming-events-carousel')
    .slick('slickNext');
  });
  if ($('#upcoming-events-carousel')
    .slick('slickCurrentSlide') == 0) {
    $("#home-upcoming .prevBtn")
  .addClass('disabled');
}
$('#upcoming-events-carousel')
.on('afterChange', function(event, slick, currentSlide, nextSlide) {
  if ($('#upcoming-events-carousel')
    .slick('slickCurrentSlide') > 0) {
    $("#home-upcoming .prevBtn")
  .removeClass('disabled');
}
});
$(".amount")
.text(function() {
  return $(this)
  .text()
  .replace("$0.00", "Free");
});​​​​​
var $boardContainer = $('#board')
.imagesLoaded(function() {
  $boardContainer.isotope({
    itemSelector: '.board',
    layoutMode: 'packery',
        //filter:         '.featured',
      });
});
  // What We Fund
  $(function() {
    var $container = $('#whatwefund-grid')
    .imagesLoaded(function() {
      $container.isotope({
        itemSelector: '.item',
        layoutMode: 'packery',
        filter: '.featured',
      });
    });
    // var $grid_container = $('.sortable-grid').imagesLoaded( function() {
    //   $grid_container.isotope({
    //     itemSelector:   '.item',
    //     layoutMode:     'packery',
    //   });
    // });
function archiveStuffs() {
  $('.popup-video')
  .magnificPopup({
    disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false
  });
}
archiveStuffs()
      //   filterTags();
      // function filterTags(){
      //   isotopeInit();
      //   var $checkboxes = $('#whatwefund-filters button')
      //   $checkboxes.on( 'click', 'button', function() {
      //     var arr = [];
      //     $checkboxes.filter(':checked').each(function(){
      //       var $dataToFilter = $(this).attr('data-filter');
      //       arr.push( $dataToFilter );
      //     });
      //     arr = arr.join(', ');
      //     $container.isotope({ filter: arr });
      //   });
      // };
      isotopeInit();

      function isotopeInit() {
        var $grid_container = $('.sortable-grid')
        .imagesLoaded(function() {
          $grid_container.isotope({
            itemSelector: '.item',
            layoutMode: 'packery',
            animationEngine: "best-available",
          });
        });
      };
      $('.sortable-grid')
      .infinitescroll({
        loading: {
          finished: undefined,
          finishedMsg: "<em>No more posts to load.</em>",
          img: "http://www.infinite-scroll.com/loading.gif",
          msg: null,
          msgText: "<em>Loading the next set of posts...</em>",
            //selector: '.infinite-loader',
            speed: 'fast',
            start: undefined
          },
          binder: $(window),
          //pixelsFromNavToBottom: Math.round($(window).height() * 0.9),
          //bufferPx: Math.round($(window).height() * 0.9),
          nextSelector: ".archive-nav a",
          navSelector: ".archive-nav",
          contentSelector: ".sortable-grid",
          itemSelector: ".item",
          //maxPage: {{pagination.pages}},
          appendCallback: true,
          //animate: true,
          bufferPx: 500,
        },
        // Callbacks for initializing scripts to added post excerpts
        function(newElements) {
          var $newElems = $(newElements);
          archiveStuffs();
          initPhotoSwipeFromDOM('.event-gallery');
          // checkForFeatured();
          // makeFontResponsive();
          // addReadMoreLinks();
          // fitVidInit();
          $newElems.imagesLoaded(function() {
            $('.sortable-grid')
            .isotope('appended', $newElems);
          });
        });
$('.grid-filters')
.on('click', 'button', function() {
  var filterValue = $(this)
  .attr('data-filter');
  $('.grid-filters')
  .find('.active')
  .removeClass('active');
  $(this)
  .addClass('active');
  var string = filterValue.replace('.', '');
  $('#wrapper')
  .removeClass();
  $('#wrapper')
  .addClass(string);
        // use filter function if value matches
        filterValue = filterFns[filterValue] || filterValue;
        $('.sortable-grid')
        .isotope({
          filter: filterValue
        });
        $('html,body')
        .animate({
          scrollTop: $('#archive-grid')
          .offset()
          .top - 49
        });
      });
var filterFns = {
      // show if number is greater than 50
      numberGreaterThan50: function() {
        var number = $(this)
        .find('.number')
        .text();
        return parseInt(number, 10) > 50;
      },
      // show if name ends with -ium
      ium: function() {
        var name = $(this)
        .find('.name')
        .text();
        return name.match(/ium$/);
      }
    };

    $('#whatwefund-filters').on('click', 'button', function() {

      var filterValue = $(this).attr('data-filter');

      $('#whatwefund-filters').find('.active').removeClass('active');
      $(this).addClass('active');
        // use filter function if value matches

        filterValue = filterFns[filterValue] || filterValue;

        $container.isotope({
          filter: filterValue
        });

        $('html,body').animate({
          scrollTop: $('#whatwefund-filters').offset().top - 49
        });

      });
  });
  // End What We Fund

  // Parallax BG
  if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {} else {
    $window = $(window);
    $('.page-header, .simple-header, .simple-header .inner')
    .each(function() {
      var $bgobj = $(this);
      $(window)
      .scroll(function() {
        var yPos = ($window.scrollTop() / $bgobj.data('speed'));
        var coords = '50% ' + yPos + 'px';
        $bgobj.css({
          backgroundPosition: coords
        });
      });
    });
  }
  // Cart Modal Window
  $('#event-bar .enabled, .popup')
  .magnificPopup({
    type: 'inline',
    preloader: false,
    closeBtnInside: false,
    mainClass: 'mfp-fade gridlock gridlock-fluid',
  });
  $('.member-popup')
  .magnificPopup({
    type: 'ajax',
    callbacks: {
      parseAjax: function(mfpResponse) {
        mfpResponse.data = $(mfpResponse.data)
        .find('#content .summary');
      },
    },
      //alignTop: center,
      overflowY: 'scroll' // as we know that popup content is tall we set scroll overflow by default to avoid jump
    });
  $('.button.closed')
  .magnificPopup({
    type: 'image',
    closeBtnInside: true,
    closeOnContentClick: true,
    mainClass: 'mfp-fade',
    image: {
      verticalFit: true
    }
  });
  // Sticky Menu
  if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {} else {
    if ($('#head')
      .length) {
      var sticky = new Waypoint.Sticky({
        element: $('#head')[0],
        wrapper: '<div class="header-wrapper"/>',
      });
  }
  if ($('#toolbar.events, #archive-bar, #event-bar.toolbar')
    .length) {
    var eventSticky = new Waypoint.Sticky({
      element: $('#toolbar.events, #archive-bar, #event-bar.toolbar')[0],
      wrapper: '<div class="event-bar-wrapper"/>',
      offset: 50,
    });
}
}
  $(function($) {
    var scrollElement = 'html, body';
    $('html, body').each(function () {
      var initScrollTop = $(this).attr('scrollTop');
      $(this).attr('scrollTop', initScrollTop + 1);
      if ($(this).attr('scrollTop') == initScrollTop + 1) {
        scrollElement = this.nodeName.toLowerCase();
        $(this).attr('scrollTop', initScrollTop);
        return false;
      }
    });
    // Smooth scrolling for internal links
    $("a[href^='#']:not(.tabber-handle, .popup, [href*='#'], #event-status-button)").click(function(event) {
      event.preventDefault();
      var $this = $(this),
      target = this.hash,
      $target = $(target);
      $(scrollElement).stop().animate({
        'scrollTop': $target.offset().top - 100
      }, 300, 'swing', function() {
        window.location.hash = target;
      });
    });
  });
if ($('#member-widget')
  .length) {
  if ($('body.single-tribe_events')
    .length > 0) {
    var offset = 125;
} else {
  var offset = 75;
}
var memberSticky = new Waypoint.Sticky({
  element: $('#member-widget:not(.page-home #member-widget)')[0],
  wrapper: '<div class="member-wrapper"/>',
  offset: offset,
});
var mw = $('.member-wrapper')
.width();
var mh = $('.member-wrapper')
.height();
$('#member-widget')
.css({
  width: mw
});
    // Accounting for Sponsors
    var $sponsors = $('#sponsor-hat');
    $sponsors.waypoint(function(direction) {
      if (direction === 'down') {
        $('#member-widget')
        .addClass('boom');
      }
    }, {
      offset: mh + 125
    });
    $sponsors.waypoint(function(direction) {
      if (direction === 'up') {
        $('#member-widget')
        .removeClass('boom');
      }
    }, {
      offset: mh + 125
    });
    // Accounting for Footer Modules
    var $things = $('#footer-modules');
    $things.waypoint(function(direction) {
      if (direction === 'down') {
        $('#member-widget')
        .addClass('boom');
      }
    }, {
      offset: mh + 75
    });
    $things.waypoint(function(direction) {
      if (direction === 'up') {
        $('#member-widget')
        .removeClass('boom');
      }
    }, {
      offset: mh + 75
    });
    // Accounting for What We Fund
    var $wwf_filter = $('#whatwefund-filters');
    $wwf_filter.waypoint(function(direction) {
      if (direction === 'down') {
        $('#member-widget')
        .addClass('boom');
      }
    }, {
      offset: mh + 125
    });
    $wwf_filter.waypoint(function(direction) {
      if (direction === 'up') {
        $('#member-widget')
        .removeClass('boom');
      }
    }, {
      offset: mh + 125
    });
  }
  // Archive Page
  $('.popup-video')
  .magnificPopup({
    disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false
  });
  $('.main-nav a.search, #main-nav a.search')
  .click(function(event) {
    event.preventDefault();
    $('#search-footer')
    .fadeIn(300);
  });
  $('#search-footer .close')
  .click(function(event) {
    event.preventDefault();
    $('#search-footer')
    .fadeOut(300);
  });
  $('.cross-sells h2')
  .text('Related Books');
  $('.cross-sells')
  .append(
    '<span>All sales from The Library Store support the Los Angeles Public Library.</span>'
    );
}
$(document)
.ready(function() {
  thangs();
});;
//(function($) {
//  'use strict';
//  var $body = $('html, body'),
//  content = $('body')
//  .smoothState({
//    prefetch: true,
//    pageCacheSize: 4,
//    onStart: {
//      duration: 250,
//      render: function(url, $container) {
//        content.toggleAnimationClass('is-exiting');
//        thangs();
//      }
//    },
//    onEnd: {
//        duration: 0, // Duration of the animations, if any.
//        render: function(url, $container, $content) {
//          $body.css('cursor', 'auto');
//          $body.find('a')
//          .css('cursor', 'auto');
//          $container.html($content);
//          thangs();
//          $body.animate({
//            scrollTop: 0
//          });
//        }
//      },
//    })
//  .data('smoothState');
//})(jQuery);
// $( ".single_add_to_cart_button" ).each(function(){
//     var product_id = jQuery(this).attr('rel');
//     var el = jQuery(this);
//     el.click(function() {
//             var data = {
//                 action: 'add_foobar',
//                 product_id: product_id
//             };
//             jQuery.post('/wp-admin/admin-ajax.php' , data, function(response) {
//                 if(response != 0) {
//                     // do something
//                 } else {
//                     // do something else
//                 }
//             });
//         return false;
//     });
// });
// SmartAjax.bind('a', {
//   reload: false,
//   cache: true,
//   containers: [{
//   selector: '#content > div'
//   }],
//   before: function()
//   {
//   $('#content').animate({
//   opacity: 0
//   }, 100 , SmartAjax.proceed);
//   },
//   done: function()
//   {
//   thangs();
//   $('#content').animate({
//   opacity: 1
//   },100);
//   }
// });
//}, true);