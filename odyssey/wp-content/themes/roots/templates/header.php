<header class="banner navbar navbar-default navbar-static-top" role="banner">
  <div class="container">

  <nav role="navigation" class="col-centered">
    <?php 
      if ( is_front_page() && is_home() ) {
  // Default homepage
      } elseif ( is_front_page() ) {
      if (has_nav_menu('primary_navigation')) : wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav')); endif; 
      } elseif ( is_home() ) {
        // blog page
      } else {
      if (has_nav_menu('secondary_navigation')) : wp_nav_menu(array('theme_location' => 'secondary_navigation', 'menu_class' => 'nav navbar-nav')); endif; 
      }
      
    ?>
  </nav>

  </div>
</header>
