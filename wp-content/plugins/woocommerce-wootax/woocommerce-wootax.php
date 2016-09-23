<?php

/**
 * Plugin Name: WooTax
 * Plugin URI: http://wootax.com
 * Description: Harness the power of TaxCloud to accurately calculate sales tax for your WooCommerce store.
 * Version: 4.4
 * Author: Brett Porcelli
 * Author URI: http://bporcelli.com
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Do not all allow direct access
}

// We need access to is_plugin_active, even on the frontend. Make sure it is available.
if( !function_exists( 'is_plugin_active' ) ) {
	require ABSPATH . 'wp-admin/includes/plugin.php';
}

// Seems weird to include this here... try to think of a better way in the future
require 'includes/wc-wootax-messages.php';

/**
 * The main WooTax class
 * Handles plugin activation/deactivation routines and a few miscellaneous tasks
 * 
 * @since 4.2
 */
class WC_WooTax {
	/** Current plugin version */
	private static $version = 4.4;

	/** Key of option where plugin settings are stored */
	private static $settings_key = 'woocommerce_wootax_settings';

	/** Plugin settings */
	private static $settings = array();

	/** When this is true, the get_option method reloads the WooTax settings array */
	public static $settings_changed = false;

	/**
	 * Initialize plugin
	 * - Hook into WooCommerce
	 * - Define WooTax constants
	 * - Include dependencies
	 *
	 * @since 4.4
	 */
	public static function init() {
		self::define_constants();

		if ( !self::ready() ) {
			return;
		}

		self::includes();
		self::hooks();
		self::maybe_check_updates();
	}

	/**
	 * Determine if WooTax is ready to run
	 * WooCommerce must be active and a valid TaxCloud API Key and Login ID (at the least) must be set
	 *
	 * @since 4.4
	 */
	private static function ready() {
		if ( !class_exists( 'SoapClient' ) ) {
			wootax_add_message( '<strong>Warning: WooTax has been disabled.</strong> The SoapClient class is required by WooTax, but it is not installed on your server. To resolve this issue, please contact your web host and ask them to enable PHP SOAP for you.' );
			return false;
		} else if ( !is_plugin_active( 'woocommerce/woocommerce.php' ) || !version_compare( WOOCOMMERCE_VERSION, '2.1', '>=' ) ) {
			wootax_add_message( '<strong>Warning: WooTax has been disabled.</strong> WooCommerce version 2.1 or greater must be activated for WooTax to work properly.' );
			return false;
		}

		return true;
	}

