<?php
  $args = array( 'page_id' => 547 );
  $the_query = new WP_Query( $args );
?>

<?php  while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<div class="desktop-4 right">
  <h3 class="title"><?php the_title(); ?></h3>
  <?php the_post_thumbnail(); ?>
  <?php the_content(); ?>
  <a href="<?php the_permalink(); ?>" class="button">Join Today</a>
</div>
<?php endwhile; wp_reset_postdata(); ?>

<div id='PORRA' class='white-popup mfp-hide open'>
Popup content
</div>

<script>
  $(window).load(function(){
    setTimeout(function(){
      $.magnificPopup.open({
        items: {
          src: '/assets/img/membership-cta.png'
        },
        mainClass: 'mfp-fade',
        type: 'image'
      }, 0);
    }, 2000);
  });
</script>

