<?php
/**
* List View Loop
* This file sets up the structure for the list loop
*
* Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/loop.php
*
* @package TribeEventsCalendar
*
*/

if ( ! defined( 'ABSPATH' ) ) {
die( '-1' );
} ?>

<?php
	global $more;
	$more = false;
?>

<div class="tribe-events-loop vcalendar">

<?php while ( have_posts() ) : the_post(); ?>
<?php do_action( 'tribe_events_inside_before_loop' ); ?>

<?php

  if ( has_post_thumbnail()) {

    // $thumb_id = get_post_thumbnail_id();
    // $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail', true);
    // $thumb_url = $thumb_url_array[0];
    // $event_bg  = $thumb_url;
    $terms = wp_get_post_terms(get_the_ID(), 'tribe_events_cat');
    $count = count($terms);

    if ( $count > 0 ){
      $i = 0;
      foreach ( $terms as $term ){
        if(++$i > 1) break;
        $eventCat = $term->slug;
      }
    }

    $event_bg = '/assets/img/headers/default-'.$eventCat.'.jpg';
    $noBg = '';

  }  else {

    $noBg = ' noimage';
    $terms = wp_get_post_terms(get_the_ID(), 'tribe_events_cat');
    $count = count($terms);

    // Here's where we'll get the slug for the current event category.
    // It only displays the first category slug -- but there shouldn't be a reason for more than one cat, right?

    if ( $count > 0 ){
      $i = 0;
      foreach ( $terms as $term ){
        if(++$i > 1) break;
        $eventCat = $term->slug;
      }
    }

    // Custom Category Header
    // Let's make sure to reuse this in other parts of the site, where applicable.
    // Probably the actual Event Category page.

    $event_bg = '/assets/img/headers/default-'.$eventCat.'.jpg';

  }

  $event_date = tribe_get_start_date($pageID, false, "l, M j, Y | g:ia");
  $venue_details = array();

  if ( $venue_name = tribe_get_meta( 'tribe_event_venue_name' ) ) {
    $venue_details[] = $venue_name;
  }


?>

<!--<div class="date-header">
	<div class="row">
		<div class="desktop-12">
			<?php tribe_events_list_the_date_headers(); ?>
		</div>
	</div>
</div>-->

<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?>">
	<div class="row">
		<?php tribe_get_template_part( 'list/single', 'event' ) ?>
	</div>
	<div class="bg<?php echo $noBg; ?>" style="background-image:url(<?php echo $event_bg; ?>);"></div>
</div>

<?php do_action( 'tribe_events_inside_after_loop' ); ?>
<?php endwhile; ?>

</div>
