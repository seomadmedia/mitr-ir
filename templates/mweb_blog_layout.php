<?php

/**-------------------------------------------------------------------------------------------------------------------------
 * Class mweb_theme_layout
 * This file render layout for page
 */

if ( ! class_exists( 'mweb_theme_blog_layout' ) ) {
	class mweb_theme_blog_layout {

		//render
		static function render( $mweb_options ) {

			//check page layout
			/*if ( empty( $mweb_options['page_layout'] ) ) {
				$mweb_options['page_layout'] = 'general-list';
			}*/

			//create class
			$class   = array();
			$class[] = 'page-layout-wrap';
			$class[] = 'is-' . esc_attr( $mweb_options['page_layout'] );
			$class = implode( ' ', $class );

			//render
			if ( have_posts() ) {

				mweb_open_page_wrap( $class, $mweb_options['sidebar_position'] );
				
				
				mweb_theme_general_layout::render( $mweb_options );

				//render sidebar
				if ( ! empty( $mweb_options['sidebar_position'] ) && 'none' != $mweb_options['sidebar_position'] ) {
					mweb_get_sidebar( $mweb_options['sidebar_name'] );
				}

				mweb_close_page_wrap();
			} else {
				get_template_part( 'templates/section', 'no_content' );
			}
		}
	}
}