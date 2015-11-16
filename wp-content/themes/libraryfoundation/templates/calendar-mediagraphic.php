<?php 
  $temp = $wp_query; 
  $wp_query = null; 
  $wp_query = new WP_Query(); 
  $wp_query->query('p=2827&post_type=page'); 
?>

<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

<?php
  $thumb_id = get_post_thumbnail_id();
  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'header-bg', true);
  $thumb_url = $thumb_url_array[0];
?>

<div id="archive-graphic" style="background-image:url(<?php echo $thumb_url; ?>);">
  <div class="row">
    <div class="desktop-12 tablet-6 mobile-3">
      <h2 class="title"><?php the_title(); ?></h2>
      <div class="desc"><?php the_content(); ?></div>
      <a href="<?php the_permalink(); ?>" class="button">View More</a>
    </div>
  </div>
</div>

 <?php endwhile; ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp;  // Reset
?>