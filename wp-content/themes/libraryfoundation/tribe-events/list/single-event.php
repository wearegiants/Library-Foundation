<?php
/**
* List View Single Event
* This file contains one event in the list view
*
* Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
*
* @package TribeEventsCalendar
*
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php

	$venue_details = array();

	if ( $venue_name = tribe_get_meta( 'tribe_event_venue_name' ) ) {
		$venue_details[] = $venue_name;
	}

	if ( $venue_address = tribe_get_meta( 'tribe_event_venue_address' ) ) {
		$venue_details[] = $venue_address;
	}
	$has_venue_address = ( $venue_address ) ? ' location' : '';

  $cost = tribe_get_cost();
	$organizer = tribe_get_organizer();

  if ( $cost == 'Free') {
    $cost = 0;
  } else {
    $cost = tribe_get_cost();
  }

?>

<?php

  if( tribe_get_end_date( null, false, 'Y-m-d H:i:s' ) < date( 'Y-m-d H:i:s' )) {

    //$ticketStatus = '<a id="event-status-button"  href="#" class="button disabled">This Event Has Passed</a>';
    $ticketStatus = '<a href="' . get_the_permalink( $id ) . '" class="button">This Event Has Passed</a>';

  } else {

  	//$ticketStatus = 'hello';
  	if (tribe_events_has_tickets()) {

      if ($cost>0) {
        $ticketStatus = '<a href="' . get_the_permalink( $id ) . '" class="button">Purchase Tickets</a>';
      } else {
        $ticketStatus = '<a href="' . get_the_permalink( $id ) . '" class="button">RSVP</a>';
      }

    }

    if(tribe_events_has_soldout()){

      //$soldoutimage = 'http://i.imgur.com/znE1JTm.png';
      //$ticketStatus = '<a id="event-status-button"  href="'.$soldoutimage.'" class="button closed">Full/Standby</a>';
      //$ticketStatus = '<a href="' . get_the_permalink( $id ) . '" class="button">Full/Standby</a>';

      if ($cost>0) {
        $ticketStatus = '<a href="' . get_the_permalink( $id ) . '" class="button">Sold Out</a>';
      } else {
        $ticketStatus = '<a href="' . get_the_permalink( $id ) . '" class="button">Full/Standby</a>';
      }

    }

  }

?>

<div class="desktop-12 tablet-6 mobile-3 meta">
	<?php
		$terms = wp_get_post_terms(get_the_ID(), 'tribe_events_cat');
		$count = count($terms);
		if ( $count > 0 ){
			foreach ( $terms as $term ) {
				echo '<a href="'. get_term_link($term->slug, 'tribe_events_cat') .'" class="cat_' . $term->slug . '">' . $term->name . '</a>';
			}
		}
	?>
  <hr class="hidden invisible">
  <?php
    $sd = tribe_get_start_date($post->ID, 'M j, Y');
    $st = tribe_get_start_time($post->ID, 'g:i a');
  ?>
	<?php echo $sd; ?>
</div>

<div class="desktop-8 tablet-4 mobile-3">
	<h3 class="title"><a href="<?php echo tribe_get_event_link() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
	<span class="date upper"><?php the_field('event_title'); ?></span>
</div>

<div class="ticket-status desktop-4 tablet-2 mobile-3 text-right">
	<?php echo $ticketStatus; ?>
</div>

<?php do_action( 'tribe_events_after_the_content' ) ?>
