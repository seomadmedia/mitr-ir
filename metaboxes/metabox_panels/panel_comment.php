<?php

//meta box comments config
if ( ! function_exists( 'mweb_metabox_comment_box' ) ) {
	function mweb_metabox_comment_box() {
		return array(
			'fields'     => array(
				array(
					'id'      => 'mweb_single_comment_box',
					'type'    => 'select',
					'title'    => esc_attr__( 'نمایش دیدگاه', 'mweb' ),
					'options' => array(
						'default' => esc_attr__( 'پیشفرض تنظیمات پوسته', 'mweb' ),
						'show'    => esc_attr__( 'نمایش', 'mweb' ),
						'none'    => esc_attr__( 'عدم نمایش', 'mweb' )
					),
					'default'     => 'default'
				)
			)
		);
	}
}