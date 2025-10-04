<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post , $product;

//$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'woocommerce' ) ) );
$content_style = mweb_theme_util::get_theme_option('mweb_toggle_content'); 
$hide_tags = mweb_theme_util::get_theme_option('mweb_hide_tags'); 
$p_subtitle = get_post_meta( get_the_ID(), '_product_subtitle', true );
$content_title = apply_filters('mweb_tab_content_title', true);
if( $content_title ){?>
<div class="tab_content_heading">
	<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#message-edit"></use></svg>
	<div class="heading_left">
		<span class="tab_h_title">نقد و بررسی اجمالی</span><span class="tab_h_desc"><?= $p_subtitle ?></span>
	</div>
</div>
<?php
}
if( $content_style == true ){
	echo '<div class="entry_content_inner">';
		the_content();
	echo '</div><div class="entry_content_more">نمایش <span>ادامه مطلب</span></div>';
}else{
	the_content();
}

?>

<?php 
if ( $hide_tags == true )
	echo wc_get_product_tag_list( $product->get_id(), ' ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' );
?>
