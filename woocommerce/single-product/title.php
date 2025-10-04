<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

echo '<h1 class="product_title entry-title">';
	the_title();
	$is_fake = get_post_meta( get_the_ID(), '_is_fake', true );
	if($is_fake == 'yes'){
		echo '<span class="is_fake_label">غیر اصل</span>';
	}
	$custom_label = get_post_meta( get_the_ID(), '_is_custom_label', true );
	if(!empty($custom_label)){
		echo '<span class="is_custom_label">'.$custom_label.'</span>';
	}
	$p_subtitle = get_post_meta( get_the_ID(), '_product_subtitle', true );
	if(!empty($p_subtitle)){
		echo '<span class="sub_head">'.$p_subtitle.'</span>';
	}
echo '</h1>';

