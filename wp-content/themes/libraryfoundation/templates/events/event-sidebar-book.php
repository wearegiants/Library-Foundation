<?php if( have_rows('event_book') ): ?>
<div id="related-book">
<?php while ( have_rows('event_book') ) : the_row();?>

  <?php

    $image = get_sub_field('book_image');

    if( !empty($image) ):
    $url = $image['url'];
    $title = $image['title'];
    $alt = $image['alt'];
    $caption = $image['caption'];

    $size = 'medium';
    $thumb = $image['sizes'][ $size ];
    $width = $image['sizes'][ $size . '-width' ];
    $height = $image['sizes'][ $size . '-height' ];

    endif;

  ?>

  <div class="item related-book">
    <div class="row">
      <div class="desktop-4 tablet-2 mobile-1">
        <img class="img-responsive" src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
      </div>
      <div class="desktop-7 tablet-4 mobile-2 right">
        <?php the_sub_field('book_description'); ?>
        <br><small>Add to cart during checkout</small>
      </div>
    </div>
  </div>

<?php endwhile; ?>

</div>
<?php if( get_field('book_message')):?>

<div class="item message">
  <small><?php the_field('book_message'); ?></small>
</div>

<?php endif; ?>


<?php endif; ?>