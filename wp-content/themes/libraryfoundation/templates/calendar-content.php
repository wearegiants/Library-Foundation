<?php

  $queried_object = get_queried_object();
  $taxonomy = $queried_object->taxonomy;
  $term_id = $queried_object->term_id;

  // Dynamically Grab the page width depending on template.

  if ( get_field('include_aside', $taxonomy . '_' . $term_id)) {

    $pageWidth = 'sizer-item desktop-8 tablet-4 mobile-3';

  } else {

    $pageWidth = 'sizer-item desktop-12 tablet-6 mobile-3';

  }

?>

<div class="page-content">
  <div class="row">
    <?php if ( is_tax() ): ?>

      <div class="<?php echo $pageWidth ;?>"><?php the_field('description',$taxonomy . '_' . $term_id); ?></div>
      <?php if ( get_field('include_aside',$taxonomy . '_' . $term_id)) { ?>
      <aside class="aside desktop-4 tablet-2 mobile-3 right">
        <?php the_field('aside',$taxonomy . '_' . $term_id); ?>

        <?php // Pull in specific sidebars for categories ?>

        <?php if ( is_tax('tribe_events_cat', 'library-store-on-wheels') ): ?>
        <?php get_sidebar('simple'); ?>
        <?php endif; ?>

      </aside>
      <?php } ?>


    <?php else: ?>

      <div class="<?php echo $pageWidth ;?>"><?php the_field('description','option'); ?></div>
      <?php if ( get_field('include_aside',$taxonomy . '_' . $term_id)) { ?>
      <aside class="aside desktop-4 tablet-2 mobile-3 right"><?php the_field('aside',$taxonomy . '_' . $term_id); ?></aside>
      <?php } ?>

    <?php endif; ?>
  </div>
</div>
