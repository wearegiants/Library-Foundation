<?php Themewrangler::setup_page();get_header(); ?>


<?php

  $featured = get_field('featured_header');

  if ( $featured ) {

    $min = '';

  } else {

    $min = 'minimal';

  }

  include locate_template('templates/single-header.php');
  include locate_template('templates/global/page-toolbar.php');
  include locate_template('templates/single-content.php');
  include locate_template('templates/flex-content.php');

?>

<?php get_footer(); ?>