<?php
/**
 * Compare Template
 *
 * @author mahdisweb
 * @package /templates/shop
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $post; ?>
    
<?php if( ! empty( $products ) ) : ?>

<?php 

$fields = array();
$product_ids = array();
$product_atts = array();
foreach( $products as $product ) {
	$product_ids[] = $product->get_id();
	if( is_object($product) ){
		
		$product_attributes = array();
 
		// Display weight and dimensions before attribute list.
		$display_dimensions = apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() );
	 
		if ( $display_dimensions && $product->has_weight() ) {
			$product_attributes['weight'] = array(
				'label' => __( 'Weight', 'woocommerce' ),
				'value' => wc_format_weight( $product->get_weight() ),
			);
		}
	 
		if ( $display_dimensions && $product->has_dimensions() ) {
			$product_attributes['dimensions'] = array(
				'label' => __( 'Dimensions', 'woocommerce' ),
				'value' => wc_format_dimensions( $product->get_dimensions( false ) ),
			);
		}
	 
		// Add product attributes to list.
		$attributes = array_filter( $product->get_attributes(), 'wc_attributes_array_filter_visible' );
	 
		foreach ( $attributes as $attribute ) {
			$values = array();
	 
			if ( $attribute->is_taxonomy() ) {
				$attribute_taxonomy = $attribute->get_taxonomy_object();
				$attribute_values   = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );
	 
				foreach ( $attribute_values as $attribute_value ) {
					$value_name = esc_html( $attribute_value->name );
	 
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
	 
			$product_attributes[ 'attribute_' . sanitize_title_with_dashes( $attribute->get_name() ) ] = array(
				'label' => wc_attribute_label( $attribute->get_name() ),
				'value' => apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values ),
			);
		}
		
 	
		$product_attributes = apply_filters( 'woocommerce_display_product_attributes', $product_attributes, $product );
		$product_atts[$product->get_id()] = $product_attributes;
		foreach ( $product_attributes as $attribute_id => $attribute ) {
			if ( !isset( $fields[$attribute_id] ) ) {
					$fields[$attribute_id] =  $attribute;
			}
		}
	}
}




$has_weight = $has_dimensions = '';
$flag_weight = $flag_dimensions = false;
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
				
				foreach ($fields as $key => $attribute) {
					 
					$key_slug = substr($key, 10);

					if(is_object($attribute_in_group) && $attribute_in_group->slug == $key_slug){
							//unset($attributes[$attribute['name']]);
						
						$temp[$attribute_group_name]['name'] = $attribute_group_name;
						$temp[$attribute_group_name]['icon'] = $icon;
						$temp[$attribute_group_name]['attributes'][$key] = $attribute;
						$haveGroup[$key] = $attribute;
					} /* else {
						$donthaveGroup[$key_slug] = $attribute;
					} */
				} 
			}
		}
	}
} else {
	$temp = $fields;
}

foreach ($fields as $key => $attribute) {
	if(!isset($haveGroup[$key])){
		$temp['other']['name'] = __('سایر مشخصات', 'mweb');
		$temp['other']['icon'] = '<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-square-left"></use></svg>';
		$temp['other']['attributes'][$key] = $attribute;
	}
} 

