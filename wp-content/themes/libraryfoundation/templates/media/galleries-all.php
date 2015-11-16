<?php

  $args = array(
    'showposts'   => -1,
    'post_type'   => 'archive',
    'tax_query'  => array(
      array(
        'taxonomy' => 'post_format',
        'field'    => 'slug',
        'terms'    => array( 'post-format-gallery' ),
      )
    )
  );

  $temp = $wp_query;
  $wp_query = null;
  $wp_query = new WP_Query();
  $wp_query->query($args);
?>

<div id="sized" class="content row">

<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

<?php

  $video            = get_field('archive:_video'); //Embed Code
  $video_url        = get_field('archive:_video', FALSE, FALSE); //URL
  $video_thumb_url  = get_video_thumbnail_uri($video_url); //get THumbnail via our functions in functions.php

  if (has_category( 'aloud' )){
    $category = 'aloud';
  }

  $images          = get_field('archive_gallery');
  $image_1         = $images[0];
  $thumb_url       = $image_1[url];

?>

<div <?php post_class('item gallery sizer-item desktop-4 tablet-3 mobile-3'); ?>>
  <div class="thumb">
    <div class="info">
      <a href="#" class="category"><?php echo $category; ?></a>
    </div>

    <?php include locate_template('templates/event-gallery.php' );?>

  </div>
  <div class="meta photo">
    <div class="wrapper">
      <h3 class="title"><a href=""><?php the_title(); ?></a></h3>
    </div>
  </div>
</div>

<?php endwhile; ?>

</div>

<?php
  $wp_query = null;
  $wp_query = $temp;  // Reset
?>