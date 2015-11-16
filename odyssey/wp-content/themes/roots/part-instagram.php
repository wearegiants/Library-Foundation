  <section id="instagram" class="row">
    <div class="container-fluid text-center no-padding">
    <div class="section-header v-centered">
      <h2 class="section_title"><?php the_title(); ?></h2>
    </div>
    
    <?php $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1; // setup pagination
    
    $the_query = new WP_Query( array( 
    'post_type'      => 'instagram',
    'paged'          => $paged,
    //'orderby'        => 'menu_order',
    'posts_per_page' => 12) 
    ); ?>
    
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <div class="instagram-item item col-md-2">
      <?php the_content(); ?>
    
    </div>
    
    <?php endwhile; wp_reset_postdata(); // Rest Data ?>
    
    </div>
  </section>
