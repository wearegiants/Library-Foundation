<?php $var1   = $_GET['category']; ?>
<?php $search = $_GET['search']; ?>
<?php // $dates  = $_GET['date']; ?>

<?php

  if (isset($_GET['category'])) {

    $param = 'category_name='.$var1;

  } elseif (isset($_GET['search'])) {

    $param = 's='.$search;

  }

  if (isset($_GET['date'])) {

    $dates  = $_GET['date'];

  } else {

    $dates  = '';

  }

?>

<?php

  //var_dump($dates);

  $today = date('Ymd');

  $args = array(

    'showposts'    => -1,
    'post_type'    => 'archive',
    'paged'        => $paged,
    's'            => $search,
    'category_name'=> $var1,

    'meta_query' => array(
      array(
        'key'     => 'event_date',
        'compare' => 'LIKE',
        'value'   => $dates,
      )
    ),

  );
  $temp = $wp_query;
  $wp_query = null;
  $wp_query = new WP_Query();
  $wp_query->query( $args, $param );
  $format = '';

?>

<div id="sized" class="newest row">

<?php if ( have_posts() ) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

  <?php

    //$var2 = $_GET['var2'];



    if ( in_category( 'aloud' )) {

      $category = 'aloud';
      $catlink  = 'category?=aloud';

    } elseif ( in_category( 'young-literati' )) {

      $category = 'young literari';
      $catlink  = 'category?=young-literai';

    } else {

      $category = '';

    }



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
      $link   = 'video';
      $class  = '';

      $images          = get_field('archive_gallery');
      $image_1         = $images[0];
      $thumb_url       = $image_1[url];

    }

?>

<div <?php post_class('item desktop-4 tablet-3 mobile-3 newest sizer-item'); ?>>
  <div class="thumb">
    <div class="info">
      <a href="<?php echo $catlink; ?>" class="category"><?php echo $category; ?></a>
      <span class="format"><?php echo $format; ?></span>
    </div>
    <?php

      if(has_post_format('video')){

        if ( has_post_thumbnail() ) {
          the_post_thumbnail( 'footer-module-image', array( 'class' => 'img-responsive' ) );
        } else {
          echo '<img class="img-responsive" src=' . $video_thumb_url . '>';
        }

      } elseif (has_post_format('audio')){

        if ( has_post_thumbnail() ) {
          the_post_thumbnail( 'footer-module-image', array( 'class' => 'img-responsive' ) );
        } else {
          echo '<img class="img-responsive" src="/assets/img/play.jpg">';
        }

      } elseif (has_post_format('gallery')){

        ?>

        <?php include locate_template('templates/event-gallery.php' );?>

        <?php


      } ?>
  </div>
  <div class="meta newest">
    <div class="wrapper">
      <h3 class="title"><a href="<?php echo $link; ?>" class="<?php echo $class; ?>" target="blank"><?php the_title(); ?></a></h3>
      <span class="time"><?php the_field('event_date'); ?></span>
    </div>
  </div>
</div>

<?php endwhile; else : ?>
  <div class="desktop-12">
    <p>
      <?php

      if (isset($_GET['category'])) {

      _e( 'Sorry, no posts in that category.' );

      } elseif (isset($_GET['search'])) {

      _e( 'Sorry, no posts matched your search criteria.' );

      }
      ?>
    </p>
    <a href="/media-archive" class="button">Go Back to the Media Archive</a>
  </div>
<?php endif; ?>


</div>

<?php
  $wp_query = null;
  $wp_query = $temp;  // Reset
?>