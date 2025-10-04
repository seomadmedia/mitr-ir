<?php
//header

if( !is_user_logged_in() && is_account_page() ){
	remove_all_actions( 'mweb_theme_header' );

}else{
	
	$is_mobile = wp_is_mobile();
	$mobile_head = mweb_theme_util::get_theme_option( 'mobile_head_activity' );
	if( $is_mobile ){
		if( $mobile_head ){
			remove_all_actions( 'mweb_theme_header' );
			get_template_part( 'templates/header/head', 'mobile' );
		} else if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'head_mobile' ) ) {
			remove_all_actions( 'mweb_theme_header' );
			elementor_theme_do_location( 'head_mobile' );
		}
	}

	$mweb_offer_txt = mweb_theme_util::get_theme_option( 'mweb_offer_txt' );
	if( !empty( $mweb_offer_txt ) ){
		$mweb_offer_link = mweb_theme_util::get_theme_option( 'mweb_offer_link' );
		$gr_bg = mweb_theme_util::get_theme_option('mweb_offer_gr_bg'); 
			$bg_class = $gr_bg == true ? ' bg_gradient_animation' : '';
		if( empty($mweb_offer_link) ){
			echo '<div class="header_offer'.$bg_class.'"><div class="container"><p>'.do_shortcode($mweb_offer_txt).'</p></div></div>';
		}else{
			echo '<div class="header_offer'.$bg_class.'"><div class="container"><a href="'.$mweb_offer_link.'"><p>'.do_shortcode($mweb_offer_txt).'</p></a></div></div>';
		}
	}else{
		$mweb_offer_img = mweb_theme_util::get_theme_option( 'mweb_offer_img' ,'url' );
		$mweb_offer_img_mob = mweb_theme_util::get_theme_option( 'mweb_offer_img_mob' ,'url' );
		if( !empty($mweb_offer_img) || !empty($mweb_offer_img_mob) ){
			$mweb_offer_link = mweb_theme_util::get_theme_option( 'mweb_offer_link' );
			if( $is_mobile && !empty($mweb_offer_img_mob) )
				$mweb_offer_img = $mweb_offer_img_mob;
			echo '<div class="header_offer"><a href="'.$mweb_offer_link.'"><img src="'.$mweb_offer_img.'" /></a></div>';
		}
	}
	
	get_template_part( 'templates/header/module', 'cart_sidebar' ); 
	if( !is_user_logged_in() )
		get_template_part( 'templates/header/module', 'account' );
	
}
