<?php
/**
 * List View Content Template
 * The content template for the list view. This template is also used for
 * the response that is returned on list view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/content.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<div id="tribe-events-content" class="tribe-events-list">

	<!-- List Title -->
	<?php do_action( 'tribe_events_before_the_title' ); ?>
	<!--<div class="header">
		<div class="row">
			<div class="desktop-8">
				<span class="tribe-events-page-title"><?php echo tribe_get_events_title() ?></span>
			</div>
		</div>
	</div>-->
	<?php do_action( 'tribe_events_after_the_title' ); ?>

	<!-- Notices -->

	<div class="row">
		<div class="desktop-12">
			<?php if ( have_posts() ) : ?>
			<?php echo tribe_events_the_notices(); ?>
			<?php endif; ?>
		</div>
	</div>

  <div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
    <?php do_action( 'tribe_events_before_header_nav' ); ?>
    <?php tribe_get_template_part( 'list/nav', 'header' ); ?>
    <?php do_action( 'tribe_events_after_header_nav' ); ?>
  </div>

	<!-- Events Loop -->
	<?php if ( have_posts() ) : ?>

		<?php do_action( 'tribe_events_before_loop' ); ?>
		<?php tribe_get_template_part( 'list/loop' ) ?>
		<?php do_action( 'tribe_events_after_loop' ); ?>

	<?php else: ?>

    <?php

    $cat = get_query_var( 'tribe_events_cat');

    $old_args = array(
    'post_type'     => 'tribe_events',
    'posts_per_page'=> -1,
    'order'          => 'DESC',
    'tax_query'     => array(
      array(
        'taxonomy' => 'tribe_events_cat',
        'field'    => 'slug',
        'terms'    => $cat,
      ),
    ),
    'eventDisplay' => 'all',
    'meta_query'   => array(
        array(
          'key'      => '_EventStartDate',
          'value'    => date('Y-m-d'),
          'compare'  => '<'
        )
      ),
    'eventDisplay' => 'all',
    );

    $old_temp = $old_wp_query;
    $old_wp_query = null;
    $old_wp_query = new WP_Query();
    $old_wp_query->query($old_args);
    ?>

    <header class="past-events">
      <div class="row">
        <div class="desktop-12">
          <h2 class="title">Sorry, no upcoming events. Check out some past events.</h2>
        </div>
      </div>
    </header>

    <div class="tribe-events-list">

    <?php $counter = 1; while ($old_wp_query->have_posts()) : $old_wp_query->the_post();?>
    <?php

      if ( has_post_thumbnail()) {

      $thumb_id = get_post_thumbnail_id();
      $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'header-bg', true);
      $thumb_url = $thumb_url_array[0];
      $event_bg  = $thumb_url;

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

    ?>

    <div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?>">
      <div class="row">
        <?php tribe_get_template_part( 'list/single', 'event' ) ?>
      </div>
      <div class="bg <?php echo $noBg; ?>" style="background-image:url(<?php echo $event_bg; ?>);"></div>
    </div>
    <?php $counter++; endwhile; ?>
    <?php $old_wp_query = null; $old_wp_query = $old_temp; wp_reset_postdata(); ?>

    </div>


	<?php endif; ?>

	<!-- List Footer -->
	<?php do_action( 'tribe_events_before_footer' ); ?>
	<div id="tribe-events-footer">

		<!-- Footer Navigation -->
		<?php do_action( 'tribe_events_before_footer_nav' ); ?>
		<?php tribe_get_template_part( 'list/nav', 'footer' ); ?>
		<?php do_action( 'tribe_events_after_footer_nav' ); ?>

	</div>
	<!-- #tribe-events-footer -->
	<?php //do_action( 'tribe_events_after_footer' ) ?>

</div><!-- #tribe-events-content -->
