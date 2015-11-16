<?php
/*
Template Name: Essay
*/
?>

<div class="container">
<div class="col-md-8 col-centered essay">
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part('templates/page', 'header'); ?>
<?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
</div>
</div>