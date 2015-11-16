<?php

  $thumb_id         = get_post_thumbnail_id();
  $thumb_url_array  = wp_get_attachment_image_src($thumb_id, 'large', true);
  $video            = get_field('archive:_video'); //Embed Code
  $video_url        = get_field('archive:_video', FALSE, FALSE); //URL
  $video_thumb_url  = get_video_thumbnail_uri($video_url); //get THumbnail via our functions in functions.php
  $audio_url        = get_field('archive_podcast');
  $postcreatedate   = get_the_date('Y');
  //$category         = strip_tags(get_the_category_list('',', ',''));
  $itemsize         = 'desktop-4';
  $skeletonsize     = '700x450';
  $speakers         = get_field('speakers');
  $guests           = $speakers;
  $action           = '';
  $metainfo         = get_the_tag_list('',', ','');
  $formatTitle      =
  // Random Colors
  $input            = array("pink","blue","green","orange");
  $rand_keys        = array_rand($input, 2);

  $rando            = $input[$rand_keys[1]] . "\n";


  //$category = get_post_class($post->ID);

  // Conditionals

  if ( has_post_format( 'video' )) {

    $format         = 'video';
    $thumb_url      = $video_thumb_url;
    $action         = '<a href="'. $video_url .'" class="play popup-video"><i class="ss-icon ss-gizmo">play</i></a>';
    //$action         = '';
    $itemsize       = 'desktop-8';
    $skeletonsize   = '1400x900';
    $formatTitle    = $format . '/ ';
    $formatTitle    = 'video';

  } elseif ( has_post_format( 'gallery' )) {

    $format         = 'photo';
    $images         = get_field('archive_gallery');
    $image_1        = $images[0];
    $thumb_url      = $image_1[url];
    $formatTitle    = 'gallery';


  } elseif ( has_post_format( 'quote' )) {

    $format         = 'ellipsischat';
    $thumb_url      = $thumb_url_array[0];
    $itemsize       = 'desktop-12';
    $skeletonsize   = '1400x500';
    $formatTitle    = 'quote';

  } elseif ( has_post_format( 'audio' )) {

    $format         = 'audio';
    $thumb_url      = $thumb_url_array[0];
    //$action         = '<a href="'. $audio_url .'" class="play" target="blank"><i class="ss-icon ss-gizmo">play</i></a>';
    $action         = '';
    $formatTitle    = 'podcast';

  } else {

    $format         = 'user';
    $guests         = get_the_title();
    $thumb_url      = $thumb_url_array[0];
    $metainfo       = '';
    $postcreatedate = '';
    $category       = '';
    $itemsize       = 'desktop-4';
    $skeletonsize   = '700x899';
    $formatTitle    = 'people';

  }

?>

<?php if(  has_post_format( 'gallery' )){ ?>

<div <?php post_class('item gallery-item desktop-4 tablet-3 contained ' . "$format"); ?>>

  <span class="icon"><i class="ss-icon ss-glyphish"><?php echo $format; ?></i></span>

  <div class="meta">
    <span class="cat"><?php echo $formatTitle; echo $category; echo ' / '; echo $postcreatedate; ?></span>
    <h2 class="title"><?php echo $guests; ?></h2>
    <span class="cat"><?php echo $metainfo; ?></span>
  </div>

  <?php include locate_template('templates/event-gallery.php' );?>

</div>

<?php } else { ?>

<div <?php post_class('item non-gallery contained ' . " " . "$itemsize" . " " . "$format" . " " . "$format" . " " . "$rando"); ?>>

  <?php if( get_post_type() == 'people' ): ?>
  <div class="description">
    <?php the_content(); ?>
  </div>
  <?php endif; ?>

  <span class="icon"><i class="ss-icon ss-glyphish"><?php echo $format; ?></i></span>

  <?php if ( has_post_format( 'quote' )): ?>
  <div class="quote-text">
    <div class="row">
      <div class="desktop-8 tablet-5 mobile-3 centered">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <div class="meta">
    <span class="cat"><?php echo $formatTitle; echo $category; echo ' / '; echo $postcreatedate; ?></span>
    <?php if ( has_post_format( 'audio' )): ?>
    <h2 class="title"><a href="<?php echo $audio_url; ?>" target="blank"><?php echo $guests; ?></a></h2>
    <?php else: ?>
    <h2 class="title"><?php echo $guests; ?></h2>
    <?php endif; ?>
    <span class="cat"><?php echo $metainfo; ?></span>
  </div>

  <?php echo $action; ?>

  <?php if ( has_post_format( 'quote' )) { } else { ?>
  <div class="thumbnail" style="background-image: url(<?php echo $thumb_url;?> );"></div>
  <div class="skeleton"><img src="http://placehold.it/<?php echo $skeletonsize; ?>" class="img-responsive" /></div>
  <?php } ?>
</div>
<?php } ?>