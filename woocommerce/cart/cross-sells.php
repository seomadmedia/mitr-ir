<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.6.0
 */

defined( 'ABSPATH' ) || exit;


$is_mobile = wp_is_mobile();
$product_type = apply_filters('general_product_type' , 'prdtype_default');

$data_setting = array();

$data_setting['slidesPerView'] = 1;
$data_setting['spaceBetween'] = 15;
$data_setting['watchSlidesVisibility'] = true;
$data_setting['loop'] = true;
$data_setting['autoplay'] = false;
$data_setting['touchMoveStopPropagation'] = true;
$data_setting['navigation'] = array('nextEl' => '.mweb-swiper-next', 'prevEl' => '.mweb-swiper-prev' );

$data_setting['breakpoints'] = array('575' => array('slidesPerView' => 1), '768' => array('slidesPerView' => 2), '1024' => array('slidesPerView' => 5));

if ( $cross_sells ) : ?>

	<div class="cross-sells nav_swiper-slider">

		<?php
		$heading = apply_filters( 'woocommerce_product_cross_sells_products_heading', __( 'You may be interested in&hellip;', 'woocommerce' ) );
		if ( $heading ) :
			?>
			<h2 class="block-title"><span class="title"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#bag-happy"></use></svg><?php echo esc_html( $heading ); ?></span></h2>
		<?php endif; ?>

		<div class="swiper sw_slider_cross_sell" dir='rtl' id="<?= wp_unique_id('sl_') ?>" data-slider="<?= esc_attr(wp_json_encode($data_setting)); ?>">
			<div class="swiper-wrapper">
		<?php //woocommerce_product_loop_start(); ?>

			<?php foreach ( $cross_sells as $cross_sell ) : ?>

				<?php
					$post_object = get_post( $cross_sell->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited, Squiz.PHP.DisallowMultipleAssignments.Found

					if($is_mobile){
						echo '<div class="swiper-slide"><div class="item">';
							echo mweb_loop_template_product_mobile(array('flag' => 'no'));
						echo '</div></div>';
					}else{
						echo '<div class="swiper-slide">';
							wc_get_template_part( 'content', 'product_related' );  
						echo '</div>';
					}		
				?>

			<?php endforeach; ?>

		<?php //woocommerce_product_loop_end(); ?>
		</div>
			<div class="mweb-swiper-next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#arrow-right-1"></use></svg></div><div class="mweb-swiper-prev"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>'#arrow-left-1"></use></svg></div>
		</div>

	</div>
	<?php
endif;

wp_reset_postdata();
