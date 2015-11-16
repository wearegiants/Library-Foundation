<?php $bg_image = get_field('image'); ?>

<section id="essay" <?php if( !empty($bg_image) ): ?>style="background-image:url(<?php echo $bg_image['url']; ?>);"<?php endif; ?>>
  <div class="container">
    <header class="col-md-12"><h2 class="section_title text-center"><?php the_title(); ?></h2></header>
    <article class="col-md-6 col-centered text-center"><?php the_content(); ?></article>
  </div>
</section>
