<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.7.0
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form class="woocommerce-ordering" method="get">
	<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#document-filter"></use></svg>
	<select
		name="orderby"
		class="orderby"
		<?php if ( $use_label ) : ?>
			id="woocommerce-orderby-<?php echo esc_attr( $id_suffix ); ?>"
		<?php else : ?>
			aria-label="<?php esc_attr_e( 'Shop order', 'woocommerce' ); ?>"
		<?php endif; ?>
	>
		<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
		<?php endforeach; ?>
	</select>
	<div class="el-instock-switch">
		<?php
		$in_stock_only = isset($_GET['in_stock']) ? $_GET['in_stock'] : '';
        $checked = $in_stock_only ? 'checked' : '';
		?>
		<label class="ui_input_switch">
		<input type="checkbox" name="in_stock" value="1" <?php echo $checked; ?>>
		<span class="slider"></span>
		</label><p>کالاهای موجود</p>
	</div>
	<input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page', 'in_stock' ) ); ?>
</form>
