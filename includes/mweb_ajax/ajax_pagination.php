<?php
/**-------------------------------------------------------------------------------------------------------------------------
 * ajax pagination for composers
 */
if ( ! function_exists( 'mweb_theme_pagination_data' ) ) {
	add_action( 'wp_ajax_nopriv_mweb_theme_pagination_data', 'mweb_theme_pagination_data' );
	add_action( 'wp_ajax_mweb_theme_pagination_data', 'mweb_theme_pagination_data' );

	function mweb_theme_pagination_data() {

		$param         = array();
		$data_response = array();

		if ( ! empty( $_POST['data'] ) ) {
			$param = mweb_theme_data_validate( $_POST['data'] );
		}
		if ( empty( $param['block_page_next'] ) ) {
			$param['block_page_next'] = 2;
		}

		$data_query = mweb_theme_query::get_custom_query( $param, intval( $param['block_page_next'] ) );

		if ( ! empty( $data_query->max_num_pages ) ) {
			$data_response['block_page_max'] = $data_query->max_num_pages;
		}

		if ( ! empty( $data_query->paged ) ) {
			$data_response['block_page_current'] = $data_query->paged;
		} else {
			$data_response['block_page_current'] = $param['block_page_next'];
		}

		//get post data
		$data_response['content'] = mweb_theme_ajax_data_content( $data_query, $param );

		wp_reset_postdata();

		die( json_encode( $data_response ) );
	}
}
