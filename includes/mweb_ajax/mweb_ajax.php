<?php

function mweb_ajax_scripts(){ 
	$ajax_nonce = json_encode(wp_create_nonce( 'mweb-ajax-nonce' ));
	wp_add_inline_script( 'my-script', "var admin_ajax_nonce = {$ajax_nonce};" );
}
add_action( 'wp_enqueue_scripts', 'mweb_ajax_scripts' );

$mweb_theme_template_directory = get_template_directory();

require_once $mweb_theme_template_directory . '/includes/mweb_ajax/ajax_mic.php';
require_once $mweb_theme_template_directory . '/includes/mweb_ajax/ajax_filter.php';
require_once $mweb_theme_template_directory . '/includes/mweb_ajax/ajax_pagination.php';
require_once $mweb_theme_template_directory . '/includes/mweb_ajax/ajax_login_register.php';
require_once $mweb_theme_template_directory . '/includes/mweb_ajax/ajax_search.php';
require_once $mweb_theme_template_directory . '/includes/mweb_ajax/ajax_off.php';


/**-------------------------------------------------------------------------------------------------------------------------
 * registering ajax
 */

if ( ! function_exists( 'mweb_theme_ajax_admin_url' ) ) {
	function mweb_theme_ajax_admin_url() {
		wp_localize_script('mweb-admin-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
	}

	//add_action( 'admin_enqueue_scripts', 'mweb_theme_ajax_admin_url' );
}

/**-------------------------------------------------------------------------------------------------------------------------
 * @param $param
 *
 * @return array|string
 * validate data
 */
if ( ! function_exists( 'mweb_theme_data_validate' ) ) {
	function mweb_theme_data_validate( $param ) {
		if ( is_array( $param ) ) {
			foreach ( $param as $key => $val ) {
				$key           = sanitize_text_field( $key );
				$param[ $key ] = sanitize_text_field( $val );
			}
		} elseif ( is_string( $param ) ) {
			$param = sanitize_text_field( $param );
		} else {
			$param = '';
		}

		return $param;
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @param $data_query
 * @param $param
 *
 * @return bool|string
 * render ajax content
 */
if ( ! function_exists( 'mweb_theme_ajax_data_content' ) ) {
	function mweb_theme_ajax_data_content( $data_query, $param ) {

		//get content
		if ( ! empty( $param['block_name'] ) ) {
						
			switch ( $param['block_name'] ) {

				case 'mweb_blog_listing' :
					return mweb_blog_listing( $data_query, $param );
									
				case 'mweb_onsale_product_timeline' :
					return mweb_onsale_product_timeline( $data_query, $param );
					
				case 'mweb_product_list_tab' :
					return mweb_product_list_tab( $data_query, $param );
					
				case 'mweb_product_list_tab_v' :
					return mweb_product_list_tab_v( $data_query, $param );
					
				case 'mweb_product_listing' :
					return mweb_product_listing( $data_query, $param );
				
				case 'mweb_product_list_as_table' :
					return mweb_product_list_as_table( $data_query, $param );	
					
				default :
					return false;
			}
		} else {
			return false;
		}
	}
}



