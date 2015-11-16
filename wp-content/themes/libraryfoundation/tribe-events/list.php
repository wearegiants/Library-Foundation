<?php
/**
 * List View Template
 * The wrapper template for a list of events. This includes the Past Events and Upcoming Events views
 * as well as those same views filtered to a specific category.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
  tribe_events_the_header_attributes();
} ?>

<?php



  do_action( 'tribe_events_before_template' );
  include locate_template('templates/calendar-header.php');
  get_template_part('templates/calendar', 'content');
  get_template_part('templates/flex', 'content');
  tribe_get_template_part( 'modules/bar' );
  tribe_get_template_part( 'list/content' );
  do_action( 'tribe_events_after_template' );

  //include locate_template('templates/calendar-faq.php');
  //include locate_template('templates/calendar-sponsors.php');

?>
