<div class="clearfix"></div>

<section id="vase-gallery" class="row">
    <h2 class="section_title text-center"><?php the_title(); ?></h2>
    <article class="text-center page-content"><?php the_content(); ?></article>

	<?php 

	$images = get_field('photo_gallery');

	if( $images ): ?>

	<div id="vase-photos" class="zoom-gallery rsMinW">

	<?php foreach( $images as $image ): ?>
	<div class="rsContent">
		<img class="rsImg" src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $alt; ?>" />
	</div>
	<?php endforeach; ?>

	</div>

	<?php endif; ?>


</section>

