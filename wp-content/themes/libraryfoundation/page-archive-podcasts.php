<?php Themewrangler::setup_page();get_header(/***Template Name: Archive Podcasts */); ?>

<?php get_template_part('templates/page', 'header-simple'); ?>

<div id="archive--wrapper">
  <div id="archive--videos">
    <div class="row">
      <div class="desktop-12 tablet-6 mobile-3">
        <?php include locate_template('/templates/media/podcasts-all.php' ); ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>