<?php
/*
Plugin Name: Product password protector (woocommerce)
Description: Plugin that can be used to enable password protection for your products by creating a password for them.
Version: 1.3
Author: Alex Masliychuk (alex91ckua)
Author URI: http://themeforest.net/user/alex91ckua
*/

require_once (dirname(__FILE__) . '/add_product_options.php');

require_once (dirname(__FILE__) . '/install.php');

register_activation_hook (__FILE__, 'install');

add_action('admin_menu', 'add_product_protector_menu');


// Get Woocommerce Version

function wpbo_get_woo_version_number() {
        // If get_plugins() isn't available, require it
	if ( ! function_exists( 'get_plugins' ) )
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	
        // Create the plugins folder and file variables
	$plugin_folder = get_plugins( '/' . 'woocommerce' );
	$plugin_file = 'woocommerce.php';
	
	// If the plugin version number is set, return it 
	if ( isset( $plugin_folder[$plugin_file]['Version'] ) ) {
		return $plugin_folder[$plugin_file]['Version'];

	} else {
	// Otherwise return null
		return NULL;
	}
}

// End Get Woocommerce Version

///////////////////////////////////

function protector_ajax_load_scripts() {
	// load our jquery file that sends the $.post request
	wp_enqueue_script( "ajax-misc", plugin_dir_url( __FILE__ ) . '/ajax_misc.js', array( 'jquery' ) );
 
	// make the ajaxurl var available to the above script
	wp_localize_script( 'ajax-misc', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );	
}
add_action('wp_print_scripts', 'protector_ajax_load_scripts');


function protector_ajax_process_request() {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        if ( isset($_POST['category_id']) && isset($_POST['new_password']) ) {

            $categories_info = unserialize(get_option('product_protector_categories_info'));
            $categories_info[$_POST['category_id']] = $_POST['new_password'];

            update_option('product_protector_categories_info', serialize($categories_info) );
        }
    }
    
}
add_action('wp_ajax_protector_update_password', 'protector_ajax_process_request');

//////////////////////////////////////////

function add_product_protector_menu() {
    add_menu_page('Product protector', 'Protector', 'manage_options', 'product-protector', 'product_protector_menu_code');
}

function product_protector_menu_code() {
	if (isset($_POST['password'])) {
		
		$error = false;
		
		if ( strlen($_POST['password']) >= 4 ) {
			$new_password = $_POST['password'];
			update_option('product_protector',$new_password);
			
		} else {$error = true; $error_str = 'Password length must be at least 4 symbols.';}
	}
?>
        <style type="text/css" >
            
            .hidden-input {display: none;}
        </style>
        
        <script>
            function showHiddenBox(obj) {
                
                jQuery(obj).parent().parent().parent().find('.hidden-input').show();
            }
        </script>

	<div class="wrap">
            
            <h2>Product protector settings</h2>
          
            <h3>Main Options</h3>
            
		<form name="productform" id="productform" action="" method="post">
			<table class="form-table">
			  <tbody>
				<tr valign="top">
				  <th scope="row">
					<label>Set new password</label>
				  </th>
				  <td>
                                    <input type="text" name="password" value="" placeholder="Enter new password here" class="regular-text code">
				  </td>
				</tr>
				<tr valign="top">
				  <th scope="row">
					<label>Current password</label>
				  </th>
				  <td>
					<label><?php echo get_option('product_protector'); ?></label>
				  </td>
				</tr>
				<?php if($error) : ?>
					<tr valign="top">
					  <th scope="row">
						<label style="color: red;"><?php echo 'Error: ' . $error_str ?></label>
					  </th>
					  <td>
						<label></label>
					  </td>
					</tr>
				<?php endif; ?>
				<tr valign="top">
				  <th scope="row">
					<input type="submit" value="Change password" />
				  </th>
				</tr>				
			  </tbody>
			</table>
		</form>
            
            <h3>Password By Category</h3>
            
<table class="widefat">
<thead>
    <tr>
        <th><?php _e( 'Category' ); ?></th>
        <th><?php _e( 'Password' ); ?></th>
    </tr>
</thead>
<tfoot>
    <tr>
        <th><?php _e( 'Category' ); ?></th>
        <th><?php _e( 'Password' ); ?></th>
    </tr>
</tfoot>
<tbody>
    
<?php
    // get categories passwords
    
    $categories_info = unserialize(get_option('product_protector_categories_info'));

    // get all product categories
    $all_categories = get_categories( 'taxonomy=product_cat&hide_empty=0&hierarchical=1' );
    foreach ($all_categories as $cat) {

        //print_r($cat); // debug

        $category_id = $cat->term_id;
        
        $cat_password = 'no password';
        
        if ($categories_info[$category_id]) { $cat_password = $categories_info[$category_id]; }
        
        //$thumbnail_id 	= get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
        //$image = wp_get_attachment_url( $thumbnail_id );
        //echo '<li><a href="'. get_term_link($cat->slug, 'product_cat') .'"><div>'. $cat->name .'</div></a>';
        
        echo '
            <tr>
                <td class="post-title page-title column-title">
                    <strong><a class="row-title" href="javascript://" title="Edit this item">'.$cat->name.'</a></strong>
                    <div class="row-actions">
                        <span class="edit"><a href="javascript://" onclick="showHiddenBox(this);" title="Edit this item" >Edit</a> | </span>
                        <span class="trash"><a class="submitdelete" title="Delete password for this category" href="javascript://" onclick="deletePassword('.$category_id.');" >Delete Password</a></span>
                    </div>
                    <div class="hidden-input" >
                        <input id="new-password" type="text" value="" />
                        <input name="save" type="button" onclick="updatePassword(this, '.$category_id.');" class="button button-primary button-large" value="Update">
                    </div>
                </td>
                <td>'.$cat_password.'</td>  
            </tr>
        ';
    }
?>
    
</tbody>
</table>            
            
	</div>
<?php

}

