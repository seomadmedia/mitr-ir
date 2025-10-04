<?php

//meta box product config
if ( ! function_exists( 'mweb_metabox_product' ) ) {
	function mweb_metabox_product() {
		return array(
			
			'fields'     => array(
			
				array(
					'id' => 'mweb_product_review_good',
					'type' => 'editor',
					'title' => esc_html__( 'مزایا', 'mweb' ),
					'args'   => array(
						'teeny'            => true,
						'media_buttons' => false,
						'textarea_rows'    => 10
					)
				),
				array(
					'id' => 'mweb_product_review_bad',
					'type' => 'editor',
					'title' => esc_html__( 'معایب', 'mweb' ),
					'media_buttons' => false,
					'args'   => array(
						'teeny'            => true,
						'media_buttons' => false,
						'textarea_rows'    => 10
					)
				),
				array(
					'id'          => 'review_q1',
					'title'       => __('گزینه اول','mweb'),
					'type'        => 'text',
				),
				array(
					'id'          => 'review_p1',
					'title'       => __('مقدار گزینه اول','mweb'),
					'type'        => 'slider',
					"min" => 0,
					"step" => .1,
					"max" => 10,
					'resolution' => 0.1
				),
				array(
					'id'          => 'review_q2',
					'title'       => __('گزینه دوم','mweb'),
					'type'        => 'text',
				),
				array(
					'id'          => 'review_p2',
					'title'       => __('مقدار گزینه دوم','mweb'),
					'type'        => 'slider',
					"min" => 0,
					"step" => .1,
					"max" => 10,
					'resolution' => 0.1,
				),
				array(
					'id'          => 'review_q3',
					'title'       => __('گزینه سوم','mweb'),
					'type'        => 'text',
				),
				array(
					'id'          => 'review_p3',
					'title'       => __('مقدار گزینه سوم','mweb'),
					'type'        => 'slider',
					"min" => 0,
					"step" => .1,
					"max" => 10,
					'resolution' => 0.1,
				),
				array(
					'id'          => 'review_q4',
					'title'       => __('گزینه چهارم','mweb'),
					'type'        => 'text',
				),
				array(
					'id'          => 'review_p4',
					'title'       => __('مقدار گزینه چهارم','mweb'),
					'type'        => 'slider',
					"min" => 0,
					"step" => .1,
					"max" => 10,
					'resolution' => 0.1,
				),
				array(
					'id'          => 'review_q5',
					'title'       => __('گزینه پنجم','mweb'),
					'type'        => 'text',
				),
				array(
					'id'          => 'review_p5',
					'title'       => __('مقدار گزینه پنجم','mweb'),
					'type'        => 'slider',
					"min" => 0,
					"step" => 0.1,
					"max" => 10,
					'resolution' => 0.1,
				)
				
			)
		);
	}
}