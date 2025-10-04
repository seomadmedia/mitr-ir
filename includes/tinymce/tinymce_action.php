<?php

/**-------------------------------------------------------------------------------------------------------------------------
 * add tinymce to wysywyg
 */
if ( ! function_exists( 'mweb_add_tinymce' ) ) {

	function mweb_add_tinymce() {
		global $typenow;

		if ( 'post' != $typenow && 'page' != $typenow && 'product' != $typenow) {
			return false;
		}

		add_filter( 'mce_buttons', 'theme_mweb_tinymce_add_button' );
		add_filter( 'mce_external_plugins', 'theme_mweb_tinymce_plugin' );

	}

	add_action( 'admin_head', 'mweb_add_tinymce' );
}

if ( ! function_exists( 'theme_mweb_tinymce_plugin' ) ) {
	function theme_mweb_tinymce_plugin( $plugin_array ) {

		$plugin_array['theme_mweb_shortcodes'] = get_template_directory_uri() . '/includes/tinymce/tinymce_script.js';

		return $plugin_array;
	}
}

if ( ! function_exists( 'theme_mweb_tinymce_add_button' ) ) {
	function theme_mweb_tinymce_add_button( $buttons ) {

		array_push( $buttons, 'mweb_button_key' );

		return $buttons;
	}
}
