<hr class="invisible">
<hr class="invisible">
<hr class="invisible">
<hr class="invisible">
<hr class="invisible">
<hr class="invisible">
<hr class="invisible">
<hr class="invisible">
<hr class="invisible">
<hr class="invisible">

<div class="sl">
<div class="sl-wrapper row">
<div class="sl-item_wrap desktop-12 tablet-6 mobile-3">

<?php 

if( have_rows('featured_slider_bottom', 'options') ):
while ( have_rows('featured_slider_bottom', 'options') ) : the_row();

$post_object = get_sub_field('slide_post');
$post = $post_object;
setup_postdata( $post );

if ( has_post_thumbnail() ) {
  $thumb_id = get_post_thumbnail_id();
  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'header-bg', true);
  $thumb_url = $thumb_url_array[0];
} 

?>

  <div class="sl-item <!--sl-item_featured--> desktop-6 tablet-6 mobile-3 contained">
    <div class="sl-item_inner wrapper" style="background-image:url(<?php echo $thumb_url; ?>);">
      <a href="#">
        <h3 class="sl-title"><?php the_title(); ?></h3>
      </a>
    </div>
  </div>

<?php 

wp_reset_postdata();
endwhile; 
endif;

?>

</div>
</div>
</div>
