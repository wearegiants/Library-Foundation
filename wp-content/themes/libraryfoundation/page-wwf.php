<?php Themewrangler::setup_page();get_header(/***Template Name: What We Fund */); ?>

<?php get_template_part('templates/page', 'header'); ?>

<div class="row">

  <?php while (have_posts()) : the_post(); ?>
  <div class="page-content desktop-7 tablet-4 mobile-3"><?php the_content(); ?></div>
  <?php endwhile; ?>

  <aside class="aside desktop-4 tablet-2 mobile-3 right noboom">
  <hr class="invisible">
  <br>
  <?php get_sidebar('simple'); ?>
  </aside>

</div>
<div id="sponsor-hat"></div>
<?php get_template_part('templates/flex', 'content'); ?>

<script>
$(document).ready(function(){
  var waypoint = new Waypoint({
    element: document.getElementById('sponsor-hat'),
    handler: function(direction) {
      notify('I am still alive')
    },
    offset: 0
  })
    waypoint.destroy();

</script>

<?php get_footer(); ?>