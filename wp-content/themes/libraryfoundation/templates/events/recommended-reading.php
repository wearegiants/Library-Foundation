<?php if( have_rows('page_modules') ): ?>
<?php while ( have_rows('page_modules') ) : the_row(); ?>

<?php if( get_row_layout() == 'recommended_reading'): ?>
<h2><?php the_sub_field('recommended_reading_title'); ?></h2>
<?php the_sub_field('description'); ?>
<hr class="divider">
<?php while ( have_rows('recommended_reading_list') ) : the_row(); ?>

<div class="row">
	<div class="desktop-3 tablet-2 mobile-1">
		<?php if(get_sub_field('link')): ?><a href="<?php the_sub_field('link'); ?>"><?php endif; ?>
		<img src="<?php the_sub_field('image'); ?>" class="img-responsive" alt="Recommended Reading"/>
		<?php if(get_sub_field('link')): ?></a><?php endif; ?>
	</div>
	<div class="desktop-9 tablet-4 mobile-3">
		<?php the_sub_field('description'); ?>
		<?php if(get_sub_field('link')): ?><a class="btn" href="<?php the_sub_field('link'); ?>">More Info</a><?php endif; ?>
	</div>
	<hr class="divider desktop-12 tablet-6 mobile-3">
</div>

<?php endwhile; ?>
<?php endif; ?>

<?php if( get_row_layout() == 'interesting_links'): ?>
<h2><?php the_sub_field('interesting_link_title'); ?></h2>
<?php the_sub_field('description'); ?>
<hr class="divider">
<?php while ( have_rows('interesting_link_list') ) : the_row(); ?>

<div class="row il-wrap">
	<div class="desktop-12 tablet-6 mobile-3 il-item">
		<h3 class="il-title ss-gizmo ss-globe">
			<?php if(get_sub_field('link_url')): ?><a href="<?php the_sub_field('link_url'); ?>"><?php endif; ?>
			<?php the_sub_field('link_title'); ?>
			<?php if(get_sub_field('link_url')): ?><br><small><?php the_sub_field('link_url'); ?></small><?php endif; ?>
			<?php if(get_sub_field('link_url')): ?></a><?php endif; ?>
		</h3>
		<div class="il-desc"><?php the_sub_field('link_description'); ?></div>
	</div>
</div>

<?php endwhile; ?>
<hr class="invisible">
<?php endif; ?>

<?php endwhile; ?>
<?php endif; ?>