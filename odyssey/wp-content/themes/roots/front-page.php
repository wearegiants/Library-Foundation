<div id="home">

<?php
// Get all the children of this page
$args = array(
'posts_per_page'   => -1,
'post_type'        => 'page',
'orderby'          => 'menu_order',
'order'            => 'ASC',
);
query_posts($args);
?>

<?php if (have_posts()) : ?>

<?php while (have_posts()) : the_post(); ?>

<?php
if( $post->ID == 8 ) {
 //Is Essay page
get_template_part('part-essay');

} elseif( $post->ID == 88 ) {
// If Description page
get_template_part('part-description');

} elseif( $post->ID == 12 ) {
//  If About page
get_template_part('part-calendar');

} elseif( $post->ID == 58 ) {
//  If About page
get_template_part('part-simpsons');

} elseif( $post->ID == 82 ) {
//  If About page
get_template_part('part-gallery');

} elseif( $post->ID == 166 ) {
//  If About page
// get_template_part('part-vase-gallery');

} elseif( $post->ID == 16 ) {
//  If Videos page
//get_template_part('part-map');

} elseif( $post->ID == 10 ) {
//  If Photos page
 get_template_part('part-reading');

} elseif( $post->ID == 34 ) {
//  If Photos page
 get_template_part('part-instagram');

} elseif( $post->ID == 434 ) {
//  If Photos page
 get_template_part('part-pullquote');

} elseif( $post->ID == 14 ) {
//  If Reviews page
get_template_part('part-about');

} elseif( $post->ID == 577 ) {
//  If Reviews page
get_template_part('part-map');

}


?>

<?php endwhile; ?>
<?php endif; ?>

</div>