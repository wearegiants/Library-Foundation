<?php
/// woocommerce checkbox fix 

    add_action('admin_head', 'product_protector_checkbox_fix');

function product_protector_checkbox_fix() {
  echo '<style>
    ._product_pass_checkbox_field {
      display: block !important;
    } 
  </style>';
}

// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );

// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );

function woo_new_product_tab_content() {
 
	// The new tab content
 
	echo '<h2>New Product Tab</h2>';
	echo '<p>Here\'s your new product tab.</p>';
	
}


function woo_add_custom_general_fields() { //добавим поля к продукту
 
  global $woocommerce, $post;
  
  echo '<div class="options_group">';
  
	// Custom fields will be created here...
	// Checkbox
	woocommerce_wp_checkbox( 
	array( 
		'id'            => '_product_pass_checkbox', 
		'wrapper_class' => 'show_if_simple', 
		'label'         => __('Product protector enable', 'woocommerce' ), 
		'description'   => __( 'Check me to enable request password for this product', 'woocommerce' ) 
		)
	);

	// Text Field
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_product_individual_password_', 
			'label'       => __( 'Set individual password', 'woocommerce' ), 
			'description' => __( 'You can also set individual password for this product if you wish (Note: This will override your global products password). To disable this - just leave field empty', 'woocommerce' ) 
		)
	);	
  
  echo '</div>';
	
}

function woo_add_custom_general_fields_save( $post_id ){ //сохраним чекбокс

	// Checkbox
	$woocommerce_checkbox = isset( $_POST['_product_pass_checkbox'] ) ? 'yes' : 'no';
	update_post_meta( $post_id, '_product_pass_checkbox', $woocommerce_checkbox );
	update_post_meta( $post_id, '_product_individual_password_', $_POST['_product_individual_password_'] );

}


?>