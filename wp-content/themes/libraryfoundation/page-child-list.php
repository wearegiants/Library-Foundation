<?php Themewrangler::setup_page();get_header(/***Template Name: Child List */); ?>

<?php

  get_template_part('templates/page', 'header-simple');

?>

<?php while (have_posts()) : the_post(); ?>

<div class="page-content">
  <div class="row">

    <div class="sizer-item desktop-7 tablet-4 mobile-3">
      <?php the_content(); ?>

      <?php
        $this_page_id=$wp_query->post->ID;
        $args = array(
          'posts_per_page' => -1,
          'post_type'      => 'page',
          'paged'          => $paged,
          'post_parent'    => $this_page_id
        );
        $temp = $wp_query;
        $wp_query = null;
        $wp_query = new WP_Query();
        $wp_query->query($args);

        while ($wp_query->have_posts()) : $wp_query->the_post();
      ?>

      <div class="child-page item row">
        <div class="desktop-3">
          <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) ); ?>
          </a>
        </div>
        <div class="desktop-9">
          <h2 class="title" style="margin-bottom:0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <p><?php echo excerpt('30'); ?></p>
          <a href="<?php the_permalink();?>" class="readmore">Read More</a>
        </div>
        <hr class="invisible">
      </div>

      <?php endwhile; ?>

      <nav>
          <?php previous_posts_link('&laquo; Newer') ?>
          <?php next_posts_link('Older &raquo;') ?>
      </nav>

      <?php
        $wp_query = null;
        $wp_query = $temp;  // Reset
      ?>

    </div><!-- Main Content-->

    <aside class="aside desktop-4 tablet-2 mobile-3 right">
      <?php if ( get_field('include_aside')) : ?>
      <?php the_field('aside'); ?>
      <?php endif; ?>
      <?php get_sidebar('simple'); ?>
    </aside>

  </div>
</div>

<?php

  var_dump($post->post_name);

?>

<?php endwhile; ?>

<?php get_footer(); ?>
