<?php

  $post_object = get_sub_field('donation_product', $post_object->ID);

  $temp = $wp_query;
  $wp_query = null;
  $wp_query = new WP_Query();
  $wp_query->query('p='.$post_object.'&post_type=product'); ?>


  <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
  <div id="donation-module">
  <?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
  </div>
  <p>We ask that you make donation of $25 or more. You may also make a contribution over the phone by calling 213.228.7500.</p>
  <?php endwhile; ?>

  <style>
    #donation-module .price {
      display: none;
    }
  </style>


<?php
  $wp_query = null;
  $wp_query = $temp;  // Reset
?>