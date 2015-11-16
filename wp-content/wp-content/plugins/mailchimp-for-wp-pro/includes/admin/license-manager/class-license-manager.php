<?php

if( ! interface_exists( 'iDVK_License_Manager', false ) ) {

	interface iDVK_License_Manager {

		public function specific_hooks();
		public function setup_auto_updater();

	}

}


if( ! class_exists( 'DVK_License_Manager', false ) ) {

	/**
	 * Class DVK_License_Manager
	 *
	 * Modified version of the Yoast License Manager class - https://github.com/Yoast/License-Manager
	 */
	abstract class DVK_License_Manager implements iDVK_License_Manager {

		/**
		* @const VERSION The version number of the License_Manager class
		*/
		const VERSION = 2;

		/**
		 * @var DVK_Product The license
		 */
		protected $product;

		/**
		* @var string
		*/
		private $license_constant_name = '';

		/**
		* @var boolean True if license is defined with a constant
		*/
		private $license_constant_is_defined = false;

		/**
		* @var boolean True if remote license activation just failed
		*/
		private $remote_license_activation_failed = false;

		/**
		* @var array Array of license related options
		*/
		private $options = array();

		/**
		 * @var bool Boolean indicating whether this plugin is network activated
		 */
		protected $is_network_activated = false;

		/**
		 * Constructor
		 *
		 * @param DVK_Product $product
		 */
		public function __construct( DVK_Product $product ) {

			// Set the license
			$this->product = $product;

			// run upgrade script
			if( is_admin() && get_option( $product->get_prefix() . 'license_manager_version', 0 ) < self::VERSION ) {
				$this->upgrade();
			}

			// maybe set license key from constant
			$this->maybe_set_license_key_from_constant();
		}

		/**
		 * Makes sure the database is in sync with current code
		 * Runs every time the VERSION constant has changed
		 */
		private function upgrade() {

			// transfer old option to new option (with shorter prefix)
			if( self::VERSION === 2 && $this->get_license_key() === '' ) {

				// retrieve old option
				$old_license_option_name = sanitize_title_with_dashes( $this->product->get_item_name() . '_', null, 'save' ) . 'license';

				// store in new option key, remove old option
				if( $this->is_network_activated ) {
					$old_license_option = get_site_option( $old_license_option_name, array() );
					update_site_option( $this->product->get_prefix() . 'license', $old_license_option );
					delete_site_option( $old_license_option_name );
				} else {
					$old_license_option = get_option( $old_license_option_name, array() );
					update_option( $this->product->get_prefix() . 'license', $old_license_option );
					delete_option( $old_license_option_name );
				}

			}

			// make sure the upgrade code only runs once
			update_option( $this->product->get_prefix() . 'license_manager_version', self::VERSION );
		}

		/**
		 * Setup hooks
		 *
		 */
		public function setup_hooks() {

			// show admin notice if license is not active
			add_action( 'admin_notices', array( $this, 'display_admin_notices' ) );

			// catch general GET requests
			add_action( 'admin_init', array( $this, 'catch_get_request' ) );

			// catch POST requests from license form
			add_action( 'admin_init', array( $this, 'catch_post_request') );

			// setup item type (plugin|theme) specific hooks
			$this->specific_hooks();

			// setup the auto updater
			$this->setup_auto_updater();
		}

		/**
		* Display license specific admin notices, namely:
		*
		* - License for the product isn't activated
		* - External requests are blocked through WP_HTTP_BLOCK_EXTERNAL
		*/
		public function display_admin_notices() {

			// show notice if license is invalid
			if( ! $this->license_is_valid() ) {

				if( $this->get_license_key() == '' ) {
					$message = '<b>Warning!</b> You didn\'t set your %s license key yet, which means you\'re missing out on updates and support! <a href="%s">Enter your license key</a> or <a href="%s" target="_blank">get a license here</a>.';
				} else {
					$message = '<b>Warning!</b> Your %s license is inactive which means you\'re missing out on updates and support! <a href="%s">Activate your license</a> or <a href="%s" target="_blank">get a license here</a>.';
				}

				$on_settings_page = ( isset( $_GET['page'] ) && stristr( $_GET['page'], 'mc4wp' ) !== false );

				if( $this->get_option( 'show_notice' ) !== false || $on_settings_page ) {

					// add dismiss button if in any admin section
					if( ! $on_settings_page ) {
						$message .= ' <a class="button" href="'. wp_nonce_url( add_query_arg( array( $this->product->get_prefix() . 'action' => 'dismiss_license_notice' ) ), $this->product->get_prefix() . 'dismiss_license_notice' ) .'">'. __( 'I know. Don\'t bug me.', 'mailchimp-for-wp' ) . '</a>';
					}
					?>
					<div class="error">
						<p><?php printf( __( $message, $this->product->get_text_domain() ), $this->product->get_item_name(), $this->product->get_license_page_url(), $this->product->get_tracking_url( 'activate-license-notice' ) ); ?></p>
					</div>
					<?php
				}
			}

			// show notice if external requests are blocked through the WP_HTTP_BLOCK_EXTERNAL constant
			if( defined( 'WP_HTTP_BLOCK_EXTERNAL' ) && WP_HTTP_BLOCK_EXTERNAL === true ) {

				// check if our API endpoint is in the allowed hosts
				$host = parse_url( $this->product->get_api_url(), PHP_URL_HOST );

				if( ! defined( 'WP_ACCESSIBLE_HOSTS' ) || stristr( WP_ACCESSIBLE_HOSTS, $host ) === false ) {
					?>
					<div class="error">
						<p><?php printf( __( '<b>Warning!</b> You\'re blocking external requests which means you won\'t be able to get %s updates. Please add %s to %s.', $this->product->get_text_domain() ), $this->product->get_item_name(), '<strong>' . $host . '</strong>', '<code>WP_ACCESSIBLE_HOSTS</code>' ); ?></p>
					</div>
					<?php
				}

			}
		}

		/**
		* Set a notice to display in the admin area
		*
		* @param string $type error|updated
		* @param string $message The message to display
		*/
		protected function set_notice( $message, $success = true ) {
			$css_class = ( $success ) ? 'updated' : 'error';
			add_settings_error( $this->product->get_prefix() . 'license', 'license-notice', $message, $css_class );
		}

		/**
		 * Remotely activate License
		 * @return boolean True if the license is now activated, false if not
		 */
		public function activate_license() {

			$result = $this->call_license_api( 'activate' );

			if( $result ) {

				// story expiry date
				if( isset( $result->expires ) ) {
					$this->set_license_expiry_date( $result->expires );
					$expiry_date = strtotime( $result->expires );
				} else {
					$expiry_date = false;
				}

				// show success notice if license is valid
				if( $result->license === 'valid' ) {

					// show a custom notice if users have an unlimited license
					if( $result->license_limit == 0 ) {
						$message = sprintf( __( 'Your %s license has been activated. You have an unlimited license. ', $this->product->get_text_domain() ), $this->product->get_item_name() );
					} else {
						$message = sprintf( __( 'Your %s license has been activated. You have used %d/%d activations. ', $this->product->get_text_domain() ), $this->product->get_item_name(), $result->site_count, $result->license_limit );
					}

					// add upgrade notice if user has less than 3 activations left
					if( $result->license_limit > 0 && ( $result->license_limit - $result->site_count ) <= 3 ) {
						$message .= sprintf( __( '<a href="%s">Did you know you can upgrade your license?</a>', $this->product->get_text_domain() ), $this->product->get_tracking_url( 'license-nearing-limit-notice' ) );
						// add extend notice if license is expiring in less than 1 month
					} elseif( $expiry_date !== false && $expiry_date < strtotime( '+1 month' ) ) {
						$days_left = round( ( $expiry_date - strtotime( 'now' ) ) / 86400 );
						$message .= sprintf( __( '<a href="%s">Your license is expiring in %d days, would you like to extend it?</a>', $this->product->get_text_domain() ), 'https://mc4wp.com/checkout/?edd_license_key=' . esc_attr( $this->get_license_key() ) . '&download_id=899', $days_left );
					}

					$this->set_notice( $message, true );

				} else {

					if( isset( $result->error ) && $result->error === 'no_activations_left' ) {
						// show notice if user is at their activation limit
						$this->set_notice( sprintf( __( 'You\'ve reached your activation limit. You must <a href="%s">reset</a> or <a href="%s">upgrade your license</a> to use it on this site.', $this->product->get_text_domain() ), 'https://mc4wp.com/kb/resetting-license-activations/', $this->product->get_tracking_url( 'license-at-limit-notice' ) ), false );
					} elseif( isset($result->error) && $result->error === 'expired' ) {
						// show notice if the license is expired
						$result->license = 'expired';
						$this->set_notice( sprintf( __( 'Your license has expired. You must <a href="%s">renew your license</a> if you want to use it again.', $this->product->get_text_domain() ), 'https://mc4wp.com/checkout/?edd_license_key=' . esc_attr( $this->get_license_key() ) . '&download_id=899', false ) );
					} else {
						// show a general notice if it's any other error
						$this->set_notice( __( 'Failed to activate your license, your license key seems to be invalid.', $this->product->get_text_domain() ), false );
					}

					$this->remote_license_activation_failed = true;
				}

				$this->set_license_status( $result->license );
			}

			return ( $this->license_is_valid() );
		}

		/**
		 * Remotely deactivate License
		 * @return boolean True if the license is now deactivated, false if not
		 */
		public function deactivate_license () {

			$result = $this->call_license_api( 'deactivate' );

			if( $result ) {

				// show notice if license is deactivated
				if( $result->license === 'deactivated' ) {
					$this->set_license_status( $result->license );
					$this->set_notice( sprintf( __( 'Your %s license has been deactivated.', $this->product->get_text_domain() ), $this->product->get_item_name() ) );

					// deactivation failed, check if license has expired
				} elseif( isset( $result->expires ) && strtotime( 'now' ) > strtotime( $result->expires ) ) {
					$this->set_license_status( 'expired' );
					$this->set_notice( sprintf( __( 'Your plugin license has expired. You will no longer have access to plugin updates unless you <a href="%s">renew your license</a>.', 'mailchimp-for-wp' ), 'https://mc4wp.com/checkout/?edd_license_key=' . esc_attr( $this->get_license_key() ) . '&download_id=899' ) );
				} else {
					$this->set_notice( sprintf( __( 'Failed to deactivate your %s license.', $this->product->get_text_domain() ), $this->product->get_item_name() ), false );
				}

			}

			return ( $this->get_license_status() === 'deactivated' );
		}

		/**
		* @param string $action activate|deactivate
		* @return mixed
		*/
		protected function call_license_api( $action ) {

			// don't make a request if license key is empty
			if( $this->get_license_key() === '' ) {
				return false;
			}

			// data to send in our API request
			$api_params = array(
				'edd_action' => $action . '_license',
				'license'    => $this->get_license_key(),
				'url' => get_option( 'home' )
			);

			// setup request parameters
			$request_params = array(
				'method' => 'POST',
				'body'      => $api_params
			);


			require_once dirname( __FILE__ ) . '/class-api-request.php';
			$request = new DVK_API_Request( $this->product->get_api_url(), $request_params );

			if( $request->is_valid() !== true ) {

				$notice = sprintf( __( 'Request error: "%s"', $this->product->get_text_domain() ), $request->get_error_message() );

				$this->set_notice( $notice, false );
			}

			// get response
			$response = $request->get_response();

			// update license status
			$license_data = $response;

			return $license_data;
		}



		/**
		* Set the license status
		*
		* @param string $license_status
		*/
		public function set_license_status( $license_status ) {
			$this->set_option( 'status', $license_status );
		}

		/**
		* Get the license status
		*
		* @return string $license_status;
		*/
		public function get_license_status() {
			$license_status = $this->get_option( 'status' );
			return trim( $license_status );
		}

		/**
		* Set the license key
		*
		* @param string $license_key
		*/
		public function set_license_key( $license_key ) {
			$this->set_option( 'key', $license_key );
		}

		/**
		* Gets the license key from constant or option
		*
		* @return string $license_key
		*/
		public function get_license_key() {
			$license_key = $this->get_option( 'key' );
			return trim( $license_key );
		}

		/**
		* Gets the license expiry date
		*
		* @return string
		*/
		public function get_license_expiry_date() {
			return $this->get_option( 'expiry_date' );
		}

		/**
		* Stores the license expiry date
		*/
		public function set_license_expiry_date( $expiry_date ) {
			$this->set_option( 'expiry_date', $expiry_date );
		}

		/**
		* Checks whether the license status is active
		*
		* @return boolean True if license is active
		*/
		public function license_is_valid() {
			return ( $this->get_license_status() === 'valid' );
		}

		/**
		* Get all license related options
		*
		* @return array Array of license options
		*/
		protected function get_options() {

			// create option name
			$option_name = $this->product->get_prefix() . 'license';

			// get array of options from db
			if( $this->is_network_activated ) {
				$options = get_site_option( $option_name, array( ) );
			} else {
				$options = get_option( $option_name, array( ) );
			}

			// setup array of defaults
			$defaults = array(
				'key' => '',
				'status' => '',
				'expiry_date' => '',
				'show_notice' => true
			);

			// merge options with defaults
			$this->options = wp_parse_args( $options, $defaults );

			return $this->options;
		}

		/**
		* Set license related options
		*
		* @param array $options Array of new license options
		*/
		protected function set_options( array $options ) {
			// create option name
			$option_name = $this->product->get_prefix() . 'license';

			// update db
			if( $this->is_network_activated ) {
				update_site_option( $option_name, $options );
			} else {
				update_option( $option_name, $options );
			}

		}

		/**
		* Gets a license related option
		*
		* @param string $name The option name
		* @return mixed The option value
		*/
		protected function get_option( $name ) {
			$options = $this->get_options();
			return $options[ $name ];
		}

		/**
		* Set a license related option
		*
		* @param string $name The option name
		* @param mixed $value The option value
		*/
		protected function set_option( $name, $value ) {
			// get options
			$options = $this->get_options();

			// update option
			$options[ $name ] = $value;

			// save options
			$this->set_options( $options );
		}

		public function show_license_form_heading() {
			?>
			<h3>
				<?php printf( __( '%s: License Settings', $this->product->get_text_domain() ), $this->product->get_item_name() ); ?>&nbsp; &nbsp;
			</h3>
			<?php
		}

		/**
		* Show a form where users can enter their license key
		*
		* @param boolean $embedded Boolean indicating whether this form is embedded in another form?
		*/
		public function show_license_form( $embedded = true ) {

			$key_name = $this->product->get_prefix() . 'license_key';
			$nonce_name = $this->product->get_prefix() . 'license_nonce';
			$action_name = $this->product->get_prefix() . 'license_action';


			$visible_license_key = $this->get_license_key();

			// obfuscate license key
			$obfuscate = ( strlen( $this->get_license_key() ) > 5 && ( $this->license_is_valid() || ! $this->remote_license_activation_failed ) && $this->get_license_status() !== 'expired' );

			if($obfuscate) {
				$visible_license_key = str_repeat( '*', strlen( $this->get_license_key() ) - 4 ) . substr( $this->get_license_key(), -4 );
			}

			// make license key readonly when license key is valid or license is defined with a constant
			$readonly = ( $this->license_is_valid() || $this->license_constant_is_defined );

			require dirname( __FILE__ ) . '/views/form.php';

			// enqueue script in the footer
			add_action( 'admin_footer', array( $this, 'output_script'), 99 );
		}

		/**
		 * Perform actions on some GET requests
		 */
		public function catch_get_request() {

			// only act on $prefix_action
			if( ! isset( $_GET[ $this->product->get_prefix() . 'action' ] ) ) {
				return;
			}

			// Get action
			$action = $_GET[ $this->product->get_prefix() . 'action' ];

			// make sure we're coming from an admin page
			if( ! check_admin_referer( $this->product->get_prefix() . $action ) ) {
				return;
			}

			switch( $action ) {
				case 'dismiss_license_notice':
					$this->set_option( 'show_notice', false );
					break;
			}


		}

		/**
		* Check if the license form has been submitted
		*/
		public function catch_post_request() {

			$name = $this->product->get_prefix() . 'license_key';

			// check if license key was posted and not empty
			if( ! isset( $_POST[$name] ) ) {
				return;
			}

			// run a quick security check
			$nonce_name = $this->product->get_prefix() . 'license_nonce';

			if ( ! check_admin_referer( $nonce_name, $nonce_name ) ) {
				return;
			}

			if( ! current_user_can( 'manage_options' ) ) {
	            return;
			}

			// get key from posted value
			$license_key = $_POST[$name];

			// check if license key doesn't accidentally contain asterisks
			if( strstr( $license_key, '*' ) === false ) {

				// sanitize key
				$license_key = trim( sanitize_key( $_POST[$name] ) );

				// save license key
				$this->set_license_key( $license_key );
			}

			// does user have an activated valid license
			if( ! $this->license_is_valid() ) {

				// try to auto-activate license
				return $this->activate_license();

			}

			$action_name = $this->product->get_prefix() . 'license_action';

			// was one of the action buttons clicked?
			if( isset( $_POST[ $action_name ] ) ) {

				$action = trim( $_POST[ $action_name ] );

				switch($action) {

					case 'activate':
						return $this->activate_license();
						break;

					case 'deactivate':
						return $this->deactivate_license();
						break;
				}

			}

		}

		/**
		* Output the script containing the YoastLicenseManager JS Object
		*
		* This takes care of disabling the 'activate' and 'deactivate' buttons
		*/
		public function output_script() {
			require_once dirname( __FILE__ ) . '/views/script.php';
		}

		/**
		* Set the constant used to define the license
		*
		* @param string $license_constant_name The license constant name
		*/
		public function set_license_constant_name( $license_constant_name ) {
			$this->license_constant_name = trim( $license_constant_name );
			$this->maybe_set_license_key_from_constant();
		}

		/**
		* Maybe set license key from a defined constant
		*/
		private function maybe_set_license_key_from_constant( ) {

			if( empty( $this->license_constant_name ) ) {
				// generate license constant name
				$this->set_license_constant_name( strtoupper( str_replace( array(' ', '-' ), '', sanitize_key( $this->product->get_item_name() ) ) ) . '_LICENSE' );
			}

			// set license key from constant
			if( defined( $this->license_constant_name ) ) {

				$license_constant_value = constant( $this->license_constant_name );

				// update license key value with value of constant
				if( $this->get_license_key() !== $license_constant_value ) {
					$this->set_license_key( $license_constant_value );
				}

				$this->license_constant_is_defined = true;
			}
		}


	}

}