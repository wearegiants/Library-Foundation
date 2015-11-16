<?php while (have_posts()) : the_post(); ?>

<div class="event-content">
  <div class="row">
    <div class="desktop-7 tablet-6 mobile-3">

      <?php if( have_rows('related_ticket_groups') ): ?>
      <?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
      <?php endif; ?>

      <div class="content"><?php the_content(); ?></div>
      <?php include locate_template('templates/event-bios.php'); ?>
      <?php include locate_template('templates/events/event-bios-simple.php'); ?>
      <?php include locate_template('templates/events/recommended-reading.php'); ?>
    </div>
    <?php get_sidebar('event'); ?>
  </div>
</div>

<?php endwhile; ?>
