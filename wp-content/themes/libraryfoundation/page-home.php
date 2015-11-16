<?php Themewrangler::setup_page();get_header(/***Template Name: Home Page */); ?>

<div id="home-slider">
    <div id="home-carousel" class="rsMinW">

    <?php if( have_rows('featured_slider', 'options') ): while ( have_rows('featured_slider', 'options') ) : the_row(); ?>

    <?php

      if (get_sub_field('slide_color') == "pink") {

        $bgColor = 'RGBA(226, 67, 140, 1)';

      } elseif (get_sub_field('slide_color') == "green") {

        $bgColor = '#86993F';

      } elseif (get_sub_field('slide_color') == "orange") {

        $bgColor = '#E37428';

      } elseif (get_sub_field('slide_color') == "teal") {

        $bgColor = '#3BB8EA';

      } elseif (get_sub_field('slide_color') == "blue") {

        $bgColor = 'RGBA(0, 139, 190, 1)';

      } else {

        $bgColor = '';

      }

      $post_object = get_sub_field('slide_post');
      $post = $post_object;
      setup_postdata( $post );

      if (get_sub_field('slide_image')){

      $image = get_sub_field('slide_image');
      $url = $image['url'];
      $title = $image['title'];
      $alt = $image['alt'];
      $caption = $image['caption'];

      $size = 'header-bg';
      $altsize = 'large';
      $large = $image['sizes'][ $altsize ];
      $thumb = $image['sizes'][ $size ];
      $width = $image['sizes'][ $size . '-width' ];
      $height = $image['sizes'][ $size . '-height' ];

      }

    ?>

    <div class="slide" style="background-image:url(<?php echo $large; ?>);">
      <div class="meta">
        <div class="row">
          <div class="desktop-10 tablet-6 mobile-3 centered">
            <h2 class="title"><a href="<?php the_sub_field('slide_post');?>"><?php the_sub_field('slide_title'); ?></a></h2>
            <div class="slide_meta">
              <div class="row">
                <div class="desktop-12 tablet-6 mobile-3 centered">
                  <a class='section-link' href="<?php the_sub_field('slide_post');?>">
                    <span class="button post-title" style="background-color:<?php echo $bgColor; ?>"><?php the_sub_field('button_text');?></span>
                    <span class="button sub-title"><?php the_sub_field('slide_sub-title', ''); ?></span>
                  </a>
                </div>
            </div>
          </div>
        </div>

        </div>
        <hr style="background-color:<?php echo $bgColor; ?>">
      </div>

      <?php

        if (get_sub_field('slide_image')){ ?>

        <img class="rsImg" src="<?php echo $thumb; ?>" alt="<?php echo $image['alt']; ?>" />

        <?php } else {

          if ( has_post_thumbnail() ) {

          the_post_thumbnail('header-bg', array('class' => 'rsImg'));

          } else {

          echo '<img src="http://placehold.it/1200x500/C9B6F2" class="rsImg">';

          }

        }

      ?>

    </div>

    <?php wp_reset_postdata();?>

    <?php endwhile; endif; ?>
  </div>
</div>

<div id="books-bg">

