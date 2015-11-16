<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

<?php 

if ( is_front_page() && is_home() ) {
  echo 'yolo';// Default homepage
} elseif ( is_front_page() ) {
  include('snippets/home-thing.php');
}

?>

<?php do_action('get_header'); get_template_part('templates/header'); ?>

<div class="wrap container-fluid" role="document">
<div class="content row">
<main class="main <?php echo roots_main_class(); ?>" role="main">

<?php include roots_template_path(); ?>


</main>
</div>
</div>

<?php get_template_part('templates/footer'); ?>

</body>
</html>
