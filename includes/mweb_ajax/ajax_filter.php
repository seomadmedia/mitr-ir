<?php
/**-------------------------------------------------------------------------------------------------------------------------
 * ajax block filter
 */
if ( ! function_exists( 'mweb_theme_ajax_filter_data' ) ) {
	add_action( 'wp_ajax_nopriv_mweb_theme_ajax_filter_data', 'mweb_theme_ajax_filter_data' );
	add_action( 'wp_ajax_mweb_theme_ajax_filter_data', 'mweb_theme_ajax_filter_data' );

	function mweb_theme_ajax_filter_data() {

		$param                    = array();
		$data_response            = array();
		$data_response['content'] = '';

		if ( ! empty( $_POST['data'] ) ) {
			$param = mweb_theme_data_validate( $_POST['data'] );
		}

		// اضافه کردن فیلتر موجودی
		if ( ! empty( $param['in_stock'] ) && $param['in_stock'] == 'yes' ) {
			$param['in_stock'] = true;
		} else {
			$param['in_stock'] = false;
		}

		$data_query = mweb_theme_query::get_custom_query( $param );
		if ( ! empty( $data_query->max_num_pages ) ) {
			$data_response['block_page_max'] = $data_query->max_num_pages;
		}

		// دریافت محتوا
		$data_response['content'] = mweb_theme_ajax_data_content( $data_query, $param );

		wp_reset_postdata();

		die( json_encode( $data_response ) );
	}
}
