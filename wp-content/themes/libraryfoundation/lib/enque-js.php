<?php 

function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}

function my_input_enqueue() {
	if ( is_page('cart') || is_page('checkout') ){
		wp_register_script('my-script', '/assets/javascripts/jquery.inputmask.bundle.min.js', false, null);
		wp_enqueue_script('my-script');
	}
}

function myscript() {
	if ( is_page('cart') || is_page('checkout') ){
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#billing_phone').inputmask("mask", {
			"mask": "999-999-9999",
			onincomplete: function () {
				$('.place-order').css('position','relative').append('<a id="submit-link" href="#billing_email_field" class="coverlink"></a>');
				$('#place_order').css({opacity:.5,pointerEvents: 'none'});
				if ($('#submit-link-span').length > 0) { 
					
				} else {
					$('#billing_phone_field label').append('<span id="submit-link-span" class="right" style="color:red">Please enter your phone number</span>');
				}
			},
			oncomplete: function () {
				$('#place_order').css({opacity:1,pointerEvents: 'auto'});
				$('#submit-link').remove();
				$('#submit-link-span').remove();
			},
		}); //specifying fn & options
	});
</script>
<?php
}
}
add_action( 'wp_footer', 'myscript' );

function myscript_jquery() {
    wp_enqueue_script( 'my_input_enqueue' );
}

if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
if (!is_admin()) add_action("wp_enqueue_scripts", "my_input_enqueue", 11);
