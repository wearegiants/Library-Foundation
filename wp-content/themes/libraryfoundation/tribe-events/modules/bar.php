<?php
/**
 * Events Navigation Bar Module Template
 * Renders our events navigation bar used across our views
 *
 * $filters and $views variables are loaded in and coming from
 * the show funcion in: lib/tribe-events-bar.class.php
 *
 * @package TribeEventsCalendar
 *
 */
?>

<?php

$filters = tribe_events_get_filters();
$views   = tribe_events_get_views();

global $wp;
$current_url = esc_url( add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );

?>

<div class="row">
	<div class="desktop-hide tablet-hide mobile-3">
		<a id="search-events-mobile"><i class="ss-icon ss-gizmo">search</i> Find Events</a>
	</div>
</div>

<?php get_template_part('templates/global/page', 'toolbar' );?>

<?php do_action( 'tribe_events_bar_before_template' ) ?>

<div id="event-bar" class="event-page">
	<div class="row">
	  <form id="tribe-bar-form" class="tribe-clearfix" name="tribe-bar-form" method="post" action="<?php echo esc_attr( $current_url ); ?>">
	    <?php  //Views ?>
	    <?php if ( count( $views ) > 1 ) { ?>
	      <div id="tribe-bar-views">
	        <div class="tribe-bar-views-inner tribe-clearfix">
	          <h3 class="tribe-events-visuallyhidden"><?php _e( 'Event Views Navigation', 'tribe-events-calendar' ) ?></h3>
	          <label><?php _e( 'View As', 'tribe-events-calendar' ); ?></label>
	          <select class="tribe-bar-views-select tribe-no-param" name="tribe-bar-view">
	            <?php foreach ( $views as $view ) : ?>
	              <option <?php echo tribe_is_view( $view['displaying'] ) ? 'selected' : 'tribe-inactive' ?> value="<?php echo $view['url'] ?>" data-view="<?php echo $view['displaying'] ?>">
	                <?php echo $view['anchor'] ?>
	              </option>
	            <?php endforeach; ?>
	          </select>
	        </div>
	      </div>
	    <?php } // if ( count( $views ) > 1 ) ?>
	    <?php if ( ! empty( $filters ) ) { ?>
	      <div class="tribe-bar-filters max-5 desktop-8 tablet-6 mobile-3">

	        <div class="tribe-bar-filters-inner tribe-clearfix row ss-glyphish ss-calendar row">
	        	<span class="icon-holder"><i class="ss-glyphish ss-calendar"></i></span>
	          <?php foreach ( $filters as $filter ) : ?>
	            <div class="desktop-4 tablet-2 mobile-3 <?php echo esc_attr( $filter['name'] ) ?>-filter">
	              <!--<label class="label-<?php echo esc_attr( $filter['name'] ) ?>" for="<?php echo esc_attr( $filter['name'] ) ?>"><?php echo $filter['caption'] ?></label>-->
	              <?php echo $filter['html'] ?>
	            </div>
	          <?php endforeach; ?>
	          <div class="desktop-4 tribe-bar-submit text-right">
	            <input class="tribe-events-button tribe-no-param button ss-glyphish ss-calendar" type="submit" name="submit-bar" value="<?php _e( 'Find Events', 'tribe-events-calendar' ) ?>" />
	          </div>
	        </div>
	      </div>

				<?php if ( is_tax( 'tribe_events_cat', 'aloud' ) ) : ?>
				<div class="social tribe-bar-filters desktop-4 tablet-6 mobile-3 right text-right">
					<span class="button no-border">Follow Us</span>
					<a target="blank" href="https://facebook.com/aloudla"><i class="ss-icon ss-social-circle">Facebook</i></a>
					<a target="blank" href="https://twitter.com/aloudla"><i class="ss-icon ss-social-circle">Twitter</i></a>
					<a target="blank" href="https://instagram.com/aloudla"><i class="ss-icon ss-social-circle">Instagram</i></a>
					<a target="blank" href="https://vimeo.com/channels/aloud"><i class="ss-icon ss-social-circle">Vimeo</i></a>
				</div>
				<?php endif; ?>

				<?php if ( is_tax( 'tribe_events_cat', 'young-literati' ) ) : ?>
				<div class="social tribe-bar-filters desktop-4 tablet-6 mobile-3 right text-right">
					<span class="button no-border">Follow Us</span>
					<a target="blank" href="https://www.facebook.com/LibraryFoundLA"><i class="ss-icon ss-social-circle">Facebook</i></a>
					<a target="blank" href="https://twitter.com/LibraryFoundLA"><i class="ss-icon ss-social-circle">Twitter</i></a>
				</div>
				<?php endif; ?>

				<?php if ( is_tax( 'tribe_events_cat', 'library-store-on-wheels' ) ) : ?>
				<div class="social tribe-bar-filters desktop-4 tablet-6 mobile-3 right text-right">
					<span class="button no-border">Follow Us</span>
					<a target="blank" href="https://facebook.com/Thelibrarystore"><i class="ss-icon ss-social-circle">Facebook</i></a>
					<a target="blank" href="https://twitter.com/Thelibrarystore"><i class="ss-icon ss-social-circle">Twitter</i></a>
					<a target="blank" href="https://instagram.com/libraryfoundla"><i class="ss-icon ss-social-circle">Instagram</i></a>
				</div>
				<?php endif; ?>

	    <?php } // if ( !empty( $filters ) ) ?>
	  </form>
	</div>
</div>

<script>
	$("#toolbar .nav li a").each(function() {
   var _href = $(this).attr("href");
   $(this).attr("href", _href + '?calendar=true');
	});
</script>

<?php do_action( 'tribe_events_bar_after_template' ) ?>
