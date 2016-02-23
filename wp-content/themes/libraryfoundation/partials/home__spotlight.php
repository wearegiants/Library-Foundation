<hr class="invisible">

<div class="fs-row">
  <div class="fs-cell fs-full-all">
    <hr class="invisible fs-lg-hide">
    <h3 class="home__section-title accent accent__lg color__blue">Special Events</h3>
  </div>
</div>

<hr class="invisible compact">

<div class="spotlight">
<div class="fs-row">
<div class="fs-cell fs-all-full">
<div class="fs__carousel" data-carousel-options='{"controls":true,"pagination":false}'>

<?php 
  $spotlight = get_field('spotlight', 4);
  if ($spotlight):
  $counter = 1;
  foreach($spotlight as $slide):

  if (!wp_is_mobile()){

    if ( $counter % 4 == 0 || $counter == 1 ) {
      $half = '';
      $size = '__md';
      echo '<div class="fs_carousel-slide"><div class="fs-cell fs-all-full fs-contained">';
    } else {
      $half = '-half';
      $size = '__sm';
    }

  } else {

    $half = '-half';
    $size = '__sm';

  }


?>

  <div class="spotlight__item fs-cell fs-lg-half fs-md-half fs-contained relative bg__color-black item__<?php echo $counter; ?>">
    <div class="banner banner__md<?php echo $half; ?>">
      <div class="spotlight__item-content covered">
        <div class="wrapper">
          <span class="spotlight__item-subtitle accent accent__sm color__white"><?php echo $slide['subtitle']; ?></span>
          <h3 class="spotlight__item-title title<?php echo $size; ?> color__white"><?php echo $slide['title']; ?></h3>
          <span class="accent accent__sm color__white75">View More</span>
        </div>
      </div>
      <div class="covered spotlight__item-bg" style="background-image: url(<?php echo $slide['image']['sizes']['large']; ?>)"></div>
    </div>
  </div>

<?php 
  if (!wp_is_mobile()){
    if ( $counter % 3 == 0 ) {
      echo '</div></div>';
    }
  }
?>

<?php $counter++; endforeach; ?>
<?php endif; ?>

</div>
</div>
</div>
</div>