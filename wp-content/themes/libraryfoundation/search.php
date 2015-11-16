<?php Themewrangler::setup_page();get_header(); ?>

<?php if ( have_posts() ) : ?>

<?php
  $input     = array("1","2","3","4","5","6","7");
  $rand_keys = array_rand($input, 2);
  $bgImg     = $input[$rand_keys[1]];
?>

<div class="simple-header" data-speed="1.25" style="background-image:url(<?php echo '/assets/img/bg/'; echo $bgImg; echo '.jpg' ?>);">
  <div class="row">
    <div class="desktop-12">
      <h1 class="page-header-title"><?php printf( __( 'Search Results for: %s', 'blankslate' ), get_search_query() ); ?></h1>
    </div>
  </div>
</div>
<?php endif; ?>

<div class="page-content">
  <div class="row">
    <div class="desktop-7">
      <?php while ( have_posts() ) : the_post(); ?>
      <div class="search-item hentry">
        <div class="row">

          <?php
            if ( has_post_thumbnail() ) {
              $width = 'desktop-9 tablet-5 mobile-3';
            } else {
              $width = 'desktop-12 tablet-6 mobile-3';
            }
          ?>

          <?php if ( has_post_thumbnail() ): ?>
          <div class="desktop-3 tablet-1 mobile-hide">
            <a href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'img-responsive' ) ); ?>
            </a>
          </div>
          <?php endif; ?>

          <div class="<?php echo $width; ?>">
            <span class="post-type"><?php $post_type = get_post_type_object( get_post_type($post) ); echo $post_type->label ; ?></span>
            <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p><?php echo excerpt(15); ?></p>
          </div>
          <hr class="desktop-12" style="background:#eee">
        </div>
      </div>
      <?php endwhile; ?>
    </div>
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>