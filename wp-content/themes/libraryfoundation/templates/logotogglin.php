<script>

  $(function(){

    var swiper = new Swiper('.swiper-container', {
      // pagination: '.swiper-pagination',
      // nextButton: '.swiper-button-next',
      // prevButton: '.swiper-button-prev',
      effect: 'cube',
      grabCursor: false,
      allowSwipeToNext : false,
      allowSwipeToPrev : false,
      simulateTouch: false,
      cube: {
          shadow: false,
          slideShadows: false,
          shadowOffset: 20,
          shadowScale: 0.94
      }
    });

    function hoverEffect(){
      $( "#logo" ).mouseenter(function() {
      //n += 1;
      swiper.slideTo(0);
      }).mouseleave(function() {
      swiper.slideTo(1);
      });
    }

    var homeClasses    = '.page-home';
    var aloudClasses   = '.events-category-aloud, .page-template-page-protected';
    var ylClasses      = '.page-young-literati';
    var memberClasses  = '.page-membership, .page-become-a-member, .page-bibliophiles';
    var councilClasses = '.page-the-council, .page-council-board';
    var lsClasses      = '.events-category-library-store, .events-category-library-store-on-wheels';

    if ($('body').is(aloudClasses)) {

      //alert('ALOUD');
      $('#swiper').addClass('aloud-logo pushover');

      setTimeout(function(){
        swiper.slideTo(1);
      },500);

      hoverEffect();

    }

    if ($('body').is(ylClasses)) {

      //alert('YL');
      $('#swiper').addClass('yl-logo pushover');

      setTimeout(function(){
        swiper.slideTo(1);
      },500);

      hoverEffect();

    }

    if ($('body').is(memberClasses)) {

      //alert('ALOUD');
      $('#swiper').addClass('member-logo pushover');

      setTimeout(function(){
        swiper.slideTo(1);
      },500);

      hoverEffect();

    }

    if ($('body').is(lsClasses)) {

      //alert('Library Store!');
      $('#swiper').addClass('ls-logo pushover');

      setTimeout(function(){
        swiper.slideTo(1);
      },500);

      hoverEffect();

    }

    if ($('body').is(councilClasses)) {

      //alert('Library Store!');
      $('#swiper').addClass('council-logo pushover');

      setTimeout(function(){
        swiper.slideTo(1);
      },500);

      hoverEffect();

    }

  });

</script>