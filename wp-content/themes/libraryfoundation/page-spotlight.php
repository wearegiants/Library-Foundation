<?php Themewrangler::setup_page();get_header(/***Template Name: Special Projects */); ?>

<div class="page-header">
	<div class="row">
		<div class="desktop-12 tablet-6 mobile-3">
			<h1 class="page-header-title"><?php the_title(); ?></h1>
		</div>
	</div>
</div>

<hr class="invisible">

<div id="page-description">
	<div class="row">
		<div class="desktop-8 tablet-6 mobile-3">
			<h3 class="section-headline">WHAT ARE SPECIAL PROJECTS?</h3>
			<?php the_post(); the_content(); ?>
		</div>
	</div>
</div>

<hr class="invisible">

<div class="section bg-color-lightgray">
	<div class="row">	
		<header class="all-full">
			<h3 class="section-headline">CURRENT PROJECTS</h3>
		</header>

<?php 

	$currentProjects = get_field('current_projects');

	foreach ($currentProjects as $currentProject) {
    $ids[] = $currentProject['image'];
	}

	$cache = get_posts(array('post_type' => 'attachment', 'numberposts' => -1, 'post__in' => $ids));

	$counter = 1;

	foreach ($currentProjects as $currentProject):

	$image_id = $currentProject['image'];
	$image = wp_get_attachment_image_src($image_id, 'whatwefund-twothirds'); 
	$currentTitle = $currentProject['title'];

	if ($counter == 1) {
		$currentWidth = 'desktop-12 tablet-6 mobile-3';	
	} else {
		$currentWidth = 'desktop-6 tablet-3 mobile-3';
	}	

?>

		<div class="special-project special-project_current module min-height <?php echo $currentWidth; ?>">
			<div class="wrapper">
				<a href="<?php the_sub_field('title'); ?>">
					<h3 class="special-project_title module-headline_serif color-white margin-none"><?php echo $currentTitle; ?></h3>
					<span class="special-project_link module-sublink color-white">VIEW MORE</span>
				</a>
			</div>
			<div class="covered overlayed bg" style="background-image:url(<?php echo $image[0]; ?>);"></div>
		</div>

<?php $counter++; endforeach; ?>

	</div>
</div>

<div class="section bg-color_white">\
	<div class="row">	
		<header class="all-full">
			<h3 class="section-headline">PAST PROJECTS</h3>
		</header>

<?php 

	$pastProjects = get_field('past_projects');

	foreach ($pastProjects as $pastProject) {
    $ids[] = $pastProject['image'];
	}

	$cache = get_posts(array('post_type' => 'attachment', 'numberposts' => -1, 'post__in' => $ids));

	foreach ($pastProjects as $pastProject):

	$image_id = $pastProject['image'];
	$image = wp_get_attachment_image_src($image_id, 'archive-small'); 
	$currentTitle = $pastProject['title'];

?>


		<div class="special-project special-project_past module desktop-4 tablet-3 mobile-3">
			<div class="text-center">
				<a href="<?php the_sub_field('title'); ?>">
					<img src="<?php echo $image[0]; ?>" class="img-responsive margin-bottom" />
					<h3 class="special-project_title module-headline_serif module-headline_small margin-none"><?php echo $currentTitle; ?></h3>
					<span class="special-project_link module-sublink color-blue">VIEW MORE</span>
				</a>
			</div>
		</div>
			

<?php endforeach; ?>

	</div>
</div>

<?php get_footer(); ?>