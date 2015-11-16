<?php

  if ( is_page( 'young-literati' ) || is_page( 'membership' ) ) {

    $menuLocation = 41;
    $menuId = 'id="toolbar"';
    $eventsClass = 'page-events';

  } elseif ( is_page( 'blog' ) || is_category() || is_single() ) {

    $menuLocation = 594;
    $eventsClass = '';

  } elseif ( tribe_is_past() || tribe_is_upcoming() && !is_tax() ) {

    $menuLocation = 41;
    $menuId = 'id="toolbar"';
    $eventsClass = 'events';

  } elseif ( is_tax( 'tribe_events_cat' ) ) {

    $menuLocation = 41;
    $menuId = 'id="toolbar"';
    $eventsClass = 'events';

  } else {

    $menuLocation = 2;

  }

  $menuParameters = array(
    'container'       => false,
    'echo'            => false,
    'items_wrap'      => '%3$s',
    'menu'            => $menuLocation,
    'depth'           => 0,
    'walker'          => new MV_Cleaner_Walker_Nav_Menu(),
  );
?>

<div <?php echo $menuId; ?> class="toolbar <?php echo $eventsClass; ?>">
  <div class="row">
    <div class="desktop-12 tablet-6 mobile-hide">
      <ul class="nav sf-menu">
        <?php echo wp_nav_menu( $menuParameters ); ?>
        <li class="right lapl-link"><a href="http://lapl.org" class="external-link">Visit LAPL.org</a></li>
      </ul>
    </div>
  </div>
</div>
