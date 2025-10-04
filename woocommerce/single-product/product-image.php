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
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

use Automattic\WooCommerce\Enums\ProductType;

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
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

			$wrapper_classname = $product->is_type( ProductType::VARIABLE ) && ! empty( $product->get_available_variations( 'image' ) ) ?
				'woocommerce-product-gallery__image woocommerce-product-gallery__image--placeholder' :
				'woocommerce-product-gallery__image--placeholder';
			$html              = sprintf( '<div class="%s">', esc_attr( $wrapper_classname ) );
			$html             .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
			$html             .= '</div>';
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $my_thumb );
		}
		

	?>
		</div>
	</div>
	<div class="product_tools_btn">
		<span class="popup-image" id="btn_popup_images"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#maximize-4"></use></svg></span>
		<?php $video_embed = get_post_meta( get_the_ID(), 'mweb_single_video_embed', true ); 
			  $video_direct = get_post_meta( get_the_ID(), 'mweb_single_video_directlink', true );
			  $price_chart_class = '';
		?>
		
		<?php if(!empty($video_embed)): $price_chart_class = ' has_right'; ?>
			<?php echo '<a class="popup-video embed_video" href="https://www.aparat.com/video/video/embed/videohash/'.$video_embed.'/vt/frame" title="ویدیو"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#play"></use></svg></a>'; ?>
		<?php elseif(!empty($video_direct)): $price_chart_class = ' has_right'; ?>
			<?php echo '<a href="#popup-video" class="popup-video direct_video" title="ویدیو"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#play"></use></svg></a>'; ?>
			<div id="popup-video" class="mfp-hide">
				<video controls><source src="<?php echo $video_direct; ?>" type="video/mp4"> Your browser does not support the video tag. </video>
			</div>
		<?php endif ; ?>
		<?php mweb_get_product_share();
			  mweb_get_product_price_chart($price_chart_class);
			  mweb_get_product_360_view();
		?>
		<?php do_action('product_tools_hook'); ?>
	</div>
	
</div>

<div class="thumbnails">
	<div class="swiper product-thumbs" dir="rtl">
		<div class="swiper-wrapper">
			<?php do_action( 'woocommerce_product_thumbnails' ); ?>
		</div>
		<div class="swiper-button-next swiper-button-v1-next"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#arrow-left-1"></use></svg></div>
		<div class="swiper-button-prev swiper-button-v1-prev"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#arrow-right-1"></use></svg></div>
	</div>
</div>

<?php mweb_deal_countdown_timer('single_dailydeal'); ?>					


