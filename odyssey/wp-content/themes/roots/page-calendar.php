<?php
/*
Template Name: Calendar
*/
?>

<?php while (have_posts()) : the_post(); ?>
<?php get_template_part('templates/page', 'header'); ?>

<div class="col-md-9 col-centered text-center">
<?php get_template_part('templates/content', 'page'); ?>
</div>

<?php endwhile; ?>

<?php if( have_rows('events_listing') ): while ( have_rows('events_listing') ) : the_row(); ?>

<?php
$image = get_sub_field('event_listing_image');
$date = "l, M d";
$time = "ga";
$datetime = get_sub_field('event_listing_datetime', $event['id']);
$size = 'calendar-rectangle';
$thumb = $image['sizes'][ $size ];

$format = "l, M d";
$timestamp = get_sub_field('event_listing_datetime');
?>

<div class="event clearfix row">
<div class="col-md-9 col-centered">
<div class="col-md-6"><a href="<?php the_sub_field('event_listing_link'); ?>"><img class="img-responsive" src="<?php echo $thumb; ?>"></a></div>
<div class="col-md-6 title">
	<h3 class="sub-title"><span><?php the_sub_field('event_listing_datetime_text'); ?></span> | <?php the_sub_field('event_listing_location'); ?></h3>
	<h2 class="title"><?php the_sub_field('event_listing_name'); ?></h2>
	<?php
	$values = get_sub_field('event_listing_link');
	  if($values) { ?>
	    <a class="rnd-button" href="<?php the_sub_field('event_listing_link'); ?>">More Information</a>
	  <?php } else { ?>
	    <a class="rnd-button disabled" href="#">Coming Soon</a>
	  <?php }
	?>
</div>
</div>

</div>

<?php endwhile; else : endif; ?>