function isSecured($product_id) {
	
	$product_isSecured = get_post_meta( $product_id, '_product_pass_checkbox', true );

	if ($product_isSecured == 'yes') return true;
	
        
        // we'll try to locate category password for product...
        
        $categories_info = unserialize(get_option('product_protector_categories_info')); // get categories passwords
        
        $terms = wp_get_post_terms( $product_id, 'product_cat' );
        foreach ( $terms as $term ) { $product_categories[] = $term->term_id; }	
        
        
        
		if ( !empty ($categories_info) && !empty($product_categories) ) {
		
			foreach ($categories_info as $key => $value) {
				
				if ( in_array($key, $product_categories)  ) {

					return true;
				}            
			}        
		}
	
	return false;
}

add_action( 'woocommerce_add_to_cart_validation', 'wpbo_check_product_password', 10, 10 );

function wpbo_check_product_password($valid, $product_id) {
    
        // Priority: Global password > Category password > Individual

	global $woocommerce, $post;
        
        $currentProductPass = get_option('product_protector'); // get global password
        
        /////////////////////////// Category password ////////////////////////
        
        $categories_info = unserialize(get_option('product_protector_categories_info')); // get categories passwords

        
        $terms = wp_get_post_terms( $product_id, 'product_cat' );
        foreach ( $terms as $term ) { $product_categories[] = $term->term_id; }
        
		if ( !empty ($categories_info) && !empty($product_categories) ) {
			
			ksort($categories_info);
			
			foreach ($categories_info as $key => $value) {
				
				if ( in_array($key, $product_categories) && $value != "" ) {

					$currentProductPass = $value;
				}            
			}
		}
        
        /////////////////////////// END Category password ////////////////////////
        
	if (strlen(get_post_meta( $product_id, '_product_individual_password_', true )) > 0) { // if individual password set
	
            $currentProductPass = get_post_meta( $product_id, '_product_individual_password_', true );
	}
        
        /* DEBUG
        print_r($categories_info);
        $woocommerce->add_message("Actual pass: " . $currentProductPass); 
         */       
	
	if (isSecured($product_id)) {
            
            if ($_POST['product_password'] == $currentProductPass) {
                return true;
            }
            else {

				$woo_version = wpbo_get_woo_version_number();

				if ( $woo_version >= 2.1 ) {
					 wc_add_notice( sprintf( "Wrong product password."), 'error' );
				} else if ( $woo_version < 2.1 ) {
					$woocommerce->add_error( "Wrong product password.");
				}				
				
            }
	} else {
            return true;
	}
}

/////////// addding input to the form

// Add custom form to product
	add_action('woocommerce_before_add_to_cart_button', 'password_input_wc_before_add_to_cart_button' );	

    // Add our custom form to the product page.
    function password_input_wc_before_add_to_cart_button() {

		global $post;
		$product_id = $post->ID;
                
		if (isSecured($product_id)) {
			echo '<div>
                                    <label class="product-protector-label">Product password (required)</label> 
                                    <input class="input-text product-protector-input" name="product_password" type="password" value="" >
                              </div><br/>';
		}
    }
    