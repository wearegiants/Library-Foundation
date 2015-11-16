<?php $bg_image = get_field('background_image'); ?>

<section id="description" <?php if( !empty($bg_image) ): ?>style="background-image:url(<?php echo $bg_image['url']; ?>);"<?php endif; ?>>
  <div class="container">
  	<h2 class="section_title text-center"><?php the_title(); ?></h2>
    <article class="col-md-8 col-centered text-center"><?php the_content(); ?></article>
  </div>
</section>
