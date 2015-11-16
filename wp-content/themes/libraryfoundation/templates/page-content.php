<?php

  // Dynamically Grab the page width depending on template.

  $includeSidebar = get_field('include_sidebar');

  if ( get_field('include_aside')) {

    $pageWidth = 'sizer-item desktop-7 tablet-4 mobile-3';

  } else {

    $pageWidth = 'sizer-item desktop-12 tablet-6 mobile-3';

  }

  if (is_front_page()) {

    $pageWidth = 'sizer-item desktop-10 tablet-4 mobile-3 centered';
    $homepage = 'class="homepage"';

  }

  if (is_page('about')) {

    $pageWidth = 'sizer-item desktop-10 tablet-6 mobile-3 centered';

  }

?>

<?php while (have_posts()) : the_post(); ?>

<div class="page-content">
  <div class="row">

    <div class="<?php echo $pageWidth; ?>">
      <?php the_content(); ?>
      <?php include locate_template('templates/events/recommended-reading.php'); ?>
      <br>
      <?php if ( get_field('include_sidebar')) {

       get_template_part('templates/flex', 'content');

      } else {

      // get_template_part('templates/flex', 'content');

      } ?>

    </div>

    <?php if ( get_field('include_aside')) { ?>
    <aside class="aside desktop-4 tablet-2 mobile-3 right"><?php the_field('aside'); ?></aside>

    <?php if ( is_ancestor(250) OR is_front_page() OR $includeSidebar ) { // If What We Fund Ancestor ?>
    <aside class="aside desktop-4 tablet-2 mobile-3 right">
      <?php if ( $includeSidebar ) { get_sidebar('simple'); } ?>
    </aside>
    <?php } ?>

    <?php } ?>

  </div>
</div>

<?php endwhile; ?>
