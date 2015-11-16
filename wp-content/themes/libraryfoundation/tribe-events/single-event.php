<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$event_id = get_the_ID();

?>

<?php

  include locate_template('templates/event-header.php');
  include locate_template('templates/event-bar.php');
  include locate_template('templates/event-content.php');
  include locate_template('templates/flex-content.php');

  echo '<div id="sponsor-hat"></div>';

  //if( is_tax( 'tribe_events_cat', 'aloud' )) {
  if( has_term( 'aloud', 'tribe_events_cat' ) ) {

    include locate_template('templates/events/event-faq.php');
    include locate_template('templates/events/event-sponsors.php');

  } else {

    include locate_template('templates/events/event-sponsors.php');
    include locate_template('templates/events/event-faq.php');

  }


?>
