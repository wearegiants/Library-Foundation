<div class="row">
  <div class="desktop-12 tablet-6 mobile-3">
    <div class="module-slider rsMinW">
      <?php $images = get_sub_field('slideshow_gallery'); if( $images ): ?>
      <?php foreach( $images as $image ): ?>
      <img class="rsImg" src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
      <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</div>
<hr class="invisible">