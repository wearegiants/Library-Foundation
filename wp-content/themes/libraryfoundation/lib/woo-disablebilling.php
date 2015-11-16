<?php

remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
remove_action( 'woocommerce_order_details_after_order_table', 'woocommerce_order_again_button' );

add_filter( 'wc_stripe_icon', 'new_cards');

function new_cards() {

return get_stylesheet_directory_uri() . "/assets/img/cards.png" ;

}

add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +

function woo_custom_cart_button_text() {

  return __( 'Add to Bag', 'woocommerce' );

}

function so_28348735_category_based_thank_you_message ( $order_id ){

  $order = wc_get_order( $order_id );

  foreach( $order->get_items() as $item ) {

    $hasContent     = false;
    $freeticket     = false;
    $paidticket     = false;
    $donation       = false;
    $membership     = false;
    $memGift        = false;
    $youngLit       = false;
    $giftMembership = false;

    if ( has_term( 'free-lfla-event', 'product_cat', $item['product_id'] ) ) {
      $freeticket = true; $hasContent = true;
    }

    if ( has_term( 'paid-lfla-event', 'product_cat', $item['product_id'] ) ) {
      $paidticket = true; $hasContent = true;
    }

    if ( has_term( 'general-donation', 'product_cat', $item['product_id'] ) ) {
      $donation = true; $hasContent = true;
    }

    if ( has_term( 'membership', 'product_cat', $item['product_id'] ) ) {
      $membership = true; $hasContent = true;
    }

    if ( has_term( 'memorial-gift', 'product_cat', $item['product_id'] ) ) {
      $memGift = true; $hasContent = true;
    }

    if ( has_term( 'young-literati-membership', 'product_cat', $item['product_id'] ) ) {
      $youngLit = true; $hasContent = true;
    }

    if ( has_term( 'gift-membership', 'product_cat', $item['product_id'] ) ) {
      $giftMembership = true; $hasContent = true;
    }

  }

  if ($hasContent === true) {
    echo '<div id="post_confirmation" class="desktop-4 right" style="opacity:0">';
  }

  if ($freeticket === true) {
    // Free LFLA Event
    include locate_template('templates/thanks/free-event.php' );
  }

  if ($paidticket === true) {
    // Paid LFLA Event
    include locate_template('templates/thanks/paid-event.php' );
  }

  if ($donation === true) {
    // General Donation
    include locate_template('templates/thanks/general-donation.php' );
  }

  if ($membership === true) {
    // Membership
    include locate_template('templates/thanks/membership.php' );
  }

  if ($memGift === true) {
    include locate_template('templates/thanks/memorial-gift.php' );
  }

  if ($youngLit === true) {
    include locate_template('templates/thanks/membership-yl.php' );
  }

  if ($giftMembership === true) {
    include locate_template('templates/thanks/membership-gift.php' );
  }

  if ($hasContent === true) {
    echo '</div>';

    ?><script>
      //$("#post_confirmation").prependTo('.cart-content .row').css('opacity','1');
    </script><?php

  }


}

add_action( 'woocommerce_thankyou', 'so_28348735_category_based_thank_you_message' );

/**
 * Plugin Name: WooCommerce Remove Billing Fields for Free Virtual Products
 * Plugin URI: https://gist.github.com/BFTrick/7873168
 * Description: Remove the billing address fields for free virtual orders
 * Author: Patrick Rauland
 * Author URI: http://patrickrauland.com/
 * Version: 2.0
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author      Patrick Rauland
 * @since   1.0
 */

// function patricks_billing_fields( $fields ) {
//   global $woocommerce;

//   // if the total is more than 0 then we still need the fields
//   if ( 0 != $woocommerce->cart->total ) {
//     return $fields;
//   }

//   // return the regular billing fields if we need shipping fields
//   if ( $woocommerce->cart->needs_shipping() ) {
//     return $fields;
//   }

//   // we don't need the billing fields so empty all of them except the email
//   unset( $fields['billing_country'] );
//   //unset( $fields['billing_first_name'] );
//   //unset( $fields['billing_last_name'] );
//   unset( $fields['billing_company'] );
//   unset( $fields['billing_address_1'] );
//   unset( $fields['billing_address_2'] );
//   unset( $fields['billing_city'] );
//   unset( $fields['billing_state'] );
//   //unset( $fields['billing_postcode'] );
//   unset( $fields['billing_phone'] );

//   return $fields;
// }
// add_filter( 'woocommerce_billing_fields', 'patricks_billing_fields', 20 );


// That's all folks!


add_filter( 'woocommerce_payment_complete_order_status', 'virtual_order_payment_complete_order_status', 10, 2 );

function virtual_order_payment_complete_order_status( $order_status, $order_id ) {
  $order = new WC_Order( $order_id );

  if ( 'processing' == $order_status &&
       ( 'on-hold' == $order->status || 'pending' == $order->status || 'failed' == $order->status ) ) {

    $virtual_order = null;

    if ( count( $order->get_items() ) > 0 ) {

      foreach( $order->get_items() as $item ) {

        if ( 'line_item' == $item['type'] ) {

          $_product = $order->get_product_from_item( $item );

          if ( ! $_product->is_virtual() ) {
            // once we've found one non-virtual product we know we're done, break out of the loop
            $virtual_order = false;
            break;
          } else {
            $virtual_order = true;
          }
        }
      }
    }

    // virtual order, mark as completed
    if ( $virtual_order ) {
      return 'completed';
    }
  }

  // non-virtual order, return original status
  return $order_status;
}


function conditional_checkout_fields_products( $fields ) {

    $cart = WC()->cart->get_cart();

    foreach ( $cart as $item_key => $values ) {

        $product_cats = wp_get_post_terms( $product->id, 'product_cat' );

        $product = $values['data'];

        if (in_array("free-lfla-event", $product_cats)) {
            unset( $fields['billing']['billing_galaxy'] );
        }

        //var_dump($product_cats);
    }

    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'conditional_checkout_fields_products' );


/**
 * Gravity Perks // GP Price Range // Modify Validation Messages
 */
add_filter( 'gform_validation', function( $result ) {

  foreach( $result['form']['fields'] as &$field ) {

    if( ! $field['failed_validation'] ) {
      continue;
    }

    $min = rgar( $field, 'priceRangeMin' );
    $max = rgar( $field, 'priceRangeMax' );

    if( ! $min && ! $max ) {
      continue;
    }

    switch( $field['validation_message'] ) {
      case sprintf( __( 'Please enter a price between <strong>%s</strong> and <strong>%s</strong>.' ), GFCommon::to_money( $min ), GFCommon::to_money( $max ) ):
        $field['validation_message'] = 'My custom validation message if field has a minimum and maximum.';
        break;
      case sprintf( __( 'Please enter a price greater than or equal to <strong>%s</strong>.' ), GFCommon::to_money( $min ) ):
        $field['validation_message'] = 'My custom validation message if field has a minimum.';
        break;
      case sprintf( __( 'Please enter a price less than or equal to <strong>%s</strong>.' ), GFCommon::to_money( $max ) ):
        $field['validation_message'] = 'My custom validation message if field has a maximum.';
        break;
    }

  }

  return $result;
}, 11 );

function wc_remove_related_products( $args ) {
  return array();
}
add_filter('woocommerce_related_products_args','wc_remove_related_products', 10);


if ( function_exists( 'tribe_is_event') ) {
  /**
   * Adds the phone number to the "Purchaser Email" column.
   * @link http://theeventscalendar.com/support/forums/topic/add-attendee-telephone-number-to-attendee-list/
   */
  function tribe_953653_add_phone_to_attendee_list( $value, $item, $column ) {

    // Change this column name to move the phone number to a different column.
    if ( 'purchaser_name' != $column ) {
      return $value;
    }

    $phone_number = get_post_meta( $item['order_id'], 'myfield2', true );

    // Remove the <small></small> tags from this to have the phone number text display at full size.
    if ( ! empty( $phone_number ) ) {
      return $value . sprintf( '<br><small><b>Membership Status:</b><br> %s</small>', sanitize_text_field( $phone_number ) );
    }

    return $value;
  }

  add_filter( 'tribe_events_tickets_attendees_table_column', 'tribe_953653_add_phone_to_attendee_list', 10, 3 );
}

// Book Purchase?

add_filter( 'manage_tribe_events_page_tickets-attendees_columns', 'add_my_custom_attendee_column', 20 );
add_filter( 'tribe_events_tickets_attendees_table_column', 'populate_my_custom_attendee_column', 10, 3 );

function add_my_custom_attendee_column( $columns ) {
    $columns['custom_id'] = 'Book Purchase';
    return $columns;
}

function populate_my_custom_attendee_column( $existing, $item, $column, $order_id ) {

    if ( 'custom_id' !== $column ) return $existing;

    //$member = get_post_meta( $item['order_id'], 'myfield2', true );
    //$phone_number = get_post_meta( $item['order_id'], 'order_warning', true );
    //$product_cats = wp_get_post_terms( $item['order_id'], 'product_cat' );

    // $item = $values['data'];

    // if (in_array("free-lfla-event", $member)) {
    //   $member = 'hello';
    // }

    //return var_dump($phone_number);
/****************************** Start Miles Modification **************************/
	global $wpdb;
	$event_query = "
		SELECT		meta_value
		FROM		{$wpdb->prefix}postmeta
		WHERE		meta_key = '_tribe_wooticket_for_event'
		AND 		post_id = %d
	";

	$event_id = $wpdb->get_var( $wpdb->prepare($event_query, $item['product_id']) );

	return book_ordered($item['order_id'], $event_id, true);
/****************************** End Miles Modification   **************************/

}


add_filter( 'woocommerce_variable_free_price_html',  'hide_free_price_notice' );
add_filter( 'woocommerce_free_price_html',           'hide_free_price_notice' );
add_filter( 'woocommerce_variation_free_price_html', 'hide_free_price_notice' );
/**
 * Hides the 'Free!' price notice
 */
function hide_free_price_notice( $price ) {
  return 'Free';
}



// Removes categories "meetup" and shindig" from list and month views
add_action( 'pre_get_posts', 'exclude_events_category' );

function exclude_events_category( $query ) {

if ( $query->query_vars['eventDisplay'] == 'list' || $query->query_vars['eventDisplay'] == 'month' && $query->query_vars['post_type'] == TribeEvents::POSTTYPE && !is_tax(TribeEvents::TAXONOMY) && empty( $query->query_vars['suppress_filters'] ) ) {

  $query->set( 'tax_query', array(

    array(
      'taxonomy' => 'tribe_events_cat',
      'field'    => 'slug',
      'terms'    => 'hidden',
      'operator' => 'NOT IN',
    )
    )
  );
}
return $query;
}