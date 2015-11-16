<?php

  if ( has_post_thumbnail() ) {

    $thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
    $bgImg = $thumb_url_array[0];

  } else {

    $input     = array("1","2","3","4","5","6","7");
    $rand_keys = array_rand($input, 2);
    $bgImg     = $input[$rand_keys[1]];

  }

?>

<?php if ( has_post_thumbnail() ): ?>
<div class="simple-header" data-speed="1.25" style="background-image:url(<?php echo $bgImg; ?>);">
<?php else: ?>
<div class="simple-header" data-speed="1.25" style="background-image:url(<?php echo '/assets/img/bg/'; echo $bgImg; echo '.jpg' ?>);">
<?php endif; ?>
  <div class="row">
    <div class="desktop-12 tablet-6 mobile-3">

      <?php
        if ( $post->post_parent ) {

        $anc_reverse = get_post_ancestors( $post->ID );
        $anc = array_reverse($anc_reverse);

        echo '<ul class="parent-links">';

        foreach ( $anc as $ancestor ) {
          $output = '<li><a class="ss-gizmo ss-navigateright" href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li>';
          echo $output;
        }

        echo '</ul>';

      }
      ?>

      <h1 class="page-header-title"><?php the_title(); ?></h1>
    </div>
  </div>
</div>

