<?php // if( have_rows('footer_modules', 'option') ): ?>
<?php // $footer_modules = get_field('footer_modules', 'option'); ?>

<div id="footer-modules" class="gridlock">
  <div class="row">
    <?php // while ( have_rows('footer_modules', 'option') ) : the_row(); ?>

    <?php
//      $post_object = get_sub_field('page_link');
//      $post = $post_object;
//      setup_postdata( $post ); 
//
//      $image = get_sub_field('image');
//      $url = $image['url'];
//      $title = $image['title'];
//      $alt = $image['alt'];
//      $caption = $image['caption'];
//      $size = 'footer-module-image';
//      $thumb = $image['sizes'][ $size ];

    ?>

    <?php if(''){ ?>
    <div class="desktop-6 mobile-3 tablet-6 module sizer-item">
      <div class="row">
        <div class="max-6 desktop-6 tablet-2 mobile-1"><a href="<?php the_permalink(); ?>"><img src="<?php echo $thumb; ?>" alt="" class="img-responsive alignleft" /></a></div>
        <div class="max-6 desktop-6 tablet-4 mobile-2 padded">
          <div class="inner">
            <h3 class="footer-module-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p><?php the_sub_field('description'); ?></p>
            <a href="<?php the_permalink(); ?>" class="button">Learn More</a>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>

    <?php //wp_reset_postdata(); ?>
    <?php //endwhile; ?>

    <div class="desktop-6 mobile-3 tablet-6 module sizer-item">
      <div class="row">
        <div class="max-6 desktop-6 tablet-2 mobile-1"><a href="/support-us/become-a-member/"><img src="/wp-content/uploads/maguire-gardens-600x335.jpg" alt="" class="img-responsive alignleft" /></a></div>
        <div class="max-6 desktop-6 tablet-4 mobile-2 padded">
          <div class="inner">
            <h3 class="footer-module-title"><a href="/support-us/become-a-member/">Become a Member</a></h3>
            <p>Join a community of Los Angeles Public Library supporters.</p>
            <a href="/support-us/become-a-member/" class="button">Learn More</a>
          </div>
        </div>
      </div>
    </div>

    <div class="desktop-6 mobile-3 tablet-6 module sizer-item">
      <div class="row">
        <div class="max-6 desktop-6 tablet-2 mobile-1"><a href="/about/"><img src="/wp-content/uploads/about-600x335.jpg" alt="" class="img-responsive alignleft" /></a></div>
        <div class="max-6 desktop-6 tablet-4 mobile-2 padded">
          <div class="inner">
            <h3 class="footer-module-title"><a href="/about/">About Us</a></h3>
            <p>Learn more about the Library Foundation.</p>
            <a href="/about/" class="button">Learn More</a>
          </div>
        </div>
      </div>
    </div>

    <div class="desktop-6 mobile-3 tablet-6 module sizer-item">
      <div class="row">
        <div class="max-6 desktop-6 tablet-2 mobile-1"><a href="/library-store/"><img src="/wp-content/uploads/1227_IMG_4956-600x335.jpg" alt="" class="img-responsive alignleft" /></a></div>
        <div class="max-6 desktop-6 tablet-4 mobile-2 padded">
          <div class="inner">
            <h3 class="footer-module-title"><a href="/library-store/">The Library Store</a></h3>
            <p>Shop our collection of literary gifts and goods.</p>
            <a href="/library-store/" class="button">Learn More</a>
          </div>
        </div>
      </div>
    </div>

    <div class="desktop-6 mobile-3 tablet-6 module sizer-item">
      <div class="row">
        <div class="max-6 desktop-6 tablet-2 mobile-1"><a href="/what-we-fund/"><img src="/wp-content/uploads/Student-Zones1-600x335.jpg" alt="" class="img-responsive alignleft" /></a></div>
        <div class="max-6 desktop-6 tablet-4 mobile-2 padded">
          <div class="inner">
            <h3 class="footer-module-title"><a href="/what-we-fund/">What We Fund</a></h3>
            <p>Enriching the programs of the Los Angeles Public Library.</p>
            <a href="/what-we-fund/" class="button">Learn More</a>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<?php // endif; ?>