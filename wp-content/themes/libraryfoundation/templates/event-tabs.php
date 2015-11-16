<div class="tabbed">
  <menu class="tabber-menu">
    <a href="#tab-1" class="active tabber-handle"><?php the_field('tab_1_name'); ?></a>
    <a href="#tab-2" class="tabber-handle"><?php the_field('tab_2_name'); ?></a>
  </menu>
  <div class="active tabber-tab" id="tab-1"></div>
  <div class="tabber-tab" id="tab-2"></div>
</div>

<script>

  $(document).ready(function(){
    // Create the tab wrapper
    $('.tribe-events-tickets .ticket').hide();
    
  <?php 
    
    // First Tab
    while ( have_rows('related_ticket_groups') ) : the_row();
    $post_object = get_sub_field('tickets');
    if( $post_object ): 
    $post = $post_object;
    setup_postdata( $post ); 

    $title = get_the_title($post);
    $title = preg_replace('/[^A-Za-z0-9]/', '', $title);
    // convert the string to all lowercase
    $title = strtolower($title);

  ?>
  $(".ticket_<?php echo $title; ?>").prependTo("#tab-1").show(); 
  <?php wp_reset_postdata(); endif; ?>
    
  <?php endwhile; ?>

  <?php 
    
    // Second Tab
    while ( have_rows('related_ticket_2') ) : the_row();
    $post_object = get_sub_field('tickets');
    if( $post_object ): 
    $post = $post_object;
    setup_postdata( $post ); 

    $title = get_the_title($post);
    $title = preg_replace('/[^A-Za-z0-9]/', '', $title);
    // convert the string to all lowercase
    $title = strtolower($title);

  ?>
  $(".ticket_<?php echo $title; ?>").prependTo("#tab-2").show(); 
  <?php wp_reset_postdata(); endif; ?>
    
  <?php endwhile; ?>


});

</script>

