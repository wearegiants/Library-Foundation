<?php if( have_rows('additional_content') ): while ( have_rows('additional_content') ) : the_row();

  $image = get_sub_field('thumbnail');

  if( !empty($image) ) {

    $articleWidth = 'desktop-7 tablet-6 mobile-3';
    $url = $image['url'];
    $title = $image['title'];
    $alt = $image['alt'];
    $size = 'thumbnail';
    $thumb = $image['sizes'][ $size ];

  } else {

    $articleWidth = 'desktop-12 tablet-6 mobile-3';

  }

  ?>

  <div class="row article-item">
    <?php if( !empty($image) ) :?><div class="thumb desktop-4 tablet-6 mobile-3">
      <img src="<?php echo $thumb; ?>" class="img-responsive" alt="" />
    </div><?php endif; ?>
    <div class="desc right <?php echo $articleWidth; ?>"><?php the_sub_field('description'); ?></div>
  </div>

  <?php endwhile; endif;?>