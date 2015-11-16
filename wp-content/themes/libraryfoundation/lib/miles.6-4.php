<?php

//Was there a book ordered in an order
function book_ordered($order_id, $event_id = null, $show_titles = false) {
	global $wpdb;
	$book_ordered = "No";

	// Get ticket id for the event
	// Sample event id = 5817
	// need to query post_meta where key = _tribe_wooticket_for_event = 5817

	$ticket_query = "
		SELECT 		post_id
		FROM 		{$wpdb->prefix}postmeta
		WHERE		meta_key = '_tribe_wooticket_for_event'
		AND			meta_value = %d
	";

  	$ticket = $wpdb->get_row( $wpdb->prepare($ticket_query, $event_id), ARRAY_A );



	if(NULL !== $ticket) {
		//echo "<h1>Ticket: {$ticket['post_id']}";
		$ticket_id = $ticket['post_id'];
		$related_products = array();

		$book_query = "
			SELECT		meta_value
			FROM		{$wpdb->prefix}postmeta
			WHERE		meta_key = '_crosssell_ids'
			AND 		post_id = %d
		";
		$linked_products = $wpdb->get_var( $wpdb->prepare($book_query, $ticket_id) );
		if(NULL !== $linked_products) {
			$related_products = unserialize($linked_products);
		}
	} else {
		return "No";
	}



	$order = new WC_Order( $order_id );
	$items = $order->get_items();
	$quantity = 0;
	if (TRUE === $show_titles) {
		$books = array();
	}
	foreach($items as $item) {
		$terms = get_the_terms( $item['product_id'], 'product_cat' );
		foreach ($terms as $term) {
			if(substr($term->slug,0,4) === "book") {
				if(in_array($item['product_id'], $related_products)) {
					if (TRUE === $show_titles) {
						if(!isset($books[$item['name']])) {
							$books[$item['name']] = $item['qty'];
						} else {
							$books[$item['name']] += $$item['qty'];
						}
					} else {
						$quantity += $item['qty'];
					}
				}
				$book_ordered = "Yes($quantity)";

			}
		}
	}

	if(TRUE === $show_titles) {
		if(count($books) >0) {
			$book_ordered="";
			foreach($books as $title => $qty) {
				$book_ordered .= "$title ($qty), ";
			}
			$book_ordered = substr($book_ordered,0,-2);
		}
	}
	return $book_ordered;

}




