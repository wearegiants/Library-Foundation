<?php 
  $temp = $wp_query; 
  $wp_query = null; 
  $wp_query = new WP_Query(); 
  $wp_query->query('showposts=6&post_type=tribe_events'.'&paged='.$paged); 

  while ($wp_query->have_posts()) : $wp_query->the_post(); 

  get_template_part('templates/events/list', 'item');

  endwhile; ?>

  <nav>
    <?php previous_posts_link('&laquo; Newer') ?>
    <?php next_posts_link('Older &raquo;') ?>
  </nav>

<?php 
  $wp_query = null; 
  $wp_query = $temp;  // Reset
?>