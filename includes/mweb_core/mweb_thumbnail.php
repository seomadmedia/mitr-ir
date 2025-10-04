<?php
		
/**
 * @param $size
 * @param bool $size_mobile
 * @param string $class_name
 *
 * @return string
 * render thumbnail
 */
if ( ! function_exists( 'mweb_post_thumb' ) ) {
	function mweb_post_thumb( $options ) {

		// get config
		$post_id = get_the_ID();
		if ( empty( $options['size'] ) ) {
			$options['size'] = apply_filters( 'single_product_archive_thumbnail_size', 'woocommerce_thumbnail' );
		}

		$class_name   = array();
		$class_name[] = 'is-image';
		if ( ! empty( $options['class_name'] ) ) {
			$class_name[] = $options['class_name'];
		}
		

		if ( ! empty( $options['size_mobile'] ) ) {
			$class_name[] = 'has-mobile-size';
		}
		
		if ( ! isset( $options['has_link'] ) ) {
			$options['has_link'] = true;
		}
		
		$class_name = implode( ' ', $class_name );

		// get full image
		$featured_id  = get_post_thumbnail_id( get_the_ID() );
		$featured_alt = get_post_meta( $featured_id, '_wp_attachment_image_alt', true );

		// get mobile image
		$attachment_full = wp_get_attachment_image_src( $featured_id, $options['size'] );

		// check lazyload
		$image_class = $data_attr = '';
		/* $lazy = apply_filters( 'mweb_lazy_status', false );
		if($lazy == true){
			$image_class .= 'class="lazy" ';
			$data_attr .= 'data-src="' . $attachment_full[0] . '" ';
		} */
		
		
		// render
		$str = '';
		if( !isset($options['nowrap']) )
			$str .= '<div class="' . esc_attr( $class_name ) . '">';
		$str .= $options['has_link'] == true ? '<a href="' . get_permalink() . '" title="' . esc_attr( get_the_title() ) . '" rel="bookmark">' : '';
		if ( empty( $options['size_mobile'] ) ) {
			if ( ! empty( $options['size_mobile_h'] ) ) {
				$attachment_mobile_h = wp_get_attachment_image_url( $featured_id, $options['size_mobile_h'] );
				if ( ! empty( $attachment_full[0] ) && ! empty( $attachment_full[1] ) && ! empty( $attachment_full[2] ) ) {
					$str .= '<img width="' . $attachment_full[1] . '" height="' . $attachment_full[2] . '" src="' . $attachment_full[0] . '" ';
					$str .= $image_class . $data_attr;
					$str .= 'srcset="' . $attachment_full[0] . ' 768w, ' . $attachment_mobile_h . ' 767w" ';
					$str .= 'sizes="(max-width: 767px) 33vw, 768px" alt="' . esc_attr( $featured_alt ) . '"/>';
				}
			} else {
				$str .= get_the_post_thumbnail( $post_id, $options['size'] );
			}
		} else {
			$attachment_mobile = wp_get_attachment_image_url( $featured_id, $options['size_mobile'] );
			if ( empty( $options['size_mobile_h'] ) ) {
				if ( ! empty( $attachment_full[0] ) && ! empty( $attachment_full[1] ) && ! empty( $attachment_full[2] ) ) {
					$str .= '<img width="' . $attachment_full[1] . '" height="' . $attachment_full[2] . '" src="' . $attachment_full[0] . '" ';
					$str .= $image_class . $data_attr;
					$str .= 'srcset="' . $attachment_full[0] . ' 480w, ' . $attachment_mobile . ' 479w" ';
					$str .= 'sizes="(max-width: 479px) 33vw, 480px" alt="' . esc_attr( $featured_alt ) . '"/>';
				}
			} else {
				$attachment_mobile_h = wp_get_attachment_image_url( $featured_id, $options['size_mobile_h'] );
				if ( ! empty( $attachment_full[0] ) && ! empty( $attachment_full[1] ) && ! empty( $attachment_full[2] ) ) {
					$str .= '<img width="' . $attachment_full[1] . '" height="' . $attachment_full[2] . '" src="' . $attachment_full[0] . '" ';
					$str .= $image_class . $data_attr;
					$str .= 'srcset="' . $attachment_full[0] . ' 768w, ' . $attachment_mobile_h . ' 767w, ' . $attachment_mobile . ' 150w" ';
					$str .= 'sizes="(max-width: 479px) 10vw, (max-width: 767px) 33vw, 768px" alt="' . esc_attr( $featured_alt ) . '"/>';
				}
			}
		}

		$str .= $options['has_link'] == true ? '</a>' : '';
		
		if( !isset($options['nowrap']) )
			$str .= '</div>';

		return $str;
	}
}
		



/**
 * @return string
 * check post thumbnail
 */
if ( ! function_exists( 'mweb_post_no_thumbnail' ) ) {
	function mweb_post_no_thumbnail() {

		$str = '';
		$str .= '<span class="no-thumb"></span>';	
		return $str;
	}
}
