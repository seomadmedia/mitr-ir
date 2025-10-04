<?php

//Class mweb_theme_util
if ( ! class_exists( 'mweb_theme_util' ) ) {
	class mweb_theme_util {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $option_name
		 *
		 * @return string
		 * load value from theme options
		 */
		 

		static function get_theme_option( $option_name, $option_name_value = null ) {

			$settings = get_option( 'shop_options' );

			if ( ! empty( $settings[ $option_name ] ) ) {
				if($option_name_value == null) {
					return $settings[ $option_name ];
				}else{
					if( is_array( $settings[ $option_name ] ) ) {
						if( array_key_exists( $option_name_value, $settings[ $option_name ] ) ) {
							return $settings[ $option_name ][ $option_name_value ];
						}
					} 
				}
			}

			return false;
		}
		
		
		
		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $id 
		 * @return string
		 * get metabox 
		 */
		static function get_metabox_io($id) {
			if(empty($id)){
				return false;
			}
			
			$self_hosted_url = wp_get_attachment_url( $id );
			
			return $self_hosted_url;

		}
		
		

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return mixed
		 * get category page id
		 */
		static function get_page_cate_id() {

			global $wp_query;
			$mweb_page_cate_id = $wp_query->get_queried_object_id();

			//get blog options
			return $mweb_page_cate_id;
		}


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return bool
		 * get_site_blog_id
		 */
		static function get_site_blog_id() {

			if ( ! empty( $GLOBALS['blog_id'] ) ) {
				return $GLOBALS['blog_id'];
			} else {
				return false;
			}
		}
	}
}




/**
 * GET mweb Settings
 */
if ( ! function_exists('mweb_get_module_settings') ) {
	function mweb_get_module_settings( $option, $all = false, $default = '' ) {
		$options = get_option( 'mweb_settings' );
		if( $all == false ){
			if ( isset( $options[ $option ] ) ) {
				return $options[ $option ];
			}
		}else{
			return $options;
		}
		return $default;
	}
}