<?php $posts = get_field('people'); if( $posts ): ?>
<hr class="invisible">
  <div id="event-bios">
  <div class="row">

<?php foreach( $posts as $p ): ?>

<?php

  $my_postid = $p;//This is page id or post id
  $content_post = get_post($my_postid);
  $content = $content_post->post_content;
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);

  if ( get_field('big_photos') ) {

    $photoWidth = 'big-photo desktop-12 tablet-6 mobile-3';
    $articleWidth = 'desktop-12';

  } else {

    $photoWidth = 'small-photo desktop-3 tablet-2 mobile-3';
    $articleWidth = 'desktop-9 tablet-4 mobile-3';

  }

  if ( get_field('featured_speakers') ) {

    $bioWidth = 'desktop-6 tablet-3 mobile-3';

  } else {

    $bioWidth = 'desktop-12 tablet-6 mobile-3';

  }



?>

<?php if ( get_field('featured_speakers') ) { ?>
    <div class="item bio <?php echo $bioWidth; ?>">
      <h3 class="title"><?php echo get_the_title( $p->ID ); ?></h3>
      <?php echo get_the_post_thumbnail( $p->ID, 'event-bio', array( 'class' => 'img-responsive' ) ); ?>
      <p><?php echo $content; ?></p>
    </div>
  <?php } else { ?>
<div class="item bio">
  <div class="row">
    <div class="<?php echo $photoWidth; ?>">

      <?php if ( !get_field('big_photos') ) : ?>
      <?php echo get_the_post_thumbnail( $p->ID, 'thumbnail', array( 'class' => 'rounded img-responsive' ) ); ?>
      <?php endif; ?>

    </div>
    <hr class="invisible desktop-hide tablet-hide mobile-3" style="margin-bottom: 0">
    <div class="<?php echo $articleWidth; ?>">
      <h3 class="title"><?php echo get_the_title( $p->ID ); ?></h3>

      <?php if ( get_field('big_photos') ) : ?>
      <?php echo get_the_post_thumbnail( $p->ID, 'event-bio', array( 'class' => 'img-responsive' ) ); ?>
      <?php endif; ?>

      <p><?php echo $content; ?></p>
    </div>
    </div>
    <hr>
    </div>
<?php } ?>

<?php endforeach; ?>

  </div>
</div>

<?php endif; ?>
