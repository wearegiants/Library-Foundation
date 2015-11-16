<section id="home-graphic">

<div id="lfla-logo"><a href="#"><img class="img-responsive" src="/odyssey/wp-content/themes/roots/assets/img/logo.png" alt="The Library Foundation of Los Angeles" /></a></div>

<div id="logo-wrapper">
<h1 id='site-logo' class="col-md-6 col-lg-6 col-sm-8 col-centered text-center">
<a href="/"><img class="img-responsive" src="/odyssey/wp-content/themes/roots/assets/img/odyssey-logow.png" alt="<?php bloginfo('name'); ?>" /></a>
</h1> 
</div>

<div class="overlay"></div>

<?php $images = get_field('header_background_gallery', 'option'); if( $images ): ?>

<div class="image royalSlider rsMinW" id="home-graphic-slider" data-0p="margin-top:0px; opacity:1;" data-600="margin-top: 200px; opacity:0;">
<div class="slidersituation">
<?php foreach( $images as $image ): ?>
<div class="rsContent"><img class="rsImg" alt="Library Foundation of Los Angeles" src="<?php echo $image['url']; ?>" /></div>
<?php endforeach; ?>
</div>
</div>

<?php endif; ?>

</section>