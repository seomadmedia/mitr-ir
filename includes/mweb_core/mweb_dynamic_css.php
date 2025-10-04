<?php
/**
 * this file render dynamic css for theme
 */
 
 

//add css to header
//add_action( 'wp_head', 'mweb_theme_dynamic_css', 99 );
add_action( 'wp_enqueue_scripts', 'mweb_theme_dynamic_css' );

/**
 * @return string
 * this file get options and create css code as string
 */
if ( ! function_exists( 'mweb_theme_dynamic_css' ) ) {
	function mweb_theme_dynamic_css() {

		//get cache
		$mweb_dynamic_css_cache = get_option( 'mweb_theme_dynamic_css_cache', '' );

		if ( empty( $mweb_dynamic_css_cache ) ) {
			$str = '';
			//$str .= '<style type="text/css" media="all">';

			$color_main = mweb_theme_util::get_theme_option( 'color_main' );

			$color_sec = mweb_theme_util::get_theme_option( 'color_sec' );
			
			$color_1 = mweb_theme_util::get_theme_option( 'color1' ); // bg
			$color_2 = mweb_theme_util::get_theme_option( 'color2' ); // header
			
			$color_3 = mweb_theme_util::get_theme_option( 'color3' ); // color footer
			$color_4 = mweb_theme_util::get_theme_option( 'color4' ); // color footer text
			
			$color_5 = mweb_theme_util::get_theme_option( 'color5' ); // add to basket
			
			$color_6 = mweb_theme_util::get_theme_option( 'color6' ); // out of stock
			
			$color_7 = mweb_theme_util::get_theme_option( 'color7' ); // cart header
			
			$color_8 = mweb_theme_util::get_theme_option( 'color8' ); // discount bg color
			
			
			$mweb_site_width = mweb_theme_util::get_theme_option( 'mweb_site_width' ); // site width
			
			$mweb_white_body = mweb_theme_util::get_theme_option( 'mweb_white_body' ); // color body shadow

			
			
			$body_background = mweb_theme_util::get_theme_option( 'mweb-body-pat' ); //  body background
			$header_background = mweb_theme_util::get_theme_option( 'mweb-head-pat' ); //  header background
			$footer_background = mweb_theme_util::get_theme_option( 'mweb-footer-pat' ); //  footer background


			$under_construction_background = mweb_theme_util::get_theme_option( 'under_construction_background' ); //  under construction background
			
			$mweb_offer_pat = mweb_theme_util::get_theme_option( 'mweb_offer_pat' ); //  offer background

			$mweb_product_title_style = mweb_theme_util::get_theme_option( 'mweb_product_title_style' ); //  product title style
			
			$mweb_font_family = mweb_theme_util::get_theme_option( 'mweb_font_family' ); 
			
			$btn_c_bg = mweb_theme_util::get_theme_option('elm_c_bg');
			$btn_c_position = mweb_theme_util::get_theme_option('elm_c_btn_position');
			
			$mweb_just_numfa = mweb_theme_util::get_theme_option('mweb_just_numfa');
			
			$global_radius = mweb_theme_util::get_theme_option('global_radius');
			
			$sepbox_style = mweb_theme_util::get_theme_option('sepbox_style');

			
			$site_url = THEME_ASSET;
			$str_font = '';

			if( $mweb_font_family == 'dana' ){
				$font_array = ['Dana', 'Dananum'];
				if( !$mweb_just_numfa ){
				$str_font .= '@font-face {
					font-family: "Dana";
					font-style: normal;
					font-weight: 500;
					font-display:block;
					src: url("[site_url]/fonts/Dana-medium.woff") format("woff"), 
					url("[site_url]/fonts/Dana-medium.woff2") format("woff2"), 
					url("[site_url]/fonts/Dana-medium.ttf") format("truetype");
				}
				@font-face {
					font-family: "Dana";
					font-style: normal;
					font-weight: normal;
					font-display:block;
					src: url("[site_url]/fonts/Dana-regular.woff") format("woff"), 
					url("[site_url]/fonts/Dana-regular.woff2") format("woff2"), 
					url("[site_url]/fonts/Dana-regular.ttf") format("truetype");
				}';
				}
				$str_font .= '@font-face {
					font-family: "Dananum";
					font-style: normal;
					font-weight: 500;
					font-display:block;
					src: url("[site_url]/fonts/Dana-medium-fanum.woff") format("woff"), 
					url("[site_url]/fonts/Dana-medium-fanum.woff2") format("woff2"), 
					url("[site_url]/fonts/Dana-medium-fanum.ttf") format("truetype");
				}
				@font-face {
					font-family: "Dananum";
					font-style: normal;
					font-weight: normal;
					font-display:block;
					src: url("[site_url]/fonts/Dana-regular-fanum.woff") format("woff"), 
					url("[site_url]/fonts/Dana-regular-fanum.woff2") format("woff2"), 
					url("[site_url]/fonts/Dana-regular-fanum.ttf") format("truetype");
				}';
			} elseif( $mweb_font_family == 'iranyekan' ){
				$font_array = ['IRANYekan', 'IRANYekannum'];
				if( !$mweb_just_numfa ){
				$str_font .= '@font-face {
					font-family: "IRANYekan";
					font-style: normal;
					font-weight: 500;
					font-display:block;
					src: url("[site_url]/fonts/IRYekan-medium.eot");
					src: url("[site_url]/fonts/IRYekan-medium.eot?#iefix") format("embedded-opentype"), 
					url("[site_url]/fonts/IRYekan-medium.woff") format("woff"), 
					url("[site_url]/fonts/IRYekan-medium.ttf") format("truetype");
				}
				@font-face {
					font-family: "IRANYekan";
					font-style: normal;
					font-weight: normal;
					font-display:block;
					src: url("[site_url]/fonts/IRYekan-regular.eot");
					src: url("[site_url]/fonts/IRYekan-regular.eot?#iefix") format("embedded-opentype"), 
					url("[site_url]/fonts/IRYekan-regular.woff") format("woff"), 
					url("[site_url]/fonts/IRYekan-regular.ttf") format("truetype");
				}';
				}
				$str_font .= '@font-face {
					font-family: "IRANYekannum";
					font-style: normal;
					font-weight: 500;
					font-display:block;
					src: url("[site_url]/fonts/IRYekan-medium-fanum.eot");
					src: url("[site_url]/fonts/IRYekan-medium-fanum.eot?#iefix") format("embedded-opentype"), 
					url("[site_url]/fonts/IRYekan-medium-fanum.woff") format("woff"), 
					url("[site_url]/fonts/IRYekan-medium-fanum.ttf") format("truetype");
				}
				@font-face {
					font-family: "IRANYekannum";
					font-style: normal;
					font-weight: normal;
					font-display:block;
					src: url("[site_url]/fonts/IRYekan-regular-fanum.eot");
					src: url("[site_url]/fonts/IRYekan-regular-fanum.eot?#iefix") format("embedded-opentype"), 
					url("[site_url]/fonts/IRYekan-regular-fanum.woff") format("woff"), 
					url("[site_url]/fonts/IRYekan-regular-fanum.ttf") format("truetype");
				}';
			} elseif( $mweb_font_family == 'yekanbakh' ){
				$font_array = ['YekanBakh', 'YekanBakhnum'];
				if( !$mweb_just_numfa ){
				$str_font .= '@font-face {
					font-family: "YekanBakh";
					font-style: normal;
					font-weight: 500;
					font-display:block;
					src: url("[site_url]/fonts/YekanBakh-semibold.woff") format("woff"), 
					url("[site_url]/fonts/YekanBakh-semibold.woff2") format("woff2");
				}
				@font-face {
					font-family: "YekanBakh";
					font-style: normal;
					font-weight: normal;
					font-display:block;
					src: url("[site_url]/fonts/YekanBakh-regular.woff") format("woff"), 
					url("[site_url]/fonts/YekanBakh-regular.woff2") format("woff2");
				}';
				}
				
				$str_font .= '@font-face {
					font-family: "YekanBakhnum";
					font-style: normal;
					font-weight: 500;
					font-display:block;
					src: url("[site_url]/fonts/YekanBakh-semibold-fanum.woff") format("woff"), 
					url("[site_url]/fonts/YekanBakh-semibold-fanum.woff2") format("woff2");
				}
				@font-face {
					font-family: "YekanBakhnum";
					font-style: normal;
					font-weight: normal;
					font-display:block;
					src: url("[site_url]/fonts/YekanBakh-regular-fanum.woff") format("woff"), 
					url("[site_url]/fonts/YekanBakh-regular-fanum.woff2") format("woff2");
				}';
			} else{
				$font_array = ['IRANSans', 'IRANSansnum'];
				if( !$mweb_just_numfa ){
				$str_font .= '@font-face {
					font-family: "IRANSans";
					font-style: normal;
					font-weight: 500;
					font-display:block;
					src: url("[site_url]/fonts/IRANSans-medium.eot");
					src: url("[site_url]/fonts/IRANSans-medium.eot?#iefix") format("embedded-opentype"), 
					url("[site_url]/fonts/IRANSans-medium.woff") format("woff"), 
					url("[site_url]/fonts/IRANSans-medium.ttf") format("truetype");
				}
				@font-face {
					font-family: "IRANSans";
					font-style: normal;
					font-weight: normal;
					font-display:block;
					src: url("[site_url]/fonts/IRANSans.eot");
					src: url("[site_url]/fonts/IRANSans.eot?#iefix") format("embedded-opentype"), 
					url("[site_url]/fonts/IRANSans.woff") format("woff"), 
					url("[site_url]/fonts/IRANSans.ttf") format("truetype");
				}';
				}
				$str_font .= '@font-face {
					font-family: "IRANSansnum";
					font-style: normal;
					font-weight: 500;
					font-display:block;
					src: url("[site_url]/fonts/IRANSans-medium-fanum.eot");
					src: url("[site_url]/fonts/IRANSans-medium-fanum.eot?#iefix") format("embedded-opentype"), 
					url("[site_url]/fonts/IRANSans-medium-fanum.woff") format("woff"), 
					url("[site_url]/fonts/IRANSans-medium-fanum.ttf") format("truetype");
				}
				@font-face {
					font-family: "IRANSansnum";
					font-style: normal;
					font-weight: normal;
					font-display:block;
					src: url("[site_url]/fonts/IRANSans-fanum.eot");
					src: url("[site_url]/fonts/IRANSans-fanum.eot?#iefix") format("embedded-opentype"), 
					url("[site_url]/fonts/IRANSans-fanum.woff") format("woff"), 
					url("[site_url]/fonts/IRANSans-fanum.ttf") format("truetype");
				}';
			}
				
		

			$str .= str_replace('[site_url]', $site_url, $str_font);
			
			/* ----------------------------- site width --------------------------------- */
			if(!empty($mweb_site_width)){
				$str .= '@media (min-width: 1200px){ .container { max-width: '.$mweb_site_width.'px; } header .my_sticky #navigation{ max-width: '.$mweb_site_width.'px; } }';
			}
			
			$product_display_features = get_option('product_display_features', array());
			$features = isset($product_display_features['features']) ? $product_display_features['features'] : array();

			
			$str .= ':root {';
				if( !empty($color_main) )
					$str .= '--maincolor: '.$color_main.';';
				if( !empty($color_sec) )
					$str .= '--secondcolor: '.$color_sec.';';
				if( !empty($color_1) )
					$str .= '--bgcolor: '.$color_1.';';
				if( !empty($color_2) )
					$str .= '--headcolor: '.$color_2.';';
				if( !empty($color_3) )
					$str .= '--footcolor: '.$color_3.';';
				if( !empty($color_4) )
					$str .= '--foottxcolor: '.$color_4.';';
				if( !empty($color_5) )
					$str .= '--cartcolor: '.$color_5.';';
				if( !empty($color_7) )
					$str .= '--headcartcolor: '.$color_7.';';
				if( !empty($color_8) )
					$str .= '--offbgcolor: '.$color_8.';';
				
				$str .= '--mainfont: '. ( $mweb_just_numfa == true ? $font_array[1] : $font_array[0] ) .';';
				$str .= '--mainfontnum: '.$font_array[1].';';
				
				$str .= '--borderradius: '.$global_radius.'px;';
				
				$str .= '--featured: '.count($features).';';

			$str .= '}';
				


			/* ----------------------------- color 6 --------------------------------- */
			if(!empty($color_6)){
				$str .= '.out_of_stock{ background-color: '.$color_6.'; }';
				$str .= '.out_of_stock:after{ border-top-color: rgb('.mweb_hex2rgb($color_6 ,'lowcl').'); }';
				$str .= '.out_of_stock:before{ border-bottom-color: '.$color_6.'; }';
			}
			
			
			/* ----------------------------- body background image --------------------------------- */

			if( !empty($body_background) && !empty($body_background['background-image']) ){
				$str .= 'body{ background-image: url('.$body_background['background-image'].'); background-position: '.$body_background['background-position'].'; background-repeat: '.$body_background['background-repeat'].'; background-size: '.$body_background['background-size'].'; }';
			}
			
			
			/* ----------------------------- head background --------------------------------- */

			if( !empty($header_background) && !empty($header_background['background-image']) ){
				$str .= '.logo_wrap , .full_header_wrap{ background-image: url('.$header_background['background-image'].');	background-position: '.$header_background['background-position'].';	background-repeat: '.$header_background['background-repeat'].';	background-size: '.$header_background['background-size'].';	}';
			}


			/* ----------------------------- footer background --------------------------------- */

			if(!empty($footer_background) && !empty($footer_background['background-image'])){
				$str .= '.footer_wrap{ background-image: url('.$footer_background['background-image'].'); background-position: '.$footer_background['background-position'].'; background-repeat: '.$footer_background['background-repeat'].'; background-size: '.$footer_background['background-size'].'; }';
			}
			
			
			/* ----------------------------- header offer --------------------------------- */

			if( !empty($mweb_offer_pat) ){
				
				$my_offer_css = '.header_offer{';
				if(!empty($mweb_offer_pat['background-image']))
					$my_offer_css .= 'background-image: url('.$mweb_offer_pat['background-image'].'); background-position: '.$mweb_offer_pat['background-position'].'; background-repeat: '.$mweb_offer_pat['background-repeat'].';';
				
				if(!empty($mweb_offer_pat['background-color']))
					$my_offer_css .= 'background-color:'.$mweb_offer_pat['background-color'].';';
				
				$mweb_offer_size = mweb_theme_util::get_theme_option( 'mweb_offer_size' );
				$mweb_offer_color = mweb_theme_util::get_theme_option( 'mweb_offer_color' );
				$mweb_offer_align = mweb_theme_util::get_theme_option( 'mweb_offer_align' );
				
				if( $mweb_offer_size )
					$my_offer_css .= 'font-size:'.$mweb_offer_size.'px;';
				if( $mweb_offer_color )
					$my_offer_css .= 'color:'.$mweb_offer_color.';';
				if( $mweb_offer_align )
					$my_offer_css .= 'text-align:'.$mweb_offer_align.';';
				
				
				$my_offer_css .= '}';
				$str .= $my_offer_css;

			}
			
			/* -----------------------------  product title style --------------------------------- */
			if( $mweb_product_title_style) {
				$str .= '.single_product_head{padding: 0px 15px 10px; background-color: #f5f6f7;}.woocommerce .entry-summary .product_meta{ padding:0}';
			}
			
			/* ----------------------------- under construction background --------------------------------- */

			if( !empty($under_construction_background) && !empty($under_construction_background['background-image']) ){
				$str .= '.under_construction{ background-image: url('.$under_construction_background['background-image'].'); background-position: '.$under_construction_background['background-position'].'; background-repeat: '.$under_construction_background['background-repeat'].'; background-size: '.$under_construction_background['background-size'].'; }';
			}
			
			/* ----------------------------- body background boxes --------------------------------- */

			if( $mweb_white_body ){
				$str .= '.item .item-area, .woocommerce-account .woocommerce-MyAccount-navigation, .my_acc_user_info, .widget, .tb-wrap, .el_alert, .page-shopping-cart .woocommerce-cart-form, .mweb_checkout_page, .woocommerce-orders .woocommerce-MyAccount-content, .woocommerce-downloads .woocommerce-MyAccount-content, .woocommerce-woo-wallet-transactions .woocommerce-MyAccount-content, .order_action.or_cancel, .order_return_wrap{box-shadow: 0 0px 2px 0px rgba(0, 0, 0, 0.1);}';
			}
			
			/* ----------------------------- toggle button contact --------------------------------- */

			if( $btn_c_position ){
				$str .= '.elm_c_wrap{ left: auto !important; right: 25px}';
			}
			if( $btn_c_bg ){
				$str .= '.elm_c_btn.btn_c_all{ background-color: '.$btn_c_bg.' }';
			}
			
			
			
			/* ----------------------------- header mobile ------------------------------- */
			
			$bg_head_mobile = mweb_theme_util::get_theme_option( 'bg_head_mobile' );
			$color_head_mobile = mweb_theme_util::get_theme_option( 'color_head_mobile' );
			
			if(!empty($bg_head_mobile)){			
				$str .= '.head_mobile{ background-color: '.$bg_head_mobile.'; }';
				$str .= '.head_mobile .hs_icon.shop_cart, .head_mobile .search_wrap_mobile form.search_wrap input{ background-color: rgb(0 0 0 / 8%) !important; }';
				$str .= '.hs_icon.shop_cart a i{ color: #fff !important; }';
				$str .= '.head_mobile form.search_wrap i.search_icon { color: rgb(255 255 255 / 30%); }';
			}
			
			if(!empty($color_head_mobile)){			
				$str .= '.head_mobile .hs_icon{ color: '.$color_head_mobile.'; }';
			}
			
			
			/* ----------------------------- toolbar mobile ------------------------------- */
			
			$bg_toolbar = mweb_theme_util::get_theme_option( 'bg_toolbar' );
			$color_txt_toolbar = mweb_theme_util::get_theme_option( 'color_txt_toolbar' );
			
			if(!empty($bg_toolbar)){			
				$str .= '.toolbar_mobile:before, .toolbar_mobile:after{ background-color: '.$bg_toolbar.'; }';
				$str .= '.sticky_toolbar_footer.mfoot_2 svg, .sticky_toolbar_footer.mfoot_1 svg{ fill: '.$bg_toolbar.' }';
			}
			
			if(!empty($color_txt_toolbar)){			
				$str .= '.toolbar_item{ color: '.$color_txt_toolbar.'; }';
			}
		
			/* ----------------------------- typography ------------------------------- */
			
			$menu_typ = mweb_theme_util::get_theme_option( 'menu-typography' );
			$content_typ = mweb_theme_util::get_theme_option( 'content-typography' );
			$ch2_typ = mweb_theme_util::get_theme_option( 'ch2-typography' );
			$ch3_typ = mweb_theme_util::get_theme_option( 'ch3-typography' );
			$ch4_typ = mweb_theme_util::get_theme_option( 'ch4-typography' );
			$ch5_typ = mweb_theme_util::get_theme_option( 'ch5-typography' );
			
			if(!empty($menu_typ))
				$str .= ".mweb-main-menu ul>li.level-0>a{font-size: {$menu_typ['font-size']}; font-weight: {$menu_typ['font-weight']}; color: {$menu_typ['color']}} .mweb-main-menu ul>li.level-0{line-height: {$menu_typ['line-height']};}";
			
			$str .= ".entry-content>p, .entry_content_inner>p{";
				if(!empty($content_typ['font-size'])) 
					$str .= "font-size: {$content_typ['font-size']};";
				if(!empty($content_typ['font-weight'])) 
					$str .= "font-weight: {$content_typ['font-weight']};";
				if(!empty($content_typ['color'])) 
					$str .= "color: {$content_typ['color']};";
				if(!empty($content_typ['line-height'])) 
					$str .= "line-height: {$content_typ['line-height']};";
			$str .= "}";
			
			if(!empty($ch2_typ))
				$str .= ".entry-content>h2, .entry_content_inner>h2{font-size: {$ch2_typ['font-size']}; font-weight: {$ch2_typ['font-weight']}; color: {$ch2_typ['color']}; line-height: {$ch2_typ['line-height']};}";
			
			if(!empty($ch3_typ))
				$str .= ".entry-content>h3, .entry_content_inner>h3{font-size: {$ch3_typ['font-size']}; font-weight: {$ch3_typ['font-weight']}; color: {$ch3_typ['color']}; line-height: {$ch3_typ['line-height']};}";
			
			if(!empty($ch4_typ))
				$str .= ".entry-content>h4, .entry_content_inner>h4{font-size: {$ch4_typ['font-size']}; font-weight: {$ch4_typ['font-weight']}; color: {$ch4_typ['color']}; line-height: {$ch4_typ['line-height']};}";
			
			if(!empty($ch5_typ))
				$str .= ".entry-content>h5, .entry_content_inner>h5{font-size: {$ch5_typ['font-size']}; font-weight: {$ch5_typ['font-weight']}; color: {$ch5_typ['color']}; line-height: {$ch5_typ['line-height']};}";
		

			$sidebar_style = mweb_theme_util::get_theme_option('sidebar_style'); 
			switch( $sidebar_style ){
				case '2' : 
					$str .= '.widget_title:after,.widget_title:before{height:2px;position:absolute;bottom:-2px;z-index:1;content:""}.widget_title:before{width:32px;background-color:#dcdcdc;right:18px}.widget_title:after{width:13px;background-color:var(--maincolor);right:0}';
					break;
				case '3' : 
					$str .= '.widget_title:before{width:4px;height:16px;background-color:var(--maincolor);display:inline-block;vertical-align:middle;margin-left:14px;border-radius:13px;z-index:1;content:""}';
					break;
				case '4' : 
					$str .= '.widget_title:before{width:14px;height:14px;border:1px solid #dee1e7;display:inline-block;vertical-align:middle;margin-left:14px;border-radius:6px;z-index:1;content:""}';
					break;
	
			}
			
			
			if( $sepbox_style == 'two' ){
				$str .= '.block-title { margin-bottom: 20px; } .block-title:before { border-bottom: 2px dashed rgb(0 0 0 / 33%); top: auto; bottom: -7px; right: 0; left: 0px !important; } .bk_view_more { border: 1px solid rgb(0 0 0 / 9%); line-height: 30px; margin-top: 4px; height: 30px; }';
			} elseif( $sepbox_style == 'three' ){
				$str .= '.block-title { margin-bottom: 20px; } .block-title:before { border-bottom: 2px dotted rgb(0 0 0 / 50%); top: auto; bottom: -7px; right: 0; left: 0px !important; } .bk_view_more { border: 1px solid rgb(0 0 0 / 9%); line-height: 30px; margin-top: 4px; height: 30px; }';
			}


			/************************ USER CUSTOM CSS **********************************/
			$mweb_custom_css = mweb_theme_util::get_theme_option( 'custom_css' );

			if ( ! empty( $mweb_custom_css ) ) {
				$str .= $mweb_custom_css;
			}
			
			
			//$str_all = apply_filters( 'custom_css_elm', $str );

			
			//$str .= mweb_theme_composer_render::dynamic_style();

			//$str .= '</style>';
			
			$str = mweb_minimize_CSS($str);

			//save to database
			$mweb_save_dynamic_css_cache = addslashes( $str );
			delete_option( 'mweb_theme_dynamic_css_cache' );
			add_option( 'mweb_theme_dynamic_css_cache', $mweb_save_dynamic_css_cache );

			wp_add_inline_style( 'mweb-style', $str );


		} else {
			wp_add_inline_style( 'mweb-style', stripcslashes( $mweb_dynamic_css_cache ) );
		}
	}
}

if ( ! function_exists( 'mweb_theme_delete_dynamic_css_cache' ) ) {
	function mweb_theme_delete_dynamic_css_cache() {
		delete_option( 'mweb_theme_dynamic_css_cache' );
	}
}

// delete css cache
add_action( 'redux/options/shop_options/saved', 'mweb_theme_delete_dynamic_css_cache' );
add_action( 'redux/options/shop_options/reset', 'mweb_theme_delete_dynamic_css_cache' );
add_action( 'redux/options/shop_options/section/reset', 'mweb_theme_delete_dynamic_css_cache' );
//add_action( 'save_post', 'mweb_theme_delete_dynamic_css_cache' );