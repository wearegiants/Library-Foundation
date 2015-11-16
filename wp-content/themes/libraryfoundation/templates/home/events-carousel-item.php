<div class="slide">
  <div class="row">
    <div class="">

      <div class="category">
        <?php 
    $terms = wp_get_post_terms(get_the_ID(), 'tribe_events_cat');
    $count = count($terms);
    if ( $count > 0 ){
      foreach ( $terms as $term ) {
        echo '<span class="cat_' . $term->slug . '">' . $term->name . '</span>';
      }
    }
  ?> 
</div>

      <div class="thumbnail">
        <a href="<?php the_permalink(); ?>">
        <?php
          if ( has_post_thumbnail() ) {
            the_post_thumbnail('event-bio', array('class' => 'img-responsive'));
          } else {
            echo '<img src="http://placehold.it/700x375" class="img-responsive">';
          }
        ?>
        </a>
      </div>
      <div class="meta">
        <div class="wrapper sizer-item">

          <?php
            $event_date = tribe_get_start_date($pageID, false, "l, M j, Y | g:ia");
          ?>
          <header>
            <p class="posted"><?php echo $event_date  ?></p>
            <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          </header>
          <div class="desc">
            <p><?php echo excerpt(20); ?></p>
            <a href="<?php the_permalink(); ?>" class="button">Read More</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>