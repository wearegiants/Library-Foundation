<?php Themewrangler::setup_page();get_header(); ?>

<?php
  $input     = array("1","2","3","4","5","6","7");
  $rand_keys = array_rand($input,2);
  $bgImg     = $input[$rand_keys[1]];
?>

<div class="simple-header" data-speed="1.25" style="background-image:url(<?php echo '/assets/img/bg/' . $bgImg . '.jpg' ?>);">
  <div class="row">
    <div class="desktop-12">
      <h1 class="page-header-title">Error, 404.</h1>
    </div>
  </div>
</div>

<div class="page-content">
  <div class="row">
    <div class="desktop-12 tablet-6 mobile-3">
      <p>Sorry folks, nothing here.</p>
    </div>
  </div>
</div>

<?php get_footer(); ?>