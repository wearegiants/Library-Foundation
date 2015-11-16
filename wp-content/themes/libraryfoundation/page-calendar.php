<?php Themewrangler::setup_page();get_header(/***Template Name: Calendar */); ?>

<div class="row">
<div class="desktop-12">

<?php 

  get_template_part('templates/page', 'header');
  get_template_part('templates/page', 'content');
  get_template_part('templates/events/event', 'list');
  echo '<hr>';

?>

</div>
</div>

<?php get_footer(); ?>