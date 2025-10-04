<?php $mweb_cart_sidebar = mweb_theme_util::get_theme_option( 'mweb_cart_sidebar' ); ?>
<?php if( ( is_woocommerce_activated() && $mweb_cart_sidebar ) || wp_is_mobile() ){
global $woocommerce ?>
<div class="togglesidebar cart_sidebar">
	<div class="cart_sidebar_wrap">
		<div class="cart_sidebar_head">
			<div class="cart_sidebar_close close_sidebar" data-class="open_cart_sidebar"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#close-square"></use></svg></div>
			<strong>سبد خرید</strong>
			<div class="cart_count"><?php echo WC()->cart->cart_contents_count; ?></div>
		</div>
		<div class="widget_shopping_cart_content">
			<?php woocommerce_mini_cart(); ?>
		</div>
	</div>
</div>
<?php } ?>