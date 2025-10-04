<?php
//registering admin css and script
if ( ! function_exists( 'mweb__register_backend_script' ) ) {
	function mweb_register_backend_script( $hook ) {
		
		if( $hook != 'toplevel_page_revslider' )	{
			wp_enqueue_script( 'mweb-admin-script', THEME_THEMEROOT . '/includes/admin/js/admin-script.js', array( 'jquery' ), THEME_VERSION, true );
		}
		
		wp_localize_script('mweb-admin-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

		wp_register_style( 'mweb-admin-style', THEME_THEMEROOT . '/includes/admin/css/admin-style.css', array(), THEME_VERSION, 'all' );
		wp_enqueue_style( 'mweb-admin-style' );
		
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );

		wp_enqueue_media();
		
		$screen = get_current_screen();


		//only load in post
		/* if ( $hook == 'term.php' || $hook == 'edit-tags.php' || $hook == 'nav-menus.php' || $hook == 'post.php' || $hook == 'post-new.php' || $hook == 'edit-comments.php' || $hook == 'comment.php' || $hook == 'toplevel_page_mweb-digiland-pro' ) {
			//wp_enqueue_script( 'mweb-admin-script' );
		} */
		
		//print_r($hook);
		
		if ( $hook == 'term.php' || $hook == 'edit-tags.php' || $hook == 'edit.php' || $hook == 'toplevel_page_mweb-tickets'  || $screen->id == "appearance_page_custom-display-features"  ){
			wp_enqueue_script( THEME_NAME.'-brands', THEME_THEMEROOT . '/includes/admin/js/brands.js', array('jquery'), THEME_VERSION, true );
			wp_enqueue_script( THEME_NAME.'-select2', THEME_THEMEROOT . '/includes/admin/js/select2.min.js', array('jquery'), THEME_VERSION, true );
			wp_enqueue_style( THEME_NAME.'-select2', THEME_THEMEROOT . '/includes/admin/css/select2.min.css', array(), THEME_VERSION, 'all');
		}
		
		if ( $hook == 'product_page_product-reviews' ){
			wp_enqueue_script( THEME_NAME.'-pquestion', THEME_THEMEROOT . '/includes/admin/js/product-question-answer.js', array(), THEME_VERSION, 'all');
		}
		

		
		//print_r($screen);
		
        if ( $screen->post_type == 'attribute_group') {
			icon_picker_scripts();
			wp_enqueue_script( 'mweb-admin-script' );
			wp_enqueue_script( THEME_NAME.'-select2', THEME_THEMEROOT . '/includes/admin/js/select2-attr.min.js', array('jquery'), THEME_VERSION, true );
			wp_enqueue_script( THEME_NAME.'-select2-sortable', THEME_THEMEROOT . '/includes/admin/js/select2.sortable.min.js', array('jquery'), THEME_VERSION, true );
			wp_enqueue_script( THEME_NAME.'-html5-sortable', THEME_THEMEROOT . '/includes/admin/js/html.sortable.min.js', array('jquery'), THEME_VERSION, true );
			wp_enqueue_style( THEME_NAME.'-select2', THEME_THEMEROOT . '/includes/admin/css/select2.css', array(), THEME_VERSION, 'all');
			wp_enqueue_style( THEME_NAME.'-select2-sortable', THEME_THEMEROOT . '/includes/admin/css/select2.sortable.css', array(), THEME_VERSION, 'all');
        }
       
		
		
		wp_enqueue_style('vntd-admin', THEME_THEMEROOT . '/assets/css/admin/vntd-admin.css');	
		wp_enqueue_style('font-awesome', THEME_THEMEROOT . '/assets/css/admin/font-awesome.min.css');
		
		
		if ( 'toplevel_page_mweb-settings' == $hook ) {
		
			wp_register_style( 'module-css', THEME_THEMEROOT . '/includes/admin/css/module-panel.css' );
			wp_register_script( 'module-script', THEME_THEMEROOT . '/includes/admin/js/module-scripts.js', array(), false, false );
			
			wp_enqueue_script( 'jquery-ui-sortable' );

			wp_enqueue_style( 'module-css' );
			wp_enqueue_script( 'module-script' );
			

		}
		
		
	}

	//check & do action
	add_action( 'admin_enqueue_scripts', 'mweb_register_backend_script' );
	
}



/*-----------------------------------------------------------------------------------*/
/* icon picker
/*-----------------------------------------------------------------------------------*/

function icon_picker_scripts() {
    $css = THEME_THEMEROOT . '/includes/admin/css/icon-picker.css';
    wp_enqueue_style( 'icon-picker', $css, array(), '1.0' );
    
	//$font = THEME_THEMEROOT . '/assets/css/admin/font-awesome.min.css';
   //wp_enqueue_style( 'font-awesome', $font,'','1.0');
	$icon_packs = array(
		'theme' => mweb_print_sprites_path(),
		'fontawesome' => THEME_THEMEROOT.'/assets/images/fontawesome.svg',
	);
    $js = THEME_THEMEROOT . '/includes/admin/js/icon-picker.js';
    wp_enqueue_script( 'icon-picker', $js, array( 'jquery' ), '1.0' );
	wp_add_inline_script( 'icon-picker', 'const IconPack = ' . json_encode( apply_filters( 'mweb_icon_pack_list', $icon_packs )), 'before' );

}
global $pagenow;
if (($pagenow == 'widgets.php' || $pagenow == 'nav-menus.php' || $pagenow == 'themes.php') && is_admin()  ) {
	add_action( 'admin_enqueue_scripts', 'icon_picker_scripts' );
	add_action( 'load-widgets.php', 'color_picker_load' );
}


function color_picker_load() {    
	wp_enqueue_style( 'wp-color-picker' );        
	wp_enqueue_script( 'wp-color-picker' );    
}
