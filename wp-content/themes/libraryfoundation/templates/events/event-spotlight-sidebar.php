<div id="event-spotlight-slider">

<header>
<span>Event Spotlight</span>
</header>

<div class="slider rsMinW">
<?php 

  if( have_rows('featured_slider_bottom', 'options') ): 
  
    while ( have_rows('featured_slider_bottom', 'options') ) : the_row(); 
    $post_object = get_sub_field('slide_post');
    $post = $post_object;
    setup_postdata( $post ); 

  if ( has_post_thumbnail() ) {

    $featuredImage = get_the_post_thumbnail($page->ID,'header-bg', array('class' => 'rsImg'));

  } else {

    $featuredImage = '<img src="http://placehold.it/1200x500/C9B6F2" class="rsImg">';

  }

?>

<div class="slide">
  <?php echo $featuredImage; ?>
  <div class="meta">
    <div class="row">
      <div class="desktop-12">
        <div class="wrapper">
          <h2 class="title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
          <a class="button" href="<?php the_permalink();?>">View More</a>
        </div>
      </div>
    </div>
  </div>
  <div class="overlay"></div>
</div>

<?php

  wp_reset_postdata();
  endwhile; endif;

?>
</div>
</div>