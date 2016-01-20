<div style="display:none;">
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
</div>

<hr class="invisible">

<div class="sl">
  <div class="sl-wrapper row">
    <div class="sl-item_wrap desktop-12 tablet-6 mobile-3">
      <div class="sl-item module min-height sl-item_featured desktop-6 tablet-6 mobile-3 contained">
        <div class="carousel">

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

        <div class="slider">
          <div class="sl-item_inner wrapper">
            <a href="#">
              <span class="special-project_link module-sublink color-white">SPOTLIGHT</span>
              <br>
              <br>
              <h3 class="sl-title module-headline color-white margin-none"><?php echo strtoupper(get_the_title()); ?></h3>
              <span class="special-project_link module-sublink color-white">VIEW MORE</span>
            </a>
          </div>
          <div class="covered overlayed bg" style="background-image:url(<?php echo $thumb_url; ?>);"></div>
        </div>

<?php 

  wp_reset_postdata();
  endwhile; 
  endif;

?>
        </div>
      </div>
    </div>
  </div>
</div>
