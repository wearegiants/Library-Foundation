

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