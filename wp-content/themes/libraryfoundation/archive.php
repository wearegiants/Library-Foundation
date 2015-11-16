<?php Themewrangler::setup_page();get_header(); ?>

<?php
  $input     = array("1","2","3","4","5","6","7");
  $rand_keys = array_rand($input, 2);
  $bgImg     = $input[$rand_keys[1]];
?>


<div class="simple-header" data-speed="1.25" style="background-image:url(<?php echo '/assets/img/bg/'; echo $bgImg; echo '.jpg' ?>);">
  <div class="row">
    <div class="desktop-12">
      <h1 class="page-header-title"><a href="/blog"><?php echo get_the_title(442); ?></a><span class="page-header-sub-title"> / <?php 
      if ( is_day() ) { printf( __( 'Daily Archives: %s', 'blankslate' ), get_the_time( get_option( 'date_format' ) ) ); }
      elseif ( is_month() ) { printf( __( 'Monthly Archives: %s', 'blankslate' ), get_the_time( 'F Y' ) ); }
      elseif ( is_year() ) { printf( __( 'Yearly Archives: %s', 'blankslate' ), get_the_time( 'Y' ) ); }
      else { _e( 'Archives', 'blankslate' ); }
      ?>
      </span></h1>
      
    </div>
  </div>
</div>

<hr>

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

    <nav class="cd-pagination no-space">
      <?php echo paginate_links( $links ); ?>
    </nav>
    
  </div>
  <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>