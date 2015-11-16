<div id="member-tabs" class="tabbed">

  <?php if (is_page('membership')): ?>
  <menu class="row">
    <div class="desktop-12 tablet-6 mobile-3">
      <menu class="tabber-menu">
        <a href="#tab_2" class="tabber-handle">
          <h3 class="member-level-title">Library Associates</h3>

        </a>
        <a href="#tab_4" class="tabber-handle">
          <h3 class="member-level-title">Leadership Circle</h3>

        </a>
      </menu>
    </div>
  </menu>
  <?php endif; ?>

  <div class="row">
  <div class="desktop-12 tablet-6 mobile-3 padded">

  <?php if( have_rows('page_modules') ): $counter = 1; while ( have_rows('page_modules') ) : the_row(); ?>
  <?php if( get_row_layout() == 'page_references_description' ): ?>
  <div id="tab_<?php echo $counter; ?>" class="tabber-tab">
  <?php while( have_rows('references') ) : the_row(); ?>

  <?php

    if ( get_sub_field ('remove_overlay') ) { $nOverlay = ' overlayless'; }

    $post_object = get_sub_field('page');
    if( $post_object ): $post = $post_object; setup_postdata( $post );
    $thing = $post->post_name;
    wp_reset_postdata(); endif;

    $page_object = get_sub_field('gift_membership');
    if( $page_object ): $page = $page_object; setup_postdata( $page );
    $blargh = $page->post_name;
    wp_reset_postdata(); endif;

  ?>

  <div class="simple membership-level<?php echo $mClass; echo $nOverlay; ?>">
    <div class="row">
      <header class="desktop-4 tablet-6 mobile-3">
        <h2 class="member-level-title"><?php the_sub_field('title'); ?></h2>
        <span class="sub-title"><?php the_sub_field('sub_title'); ?></span>
        <br><br>
        <a href="#<?php echo $thing;?>" class="popup button">Join/Renew Now</a><br>
        <?php if (get_sub_field('gift_membership')): ?>
        <!--<a href="#<?php echo $blargh;?>" class="popup gift">Gift a Membership</a>-->
        <a href="#<?php echo $blargh;?>" class="popup button">Gift a Membership</a>
        <?php endif; ?>
      </header>
      <div class="desktop-8"><?php the_sub_field('description'); ?></div>
    </div>
  </div>

  <?php
    $post_object = get_sub_field('page');
    if( $post_object ): $post = $post_object; setup_postdata( $post );
  ?>
  <div id="<?php echo $thing;?>" class="mfp-hide white-popup-block modal-window member">
    <?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
  </div>
  <?php wp_reset_postdata(); endif; ?>

  <?php
    $page_object = get_sub_field('gift_membership');
    if( $page_object ): $post = $page_object; setup_postdata( $post );
  ?>
  <div id="<?php echo $blargh;?>" class="mfp-hide white-popup-block modal-window member">
    <?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
    <hr>
    <p>
      Give the gift of Membership to your friends, family, colleagues and we'll send directly
      to your recipient, or mail the gift to you to deliver personally. Members enjoy 12
      full months of critically acclaimed programs that bring together today’s brightest
      thinkers, invitations to special events, discounts, and so much more.
      <br>
      If you'd like to purchase multiple memberships, please <a href="mailto:info@lfla.org">contact us directly</a>.
    </p>
  </div>
  <?php wp_reset_postdata(); endif; ?>



  <?php endwhile; ?>
  </div>
  <?php endif; ?>
  <?php $counter++; endwhile; endif; ?>

  </div>
  </div>

</div>

<?php

if ( is_tax() ) {

  $queried_object = get_queried_object();
  $taxonomy = $queried_object->taxonomy;
  $term_id = $queried_object->term_id;
  $taxTerm = $taxonomy . '_' . $term_id;

} else {

  $taxTerm = '';

}

// check if the flexible content field has rows of data
if( have_rows('page_modules' , $taxTerm) ):

     // loop through the rows of data
    while ( have_rows('page_modules',$taxTerm) ) : the_row();

        // if( get_row_layout() == 'event_block' ):

        //   include('flex/events.php');

        if( get_row_layout() == 'page_references'):

          include('flex/post-objects.php');

        elseif( get_row_layout() == 'general_text_box' ):

          include('flex/general-textbox.php');

        elseif( get_row_layout() == 'video_wide' ):

          include('flex/general-video.php');

        elseif( get_row_layout() == 'custom_page_references' ):

          include('flex/post-objects-desc.php');

        elseif( get_row_layout() == 'image_gallery' ):

          include locate_template('templates/image-gallery.php');

        elseif( get_row_layout() == 'flickr_gallery' ):

          include locate_template('templates/page-flickrgallery.php');

        elseif( get_row_layout() == 'what_we_fund_grid' ):

          get_template_part('templates/whatwefund/whatwefund', 'grid');

        elseif( get_row_layout() == 'page_list' ):

          get_template_part('templates/page', 'list');

        elseif( get_row_layout() == 'calendar' ):

          include locate_template('templates/page-calendar.php');

        elseif( get_row_layout() == 'headshot_grid' ):

          include locate_template('templates/staff/staff-flex.php');

        elseif( get_row_layout() == 'download' ):

          $file = get_sub_field('file');

        elseif( get_row_layout() == 'section_title' ):

          include('flex/section-title.php');

        elseif( get_row_layout() == 'slideshow'):

          include locate_template('templates/slideshow.php' );

        elseif( get_row_layout() == 'member_title' ):

          if (is_page('membership')) {

            include('flex/member-title-alt.php');

          } else {

            include('flex/member-title.php');

          }

        endif;

    endwhile;

else :

    // no layouts found

endif;

?>