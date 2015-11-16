<?php while (have_posts()) : the_post(); ?>

<div class="page-content">
  <div class="row">

    <div class="sizer-item desktop-7 tablet-4 mobile-3">
      <?php the_content(); ?>
      <?php get_template_part('templates/flex', 'content'); ?>
    </div><!-- Main Content-->

    <aside class="aside desktop-4 tablet-2 mobile-3 right">
      <?php if ( get_field('include_aside')) : ?>
      <?php the_field('aside'); ?>
      <?php endif; ?>
      <?php get_sidebar('simple'); ?>
    </aside>

  </div>
</div>

<?php endwhile; ?>
