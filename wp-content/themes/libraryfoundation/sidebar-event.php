<div id="sidebar-wrapper" class="desktop-4 tablet-6 mobile-3 right sizer-item">

  <?php include locate_template('/templates/events/event-sidebar-general.php'); ?>
  <?php include locate_template('/templates/events/event-sidebar-donate.php'); ?>
  <?php include locate_template('/templates/events/event-sidebar-articles.php'); ?>
  <?php include locate_template('/templates/events/event-sidebar-gallery.php'); ?>


  <aside class="sidebar" id="event-sidebar">
    <ul class="xoxo">

      <?php include locate_template('/templates/events/event-sidebar-book.php'); ?>
      <?php if (!get_field('short_sidebar')): ?>
      <?php dynamic_sidebar( 'general-widget-area' ); ?>
      <?php endif; ?>
      <?php if (get_field('short_sidebar')): ?>
      <div id="member-widget">
  <div class="wrapper">
    <h3>Become a Member</h3>
    <p>
      Library Foundation Membership gives you special access to public programs,
      opening parties, and puts you in the mix of L.A.'s vibrant literary and
      culture scene.
    </p>
  </div>
  <a href="#">Join Now</a>
</div>
      <?php endif; ?>
    </ul>
  </aside>


</div>