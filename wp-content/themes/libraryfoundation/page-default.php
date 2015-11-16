<?php Themewrangler::setup_page();get_header(); ?>

<?php

  if ( get_field('simple_page')) {

    get_template_part('templates/page', 'header-simple');

  } else {

    get_template_part('templates/page', 'header');

  }

  get_template_part('templates/page', 'content');

  if ( get_field('include_sidebar')) {

    // Don't display some stuff.
    // get_template_part('templates/flex', 'content');

  } else {

    get_template_part('templates/flex', 'content');

  }


  if (is_ancestor(250)) {
   get_template_part('templates/whatwefund/whatwefund', 'grid' );
  }

?>

<?php get_footer(); ?>