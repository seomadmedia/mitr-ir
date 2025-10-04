<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product, $yith_woocompare;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}

// Extra post classes
$classes = array();

if ( is_product() ) {
	$classes[] = 'item';
}else {
	$classes[] = 'item col-12 col-sm-6 col-md-4 col-lg-3';
}

?>
<li <?php wc_product_class($classes, $product); ?>>

<div class="item-area item_general clear"> 
<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	 
	remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
	do_action( 'woocommerce_before_shop_loop_item' );
	?>
	
	<div class="product-image-area">
		<a class="product-image" href="<?php the_permalink(); ?>">
		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
			//add_action( 'woocommerce_before_shop_loop_item_title', 'mweb_template_loop_product_thumbnail', 10);
			add_action( 'woocommerce_before_shop_loop_item_title', 'mweb_loop_product_back_thumbnail', 10);
			do_action( 'woocommerce_before_shop_loop_item_title' );
			mweb_template_loop_product_thumbnail();
		?>
		</a>
		<?php
			//mweb_woocommerce::mweb_woocommerce_check_stock();
			//mweb_woocommerce::mweb_wc_custom_label();
		?>
	</div>
	<div class="product-detail-area">
		<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 */
				remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
			
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?> 
		<?php 
			/**
			 * woocommerce_shop_loop_item_title hook.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			do_action( 'woocommerce_shop_loop_item_title' ); ?>

		<div class="actions">
			<?php 
				add_action('woocommerce_template_loop_rating_wrap', 'woocommerce_template_loop_rating', 10);
				do_action( 'woocommerce_template_loop_rating_wrap' ); ?>
			<ul class="add-to-links">
				<?php mweb_wishlist::mweb_single_add_wishlist(get_the_ID(),'product'); ?>
				<?php if(function_exists('mweb_add_compare_button')) { mweb_add_compare_button(); } ?>

				<li>
					<?php 
					 /**
					 * woocommerce_after_shop_loop_item hook.
					 *
					 * @hooked woocommerce_template_loop_product_link_close - 5
					 * @hooked woocommerce_template_loop_add_to_cart - 10
					 */
					
					if ( class_exists('YITH_WCQV_Frontend') ) {
						remove_action('woocommerce_after_shop_loop_item',  array( YITH_WCQV_Frontend::get_instance(), 'yith_add_quick_view_button'), 15);
					}
					if ( isset($yith_woocompare) ) {
						remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
					}
					remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
					remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
					do_action( 'woocommerce_after_shop_loop_item' );
					mweb_get_custom_add_to_cart_loop();
					?>
				</li>
			</ul>
		</div>
	</div>
</div> 
</li>
