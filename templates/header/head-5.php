<?php 
$mweb_head_tel_or_ins = mweb_theme_util::get_theme_option('mweb_head_tel_or_ins'); 
$mweb_head_tel_or_ins_link = mweb_theme_util::get_theme_option('mweb_head_tel_or_ins_link');
 
$mweb_head_support = mweb_theme_util::get_theme_option('mweb_head_support'); 
$mweb_head_support_text = mweb_theme_util::get_theme_option('mweb_head_support_text'); 

$mweb_head_panel = mweb_theme_util::get_theme_option('mweb_head_panel');
 
$mweb_acc_url = mweb_theme_util::get_theme_option('mweb_login_register_url'); 
if(empty($mweb_acc_url)){
	$mweb_acc_url = get_permalink( get_option('woocommerce_myaccount_page_id'));
}

$mweb_head3_menu = mweb_theme_util::get_theme_option('mweb_head3_menu'); 

?>
<header <?php mweb_theme_schema::makeup('header'); ?> class="head_4 head_5"> 
	<div class="container">
		<div class="row">
			<div class="col-6 col-sm-6 col-md-3">
				<?php get_template_part( 'templates/header/module', 'logo' ); ?>
			</div>
			<div class="col-md-5 hide_mobile">
				<?php echo mweb_render_search_form(); ?>
			</div>
			<div class="col-6 col-sm-6 col-md-4">		
				<?php if(is_user_logged_in()): ?>
					<div class="hs_icon user_login"><span><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#profile-tick"></use></svg></span>
						<?php
							if(has_nav_menu('user-menu')): ?>
							<div class="my-account">
							<?php
							   wp_nav_menu( array(
									'theme_location' => 'user-menu',
									'container' => false, 
									'menu_id' => '',
									'menu_class' => 'menu'
								));
							?>
							</div>
						<?php endif; ?>
					</div>
				<?php else: ?>
					 <a class="hs_icon user_login login_btn" href="<?php echo esc_url($mweb_acc_url); ?>"><span><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#user"></use></svg></span></a>
				<?php endif; ?> 
				<?php $mweb_acc_url = get_permalink( get_option('woocommerce_myaccount_page_id')); ?>
				<a href="<?php echo wc_get_endpoint_url('wishlists', '', $mweb_acc_url); ?>" class="head_wishlist_btn hs_icon"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#heart"></use></svg></a>
				<?php if(!empty($mweb_head_tel_or_ins) && $mweb_head_tel_or_ins != 'none' ){
					$my_icon = ($mweb_head_tel_or_ins == 'head_telegram') ? '<svg class="pack-theme" viewBox="0 0 512 512"><use xlink:href="'.mweb_print_sprites_path().'#telegram"></use></svg>' : '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#instagram"></use></svg>';
					echo '<a href="'.$mweb_head_tel_or_ins_link.'" class="hs_icon '.$mweb_head_tel_or_ins.'" title="ما در شبکه اجتماعی">'.$my_icon.'</a>';
				} ?>
				<?php if($mweb_head_support == true){
					$num_strong = substr($mweb_head_support_text, 0, 3) == '091' ? 4 : 3;
					$my_phone = '<div class="head_phone">'. ( strlen($mweb_head_support_text) > 8 ? '<strong>'.substr($mweb_head_support_text, 0, $num_strong).'</strong>'.substr($mweb_head_support_text, $num_strong) : $mweb_head_support_text ) .'</div>';
					echo '<div class="hs_icon phone"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#call-incoming"></use></svg>'.$my_phone.' </div>'; 
				} ?>	
			</div>
		</div>
		<div class="main_nav custom_sticky">
			<div class="container no_padding">
				<?php if ( class_exists('WooCommerce') ) : ?>
				<div class="menu_cart">
					<div class="shop_cart hs_icon get_sidebar" data-class="open_cart_sidebar"> <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="مشاهده سبد خرید"><span class="shop-badge"><?php echo sprintf (_n( '%d ', '%d ', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#bag-happy"></use></svg></a>
						<?php get_template_part( 'templates/header/module', 'cart' ); ?>
					</div>
				</div>
				<?php endif; ?>
				
				<?php get_template_part( 'templates/header/module', 'navigation' ); ?>
				<?php get_template_part( 'templates/header/module', 'nav_mobile' ); ?>
				<?php get_template_part( 'templates/header/module', 'menu_button' ); ?>
			</div>
		</div>
	</div>
</header>