	/**
	 * Define WooTax constants
	 *
	 * @since 4.4
	 */
	private static function define_constants() {
		self::define( 'WT_VERSION', self::$version );
		self::define( 'WT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
		self::define( 'WT_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
		self::define( 'WT_SHIPPING_TIC', apply_filters( 'wootax_shipping_tic', 11010 ) );
		self::define( 'WT_SHIPPING_ITEM', 'SHIPPING' );
		self::define( 'WT_FEE_TIC', apply_filters( 'wootax_fee_tic', 10010 ) );
		self::define( 'WT_RATE_ID', get_option( 'wootax_rate_id' ) );
		self::define( 'WT_DEFAULT_ADDRESS', WC_WooTax::get_option( 'default_address' ) == false ? 0 : WC_WooTax::get_option( 'default_address' ) );
		self::define( 'WT_SUBS_ACTIVE', is_plugin_active( 'woocommerce-subscriptions/woocommerce-subscriptions.php' ) );
		self::define( 'WT_LOG_REQUESTS', WC_WooTax::get_option( 'log_requests' ) == 'no' ? false : true );
	}

	/**
	 * Define a constant if it hasn't been defined already
	 *
	 * @since 4.4
	 */
	private static function define( $name, $value ) {
		if ( !defined( $name ) ){
			define( $name, $value );
		}
	}
	
	/**
	 * Hook into WordPress/WooCommerce
	 *
	 * @since 4.4
	 */
	private static function hooks() {
		// Display correct rate label for older versions of WooCommerce
		add_filter( 'woocommerce_rate_label', array( __CLASS__, 'get_rate_label' ), 15, 2 );

		// Return correct rate code for WooTax tax rate
		add_filter( 'woocommerce_rate_code', array( __CLASS__, 'get_rate_code' ), 12, 2 );
	}

	/**
	 * What type of request is this?
	 * string $type ajax, frontend or admin
	 *
	 * @since 4.4
	 * @return bool
	 * @see WooCommerce->is_request()
	 */
	private static function is_request( $type ) {
		switch ( $type ) {
			case 'admin' :
				return is_admin();
			case 'ajax' :
				return defined( 'DOING_AJAX' );
			case 'cron' :
				return defined( 'DOING_CRON' );
			case 'frontend' :
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}

	/**
	 * Include WooTax dependencies
	 *
	 * @since 4.4
	 */
	private static function includes() {
		// Used for all request types
		require 'includes/wc-wootax-functions.php';
		require 'classes/class-wc-wootax-taxcloud.php';

		// Used on frontend
		if ( self::is_request( 'frontend' ) ) {
			if ( WC_WooTax::get_option( 'show_exempt' ) == 'true' ) {
				require 'includes/wc-wootax-exemptions.php';
			} 
			
			require 'classes/class-wc-wootax-checkout.php';
		}
		
		// Frontend and admin panel
		if ( self::is_request( 'frontend' ) || self::is_request( 'admin' ) || self::is_request( 'cron' ) ) {
			require 'classes/class-wc-wootax-order.php';
			require 'classes/class-wt-orders.php';

			if ( WT_SUBS_ACTIVE ) {
				require 'classes/class-wc-wootax-subscriptions.php';
			}

			require 'includes/wc-wootax-cron-tasks.php';
		}

		// Strictly admin panel
		if ( self::is_request( 'admin' ) ) {
			require 'classes/class-wc-wootax-upgrade.php';
			require 'classes/class-wc-wootax-settings.php';
			require 'classes/class-wc-wootax-admin.php';
			require 'classes/class-wc-wootax-refund.php';

			// Check to make sure EDD_SL_Plugin_Updater isn't defined already -- other plugins may use it
			if ( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
				require 'classes/EDD_SL_Plugin_Updater.php';
			}
		}
	}

	/**
	 * Run the WooTax activation routine
	 *
	 * @since 4.4
	 */
	public static function activate_wootax() {
		self::configure_woocommerce();
		self::maybe_add_wootax_rate();
		self::add_exempt_user_role();
		self::schedule_wootax_events();
	}

	/**
	 * Run the WooTax deactivation routine
	 *
	 * @since 4.4
	 */
	public static function deactivate_wootax() {
		self::unschedule_wootax_events();
	}

	/**
	 * Configures WooCommerce tax settings to work with WooTax
	 * Executed on plugin activation
	 *
	 * @since 4.2
	 */
 	public static function configure_woocommerce() {
 		// Update WooCommerce settings
		update_option( 'woocommerce_calc_taxes', 'yes' );
		update_option( 'woocommerce_prices_include_tax', 'no' );
		update_option( 'woocommerce_tax_based_on', 'shipping' );
		update_option( 'woocommerce_default_customer_address', 'base' );
		update_option( 'woocommerce_shipping_tax_class', '' );
		update_option( 'woocommerce_tax_round_at_subtotal', false );
		update_option( 'woocommerce_tax_display_shop', 'excl' );
		update_option( 'woocommerce_tax_display_cart', 'excl' );
		update_option( 'woocommerce_tax_total_display', 'itemized' );
		
		// Confirm activation with user
		wootax_add_message( '<strong>Success!</strong> Your WooCommerce tax settings have been automatically adjusted to work with WooTax.', 'updated', 'activated', true, true );
	}
	
	/**
	 * Maybe insert a tax rate into the database for WooTax
	 * Runs on plugin activation
	 *
	 * @since 4.4
	 */
	public static function maybe_add_wootax_rate() {
		if ( !self::has_tax_rate() ) {
			self::add_rate_code();
		}
	}

	/**
	 * Determines if WooTax has added a tax rate
	 *
	 * @since 4.2
	 * @return bool true/false
	 */
	private static function has_tax_rate() {
		global $wpdb;

		$wootax_rate_id = get_option( 'wootax_rate_id' ); // WT_RATE_ID is not defined yet when this method is executed

		if ( !$wootax_rate_id ) {
			return false;
		} else {
			$name = $wpdb->get_var( "SELECT tax_rate_name FROM {$wpdb->prefix}woocommerce_tax_rates WHERE tax_rate_id = $wootax_rate_id" );

			if ( empty( $name ) ) {
				return false;
			}	
		}

		return true;
	}

	/**
	 * Get appropriate label for tax rate (should be Sales Tax for the rate applied by WooTax)
	 *
	 * @param $name - the name of the tax (fetched from db; won't be populated in our case)
	 * @param $key - the tax key (we want to return the appropriate name for the wootax rate)
	 */
	public static function get_rate_label( $name, $key = NULL ) {
		if ( $name == WT_RATE_ID || $key == WT_RATE_ID ) {
			return 'Sales Tax';
		} else {
			return $name;
		}
	}

	/**
	 * Return correct rate code for WooTax tax rate
	 *
	 * @param $code -the code WooCommerce generates @see WC_Tax->get_rate_code()
	 * @param $key - the tax rate id; compare to stored wootax rate id and return 'WOOTAX-RATE-DO-NOT-REMOVE' if match is found
	 */
	public static function get_rate_code( $code, $key ) {
		if ( $key == WT_RATE_ID ) {
			return apply_filters( 'wootax_rate_code', 'WOOTAX-RATE-DO-NOT-REMOVE' );
		} else {
			return $code;
		}
	}

	/**
	 * Adds a tax rate code for WooTax
	 *
	 * @since 4.0
	 */
	private static function add_rate_code() {
		global $wpdb;

		// Add new rate 
		$_tax_rate = array(
			'tax_rate_country'  => 'WOOTAX',
			'tax_rate_state'    => 'RATE',
			'tax_rate'          => 0,
			'tax_rate_name'     => 'DO-NOT-REMOVE',
			'tax_rate_priority' => NULL,
			'tax_rate_compound' => true,
			'tax_rate_shipping' => NULL,
			'tax_rate_order'    => NULL,
			'tax_rate_class'    => 'standard',
		);

		$wpdb->insert( $wpdb->prefix . 'woocommerce_tax_rates', $_tax_rate );

		$tax_rate_id = $wpdb->insert_id;

		update_option( 'wootax_rate_id', $tax_rate_id );
	}

	/**
	 * Adds a user role for tax exempt customers
	 * Role is an exact copy of the "Customer" role
	 *
	 * @since 4.3
	 */
	public static function add_exempt_user_role() {
		add_role( 'exempt-customer', __( 'Exempt Customer', 'woocommerce' ), array(
			'read' 						=> true,
			'edit_posts' 				=> false,
			'delete_posts' 				=> false,
		) );
	}

	/**
	 * Schedule events for the WooTax order checker and recurring payments updater
	 *
	 * @since 4.4
	 */
	public static function schedule_wootax_events() {
		// Updates recurring tax amounts if necessary
		wp_schedule_event( time(), 'twicedaily', 'wootax_update_recurring_tax' );
	}

	/**
	 * Unschedule events for the WooTax order checker and recurring payments updater
	 * Hooks to be cleared are wootax_update_recurring_tax
	 *
	 * @since 4.4
	 */
	public static function unschedule_wootax_events() {
		wp_clear_scheduled_hook( 'wootax_update_recurring_tax' );
	}

	/**
	 * Maybe check for updates
	 * Runs if we are serving an admin request and EDD_SL_Plugin_Updater is accessible
	 *
	 * @since 4.4
	 */
	private static function maybe_check_updates() {
		if ( !self::is_request( 'admin' ) || !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
			return;
		}

		$license_key = trim( get_option( 'wootax_license_key' ) );
		
		if ( $license_key != false ) {
			$edd_updater = new EDD_SL_Plugin_Updater( 'http://wootax.com', __FILE__, array( 
				'version' 	=> WT_VERSION, 		 // current version number
				'license' 	=> $license_key, 		 // license key (used get_option above to retrieve from DB)
				'item_name' => 'WooTax Plugin for WordPress', // name of this plugin
				'author' 	=> 'Brett Porcelli',  	 // author of this plugin
				'url' 		=> home_url(), 			 // url where plugin is being activated
			) );
		}
	}

	/**
	 * Get the value of a WooTax option
	 *
	 * @since 4.2
	 * @param (mixed) $key the key of the option to be fetched
	 * @return (mixed) requested option or boolean false if it isn't set
	 */
	public static function get_option( $key ) {
		if ( count( self::$settings ) == 0 || self::$settings_changed ) {
			self::$settings = get_option( self::$settings_key );
			self::$settings_changed = false;
		}
		
		if ( !isset( self::$settings[ $key ] ) || !self::$settings[ $key ] ) {
			return false;
		} else {
			return self::$settings[ $key ];
		}
	}

	/**
	 * Set the value of a WooTax option
	 *
	 * @since 4.2
	 * @param (mixed) $key the key of the option to be updated
	 * @param (mixed) $value the new value of the option
	 */
	public static function set_option( $key, $value ) {
		if ( count( self::$settings ) == 0 ) {
			self::$settings = get_option( self::$settings_key );
		}

		self::$settings[ $key ] = $value;

		update_option( self::$settings_key, self::$settings );
	}
}

add_action( 'plugins_loaded', array( 'WC_WooTax', 'init' ) );

// Activation routine
register_activation_hook( __FILE__, array( 'WC_WooTax', 'activate_wootax' ) );

// Deactivation routine
register_deactivation_hook( __FILE__, array( 'WC_WooTax', 'deactivate_wootax' ) );