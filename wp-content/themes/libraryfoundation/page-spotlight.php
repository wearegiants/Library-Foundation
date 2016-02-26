<?php Themewrangler::setup_page('new_default|not default','new_vendor | new_scripts');get_header('v2'/***Template Name: Special Projects 2 */); ?>

<div class="fs-grid">
	<header class="hero bg--black relative">
		
<?php $current = get_field('current_projects'); ?>
<?php if($current): ?>
		<div class="fs__carousel special__slide-carousel carousel_fade">
<?php foreach($current as $slide): ?>

			<div class="hero bg--black relative wallpaper special__slide" data-background-options='{"source":"<?php echo $slide['image']['sizes']['whatwefund-twothirds']; ?>"}'>
				<div class="special__slide-footer pinned pinned__bottom">
					<div class="special__slide--footer__wrapper">
						<div class="fs-row">
							<div class="fs-cell fs-all-full">
								<a class="color--white accent accent__sm" href="<?php echo $slide['url']; ?>"><?php echo $slide['title']; ?></a>
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

	<div class="section section--md bg--white"></div>

	<div class="section section--md bg--bgGray">
		<div class="fs-row">
			<div class="fs-cell fs-all-full">
				<div class="accent accent--md text-center">Current Projects</div>
			</div>
		</div>
	</div>

	<div class="section bg--bgGray">
		<div class="fs-row">
<?php if($current): ?>
<?php foreach($current as $slide): ?>
			<div class="fs-cell fs-lg-half fs-md-half fs-sm-3">
				<div class="hero hero--sm bg--gray wallpaper relative" data-background-options='{"source":"<?php echo $slide['image']['sizes']['whatwefund-twothirds']; ?>"}'>
					<div class="covered">
						<div class="wrapper">
							<?php echo $program['title']; ?>
						</div>
					</div>
				</div>
			</div>
<?php endforeach; ?>
<?php endif; ?>
		</div>
	</div>

	<div class="section section--md bg--bgGray">
		<div class="fs-row">
			<div class="fs-cell fs-all-full">
				<div class="accent accent--md text-center">Past Projects</div>
			</div>
		</div>
	</div>

	<div class="section section--lg section--top bg--bgGray">
		<div class="fs-row">
<?php $past = get_field('past_projects'); ?>		
<?php if($past): ?>
<?php foreach($past as $slide): ?>
			<div class="fs-cell fs-lg-third fs-md-half fs-sm-3">
				<div class="hero hero--sm bg--gray wallpaper relative" data-background-options='{"source":"<?php echo $slide['image']['sizes']['whatwefund-twothirds']; ?>"}'>
					<div class="covered">
						<div class="wrapper">
							<?php echo $program['title']; ?>
						</div>
					</div>
				</div>
			</div>
<?php endforeach; ?>
<?php endif; ?>
		</div>
	</div>

</div>

<?php get_footer('v2'); ?>