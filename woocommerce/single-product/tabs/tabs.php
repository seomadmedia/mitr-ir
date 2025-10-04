<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.8.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
 

$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );
$icons = array(
	'description' => 'document-text',
	'additional_information' => 'setting-3',
	'reviews' => 'message',
	'questions' => 'message-question',
	'review_p_tab' => 'mouse-circle',
	'all' => 'message-text-1',
);

$tab_style = mweb_theme_util::get_theme_option('mweb_product_tab_style'); 
		
if( !empty($tab_style) ){
	$tab_class = $tab_style == 'none' ? 'style_tabs_default' : 'style_'.$tab_style;
}

if( isset($tab_fixed) && wp_is_mobile() ){
	$tab_class = 'style_tabs_one wc_fixed_tab';
}

if ( ! empty( $product_tabs ) ) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper <?= $tab_class ?><?= !empty($scroll) ? ' scroll_wc_tab' : ''; ?>">
		<?php if( !isset($remove_tabs) ){ ?>
			<ul class="tabs wc-tabs scrolling-wrapper<?= !empty($scroll) ? ' scroll_wc_ul' : ''; ?>" role="tablist">
				<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
					<li role="presentation" class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>">
						<a href="#tab-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
							<?php $tab_icon = array_key_exists($key, $icons) ? $icons[$key] : $icons['all'];
							echo '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#'.$tab_icon.'"></use></svg>';
							?>
							<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php } ?>
		<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
				<?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
				?>
			</div>
		<?php endforeach; ?>

		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>

<?php endif; ?>
