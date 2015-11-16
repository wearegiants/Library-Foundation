
<?php 
  $temp = $wp_query; 
  $wp_query = null; 
  $wp_query = new WP_Query(); 
  $wp_query->query('p=4440&post_type=page'); 
  while ($wp_query->have_posts()) : $wp_query->the_post(); 
?>

<div <?php post_class('sidebar'); ?>>
<h3 class="title">Important Member Information</h3>
<?php the_content(); ?>
</div>

<?php endwhile; ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp;  // Reset
?>
