<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.1
 */



defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;
$wrapper_classes   = 'gallery-' . ( has_post_thumbnail() ? 'with-images' : 'without-images' );
$attachment_ids = $product->get_gallery_image_ids();
?>
<div class="images <?php echo $wrapper_classes; ?>">
	<div class="swiper product-images" dir="rtl">
		<div class="swiper-wrapper">
	<?php
		
		$my_thumb = $product->get_image_id();
		if ( $attachment_ids && $product->get_image_id() ) {
			array_unshift($attachment_ids ,$my_thumb);
			
			$my_flag = true ;
			
			foreach ( $attachment_ids as $attachment_id ) {
				$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
				$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'woocommerce_single' );
				if($my_flag){
					$attributes      = array(
						'title'                   => get_post_field( 'post_title', $attachment_id ),
						'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
						'class' 				  => 'img-responsive woocommerce-main-image',
						'data-zoom-image'		  => $full_size_image[0],
						'data-src'                => $full_size_image[0],
						'data-large_image'        => $full_size_image[0],
						'data-large_image_width'  => $full_size_image[1],
						'data-large_image_height' => $full_size_image[2],
					);
					$my_flag = false;
					
				}else {
					$attributes      = array(
						'title'                   => get_post_field( 'post_title', $attachment_id ),
						'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
						'class' 				  => 'img-responsive',
						'data-zoom-image'		  => $full_size_image[0],
						'data-src'                => $full_size_image[0],
						'data-large_image'        => $full_size_image[0],
						'data-large_image_width'  => $full_size_image[1],
						'data-large_image_height' => $full_size_image[2],
					);
				}		

				$html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '" class="swiper-slide img woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
				$html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
				$html .= '</a></div>';

				echo apply_filters( 'woocommerce_single_product_image_html', $html, $attachment_id );
			}
		} elseif(has_post_thumbnail()){
			$html  = wc_get_gallery_image_html( $my_thumb, true );
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $my_thumb );
		} else {

			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
			$html .= '</div>';
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $my_thumb );
		}
		

	?>
		</div>
	</div>
	

</div>

<?php //mweb_deal_countdown_timer('single_dailydeal'); ?>					

	
