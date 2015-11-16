<?php 
  if (get_sub_field('title_color')) {
    $color = 'style=" color: ' . get_sub_field('title_color') . '"';
  } else {
    $color = '';
  }
?>

<div class="section-header">
  <div class="row">
    <header class="desktop-12">
      <h3 class="member-level-title" <?php echo $color ?>><?php the_sub_field('title'); ?></h3>
      <?php the_sub_field('sub_title'); ?>
    </header>
  </div>
</div>