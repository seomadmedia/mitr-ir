<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}



$gallery_dir = mweb_theme_util::get_theme_option('mweb_product_picmode');
if( empty($gallery_dir) || $gallery_dir == 'horizontal' ){
	$gallery_dir = 'horizontal';
	$gallery_dir_class = 'gallery_type_h';
	$gallery_img_col = 'col-12 col-sm-12 col-md-12 col-lg-4'; // horizontal
	$gallery_thumb_col = 'col-12 col-sm-12 col-md-12 col-lg-8'; // horizontal

}else{
	$gallery_dir = 'vertical';
	$gallery_dir_class = 'gallery_type_v';
	$gallery_img_col = 'col-12 col-sm-12 col-md-12 col-lg-4'; // vertical
	$gallery_thumb_col = 'col-12 col-sm-12 col-md-12 col-lg-8'; // vertical
}
add_action('woocommerce_after_add_to_cart_form', 'display_warranty_options');


?>


<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

	<div class="primary_block row clearfix">
		<div class="entry-img single_p_gallery <?= $gallery_dir_class ?> <?= $gallery_img_col ?>" data-direction="<?= $gallery_dir ?>">
			<div class="inner">
			<?php
			
				// vertical or horizontal
				
				/**
				 * woocommerce_before_single_product_summary hook
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action( 'woocommerce_before_single_product_summary' );
			?>
			</div>
		</div>
		<div class="summary entry-summary <?= $gallery_thumb_col ?>">
		<div class="single_product_head">

			<?php
				/**
				 * Hook: woocommerce_single_product_summary.
				 *
				 * @hooked woocommerce_template_single_title - 5
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_price - 10
				 * @hooked woocommerce_template_single_excerpt - 20
				 * @hooked woocommerce_template_single_add_to_cart - 30
				 * @hooked woocommerce_template_single_meta - 40
				 * @hooked woocommerce_template_single_sharing - 50
				 * @hooked WC_Structured_Data::generate_product_data() - 60
				 */


				$single_style = mweb_theme_util::get_theme_option('mweb_product_single_style');
				if($single_style == 'none' || $single_style == 'p_style_one'){
					remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
					remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

					add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 29);
					
					add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10);
				}else{
					remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
					remove_action('woocommerce_single_product_summary', 'mweb_add_line_product_summary', 11);
					remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
					remove_action('woocommerce_single_product_summary', 'mweb_add_custom_field_product_summary', 41);
					//remove_action('woocommerce_single_product_summary', 'mweb_product_info_box' , 50 );    

					add_action('woocommerce_single_product_summary', 'mweb_add_line_product_summary_type_two' , 11);
					add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10);
					add_action('woocommerce_single_product_summary', 'mweb_add_custom_field_product_summary', 21);
					add_action('woocommerce_single_product_summary', 'mweb_cart_end_product_summary', 21);
					add_action('woocommerce_single_product_summary', 'mweb_cart_start_product_summary', 21);
					
					add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 29);
				}
				
				
				do_action( 'woocommerce_single_product_summary' );

			?>

		</div>
		
		<?php //mweb_woocommerce::mweb_product_info_box(); ?>

	</div>
	

</div><!-- #product-<?php the_ID(); ?> -->

<?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */

		do_action( 'woocommerce_after_single_product_summary' );
	?>

<?php 
$mweb_product_recently_viewed = mweb_theme_util::get_theme_option('mweb_product_recently_viewed' );
if($mweb_product_recently_viewed == true){
	
	echo mweb_get_recently_viewed_product();
 
}
?>

<?php do_action( 'woocommerce_after_single_product' ); ?>
