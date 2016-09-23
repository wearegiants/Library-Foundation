<?php 
	$video_field = get_field('video_url');
	$podcast_field = get_field('podcast_url');
  $video_field_embed = get_field('iframe');
  $gallery_field = get_field('gallery');
  $date = get_field('date');
  $date = date("F j, Y",strtotime($date));
	
	if ($video_field || $video_field_embed) {
		$type = 'Video | ';
	}

	if ($podcast_field) {
		$type = 'Podcast | ';
	}

  if ($gallery_field) {
    $type = '';
  }
	
  $title  = get_the_title();
  $pieces = explode(" | ", $title);
  $boom = explode(" / ", $title);
  #echo $pieces[0]; // piece1
  #echo $pieces[1]; // piece2

  if (strpos($title, ' | ') !== false) {
    $theTitle = $pieces[1];
  } else {
    $theTitle = get_the_title();
  }
  if (strpos($title, ' / ') !== false) {
    $theTitle = $boom[0];
  } else {
    $theTitle = get_the_title();
  }
  $thumb_id = get_post_thumbnail_id();
  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'footer-module-image', true);
  $thumb_url = $thumb_url_array[0];
?>

<div class="archive-item archive-item--all">
	<div class="fs-row">
		<div class="fs-cell fs-lg-half fs-md-half fs-sm-3">
			<a href="<?php the_permalink(); ?>" class="archive-item__thumb archive-item__thumb--all bg--bgGray wallpaper" data-background-options='{"source":"<?php echo do_shortcode('[featured_image size="gallery-md"]'); ?>" }'></a>
		</div>
		<div class="fs-cell fs-lg-half fs-md-half fs-sm-3">
			<div class="archive-item__date archive-item__date--all"><?php echo $type; ?><?php echo $date; ?></div>
			<h2 class="archive-item__title archive-item__title--all"><a href="<?php the_permalink(); ?>"><?php echo $theTitle; ?></a></h2>
			<h4 class="archive-item__subtitle archive-item__subtitle--all"><?php the_field('speakers'); ?></h4>
			<?php echo excerpt(20); ?>
		</div>
	</div>
	<hr class="divider">
</div>