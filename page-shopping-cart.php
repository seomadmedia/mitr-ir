<?php
/*
  Template name: سبد خرید و پرداخت
 */

get_header();
?>

<div class="container-wrap page-shopping-cart">
    <div class="container">
        <div class="order-steps">
			<?php if (function_exists('is_wc_endpoint_url')) : ?>
				<?php if (!is_wc_endpoint_url('order-received')) : ?>
					<div class="checkout-breadcrumb">
						<div class="title-cart">
							<i><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#bag-2"></use></svg></i>
							<a href="<?php echo esc_url(wc_get_cart_url()); ?>">
								<h4><?php esc_html_e('سبد خرید', 'mweb'); ?></h4>
							</a>
						</div>
						<div class="title-checkout">
							<i><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#receipt-1"></use></svg></i>
							<a href="<?php echo esc_url(wc_get_checkout_url()); ?>">
								<h4><?php esc_html_e('جزئیات پرداخت', 'mweb'); ?></h4>
							</a>
						</div>
						<div class="title-thankyou">
							<i><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#ticket-2"></use></svg></i>
							<h4><?php esc_html_e('تکمیل سفارش', 'mweb'); ?></h4>
						</div>
					</div>
				<?php else : ?>
					<div class="checkout-breadcrumb">
						<div class="title-cart">
							<i><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#bag-2"></use></svg></i>
							<a href="#">
								<h4><?php esc_html_e('سبد خرید', 'mweb'); ?></h4>
							</a>
						</div>
						<div class="title-checkout">
							<i><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#receipt-1"></use></svg></i>
							<a href="#">
								<h4><?php esc_html_e('جزئیات پرداخت', 'mweb'); ?></h4>
							</a>
							
						</div>
						<div class="title-thankyou mweb-complete">
							<i><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#ticket-2"></use></svg></i>
							<h4><?php esc_html_e('تکمیل سفارش', 'mweb'); ?></h4>
						</div>
					</div>
				<?php endif; ?>
			<?php endif; ?>
        </div>
    </div>
    <div class="container">
        <div id="content" class="wc_page_body<?php echo is_checkout() ? ' mweb_checkout_page': ''; ?>">
			<?php 
			if ( is_page( 'cart' ) || is_cart() ) 
				do_action( 'woocommerce_before_cart_wrap' ); ?>
			
            <?php
            while (have_posts()) :
                the_post();
                the_content();
            endwhile;
            ?>
			
			<?php 
			if ( is_page( 'cart' ) || is_cart() ) 
				do_action( 'woocommerce_after_cart_wrap' ); ?>
        </div>
    </div>
</div>

<?php
get_footer();
