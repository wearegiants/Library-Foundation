<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://idx.is
 * @since      1.0.0
 *
 * @package    Clean_Inactive_Images
 * @subpackage Clean_Inactive_Images/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Clean_Inactive_Images
 * @subpackage Clean_Inactive_Images/admin
 * @author     Bruno Rodrigues <bruno@idx.is>
 */
class Clean_Inactive_Images_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * @var string $post_type The post type to search.
	 */
	private $post_type;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param      string $plugin_name The name of this plugin.
	 * @param      string $version The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Clean_Inactive_Images_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Clean_Inactive_Images_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/clean-inactive-images-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Clean_Inactive_Images_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Clean_Inactive_Images_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/clean-inactive-images-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function add_options_page() {
		add_submenu_page(
			'options-general.php',
			'Clean Inactive Images',
			'Clean Inactive Images',
			'administrator',
			'clean-inactive-images', array(
			$this,
			'render_options_page'
		) );
	}

	public function render_options_page() {
		require 'partials/clean-inactive-images-admin-display.php';
	}

	public function fetch_used_images() {
		$used_images = $this->get_used_images();
		add_user_meta( get_current_user_id(), 'content_used_images', $used_images, true );
		echo json_encode( $used_images );
		die;
	}

	private function get_used_images() {
		$img_paths = [ ];
		$img_paths = $this->get_images_from_post_content();
		$img_paths = array_merge( $img_paths, $this->get_images_from_post_thumbnails() );
		$img_paths = $this->get_images_from_id( $this->get_attachment_ids_from_post_galleries(), $img_paths );
		$img_paths = array_unique( $img_paths );

		return $this->clean_all_images_path( $img_paths );
	}

	/**
	 * @return array
	 */
	private function get_base_directory() {
		$base_directory = wp_upload_dir();
		$base_directory = $base_directory['basedir'];

		return $base_directory;
	}

	public function fetch_images_in_uploads_folder() {
		$all_images = $this->clean_all_images_path( $this->get_all_images_from_uploads_folder( $this->get_base_directory() ) );
		add_user_meta( get_current_user_id(), 'uploads_images', $all_images, true );
		echo json_encode( $all_images );
		die;
	}

	public function delete_unused_images() {
		$uploads = get_user_meta( get_current_user_id(), 'uploads_images', true );
		$content = get_user_meta( get_current_user_id(), 'content_used_images', true );

		$unused = array_diff( $uploads, $content );
		$this->delete_images( $unused, $this->get_base_directory() );

		delete_user_meta( get_current_user_id(), 'uploads_images' );
		delete_user_meta( get_current_user_id(), 'content_used_images' );

		echo json_encode( $unused );
		die;
	}

	private function find_all_dirs( $start ) {
		return array_diff( scandir( $start ), array( '..', '.' ) );
	}

	/**
	 * @param $base_directory
	 *
	 * @return array
	 */
	private function get_all_images_from_uploads_folder( $base_directory ) {
		$all_images = [ ];
		$years      = $this->find_all_dirs( $base_directory );
		foreach ( $years as $year ) {
			$path   = $base_directory . '/' . $year;
			$months = $this->find_all_dirs( $path );
			foreach ( $months as $month ) {
				$path       = $base_directory . '/' . $year . '/' . $month;
				$all_images = array_merge( $all_images, glob( $path . '/{*.jpg, *.jpeg, *.png}', GLOB_BRACE ) );
			}
		}

		return $all_images;
	}


	private function clean_image_path( $path ) {
		return substr( $path, strpos( $path, 'uploads/' ) + strlen( 'uploads/' ) );
	}

	private function clean_all_images_path( $all_images ) {
		$tmp = [ ];
		foreach ( $all_images as $image ) {
			$tmp[] = $this->clean_image_path( $image );
		}

		return $tmp;
	}


	private function get_image_id( $image ) {
		global $wpdb;
		$image = $this->clean_image_path( $image );
		$sql   = "select ID from wp_posts where guid like '%{$image}%';";

		return $wpdb->get_var( $sql );
	}

	public function register_plugin_settings() {
		register_setting( 'cii_settings_group', 'cii_post_type' );
	}

	/**
	 * @param $unused
	 * @param $base_directory
	 *
	 * @return string
	 */
	private function delete_images( $unused, $base_directory ) {
		foreach ( $unused as $image ) {
			$image = $base_directory . '/' . $image;
			if ( is_file( $image ) ) {
				$img_id = $this->get_image_id( $image );
				wp_delete_attachment( $img_id );
				@unlink( $image );
			}
		}

		return count( $unused );
	}

	/**
	 * @param $image
	 *
	 * @return array
	 */
	public function get_image_thumbs( $image ) {
		$base_directory = $this->get_base_directory();
		$image_name     = substr( $image, 0, strrpos( $image, '.' ) );

		$all_images   = glob( $base_directory . '/' . $image_name . '-*.*' );
		$all_images[] = $base_directory . '/' . $image;

		return $all_images;

	}

	private function get_images_from_post_content() {
		global $wpdb;

		$sql               = "SELECT post_content FROM wp_posts WHERE post_content REGEXP '\/uploads\/'";
		$all_posts_content = $wpdb->get_results( $sql );

		$all_images = [ ];

		foreach ( $all_posts_content as $post ) {
			preg_match_all( '/\/uploads\/\d{4}\/\d{2}\/[a-zA-z0-9\-\_]+\.(jpg|jpeg|png)/i', $post->post_content, $used_images );
			$all_images = array_merge( $all_images, $used_images[0] );
		}

		$unique_images = array_unique( $all_images );
		$all_images    = [ ];
		foreach ( $unique_images as $img ) {
			$all_images = array_merge( $all_images, $this->get_image_thumbs( substr( $img, 9 ) ) );
		}

		return $all_images;
	}

	private function get_attachment_ids_from_post_galleries() {
		global $wpdb;
		$attachment_ids    = [ ];
		$sql               = "SELECT post_content FROM wp_posts where (post_status = 'publish' or post_status = 'draft') and (post_content like '%[gallery%')";
		$all_posts_content = $wpdb->get_results( $sql );
		foreach ( $all_posts_content as $content ) {
			preg_match( '/\[gallery.*ids=.(.*).\]/', $content->post_content, $images_ids );
			if ( ! empty( $images_ids ) && isset( $images_ids[1] ) ) {
				$images_ids = explode( ",", $images_ids[1] );
				foreach ( $images_ids as $id ) {
					if ( ! empty( $id ) ) {
						if ( ! in_array( $id, $attachment_ids ) ) {
							$attachment_ids[] = $id;
						}
					}
				}
			}
		}

		return $attachment_ids;
	}

	private function get_images_from_post_thumbnails() {
		$thumb_paths = $this->get_thumbnails_paths();

		$all_images = [ ];
		foreach ( $thumb_paths as $path ) {
			$all_images = array_merge( $all_images, $this->get_image_thumbs( $path ) );
		}

		return $all_images;
	}

	private function get_thumbnails_paths() {
		global $wpdb;
		$sql = "SELECT guid FROM wp_postmeta INNER JOIN wp_posts ON wp_postmeta.meta_value = wp_posts.ID where wp_postmeta.meta_key = '_thumbnail_id'";

		$results = $wpdb->get_results( $sql );

		$paths = [ ];
		foreach ( $results as $result ) {
			$paths[] = $this->clean_image_path( $result->guid );
		}


		return $paths;

	}

	/**
	 * @param $attach_ids
	 * @param $img_paths
	 *
	 * @return array
	 */
	private function get_images_from_id( $attach_ids, $img_paths = [ ] ) {
		$base_directory = $this->get_base_directory();
		foreach ( $attach_ids as $img_id ) {
			$src = wp_get_attachment_image_src( $img_id, 'full' );

			$clean_path = $this->clean_image_path( $src[0] );

			$img_paths = array_merge( $img_paths, $this->get_image_thumbs( $clean_path ) );
		}

		return $img_paths;
	}
}
