<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-attributes.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! $product_attributes ) {
	return;
}


$divider = '<br>';
global $post, $product;
$has_row    = true;
$is_table   = mweb_theme_util::get_theme_option('mweb_attr_type') == 'list' ? false : true;
$alt        = 1;
$alt2 		= 1;
//$attributes = array_filter( $product->get_attributes(), 'wc_attributes_array_filter_visible' );

$attr_total = 0;

$args = array( 'posts_per_page' => -1, 'post_type' => 'attribute_group', 'post_status' => 'publish', 'orderby' => 'menu_order', 'suppress_filters' => 0);

$attribute_groups = get_posts( $args );

$temp = array();
$haveGroup = array();
$donthaveGroup = array();
if(!empty($attribute_groups)){
	foreach ($attribute_groups as $attribute_group) {

		$attribute_group_name = $attribute_group->post_title;

		$attributeGroupIcon = get_post_meta($attribute_group->ID, 'woocommerce_group_attributes_icon' , true);
		$icon = "";
		if(!empty($attributeGroupIcon)){
			$icon = $attributeGroupIcon;
		}else{
			$icon = '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-square-left"></use></svg>';
		}

		$attributes_in_group = get_post_meta($attribute_group->ID, 'woocommerce_group_attributes_attributes');
				
		if( is_array($attributes_in_group[0]) ) {
			$attributes_in_group = $attributes_in_group[0];
		} else {
			$attributes_in_group = $attributes_in_group;
		}

		if( !empty($attributes_in_group) ){
			foreach ($attributes_in_group as $attribute_in_group) {

				$attribute_in_group = wc_get_attribute($attribute_in_group);
				
				if( !$attribute_in_group )
					continue;
				
				foreach ($product_attributes as $key => $attribute) {
					 
					$key_slug = substr($key, 10);

					if(is_object($attribute_in_group) && $attribute_in_group->slug == $key_slug){
						//unset($attributes[$attribute['name']]);
						
						$temp[$attribute_group_name]['name'] = $attribute_group_name;
						$temp[$attribute_group_name]['icon'] = $icon;
						$temp[$attribute_group_name]['attributes'][] = $attribute;
						$haveGroup[$key] = $attribute;
						$attr_total++;
						
					} /* else {
						$donthaveGroup[$key_slug] = $attribute;
					} */
				} 
			}
		}
	}
} else {
	$temp = $product_attributes;
}

foreach ($product_attributes as $key => $attribute) {
	if(!isset($haveGroup[$key])){
		$temp['other']['name'] = __('سایر مشخصات', 'mweb');
		$temp['other']['icon'] = '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-square-left"></use></svg>';
		$temp['other']['attributes'][] = $attribute;
		$attr_total++;
	}
} 

//print_r($temp);
$is_mobile  = wp_is_mobile();
$max_attrs  = apply_filters( 'mweb_max_mobile_attributes', 5 ); 

ob_start();
if( $is_table == true ):
?>
<table class="elm_pattr_wrap woocommerce-product-attributes shop_attributes" aria-label="<?php esc_attr_e( 'Product Details', 'woocommerce' ); ?>">
<?php
$attr_count = 0;
$alt        = 1;

foreach ( $temp as $key => $attribute_group ) :

	if ( isset( $attribute_group['attributes'] ) ) {
		$group_start_count = $attr_count + 1;
		$group_attr_count  = count( $attribute_group['attributes'] );
		$group_end_count   = $attr_count + $group_attr_count;

		$group_hide = ( $is_mobile && $group_start_count > $max_attrs ) ? ' hide' : '';

		echo '<tr class="attribute_group_row attribute_group_row_defined' . $group_hide . '">';
		echo '<th class="attribute_group_name" colspan="2">';
		if ( ! empty( $attribute_group['icon'] ) ) {
			echo $attribute_group['icon'];
		}
		echo esc_html( $attribute_group['name'] );
		echo '</th>';
		echo '</tr>';

	} else {
		$attribute_group['attributes'][] = $attribute_group;
		$group_hide = '';
	}

	echo '<tr class="attribute_row attribute_row_list' . $group_hide . '">';
	echo '<td><table class="attribute_name_values">';

	if ( ! is_array( $attribute_group['attributes'] ) ) {
		continue;
	}

	foreach ( $attribute_group['attributes'] as $attribute ) {
		$attr_count++;

		// کلاس hide برای ویژگی‌های بعد از max_attrs روی موبایل
		$extra_class = ( $is_mobile && $attr_count > $max_attrs ) ? ' hide' : '';

		$alt = $alt * -1;
		$row_class = $alt == 1 ? ' class="alt' . $extra_class . '"' : ' class="' . $extra_class . '"';

		echo "<tr{$row_class}>";
		echo '<th class="attribute_name">' . esc_html( $attribute['label'] ) . '</th>';
		echo '<td class="attribute_value"> ' . wp_kses_post( $attribute['value'] ) . ' </td>';
		echo '</tr>';
	}

	echo '</table></td></tr>';

