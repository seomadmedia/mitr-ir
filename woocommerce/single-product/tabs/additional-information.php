<?php
/**
 * Additional Information tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/additional-information.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$heading = esc_html( apply_filters( 'mweb_product_additional_information_heading', __( 'مشخصات کلی', 'mweb' ) ) );
$p_subtitle = get_post_meta( get_the_ID(), '_product_subtitle', true );
$content_title = apply_filters('mweb_tab_content_title', true);
?>

<?php if ( $heading && $content_title ) : ?>

<div class="tab_content_heading">
	<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#subtitle"></use></svg>
	<div class="heading_left">
		<span class="tab_h_title"><?php echo esc_html( $heading ); ?></span><span class="tab_h_desc"><?= $p_subtitle ?></span>
	</div>
</div>
<?php endif; ?>

<?php do_action( 'woocommerce_product_additional_information', $product ); ?>
