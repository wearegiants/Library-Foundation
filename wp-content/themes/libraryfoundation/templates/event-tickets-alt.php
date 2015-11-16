<?php if( have_rows('password_protected_2', 'options') ): ?>

<script>

$(document).ready(function(){

<?php
  while ( have_rows('password_protected_2', 'options') ) : the_row();

  $ticket_name = get_sub_field('event_name');
  $ticket_name = preg_replace('/[^A-Za-z0-9]/', '', $ticket_name);
  // convert the string to all lowercase
  $ticket_name = strtolower($ticket_name);

?>

  $(".ticket_<?php echo $ticket_name; ?> .tickets_name").append('<a href="#modal_<?php echo $ticket_name; ?>_box" class="alert">Members Only: Click to unlock</a>');
  $(".ticket_<?php echo $ticket_name; ?> .quantity input").prop('disabled', true);

  // Login form <?php echo $ticket_name; ?>


  $("#login_<?php echo $ticket_name; ?>").click(function(){

    if( $("#loginpassword_<?php echo $ticket_name; ?>").val()=="<?php the_sub_field('password'); ?>") {

      $(".ticket_<?php echo $ticket_name; ?> .quantity input").prop('disabled', false);
      $.magnificPopup.close();
      $(".quantity input").stepper("enable");
      $(".alert").addClass('active').text("Awesome, you're in.");

    }else {

      alert("Please try again");

    }

  });

  $(window).keydown(function(event){

    if(event.keyCode == 13) {

      event.preventDefault();

      if( $("#loginpassword_<?php echo $ticket_name; ?>").val()=="<?php the_sub_field('password'); ?>") {

        $(".ticket_<?php echo $ticket_name; ?> .quantity input").prop('disabled', false);
        $.magnificPopup.close();
        $(".quantity input").stepper("enable");
        $(".alert").addClass('active').text("Awesome, you're in.");

      } else {

       // alert("Please try again");

      }

      return false;
    }

  });

  // $("#ticket_<?php echo $ticket_name; ?>").click(function(){
  //   $.magnificPopup.open({
  //     items: {
  //       src: '#modal_<?php echo $ticket_name; ?>_box',
  //       type: 'inline',
  //     },
  //     preloader: false,
  //     mainClass: 'mfp-fade gridlock gridlock-fluid',
  //     callbacks: {
  //       open: function() {
  //         $('body').addClass('.members-only-ignited');
  //       },
  //       close: function() {
  //         $('body').removeClass('.members-only-ignited');
  //       },
  //     },
  //   }, 0);
  // });

<?php endwhile; ?>

});

$(document).ready(function(){
  $('.alert').magnificPopup({
    type: 'inline',
    preloader: false,
    //closeBtnInside: false,
    mainClass: 'mfp-fade gridlock gridlock-fluid',
    callbacks: {
      open: function() {
        $('body').addClass('.members-only-ignited');
      },
      close: function() {
        $('body').removeClass('.members-only-ignited');
      },
    }
  });
});


</script>

<?php endif; ?>

<?php // Heres where the boxes go ?>

<?php if( have_rows('password_protected_2', 'options') ): ?>
<?php
  while ( have_rows('password_protected_2', 'options') ) : the_row();
?>

<div id="modal_<?php echo $ticket_name; ?>_box" class="pass mfp-hide white-popup-block modal-window">
  <h2>Unlock <?php the_sub_field('event_name'); ?></h2>
  <p class="message"><a href="/membership">Click here if you're not already a member.</a></p>
  <form action="" method="post" class="row">
    <div>
    <input type="password" id="loginpassword_<?php echo $ticket_name; ?>" placeholder="Password" class="desktop-9 tablet-5 mobile-3" />
    <input type="button" id="login_<?php echo $ticket_name; ?>" value="Unlock" class="desktop-3 tablet-1 mobile-3 login-btn" />
    </div>
  </form>
</div>

<?php endwhile; ?>
<?php endif; ?>