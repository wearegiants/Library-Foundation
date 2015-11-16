<?php Themewrangler::setup_page();get_header(); ?>

<?php get_template_part('templates/page', 'header'); ?>
<?php get_template_part('templates/global/page', 'toolbar'); ?>

<div class="row">
  <div class="desktop-7">

    <?php
      $args = array(
        'posts_per_page' => 10,
        'post_type'     => 'post',
        'paged'          => $paged
      );
      $temp = $wp_query;
      $wp_query = null;
      $wp_query = new WP_Query();
      $wp_query->query($args);

      while ($wp_query->have_posts()) : $wp_query->the_post();
    ?>

    <?php include locate_template('templates/blog/blog-item.php' ); ?>

    <?php endwhile; ?>

    <?php $args = array(
      'base'               => '%_%',
      'format'             => '?page=%#%',
      'total'              => 1,
      'current'            => 0,
      'show_all'           => False,
      'end_size'           => 1,
      'mid_size'           => 2,
      'prev_next'          => True,
      'prev_text'          => __('« Previous'),
      'next_text'          => __('Next »'),
      'type'               => 'plain',
      'add_args'           => False,
      'add_fragment'       => '',
      'before_page_number' => '',
      'after_page_number'  => ''
    ); ?>

    <nav class="pagination">
      <?php echo paginate_links( $links ); ?>
    </nav>

    <?php
      $wp_query = null;
      $wp_query = $temp;  // Reset
    ?>

  </div>
  <hr class="desktop-hide tablet-6 mobile-3 invisible"/>
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>