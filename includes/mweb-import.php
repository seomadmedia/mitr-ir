<?php


   	/*
 * @package     WBC_Importer - Extension for Importing demo content
 * @author      Webcreations907
 * @version     1.0
 */

if ( ! function_exists( 'mweb_imported_demo' ) ) {
	function mweb_imported_demo( $demo_active_import, $demo_directory_path ) {

		reset( $demo_active_import );
		$current_key = key( $demo_active_import );

		//delete hello word
		wp_delete_post( 1 );

		/************************************************************************
		 * Remove all default widget
		 *************************************************************************/

		global $wp_registered_sidebars;
		$tn_widgets = get_option( 'sidebars_widgets' );
		foreach ( $wp_registered_sidebars as $sidebar => $value ) {
			unset( $tn_widgets[ $sidebar ] );
		}
		//update with widgets removed
		update_option( 'sidebars_widgets', $tn_widgets );


		/************************************************************************
		 * Setting Menus
		 *************************************************************************/

		$tn_menu_array = array( 'demo1' );

		if ( isset( $demo_active_import[ $current_key ]['directory'] ) && ! empty( $demo_active_import[ $current_key ]['directory'] ) && in_array( $demo_active_import[ $current_key ]['directory'], $tn_menu_array ) ) {
			$one_menu = get_term_by( 'name', 'منو اصلی', 'nav_menu' );
			$two_menu  = get_term_by( 'name', 'منو موبایل', 'nav_menu' );
			$thr_menu  = get_term_by( 'name', 'منو پنل کاربری', 'nav_menu' );
			$four_menu  = get_term_by( 'name', 'دسترسی سریع', 'nav_menu' );
			$five_menu  = get_term_by( 'name', 'راهنمای خرید', 'nav_menu' );
			$six_menu  = get_term_by( 'name', 'خدمات مشتریان', 'nav_menu' );

			if ( isset( $one_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'main-menu' => $one_menu->term_id,
						'two-menu'  => $two_menu->term_id,
					    'user-menu'  => $thr_menu->term_id,
						'foot-menu-1'  => $four_menu->term_id,
						'foot-menu-2'  => $five_menu->term_id,
						'foot-menu-3'  => $six_menu->term_id,
					)
				);
			}

		}
		
		/************************************************************************
		* Set HomePage
		*************************************************************************/
		// array of demos/homepages to check/select from
		$wbc_home_pages = array(
			'demo1' => 'صفحه اصلی'
		);
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
		
			$page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
			
			if ( isset( $page->ID ) ) {
				update_option( 'page_on_front', $page->ID );
				update_option( 'show_on_front', 'page' );

			}
			
		}		
	

	}

	add_action( 'wbc_importer_after_content_import', 'mweb_imported_demo', 10, 2 );
}



?>