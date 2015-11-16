<?php Themewrangler::setup_page();get_header(); ?>

<?php

  get_template_part('templates/page', 'header');
  get_template_part('templates/page', 'content');
  get_template_part('templates/member', 'content');

?>

<?php get_footer(); ?>