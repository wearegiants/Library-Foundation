<?php $bg_image = get_field('background_image'); ?>

<section id="about" class="col-md-12" <?php if( !empty($bg_image) ): ?>style="background-image:url(<?php echo $bg_image['url']; ?>);"<?php endif; ?>>
	<div class="row">
		<div class='col-md-8 col-centered'>
			<h2 class="section_title text-center"><?php the_title(); ?></h2>
			<article class="text-center"><?php the_content(); ?></article>
		</div>
	</div>
</section>
