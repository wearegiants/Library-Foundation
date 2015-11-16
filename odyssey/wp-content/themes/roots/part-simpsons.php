<?php $bg_image = get_field('background_image'); ?>

<section id="simpsons" class="col-md-6 pad25" <?php if( !empty($bg_image) ): ?>style="background-image:url(<?php echo $bg_image['url']; ?>);"<?php endif; ?>>
  
    <header><h2 class="section_title text-center"><?php the_title(); ?></h2></header>
    <article class="text-center page-content"><?php the_content(); ?></article>
    <div class="image"><?php the_post_thumbnail( 'large', array( 'class' => 'img-responsive' ) ); ?></div>
  
</section>

