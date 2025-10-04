<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$mweb_sidebar_position = mweb_theme_util::get_theme_option('product_archive_sidebar_position' );
$desc_bottom = mweb_theme_util::get_theme_option('archive_desc_bottom' );
$disable_sidebar_mobile = mweb_theme_util::get_theme_option('disable_sidebar_mobile' );


$active_sub_categories = mweb_theme_util::get_theme_option('active_sub_categories' );
$position_sub_categories = mweb_theme_util::get_theme_option('position_sub_categories' );


$mweb_wrap_col = 'col-lg-9 content-with-sidebar';
if($mweb_sidebar_position =='default'){
	$mweb_sidebar_position = 'right';
}elseif($mweb_sidebar_position == 'none') {
	$mweb_wrap_col = 'col-lg-12 content-without-sidebar';
} 


$loop_name = apply_filters('mweb_mobile_loop_name_archive', 'product');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

if($active_sub_categories == true && $position_sub_categories == 'is_top')
	mweb_get_subcategories_in_archive_product(9, 'is_top');


echo '<div class="row is-sidebar-'.$mweb_sidebar_position.'">';
echo '<div class="content-wrap col-12 col-sm-12 col-md-12 '.$mweb_wrap_col.'">';

?>
<header class="woocommerce-products-header block-title">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title title"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#document"></use></svg><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>
</header>

<?php

	if( $active_sub_categories == true && $position_sub_categories == 'is_down' )
		mweb_get_subcategories_in_archive_product(6, 'is_down');

	ob_start();
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	$my_desc = ob_get_clean();
?>
<?php if( !empty( $my_desc ) && !$desc_bottom ){ ?>
<div class="term-description-wrap">
	<?= $my_desc; ?>
	<div class="loadmore">اطلاعات بیشتر ...</div>
</div>
<?php } ?>

<?php


if ( woocommerce_product_loop() ) {

	echo '<div class="shop-control-bar clear">';

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked wc_print_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );
	
	echo '</div>';
	
	?>
	<?php if ( is_active_sidebar( 'filter_sidebar' ) && false ) : 
	
		$data_setting = array();

		$data_setting['slidesPerView'] = 1;
		$data_setting['spaceBetween'] = 0;
		$data_setting['watchSlidesVisibility'] = true;
		$data_setting['loop'] = false;
		$data_setting['autoplay'] = false;
		$data_setting['touchMoveStopPropagation'] = true;
		//$data_setting['navigation'] = array('nextEl' => '.mweb-swiper-next', 'prevEl' => '.mweb-swiper-prev' );

		$data_setting['breakpoints'] = array('575' => array('slidesPerView' => 1), '768' => array('slidesPerView' => 2), '1024' => array('slidesPerView' => 4));
		
	?>
		<div class="wd_filter_wrap mweb-swiper">
			<div class="swiper-slider swiper-container" dir='rtl' data-slider="<?= esc_attr(wp_json_encode($data_setting)); ?>">
				<div class="swiper-wrapper">
					<?php dynamic_sidebar( 'filter_sidebar' ); ?>
					<?php 
						if(is_yith_wcan_activated()){
							$args = array(
								'before_widget' => '<div class="swiper-slide"><div id="yith-woo-ajax-reset-navigation" class="widget wd_filter %s">', 
								'after_widget' => '</div></div>',
								'before_title' => '<div class="wd_title">',
								'after_title' => '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#add-circle"></use></svg></div>'
								);
							$instance = array(
								'title' => 'حذف فیلتر ها',
								'label' => 'بازنشانی تمام فیلترها',
								'custom_style' => 0,
								);
							the_widget( 'YITH_WCAN_Reset_Navigation_Widget_Premium', $instance, $args ); 
						}
					?>
					
				</div>
			</div>
		</div>
		
	<?php endif; ?>

	
	<?php
	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 *
			 * @hooked WC_Structured_Data::generate_product_data() - 10
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', $loop_name );
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

if( !empty( $my_desc ) && $desc_bottom ){ ?>
	<div class="term-description-wrap">
	<?php echo $my_desc; ?>
	<div class="loadmore">اطلاعات بیشتر ...</div>
	</div>
<?php } 


echo '</div>';

if( $mweb_sidebar_position != 'none' ){

	if($disable_sidebar_mobile && wp_is_mobile()){
		// new sidebar in update
	}else{
		
		/**
		 * Hook: woocommerce_sidebar.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
		
	}
	

}
echo '</div>';


/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
