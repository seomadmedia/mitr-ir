<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( $related_products ) : ?>
	<?php
	
		$is_mobile = wp_is_mobile();
		$product_type = apply_filters('general_product_type' , 'prdtype_default');

		$data_setting = array();

		$data_setting['slidesPerView'] = 2;
		$data_setting['spaceBetween'] = 15;
		$data_setting['watchSlidesVisibility'] = true;
		$data_setting['loop'] = false;
		$data_setting['autoplay'] = false;
		$data_setting['touchMoveStopPropagation'] = true;
		$data_setting['navigation'] = array('nextEl' => '.mweb-swiper-next', 'prevEl' => '.mweb-swiper-prev' );

		$data_setting['breakpoints'] = array('575' => array('slidesPerView' => 2), '768' => array('slidesPerView' => 2), '1024' => array('slidesPerView' => 5));

		$arrow_right = 'arrow-right-1';
		$arrow_left = 'arrow-left-1';	
		$attr_class = 'swiper sw_slider_related';

		if( isset($slider_data) ){
			$data_setting = $slider_data;
			if( $slider_overflow ){
				$attr_class .= ' swiper-wrap-visible';
			}
			$product_type .= $loop_type;
		}
	
	?>

	<section class="block-wrap related products <?= $product_type; ?>">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

		if ( $heading ) : ?>
			<div class="block-title"><span class="title"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#link-square"></use></svg><?php echo esc_html( $heading ); ?></span></div>
		<?php endif; ?>
		
		<?php //woocommerce_product_loop_start(); ?>

		<div class="<?= $attr_class ?>" dir='rtl' id="<?= wp_unique_id('sl_') ?>" data-slider="<?= esc_attr(wp_json_encode($data_setting)); ?>">
			<div class="swiper-wrapper">
			<?php if( isset($slider_data) ){
				foreach ( $related_products as $related_product ) : ?>

				<?php
				 	$post_object = get_post( $related_product->get_id() );
					setup_postdata( $GLOBALS['post'] =& $post_object );
					
					echo '<div class="swiper-slide"><div class="item">';
						echo $loop_name( $loop_arg );
					echo '</div></div>';
					
				?>
	
				<?php endforeach;
				
			} else{ ?>
			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
				 	$post_object = get_post( $related_product->get_id() );
					setup_postdata( $GLOBALS['post'] =& $post_object );
					if( $is_mobile ){
						echo '<div class="swiper-slide"><div class="item">';
							echo mweb_loop_template_product_mobile( array('flag' => 'yes') );
						echo '</div></div>';
					}else{
						wc_get_template_part( 'content', 'product_related' );  
					}	
				?>

			<?php endforeach; ?>
			<?php } ?>
			</div>
			<?php if( isset($slider_data) ){ 
				if ( isset($slider_data['pagination']) ) { 
					echo '<div class="mweb-swiper-pagination"></div>';
				} 
				if ( isset($slider_data['navigation']) ){
					echo '<div class="mweb-swiper-next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$arrow_right.'"></use></svg></div><div class="mweb-swiper-prev"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$arrow_left.'"></use></svg></div>';
				}		
			} else { 
				echo '<div class="mweb-swiper-next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$arrow_right.'"></use></svg></div><div class="mweb-swiper-prev"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$arrow_left.'"></use></svg></div>';
			 } ?>
		</div>
		<?php //woocommerce_product_loop_end(); ?>

	</section>

<?php endif;

wp_reset_postdata();
