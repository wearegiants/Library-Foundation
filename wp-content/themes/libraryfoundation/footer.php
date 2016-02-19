<?php if( is_tax( 'tribe_events_cat', 'aloud' )): ?>

<div id="aloud--faq" class="accordion page-section">
  <div class="row">
    <div class="desktop-12">
      <h3 class="event-section-title">Frequently Asked Questions</h3>
      <ul id="faq-accordion">
        <?php while ( have_rows('aloud_faq','options') ) : the_row(); ?>
        <li class="item active">
          <a href="#tab" class="title"><?php the_sub_field('question'); ?></a>
          <div><?php the_sub_field('answer'); ?></div>
        </li>
        <?php endwhile; ?>
      </ul>
    </div>
  </div>
</div>

<?php endif; ?>

<?php if( is_tax( 'tribe_events_cat', 'aloud' )): ?>

<div id="sponsors" class="page-section">
  <div class="row">
    <div class="desktop-12">
      <h3 class="event-section-title">Thanks to our generous sponsors</h3>
      <?php $globalSponsors = get_field('aloud_sponsors', 'options'); if( $globalSponsors ): ?>
      <?php foreach( $globalSponsors as $globalSponsor ): $link = get_field('attachement_link', $globalSponsor['id']); ?>

      <div class="item desktop-3 tablet-2 mobile-1 sizer-item contained">
      <a href="<?php echo $link; ?>">
      <img class="img-responsive" src="<?php echo $globalSponsor['sizes']['large']; ?>" alt="<?php echo $globalSponsor['alt']; ?>" />
      </a>
      </div>

      <?php endforeach; endif; ?>
    </div>
  </div>
</div>

<?php endif; ?>

<?php if ( (get_post_type() == 'tribe_events' && tribe_is_upcoming()) || tribe_is_month() || tribe_is_by_date() ): ?>
<?php if (!is_tax( 'tribe_events_cat' )): ?>

  <!--
  <div class="row">
    <div class="desktop-12 tablet-6 mobile-3">
      <a class="external-link blue" href="http://lapl.org">Visit LAPL.org</a>
    </div>
  </div>
-->



  <?php if( have_rows('spotlight_carousel', 'option') ): ?>

  <div id="home-featured">
    <div class="row">
      <header class="desktop-10 centered">
        <hr>
        <a href="#spotlight-events">
          <i class="ss-icon ss-gizmo home-arrow left ">down</i>
          <h3 id="spotlight-events"><a href="/calendar">Spotlight<span></a></h3>
        </a>
      </header>
      <div class="desktop-12">
        <div class="slider rsMinW">
          <?php

          while ( have_rows('spotlight_carousel', 'option') ) : the_row();

          // $thingie = get_sub_field('slide_post');
          // $post = $thingie;
          // setup_postdata( $post );

          $post_object = get_sub_field('slide_post');

          if( $post_object ):

            $post = $post_object;
          setup_postdata($post);

          get_template_part('templates/home/slider', 'bottom' );

          wp_reset_postdata();
          endif;
          endwhile;

          ?>
        </div>
      </div>
    </div>
  </div>

  <hr>

<?php endif; ?>
<?php endif; ?>
<?php endif; ?>

<?php if ( (get_post_type() == 'tribe_events' && tribe_is_upcoming()) || tribe_is_month() || tribe_is_by_date() ): ?>
  <?php // include locate_template('templates/calendar-mediagraphic.php'); ?>
<?php endif; ?>

<?php include locate_template('/templates/logotogglin.php' );?>

</div>
</div></section><!--Content-->

<?php get_template_part('templates/footer', 'modules' ); ?>

<footer id="foot" class="gridlock">
  <div class="row">
    <div class="desktop-3 tablet-3 mobile-3"><a class="logo" href="/">The Library Foundation<br>of Los Angeles</a></div>
    <div class="desktop-3 tablet-3 mobile-3"><?php the_field('address', 'option'); ?></div>
    <div class="desktop-3 tablet-3 mobile-3"><?php the_field('phone_&_email', 'option'); ?></div>
    <div class="desktop-3 tablet-3 mobile-3"><?php the_field('social_links', 'option'); ?></div>
    <hr style="height:1px; background:#ddd;" class="desktop-12 tablet-6 mobile-3">
    <div class="desktop-12">
      © 2015 Library Foundation of Los Angeles |
      <a href="<?php echo get_permalink(4738); ?>">Contact Us</a>|
      <a href="<?php echo get_permalink(26929); ?>">Donors Privacy</a>
    </div>
  </div>
</footer><!--Footer-->

</div></div><!-- Wrapper -->

<?php
  $menuParameters = array(
    'container'       => false,
    'echo'            => false,
    'items_wrap'      => '%3$s',
    'theme_location'  =>'main-menu',
    'walker'          => new MV_Cleaner_Walker_Nav_Menu(),
    'depth'           => 0,
  );
?>

<nav class="shifter-navigation">
  <div class="main-nav">
    <h4>Navigation</h4>
    <a href="/">Home</a>
    <?php echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' ); ?>
    <a href="#" class="search"><i class="ss-gizmo ss-icon">search</i></a>
    <h4>Support Us</h4>
    <a href="<?php echo get_the_permalink(299); ?>">Donate</a>
    <a href="<?php echo get_the_permalink(289); ?>">Join the LFLA</a>
    <h4>Follow Us</h4>
    <div class="social-icons">
      <a href="#"><i class="ss-icon ss-social-circle">Facebook</i></a>
      <a href="#"><i class="ss-icon ss-social-circle">Twitter</i></a>
      <a href="#"><i class="ss-icon ss-social-circle">Instagram</i></a>
      <a href="#"><i class="ss-icon ss-social-circle">Flickr</i></a>
      <a href="#"><i class="ss-icon ss-social-circle">Vimeo</i></a>
    </div>
  </div>
</nav>

<?php the_widget( 'WP_Widget_Text', 'text', 3 ); ?>

<?php wp_footer(); ?>
<?php include locate_template('/lib/photoswipe.php' );?>
<?php include locate_template('/templates/search-footer.php' );?>
<!--[if lte IE 6]><script src="/assets/warning/warning.js"></script><script>window.onload=function(){e("/assets/warning/")}</script><![endif]-->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-35986901-18', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>