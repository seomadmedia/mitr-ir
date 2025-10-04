<?php

//meta box sidebar config
if ( ! function_exists( 'mweb_metabox_sidebar' ) ) {
	function mweb_metabox_sidebar() {
		return array(
			
			'fields'     => array(
				array(
					'id'      => 'mweb_sidebar_title',
					'type'    => 'select',
					'title'    => esc_attr__( 'نام سایدبار', 'mweb' ),
					'options' => mweb_theme_config::sidebar_name( true ),
					'default'     => 'mweb_default_from_theme_options'
				),
				array(
					'id'       => 'mweb_sidebar_position',
					'title'     => esc_attr__( 'موقعیت سایدبار', 'mweb' ),
					'type'     => 'image_select',
					'options'  => mweb_theme_config::metabox_sidebar_position(),
					'default'      => 'default'
				),
			)
		);
	}
}