<?php
  $args = array(

    'showposts'    => 15,
    'post_type'    => 'archive',
    'paged'        => $paged,
    'meta_query'   => array(
      array(
        'key'      => 'media_featured_toggle',
        'value'    => '1',
        'compare'  => '=='
      )
    ),
  );
  $temp = $wp_query;
  $wp_query = null;
  $wp_query = new WP_Query();
  $wp_query->query($args);
  $format = '';
?>


<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

  <?php

    $category = get_the_category();
    $cat_name = $category[0]->cat_name;
    $catlink  = '/media-archive/category?category='.$cat_name;

    if (has_post_format('video')){

      $video            = get_field('archive:_video'); //Embed Code
      $video_url        = get_field('archive:_video', FALSE, FALSE); //URL
      $video_thumb_url  = get_video_thumbnail_uri($video_url); //get THumbnail via our functions in functions.php

      $format = 'video';
      $link   = $video_url;
      $class  = 'play popup-video';

    } elseif (has_post_format('audio')){

      $format = 'podcast';
      $link   =  get_field('archive_podcast');
      $class  = '';

    } elseif (has_post_format('gallery')){

      $format = 'gallery';
      $link   = '#';
      $class  = '';

      $images          = get_field('archive_gallery');
      $image_1         = $images[0];
      $thumb_url       = $image_1[url];

    }

?>

<div <?php post_class('item newest sticky'); ?>>
  <div class="thumb">
    <div class="info">
      <a href="<?php echo $catlink; ?>" class="category"><?php echo $cat_name; ?></a>
      <span class="format"><?php echo $format; ?></span>
    </div>
    <?php

      if(has_post_format('video')){

        echo '<a class="play popup-video" href="'.$link.'">';

        if ( has_post_thumbnail() ) {
          the_post_thumbnail( 'footer-module-image', array( 'class' => 'img-responsive' ) );
        } else {
          echo '<img class="img-responsive" src=' . $video_thumb_url . '>';
        }

        echo '</a>';

      } elseif (has_post_format('audio')){

        echo '<a href="'.$link.'">';

        if ( has_post_thumbnail() ) {
          the_post_thumbnail( 'footer-module-image', array( 'class' => 'img-responsive' ) );
        } else {
          echo '<img class="img-responsive" src="/assets/img/play.jpg">';
        }

        echo '</a>';

      } elseif (has_post_format('gallery')){

        ?>

        <?php include locate_template('templates/event-gallery.php' );?>

        <?php


      } ?>
  </div>
  <div class="meta newest">
    <div class="wrapper">
      <h3 class="title"><a href="<?php echo $link; ?>" class="<?php echo $class; ?>" target="blank"><?php the_title(); ?></a></h3>
      <!--<span class="posted time"><?php the_time('F jS, Y') ?></span>-->
      <span class="event  time"><?php the_field('event_date'); ?></span>
    </div>
  </div>
</div>

<?php endwhile; ?>

<?php
  $wp_query = null;
  $wp_query = $temp;  // Reset
?>