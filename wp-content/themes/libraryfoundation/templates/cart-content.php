<?php while (have_posts()) : the_post(); ?>

  <?php

  if ( is_page('checkout')) {

    $pageWidth = 'desktop-7';

  } else {

    $pageWidth = 'desktop-12 tablet-6 mobile-3';
  }

  ?>

  <div class="cart-content">
    <div class="row">
      <div class="<?php echo $pageWidth; ?>"><?php the_content(); ?></div>
      <?php

      if ($freeticket === true) {
        include locate_template('templates/thanks/free-event.php' );
      }

      ?>

    </div>
  </div>

<?php endwhile; ?>
