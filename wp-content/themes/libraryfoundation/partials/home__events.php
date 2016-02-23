<div class="events__carousel bg__color-bgGray">

<div class="fs-row">
  <div class="fs-cell fs-lg-7 fs-md-4 fs-sm-3">
    <div class="title title__xs">From Member events to ALOUD programs, Library Store On Wheels stops and much much more, stay up on the Library Foundation’s activities.</div>
  </div>
  <div class="fs-cell fs-lg-4 fs-md-2 fs-sm-3 fs-right">
    <div class="events__carousel-select">
      <div class="events__carousel-select_icon fs-cell fs-lg-2 fs-md-1 fs-sm-hide fs-contained"><span class="ss-gizmo ss-calendar">C</span></div>
      <select class="events__carousel-select_menu fs-lg-10 fs-md-5 fs-sm-3 fs-contained">
        <option value="volvo">Jump to Month</option>
        <option value="saab">Saab</option>
        <option value="mercedes">Mercedes</option>
        <option value="audi">Audi</option>
      </select>
    </div>
  </div>
</div>

<hr class="invisible compact">

<?php 

$args = array(
  'showposts'   => 9,
  'post_type'   => 'tribe_events',
  'tax_query'   => array(
    array(
      'taxonomy'  => 'tribe_events_cat',
      'field'     => 'slug',
      'terms'     => array('hidden'),
      'operator'  => 'NOT IN'
    ),
  ),
);

$temp = $wp_query;
$wp_query = null;
$wp_query = new WP_Query();
$wp_query->query($args);

?>


<div class="fs-row">
<div class="fs-cell fs-all-full">
<div class="fs__carousel" data-carousel-options='{"autoHeight":true,"show":{"740px":2,"980px":2,"1220px":3},"contained":false}'>

<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

<?php 

$terms = wp_get_post_terms(get_the_ID(), 'tribe_events_cat');
$count = count($terms);

?>

  <div class="events__carousel-item bg__color-white relative">
    <a href="<?php the_permalink(); ?>" class="covered"></a>
    <div class="events__carousel-image relative">
      <?php 
        if ( $count > 0 ){
          foreach ( $terms as $term ) {
            echo '<span class="events__carousel-tag color__white accent accent__sm cat_' . $term->slug . '">' . $term->name . '</span>';
          }
        }
      ?>
      <?php the_post_thumbnail('event-bio', array('class' => 'img-responsive')); ?>
    </div>
    <div class="events__carousel-content">
      <div class="wrapper">
        <span class="accent accent__sm events__carousel-date"><?php echo tribe_get_start_date(get_the_ID(), false, "l, M j, Y | g:ia"); ?></span>
        <h3 class="events__carousel-title title title__sm"><?php the_title(); ?></h3>
        <p class="fs-sm-hide"><?php echo excerpt(20); ?></p>
      </div>
      <div class="wrapper events__carousel-footer">
        <span class="accent accent__sm">Read More</span>
      </div>
    </div>
  </div>

 <?php endwhile; ?>

</div>
</div>
</div>
</div>


<?php
  $wp_query = null;
  $wp_query = $temp;  // Reset
?>