<?php

  $thumb_id = get_post_thumbnail_id();
  $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'header-bg', true);

  $input     = array("1","2","3","4","5","6","7");
  $rand_keys = array_rand($input,2);
  $bgImg     = $input[$rand_keys[1]]."\n";
  $bgImg     = preg_replace('/\s+/', '', $bgImg);

  if($featured){
    $thumb_url = $thumb_url_array[0];
  } else {
    $thumb_url = '/assets/img/bg/'.$bgImg.'.jpg';
  }

?>

<div class="page-header <?php echo $min; ?>" style="background-image:url(<?php echo $thumb_url; ?>);">
  <div class="row">
    <div class="desktop-12">
      <h1 class="page-header-title"><?php the_title(); ?></h1>
      <h3 class="page-header-subtitle"><?php the_time('l, M jS, Y'); ?></h3>
    </div>
  </div>
</div>
