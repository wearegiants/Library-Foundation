<?php Themewrangler::setup_page();get_header(); ?>

<?php

  if ( get_field('simple_page')) {

    get_template_part('templates/page', 'header-simple');

  } else {

    get_template_part('templates/page', 'header');

  }

  // get_template_part('templates/page', 'content');
  // get_sidebar();
  // get_template_part('templates/flex', 'content');

?>
<hr class="invisible">
<div class="row">

  <div class="clearfix">
  <div class="page-content desktop-7 tablet-4 mobile-3 sizer-item">
    <?php while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
    <?php endwhile; ?>
  </div>
  <?php get_sidebar('event');?>
  </div>

  <div class="desktop-12">
    <div id="sponsor-hat"></div>
    <?php get_template_part('templates/flex', 'content'); ?>
  </div>
</div>

<?php get_footer(); ?>