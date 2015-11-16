<?php

  if ( has_post_thumbnail()) {

    $thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'header-bg', true);
    $thumb_url = $thumb_url_array[0];
    $event_bg  = $thumb_url;

    $small_id = get_post_thumbnail_id();
    $small_url_array = wp_get_attachment_image_src($small_id, 'thumbnail', true);
    $small_url = $small_url_array[0];
    $small_bg  = $small_url;

  }  else {

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

<?php if (!get_field('simple_header')) { ?>

<div class="page-header event" data-speed="2" style="background-image:url(<?php echo $event_bg; ?>);">
  <div class="row">
    <div class="desktop-12">
      <?php
        $terms = wp_get_post_terms(get_the_ID(), 'tribe_events_cat');
        $count = count($terms);
        if ( $count > 0 ){
          echo '<ul class="parent-links">';
          foreach ( $terms as $term ) {
            echo '<li><a href="'. get_term_link($term->slug, 'tribe_events_cat') .'" class="cat_' . $term->slug . '">' . $term->name . '</a></li>';
          }
          echo '</ul>';
        }
      ?>
      <h1 class="event-header-title"><?php the_title(); ?></h1>
    </div>
  </div>

  <div class="event-meta">
    <div class="row">
      <div class="max-8 desktop-6 tablet-6 mobile-3">
        <span class="date upper"><?php the_field('event_title'); ?></span><br>
        <span class="location lower"><?php the_field('event_subtitle'); ?></span>
      </div>
      <div class="max-4 desktop-5 tablet-6 mobile-3 text-right right">
        <span class="date upper"><?php echo $event_date  ?></span><br>
        <span class="location lower"><a href="<?php echo tribe_the_map_link(); ?>"><?php echo $venue_details[0]; ?></a></span>
      </div>
    </div>
  </div><!-- Event Meta-->
</div>

<?php } else { ?>

<div class="simple-header page-header event">
  <div class="row">
    <div class="desktop-12">
      <h1 class="page-header-title"><?php the_title(); ?></h1>
    </div>
  </div>
  <div class="event-meta">
    <div class="row">
      <div class="desktop-8">
        <span class="date upper"><?php the_field('event_title'); ?></span><br>
        <span class="location lower"><?php the_field('event_subtitle'); ?></span>
      </div>
      <div class="desktop-4 text-right">
        <span class="date upper"><?php echo $event_date  ?></span><br>
        <span class="location lower"><a href="<?php echo tribe_the_map_link(); ?>"><?php echo $venue_details[0]; ?></a></span>
      </div>
    </div>
  </div><!-- Event Meta-->
  <?php if (get_field('blurry_background')): ?>
  <?php if ( has_post_thumbnail() ): ?>
  <div class="simple-header--bg"><div class="inner" data-speed="2" style="background-image:url(<?php echo $small_bg; ?>);"></div></div>
  <?php endif; ?>
  <?php endif; ?>
</div>

<?php } ?>