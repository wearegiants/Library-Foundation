<?php $bg_image = get_field('background_image'); ?>

<section id="essay" class="pullquote col-md-12" <?php if( !empty($bg_image) ): ?>style="background-image:url(<?php echo $bg_image['url']; ?>);"<?php endif; ?>>
	<div class="row">
		<div class='col-md-8 col-centered'>
			<h2 class="section_title text-center"><?php the_title(); ?></h2>
			<article class="text-center"><?php the_content(); ?></article>
			<hr>
			<?php $count = count( get_field( 'essays' ) ); if ( $count > 1 ) { ?>
			
			<?php
			
			// check if the repeater field has rows of data
			if( have_rows('essays') ):
			
			 	// loop through the rows of data
			    while ( have_rows('essays') ) : the_row(); ?>
			
			        <div class="col-md-6 essay">
			          <h2 class="section_title text-center"><?php the_sub_field('essay_title'); ?></h2>
			          <article class="text-center"><?php the_sub_field('essay_excerpt'); ?></article>
			        </div>
			
			    <?php endwhile;
			
			else :
			
			    // no rows found
			
			endif;
			
			?>
			      
			<?php } else { ?>
			
			<?php
			
			// check if the repeater field has rows of data
			if( have_rows('essays') ):
			
			 	// loop through the rows of data
			    while ( have_rows('essays') ) : the_row(); ?>
			
			        <div class="bit-1">
			          <h2 class="section_title text-center"><?php the_sub_field('essay_title'); ?></h2>
			          <article class="text-center"><?php the_sub_field('essay_excerpt'); ?></article>
			        </div>
			
			    <?php endwhile;
			
			else :
			
			    // no rows found
			
			endif;
			
			?>
			 
			<?php } ?>
			
		</div>
	</div>
</section>
