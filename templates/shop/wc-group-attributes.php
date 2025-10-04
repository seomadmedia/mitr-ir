<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/* global $woocommerce_group_attributes_options;*/
$divider = '|';
global $post, $product;
$has_row    = false;
$alt        = 1;
$alt2 		= 1;
$attributes = $product->get_attributes();

// Reassmble the attributes variable
// Add the grouped attributes
$args = array( 'posts_per_page' => -1, 'post_type' => 'attribute_group', 'post_status' => 'publish', 'orderby' => 'menu_order', 'suppress_filters' => 0);

$attribute_groups = get_posts( $args );
$temp = array();
$haveGroup = array();
if(!empty($attribute_groups)){
	foreach ($attribute_groups as $attribute_group) {

		// Attribut Group Name
		$attribute_group_name = $attribute_group->post_title;

		// Attribut Group Image
		$attributeGroupIcon = get_post_meta($attribute_group->ID, 'woocommerce_group_attributes_icon' , true);
		$icon = "";
		if(!empty($attributeGroupIcon)){
			$icon = $attributeGroupIcon;
		}else{
			$icon = '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-square-left"></use></svg>';
		}

		$attributes_in_group = get_post_meta($attribute_group->ID, 'woocommerce_group_attributes_attributes');
		
		if(is_array($attributes_in_group[0])) {
			$attributes_in_group = $attributes_in_group[0];
		} else {
			$attributes_in_group = $attributes_in_group;
		}

		if(!empty($attributes_in_group)){
			foreach ($attributes_in_group as $attribute_in_group) {

				$attribute_in_group = wc_get_attribute($attribute_in_group);

				foreach ($attributes as $attribute) {

					if($attribute['is_visible'] == 0){ 
						continue;
					}

					if(is_object($attribute_in_group) && $attribute_in_group->slug == $attribute['name']){
						//if($woocommerce_group_attributes_options['multipleAttributesInGroups'] !== "1") {
							unset($attributes[$attribute['name']]);
						//}
						
						$temp[$attribute_group_name]['name'] = $attribute_group_name;
						$temp[$attribute_group_name]['icon'] = $icon;
						$temp[$attribute_group_name]['attributes'][] = $attribute;
						$haveGroup[] = $attribute['name'];
					} else {
						$temp[$attribute['name']] = $attribute;
					}
				}
			}
		}
	}
} else {
	$temp = $attributes;
}

foreach ($temp as $asd) {
	if(is_array($asd)) {
		continue;
	}
	$name = $asd->get_name();
	if(!in_array($name, $haveGroup)){
		$temp['other']['name'] = __('سایر مشخصات', 'mweb');
		$temp['other']['icon'] = '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-square-left"></use></svg>';
		$temp['other']['attributes'][] = $asd;
	}
	
	unset($temp[$name]);
}
ob_start();

?>
<table class="shop_attributes">

	<?php
	foreach ($temp as $key => $attribute_group) :

		$alt = 1;

		if(isset($attribute_group['attributes'])){
		?>
			<tr class="attribute_group_row attribute_group_row_defined">
			<?php
			echo '<th class="attribute_group_name" colspan="2">';
				if(isset($attribute_group['icon']) && !empty($attribute_group['icon'])){
					echo $attribute_group['icon'];
				}
				echo __($attribute_group['name']);
			echo '</th>';
			echo "</tr>";
		} else {
			$attribute_group['attributes'][] = $attribute_group;
		}
		?>

		<tr class="attribute_row attribute_row_list">
			<td>
				<table class="attribute_name_values">
				<?php
				if(!is_array($attribute_group['attributes'])) {
					continue;
				}
				ksort($attribute_group['attributes']);

				foreach ( $attribute_group['attributes'] as $attribute ) {
					if ( empty( $attribute['is_visible'] ) || ( $attribute['is_taxonomy'] && ! taxonomy_exists( $attribute['name'] ) ) ) {
						continue;
					} else {
						$has_row = true;
					}

					if ( ( $alt = $alt * -1 ) == 1 ){
						echo ' <tr class="alt">'; }
					else { 
						echo ' <tr>';
					}

					$hasImage = apply_filters('woocommerce_attribute_name_image', wc_attribute_label( $attribute->get_name() ), $attribute->get_id()); 
					if($hasImage) {
						$attribute_name = $hasImage;
					} else {
						$attribute_name = wc_attribute_label( $attribute->get_name() );
					}

						echo '<th class="attribute_name">' . $attribute_name . '</th>';

						echo '<td class="attribute_value">';

						$values = array();
						if ( $attribute->is_taxonomy() ) {
							$attribute_taxonomy = $attribute->get_taxonomy_object();
							$attribute_values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

							foreach ( $attribute_values as $attribute_value ) {

								$hasImage = apply_filters('woocommerce_attribute_value_image', esc_html( $attribute_value->name ), $attribute_value->term_id);
								if(!empty($hasImage)) {
									$value_name = $hasImage;
								} else {
									$value_name = esc_html( $attribute_value->name );
								}
								
								if ( $attribute_taxonomy->attribute_public ) {
									$values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name . '</a>';
								} else {
									$values[] = $value_name;
								}
							}
						} else {
							$values = $attribute->get_options();

							foreach ( $values as &$value ) {
								$value = make_clickable( esc_html( $value ) );
							}
						}

						echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( $divider, $values ) ) ), $attribute, $values );
						echo '</td>';
					echo '</tr>';
				}
				echo '</table>';
				?>
			</td>
		</tr>
		<?php
	endforeach;
	?>

	<?php if ( $product->has_weight() ) : ?>
		<tr class="attribute_row attribute_we_di">
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

	<?php if ( $product->has_dimensions() ) : ?>
		<tr class="attribute_row attribute_we_di">
			<td>
				<table class="attribute_name_values">
					<tr class="<?php if ( ( $alt = $alt * -1 ) == 1 ) echo 'alt'; ?>">
						<th class="attribute_name"><?php _e( 'Dimensions', 'woocommerce' ) ?></th>
						<td class="attribute_value product_weight"><?php echo esc_html( wc_format_dimensions( $product->get_dimensions( false ) ) ); ?></td>
					</tr>
				</table>
			</td>
		</tr>
	<?php endif; ?>

</table>
<?php
if ( $has_row ) {
	echo ob_get_clean();
} else {
	ob_end_clean();
}
