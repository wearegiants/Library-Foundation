<?php

  add_action( 'wp_ajax_add_foobar', 'prefix_ajax_add_foobar' );
add_action( 'wp_ajax_nopriv_add_foobar', 'prefix_ajax_add_foobar' );

function prefix_ajax_add_foobar() {
   $product_id  = intval( $_POST['product_id'] );
// add code the add the product to your cart
die();
}