<?php

 /**
 * Custom Post Type Registration 
 */
 
if ( ! class_exists( 'mweb_post_type' ) ) {
	class mweb_post_type{
		
		function __construct(){
			
			add_action( 'init', array( $this, 'mweb_post_type_brand' ) );
			add_action( 'init', array( $this, 'mweb_post_type_testimonial' ) );
			add_action( 'init', array( $this, 'mweb_post_type_slider' ) );
			add_action( 'init', array( $this, 'mweb_slider_taxonomy' ) );
			add_action( 'init', array( $this, 'mweb_post_type_notify' ) );
			add_action( 'init', array( $this, 'mweb_notify_taxonomy' ) );
			add_action( 'init', array( $this, 'mweb_post_type_megamenu' ) );
			add_action( 'init', array( $this, 'mweb_post_type_product_guide' ) );
			add_action( 'init', array( $this, 'mweb_post_type_story' ) );
			
			add_action( 'admin_menu', array( $this, 'add_menu_admin' ) );

		}
		
		static function add_menu_admin(){
			add_submenu_page( 'themes.php', esc_html__( 'مگامنو', 'mweb' ), esc_html__( 'مگامنو', 'mweb' ), 'manage_options', 'edit.php?post_type=mweb_megamenu');
			add_submenu_page( 'themes.php', esc_html__( 'راهنمای محصول', 'mweb' ), esc_html__( 'راهنمای محصول', 'mweb' ), 'manage_options', 'edit.php?post_type=product_guide');
			add_submenu_page( 'themes.php', esc_html__( 'استوری', 'mweb' ), esc_html__( 'استوری', 'mweb' ), 'manage_options', 'edit.php?post_type=mweb_story');
		}


		
		static function mweb_post_type_brand(){
			$labels = array(
				'name' => __( 'برند', 'mweb' ),
				'singular_name' => __( 'برند', 'mweb' ),
				'add_new' => __( 'افزودن برند جدید', 'mweb' ),
				'add_new_item' => __( 'افزودن برند جدید', 'mweb' ),
				'edit_item' => __( 'ویرایش برند', 'mweb' ),
				'new_item' => __( 'برند جدید', 'mweb' ),
				'view_item' => __( 'نمایش برند', 'mweb' ),
				'search_items' => __( 'جستجوی برند', 'mweb' ),
				'not_found' => __( 'برندی یافت نشد', 'mweb' ),
				'not_found_in_trash' => __( 'برندی در سطل زباله یافت نشد', 'mweb' ),
				'parent_item_colon' => __( 'برند مادر:', 'mweb' ),
				'menu_name' => __( 'برند ها', 'mweb' ),
			);

			$args = array(
				'labels' => $labels,
				'hierarchical' => true,
				'description' => 'لیست برند ها',
				'supports' => array( 'title', 'thumbnail' ),
				'public' => false,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_nav_menus' => true,
				'publicly_queryable' => true,
				'menu_icon' => 'dashicons-awards',
				'exclude_from_search' => false,
				'has_archive' => true,
				'query_var' => true,
				'can_export' => true,
				'rewrite' => true,
				'capability_type' => 'post'
			);
			register_post_type( 'brand', $args );
		}
		
		
		
		
		static function mweb_post_type_testimonial(){
			$labels = array(
				'name' => __( 'نظرات کاربران', 'mweb' ),
				'singular_name' => __( 'نظرات', 'mweb' ),
				'add_new' => __( 'افزودن نظر جدید', 'mweb' ),
				'add_new_item' => __( 'افزودن نظر جدید', 'mweb' ),
				'edit_item' => __( 'ویرایش نظر', 'mweb' ),
				'new_item' => __( 'نظر جدید', 'mweb' ),
				'view_item' => __( 'نمایش نظر', 'mweb' ),
				'search_items' => __( 'جستجو نظر', 'mweb' ),
				'not_found' => __( 'نظری پیدا نشد', 'mweb' ),
				'not_found_in_trash' => __( 'نظری در سطل زباله پیدا نشد', 'mweb' ),
				'parent_item_colon' => __( 'نظر مادر:', 'mweb' ),
				'menu_name' => __( 'نظرات کاربران', 'mweb' ),
			);

			$args = array(
				'labels' => $labels,
				'hierarchical' => true,
				'description' => 'لیست نظرات',
				'supports' => array( 'title', 'editor', 'thumbnail'),
				'public' => false,
				'show_ui' => true,
				'show_in_menu' => true,
				'menu_icon' => 'dashicons-format-quote',
				'show_in_nav_menus' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,
				'has_archive' => true,
				'query_var' => true,
				'can_export' => true,
				'rewrite' => true,
				'capability_type' => 'post'
			);
			register_post_type( 'testimonial', $args );
		}  	
		
		
		static function mweb_post_type_slider() {
	 
			$labels = array(
				'name' => _x('اسلایدر', 'mweb'),
				'singular_name' => _x('اسلایدر', 'mweb'),
				'add_new' => _x('اضافه کردن', 'mweb'),
				'add_new_item' => __('افزود اسلاید جدید'),
				'edit_item' => __('ویرایش اسلاید'),
				'new_item' => __('اسلاید جدید'),
				'view_item' => __('مشاهده اسلاید'),
				'search_items' => __('جستجوی اسلاید'),
				'not_found' =>  __('اسلایدی یافت نشد'),
				'not_found_in_trash' => __('اسلایدی در سطل زباله یافت نشد'),
				'parent_item_colon' => '',
			);
			 
			$args = array(
				'label' => __('اسلاید'),
				'labels' => $labels,
				'public' => true,
				'can_export' => true,
				'show_ui' => true,
				'_builtin' => false,
				'capability_type' => 'post',
				'menu_icon' => 'dashicons-image-flip-horizontal',
				'hierarchical' => false,
				//'rewrite' => array( "slug" => "slider" ),
				'supports'=> array('title', 'thumbnail') ,
				'show_in_nav_menus' => true,
				// This is where we add taxonomies to our CPT
				//'taxonomies'          => array( 'slider_category' ),
			);
			 
			register_post_type( 'slider', $args);
		 
		}
		
		
		
		static function mweb_slider_taxonomy() {

			$labels = array(
				'name'                       => _x( 'دسته بندی', 'Taxonomy General Name'),
				'singular_name'              => _x( 'دسته', 'Taxonomy Singular Name'),
				'menu_name'                  => __( 'دسته ها'),
				'all_items'                  => __( 'همه دسته ها'),
				'parent_item'                => __( 'مادر'),
				'parent_item_colon'          => __( 'دسته مادر:'),
				'new_item_name'              => __( 'دسته جدید'),
				'add_new_item'               => __( 'افزودن دسته جدید'),
				'edit_item'                  => __( 'ویرایش دسته'),
				'update_item'                => __( 'آپدیت دسته'),
				'view_item'                  => __( 'مشاهده دسته'),
				//'separate_items_with_commas' => __( 'Separate items with commas'),
				//'add_or_remove_items'        => __( 'Add or remove items'),
				//'choose_from_most_used'      => __( 'Choose from the most used'),
				//'popular_items'              => __( 'Popular Items'),
				'search_items'               => __( 'جستجو دسته'),
				'not_found'                  => __( 'پیدا نشد'),
				'no_terms'                   => __( 'دسته بندی ای وجود ندارد'),
				'items_list'                 => __( 'لیست دسته ها'),
				//'items_list_navigation'      => __( 'Items list navigation'),
			);
			$args = array(
				'hierarchical' => true,
				'labels' => $labels,
				'show_ui' => true,
				'query_var' => true,
				'show_admin_column' => true,
				'rewrite'               => array( 'slug' => 'slider-category' ),

			);
			register_taxonomy( 'slider_category', array( 'slider' ), $args );

		}
		


		static function mweb_post_type_notify() {
	 
			$labels = array(
				'name' => _x('اطلاعیه', 'mweb'),
				'singular_name' => _x('اطلاعیه', 'mweb'),
				'add_new' => _x('اضافه کردن', 'mweb'),
				'add_new_item' => __('افزود اطلاعیه جدید'),
				'edit_item' => __('ویرایش اطلاعیه'),
				'new_item' => __('اسلاید اطلاعیه'),
				'view_item' => __('مشاهده اطلاعیه'),
				'search_items' => __('جستجوی اطلاعیه'),
				'not_found' =>  __('اطلاعیه ای یافت نشد'),
				'not_found_in_trash' => __('اطلاعیه ای در سطل زباله یافت نشد'),
				'parent_item_colon' => '',
			);
			 
			$args = array(
				'label' => __('اطلاعیه'),
				'labels' => $labels,
				'public' => false,
				//'can_export' => true,
				'show_ui' => true,
				'_builtin' => false,
				'capability_type' => 'post',
				'menu_icon' => 'dashicons-media-default',
				'hierarchical' => false,
				//'rewrite' => array( "slug" => "slider" ),
				'supports'=> array('title', 'editor') ,
				'show_in_nav_menus' => true,
				// This is where we add taxonomies to our CPT
				//'taxonomies'          => array( 'slider_category' ),
			);
			 
			register_post_type( 'notify', $args);
		 
		}
		
		
		
		static function mweb_notify_taxonomy() {

			$labels = array(
				'name'                       => _x( 'دسته بندی', 'Taxonomy General Name'),
				'singular_name'              => _x( 'دسته', 'Taxonomy Singular Name'),
				'menu_name'                  => __( 'دسته ها'),
				'all_items'                  => __( 'همه دسته ها'),
				'parent_item'                => __( 'مادر'),
				'parent_item_colon'          => __( 'دسته مادر:'),
				'new_item_name'              => __( 'دسته جدید'),
				'add_new_item'               => __( 'افزودن دسته جدید'),
				'edit_item'                  => __( 'ویرایش دسته'),
				'update_item'                => __( 'آپدیت دسته'),
				'view_item'                  => __( 'مشاهده دسته'),
				//'separate_items_with_commas' => __( 'Separate items with commas'),
				//'add_or_remove_items'        => __( 'Add or remove items'),
				//'choose_from_most_used'      => __( 'Choose from the most used'),
				//'popular_items'              => __( 'Popular Items'),
				'search_items'               => __( 'جستجو دسته'),
				'not_found'                  => __( 'پیدا نشد'),
				'no_terms'                   => __( 'دسته بندی ای وجود ندارد'),
				'items_list'                 => __( 'لیست دسته ها'),
				//'items_list_navigation'      => __( 'Items list navigation'),
			);
			$args = array(
				'hierarchical' => true,
				'labels' => $labels,
				'public' => false,
				'show_ui' => true,
				'query_var' => true,
				'show_admin_column' => true,
				'default_term' => 'همه',
				'rewrite' => array( 'slug' => 'notify-category' ),

			);
			register_taxonomy( 'notify_category', array( 'notify' ), $args );

		}
		


		static function mweb_post_type_megamenu() {

			$args = array(
				'labels' => array(
					'name' => __( 'مگامنو','mweb' ),
					'singular_name' => __( 'مگامنو','mweb' )
				),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'megamenus'),
				'menu_position' => 8,
				'show_in_menu' => false,
			);
			 
			register_post_type( 'mweb_megamenu', $args);
		 
		}
		
		static function mweb_post_type_product_guide() {

			$args = array(
				'labels' => array(
					'name' => __( 'راهنمای محصول','mweb' ),
					'singular_name' => __( 'راهنمای محصول','mweb' )
				),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'product_guide'),
				'menu_position' => 8,
				'show_in_menu' => false,
			);
			 
			register_post_type( 'product_guide', $args);
		 
		}
		
		static function mweb_post_type_story() {

			$args = array(
				'labels' => array(
					'name' => __( 'استوری','mweb' ),
					'singular_name' => __( 'استوری','mweb' )
				),
				'public' => true,
				'has_archive' => false,
				'rewrite' => array('slug' => 'story'),
				'menu_position' => 8,
				'show_in_menu' => false,
				'capability_type' => 'post',
				'supports'=> array('title', 'thumbnail')
			);
			 
			register_post_type( 'mweb_story', $args);
		 
		}
		

	}
	 new mweb_post_type();

}
	 
	 