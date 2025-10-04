<?php
/**
 * this file config meta boxes for theme
 */

$mweb_template_directory = get_template_directory();

//including config file
require_once $mweb_template_directory . '/metaboxes/metabox_panels/panel_video.php';
require_once $mweb_template_directory . '/metaboxes/metabox_panels/panel_sidebar.php';
require_once $mweb_template_directory . '/metaboxes/metabox_panels/panel_comment.php';
require_once $mweb_template_directory . '/metaboxes/metabox_panels/panel_post_type.php';
require_once $mweb_template_directory . '/metaboxes/metabox_panels/panel_product.php';

if ( ! function_exists( 'mweb_theme_meta_boxes_config' ) ) {

	 // Change {$redux_opt_name} to your opt_name
    add_action("redux/metaboxes/shop_options/boxes", "mweb_theme_meta_boxes_config");

	/**-------------------------------------------------------------------------------------------------------------------------
	 * @return array
	 * meta box config
	 */
	function mweb_theme_meta_boxes_config($metaboxes) {


		$metaboxes = array();		
		
		$metaboxes[] = array(
            'id'            => 'mweb_metabox_comment_box_options',
            'title'         => __( 'تنظیمات دیدگاه', '' ),
            'post_types'    => array( 'post', 'page' ),
            //'page_template' => array('page-test.php'), // Visibility of box based on page template selector
            'position'      => 'side', // normal, advanced, side
            'priority'      => 'high', // high, core, default, low - Priorities of placement
            'sections'      => array(mweb_metabox_comment_box()) ,
        );
		
		$metaboxes[] = array(
            'id'            => 'mweb_metabox_sidebar_options',
            'title'         => __( 'تنظیمات سایدبار', '' ),
            'post_types'    => array( 'post', 'page' ),
            //'page_template' => array('page-test.php'), // Visibility of box based on page template selector
            'position'      => 'side', 
            'priority'      => 'high', 
            'sections'      => array(mweb_metabox_sidebar()) ,
        );
		
		$metaboxes[] = array(
            'id'            => 'mweb_metabox_video_options',
            'title'         => __( 'تنظیمات رسانه', '' ),
            'post_types'    => array( 'product'),
            //'page_template' => array('page-test.php'), // Visibility of box based on page template selector
            'position'      => 'normal', 
            'priority'      => 'default', 
            'sections'      => array(mweb_metabox_post_video()) ,
        );
		
		$metaboxes[] = array(
            'id'            => 'mweb_metabox_slider_options',
            'title'         => __( 'اسلایدر', '' ),
            'post_types'    => array( 'slider'),
            //'page_template' => array('page-test.php'), // Visibility of box based on page template selector
            'position'      => 'normal', 
            'priority'      => 'high', 
            'sections'      => array(mweb_metabox_slider()) ,
        );
		
		$metaboxes[] = array(
            'id'            => 'mweb_metabox_brand_options',
            'title'         => __( 'برند', '' ),
            'post_types'    => array( 'brand'),
            //'page_template' => array('page-test.php'), // Visibility of box based on page template selector
            'position'      => 'normal', 
            'priority'      => 'high', 
            'sections'      => array(mweb_metabox_brand()) ,
        );
		
		$metaboxes[] = array(
            'id'            => 'mweb_metabox_testimonial_options',
            'title'         => __( 'نظرات کاربران', '' ),
            'post_types'    => array( 'testimonial'),
            //'page_template' => array('page-test.php'), // Visibility of box based on page template selector
            'position'      => 'normal', 
            'priority'      => 'high', 
            'sections'      => array(mweb_metabox_testimonial()) ,
        );
		
		$metaboxes[] = array(
            'id'            => 'mweb_metabox_product_options',
            'title'         => __( 'نقد و بررسی', '' ),
            'post_types'    => array( 'product'),
            //'page_template' => array('page-test.php'), // Visibility of box based on page template selector
            'position'      => 'normal', 
            'priority'      => 'default', 
            'sections'      => array(mweb_metabox_product()) ,
        );
		
		$metaboxes[] = array(
            'id'            => 'mweb_metabox_story_options',
            'title'         => __( 'گزینه های استوری', '' ),
            'post_types'    => array( 'mweb_story'),
            //'page_template' => array('page-test.php'), // Visibility of box based on page template selector
            'position'      => 'normal', 
            'priority'      => 'default', 
            'sections'      => array(mweb_metabox_story()) ,
        );
		
		$metaboxes[] = array(
            'id'            => 'mweb_metabox_notify_options',
            'title'         => __( 'تنظیمات', '' ),
            'post_types'    => array( 'notify'),
            'position'      => 'side', 
            'priority'      => 'high', 
            'sections'      => array(mweb_metabox_notify()) ,
        );
		
		
		

		

		return $metaboxes;
	}
};


