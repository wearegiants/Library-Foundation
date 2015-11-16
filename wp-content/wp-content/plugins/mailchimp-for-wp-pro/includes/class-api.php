<?php

if( ! defined( 'MC4WP_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}
/**
 * Takes care of requests to the MailChimp API
 *
 * @uses WP_HTTP
 */
class MC4WP_API {

	/**
	* @var string The URL to the MailChimp API
	*/
	private $api_url = 'https://api.mailchimp.com/2.0/';

	/**
	* @var string The API key to use
	*/
	private $api_key = '';

	/**
	* @var string The error message of the latest API request (if any)
	*/
	private $error_message = '';

	/**
	* @var boolean Boolean indicating whether the user is connected with MailChimp
	*/
	private $connected = null;

	/**
	 * @var object The full response object of the latest API call
	 */
	private $last_response;

	/**
	* Constructor
	*
	* @param string $api_key
	*/
	public function __construct( $api_key ) {
		$this->api_key = $api_key;

		$dash_position = strpos( $api_key, '-' );
		if( $dash_position !== false ) {
			$this->api_url = 'https://' . substr( $api_key, $dash_position + 1 ) . '.api.mailchimp.com/2.0/';
		}
	}

	/**
	 * Show an error message to administrators
	 *
	 * @param string $message
	 *
	 * @return bool
	 */
	private function show_error( $message ) {
		if( ! is_admin() || ! current_user_can( 'manage_options' ) ) {
			return false;
		}

		add_settings_error( 'mc4wp-api', 'mc4wp-api-error', $message, 'error' );
		return true;
	}

	/**
	* Pings the MailChimp API to see if we're connected
	*
	* The result is cached to ensure a maximum of 1 API call per page load
	*
	* @return boolean
	*/
	public function is_connected() {
		if( $this->connected !== null ) {
			return $this->connected;
		}

		$this->connected = false;
		$result = $this->call( 'helper/ping' );

		if( $result !== false ) {
			if( isset( $result->msg ) && $result->msg === "Everything's Chimpy!" ) {
				$this->connected = true;
			} else {
				$this->show_error( 'MailChimp Error: ' . $result->error );
			}
		}

		return $this->connected;
	}

	/**
	* Sends a subscription request to the MailChimp API
	*
	* @param string $list_id The list id to subscribe to
	* @param string $email The email address to subscribe
	* @param array $merge_vars Array of extra merge variables
	* @param string $email_type The email type to send to this email address. Possible values are `html` and `text`.
	* @param boolean $double_optin Should this email be confirmed via double opt-in?
	* @param boolean $update_existing Update information if this email is already on list?
	* @param boolean $replace_interests Replace interest groupings, only if update_existing is true.
	* @param boolean $send_welcome Send a welcome e-mail, only if double_optin is false.
	*
	* @return boolean|string True if success, 'error' if error
	*/
	public function subscribe($list_id, $email, array $merge_vars = array(), $email_type = 'html', $double_optin = true, $update_existing = false, $replace_interests = true, $send_welcome = false ) {
		$data = array(
			'id' => $list_id,
			'email' => array( 'email' => $email),
			'merge_vars' => $merge_vars,
			'email_type' => $email_type,
			'double_optin' => $double_optin,
			'update_existing' => $update_existing,
			'replace_interests' => $replace_interests,
			'send_welcome' => $send_welcome
		);

		$response = $this->call( 'lists/subscribe', $data );

		if( is_object( $response ) ) {

			if( isset( $response->error ) ) {
				// check error
				if( (int) $response->code === 214 ) {
					return 'already_subscribed';
				}

				// store error message
				$this->error_message = $response->error;
				return 'error';
			} else {
				return true;
			}

		}

		return 'error';
	}

	/**
	* Gets the Groupings for a given List
	* @param int $list_id
	* @return array|boolean
	*/
	public function get_list_groupings( $list_id ) {
		$result = $this->call( 'lists/interest-groupings', array( 'id' => $list_id ) );
		if( is_array( $result ) ) {
			return $result;
		}

		return false;
	}

	/**
	 * @param array $list_ids Array of ID's of the lists to fetch. (optional)
	 *
	 * @return bool
	 */
	public function get_lists( $list_ids = array() ) {
		$args = array(
			'limit' => 100
		);

		// set filter if the $list_ids parameter was set
		if( count( $list_ids ) > 0 ) {
			$args['filters'] = array(
				'list_id' => implode( ',', $list_ids )
			);
		}

		$result = $this->call( 'lists/list', $args );

		if( is_object( $result ) && isset( $result->data ) ) {
			return $result->data;
		}

		return false;
	}

	/**
	* Get lists with their merge_vars for a given array of list id's
	* @param array $list_ids
	* @return array|boolean
	*/
	public function get_lists_with_merge_vars( $list_ids ) {
		$result = $this->call( 'lists/merge-vars', array('id' => $list_ids ) );

		if( is_object( $result ) && isset( $result->data ) ) {
			return $result->data;
		}

		return false;
	}

	/**
	* Gets the member info for one or multiple emails on a list
	*
	* @param string $list_id
	* @param array $struct
	* @return array
	*/
	public function get_subscriber_info( $list_id, array $struct ) {
		$result = $this->call( 'lists/member-info', array(
				'id' => $list_id,
				'emails'  => $struct
			)
		);

		if( is_object( $result ) && isset( $result->data ) ) {
			return $result->data;
		}

		return false;
	}

	/**
	* Checks if an email address is on a given list
	*
	* @param string $list_id
	* @param string $email
	* @return boolean
	*/
	public function list_has_subscriber( $list_id, $email ) {
		$member_info = $this->get_subscriber_info( $list_id, array( array( 'email' => $email ) ) );

		if( is_array( $member_info ) && isset( $member_info[0] ) ) {
			return ( $member_info[0]->status === 'subscribed' );
		}

		return false;
	}

	/**
	 * @param        $list_id
	 * @param array|string $email
	 * @param array  $merge_vars
	 * @param string $email_type
	 * @param bool   $replace_interests
	 *
	 * @return bool
	 */
	public function update_subscriber( $list_id, $email, $merge_vars = array(), $email_type = 'html', $replace_interests = false ) {

		// default to using email for updating
		if( ! is_array( $email ) ) {
			$email = array(
				'email' => $email
			);
		}

		$result = $this->call( 'lists/update-member', array(
				'id' => $list_id,
				'email'  => $email,
				'merge_vars' => $merge_vars,
				'email_type' => $email_type,
				'replace_interests' => $replace_interests
			)
		);

		if( is_object( $result ) ) {

			if( isset( $result->error ) ) {
				$this->error_message = $result->error;
				return false;
			} else {
				return true;
			}

		}

		return false;
	}

	/**
	 * Unsubscribes the given email or luid from the given MailChimp list
	 *
	 * @param string       $list_id
	 * @param array|string $struct
	 * @param bool         $delete_member
	 * @param bool         $send_goodbye
	 * @param bool         $send_notification
	 *
	 * @return bool
	 */
	public function unsubscribe( $list_id, $struct, $send_goodbye = true, $send_notification = false, $delete_member = false ) {

		if( ! is_array( $struct ) ) {
			// assume $struct is an email
			$struct = array(
				'email' => $struct
			);
		}

		$response = $this->call( 'lists/unsubscribe', array(
				'id' => $list_id,
				'email' => $struct,
				'delete_member' => $delete_member,
				'send_goodbye' => $send_goodbye,
				'send_notify' => $send_notification
			)
		);

		if( is_object( $response ) ) {

			if ( isset( $response->complete ) && $response->complete ) {
				return true;
			}

			if( isset( $response->error ) ) {
				$this->error_message = $response->error;
			}
		}

		return false;
	}

	/**
	* Calls the MailChimp API
	*
	* @uses WP_HTTP
	*
	* @param string $method
	* @param array $data
	*
	* @return object
	*/
	public function call( $method, array $data = array() ) {
		// do not make request when no api key was provided.
		if( empty( $this->api_key ) ) {
			return false;
		}

		$data['apikey'] = $this->api_key;
		$url = $this->api_url . $method . '.json';

		$response = wp_remote_post( $url, array(
			'body' => $data,
			'timeout' => 15,
			'headers' => array('Accept-Encoding' => ''),
			'sslverify' => false
			)
		);

		if( is_wp_error( $response ) ) {

			// show error message to admins
			$this->show_error( 'HTTP Error: ' . $response->get_error_message() );
			return false;
		}

		// dirty fix for older WP version
		if( $method === 'helper/ping' && is_array( $response ) && isset( $response['headers']['content-length'] ) && (int) $response['headers']['content-length'] === 44 ) {
			return (object) array( 'msg' => "Everything's Chimpy!");
		}

		$body = wp_remote_retrieve_body( $response );
		$response = json_decode( $body );

		// store response
		if( is_object( $response ) ) {
			$this->last_response = $response;
		}

		return $response;
	}

	/**
	* Checks if an error occured in the most recent request
	* @return boolean
	*/
	public function has_error() {
		return ( ! empty( $this->error_message ) );
	}

	/**
	* Gets the most recent error message
	* @return string
	*/
	public function get_error_message() {
		return $this->error_message;
	}

	/**
	 * Get the most recent response object
	 *
	 * @return object
	 */
	public function get_last_response() {
		return $this->last_response;
	}
}
