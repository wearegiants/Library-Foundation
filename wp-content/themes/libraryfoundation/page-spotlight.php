<?php Themewrangler::setup_page();get_header(/***Template Name: Special Projects */); ?>

<div class="page-header">
	<div class="row">
		<div class="desktop-12">
			<h1 class="page-header-title"><?php the_title(); ?></h1>
		</div>
	</div>
</div>

<div id="page-description">
	<div class="row">
		<div class="desktop-8 tablet-6 mobile-3">
			<?php the_post(); the_content(); ?>
		</div>
	</div>
</div>

<div class="bg-color_gray">
	<div class="row">	
		<header class="all-full">
			<h3>Current Projects</h3>
		</header>

		<div class="special-project special-project_current desktop-12 tablet-6 mobile-3">
			<div class="wrapper">
				<a href="<?php the_permalink(); ?>">
					<h3 class="special-project_title"><?php the_title(); ?></h3>
					<span class="special-project_link">View More</span>
				</a>
			</div>
		</div>

		<div class="special-project special-project_current"></div>
		<div class="special-project special-project_current"></div>
		<div class="special-project special-project_current"></div>
		<div class="special-project special-project_current"></div>
	</div>
</div>

<div class="bg-color_white">
	<div class="row">	
		<header class="all-full">
			<h3>Past Projects</h3>
		</header>
		<div class="special-project special-project_past"></div>
		<div class="special-project special-project_past"></div>
		<div class="special-project special-project_past"></div>
		<div class="special-project special-project_past"></div>
		<div class="special-project special-project_past"></div>
		<div class="special-project special-project_past"></div>
	</div>
</div>

<?php get_footer(); ?>