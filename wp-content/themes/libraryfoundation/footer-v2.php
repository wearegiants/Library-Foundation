</div><!-- #wrapper -->

<hr class="invisible">

<?php include locate_template('partials/footer__modules.php' );?>

<hr class="divider compact">

<footer class="footer fs-grid">
<div class="fs-row">
<div class="fs-cell fs-lg-fourth fs-md-half fs-sm-full"><a href="/">The Library Foundation <br class="fs-sm-hide">of Los Angeles</a></div>
<hr class="divider compact fs-cell fs-lg-hide fs-md-hide fs-sm-3"/>
<div class="fs-cell fs-lg-fourth fs-md-half fs-sm-full">630 West 5th Street <br class="fs-sm-hide">Los Angeles, CA 90071</div>
<hr class="divider compact fs-cell fs-lg-hide fs-md-6 fs-sm-hide"/>
<div class="fs-cell fs-lg-fourth fs-md-half fs-sm-full">213.228.7500 <span class="fs-lg-hide fs-md-hide">|</span> <br class="fs-sm-hide"><a href="mailto:info@lfla.org">info@lfla.org</a></div>
<hr class="divider compact fs-cell fs-lg-hide fs-md-hide fs-sm-3"/>
<div class="fs-cell fs-lg-fourth fs-md-half fs-sm-full text-right">
  <div class="footer__social">
    <a href="#" class="ss-icon ss-social ss-facebook color__facebook"></a>
    <a href="#" class="ss-icon ss-social ss-twitter color__twitter"></a>
    <a href="#" class="ss-icon ss-social ss-youtube color__youtube"></a>
    <a href="#" class="ss-icon ss-social ss-flickr color__flickr"></a>
  </div>
</div>
<div class="fs-cell fs-all-full">
<hr class="divider compact">
© <?php echo date('Y'); ?> Library Foundation of Los Angeles <span class="fs-sm-hide">|</span>
<br class="fs-lg-hide fs-md-hide">
<a href="<?php echo get_permalink(4738); ?>">Contact Us</a>|
<a href="<?php echo get_permalink(26929); ?>">Donors Privacy</a>
</div>
</div>
</footer><!--Footer-->

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

<?php the_widget( 'WP_Widget_Text', 'text', 3 ); ?>

<?php wp_footer(); ?>

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