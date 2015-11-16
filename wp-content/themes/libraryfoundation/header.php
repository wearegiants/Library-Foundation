<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title><?php wp_title(' | ', true, 'right'); ?></title>
<meta name="description" content="<?php bloginfo( 'description' ) ?>">
<link rel="shortcut icon" href="/assets/img/favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->


<?php wp_head(); ?>


<!--[if lt IE 9]>
<script src="/assets/javascripts/respond.min.js"></script>
<script src="/assets/javascripts/pie.js"></script>
<![endif]-->


<script src="//use.typekit.net/kfw6qzi.js"></script>
<script>try{Typekit.load();}catch(e){}</script>
</head>

<?php
  $menuParameters = array(
    'container'       => false,
    'echo'            => false,
    'items_wrap'      => '%3$s',
    'theme_location'  =>'main-menu',
    'walker'          => new MV_Cleaner_Walker_Nav_Menu(),
    'depth'           => 0,
  );
?>

<body <?php body_class('shifter'); ?>>
  <div id="wrapper" class="shifter-page"><div>
    <header id="head" class="gridlock gridlock-fluid">
      <div class="row">
        <nav id="main-nav" class="desktop-12 tablet-6 mobile-3">
          <a href="/" id="logo">
            <div id="swiper">
              <div class="swiper-container">
                <div class="swiper-wrapper">
                  <div id="lfla-logo" class="swiper-slide" style="background-image:url(/assets/img/logos/logo-general.png)"></div>
                  <div id="program-logo" class="swiper-slide"></div>
                </div><!--Swiper-Wrapper-->
              </div><!--Swiper-Container-->
            </div><!--Swiper-->
          </a>
          <div class="main-nav"><?php echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' ); ?></div>
          <a href="#" class="search"><i class="ss-gizmo ss-icon">search</i></a>
          <span class="shifter-handle button right">Menu</span>
          <a href="<?php echo get_the_permalink(299); ?>" class="button right hide-mobile" id="become-member-btn">Donate</a>
          <a href="<?php echo get_the_permalink(289); ?>" class="button right hide-mobile" id="become-member-btn">Join</a>
        </nav>
      </div>
    </header>
    <section id="content" class="gridlock">
      <div>
        <div <?php body_class(); ?>>

