

<?php

$groupTitle = get_sub_field('group_title');
$groupTitle_clean = get_sub_field('group_title');
$groupTitle_clean = preg_replace('/\s*/', '', $groupTitle_clean);
// convert the string to all lowercase
$groupTitle_clean = strtolower($groupTitle_clean);

?>

<?php if( have_rows('staff_members') ): ?>

<div class="max-6 desktop-6 tablet-3 mobile-3 group">
<div class="row">

<h3 class="title"><span class="cat_<?php echo $groupTitle_clean; ?>"><?php echo $groupTitle; ?></span></h3>


<?php while ( have_rows('staff_members') ) : the_row(); ?>

<?php
  $image = get_sub_field('staff_photo');

  if( !empty($image) ):
    $url = $image['url'];
    $title = $image['title'];
    $alt = $image['alt'];
    $caption = $image['caption'];

    $size = 'homepage-thumb';
    $thumb = $image['sizes'][ $size ];
    $width = $image['sizes'][ $size . '-width' ];
    $height = $image['sizes'][ $size . '-height' ];
  endif;
?>

<div class="staff-member desktop-12 tablet-6 mobile-half <?php echo $groupTitle_clean; ?>">
  <div class="row">
    <div class="thumb desktop-4 tablet-2">
      <img class="img-responsive" src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" />
    </div>
    <div class="info desktop-8 tablet-4 mobile-3"><?php the_sub_field('staff_info'); ?></div>
  </div>
</div>

<?php endwhile; ?>

</div>
</div>

<?php else : endif;?>
