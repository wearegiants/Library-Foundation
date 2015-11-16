<article class="item blog-item hentry">
  <a href="<?php the_permalink(); ?>" class="thumbnail"><?php the_post_thumbnail( 'event-bio', array( 'class' => 'img-responsive' ) ); ?></a>
  <header>
    <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <p class="posted"><?php the_time('l, M jS, Y'); ?></p>
    <?php // echo get_the_category_list(); ?>
  </header>
  <?php echo excerpt(50); ?>
  <footer>
    <hr class="invisible">
    <a href="<?php the_permalink(); ?>" class="button">Read More</a>
    <a class="share-link" target="blank" href="https://twitter.com/home?status=<?php bloginfo( 'wpurl' ) ?><?php the_permalink(); ?>"><i class="ss-social-circle ss-icon">twitter</i></a>
    <a class="share-link" target="blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php bloginfo( 'wpurl' ) ?><?php the_permalink(); ?>"><i class="ss-social-circle ss-icon">facebook</i></a>
  </footer>
</article>
