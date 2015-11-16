<?php

$width = get_sub_field('layout');

if( have_rows('pages') ):

    if( $width == "desktop-6" ){
      echo '<div class="row">';
      $quandrant = 'quadrant';
      $widthModifier = $width . ' padded quadrant sizer-item';
    }

    echo '<div id="page-list" class="'.$quandrant.'">';

    while ( have_rows('pages') ) : the_row();

        $post_object = get_sub_field('page_name');
        $post = $post_object;
        setup_postdata( $post ); ?>

        <div <?php post_class('item '. $widthModifier); ?>>
          <div class="row">
            <div class="desktop-12 tablet-6 mobile-3">
              <div class="row">
                <div class="desktop-12 tablet-4 mobile-3">
                  <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                  <?php if(has_excerpt($post->ID)) { ?>
                  <p><?php echo get_the_excerpt(); ?></p>
                  <?php } ?>
                </div>
                <div class="desktop-12 tablet-2 mobile-3 text-left">
                  <a href="<?php the_permalink(); ?>" class="button">Learn More</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php wp_reset_postdata();

    endwhile;

    if( $width == "desktop-6" ){
      echo '</div>';
    }

    echo '</div>';

endif;

?>