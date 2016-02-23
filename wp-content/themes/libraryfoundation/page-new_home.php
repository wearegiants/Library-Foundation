<?php Themewrangler::setup_page('new_default|not default','new_vendor | new_scripts');get_header('v2'/***Template Name: New Home */); ?>

<div class="home fs-grid">

<?php include locate_template('partials/home__carousel.php' );?>

</div><!-- .home .grid -->

<div class="home fs-grid">

<?php include locate_template('partials/home__about.php' );?>
<?php include locate_template('partials/home__events.php' );?>
<?php include locate_template('partials/home__spotlight.php' );?>

</div><!-- .home .grid -->

<div id="mailchimp__signup" class="mfp_hide modal">
	<div class="wrapper wrapper__extra bg__color-white">
		<span class="title title__md color__blue">Join the LFLA newsletter</span>
		<?php echo do_shortcode('[epm_mailchimp]' );?>
	</div>
</div>

<?php get_footer('v2'); ?>
