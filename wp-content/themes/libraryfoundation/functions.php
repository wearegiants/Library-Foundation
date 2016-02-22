<?php

require_once locate_template('/lib/blankslate.php');
require_once locate_template('/lib/themewrangler.class.php');
require_once locate_template('/lib/slug.php' );
require_once locate_template('/lib/cleanassnav.php' );
include_once locate_template('/lib/soil-master/soil.php' );
include_once locate_template('/lib/custom-post-types.php' );
include_once locate_template('/lib/enque-js.php' );
include_once locate_template('/lib/woo-disablebilling.php' );
include_once locate_template('/lib/miles.php' );
include_once locate_template('/lib/woo-confirmations.php' );
include_once locate_template('/lib/videoembed.php' );
//include_once locate_template('/lib/woo-ajax.php' );

// ACF Includes Nonsense

add_filter('acf/settings/path', 'my_acf_settings_path');
function my_acf_settings_path( $path ) {
  $path = get_stylesheet_directory() . '/lib/advanced-custom-fields-pro/';
  return $path;
}

add_filter('acf/settings/dir', 'my_acf_settings_dir');
function my_acf_settings_dir( $dir ) {
 $dir = get_stylesheet_directory_uri() . '/lib/advanced-custom-fields-pro/';
 return $dir;
}

include_once locate_template('/lib/advanced-custom-fields-pro/acf.php' );
//include_once locate_template('/lib/acf-field-date-time-picker/acf-date_time_picker.php' );

include_once locate_template('/lib/soil-master/soil.php' );
include_once locate_template('/lib/roots-rewrites-master/roots-rewrites.php' );
include_once locate_template('/lib/opengraph/opengraph.php' );

add_theme_support('soil-relative-urls');
add_theme_support('soil-nice-search');
add_theme_support('soil-clean-up');
add_theme_support( 'woocommerce' );

add_filter( 'woocommerce_enqueue_styles', 'jk_dequeue_styles' );
function jk_dequeue_styles( $enqueue_styles ) {
  unset( $enqueue_styles['woocommerce-general'] );  // Remove the gloss
  //unset( $enqueue_styles['woocommerce-layout'] );   // Remove the layout
  unset( $enqueue_styles['woocommerce-smallscreen'] );  // Remove the smallscreen optimisation
  return $enqueue_styles;
}

// Or just remove them all in one line
//add_filter( 'woocommerce_enqueue_styles', '__return_false' );


//define( 'ACF_LITE', true );

$settings = array(

  'available_scripts' => array(
    'jquery-g'          => array('//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js','1.11.1'),
    'scripts'           => array('/assets/javascripts/scripts.min.js'),
    'new_scripts'       => array('/assets/js/new_main.min.js'),
    'new_vendor'        => array('/assets/js/new_vendor.min.js'),
    ),

  'default_scripts'   => array(
    'scripts'),

  'available_stylesheets' => array(
    'default'           => array('/assets/css/main.css'),
    'new_default'       => array('/assets/css/new_main.min.css'),
    ),

  'default_stylesheets' => array(
    'default'
    ),

  'deregister_scripts' => array('jquery','l10n')
  );

if(function_exists("acf_add_options_page")) {
  acf_add_options_page();
}

if(function_exists("register_options_page")) {
  register_options_page('Site Options');
  register_options_page('Calendar Options');
  register_options_page('Aloud Options');
}

Themewrangler::set_defaults( $settings );


function wcs_redirect_product_based ( $order_id ){
  $order = wc_get_order( $order_id );

  foreach( $order->get_items() as $item ) {
    $_product = wc_get_product( $item['product_id'] );
    // Add whatever product id you want below here
    if ( $item['product_id'] == 52 ) {
      // change below to the URL that you want to send your customer to
      include locate_template('templates/thanks.php' );
    }
  }
}
add_action( 'woocommerce_thankyou', 'wcs_redirect_product_based' );


/**
 * Optimize WooCommerce Scripts
 * Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
 */
add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );

function child_manage_woocommerce_styles() {
  //remove generator meta tag
  remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

  //first check that woo exists to prevent fatal errors
  if ( function_exists( 'is_woocommerce' ) ) {
    //dequeue scripts and styles
    if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
      wp_dequeue_style( 'woocommerce_frontend_styles' );
      wp_dequeue_style( 'woocommerce_fancybox_styles' );
      wp_dequeue_style( 'woocommerce_chosen_styles' );
      wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
      wp_dequeue_script( 'wc_price_slider' );
      wp_dequeue_script( 'wc-single-product' );
      wp_dequeue_script( 'wc-add-to-cart' );
      wp_dequeue_script( 'wc-cart-fragments' );
      wp_dequeue_script( 'wc-checkout' );
      wp_dequeue_script( 'wc-add-to-cart-variation' );
      wp_dequeue_script( 'wc-single-product' );
      wp_dequeue_script( 'wc-cart' );
      wp_dequeue_script( 'wc-chosen' );
      wp_dequeue_script( 'woocommerce' );
      wp_dequeue_script( 'prettyPhoto' );
      wp_dequeue_script( 'prettyPhoto-init' );
      wp_dequeue_script( 'jquery-blockui' );
      wp_dequeue_script( 'jquery-placeholder' );
      wp_dequeue_script( 'fancybox' );
      wp_dequeue_script( 'jqueryui' );
    }
  }

}


@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );