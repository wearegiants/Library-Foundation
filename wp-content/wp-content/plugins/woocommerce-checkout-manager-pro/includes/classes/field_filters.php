<?php
/**
 * WooCommerce Checkout Manager Pro
 *
 * Copyright (C) 2014 Ephrain Marchan, trottyzone
 *
 */
 
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// TEXT
add_filter('woocommerce_form_field_wooccmtext', 'wooccmtext_handler', 10, 4);
function wooccmtext_handler( $field = '', $key, $args, $value ) {
	
	
		if ( ( ! empty( $args['clear'] ) ) ) {
			$after = '<div class="clear"></div>';
		} else {
			$after = '';
		}

		if ( $args['wooccm_required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
		} else {
			$required = '';
		}

		$args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

		if ( is_string( $args['label_class'] ) ) {
			$args['label_class'] = array( $args['label_class'] );
		}

		if ( is_null( $value ) ) {
			$value = $args['default'];
		}

		// Custom attribute handling
		$custom_attributes = array();

		if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
			foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
				$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
			}
		}

		if ( ! empty( $args['validate'] ) ) {
			foreach( $args['validate'] as $validate ) {
				$args['class'][] = 'validate-' . $validate;
			}
		}

				$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

				if ( $args['label'] ) {
					$field .= '<label for="' . esc_attr( $args['id'] ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label'] . $required . '</label>';
				}

				$field .= '<input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" placeholder="' . esc_attr( $args['placeholder'] ) . '" '.$args['maxlength'].' value="' . esc_attr( $value ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

				if ( $args['description'] ) {
					$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
				}

				$field .= '</p>' . $after;

	return $field;
}


// COUNTRY
add_filter('woocommerce_form_field_wooccmstate', 'wooccmstate_handler', 10, 4);
function wooccmstate_handler( $field = '', $key, $args, $value ) {

if ( ( ! empty( $args['clear'] ) ) ) {
			$after = '<div class="clear"></div>';
		} else {
			$after = '';
		}

		if ( $args['wooccm_required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
		} else {
			$required = '';
		}

		$args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

		if ( is_string( $args['label_class'] ) ) {
			$args['label_class'] = array( $args['label_class'] );
		}

		if ( is_null( $value ) ) {
			$value = $args['default'];
		}

		// Custom attribute handling
		$custom_attributes = array();

		if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
			foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
				$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
			}
		}

		if ( ! empty( $args['validate'] ) ) {
			foreach( $args['validate'] as $validate ) {
				$args['class'][] = 'validate-' . $validate;
			}
		}
		
				/* Get Country */
				$country_key = $key == 'billing_state'? 'billing_country' : 'shipping_country';
				$current_cc  = WC()->checkout->get_value( $country_key );
				$states      = WC()->countries->get_states( $current_cc );

				if ( is_array( $states ) && empty( $states ) ) {

					$field  = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field" style="display: none">';

					if ( $args['label'] ) {
						$field .= '<label for="' . esc_attr( $args['id'] ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label'] . $required . '</label>';
					}
					$field .= '<input type="hidden" class="hidden" name="' . esc_attr( $key )  . '" id="' . esc_attr( $args['id'] ) . '" value="" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '" />';

					if ( $args['description'] ) {
						$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
					}

					$field .= '</p>' . $after;

				} elseif ( is_array( $states ) ) {

					$field  = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

					if ( $args['label'] )
						$field .= '<label for="' . esc_attr( $args['id'] ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']. $required . '</label>';
					$field .= '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="state_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" ' . implode( ' ', $custom_attributes ) . ' placeholder="' . esc_attr( $args['placeholder'] ) . '">
						<option value="">'.__( 'Select a state&hellip;', 'woocommerce' ) .'</option>';

					foreach ( $states as $ckey => $cvalue ) {
						$field .= '<option value="' . esc_attr( $ckey ) . '" '.selected( $value, $ckey, false ) .'>'.__( $cvalue, 'woocommerce' ) .'</option>';
					}

					$field .= '</select>';

					if ( $args['description'] ) {
						$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
					}

					$field .= '</p>' . $after;

				} else {

					$field  = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

					if ( $args['label'] ) {
						$field .= '<label for="' . esc_attr( $args['id'] ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']. $required . '</label>';
					}
					$field .= '<input type="text" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" value="' . esc_attr( $value ) . '"  placeholder="' . esc_attr( $args['placeholder'] ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" ' . implode( ' ', $custom_attributes ) . ' />';

					if ( $args['description'] ) {
						$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
					}

					$field .= '</p>' . $after;
				}

		return $field;
}



// COUNTRY
add_filter('woocommerce_form_field_wooccmcountry', 'wooccmcountry_handler', 10, 4);
function wooccmcountry_handler( $field = '', $key, $args, $value ) {

if ( ( ! empty( $args['clear'] ) ) ) {
			$after = '<div class="clear"></div>';
		} else {
			$after = '';
		}

		
		if ( $args['wooccm_required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
		} else {
			$required = '';
		}

		$args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

		if ( is_string( $args['label_class'] ) ) {
			$args['label_class'] = array( $args['label_class'] );
		}

		if ( is_null( $value ) ) {
			$value = $args['default'];
		}

		// Custom attribute handling
		$custom_attributes = array();

		if ( ! empty( $args['custom_attributes'] ) && is_array( $args['custom_attributes'] ) ) {
			foreach ( $args['custom_attributes'] as $attribute => $attribute_value ) {
				$custom_attributes[] = esc_attr( $attribute ) . '="' . esc_attr( $attribute_value ) . '"';
			}
		}

		if ( ! empty( $args['validate'] ) ) {
			foreach( $args['validate'] as $validate ) {
				$args['class'][] = 'validate-' . $validate;
			}
		}

				$countries = $key == 'shipping_country' ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();

				if ( sizeof( $countries ) == 1 ) {

					$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">';

					if ( $args['label'] ) {
						$field .= '<label class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label']  . '</label>';
					}

					$field .= '<strong>' . current( array_values( $countries ) ) . '</strong>';

					$field .= '<input type="hidden" name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" value="' . current( array_keys($countries ) ) . '" ' . implode( ' ', $custom_attributes ) . ' class="country_to_state" />';

					if ( $args['description'] ) {
						$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
					}

					$field .= '</p>' . $after;

				} else {

					$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $args['id'] ) . '_field">'
							. '<label for="' . esc_attr( $args['id'] ) . '" class="' . esc_attr( implode( ' ', $args['label_class'] ) ) .'">' . $args['label'] . $required  . '</label>'
							. '<select name="' . esc_attr( $key ) . '" id="' . esc_attr( $args['id'] ) . '" class="country_to_state country_select ' . esc_attr( implode( ' ', $args['input_class'] ) ) .'" ' . implode( ' ', $custom_attributes ) . '>'
							. '<option value="">'.__( 'Select a country&hellip;', 'woocommerce' ) .'</option>';

					foreach ( $countries as $ckey => $cvalue ) {
						$field .= '<option value="' . esc_attr( $ckey ) . '" '.selected( $value, $ckey, false ) .'>'.__( $cvalue, 'woocommerce' ) .'</option>';
					}

					$field .= '</select>';

					$field .= '<noscript><input type="submit" name="woocommerce_checkout_update_totals" value="' . __( 'Update country', 'woocommerce' ) . '" /></noscript>';

					if ( $args['description'] ) {
						$field .= '<span class="description">' . esc_attr( $args['description'] ) . '</span>';
					}

					$field .= '</p>' . $after;
				}

		return $field;
}


// MULTISELECT
add_filter('woocommerce_form_field_multiselect', 'wooccm_multiselect_handler', 10, 4);
function wooccm_multiselect_handler( $field = '', $key, $args, $value ) {

if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';

		if ( $args['wooccm_required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
		} else {
			$required = '';
		}

		$args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

		$options = '';

		if ( ! empty( $args['options'] ) )
			foreach (explode('||',$args['options']) as $option_key => $option_text )
				$options .= '<option value="'.wpml_string_wccm_pro( esc_attr( $option_text ) ).'" '. selected( $value, $option_key, false ) . '>' . wpml_string_wccm_pro( esc_attr( $option_text ) ) .'</option>';

			$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';

			if ( $args['label'] )
				$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>';

			$field .= '<select data-placeholder="' . __( 'Select some options', 'wc_checkout_fields' ) . '" multiple="multiple" name="' . esc_attr( $key ) . '[]" id="' . esc_attr( $key ) . '" class="checkout_chosen_select select">
					' . $options . '
				</select>
			</p>' . $after;

		return $field;
}


// MULTCHECKBOX
add_filter('woocommerce_form_field_multicheckbox', 'wooccm_multicheckbox_handler', 10, 4);
function wooccm_multicheckbox_handler( $field = '', $key, $args, $value ) {

if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';

		if ( $args['wooccm_required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
		} else {
			$required = '';
		}

		$args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

		$options = '';

		if ( ! empty( $args['options'] ) )
			foreach (explode('||',$args['options']) as $option_key => $option_text )
				$options .= '' . wpml_string_wccm_pro( esc_attr( $option_text ) ) .' <input type="checkbox" name="' . esc_attr( $key ) . '[]" value="'.wpml_string_wccm_pro( esc_attr( $option_text ) ).'" '. selected( $value, $option_key, false ) . ' /><br />';

			$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';

			if ( $args['label'] )
				$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>';

			$field .= '' . $options . '
			</p>' . $after;

		return $field;
}

// RADIO BUTTONS
add_filter('woocommerce_form_field_wooccmradio', 'wooccm_radio_handler', 10, 4);
function wooccm_radio_handler( $field = '', $key, $args, $value ) {

		if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';

		if ( $args['wooccm_required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
		} else {
			$required = '';
		}

		$args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

		$field = '<div class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';

		$field .= '<fieldset><legend>' . $args['label'] . $required . '</legend>';

		if ( ! empty( $args['options'] ) )

			foreach ( explode('||',$args['options']) as $option_key => $option_text )
				$field .= '<label><input type="radio" ' . checked( $value, wpml_string_wccm_pro( esc_attr( $option_text ) ), false ) . ' name="' . esc_attr( $key ) . '" value="' . wpml_string_wccm_pro( esc_attr( $option_text ) ). '" /> ' . wpml_string_wccm_pro( esc_html( $option_text ) ). '</label>';

		$field .= '</fieldset></div>' . $after;

		return $field;

}



// SELEECT OPTIONS
add_filter('woocommerce_form_field_wooccmselect', 'wooccm_select_handler', 10, 4);
function wooccm_select_handler( $field = '', $key, $args, $value ) {

if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';

		if ( $args['wooccm_required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
		} else {
			$required = '';
		}

		$args['maxlength'] = ( $args['maxlength'] ) ? 'maxlength="' . absint( $args['maxlength'] ) . '"' : '';

		$options = '';

		if ( ! empty( $args['options'] ) )
			$options .= ($args['default']) ?'<option value="">' . $args['default'] .'</option>': '';
			foreach (explode('||',$args['options']) as $option_key => $option_text )
				$options .= '<option '. selected( $value, $option_key, false ) . '>' . wpml_string_wccm_pro( esc_attr( $option_text ) ) .'</option>';

			$field = '<p class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">';

			if ( $args['label'] )
				$field .= '<label for="' . esc_attr( $key ) . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label']. $required . '</label>';

			$field .= '<select class="' . esc_attr( $args['fancy'] ) .'" data-placeholder="' . __( ''.$args['default'].'', 'wc_checkout_fields' ) . '" name="' . esc_attr( $key ) . '" id="' . esc_attr( $key ) . '" >
					' . $options . '
				</select>
			</p>' . $after;

		return $field;

}

// CHECKBOX
add_filter('woocommerce_form_field_checkbox_wccm', 'wooccm_checkbox_handler', 10, 4);
function wooccm_checkbox_handler( $field = '', $key, $args, $value ) {

		$args['options'] = explode('||',$args['options']);
		
		if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';

		if ( $args['wooccm_required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
		} else {
			$required = '';
		}

$field = '<p class="form-row ' . implode( ' ', $args['class'] ) .'" id="' . $key . '_field">
					<input type="checkbox" class="input-checkbox" name="' . $key . '" id="' . $key . '_checkbox" value="'.$args['options'][0].'" />

					<input type="hidden" id="' . $key . '_checkboxhiddenfield" name="' . $key . '" value="'.$args['options'][1].'" />

					<label for="' . $key . '" class="checkbox ' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required . '</label>
				</p>' . $after;

				return $field;

}


// COLORPICKER
add_filter('woocommerce_form_field_colorpicker', 'wooccm_colorpicker_handler', 10, 4);
function wooccm_colorpicker_handler( $field = '', $key, $args, $value ) {

		$namecolor = (stripos($key, 'billing_') ) ? 'billing_' : 'shipping_';
		if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';

		if ( $args['wooccm_required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
		} else {
			$required = '';
		}

if ( implode( ' ', $args['class'] ) == 'form-row-first' ) {
    $style = 'margin-right: 17%;';
} else {
    $style = 'margin-left: 17%;';
}
//if ( isset($value) ) {
$value = $args['color'];
//}

			$field = '<p class="form-row ' . implode( ' ', $args['class'] ) .' wccs_colorpicker" id="' . $key . '_field">
					<label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required . '</label>
					<input type="text" class="input-text" maxlength="7" size="6" name="' . $key . '" id="' . $key . '_colorpicker" placeholder="' . $args['placeholder'] . '" value="'.$value.'" />
				</p><div style="'.$style.'" id="'.$namecolor.''.$args['cow'].'_colorpickerdiv" class="spec_shootd"></div>' . $after;

			return $field;
}


// DatePicker
add_filter('woocommerce_form_field_datepicker', 'wooccm_datepicker_handler', 10, 4);
function wooccm_datepicker_handler( $field = '', $key, $args, $value ) {


		if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';

		if ( $args['wooccm_required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
		} else {
			$required = '';
		}

			$field = '<p class="form-row ' . implode( ' ', $args['class'] ) .'MyDate'.$args['cow'].' wccs-form-row-wide" id="' . $key . '_field">
					<label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required . '</label>
					<input type="text" class="input-text" name="' . $key . '" id="' . $key . '" placeholder="' . $args['placeholder'] . '" value="'. $value.'" />
				</p>' . $after;

			return $field;
}


// TimePicker
add_filter('woocommerce_form_field_time', 'wooccm_timepicker_handler', 10, 4);
function wooccm_timepicker_handler( $field = '', $key, $args, $value ) {


		if ( ( ! empty( $args['clear'] ) ) ) $after = '<div class="clear"></div>'; else $after = '';

		if ( $args['wooccm_required'] ) {
			$args['class'][] = 'validate-required';
			$required = ' <abbr class="required" title="' . esc_attr__( 'required', 'woocommerce'  ) . '">*</abbr>';
		} else {
			$required = '';
		}

			$field = '<p class="form-row ' . implode( ' ', $args['class'] ) .'MyTime'.$args['cow'].' wccs-form-row-wide" id="' . $key . '_field">
					<label for="' . $key . '" class="' . implode( ' ', $args['label_class'] ) .'">' . $args['label'] . $required . '</label>
					<input type="text" class="input-text" name="' . $key . '" id="' . $key . '" placeholder="' . $args['placeholder'] . '" value="'. $value.'" />
				</p>' . $after;

			return $field;
}



// Heading Field
add_filter('woocommerce_form_field_heading', 'wooccm_heading_handler', 10, 4);
function wooccm_heading_handler( $field = '', $key, $args, $value ) {
		$field = '<h3 class="form-row ' . esc_attr( implode( ' ', $args['class'] ) ) .'" id="' . esc_attr( $key ) . '_field">' . $args['label'] . '</h3>';

		return $field;
}


// Billing Fields
function wooccm_billing_fields( $fields ) {
$options3 = get_option( 'wccs_settings3' );
 
            foreach ( $options3['billing_buttons'] as $btn ) :
        
            	if ( !empty($btn['cow']) && empty($btn['deny_checkout']) ) {
				  
					if ( $btn['cow'] == 'country' ) {
									$fields['billing_'.$btn['cow'].'']['type'] = 'wooccmcountry';
								} elseif ( $btn['cow'] == 'state' ) {
									$fields['billing_'.$btn['cow'].'']['type'] = 'wooccmstate';
								} else {
						$fields['billing_'.$btn['cow'].'']['type'] = ''.$btn['type'].'';
					}

				  
                	if ( $btn['cow'] !== 'country' || $btn['cow'] !== 'state' ) {
                	    $fields['billing_'.$btn['cow'].'']['placeholder'] = ''.$btn['placeholder'].'';
                	}
                    
                    	$fields['billing_'.$btn['cow'].'']['class'] = array(''.$btn['position'].' '.$btn['conditional_tie'].' '.$btn['extra_class'].'');		
                     	$fields['billing_'.$btn['cow'].'']['label'] =  wpml_string_wccm_pro(''.$btn['label'].'');
                     	$fields['billing_'.$btn['cow'].'']['clear']  = ''.$btn['clear_row'].'';
                     	$fields['billing_'.$btn['cow'].'']['default'] = ''.$btn['force_title2'].'';
                     	$fields['billing_'.$btn['cow'].'']['options'] = ''.$btn['option_array'].'';
						 $fields['billing_'.$btn['cow'].'']['required']  = false;
						 $fields['billing_'.$btn['cow'].'']['wooccm_required']  = ''.$btn['checkbox'].'';
			            $fields['billing_'.$btn['cow'].'']['cow'] = ''.$btn['cow'].'';
			            $fields['billing_'.$btn['cow'].'']['color'] = ''.$btn['colorpickerd'].'';
                    	$fields['billing_'.$btn['cow'].'']['order'] = ''.$btn['order'].'';
						$fields['billing_'.$btn['cow'].'']['fancy'] = ''.$btn['fancy'].'';
                
                    if ( !empty($btn['disabled']) ) {
                        unset($fields['billing_'.$btn['cow'].'']);
                    }
            	}
            endforeach;
            
            $fields[] = uasort($fields, 'sort_fields');
        
            if ($fields[0]) {
                unset($fields[0]);
            }
return $fields;
}


// Shipping Fields
function wooccm_shipping_fields( $fields ) {
$options2 = get_option( 'wccs_settings2' );
 
            foreach ( $options2['shipping_buttons'] as $btn ) :
				
                if ( !empty( $btn['cow']) && empty($btn['deny_checkout']) )  {
                
                    if ( $btn['cow'] == 'country' ) {
                        $fields['shipping_'.$btn['cow'].'']['type'] = 'wooccmcountry';
					} elseif ( $btn['cow'] == 'state' ) {
						$fields['shipping_'.$btn['cow'].'']['type'] = 'wooccmstate';
                    } else {
			$fields['shipping_'.$btn['cow'].'']['type'] = ''.$btn['type'].'';
			}
	  
			if ( $btn['cow'] !== 'country' || $btn['cow'] !== 'state' ) {
                        $fields['shipping_'.$btn['cow'].'']['placeholder'] = ''.$btn['placeholder'].'';
            }
					
                        $fields['shipping_'.$btn['cow'].'']['class'] = array(''.$btn['position'].' '.$btn['conditional_tie'].' '.$btn['extra_class'].'');		
                        $fields['shipping_'.$btn['cow'].'']['label'] =  wpml_string_wccm_pro(''.$btn['label'].'');
                        $fields['shipping_'.$btn['cow'].'']['clear']  = ''.$btn['clear_row'].'';
                        $fields['shipping_'.$btn['cow'].'']['default'] = ''.$btn['force_title2'].'';
                        $fields['shipping_'.$btn['cow'].'']['options'] = ''.$btn['option_array'].'';
						$fields['shipping_'.$btn['cow'].'']['required'] = false;
						$fields['shipping_'.$btn['cow'].'']['wooccm_required'] = ''.$btn['checkbox'].'';
						$fields['shipping_'.$btn['cow'].'']['cow'] = ''.$btn['cow'].'';
						$fields['shipping_'.$btn['cow'].'']['color'] = ''.$btn['colorpickerd'].'';
                        $fields['shipping_'.$btn['cow'].'']['order'] = ''.$btn['order'].'';
						$fields['shipping_'.$btn['cow'].'']['fancy'] = ''.$btn['fancy'].'';
                        
                    if ( !empty($btn['disabled']) ) {
                        unset($fields['shipping_'.$btn['cow'].'']);
                    }
                }       
            endforeach;

            $fields[] = uasort($fields, 'sort_fields');

            if ($fields[0]) {
                unset($fields[0]);
            }
return $fields;
}


// Sort fields
function sort_fields( $a, $b ) {
	    if ( $a['order'] == $b['order'] )
	        return 0;
	    return ( $a['order'] < $b['order'] ) ? -1 : 1;
}