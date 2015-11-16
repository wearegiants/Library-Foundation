
<div id="flickr-gallery" class="page-section">
  <div class="row">
    <?php while ( have_rows('external_gallery') ) : the_row(); ?>
    <?php $image = get_sub_field('thumbnail'); ?>

    <div class="item desktop-4 tablet-3 mobile-3">
      <div class="meta overlay bottom">
        <p class="posted"><?php the_sub_field('date'); ?></p>
        <h3 class="title"><a href="<?php the_sub_field('url'); ?>"><?php the_sub_field('title'); ?></a></h3>
      </div>
      <a class="thumb" href="<?php the_sub_field('url'); ?>"><img src="<?php echo $image['sizes']['whatwefund']; ?>" alt="<?php echo $image['alt']; ?>" class="img-responsive" /></a>
    </div>

    <?php endwhile;  ?>
  </div>
</div>
