<?php
/*
Template Name: Branches
*/
?>

<div class="container">
<div class="col-md-8 col-centered text-center">
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part('templates/page', 'header'); ?>
<?php get_template_part('templates/content', 'page'); ?>
</div>

<?php

// check if the repeater field has rows of data
if( have_rows('branches') ):

 	// loop through the rows of data
    while ( have_rows('branches') ) : the_row(); ?>

    <div class="item branch col-md-3 text-center">
      <a href="<?php the_sub_field('branch_link'); ?>">
        <img height="100" width="100" class="img-circle" src="<?php the_sub_field('branch_image'); ?>" alt="<?php the_sub_field('branch_name'); ?>" />
        <h4 style="min-height: 60px;"><?php the_sub_field('branch_name'); ?></h4>
      </a>
    </div>

    <?php endwhile;

else :

    // no rows found

endif;

?>

<?php endwhile; ?>
</div>
</div>