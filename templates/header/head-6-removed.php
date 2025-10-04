<?php 
$mweb_head_tel_or_ins = mweb_theme_util::get_theme_option('mweb_head_tel_or_ins'); 
$mweb_head_tel_or_ins_link = mweb_theme_util::get_theme_option('mweb_head_tel_or_ins_link');

$mweb_acc_url = mweb_theme_util::get_theme_option('mweb_login_register_url'); 
if(empty($mweb_acc_url)){
	$mweb_acc_url = get_permalink( get_option('woocommerce_myaccount_page_id'));
}

$mweb_head3_menu = mweb_theme_util::get_theme_option('mweb_head3_menu'); 
$current_user = wp_get_current_user();

?>
<?php get_template_part( 'templates/header/module', 'nav_mobile' ); ?>

<header <?php mweb_theme_schema::makeup('header'); ?> class="head_4 head_6 custom_sticky"> 
	<div class="container">
	<div class="row">
		<div class="col-5 col-sm-4 col-md-3 col-lg-2">
			<?php get_template_part( 'templates/header/module', 'logo' ); ?>
		</div>
		<div class="hide_tablet col-lg-7">
			<?php get_template_part( 'templates/header/module', 'navigation' ); ?>
		</div>
		<div class="col-7 col-sm-8 col-md-9 col-lg-3">
			<div class="head_icon_warp">	
				<div class="is-show mobile-nav-button hs_icon">
					<a id="mweb-trigger" class="icon-wrap" href="#"> <i class="fal fa-bars"></i></a>
				</div>
				<?php if ( class_exists('WooCommerce') ) : ?>
					<div class="shop_cart hs_icon get_sidebar" data-class="open_cart_sidebar"> <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="مشاهده سبد خرید"><span class="shop-badge"><?php echo sprintf (_n( '%d ', '%d ', WC()->cart->get_cart_contents_count() ), WC()->cart->get_cart_contents_count() ); ?></span><i class="fal fa-shopping-bag"></i></a>
						<?php get_template_part( 'templates/header/module', 'cart' ); ?>
					</div>
				<?php endif; ?>			
				<?php if(is_user_logged_in()): ?>
					<div class="hs_icon user_login"><span> <i class="fal fa-user-cog"></i> </span>
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
					<a class="hs_icon user_login login_btn" href="<?php echo esc_url($mweb_acc_url); ?>"><span> <i class="fal fa-user"></i> </span></a>
				<?php endif; ?> 
				
				<?php if(!empty($mweb_head_tel_or_ins) && $mweb_head_tel_or_ins != 'none' ){
					$my_icon = ($mweb_head_tel_or_ins == 'head_telegram') ? 'fal fa-paper-plane' : 'fab fa-instagram';
					echo '<a href="'.$mweb_head_tel_or_ins_link.'" class="hs_icon telegram hide_mobile" title="ما در شبکه اجتماعی"> <i class="'.$my_icon.'"></i> </a>';
				} ?>
				
				<div class="hs_icon hs_search_btn"><i class="fal fa-search"></i></div>
				
				<div class="search_overlay">
					<div class="search_toggle"><i class="fal fa-times"></i></div>
					<?php echo mweb_render_search_form(); ?>
				</div>
			</div>
		</div>
		
	</div>
	</div>
</header>