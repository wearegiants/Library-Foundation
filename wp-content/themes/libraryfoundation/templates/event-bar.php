<?php

  $cost = tribe_get_cost();

  $yolo = strlen($cost);

  if ( $cost == 'Free') {
    $cost = 0;
  } else {
    $cost = tribe_get_cost();
  }

  if( have_rows('related_ticket_groups') ) {

    if( tribe_get_end_date( null, true, 'Y-m-d H:i:s' ) < date( 'Y-m-d H:i:s' )) {

      $ticketStatus = '<a id="event-status-button"  href="#" class="button disabled ticket-status-1">This Event Has Passed</a>';

    } else {

      if ($cost>0) {
      //if (strlen($cost)>0) {
        $ticketStatus = '<a id="event-status-button" href="#things" class="button jumpdown ticket-status-2">Purchase Tickets</a>';
      } else {
        $ticketStatus = '<a id="event-status-button" href="#things" class="button jumpdown ticket-status-3">RSVP</a>';
      }
    }

   } else {

    if( tribe_get_end_date( null, true, 'Y-m-d H:i:s' ) < date( 'Y-m-d H:i:s' )) {

      $ticketStatus = '<a id="event-status-button"  href="#" class="button disabled ticket-status-4">This Event Has Passed</a>';

    } else {

      if(tribe_events_has_tickets()){

        if ( ! post_password_required() ) {



        if ($cost>0) {
          $ticketStatus = '<a id="event-status-button"  href="#tickets-form" class="button enabled ticket-status-5">Purchase Tickets</a>';
        } else {
          $ticketStatus = '<a id="event-status-button"  href="#tickets-form" class="button enabled ticket-status-6">RSVP</a>';
        }

        } else {

        $ticketStatus = '<a id="event-status-button"  href="#tickets-form" class="button enabled ticket-status-7">Members Only</a>';

        }

      }

      if(tribe_events_has_soldout()){

        $soldoutimage = '/assets/img/aloud-cta.png';
        if ($cost>0) {
          $ticketStatus = '<a id="event-status-button"  href="#" class="button disabled ticket-status-8">Sold Out</a>'; 
        } else {
          $ticketStatus = '<a id="event-status-button"  href="'.$soldoutimage.'" class="button closed ticket-status-9">Full/Standby</a>';
          ?>
          <script>
          $(window).load(function(){
            setTimeout(function(){
              $.magnificPopup.open({
                items: {
                  src: '<?php echo $soldoutimage; ?>'
                },
                mainClass: 'mfp-fade',
                type: 'image'
              });
            }, 0);
          });
        </script>
        <?php 
        } 

        ?>

      <?php }

    }

  }

?>


<div id="event-bar" class="toolbar">
  <div class="row">
    <nav class="desktop-8 tablet-4 mobile-2">
      <?php echo $ticketStatus; ?>
      <a id="event-calenar-button" href="<?php the_permalink(); ?>?ical=1" class="button hide-mobile">Add to Calendar</a>
    </nav>
    <nav class="desktop-4 tablet-2 mobile-1 text-right">
      <?php include locate_template('templates/share.php' );?>
      <a href="#faq" class="button">FAQ</a>
      <!--<a href="#reservation-policy" class="button">Reservation Policy</a>-->
    </nav>
  </div>
</div>


<div id="tickets-form" class="mfp-hide white-popup-block modal-window">
  <?php if( have_rows('related_ticket_groups') ){} else {?>
  <?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
  <?php }?>
  <div id="password-entry">
    <a href="#" class="cancel"><i class="ss-icon ss-gizmo">close</i></a>

    <?php if( have_rows('password_protected_2', 'options') ): ?>
    <?php while ( have_rows('password_protected_2', 'options') ) : the_row(); ?>

    <?php
      $ticket_name = get_sub_field('event_name');
      $ticket_name = preg_replace('/[^A-Za-z0-9]/', '', $ticket_name);
      // convert the string to all lowercase
      $ticket_name = strtolower($ticket_name);
      ?>

    <div id="<?php echo $ticket_name; ?>_password" class="password-entry" style="display:none">
      <form action="" method="post" class="password-form row">
        <input type="text" id="alt_loginpassword_<?php echo $ticket_name; ?>" placeholder="Password" class="desktop-9 tablet-5 mobile-3" />
        <input type="button" id="alt_login_<?php echo $ticket_name; ?>" value="Unlock" class="login desktop-3 tablet-1 mobile-3" />
      </form>
    </div>

    <?php endwhile; ?>
    <?php endif; ?>

  </div>
</div>