?>
<div class="table-compare-warp">

    <table class="table table-compare compare-list">
        
		
		<thead>
			<tr>
				<th><?php echo esc_html__( 'محصول', 'mweb' ); ?></th>
				<?php foreach( $products as $key => $product ) : ?>
					<?php $product_id = $product->get_id(); ?>
				<td>
					<a href="<?php echo get_permalink( $product_id ); ?>" class="product">
						<div class="product-image">
							<div class="image">
								<?php 
									if( has_post_thumbnail( $product_id ) ) {
										echo get_the_post_thumbnail( $product_id, 'shop_catalog' );
									} elseif( wc_placeholder_img_src() ) {
										echo wc_placeholder_img( 'shop_catalog' );
									}
								?>
							</div>
						</div>
						<div class="product-info">
							<h3 class="product-title"><?php echo esc_html( $product->get_title() ); ?></h3>
							<span>مشاهده و خرید محصول</span>
						</div>
					</a>
				</td>
			
				<?php 
					if($product->has_weight()){
						$has_weight .= sprintf( '<td class="attribute_value"><p>%s</p></td>', esc_html( wc_format_localized_decimal( $product->get_weight() ) . ' ' . esc_attr( get_option( 'woocommerce_weight_unit' ) ) ) );
						$flag_weight = true;
					}else{
						$has_weight .= '<td class="wc_placeholder_text"></td>';
					}
						
					if($product->has_dimensions()){
						$dimensions = function_exists( 'wc_format_dimensions' ) ? wc_format_dimensions( $product->get_dimensions(false) ) : $product->get_dimensions();
						$has_dimensions .= sprintf( '<td class="attribute_value"><p>%s</p></td>', esc_html( $dimensions ) );
						$flag_dimensions = true;
					}
					else{
						$has_dimensions .= '<td class="wc_placeholder_text"></td>';
					}

				?>
				<?php endforeach; ?>
				
				
				<?php $emp = 4 - count($products);
				if($emp){
					for($i=1 ; $i <= $emp ; $i++){
						//$mweb_src_no_image = wc_placeholder_img_src();
                        //printf('<td class="compare_placeholder"><div class="product-image"><div class="image">%s</div></div><div class="product-info"><h3 class="product-title wc_placeholder_text"></h3></div></td>',wc_placeholder_img( 'shop_catalog' )); 
                        print('<td class="compare_placeholder"><a href="#compare-form" rel="modal:open" class="add_to_compare_wrap"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#mouse-circle"></use></svg><p>برای افزودن به لیست مقایسه کلیک کنید</p><span>افزودن کالا به مقایسه</span></a></td>'); 
					}
				}
				?>
				
				
			</tr>
		</thead>
			
        <tbody>

            
            <tr>
                <th><?php echo esc_html__( 'قیمت', 'mweb' ); ?></th>
                <?php foreach( $products as $key => $product ) : ?>
                <td>
                    <div class="product-price price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
                </td>
                <?php endforeach; ?>
				
				<?php $emp = 4 - count($products);
				if($emp){
					for($i=1 ; $i <= $emp ; $i++){
                        echo '<td class="wc_placeholder_text"><div class="product-price price"></div></td>'; 
					}
				}
				?>
            </tr>

            <tr>
                <th><?php echo esc_html__( 'موجودی', 'mweb' ); ?></th>
                <?php foreach( $products as $key => $product ) :
						$stock_class = 'out-of-stock';
						$availability = $product->get_availability();
							if ( empty( $availability['availability'] ) ) {
								$availability['availability'] = __( 'In stock', 'woocommerce' );
								$stock_class = 'in-stock';
							}
						?>
                <td><?php echo sprintf( '<span class="%s">%s</span>', $stock_class , esc_html( $availability['availability'] ) ); ?></td>
                <?php endforeach; ?>
				<?php $emp = 4 - count($products);
				if($emp){
					for($i=1 ; $i <= $emp ; $i++){
                        echo '<td class="wc_placeholder_text"></td>'; 
					}
				}
				?>
            </tr>

            <tr>
                <th><?php echo esc_html__( 'توضیحات', 'mweb' ); ?></th>
                <?php foreach( $products as $key => $product ) : ?>
                <td><?php echo wp_kses_post( $product->get_short_description() ); ?></td>
                <?php endforeach; ?>
				
				<?php $emp = 4 - count($products);
				if($emp){
					for($i=1 ; $i <= $emp ; $i++){
                        echo '<td class="wc_placeholder_text"></td>'; 
					}
				}
				?>
            </tr>
			
			
			<?php
			foreach ($temp as $key => $attribute_group) :

				$alt = 1;

				if(isset($attribute_group['attributes'])){
				?>
					<tr class="attribute_group_row attribute_group_row_defined">
					<?php
					echo '<th class="attribute_group_name" colspan="5">';
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


				<?php
				/* if( !is_array($attribute_group['attributes'])) {
					continue;
				} */
				
				//print_r($attribute_group);

				foreach ( $attribute_group['attributes'] as $key => $attribute ) {
					if ( ( $alt = $alt * -1 ) == 1 ){
						echo ' <tr class="alt">'; }
					else { 
						echo ' <tr>';
					}
						echo '<th class="attribute_name">' . $attribute['label'] . '</th>';
					foreach( $products as $ky => $product ) {
						$myarray = $product_atts[$ky];
						echo isset($myarray[$key]) ? '<td class="attribute_value">' . $myarray[$key]['value'] . '</td>' : '<td class="wc_placeholder_text"></td>';
					}
					//echo '</tr>';
					
					
					$emp = 4 - count($products);
					if($emp){
						for($i=1 ; $i <= $emp ; $i++){
							echo '<td class="wc_placeholder_text"></td>'; 
						}
					}
				}
				
					echo '</tr>';
			
			endforeach;
			?>
			
			<?php if($flag_weight == true){ ?>
			<tr>
                <th class="attribute_name">وزن</th>
                <?php echo $has_weight; ?>
				<?php $emp = 4 - count($products);
				if($emp){
					for($i=1 ; $i <= $emp ; $i++){
                        echo '<td class="wc_placeholder_text"></td>'; 
					}
				}
				?>
            </tr>
			<?php } ?>
			
			<?php if($flag_dimensions == true){ ?>
			<tr>
                <th class="attribute_name">ابعاد</th>
                <?php echo $has_dimensions; ?>
				<?php $emp = 4 - count($products);
				if($emp){
					for($i=1 ; $i <= $emp ; $i++){
                        echo '<td class="wc_placeholder_text"></td>'; 
					}
				}
				?>
            </tr>
			<?php } ?>
			
            <tr>
                <th>&nbsp;</th>
                <?php foreach( $products as $i => $product ) : ?>
                <td class="text-center remove-item">
                   <?php 
                        echo '<a class="remove-icon mweb-remove-compare" data-action="remove" data-pid="'.$i.'" title="حذف" href="javascript:void(0);">&times;</a>';
                    ?>
                </td>
                <?php endforeach ?>
				<?php $emp = 4 - count($products);
				if($emp){
					for($i=1 ; $i <= $emp ; $i++){
                        echo '<td class="wc_placeholder_text"></td>'; 
					}
				}
				?>
            </tr>

        </tbody>
    </table>

</div> 

<div id="compare-form" class="modal compare_search_wrap">

<?php 
$keys = array_keys( $products );
$first_product = array_shift( $keys );
$compare_category = mweb_theme_util::get_theme_option('compare_category');
if( $compare_category == 'last' ){
	$main_cat = mweb_get_parent_category_list($first_product);
	$main_cat = array_shift($main_cat);
}else{
	$main_cat = mweb_get_product_last_level_of_category($first_product);
}
?>
	<form class="search_wrap" id="compare_search_product" >
		<i class="search_clear">&times;</i>
		<i class="search_icon"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#search"></use></svg></i>
		<input type="text" id="search-cmp" class="search-field" value="" name="product" data-category="<?= $main_cat->term_id ?>" placeholder="کلید واژه مورد نظر ...">
		<div class="search_in">دسته : <span><?= $main_cat->name ?></span></div>
	</form>
<?php	
$query_options = array('category_id' => $main_cat->term_id, 'posts_per_page' => 10, 'post_not_in' => $product_ids, 'post_type' => 'product' );
$query_data = mweb_theme_query::get_custom_query( $query_options );
if ( $query_data->have_posts() ) {
	echo '<div id="compare_product_list">';
	echo '<div class="row">';
	while ( $query_data->have_posts() ) : 
		$query_data->the_post();
			?>
			<div class="item item_simple col-12 col-sm-6">
			<?php echo mweb_loop_template_product_simple_compare(); ?>
			</div>
	<?php endwhile;
	echo '</div></div>';
} else {
	echo mweb_no_content();
}
//reset post data
wp_reset_postdata();

?>

</div>


<?php else : ?>

	<?php echo mweb_error('جدول مقایسه خالی می باشد'); ?>
   
<?php endif; ?>


