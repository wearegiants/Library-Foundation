<?php Themewrangler::setup_page();get_header(/***Template Name: w/ Sidebar */); ?>

<?php

  if ( get_field('simple_page')) {

    include locate_template('/templates/page-header-simple.php');

  } else {

    get_template_part('templates/page', 'header');

  }

  get_template_part('templates/page-content', 'simple');

?>

<?php get_footer(); ?>