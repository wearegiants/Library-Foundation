<?php // if ( get_field('sponsor_gallery') OR get_field('sponsors_options') ): ?>

<?php if ( !get_field('sponsors_options')): ?>

<div id="sponsors" class="sponsor-list row">

  <div class="item desktop-12 tablet-6 mobile-3 section-title header">
    <h3 class="event-section-title">Sponsors</h3>
  </div>

  <?php if ( get_field('add_sponsor_description')) : ?>
  <div id="sponsor-desc" class="desktop-12">
    <div class="wrapper">
      <?php the_field('sponsor_description'); ?>
    </div>
  </div>
  <?php endif; ?>

  <?php $sponsors = get_field('sponsor_gallery'); if( $sponsors ): ?>
  <?php foreach( $sponsors as $sponsor ): $link = get_field('attachement_link', $sponsor['id']); ?>
  <div class="item desktop-3 tablet-2 mobile-1 sizer-item contained">
    <a href="<?php echo $link; ?>">
      <img class="img-responsive" src="<?php echo $sponsor['sizes']['large']; ?>" alt="<?php echo $sponsor['alt']; ?>" />
    </a>
  </div>
  <?php endforeach; endif; ?>

  <?php

    if( !get_field('sponsors_options') ):
    $globalSponsors = get_field('aloud_sponsors', 'options');
    if( $globalSponsors ):
    foreach( $globalSponsors as $globalSponsor ): $link = get_field('attachement_link', $globalSponsor['id']);

  ?>

  <div class="item desktop-3 tablet-2 mobile-1 sizer-item contained">
    <a href="<?php echo $link; ?>">
      <img class="img-responsive" src="<?php echo $globalSponsor['sizes']['large']; ?>" alt="<?php echo $globalSponsor['alt']; ?>" />
    </a>
  </div>

  <?php endforeach; endif; else: endif; ?>

  <?php $mediasponsors = get_field('media_sponsors','option'); if( $mediasponsors ): ?>

  <div class="item desktop-12 tablet-6 mobile-3 section-title header">
    <h3 class="event-section-title">Media Partners</h3>
  </div>

  <?php foreach( $mediasponsors as $image ): $link = get_field('attachement_link', $image['id']); ?>
  <div class="item desktop-3 tablet-2 mobile-1 sizer-item contained">
    <a href="<?php echo $link; ?>">
      <img class="img-responsive" src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
    </a>
  </div>
  <?php endforeach; ?>

  <?php endif; ?>

</div>

<?php  endif; ?>