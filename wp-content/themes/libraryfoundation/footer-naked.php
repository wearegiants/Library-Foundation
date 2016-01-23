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
      <a href="<?php echo get_permalink(4738); ?>">Contact Us</a>
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