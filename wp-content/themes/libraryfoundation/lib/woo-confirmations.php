<?php

add_filter('woocommerce_email_order_meta_keys', 'my_woocommerce_email_order_meta_keys');

function my_woocommerce_email_order_meta_keys( $keys ) {
  $keys['How did you hear about us?'] = 'hear_about_us';
  return $keys;
}