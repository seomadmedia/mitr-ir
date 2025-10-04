<?php
/**
 * this file support multi sidebars
 */
if ( ! class_exists( 'mweb_multi_sidebar' ) ) {
	class mweb_multi_sidebar {

        

		/**-------------------------------------------------------------------------------------------------------------------------
		 * save sidebar to database
		 */
		static function save_custom_sidebars() {
            
			//theme options
			global $shop_options;
			
			
			$sidebar_data   = array();
			$sidebar_data[] = array(
				'id'   => 'sidebar_default',
				'name' => esc_attr__( 'پیشفرض', 'mweb' ),
			);

			//add to array data
			if ( ! empty( $shop_options['mweb_multi_sidebar'] ) && is_array( $shop_options['mweb_multi_sidebar'] ) ) {
				foreach ( $shop_options['mweb_multi_sidebar'] as $sidebar ) {
					array_push( $sidebar_data, array(
							'id'   => 'mweb_sidebar_multi_' . self::name_to_id( $sidebar ),
							'name' => esc_attr( strip_tags( $sidebar ) ),
						)
					);
				}
			}

			//save to database
			$multi_sidebar = get_option( 'mweb_custom_multi_sidebars', '' );
			if ( ! empty( $multi_sidebar ) ) {
				update_option( 'mweb_custom_multi_sidebars', $sidebar_data );
			} else {
				add_option( 'mweb_custom_multi_sidebars', $sidebar_data );
			}
		}

		//name to id
		static function name_to_id($name)
		{
			$name = strtolower(strip_tags($name));
			$id = str_replace(array(' ', ',', '.', '"', "'", '/', "\\", '+', '=', ')', '(', '*', '&', '^', '%', '$', '#', '@', '!', '~', '`', '<', '>', '?', '[', ']', '{', '}', '|', ':',), '', $name);
			return $id;
		}
	}
}


// save multi sidebar actions
add_action( 'after_switch_theme', array( 'mweb_multi_sidebar', 'save_custom_sidebars' ) );
add_action( 'redux/options/shop_options/saved', array( 'mweb_multi_sidebar', 'save_custom_sidebars' ) );
add_action( 'redux/options/shop_options/reset', array( 'mweb_multi_sidebar', 'save_custom_sidebars' ) );
add_action( 'redux/options/shop_options/section/reset', array( 'mweb_multi_sidebar', 'save_custom_sidebars' ) );

