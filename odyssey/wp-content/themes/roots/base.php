<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>
<div id="top"></div>

<?php

if ( is_front_page() && is_home() ) {
  echo 'yolo';// Default homepage
} elseif ( is_front_page() ) {
  include('snippets/home-thing.php');
}

if ( is_front_page() && is_home() ) {

} elseif ( is_front_page() ) {

} elseif ( is_home() ) {

} else {?>
	<h1 id='site-logo' class="page col-md-4 col-lg-5 col-sm-8 col-centered text-center">
	<a href="/odyssey"><img class="img-responsive" src="/odyssey/wp-content/themes/roots/assets/img/odyssey-logob.png" alt="<?php bloginfo('name'); ?>" /></a>
	</h1>
<?php }

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
