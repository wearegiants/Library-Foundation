<?php
  if( get_sub_field('background_image') ) {
    $image  = get_sub_field('background_image');
    $url    = $image['url'];
    $size   = 'header-bg';
    $bg     = $image['sizes'][ $size ];
    $mClass = ' has-bg';
  } else {
    $bg     = '';
    $mClass = ' no-bg';
  }
  if( get_sub_field('remove_overlay') ) { $nOverlay = ' overlayless'; }

?>

  <?php
  $temp = $wp_query;
  $wp_query = null;
  $wp_query = new WP_Query();
  $wp_query->query('p=3013&post_type=product'); ?>

<div class="complex membership-level<?php echo $mClass; echo $nOverlay;  ?>" style="background-image:url(<?php echo $bg;  ?>);">
  <div class="row">
    <div class="desktop-12">

    </div>
    <div class="desktop-6 tablet-6 mobile-3">
      <h2 class="member-level-title"><?php the_sub_field('title'); ?></h2>
      <?php the_sub_field('left_content'); ?>
    </div>
    <hr class="desktop-hide tablet-6 mobile-3 invisible">
    <div class="desktop-6 tablet-6 mobile-3">
      <?php the_sub_field('right_content'); ?>
      <?php if( get_sub_field('donation_module') ):?>
      <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
      <div id="donation-module">
      <?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
      </div>
      <p>We ask that you make donation of $25 or more. You may also make a contribution over the phone by calling 213.228.7500.</p>
      <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php
  $wp_query = null;
  $wp_query = $temp;  // Reset
?>