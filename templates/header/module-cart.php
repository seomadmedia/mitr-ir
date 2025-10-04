<?php $mweb_cart_sidebar = mweb_theme_util::get_theme_option( 'mweb_cart_sidebar' ); ?>
<?php if ( !is_cart() && !is_checkout() && !$mweb_cart_sidebar ) : ?>
	<div class="shop_detail">
		<div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>
	</div>
<?php endif; ?>