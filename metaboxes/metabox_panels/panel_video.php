<?php

//meta box post video config
if ( ! function_exists( 'mweb_metabox_post_video' ) ) {
	function mweb_metabox_post_video() {
		return array(
			
			'fields'     => array(
				
				array(
					'id' => 'mweb_single_video_directlink',
					'type' => 'text',
					'title' => esc_html__( 'لینک مستقیم ویدیو', 'mweb' ),
					'desc'  => ''
				),
				array(
					'id' => 'mweb_single_video_embed',
					'type' => 'text',
					'title' => esc_html__( 'آی‌دی یا شناسه ویدئو', 'mweb' ),
					'desc'  => 'به‌عنوان مثال شناسه ویدئوی http://www.aparat.com/v/iybdS عبارت است از : iybdS'
				),
				array(
					'id'   => 'mweb_gallery_360',
					'title' => esc_attr__( 'عکس 360 درجه', 'mweb' ),
					'desc' => esc_attr__( 'لیست عکس ها را به ترتیب انتخاب نمائید', 'mweb' ),
					'type' => 'gallery',
				),
				
			)
		);
	}
}