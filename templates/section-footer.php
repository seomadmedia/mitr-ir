<?php

$user_logged_in = is_user_logged_in();

if( is_account_page() && !$user_logged_in){

	remove_all_actions( 'mweb_theme_footer' );

}else{

	$sticky_adcart = mweb_theme_util::get_theme_option( 'mweb_sticky_adcart' );
	$is_mobile = wp_is_mobile();

	

	if( is_product() && $sticky_adcart && !$is_mobile ){
		echo '<div class="add_to_cart_sticky sticky_btn_add_to_cart"><span>افزودن به سبد خرید</span><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#shopping-cart"></use></svg></div>';
	}

	
	if( !is_account_page() && $is_mobile ): 
	
		$mb_menu = mweb_theme_util::get_theme_option('mweb_active_mb_menu'); 
		$addcart_mobile = mweb_theme_util::get_theme_option('mweb_sticky_addcart_mobile'); 
	
		$b_toolbar_style = mweb_theme_util::get_theme_option('mweb_bottom_toolbar_style');
				
		$b_toolbar_type = mweb_theme_util::get_theme_option('b_toolbar_type');
		$b_toolbar_icon = mweb_theme_util::get_theme_option('b_toolbar_icon');
		$b_toolbar_link = mweb_theme_util::get_theme_option('b_toolbar_link');
		$b_toolbar_label = mweb_theme_util::get_theme_option('b_toolbar_label');
		
		if( is_product() && $addcart_mobile && mweb_get_product_stock() ){
			global $product;
			$mclass = 'm_add_to_cart_sticky sticky_btn_add_to_cart';
			/* if( mweb_get_product_stock() == false ){
				$mclass .= 'outofstock';
			} */
            $price_c = !empty($product->get_price_html()) 
    ? '<div class="price price-placeholder wdp-dynamic-price" data-product-id="' . esc_attr($product->get_id()) . '">' . $product->get_price_html() . '</div>' 
    : '';
			printf('<div class="%1$s"><span><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#shopping-cart"></use></svg>افزودن به سبد خرید</span>%2$s</div>', $mclass, $price_c);
		}
		
		$is_cart = is_cart();
		$is_checkout = is_checkout();
		
		if( $is_cart ){
			echo '<a class="elm_sticky_btn" href="'.wc_get_checkout_url().'">ادامه جهت تسویه حساب</a>';
		}
		/* if( $is_checkout ){
			echo '<div class="elm_sticky_btn btn_chk">تایید و ادامه</div>';
		} */
		
		if( !is_product() && $mb_menu && !$is_cart && !$is_checkout){
			
			if ( is_array($b_toolbar_type) && !empty($b_toolbar_type)){
				
				?>
				<div class="sticky_toolbar_footer mfoot_<?= $b_toolbar_style ?>">
				
				<?php if( $b_toolbar_style == 1 ): ?>
				<svg xmlns="http://www.w3.org/2000/svg" width="1080" height="230" viewBox="0 0 1080 230">
				  <path class="footer_svg" d="M1081,3811.44V3966H1V3811.44q42.5-8.97,85-17.95,7.5-.99,15-1.99c18.1-5.71,39.855-7.3,58-12.97l25-3.99c18.008-5.81,39.853-7.3,58-12.96q9.5-1.5,19-2.99v-1q7.5-.99,15-1.99c19.78-6.17,43.347-7.71,63-13.96q7.5-1.005,15-2v-0.99q5-.51,10-1c3.951-1.22,18.608-3.83,25-2,15.424,4.43,29.569,8.63,38,19.95q2,1.485,4,2.99v1.99c0.667,0.34,1.333.67,2,1q0.5,1.995,1,3.99h1c0.667,1.99,1.333,3.99,2,5.98h1v2.99h1v2h1q0.5,3.48,1,6.98h1v3.99h1v3.99h1v3.98h1q1,8.475,2,16.96l9,20.94,2,0.99q0.5,1.995,1,3.99h1c0.333,1,.667,2,1,2.99,0.667,0.34,1.333.67,2,1v2c1,0.66,2,1.33,3,1.99v1.99q4,3.495,8,6.98c1.667,2,3.334,3.99,5,5.99h2c0.667,0.99,1.333,1.99,2,2.99h2c0.667,1,1.333,1.99,2,2.99,1.333,0.33,2.667.67,4,1,0.333,0.66.667,1.33,1,1.99q4.5,1.5,9,2.99v1h2v1h3v0.99h2v1c2.666,0.33,5.334.67,8,1v1h4v0.99h7c3.45,0.98,23.246,2.35,28,1v-1h7v-0.99h4v-1h4v-1h4v-1l5-.99v-1h2v-1h3v-0.99c1.333-.34,2.667-0.67,4-1v-1h2c0.333-.66.667-1.33,1-1.99,1.333-.33,2.667-0.67,4-1,0.667-1,1.333-1.99,2-2.99h2c0.667-1,1.333-2,2-2.99h2c1.333-1.66,2.667-3.33,4-4.99l9-7.98v-1.99c1-.66,2-1.33,3-1.99v-2c0.667-.33,1.333-0.66,2-1v-1.99c0.667-.33,1.333-0.67,2-1q0.5-1.995,1-3.99l2-.99q0.5-1.995,1-3.99h1q0.5-1.995,1-3.99h1v-2.99h1q0.5-1.995,1-3.99h1c0.333-1.99.667-3.99,1-5.98h1v-5.99h1v-5.98h1v-4.99h1v-3.98h1v-3.99h1q0.5-3.99,1-7.98l10-20.94q2-1.5,4-2.99c0.333-1,.667-2,1-2.99h2l3-3.99h2c0.333-.67.667-1.33,1-2h2c0.333-.66.667-1.33,1-1.99,2-.67,4-1.33,6-2v-0.99h2v-1h3v-1h3v-0.99h3v-1h4v-1h5v-1c6.372-1.83,21.067.78,25,2q5,0.495,10,1c7.328,2.29,16.752,3.72,24,5.98q5,0.495,10,1c10.559,3.31,23.491,4.7,34,7.97q10,1.5,20,2.99c18.15,5.71,39.779,7.29,58,12.97q10,1.5,20,2.99c18.008,5.81,39.853,7.31,58,12.96q7.5,1,15,2c11.986,3.76,26.887,5.2,39,8.97,3.33,0.33,6.67.67,10,1,5.93,1.85,14.07,3.14,20,4.98h5C1052.99,3806.32,1067.89,3808.88,1081,3811.44Z" transform="translate(-1 -3735)"/>
				</svg>	
				<?php elseif( $b_toolbar_style == 2 ): ?>
				<svg xmlns="http://www.w3.org/2000/svg" width="82" height="50" viewBox="0 0 82 50">
				  <path d="M0,50V45H82v5H0ZM0,0.025C0.167,0.017.331,0,.5,0A9.494,9.494,0,0,1,9.87,8h0.138A32.013,32.013,0,0,0,41,32,32.013,32.013,0,0,0,71.992,8H72.13A9.494,9.494,0,0,1,81.5,0c0.169,0,.333.017,0.5,0.025V45H0V0.025Z"/>
				</svg>
				<?php endif; ?>
				<div class="toolbar_mobile">

				<?php
				
					//$label_array = array( 'goup' => 'رفتن به بالا', 'cart' => 'سبد خرید', 'cat' => 'دسته بندی ها', 'user' => 'حساب کاربری', 'custom' => '', )
					
					$counter = count($b_toolbar_type);
					$middle = intval( ( $counter / 2 ) + 1 );
					$temp_print = '';
			
					for ($key = 0; $key < $counter; $key++) { 
						if(empty($b_toolbar_type[$key]))
							continue;
						$col_cls = 'elm_t-'.$b_toolbar_type[$key];
						$col_cls .= $middle == ($key+1) ? ' is_middle' : '';
						
						//$el_title = $b_toolbar_style > 2 ? $label_array[$b_toolbar_type[$key] : '';
						$el_title = $b_toolbar_style > 2 ? '<b>'.@$b_toolbar_label[$key].'</b>' : '';
				
						echo '<div class="toolbar_col '.$col_cls.'">';
						switch ($b_toolbar_type[$key]) {
							case "goup":
								echo '<span class="toolbar_item go_up"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-up"></use></svg>'.$el_title.'</span>';
								break;
							case "cart":
									$el_title = $middle == ($key+1) && $b_toolbar_style != 4 ? '' : $el_title;
									echo '<a href="'.esc_url( wc_get_cart_url() ).'" class="toolbar_item tb_cart get_sidebar" data-class="open_cart_sidebar"><svg class="pack-theme is_white" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#bag-2"></use></svg><span id="toolbox_cart">'. sprintf (_n( '%d ', '%d ', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ).'</span>'.$el_title.'</a>';
								break;
							case "cat":
								echo '<a class="toolbar_item get_sidebar" data-class="open_categories_sidebar"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#folder-2"></use></svg>'.$el_title.'</a>';
								break;
							case "user":
								echo '<a class="toolbar_item'.($user_logged_in == true ? ' is_logged_in' : ' login_btn').'" href="'.get_permalink(wc_get_page_id('myaccount')).'">'.($user_logged_in == true ? '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#user-tick"></use></svg>' : '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#user"></use></svg>').''.$el_title.'</a>';
								break;
							case "custom":
								echo '<a class="toolbar_item" href="'.esc_url($b_toolbar_link[$key]).'">'. (filter_var($b_toolbar_icon[$key], FILTER_VALIDATE_URL) ? '<img src="'.$b_toolbar_icon[$key].'"/>' : $b_toolbar_icon[$key] ) .$el_title.'</a>';
								break;
						}
						echo '</div>';
						
					}

				echo '</div>';
				
				echo '</div>';
			}
			
			
			get_template_part( 'templates/footer/module', 'cat_sidebar' );
		
		}
	
	endif; 
	
	$compare_activity = mweb_theme_util::get_theme_option('compare_activity');
	$mweb_toolbox = mweb_theme_util::get_theme_option('mweb_toolbox'); 
	if($mweb_toolbox && !$is_mobile): ?>
	<div class="sticky_toolbox">
		<ul>
			<?php
			if(is_user_logged_in()){
				$mweb_acc_url = get_permalink( get_option('woocommerce_myaccount_page_id'));
				$wishlist_active = mweb_theme_util::get_theme_option('wishlist_activity');
				if( $wishlist_active )
					echo '<li><a href="'.wc_get_endpoint_url('wishlists', '', $mweb_acc_url).'" title="علاقه مندی ها"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#heart"></use></svg><span id="wl_count">'.mweb_wishlist::mweb_get_count_wishlist('product').'</span></a></li>';
			} 
			if( $compare_activity == true && function_exists('mweb_get_compare_page_link') )
				echo '<li><a href="'.mweb_get_compare_page_link().'" class="compare_sticky" title="مقایسه"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#convertshape"></use></svg><span>'.count(mweb_get_compare_list()).'</span></a></li>';
			echo '<li><a href="'.esc_url( wc_get_cart_url() ).'" class="get_sidebar" data-class="open_cart_sidebar" title="سبد خرید"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#bag-happy"></use></svg><span id="toolbox_cart">'. sprintf (_n( '%d ', '%d ', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ).'</span></a></li>';
			echo '<li><a href="#" class="gototop" title="رفتن به بالا"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-up"></use></svg></a></li>';
			?>
		</ul>
	</div>
	
	<?php endif; ?>

	<?php if( $compare_activity == true && function_exists('mweb_show_mini_compare') ){ ?>
	<div class="mweb-compare-list-bottom">
		<?php mweb_show_mini_compare(); ?>
	</div>
	<?php } ?>
<?php } ?>