endforeach;
?>
<?php 
if ( false &&  $product->has_weight() ) : 
    $attr_count++;
    $group_hide = ( $is_mobile && $attr_count > $max_attrs ) ? true : false;
    ?>
    <tr class="attribute_row attribute_we<?php echo $group_hide ? ' hide' : ''; ?>">
        <td>
            <table class="attribute_name_values">
                <tr class="<?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt'; ?>">
                    <th class="attribute_name"><?php _e( 'Weight', 'woocommerce' ) ?></th>
                    <td class="attribute_value product_weight"><?php echo esc_html( wc_format_weight( $product->get_weight() ) ); ?></td>
                </tr>
            </table>
        </td>
    </tr>
<?php endif; ?>

<?php 
if ( false && $product->has_dimensions() ) : 
    $attr_count++;
    $group_hide = ( $is_mobile && $attr_count > $max_attrs ) ? true : false;
    ?>
    <tr class="attribute_row attribute_di<?php echo $group_hide ? ' hide' : ''; ?>">
        <td>
            <table class="attribute_name_values">
                <tr class="<?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt'; ?>">
                    <th class="attribute_name"><?php _e( 'Dimensions', 'woocommerce' ) ?></th>
                    <td class="attribute_value product_dimensions"><?php echo esc_html( wc_format_dimensions( $product->get_dimensions( false ) ) ); ?></td>
                </tr>
            </table>
        </td>
    </tr>
<?php endif; ?>

</table>

<?php
else : 
?>
<div class="elm_pattr_wrap product-attributes-wrapper" aria-label="<?php esc_attr_e( 'Product Details', 'woocommerce' ); ?>">
	<?php 
	
	$attr_count = 0; 

	foreach ( $temp as $key => $attribute_group ) : ?>
		<?php if ( isset( $attribute_group['attributes'] ) ) : ?>
			<?php
			$group_start_count = $attr_count + 1; 
			$group_attr_count  = count( $attribute_group['attributes'] );
			$group_end_count   = $attr_count + $group_attr_count;

			$group_hide = ( $is_mobile && $group_start_count > $max_attrs ) ? true : false;
			?>

			<div class="attribute-group<?php echo $group_hide ? ' hide' : ''; ?>">
				<div class="attribute-group-title">
					<?php
					if ( ! empty( $attribute_group['icon'] ) ) {
						echo $attribute_group['icon'];
					}
					echo '<b>' . esc_html( $attribute_group['name'] ) . '</b>';
					?>
				</div>

				<div class="attribute-items">
					<?php if ( is_array( $attribute_group['attributes'] ) ) : ?>
						<?php foreach ( $attribute_group['attributes'] as $attribute ) : 
							$attr_count++;
							$extra_class = ( $is_mobile && $attr_count > $max_attrs ) ? ' hide' : '';
						?>
						<div class="attribute-item<?php echo $extra_class; ?>">
							<div class="attribute-label"><?php echo esc_html( $attribute['label'] ); ?></div>
							<div class="attribute-value"><?php echo wp_kses_post( $attribute['value'] ); ?></div>
						</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		<?php else: ?>
			<?php
			$single = $attribute_group;
			$attr_count++;
			$group_hide = ( $is_mobile && $attr_count > $max_attrs ) ? true : false;
			?>
			<div class="attribute-group<?php echo $group_hide ? ' hide' : ''; ?>">
				<div class="attribute-items">
					<div class="attribute-item">
						<div class="attribute-label"><?php echo esc_html( $single['label'] ); ?></div>
						<div class="attribute-value"><?php echo wp_kses_post( $single['value'] ); ?></div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
<?php
endif; 

if( $is_mobile && $attr_total > $max_attrs ){
	echo '<div class="d-flex justify-content-center"><span class="wcad_show-all">مشاهده ادامه مشخصات <svg class="pack-fontawesome"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left-1"></use></svg></span></div>';
}

if ( $has_row ) {
	echo ob_get_clean();
} else {
	ob_end_clean();
}
