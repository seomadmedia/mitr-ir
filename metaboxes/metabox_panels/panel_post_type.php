<?php

//meta box post slider config
if ( ! function_exists( 'mweb_metabox_slider' ) ) {
	function mweb_metabox_slider() {
		return array(
			
			'fields'     => array(
				array(
					'id' 		=> 'mweb_slider_link',
					'type'		=> 'text',
					'title'		=> esc_html__( 'لینک', 'mweb' ),
				),
				array(
					'id'       => 'mweb_slider_mobile',
					'type'     => 'media', 
					//'url'      => true,
					'title'    => esc_html__('نسخه موبایل اسلابد (اختیاری)'),
				),
			)
		);
	}
}


//meta box post brand config
if ( ! function_exists( 'mweb_metabox_brand' ) ) {
	function mweb_metabox_brand() {
		return array(
			
			'fields'     => array(
				array(
					'id' 		=> 'mweb_brand_link',
					'type'		=> 'text',
					'title' 	=> esc_html__( 'لینک', 'mweb' ),
				),
			)
		);
	}
}


//meta box post testimonial config
if ( ! function_exists( 'mweb_metabox_testimonial' ) ) {
	function mweb_metabox_testimonial() {
		return array(
			
			'fields'     => array(
				array(
					'id' 		=> 'mweb_testimonial_sub',
					'type' 		=> 'text',
					'title' 	=> esc_html__( 'سمت', 'mweb' ),
					'description' => 'اسم شرکت و ...',

				),
			)
		);
	}
}


//meta box post story config
if ( ! function_exists( 'mweb_metabox_story' ) ) {
	function mweb_metabox_story() {
		return array(
			
			'fields'     => array(
				array(
					'id'       => 'mweb_story_items',
					'type'       => 'repeater',
					'title'    => esc_html__( 'آیتم های استوری', 'mweb' ),
					'subtitle' => esc_html__( '', 'mweb' ),
					'fields'     => array(

						array(
							'id'       => 'story_type',
							'type'     => 'select',
							'title'    => esc_html__( 'نوع استوری', 'mweb' ),
							'subtitle' => esc_html__( '', 'mweb' ),
							'options'  => array(
								  'photo' => 'تصویر',
								  'video' => 'ویدیو',
							),
							'default' => 'photo'
						),
						array(
							'id'       => 'story_media',
							'type'     => 'media', 
							'url'      => true,
							'title'    => esc_html__('مدیا'),
							'library_filter' => array('mp4', 'png', 'jpg')
						),
						array(
							'id'       => 'story_preview',
							'type'     => 'media', 
							'url'      => true,
							'title'    => esc_html__('پیش نمایش (اگر مدیا ویدیو بود باید یک تصویر پیشنمایش اضافه کنید)'),
						),
						array(
							'id'       => 'story_link',
							'type'     => 'text',
							'placeholder' => __( 'لینک استوری', 'mweb' ),
						),
						array(
							'id'       => 'story_link_title',
							'type'     => 'text',
							'placeholder' => __( 'عنوان دکمه لینک', 'mweb' ),
						),
						array(
							'id'       => 'story_length',
							'type'     => 'text',
							'placeholder' => __( 'مدت زمان به ثانیه', 'mweb' ),
							'validate' => 'numeric',
							'default'  => 3
						)
			
					)
				)
			)
		);
	}
}


//meta box post notify config
if ( ! function_exists( 'mweb_metabox_notify' ) ) {
	function mweb_metabox_notify() {
		return array(
			
			'fields'     => array(
				array(
					'id' => 'notify_group',
					'type' => 'select',
					'title' => esc_html__( 'دریافت کنندگان', 'mweb' ),
					'options'  => array(
						'_notify_all' => 'همه',
						'_notify_product' => 'محصول',
						'_notify_user' => 'کاربر'
					),
					'default'  => '_notify_all'
				),
				array(
					'id' => 'notify_product',
					'type' => 'select',
					'title' => esc_html__( 'محصول', 'mweb' ),
					'ajax' => true,
					'data' => 'posts',
					'args' => array(
						'post_type' => 'product',
						'posts_per_page' => -1,
					),
					'required' => array( 'notify_group', '=', '_notify_product' )
				),
				array(
					'id' => 'notify_user',
					'type' => 'select',
					'title' => esc_html__( 'مخاطب', 'mweb' ),
					'ajax' => true,
					'data' => 'users',
					'required' => array( 'notify_group', '=', '_notify_user' )
				),
			)
		);
	}
}