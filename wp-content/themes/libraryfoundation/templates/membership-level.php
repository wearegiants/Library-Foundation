<?php
  $member_id = get_post_thumbnail_id();
  $member_url_array = wp_get_attachment_image_src($member_id, 'header-bg', true);
  $member_url = $member_url_array[0];
  $mClass = ' has-bg';
?>

<div class="membership-level<?php echo $mClass;  ?> <?php echo $post->post_name;?>" style="background-image:url(<?php echo $member_url; ?>);">
  <div class="row">

    <header class="desktop-12">
      <h2 class="member-level-title"><?php the_title(); ?></h2>
    </header>

    <div class="desktop-6">
      <?php the_excerpt(); ?>
      <a href="<?php the_permalink(); ?>" class="button">Learn More</a>
    </div>

    <?php $children = get_pages('child_of='.$post->ID); if( count( $children ) != 0 ) {?>

    <div class="desktop-6">
      <p>This page has children</p>
    </div>

    <?php } ?>

  </div>
</div>
