<hr class="invisible" style="margin:5px 0">

<?php

include locate_template('templates/global/page-toolbar.php');

$eventCat = get_sub_field('event_category_slug');

$args = array(
  'post_type' => 'tribe_events',
  'posts_per_page'=> -1,
  'order'          => 'DESC',
  'tax_query' => array(
    array(
      'taxonomy' => 'tribe_events_cat',
      'field'    => 'slug',
      'terms'    => $eventCat,
      ),
    array(
      'taxonomy' => 'tribe_events_cat',
      'field'    => 'slug',
      'terms'    => array('hidden'),
      'operator' => 'NOT IN'
      ),
    ),
  'meta_query'   => array(
        array(
          'key'      => '_EventStartDate',
          'value'    => date('Y-m-d'),
          'compare'  => '>'
        )
      ),
  'eventDisplay' => 'all',
);

$temp = $wp_query;
$wp_query = null;
$wp_query = new WP_Query();
$wp_query->query($args);

$ul_args = array(
  'post_type' => 'tribe_events',
  'posts_per_page'=> -1,
  'tax_query' => array(
    array(
      'taxonomy' => 'tribe_events_cat',
      'field'    => 'slug',
      'terms'    => $eventCat,
      ),
    array(
      'taxonomy' => 'tribe_events_cat',
      'field'    => 'slug',
      'terms'    => array('hidden'),
//'operator' => 'NOT IN'
      ),
    ),
  );

$ul_temp = $ul_wp_query;
$ul_wp_query = null;
$ul_wp_query = new WP_Query();
$ul_wp_query->query($ul_args);



?>

<div id="calendar-module">
  <div class="tabbed">
    <?php
    // <menu class="tabber-menu">
    //   <div class="row">
    //     <div class="desktop-12">
    //       <a href="#tab-1" class="button tabber-handle">Current Calendar</a>
    //       <a href="#tab-2" class="button tabber-handle">Past Events</a>
    //       <!--<a href="#tab-3" class="button tabber-handle">Member Events</a>-->
    //       <a href="/calendar" class="button ext">View Full Event Calendar</a>
    //     </div>
    //   </div>
    // </menu>
    ?>
    <div class="tabber-tab tribe-events-list" id="tab-1">

      <?php  ?>
      <?php $counter = 1; if ( have_posts() ) :while ($wp_query->have_posts()) : $wp_query->the_post();?>

      <?php
      $thumb_id = get_post_thumbnail_id();
      $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'header-bg', true);
      $thumb_url = $thumb_url_array[0];
      $event_bg  = $thumb_url;
      if ( has_post_thumbnail() ) {
        $bg = 'bg';
      } else {
        $bg = 'bg noimage';
      }
      ?>



      <div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?>">
        <div class="row">
          <?php tribe_get_template_part( 'list/single', 'event' ) ?>
        </div>
        <div class="<?php echo $bg; ?>" style="background-image:url(<?php echo $event_bg; ?>);"></div>
      </div>



      <?php $counter++; endwhile; ?>
      <?php $wp_query = null; $wp_query = $temp;  ?>
    <?php else: ?>
    <div class="row">
      <div class="desktop-12">
        <h2 class="no-events">Sorry, no upcoming events. Check out some past events.</h2>
      </div>
    </div>
  <?php endif; wp_reset_query(); ?>

  <?php include locate_template('/templates/events/old-events.php'); ?>

</div>





</div>

</div>
</div>


<?php if (isset($_GET['calendar'])): ?>
  <script>
    $(function(){
      $('html, body').animate({
        scrollTop: $("#tab-1").offset().top - 180
      }, 400);
    });
  </script>
<?php endif; ?>