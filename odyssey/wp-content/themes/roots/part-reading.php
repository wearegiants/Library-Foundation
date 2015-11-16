<div style="clear:  both; overflow: hidden;"></div>
<section id="reading" class="row" style="min-height: 800px;">
  <div class="container text-center">
  <h2 class="section_title"><?php the_title(); ?></h2>
  <div class="description">
    <?php the_content(); ?>
  </div>

  <div class="slider center col-md-4 col-centered">

    <?php $images = get_field('recommended_reading_gallery'); if( $images ): ?>
    <?php foreach( $images as $image ): ?>

    <div>
        <div class="slide-inner">
            <img class="img-responsive" src="<?php echo $image['sizes']['recommended-reading']; ?>" alt="<?php echo $image['title']; ?> by <?php echo $image['caption']; ?>">
            <div class="meta"><div class="meta-wrap">
              <a class='big-button' target="blank" href="<?php echo $image['description']; ?>">
                <h4 class="title"><?php echo $image['title']; ?></h4>
                <span class="sub-title">by <?php echo $image['caption']; ?></span>
              </a>
              <div class="bottom"><a class='rnd-button' href="<?php echo $image['description']; ?>" target="_blank">View Book</a></div>
            </div></div>
        </div>
    </div>

    <?php endforeach; ?>
    <?php endif; ?>
  </div>

  </div>
</section>