/**
 * Only show donation if there is a row with the aloud-event shown in the shopping cart
**/
function wc_checkout_add_ons_conditionally_show_donation_add_on() {

    wc_enqueue_js("

    	if($('tr.aloud-event').length == 0) {
      	$( '#wc_checkout_add_ons' ).hide();
      }

      setTimeout(function(){
    	if($('.fee').length == 0) {


    	} else {
    		$( '#wc_checkout_add_ons' ).show();

    	}
    },2000);


	$('#wc_checkout_add_ons_5').change(function() {
      	console.log('value changed to ' + $(this).val());
		var donationValue = $(this).val();
		if(donationValue == 0) {
			console.log('$0 donation selected');
			$('.woocommerce form #customer_details #billing_address_1_field,.woocommerce-page form #customer_details #billing_address_1_field,.woocommerce form.checkout #billing_address_1_field').css('display', 'none');
			$('.woocommerce form #customer_details #billing_address_2_field, .woocommerce-page form #customer_details #billing_address_2_field, .woocommerce form.checkout #billing_address_2_field').css('display', 'none');
			$('.woocommerce form #customer_details #billing_city_field,.woocommerce-page form #customer_details #billing_city_field,.woocommerce form.checkout #billing_city_field').css('display', 'none');
			$('.woocommerce form #customer_details #billing_state_field,.woocommerce-page form #customer_details #billing_state_field,.woocommerce form.checkout #billing_state_field').css('display', 'none');
			$('.woocommerce form #customer_details #billing_postcode_field,.woocommerce-page form #customer_details #billing_postcode_field,.woocommerce form.checkout #billing_postcode_field').css('display', 'none');
			$('.woocommerce form #customer_details #billing_phone_field,.woocommerce-page form #customer_details #billing_phone_field,.woocommerce form.checkout #billing_phone_field').css('display', 'none');
			$('.woocommerce form #customer_details #billing_myfield16_field,.woocommerce-page form #customer_details #billing_myfield16_field,.woocommerce form.checkout #billing_myfield16_field').css('display', 'none');
		} else {
			console.log(donationValue + ' donation selected');
			$('.woocommerce form #customer_details #billing_address_1_field,.woocommerce-page form #customer_details #billing_address_1_field,.woocommerce form.checkout #billing_address_1_field').css('display', 'block');
			$('.woocommerce form #customer_details #billing_address_2_field, .woocommerce-page form #customer_details #billing_address_2_field, .woocommerce form.checkout #billing_address_2_field').css('display', 'block');
			$('.woocommerce form #customer_details #billing_city_field,.woocommerce-page form #customer_details #billing_city_field,.woocommerce form.checkout #billing_city_field').css('display', 'block');
			$('.woocommerce form #customer_details #billing_state_field,.woocommerce-page form #customer_details #billing_state_field,.woocommerce form.checkout #billing_state_field').css('display', 'block');
			$('.woocommerce form #customer_details #billing_postcode_field,.woocommerce-page form #customer_details #billing_postcode_field,.woocommerce form.checkout #billing_postcode_field').css('display', 'block');
			$('.woocommerce form #customer_details #billing_phone_field,.woocommerce-page form #customer_details #billing_phone_field,.woocommerce form.checkout #billing_phone_field').css('display', 'block');
			$('.woocommerce form #customer_details #billing_myfield16_field,.woocommerce-page form #customer_details #billing_myfield16_field,.woocommerce form.checkout #billing_myfield16_field').css('display', 'block');
		}
      });


    ");



}
add_action( 'wp_enqueue_scripts', 'wc_checkout_add_ons_conditionally_show_donation_add_on' );

add_action( 'manage_edit-tribe_events_columns', 'add_ticket_status_column', 10, 2 );
//add_filter( 'tribe_events_tickets_attendees_table_column', 'populate_my_custom_attendee_column', 10, 3 );

function add_ticket_status_column( $columns ) {
    $columns['ticket_sales'] = 'Ticket Sales';
    return $columns;
}
/*
This is in the plugin currently
//add_filter( 'manage_tribe_events_page_tickets-attendees_columns', 'add_my_custom_attendee_column', 20 );
add_filter( 'edit-tribe_events_columns', 'populate_my_custom_event_column', 10, 3 );


function populate_my_custom_event_column( $existing, $item, $column, $order_id ) {


	switch($column) {
		case 'ticket_sales':
			return "1/10";
		default:
			return "55".$existing;
	}

	//return $existing;
}
*/

//http://docs.woothemes.com/document/woocommerce-customer-order-csv-export-developer-documentation/
add_filter('wc_customer_order_csv_export_order_row', 'override_wc_customer_order_csv_export_order_row',10,3);

function override_wc_customer_order_csv_export_order_row($order_data, $order, $csv_generator) {

	$custom_data = array(
		'net_revenue' => get_post_meta( $order->id, 'Net Revenue From Stripe', true ),
		'stripe_fee' => get_post_meta( $order->id, 'Stripe Fee', true ),
		'stripe_id' => get_post_meta( $order->id, 'Stripe Payment ID', true ),
	);

	$new_order_data = array();

	if ( isset( $csv_generator->order_format ) && ( 'default_one_row_per_item' == $csv_generator->order_format || 'legacy_one_row_per_item' == $csv_generator->order_format ) ) {

		foreach ( $order_data as $data ) {
			$new_order_data[] = array_merge( (array) $data, $custom_data );
		}

	} else {

		$new_order_data = array_merge( $order_data, $custom_data );
	}

	return $new_order_data;

}


// Removing columns from the export and add the stripe columns
function lf_wc_customer_order_csv_export_order_headers( $column_headers ) {

	// the list of column keys can be found in class-wc-customer-order-csv-export-generator.php
	unset( $column_headers['order_id'] );
	unset( $column_headers['billing_country']);
	unset( $column_headers['order_currency']);
	unset( $column_headers['payment_method']);
	unset( $column_headers['shipping_method']);
	unset( $column_headers['customer_id']);
	unset( $column_headers['customer_note']);
	unset( $column_headers['item_tax']);
	unset( $column_headers['item_meta']);
	unset( $column_headers['shipping_items']);
	unset( $column_headers['order_notes']);
	unset( $column_headers['download_permissions_granted']);
	unset( $column_headers['myfield3']);
	unset( $column_headers['myfield4']);
	unset( $column_headers['myfield26']);
	unset( $column_headers['shipping_country']);


	$new_headers = array (
		'net_revenue'	=> 'Net Revenue',
		'stripe_fee'	=> 'Stripe Fee',
		'stripe_id'		=> 'Stripe Id'
	);
	return array_merge($column_headers, $new_headers);
}
add_filter( 'wc_customer_order_csv_export_order_headers', 'lf_wc_customer_order_csv_export_order_headers' , 10);

// reorder columns
function lf_wc_csv_export_reorder_columns( $column_headers ) {
	//echo '<pre>'.print_r($column_headers,true).'</pre><hr><hr>';
	$new_column_headers = array();

	// Should the field set be limited.
	if(isset($_POST['wc_customer_order_csv_export_limit_fields'])
		&& 	$_POST['wc_customer_order_csv_export_limit_fields'] == 0) {
		$new_column_headers['order_number'] = $column_headers['order_number'];
		$new_column_headers['order_date'] = $column_headers['order_date'];
		$new_column_headers['billing_first_name'] = $column_headers['billing_first_name'];
		$new_column_headers['billing_last_name'] = $column_headers['billing_last_name'];
		$new_column_headers['item_name'] = $column_headers['item_name'];
        $new_column_headers['fee_total'] = $column_headers['fee_total'];
        $new_column_headers['fee_items'] = $column_headers['fee_items'];
        $new_column_headers['coupons'] = $column_headers['coupons'];
        $new_column_headers['item_total'] = $column_headers['item_total'];
        $new_column_headers['tax_total'] = $column_headers['tax_total'];
        $new_column_headers['discount_tota'] = $column_headers['discount_total'];
		$new_column_headers['stripe_fee'] = $column_headers['stripe_fee'];
		$new_column_headers['net_revenue'] = $column_headers['net_revenue'];
		$new_column_headers['item_quantity'] = $column_headers['item_quantity'];
		return $new_column_headers;
	}

	$purge_array_billing = array(
		'_billing_myfield4'		=> $column_headers['_billing_myfield4'],
		'billing_last_name'		=> $column_headers['billing_last_name'],
		'billing_first_name'	=> $column_headers['billing_first_name'],
		'billing_company'		=> $column_headers['billing_company'],
		'billing_email'			=> $column_headers['billing_email'],
		'billing_phone'			=> $column_headers['billing_phone'],
		'billing_address_1'		=> $column_headers['billing_address_1'],
		'billing_address_2'		=> $column_headers['billing_address_2'],
		'billing_city'			=> $column_headers['billing_city'],
		'billing_state'			=> $column_headers['billing_state'],
		'billing_postcode'		=> $column_headers['billing_postcode'],
		'shipping_total'		=> $column_headers['shipping_total'],
		'shipping_tax_total'	=> $column_headers['shipping_tax_total'],
		'fee_total'				=> $column_headers['fee_total'],
		'fee_tax_total'			=> $column_headers['fee_tax_total'],
		'tax_total'				=> $column_headers['tax_total'],
		'cart_discount'			=> $column_headers['cart_discount'],
		'order_discount'		=> $column_headers['order_discount'],
		'discount_total'		=> $column_headers['discount_total']
	);

	$purge_array_status = array (
		'shipping_company'		=> $column_headers['shipping_company'],
		'shipping_first_name'	=> $column_headers['shipping_first_name'],
		'shipping_last_name'	=> $column_headers['shipping_last_name'],
		'shipping_address_1'	=> $column_headers['shipping_address_1'],
		'shipping_address_2'	=> $column_headers['shipping_address_2'],
		'shipping_city'			=> $column_headers['shipping_city'],
		'shipping_state'		=> $column_headers['shipping_state'],
		'shipping_postcode'		=> $column_headers['shipping_postcode'],
		'status'				=> $column_headers['status']
	);

	$purage_array_order_total = array(
		'net_revenue'			=> $column_headers['net_revenue'],
		'stripe_fee'			=> $column_headers['stripe_fee'],
		'stripe_id'				=> $column_headers['stripe_id'],
		'item_refunded'			=> $column_headers['item_refunded'],
		'refunded_total'		=> $column_headers['refunded_total']
	);


	// Remove all the columns from the above arrays from the column list so they
	// can be readded back in the appropriate spot
	foreach(array_keys(array_merge(
						$purge_array_billing,
						$purge_array_status,
						$purage_array_order_total
						)
					) as $field) {
		unset($column_headers[$field]);
	}

	foreach ( $column_headers as $key => $value ) {
		$new_column_headers[ $key ] = $value;

		switch($key) {
			case 'order_date':
				foreach($purge_array_billing as $pkey => $pvalue) {
					$new_column_headers[$pkey] = $pvalue;
				}
				break;
			case 'checkout_add_on_total_5':
				foreach($purge_array_status as $pkey => $pvalue) {
					$new_column_headers[$pkey] = $pvalue;
				}
				break;
			case 'order_total':
				foreach($purage_array_order_total as $pkey => $pvalue) {
					$new_column_headers[$pkey] = $pvalue;
				}
				break;
			default:
		}
	}

	//echo '<pre>'.print_r($new_column_headers,true).'</pre><hr><hr>';
	//die;
	return $new_column_headers;
}

// This filter needs a higher weight to make sure that it's the last one to run
add_filter( 'wc_customer_order_csv_export_order_headers', 'lf_wc_csv_export_reorder_columns' , 100);


// Adding in custom option to not show free orders
function lf_wc_customer_order_csv_export_settings($settings, $tab_id) {

	if($tab_id == "export") {
		$new_settings = array();
		foreach($settings as $set) {
			$new_settings[] = $set;
			if($set['id'] == 'wc_customer_order_csv_export_statuses') {
				$new_settings[] = array(
					'id'       => 'wc_customer_order_csv_export_hide_free_orders',
					'name'     => __( 'Exclude $0 Orders', WC_Customer_Order_CSV_Export::TEXT_DOMAIN ),
					'desc_tip' => __( 'Should $0 Orders be excluded in the export.', WC_Customer_Order_CSV_Export::TEXT_DOMAIN ),
					'type'     => 'select',
					'options'  => array("1" => "Yes", "0" => "No"),
					'default'  => '1',
					'class'    => 'wc-enhanced-select chosen_select show_if_orders'
				);

				$new_settings[] = array(
					'id'       => 'wc_customer_order_csv_export_limit_fields',
					'name'     => __( 'Export All Fields', WC_Customer_Order_CSV_Export::TEXT_DOMAIN ),
					'type'     => 'select',
					'options'  => array("1" => "Yes", "0" => "No"),
					'default'  => '1',
					'class'    => 'wc-enhanced-select chosen_select show_if_orders'
				);
			}

		}
		return $new_settings;
	}

	return $settings;
}

add_filter('wc_customer_order_csv_export_settings', 'lf_wc_customer_order_csv_export_settings', 10, 2);


function lf_wc_customer_order_csv_export_admin_query_args($query_args, $export_type, $obj) {

	if(isset($_POST['wc_customer_order_csv_export_hide_free_orders'])
		&& $_POST['wc_customer_order_csv_export_hide_free_orders'] == 1
		&& $export_type == 'orders') {
		$query_args['meta_query'] = array (array(
			'key' 		=> '_order_total',
			'value' 	=> '0.00',
			'compare' 	=> '>'
		));

	}

	return $query_args;
}


add_filter('wc_customer_order_csv_export_admin_query_args', 'lf_wc_customer_order_csv_export_admin_query_args', 10, 3);
