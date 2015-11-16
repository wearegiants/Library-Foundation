<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more($more) {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

/**
 * Manage output of wp_title()
 */
function roots_wp_title($title) {
  if (is_feed()) {
    return $title;
  }

  $title .= get_bloginfo('name');

  return $title;
}
add_filter('wp_title', 'roots_wp_title', 10);


include_once locate_template('/lib/advanced-custom-fields/acf.php' );  // ACF
include_once locate_template('/lib/acf-options-page/acf-options-page.php' );  // ACF
include_once locate_template('/lib/acf-gallery/acf-gallery.php' );     // ACF Gallery 
include_once locate_template('/lib/acf-repeater/acf-repeater.php' );     // ACF Gallery 
include_once locate_template('/lib/acf-field-date-time-picker/acf-date_time_picker.php' );     // ACF Gallery 
include_once locate_template('/lib/acf-flexible-content/acf-flexible-content.php' );     // ACF Flex Content 

function removeRecentComments() {  
global $wp_widget_factory;  
remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
}  

add_action( 'widgets_init', 'removeRecentComments' );
add_filter('show_admin_bar', '__return_false');

remove_action ('wp_head', 'rsd_link');

remove_action( 'wp_head', 'wp_shortlink_wp_head');
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version

add_filter( 'index_rel_link', 'disable_stuff' );
add_filter( 'parent_post_rel_link', 'disable_stuff' );
add_filter( 'start_post_rel_link', 'disable_stuff' );
add_filter( 'previous_post_rel_link', 'disable_stuff' );
add_filter( 'next_post_rel_link', 'disable_stuff' );

function disable_stuff( $data ) {
	return false;
}

//Page Slug Body Class

function add_slug_body_class( $classes ) {
global $post;
if ( isset( $post ) ) {
$classes[] = $post->post_type . '-' . $post->post_name;
}
return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );


register_nav_menus(
array( 'social-menu' => __( 'Social Menu' ) )
);

add_image_size( 'recommended-reading', 467, 700, true );
add_image_size( 'calendar-thumbnail', 80, 80, true );
add_image_size( 'calendar-square', 800, 800, true );
add_image_size( 'calendar-square-alt', 800, 400, true );
add_image_size( 'calendar-rectangle', 640, 480, true );