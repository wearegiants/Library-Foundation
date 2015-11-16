<?php Themewrangler::setup_page();get_header(/***Template Name: Upcoming Events */); ?>

<?php get_template_part('templates/page', 'header-simple'); ?>
<?php get_template_part('templates/page', 'content'); ?>

<div class="tribe-events-list">

<?php
$args = array(
  'showposts'          => 9,
  'post_type'          => 'tribe_events',
  'tax_query' => array(
    array(
      'taxonomy' => 'tribe_events_cat',
      'field'    => 'slug',
      'terms'    => array('hidden'),
    ),
  ),
);

$temp = $wp_query;
$wp_query = null;
$wp_query = new WP_Query();
$wp_query->query($args);

while ($wp_query->have_posts()) : $wp_query->the_post();
?>

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

<?php endwhile; ?>

<?php
$wp_query = null;
$wp_query = $temp;  // Reset
?>

</div>
<?php get_footer(); ?>


