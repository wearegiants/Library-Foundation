<div class="home__carousel fs__carousel" data-carousel-options='{"controls":true,"pagination":false}'>

<?php 
  $slides = get_field('carousel', 4);
  if ($slides):
  foreach($slides as $slide):
?>

<div class="home__carousel-slide relative">
<!--<a href="<?php echo $slide['link']; ?>" class="covered"></a>-->
<div class="fs-row">
<div class="fs-cell fs-lg-10 fs-md-6 fs-sm-3">
<div class="banner banner__lg relative">

<div class="home__carousel-content pinned pinned__bottom" style="margin-bottom:8px">
<h2 class="home__carousel-title color__white title title__xl"><?php echo $slide['title']; ?></h2>
<span class="home__carousel-subtitle bg__color-<?php echo $slide['color']; ?> color__white accent accent__sm"><?php echo $slide['link_text']; ?></span>
<span class="home__carousel-subtitle fs-sm-hide fs-md-hide color__white accent accent__sm"><?php echo $slide['subtitle']; ?></span>
</div>

</div>
</div>
</div>
<div class="pinned pinned__bottom bg__color-<?php echo $slide['color']; ?>" style="height:8px;"></div>
<?php if($slide['image']):?>
<div class="home__carousel-bg covered" style="background-image:url(<?php echo $slide['image']['sizes']['large']; ?>);"></div>
<?php endif; ?>
</div>

<?php endforeach; ?>
<?php endif; ?>

</div><!-- .home__carousel -->
