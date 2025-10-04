<?php

/* Custom Meta For Taxonomies */

/* Get field label */
if( !function_exists('mweb_get_field_label') ){
	function mweb_get_field_label( $field_id ){
		$labels = array(
			'<label>'.esc_html__( 'تصویر پس زمینه', 'mweb' ).'</label>'
		);
		/* $labels = array(
			'<label>'.esc_html__( 'تصویر پس زمینه:', 'mweb' ).'</label>',
			'<label>'.esc_html__( 'آیکن دسته', 'mweb' ).'</label>'
		); */

		return $labels[$field_id];
	}
}


/* Get field options for representative image */
if( !function_exists('mweb_get_rep_image_html') ){
	function mweb_get_rep_image_html( $image_id = '' ){
		return '<div class="mweb-image-wrap">'.( !empty( $image_id ) ? wp_get_attachment_image( $image_id, 'thumbnail' ) : '' ).'
			<input type="hidden" name="representative_image" value="'.( !empty( $image_id ) ? esc_attr( $image_id ) : '' ).'">
			<a href="#" class="select-image button">'.esc_html__( 'انتخاب تصویر', 'mweb' ).'</a>
			<a href="#" class="remove-image button '.( !empty( $image_id ) ? '' : 'hidden' ).'">'.esc_html__( 'حذف تصویر', 'mweb' ).'</a>
		</div>
		<p class="description">'.esc_html__( '','mweb' ).'</p>';
	}
}



/* Get field options for */
if( !function_exists('mweb_get_icon_html') ){
	function mweb_get_icon_html( $icon_id = '' ){
		return '<div class="mweb-image-wrap">
			'.( !empty( $icon_id ) ? wp_get_attachment_image( $icon_id, 'thumbnail' ) : '' ).'
			<input type="hidden" name="representative_icon" value="'.( !empty( $icon_id ) ? esc_attr( $icon_id ) : '' ).'">
			<a href="#" class="select-image button">'.esc_html__( 'انتخاب آیکن', 'mweb' ).'</a>
			<a href="#" class="remove-image button '.( !empty( $icon_id ) ? '' : 'hidden' ).'">'.esc_html__( 'حذف تصویر', 'mweb' ).'</a>
		</div>';
	}
}


/* Adding New */
if( !function_exists('mweb_category_img_add') ){
	function mweb_category_img_add() {
		echo '
		<div class="form-field">
			'.mweb_get_field_label( 0 ).'
			'.mweb_get_rep_image_html().'
		</div>
		';
	}
	add_action( 'product_cat_add_form_fields', 'mweb_category_img_add', 10, 2 );
}



/* Editing */
if( !function_exists('mweb_category_img_edit') ){
	function mweb_category_img_edit( $term ) {
		$image_id = get_term_meta( $term->term_id, 'representative_image', true);
		//$icon_id = get_term_meta( $term->term_id, 'representative_icon', true);
		?>
		<tr class="form-field form-required">
			<th scope="row"><?php echo mweb_get_field_label( 0 ) ?></th>
			<td><?php echo mweb_get_rep_image_html( $image_id ) ?></td>
		</tr>
		<?php
	}
	add_action( 'product_cat_edit_form_fields', 'mweb_category_img_edit', 10, 2 );
}



/* Save It */
if( !function_exists('mweb_category_img_save') ){
	function mweb_category_img_save( $term_id ) {

		if ( isset( $_POST['representative_image'] ) ) {
			update_term_meta( $term_id, 'representative_image', $_POST['representative_image'] );
		}
		
	}  
	add_action( 'edited_product_cat', 'mweb_category_img_save', 10, 2 );  
	add_action( 'create_product_cat', 'mweb_category_img_save', 10, 2 );
}



/* Delete meta */
if( !function_exists('mweb_category_img_delete') ){
	function mweb_category_img_delete( $term_id ) {
		delete_term_meta( $term_id, 'representative_image' );
	}  
	add_action( 'delete_product_cat', 'mweb_category_img_delete', 10, 2 );
}


?>