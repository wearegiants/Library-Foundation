<?php

  if( is_tax()){
    $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
    $yolo = '<span class="category category-' . $term->slug . '">' . $term->name . '</span>';
    $query = array(
        'taxonomy' => 'tribe_events_cat',
        'field'    => 'slug',
        'terms'    => $term->slug,
      );
  }

  $args = array(
    'post_type' => 'tribe_events',
    'posts_per_page'=> -1,
    'tax_query' => array(
        array($query),
        array(
          'taxonomy' => 'tribe_events_cat',
          'field'    => 'slug',
          'terms'    => 'featured',
        ),
      ),
  );

  $temp = $wp_query;
  $wp_query = null;
  $wp_query = new WP_Query();
  $wp_query->query($args);

?>

<?php if ( $wp_query->have_posts()): ?>
<div id="calendar-header">
  <div class="header overlay bottom">
    <div class="row">
      <div class="desktop-12">
        <h1 class="title">Calendar<?php echo $yolo; ?></h1>
      </div>
    </div>
  </div>
  <div class="slider rsMinW" style="height:540px">

    <?php $counter = 1; while ($wp_query->have_posts()) : $wp_query->the_post();  ?>

    <?php
      $event_date = tribe_get_start_date($pageID, false, "l, M j, Y | g:ia");
      $venue_details = array();
      $terms = wp_get_post_terms(get_the_ID(), 'tribe_events_cat');
      $count = count($terms);
      if ( $count > 0 ){
        foreach ( $terms as $term ) {
          $cats = '<a href="'. get_term_link($term->slug, 'tribe_events_cat') .'" class="cat_' . $term->slug . '">' . $term->name . '</a>';
        }
      }
      $thumb_id = get_post_thumbnail_id();
      $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'header-bg', true);
      $thumb_url = $thumb_url_array[0];
    ?>

    <div class="slide calendar" id="event_<?php echo $counter; ?>">
      <div class="meta overlay bottom">
        <div class="row">
        <div class="desktop-1"><a href="#" onClick="$('#calendar-header .slider').data('royalSlider').goTo(<?php echo $counter; ?>);" class="button prev"><i class="ss-icon ss-gizmo">navigateleft</i></a></div>
          <div class="desktop-10">
            <div class="desc">
              <span class="event-header-cats"><?php echo $cats; ?></span>
              <span class="event-header-date"><?php echo $event_date; ?></span>
              <a class="event-header-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>
          </div>
          <div class="desktop-1"><a href="#" onClick="$('#calendar-header .slider').data('royalSlider').goTo(<?php echo $counter; ?>);" class="button next"><i class="ss-icon ss-gizmo">navigateright</i></a></div>
        </div>
      </div>
      <img src="<?php echo $thumb_url; ?>" class="rsImg" />
    </div>

    <?php $counter++; endwhile; ?>
    <?php $wp_query = null; $wp_query = $temp; ?>

  </div>
</div>
<?php else: ?>
<div class="page-header calendar" data-speed="1.25">
  <div class="row">
    <div class="desktop-12 tablet-6 mobile-3">
      <?php if ( is_tax() ) :?>
    <ul class="parent-links">
      <li><a href="/calendar">Calendar</a></li>
    </ul>
    <?php endif; ?>
      <?php if ( is_tax() ) :?>

      <?php $description  =  get_queried_object()->description;
      if ( ! empty( $description ) ) {
        $class = 'has-sub';
      } else {
        $class = '';
      } ?>


      <h1 class="page-header-title <?php echo $class; ?>"><?php echo $yolo; ?></h1>

      <?php $description  =  get_queried_object()->description;
      if ( ! empty( $description ) ) : ?>
      <h3 class="page-header-subtitle"><?php echo term_description(); ?></h3>
      <?php endif; ?>

      <?php else: ?>
      <h1 class="page-header-title">Calendar</h1>
      <?php endif; ?>
      <br>
    </div>
  </div>
</div>
<?php endif;?>