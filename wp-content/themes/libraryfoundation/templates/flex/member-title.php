<?php

  $bgColor = get_sub_field('background_color');
  $bgImage = get_sub_field('background_image');
  $titleBg = "background-color:".$bgColor."";
  if( get_sub_field('background_color') ): $isColored = 'color' ; endif;
  if( get_sub_field('background_image') ): $isColored = 'color' ; endif;

?>

<div class="member-header <?php echo $isColored; ?>">
  <div class="row">
    <header class="desktop-12">
      <h3 class="member-level-title"><?php the_sub_field('title'); ?></h3>
      <?php the_sub_field('sub_title'); ?>
    </header>
  </div>
</div>