<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$price_html = $product->get_price_html();
if( $product->is_type( 'variable' ) ){
	$variations = $product->get_available_variations();
	$count = count( $variations );
	if( $count > 1 )
		$price_html == '';

	
}
echo '<div class="'. esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ) .'">'. $price_html .'</div>';
do_action( 'mweb_jewel_variation_price_detail', $product );



