<?php

  $thumb_id = get_post_thumbnail_id();
  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'header-bg', true);
  $thumb_url = $thumb_url_array[0];

?>

<div class="cart-header">
  <div class="row">
    <div class="desktop-12">
      <h1 class="page-header-title">
        <?php the_title(); ?>
        <?php global $woocommerce; if ( sizeof( $woocommerce->cart->cart_contents) > 0 ) :?>
        <span class='buttons'>
          <a class="button outlined wc-backward" href="/calendar"><?php _e( 'Return to Calendar', 'woocommerce' ) ?></a>
          <a class="button outlined wc-backward" href="/membership"><?php _e( 'Return to Membership', 'woocommerce' ) ?></a>
        </span>
        <?php endif; ?>
      </h1>

    </div>
  </div>
</div>

