<section id="gallery" class="col-md-6 pad25">
    <h2 class="section_title text-center"><?php the_title(); ?></h2>
    <article class="text-center page-content"><?php the_content(); ?></article>

	<?php 

	$images = get_field('photo_gallery');
	$url = $image['url'];
	$title = $image['title'];
	$alt = $image['alt'];
	$caption = $image['caption'];
	$desc = $image['description'];
	$size = 'large';
	$thumb = $image['sizes'][ $size ];
	$width = $image['sizes'][ $size . '-width' ];
	$height = $image['sizes'][ $size . '-height' ];

	if( $images ): ?>

	<div id="gallery-photos" class="zoom-gallery">

	<?php foreach( $images as $image ): ?>
	<a href="<?php echo $image['sizes']['large']; ?>" class="<?php echo $image['caption']; ?>">
		<img class="col-md-6 <?php echo $image['caption']; ?> img" src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $alt; ?>" />
	</a>
	<?php endforeach; ?>

	</div>

	<?php endif; ?>


</section>