<div class="row">
  <div class="desktop-12">
    <div id="mission-statement">
      <div class="page-content">
        <div class="row">
          <div class="desktop-10 tablet-6 mobile-3 centered">
            <?php the_content(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="desktop-10 tablet-6 mobile-3 centered arrow-wrapper">
    <a href="#upcoming-events">
      <i class="ss-icon ss-gizmo home-arrow left">down</i>
      <h3 id="upcoming-events">Upcoming Events</h3>
    </a>
  </div>
</div>

</div>

<div id="home-upcoming">
  <div class="row">
    <div class="desktop-10 centered">
      <div class="row">
        <header class="desktop-8 tablet-4 mobile-3">
          <p>
            From Member events to ALOUD programs, Library Store On Wheels stops and much much more, stay up on the Library Foundation’s activities.
          </p>
        </header>
        <div id="carousel-date-select" class="desktop-3 tablet-2 mobile-3 text-right right">

          <select name="selecter_basic" id="selecter_basic" class="selecter_basic" data-selecter-options='{"label":"Jump to Month"}'>
            <option value="/calendar/?action=tribe_list&tribe_paged=1&tribe_event_display=list&tribe-bar-date=<?php echo date("Y"); ?>-01-01">Jan</option>
            <option value="/calendar/?action=tribe_list&tribe_paged=1&tribe_event_display=list&tribe-bar-date=<?php echo date("Y"); ?>-02-01">Feb</option>
            <option value="/calendar/?action=tribe_list&tribe_paged=1&tribe_event_display=list&tribe-bar-date=<?php echo date("Y"); ?>-03-01">Mar</option>
            <option value="/calendar/?action=tribe_list&tribe_paged=1&tribe_event_display=list&tribe-bar-date=<?php echo date("Y"); ?>-04-01">Apr</option>
            <option value="/calendar/?action=tribe_list&tribe_paged=1&tribe_event_display=list&tribe-bar-date=<?php echo date("Y"); ?>-05-01">May</option>
            <option value="/calendar/?action=tribe_list&tribe_paged=1&tribe_event_display=list&tribe-bar-date=<?php echo date("Y"); ?>-06-01">Jun</option>
            <option value="/calendar/?action=tribe_list&tribe_paged=1&tribe_event_display=list&tribe-bar-date=<?php echo date("Y"); ?>-07-01">Jul</option>
            <option value="/calendar/?action=tribe_list&tribe_paged=1&tribe_event_display=list&tribe-bar-date=<?php echo date("Y"); ?>-08-01">Aug</option>
            <option value="/calendar/?action=tribe_list&tribe_paged=1&tribe_event_display=list&tribe-bar-date=<?php echo date("Y"); ?>-09-01">Sep</option>
            <option value="/calendar/?action=tribe_list&tribe_paged=1&tribe_event_display=list&tribe-bar-date=<?php echo date("Y"); ?>-10-01">Oct</option>
            <option value="/calendar/?action=tribe_list&tribe_paged=1&tribe_event_display=list&tribe-bar-date=<?php echo date("Y"); ?>-11-01">Nov</option>
            <option value="/calendar/?action=tribe_list&tribe_paged=1&tribe_event_display=list&tribe-bar-date=<?php echo date("Y"); ?>-12-01">Dec</option>
          </select>

        </div>
      </div>
    </div>
    <a class="carouselBtn prevBtn"><i class="ss-icon ss-gizmo">navigateleft</i></a>
    <a class="carouselBtn nextBtn"><i class="ss-icon ss-gizmo">navigateright</i></a>
    <div id="upcoming-events-carousel" class="desktop-12 contained">

      <?php
        $args = array(
          'showposts'   => 9,
          'post_type'   => 'tribe_events',
          'tax_query' => array(
            array(
              'taxonomy' => 'tribe_events_cat',
              'field'    => 'slug',
              'terms'    => array('hidden'),
              'operator'  => 'NOT IN'
            ),
          ),
        );

        $temp = $wp_query;
        $wp_query = null;
        $wp_query = new WP_Query();
        $wp_query->query($args);

        while ($wp_query->have_posts()) : $wp_query->the_post();
      ?>

      <?php get_template_part('templates/home/events-carousel', 'item' ); ?>

      <?php endwhile; ?>

      <?php
        $wp_query = null;
        $wp_query = $temp;  // Reset
      ?>

    </div>
  </div>
</div>

<div id="home-featured">
  <div class="row">
    <header class="desktop-10 tablet-6 mobile-3 centered">
      <hr>
      <a href="#spotlight-events">
        <i class="ss-icon ss-gizmo home-arrow left ">down</i>
        <h3 id="spotlight-events"><a href="/calendar">Spotlight<span> | View Full Calendar</span></a></h3>
      </a>
    </header>
    <div class="desktop-12 tablet-6 mobile-3">
      <div class="slider rsMinW">
        <?php

          if( have_rows('featured_slider_bottom', 'options') ):
          while ( have_rows('featured_slider_bottom', 'options') ) : the_row();

          $post_object = get_sub_field('slide_post');
          $post = $post_object;
          setup_postdata( $post );

          get_template_part('templates/home/slider', 'bottom' );

          wp_reset_postdata();
          endwhile; endif;


        ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
