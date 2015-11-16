   
  <div class="event-group">
  
    <div class="event-desc frame"><div class="bit-1"><?php the_sub_field('events_block_description'); ?></div></div>
    <?php if( have_rows('events_block_events') ): while ( have_rows('events_block_events') ) : the_row(); ?>
        
    <div class="event-item frame">
      <div class="bit-4">
        <div class="half"><i class="ss-icon ss-gizmo"><?php the_sub_field('event_category'); ?></i></div>
        <div class="half"><span class="time"><?php the_sub_field('event_time_start'); ?>-<?php the_sub_field('event_time_end'); ?></span></div>
      </div>
      <div class="bit-75"><?php the_sub_field('event_title'); ?></div>
    </div>
    <?php endwhile;  else : echo ('Bummer, no events'); endif; ?>
 
  </div><!-- Event Group -->

