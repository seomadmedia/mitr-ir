<?php
/**
 * Class mweb_theme_post_support
 */
if ( ! class_exists( 'mweb_theme_post_format' ) ) {
	class mweb_theme_post_format {


		/**-------------------------------------------------------------------------------------------------------------------------
		 * @return string
		 * check post format
		 */
		static function check_post_format() {
			$post_format = get_post_format();
			$post_id     = get_the_ID();

			if ( 'video' == $post_format ) {
				return 'video';
			} elseif ( 'gallery' == $post_format ) {
				return 'gallery';
			} else {
				return 'thumb';
			}
		}


	}
}
