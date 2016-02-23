<?php Themewrangler::setup_page('new_default|not default','new_vendor | new_scripts');get_header('v2'/***Template Name: New Home */); ?>

<div class="home fs-grid">

<?php include locate_template('partials/home__carousel.php' );?>
<?php include locate_template('partials/home__about.php' );?>
<?php include locate_template('partials/home__events.php' );?>
<?php include locate_template('partials/home__spotlight.php' );?>

</div><!-- .home .grid -->

<?php get_footer('v2'); ?>
