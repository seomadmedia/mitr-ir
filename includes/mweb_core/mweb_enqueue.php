<?php
//frontend script
if ( ! function_exists( 'mweb_theme_register_frontend_script' ) ) {
	function mweb_theme_register_frontend_script() {
		
		$custom_file = mweb_theme_util::get_theme_option('mweb_custom_file_cssjs');
		$mweb_preloader = mweb_theme_util::get_theme_option('mweb_preloader');
		$mweb_ticket = mweb_theme_util::get_theme_option('ticket_enable');

		wp_enqueue_script("jquery");
		
		
		//load preloader script
		if( $mweb_preloader ){
			wp_enqueue_script( 'preloader-js', THEME_ASSET . '/js/pace.min.js', array('jquery'), THEME_VERSION, true );
		}

		if( is_account_page() && $mweb_ticket ){
			wp_enqueue_style('select2', THEME_ASSET . '/css/select2.min.css' );
			wp_enqueue_script('select2', THEME_ASSET . '/js/select2.min.js', array('jquery'), THEME_VERSION, true );
		}
		
	    //	if( is_user_logged_in())
		//if(is_product() && comments_open() ){
			//wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.11.1/jquery-ui.js', false, '1.11.1');
		//}
		
		
		//load comment script
		
		
		if ( is_singular() ) {
			if ( comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
			if( is_singular('product') ){
				//$has_highchart = apply_filters( 'page_highchart_support_filter', false );
				wp_enqueue_script( 'jquery-ui-sortable' );
				wp_enqueue_script( 'jquery-ui-slider' );
				
				wp_enqueue_script('jquery-ui-core');
								
								
				wp_register_script('slider-pips', THEME_ASSET . '/js/jquery-ui-slider-pips.min.js', array('jquery-ui-core','jquery-ui-sortable'), THEME_VERSION, true);
				wp_enqueue_script( 'slider-pips' );


				$show_price_chart = get_post_meta(get_the_ID(), '_show_price_chart' , true);
				if( $show_price_chart == 'yes' ){
					wp_register_script('highcharts', THEME_ASSET . '/js/highcharts.js', array('jquery'), THEME_VERSION, true);
					wp_enqueue_script( 'highcharts' );
				}
			}
		}
		
		// Register scripts	
		wp_register_script('plugins-js', THEME_ASSET . '/js/plugins-theme.js', array('jquery'), THEME_VERSION, true);
wp_register_script('my-script', THEME_ASSET . '/js/my-script.js', array('jquery','plugins-js'), file_exists(get_template_directory() . '/js/my-script.js') ? filemtime(get_template_directory() . '/js/my-script.js') : false, true) && wp_script_add_data('my-script', 'defer', true);
		
		
		
		// Load the custom scripts
		//wp_enqueue_script('plugins-js');
		//wp_enqueue_script("jquery-effects-core");
		
		wp_enqueue_script('my-script');

		
if ( $custom_file ) {
    wp_enqueue_script(
        'custom-js',
        get_template_directory_uri() . '/custom/custom.js',
        array('jquery'),
        filemtime( get_template_directory() . '/custom/custom.js' ), // تاریخ آخرین تغییر
        true
    );
}


		// Load the stylesheets
		wp_register_style( 'plugins-theme', THEME_ASSET . '/css/plugins-theme.css', array(), THEME_VERSION);
		wp_register_style( 'woocommerce', THEME_ASSET . '/css/woocommerce.css', array(), THEME_VERSION);


	/*	wp_enqueue_style( 'plugins-theme');
		wp_enqueue_style( 'woocommerce'); */

		wp_enqueue_style( 'mweb-style', get_stylesheet_uri() , array('plugins-theme' ,'woocommerce'), THEME_VERSION );
		
		if( is_singular('product') && comments_open() ){
			wp_enqueue_style( 'jquery-uicss', THEME_ASSET . '/css/jquery-ui.css', false, '1.12.1' );
		}	
		
if($custom_file) wp_enqueue_style('custom-style',get_template_directory_uri().'/custom/custom.css',array('plugins-theme','mweb-style'),filemtime(get_template_directory().'/custom/custom.css'),'all');
	
		
		wp_dequeue_style('woo-wallet-style');
		
		
		if (is_shop() || is_product_category() || is_product_tag()) {
			
			$mweb_infinite_load = mweb_theme_util::get_theme_option('mweb_infinite_scroll');

			wp_localize_script('my-script', 'infiniteScroll', [
				'enable' => boolval($mweb_infinite_load), 
				'max_page' => 5, 
				'current_page' => max(1, get_query_var('paged')),
			]);
		}

	}

	if ( ! is_admin() ) {
		add_action( 'wp_enqueue_scripts', 'mweb_theme_register_frontend_script' );
	}	
}


if ( ! function_exists( 'mweb_override_dokan_scripts' ) ) {
	function mweb_override_dokan_scripts() {

		wp_dequeue_style( 'fontawesome' );
		//wp_dequeue_style( 'dokan-tooltip' );
		/*if(is_product() && is_user_logged_in() ){
			wp_dequeue_script('jquery-ui-sortable');
		}*/
		wp_dequeue_script('dokan-tooltip');
	}
	
	add_action('dokan_enqueue_scripts', 'mweb_override_dokan_scripts');
}

if ( ! function_exists( 'mweb_override_dokan_lite_scripts' ) ) {
	function mweb_override_dokan_lite_scripts() {
		wp_dequeue_script('dokan-tooltip');
	}
	
	add_action('dokan_register_scripts', 'mweb_override_dokan_lite_scripts');
}







