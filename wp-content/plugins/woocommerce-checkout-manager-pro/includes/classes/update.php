<?php

/**
 * WooCommerce Checkout Manager Pro
 *
 *
 * Copyright (C) 2014 Ephrain Marchan, trottyzone
 *
 */
 
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Take over the update check
add_filter('pre_set_site_transient_update_plugins', 'wooccm_check_for_plugin_update');

function wooccm_check_for_plugin_update($checked_data) {
	global $wp_version;
	
    $api_url = 'http://www.trottyzone.com/wp-content/api/index.php';
    $plugin_slug = 'woocommerce-checkout-manager-pro';

	if (empty($checked_data->checked)) {
		return $checked_data;
	}
	
	$args = array(
		'slug' => $plugin_slug,
		'version' => @$checked_data->checked[$plugin_slug .'/'. $plugin_slug .'.php'],
	);
	$request_string = array(
			'body' => array(
				'action' => 'basic_check', 
				'request' => serialize($args),
				'api-key' => md5(get_bloginfo('url'))
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
		);
	
	$raw_response = wp_remote_post($api_url, $request_string);
	
	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
		$response = unserialize($raw_response['body']);
	
	if (is_object($response) && !empty($response)) // Feed the update data into WP updater
		@$checked_data->response[$plugin_slug .'/'. $plugin_slug .'.php'] = $response;

	return $checked_data;
}

add_filter('plugins_api', 'wooccm_plugin_api_call', 10, 3);

function wooccm_plugin_api_call($def, $action, $args) {
	global $wp_version;
	
    $api_url = 'http://www.trottyzone.com/wp-content/api/index.php';
    $plugin_slug = 'woocommerce-checkout-manager-pro';

	if (!isset($args->slug) || ($args->slug != $plugin_slug))
		return false;
	
	$plugin_info = get_site_transient('update_plugins');
	$current_version = @$plugin_info->checked[$plugin_slug .'/'. $plugin_slug .'.php'];
	$args->version = $current_version;
	
	$request_string = array(
			'body' => array(
				'action' => $action, 
				'request' => serialize($args),
				'api-key' => md5(get_bloginfo('url'))
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
		);
	
	$request = wp_remote_post($api_url, $request_string);
	
	if (is_wp_error($request)) {
		$res = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
	} else {
		$res = unserialize($request['body']);
		
		if ($res === false)
			$res = new WP_Error('plugins_api_failed', __('An unknown error occurred'), $request['body']);
	}
	
	return $res;
}

function wooccmver(){
	$valuexg = get_option('wccmkelizn32aunique'); 
	$host = wooccmadd();
		if ( !empty( $valuexg ) ) { 
			$api_url = 'http://www.trottyzone.com/wp-content/plugins/wp-licensing/auth/verify.php'; 
			$request_string = array( 
				'body' => array( 'stepv' => 'wooccm', 
								 'key' => $valuexg, 
								 'domain' => $host, 
								 'product' => 'woocommerce-checkout-manager-pro' 
								), 
				'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url') ); 
			$resultx = wp_remote_post($api_url, $request_string ); 
			$result = wp_remote_retrieve_body( $resultx ); 
				if ( is_wp_error($result) ) { 
					update_option('errfafvetcgrt6434cwooccminfo15907833', 'connection_error'); 
					update_option('hostnamewooccmerrfafvetcgrt6434cwooccminfo15907833', $host); 
				}else { 
					$result = json_decode($result, true); 
						if ($result['valid'] == 'true') { 
							update_option('errfafvetcgrt6434cwooccminfo15907833', 'clear'); 
						} elseif ($result['info']['domain'] !== 'NA' && $result['valid'] == 'false' ) { 
							update_option('errfafvetcgrt6434cwooccminfo15907833', 'change_site'); 
						}elseif ($result['info']['domain'] == 'NA') { 
							update_option('errfafvetcgrt6434cwooccminfo15907833', 'not_exsit'); 
						} 
				} 
				if($result['valid'] == 'true') { 
					return true; 
				}
		}
}


require_once(plugin_dir_path( __FILE__ ).'../templates/index.php');