<?php 
$mweb_head_tel_or_ins = mweb_theme_util::get_theme_option('mweb_head_tel_or_ins'); 
$mweb_head_tel_or_ins_link = mweb_theme_util::get_theme_option('mweb_head_tel_or_ins_link');

$mweb_head_panel = mweb_theme_util::get_theme_option('mweb_head_panel'); 

$mweb_acc_url = mweb_theme_util::get_theme_option('mweb_login_register_url'); 

if(empty($mweb_acc_url)){
	$mweb_acc_url = get_permalink( get_option('woocommerce_myaccount_page_id'));
}

$mweb_head3_menu = mweb_theme_util::get_theme_option('mweb_head3_menu'); 

?>
<header <?php mweb_theme_schema::makeup('header'); ?> class="head_4 head_7"> 
	<div class="container">
		<div class="row">
			<div class="col-md-4 hide_mobile">
				<?php echo mweb_render_search_form(); ?>
			</div>
			<div class="col-6 col-sm-6 col-md-4 logo_wrap_c">
				<?php get_template_part( 'templates/header/module', 'logo' ); ?>
			</div>
			<div class="col-6 col-sm-6 col-md-4">	
				<?php $mweb_acc_url = get_permalink( get_option('woocommerce_myaccount_page_id')); ?>
				<a href="<?php echo wc_get_endpoint_url('wishlists', '', $mweb_acc_url); ?>" class="head_wishlist_btn top_icons"><i class="fal fa-heart"></i></a>
				
				<?php if(is_user_logged_in()): ?>
					<div class="top_icons user_login"><span> <i class="fal fa-user-cog"></i> </span>
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
					 <a class="top_icons user_login login_btn" href="<?php echo esc_url($mweb_acc_url); ?>"><span> <i class="fal fa-user"></i> </span></a>
				<?php endif; ?> 
				
				<?php if ( class_exists('WooCommerce') ) : ?>
					<div class="shop_cart top_icons get_sidebar" data-class="open_cart_sidebar"> <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="مشاهده سبد خرید"><span class="shop-badge"><?php echo sprintf (_n( '%d ', '%d ', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span><i class="fal fa-shopping-bag"></i></a>
						<?php get_template_part( 'templates/header/module', 'cart' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<div class="main_nav custom_sticky">
			<?php get_template_part( 'templates/header/module', 'navigation' ); ?>
			<?php get_template_part( 'templates/header/module', 'nav_mobile' ); ?>
			<?php get_template_part( 'templates/header/module', 'menu_button' ); ?>
		</div>
	</div>
</header>