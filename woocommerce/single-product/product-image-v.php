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
 * @package WooCommerce\Templates
 * @version 7.8.0
 */


defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;
$wrapper_classes   = 'gallery-' . ( has_post_thumbnail() ? 'with-images' : 'without-images' );
$attachment_ids = $product->get_gallery_image_ids();
$images = array();
$show_video = isset($video) ? true : false;
?>
<div class="images <?php echo $wrapper_classes; ?>">
	<div class="product-images-static">
		<?php
			$my_thumb = $product->get_image_id();
			if ( $my_thumb ) {
				$html = wc_get_gallery_image_html( $my_thumb, true );
				$images_src = wp_get_attachment_image_src( $my_thumb, 'woocommerce_single' );
				$images[] = $images_src[0];
			} else {
				$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
				$html .= '</div>';
			}

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $my_thumb ); 

		?>
	</div>
	<?php if( isset($product_btns) ){
		echo $product_btns;
	} ?>
</div>

<?php
	$thumb_v_html = '';
	$slide_v_html = '';
	$thumbs_html = '';
	$ex_num = 4;
	$video_direct = get_post_meta( get_the_ID(), 'mweb_single_video_directlink', true );
	if( !empty($video_direct) && $product->get_image_id() && $show_video ) {
		$html_img = apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $product->get_image_id() ), $product->get_image_id() ); 
		$html_img = str_replace('woocommerce-product-gallery__image', 'wc_gallery_image wc_gallery_more is_video', $html_img);
		$html_img = str_replace('</a>', '<svg width="24" height="24" fill="none"><use xlink:href="'.mweb_print_sprites_path().'#play-circle"></use></svg></a>', $html_img);
		$ex_num = $ex_num - 1;
		$thumbs_html.= $html_img;
		
		$images_src = wp_get_attachment_image_src( $product->get_image_id(), 'woocommerce_single' );
		//$images[] = $images_src[0];
			
		$thumb_v_html = '<div class="modal_thumb wc_gallery_more"><img src="'.$images_src[0].'"><svg width="24" height="24" fill="none"><use xlink:href="'.mweb_print_sprites_path().'#play-circle"></use></svg></div>';
		
		$slide_v_html = '<div class="swiper-slide"><div class="gallery_slider_video"><video poster="" controls="controls" id="gallery-video" src="'.$video_direct.'"><source src="'.$video_direct.'" type="video/mp4"> مرورگر شما از این ویدیو پشتیبانی نمی کند </video></div></div>';

	}

	if( $attachment_ids && $product->get_image_id() ) {
		//$count_img = count($attachment_ids);
		foreach ( $attachment_ids as $key => $attachment_id ) {
			
			$images_src = wp_get_attachment_image_src( $attachment_id, 'woocommerce_single' );
			$images[] = $images_src[0];
			if( $key > $ex_num )
				continue;
			$html_img = apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id ), $attachment_id ); 
			$html_img = str_replace('woocommerce-product-gallery__image', 'wc_gallery_image', $html_img);
			if( $key == $ex_num ){
				$html_img = str_replace('wc_gallery_image', 'wc_gallery_image wc_gallery_more', $html_img);
				$html_img = str_replace('</a>', '<svg width="24" height="24" fill="none"><use xlink:href="'.mweb_print_sprites_path().'#more"></use></svg></a>', $html_img);
			}
			$thumbs_html.= $html_img;
		}
		/* $srcValues = array();

		preg_match_all('/<img[^>]+src="([^"]+)"/i', $thumbs_html, $matches);

		if (isset($matches[1])) {
			$srcValues = $matches[1];
		} */
	}
	
?>
	
<div class="thumbnails" data-thumbs="<?= wc_esc_json(wp_json_encode($images)); ?>">
	<div class="product-thumbs-static">
		<?= $thumbs_html ?>
	</div>
</div>


<script type="text/template" id="tmpl-gallery-template">
	<div id="wc_gallery_wrap" class="modal">
	<h6 class="modal_title">گالری تصاویر</h6>
	<div class="row">
		<div class="col-12 col-sm-7 swiper-slider-arrows-fixed-yes">
			<div class="swiper product-modal-images" dir="rtl">
				<div class="swiper-wrapper">
				<?= $slide_v_html ?>
				  <% for (var i = 0; i < imageList.length; i++) { %>
					<div class="swiper-slide">
					  <img src="<%= imageList[i] %>">
					</div>
				  <% } %>
				</div>
				<div class="mweb-swiper-next"><svg width="24" height="24" fill="none"><use xlink:href="<?= mweb_print_sprites_path() ?>#arrow-right-1"></use></svg></div>
				<div class="mweb-swiper-prev"><svg width="24" height="24" fill="none"><use xlink:href="<?= mweb_print_sprites_path() ?>#arrow-left-1"></use></svg></div>
			</div>
		</div>
		<div class="col-12 col-sm-5 gallery_modal_grid">
			<?= $thumb_v_html ?>
			<% for (var i = 0; i < imageList.length; i++) { %>
				<div class="modal_thumb">
				  <img src="<%= imageList[i] %>">
				</div>
			<% } %>
		</div>
	</div>
	</div>
</script>

<script type="text/javascript">
	(function($) {
		"use strict";
		$(document).ready(function() {
			$('.product-images-static img').on('click', function (e) {
				e.preventDefault();	
				init_popup_gallery($(this), 0);				
			});
			$('.wc_gallery_image').on('click', function (e) {
				e.preventDefault();	
				init_popup_gallery($(this));
			});
			
			function init_popup_gallery( el_this, el_offset = 1) {
				//e.preventDefault();	
				//var el_this = $(this);
				//var el_offset = 1;
				var el_images = $('.thumbnails').data('thumbs');
				if( $('.thumbnails').find('.is_video').length ){
					if( el_this.hasClass('is_video') )
						el_offset = 0;
					var el_slto = el_this.hasClass('wc_gallery_image') ? el_this.index() + el_offset : el_offset + 1;
				} else {
					var el_slto = el_this.hasClass('wc_gallery_image') ? el_this.index() + el_offset : el_offset;
				}
				
				
				var template = document.getElementById("tmpl-gallery-template").innerHTML;

				// Create the gallery HTML using the template and imageList
				var renderedTemplate = _.template(template)({ imageList: el_images });
				
				$(renderedTemplate).appendTo('body').modal();

				$('#wc_gallery_wrap').on($.modal.BEFORE_CLOSE, function(event, modal) {
					$(this).remove();
				});
				var swiper = new Swiper(".product-modal-images", {
				  navigation: {
					nextEl: ".mweb-swiper-next",
					prevEl: ".mweb-swiper-prev"
				  }
				});
				$('#wc_gallery_wrap').on($.modal.OPEN, function(event, modal) {
					swiper.slideTo(el_slto);
					$('.modal_thumb:eq(' + swiper.activeIndex + ')').addClass('is_active');
				});
				
				$('.modal_thumb').on('click', function (e) {
					$('.modal_thumb').removeClass('is_active');
					$(this).addClass('is_active');
					swiper.slideTo($(this).index());
				});
				swiper.on('slideChange',  function (e) {
					$('.modal_thumb').removeClass('is_active');
					$('.modal_thumb:eq(' + swiper.activeIndex + ')').addClass('is_active');
					if( $('#gallery-video').length )
						$('#gallery-video').get(0).pause();
				});
			}
			
		   
		});
	})(jQuery);
</script>

<?php if(!isset($is_elm)){
	mweb_deal_countdown_timer('single_dailydeal');
} ?>					
