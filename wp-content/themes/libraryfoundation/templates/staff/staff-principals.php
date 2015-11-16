
<?php

$groupTitle = get_sub_field('group_title');
$groupTitle_clean = get_sub_field('group_title');
$groupTitle_clean = preg_replace('/\s*/', '', $groupTitle_clean);
// convert the string to all lowercase
$groupTitle_clean = strtolower($groupTitle_clean);

?>


<?php if( have_rows('principal_members') ): ?>

<div id="things" class="max-12 desktop-12 tablet-6 mobile-3 group">
<div class="row">

<h3 class="title"><span class="cat_<?php echo $groupTitle_clean; ?>"><?php echo $groupTitle; ?></span></h3>


<?php while ( have_rows('principal_members') ) : the_row(); ?>

<?php
  $image = get_sub_field('principal_photo');

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

<div class="staff-member desktop-4 tablet-2 mobile-3 <?php echo $princeTitle_clean; ?>">
  <div class="row">
    <div class="thumb desktop-12 tablet-6">
      <img class="img-responsive" src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" />
    </div>
    <div class="info desktop-12 tablet-6 mobile-3"><?php the_sub_field('principal_info'); ?></div>
  </div>
</div>

<?php endwhile; ?>

</div>
</div>

<?php else : echo 'noada'; endif;?>
