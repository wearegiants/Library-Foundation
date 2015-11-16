<?php 

  // Dynamically Grab the page width depending on template.

  $includeSidebar = get_field('include_sidebar');

  if ( get_field('include_aside')) {
  
    $pageWidth = 'sizer-item desktop-7 tablet-4 mobile-3';

  } else {

    $pageWidth = 'sizer-item desktop-12 tablet-4 mobile-3';

  }

  if (is_front_page()) {

    $pageWidth = 'sizer-item desktop-10 tablet-4 mobile-3 centered';
    $homepage = 'class="homepage"';

  }

?>

<?php while (have_posts()) : the_post(); ?>

<div class="page-content">
  <div class="row">

    <div class="<?php echo $pageWidth; ?>">
      <?php the_content(); ?>
    </div><!-- Main Content-->

    <?php if ( get_field('include_aside')) { ?>
    <aside class="aside desktop-4 tablet-2 mobile-3 right"><?php the_field('aside'); ?></aside>
    <?php } ?>

  </div>
</div>

<?php endwhile; ?>
