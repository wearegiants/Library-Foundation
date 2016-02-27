<?php Themewrangler::setup_page('new_default|not default','new_vendor | new_scripts');get_header('v2'/***Template Name: Special Projects 2 */); ?>

<div class="fs-grid">
	<header class="hero bg--black relative">
		
<?php $current = get_field('current_projects'); ?>
<?php if($current): ?>
		<div class="fs__carousel special__slide-carousel carousel_fade" data-carousel-options='{"single":true,"controls":false,"pagination":false, "controls":{"container":".custom_container","next":".custom_next","previous":".custom_previous"}}'>
<?php foreach($current as $slide): ?>

			<div class="hero hero--overlay bg--black relative wallpaper special__slide" data-background-options='{"source":"<?php echo $slide['image']['sizes']['whatwefund-twothirds']; ?>"}'>
				<div class="special__slide-footer pinned pinned__bottom">
					<div class="special__slide--footer__wrapper">
						<div class="fs-row">
							<div class="fs-cell fs-all-full">
								<a class="color--white accent accent__sm" href="<?php echo $slide['url']; ?>"><?php echo $slide['title']; ?></a>
								<span class="custom_container">
									<span class="custom_previous">Prev</span>
									<span class="custom_next">Next</span>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>

<?php endforeach; ?>
		</div>
<?php endif; ?>

		<div class="special__title-wrapper pinned pinned__bottom">
			<div class="fs-row">
				<div class="fs-cell fs-all-full">
					<h1 class="special__title title title__xl color--white"><?php the_title(); ?></h1>
				</div>
			</div>
		</div>
	</header>

	<div class="section section--md bg--white">
		<div class="fs-row">
			<div class="fs-cell fs-lg-8 fs-md-6 fs-sm-3">
				<h3 class="accent accent--md">WHAT ARE SPECIAL PROJECTS?</h3>
				<?php the_post(); the_content(); ?>
			</div>
		</div>
	</div>

	<div class="section section--md section--bottom bg--bgGray">
		<div class="fs-row">
			<div class="fs-cell fs-all-full">
				<h3 class="accent accent--md color--black">Current Projects</h3>
			</div>
		</div>
	</div>

	<div class="section bg--bgGray">
		<div class="fs-row">
<?php if($current): ?>
<?php foreach($current as $slide): ?>
			<div class="fs-cell fs-lg-half fs-md-full fs-sm-3">
				<div class="hero hero--overlay bg--gray wallpaper relative" data-background-options='{"source":"<?php echo $slide['image']['sizes']['whatwefund-twothirds']; ?>"}'>
					<div class="covered">
						<div class="wrapper wrapper__extra">
							<span class="title color--white"><?php echo $slide['title']; ?></span><br>
							<span class="accent accent__sm color--white">View More</span>
						</div>
					</div>
					<a href="<?php echo $slide['url']; ?>" class="covered"></a>
				</div>
			</div>
			<hr class="fs-cell fs-all-full compact invisible fs-lg-hide">
<?php endforeach; ?>
<?php endif; ?>
		</div>
	</div>

	<div class="section section--md section--bottom bg--bgGray">
		<div class="fs-row">
			<div class="fs-cell fs-all-full">
				<h3 class="accent accent--md color--bg">Past Projects</h3>
			</div>
		</div>
	</div>

	<div class="section section--lg section--top bg--bgGray">
		<div class="fs-row">
<?php $past = get_field('past_projects'); ?>		
<?php if($past): ?>
<?php foreach($past as $slide): ?>
			<div class="fs-cell fs-lg-third fs-md-full fs-sm-3">
				<div class="hero hero--overlay hero--xs bg--gray wallpaper relative" data-background-options='{"source":"<?php echo $slide['image']['sizes']['whatwefund-twothirds']; ?>"}'>
					<a href="<?php echo $slide['url']; ?>" class="covered"></a>
					<div class="covered">
						<div class="wrapper wrapper__extra">
							<span class="title title__sm color--white"><?php echo $slide['title']; ?></span><br>
							<span class="accent accent__sm color--white">View More</span>
						</div>
					</div>
				</div>
			</div>
			<hr class="fs-cell fs-all-full compact invisible fs-lg-hide">
<?php endforeach; ?>
<?php endif; ?>
		</div>
	</div>

</div>

<?php get_footer('v2'); ?>