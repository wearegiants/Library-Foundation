<div id="event-bios">
  <div class="row">
    <div class="item bio desktop-12">
      <h3 class="title"><?php the_title(); ?></h3>
      <?php echo get_the_post_thumbnail( $p->ID, 'event-bio', array( 'class' => 'img-responsive' ) ); ?> 
      <?php echo get_the_content( $p->ID ); ?>
    </div>
  </div>
</div>
