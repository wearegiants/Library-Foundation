<div id="sidebar-wrapper" class="desktop-4 tablet-2 mobile-3 right">

  <aside class="sidebar" id="event-sidebar">
    <?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
    <ul class="xoxo">

      <?php dynamic_sidebar( 'primary-widget-area' ); ?>
      <?php dynamic_sidebar( 'general-widget-area' ); ?>

    </ul>
    <?php endif; ?>
  </aside>

</div>