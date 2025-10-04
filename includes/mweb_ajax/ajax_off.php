<?php
/**-------------------------------------------------------------------------------------------------------------------------
 * ajax discount
 */
		
add_action( 'wp_ajax_nopriv_mweb_ajax_discount', 'mweb_ajax_discount' );
add_action( 'wp_ajax_mweb_ajax_discount', 'mweb_ajax_discount' );
if ( ! function_exists( 'mweb_ajax_discount' ) ) {
	function mweb_ajax_discount() {
		
		
		$param                    = array();
		$data_response            = array();
		$data_response['content'] = '';


		if ( ! empty( $_POST['data'] ) ) {
			$param = mweb_theme_data_validate( $_POST['data'] );
		}
		$data_query = mweb_theme_query::mweb_query_discount( $param );
		if ( ! empty( $data_query->max_num_pages ) ) {
			$data_response['block_page_max'] = $data_query->max_num_pages;
		}

	
		//get post data
		$data_response['content'] = mweb_theme_ajax_data_content( $data_query, $param );

		wp_reset_postdata();

		die( json_encode( $data_response ) );
		
	}
}