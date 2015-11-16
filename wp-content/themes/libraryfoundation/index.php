<?php Themewrangler::setup_page();get_header(); ?>

<?php get_template_part('templates/page', 'header'); ?>
<?php get_template_part('templates/global/page', 'toolbar'); ?>

<div class="row">
  <div class="desktop-7">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php include locate_template('templates/blog/blog-item.php' ); ?>
    <?php endwhile; endif; ?>

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

    <nav>
      <?php echo paginate_links( $links ); ?>
    </nav>
    
  </div>
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>