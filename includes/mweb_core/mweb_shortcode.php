<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class mweb_theme_shortcode
 */
if ( ! class_exists( 'mweb_theme_shortcode' ) ) {
	class mweb_theme_shortcode {
		
		
	/**
	 * register supportcode
	 */
	function __construct() {

		
		//add shortcodes
		add_shortcode( 'button', array( $this, 'mweb_button' ) );
		add_shortcode( 'media', array( $this, 'mweb_media' ) );
		add_shortcode( 'accordion', array( $this, 'mweb_accordion_group' ) );
		add_shortcode( 'accordion-item', array( $this, 'mweb_accordion_item' ) );
		add_shortcode( 'row', array( $this, 'mweb_row' ) );
		add_shortcode( 'column', array( $this, 'mweb_column' ) );
		add_shortcode( 'dlline', array( $this, 'mweb_dlline' ) );
		add_shortcode( 'myaudio', array( $this, 'mweb_my_audio' ) );
		//add_shortcode( 'dlbox', array( $this, 'mweb_dlbox' ) );
		add_shortcode( 'blockquote', array( $this, 'mweb_blockquote' ) );
		//add_shortcode( 'table_price', array( $this, 'mweb_table_price' ) );
		//add_shortcode( 'table_price_item', array( $this, 'mweb_table_price_item' ) );
		add_shortcode( 'list_positive', array( $this, 'mweb_list_positive' ) );
		add_shortcode( 'list_negative', array( $this, 'mweb_list_negative' ) );
		add_shortcode( 'more_content', array( $this, 'mweb_content_loadmore' ) );
		add_shortcode( 'product_lists', array( $this, 'mweb_product_lists' ) );
		add_shortcode( 'mweb_order_tracking', array( $this, 'mweb_order_tracking' ) );
		add_shortcode( 'wc_order_count', array( $this, 'mweb_woocommerce_order_count' ) );

		add_shortcode( 'positive_points', array( $this, 'mweb_positive_points' ) );
		add_shortcode( 'negative_points', array( $this, 'mweb_negative_points' ) );
		add_shortcode( 'overview_product', array( $this, 'mweb_overview_product' ) );
		
		add_shortcode( 'mproduct', array( $this, 'mweb_product' ) );
		
		add_shortcode( 'mmeta', array( $this, 'mweb_metapost' ) );
		
		add_shortcode( 'single_product_term', array( $this, 'mweb_show_single_product_term_with_image' ) );
		
		add_shortcode( 'barcode', array( $this, 'mweb_barcode' ) );
		add_shortcode( 'mqrcode', array( $this, 'mweb_qrcode' ) );


	}


	

	/**-------------------------------------------------------------------------------------------------------------------------
	 * @param null $content
	 *
	 * @return string
	 */
	static function shortcodes_helper( $content = null ) {
		$content = do_shortcode( shortcode_unautop( $content ) );
		$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
		$content = preg_replace( '#<br \/>#', '', $content );

		return trim( $content );
	}

	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode button
	 */
	static function mweb_button( $attrs, $content = null ) {
		extract( shortcode_atts( array(
			'type'   => '',
			'color'  => '',
			'target' => '',
			'link'   => ''
		), $attrs ) );

		$classes      = array();
		$style_inline = '';
		$str          = '';

		$classes[] = 'btn btn-shortcode';
		if ( ! empty( $type ) ) {
			$classes[] = 'is-' . strip_tags( $type );
		} else {
			$classes[] = 'is-default';
		}

		if ( ! empty( $color ) ) {
			$style_inline = 'style="background-color: ' . strip_tags( $color ) . '"';
		}

		if ( ! empty( $link ) ) {
			$link = esc_url( $link );
		} else {
			$link = '#';
		}

		if ( ! empty( $target ) ) {
			$target = 'target="blank"';
		}else{
			$target = '';
		}

		$classes = implode( ' ', $classes );

		$str .= '<a class="' . $classes . '" ' . $style_inline . ' ' . $target . ' href="' . $link . '">';
		$str .= esc_attr( $content );
		$str .= '</a>';

		return $str;

	}
	
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode media aparat
	 */
	static function mweb_media( $attrs ) {
		extract( shortcode_atts( array(
			'id' => '',
			'type' => '',
		), $attrs ) );

		$classes   = array();
		$classes[] = 'media-shortcode';

		if ( empty( $type ) ) {
			$classes[] = 'aparat';
		} else {
			$classes[] = 'is-' . esc_attr( $type );
		}

		$classes = implode( ' ', $classes );

		return '<div class="' . esc_attr( $classes ) . '"><span style="display: block;padding-top: 57%"></span><iframe src="https://www.aparat.com/video/video/embed/videohash/'.$id.'/vt/frame" allowFullScreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" ></iframe></div>';
	}
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode List Positive
	 */

	static function mweb_list_positive( $attrs, $content = null ) {
		return '<div class="el_list e_positive">' . self::shortcodes_helper( $content ) . ' </div>';
	}
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode List Negative
	 */

	static function mweb_list_negative( $attrs, $content = null ) {
		return '<div class="el_list e_negative">' . self::shortcodes_helper( $content ) . ' </div>';
	}
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode Content Loadmore // [more_content btn="نمایش" height="200"]محتوا[/more_content]
	 */

	static function mweb_content_loadmore( $attrs, $content = null ) {
		extract( shortcode_atts( array(
			'btn' => '',
			'height' => '',
		), $attrs ) );
		
		$btn_text = empty($btn) ? 'بیشتر ...' :  $btn ;
		$dn_height = empty($height) ? '' :  ' style="height:'.$height.'px"' ;
		return '<div class="readmore_content">
			<div class="entry_readmore"'.$dn_height.'>' . self::shortcodes_helper( $content ) . '</div>
			<span class="more_btn">'.$btn_text.'</span>
		</div>';

	}
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode Product Lists // [product_lists id="" outofstock="yes"]
	 */

	static function mweb_product_lists( $attrs ) {
		extract( shortcode_atts( array(
			'id' => '',
			'outofstock' => '',
		), $attrs ) );

		$args = array(
			'post_type'      => 'product',
			'posts_per_page' => -1,
		);
		if ( !empty( $id ) ) {
			$args['category_id'] = absint($id);
		}
		
		$query_data = mweb_theme_query::get_custom_query($args);
		

		ob_start();
		
		echo '<table class="product_list_table">
                <thead><tr><th>وضعیت / عکس</th><th>محصول</th><th>قیمت</th></tr></thead>
                <tbody>';
				while ( $query_data->have_posts() ) :
					$query_data->the_post();
					global $product;
					$pd_price = $pd_img ='';
					$pd_title = '<a href="'.get_permalink().'">'.get_the_title().'</a>';
					
					if($product->is_type( 'variable' )){
						$vr_attr = $product->get_variation_attributes();
						$my_array = array();
						foreach($vr_attr as $key => $attr){
							foreach($attr as $vr){
								$term  = taxonomy_exists( $key ) ? get_term_by( 'slug', $vr, $key ) : false;
								if(! is_wp_error( $term ) && $term )
									$my_array[] = $term->name;
							}
						}
						$pd_title .= '<span>'.implode(" | ",$my_array).'</span>';
						$temp_stock = false;
						foreach ( $product->get_children() as $child_id ) {
							$variation = wc_get_product( $child_id );
								
								$temp_stock = $variation->is_in_stock();
							break;
						}
						if(!$product->is_in_stock() && $outofstock != 'yes'){
							continue;
						}elseif($outofstock == 'yes' && $temp_stock == false){
							$pd_img .= '<span class="plt_outofstock">ناموجود</span>';
						}else{
							$pd_img .= '<span class="plt_instock">موجود</span>';
						}
						
						
					}else{
					
						if(!$product->is_in_stock() && $outofstock != 'yes'){
							continue;
						}elseif(!$product->is_in_stock() && $outofstock == 'yes'){
							$pd_img .= '<span class="plt_outofstock">ناموجود</span>';
						}else{
							$pd_img .= '<span class="plt_instock">موجود</span>';
						}
						
					}
					$pd_price = '<span class="price tb_price">'.$product->get_price_html().'</span>';
					$pd_img .= woocommerce_get_product_thumbnail();
					
					printf('<tr><td class="plt_image td_img">%s</td><td class="plt_title td_title">%s</td><td class="plt_price td_price">%s</td></tr>', $pd_img, $pd_title, $pd_price);

					
				endwhile;
				
				wp_reset_postdata();
				
		echo '</tbody>
            </table>';

	
		return ob_get_clean();

	}
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode override order tracking 
	 */

	static function mweb_order_tracking( $attrs ) {
		
		// Check cart class is loaded or abort.
		if ( is_null( WC()->cart ) ) {
			return;
		}

		$attrs        = shortcode_atts( array(), $attrs );
		$nonce_value = wc_get_var( $_REQUEST['woocommerce-order-tracking-nonce'], wc_get_var( $_REQUEST['_wpnonce'], '' ) ); // @codingStandardsIgnoreLine.

		if ( isset( $_REQUEST['orderid'] ) && wp_verify_nonce( $nonce_value, 'woocommerce-order_tracking' ) ) { // WPCS: input var ok.

			$order_id    = empty( $_REQUEST['orderid'] ) ? 0 : ltrim( wc_clean( wp_unslash( $_REQUEST['orderid'] ) ), '#' ); // WPCS: input var ok.

			if ( ! $order_id ) {
				wc_print_notice( __( 'Please enter a valid order ID', 'woocommerce' ), 'error' );
			} else {
				$order = wc_get_order( apply_filters( 'woocommerce_shortcode_order_tracking_order_id', $order_id ) );

				if ( $order && $order->get_id() ) {
					do_action( 'woocommerce_track_order', $order->get_id() );
					wc_get_template(
						'order/tracking.php', array(
							'order' => $order,
						)
					);
					return;
				} else {
					wc_print_notice( __( 'Sorry, the order could not be found. Please contact us if you are having difficulty finding your order details.', 'woocommerce' ), 'error' );
				}
			}
		}

		wc_get_template( 
			'order/form-tracking.php', array(
				'hide_email' => true,
			)
		);

	}
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode accordion
	 */

	static function mweb_accordion_group( $attrs, $content = null ) {
		return '<div class="accordion accordion-shortcode">' . self::shortcodes_helper( $content ) . ' </div>';
	}


	static function mweb_accordion_item( $attrs, $content = null ) {
		extract( shortcode_atts( array(
			'title' => '',
		), $attrs ) );

		if ( empty( $title ) ) {
			$title = '';
		}

		$str = '';
		$str .= '<h3 class="accordion-item-title">' . $title . '</h3>';
		$str .= '<div class="accordion-item-content accordion-hide">' . self::shortcodes_helper( $content ) . '</div>';

		return $str;

	}
	
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode table price
	 */

	static function mweb_table_price( $attrs, $content = null ) {
		extract( shortcode_atts( array(
			'name' => '',
			'active' => '',
			'price' => '',
			'period' => '',
			'button' => '',
			'link' => '',
		), $attrs ) );
		
		$tb_class = 'tb_price clear';
		if($active == 'yes'){
			$tb_class .= ' select';
		}
		if(!empty($name))
		return '<div class="'.$tb_class.'"><h5>'.$name.'</h5><span>'.$price.'<i>'.$period.'</i></span>
					<ul>' . self::shortcodes_helper( $content ) . '</ul>
					<a class="tb_btn" href="'.$link.'">'.$button.'</a>
				</div>';

	}


	static function mweb_table_price_item( $attrs ) {
		extract( shortcode_atts( array(
			'title' => '',
		), $attrs ) );

		if ( !empty( $title ) ) 
			return '<li>'.$title.'</li>';

	}
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode section 
	 */

	static function mweb_blockquote( $attrs, $content = null ) {
		extract( shortcode_atts( array(
			'author' => '',
		), $attrs ) );


		$str = '';
		$str .= '<blockquote class="blockquote">' . self::shortcodes_helper( $content );
		if(!empty($author)){
			$str .= '<span class="author_label">'.$author.'</span>';
		}
		$str .= '</blockquote>';

		return $str;

	}
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode application link
	 */

	static function mweb_dlline( $attrs ) {
		extract( shortcode_atts( array(
			'title' => '',
			'link' => '',
		), $attrs ) );

		if ( empty( $title ) ) {
			$title = '';
		}

		$str = '';

		// Return custom embed code
		$str .= '<div class="simple_dlbox clear"><a href="'.$link.'" target="_blank">
		<span class="simple_dlbox_title">'.$title.'</span><span class="simple_dlbox_btn">دریافت</span></a></div>';
	
		return $str;

	}
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode audio
	 */
	static function mweb_my_audio( $attrs ) {
		extract( shortcode_atts( array(
			'link' => '',
		), $attrs ) );

	
		$str = '';
		if ( !empty( $link ) ) {
			$str .= '<audio controls><source src="'.$link.'" type="audio/mpeg">Your browser does not support the audio element.</audio>';
		}

		return $str;

	}
	
	
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode dlbox
	 */
	static function mweb_dlbox( $attrs ) {
		extract( shortcode_atts( array(
			'title' => '',
			'link' => '',
		    'type' => '',
	     	'size' => '',
		    'pass' => '',
		), $attrs ) );

	
		$str = '';
			if ( !empty( $link ) ) {
				$str .= '<div class="download_box"><div class="download_box_title"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#cloud"></use></svg>'.$title.'</div>
				<div class="download_box_item">
				<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#document"></use></svg>
				<span>نوع فایل : </span> '.$type.'
				</div>
				<div class="download_box_item">
				<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#info-circle"></use></svg>
				<span>حجم : </span> '.$size.'
				</div>';
					if ( !empty( $pass ) ) {
				$str .= '<div class="download_box_item">
				<svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#security-safe"></use></svg>
				<span>پسورد : </span> '.$pass.'
				</div>';
					}
				$str .= ' <a href="'.$link.'">دریافت</a>';
				$str .= '</div>';
					
			}

		return $str;

	}
	 

	 
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode row
	 */
	static function mweb_row( $attrs, $content = null ) {

		return '<div class="row-shortcode row">' . self::shortcodes_helper( $content ) . '</div>';

	}
	
	
	
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode column
	 */

	static function mweb_column( $attrs, $content = null ) {

		extract( shortcode_atts( array(
			'width' => ''
		), $attrs ) );

		if ( empty( $width ) ) {
			$width = '100%';
		}

		switch ( $width ) {
			case '50%'  :
				return '<div class="col-shortcode col-12 col-sm-12 col-md-6">' . self::shortcodes_helper( $content ) . '</div>';
			case '33%'  :
				return '<div class="col-shortcode col-12 col-sm-12 col-md-4">' . self::shortcodes_helper( $content ) . '</div>';
			case '66%' :
				return '<div class="col-shortcode col-12 col-sm-12 col-md-8">' . self::shortcodes_helper( $content ) . '</div>';
			case '25%' :
				return '<div class="col-shortcode col-12 col-sm-12 col-md-3">' . self::shortcodes_helper( $content ) . '</div>';
			default :
				return '<div class="col-shortcode col-12">' . self::shortcodes_helper( $content ) . '</div>';
		}
	}
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode positive points of the product [positive_points title=""]
	 */
	static function mweb_positive_points( $attrs ) {
		extract( shortcode_atts( array(
			'id' => '',
			'title' => '',
		), $attrs ) );
		
		if( is_singular( 'product' ) ){
			$id = get_the_ID();
		}
		$str = '';
		
		if( !empty($id) ){
			$mweb_product_review_good = get_post_meta( $id, 'mweb_product_review_good', true );
			$str .= '<div class="woocommerce_review_point good">';
			if( !empty($title) && !empty($mweb_product_review_good) )
				$str .= '<span class="review_title">'. $title .'</span>';
			$str .= $mweb_product_review_good;
			$str .= '</div>';
		}
	
		return $str;
	}
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode negative points of the product [negative_points title=""]
	 */
	static function mweb_negative_points( $attrs ) {
		extract( shortcode_atts( array(
			'id' => '',
			'title' => '',
		), $attrs ) );
		
		if( is_singular( 'product' ) ){
			$id = get_the_ID();
		}
		$str = '';
		
		if( !empty($id) ){
			$mweb_product_review_bad = get_post_meta( $id, 'mweb_product_review_bad', true );
			$str .= '<div class="woocommerce_review_point bad">';
			if( !empty($title) && !empty($mweb_product_review_bad) )
				$str .= '<span class="review_title">'. $title .'</span>';
			$str .= $mweb_product_review_bad;
			$str .= '</div>';
		}
	
		return $str;
	}
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode get product [mproduct ids="" style="" col="" ]
	 */
	static function mweb_product( $attrs ) {
		extract( shortcode_atts( array(
			'ids' => '',
			'style' => 1,
			'col' => 3,
		), $attrs ) );
		
		if( empty($ids) )
			return false;
		
		$str = '';
		ob_start();
		$col = intval( 12 / $col );

		$product_ids = explode(',', $ids);
		
		$loop_number = ($style >= 4 && $style <= 7) ? 'general_'.$style : 'general';
		$loop_name = 'mweb_loop_template_product_'.$loop_number;
		
		$args = array(
			'post_type'   => 'product',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'post__in' => $product_ids
		);
		$query = new WP_Query($args);

		if( count($product_ids) > 1 ){
			echo '<div class="row">';
				 while ($query->have_posts()) {
					$query->the_post();
					echo '<div class="item col-12 col-sm-6 col-md-'.$col.'">';
						echo $loop_name();
					echo '</div>';
				 }
				wp_reset_postdata();
			echo '</div>';
		} else {
			while ($query->have_posts()) {
				$query->the_post();
				echo '<div class="blog_product"><div class="item">';
					echo $loop_name();
				echo '</div></div>';
			}
			wp_reset_postdata();
		}
		
		$str .= ob_get_clean();
	
		return $str;
	}
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode overview of the product [overview_product circular="yes" dir="h"]
	 */
	static function mweb_overview_product( $attrs ) {
		extract( shortcode_atts( array(
			'id' => '',
			'circular' => 'no',
			'dir' => 'v',
		), $attrs ) );
		
		if( is_singular( 'product' ) ){
			$id = get_the_ID();
		}
		$str = '';
		
		$class_w = 'woocommerce_review_progress clear';
		if( $dir == 'h' )
			$class_w .= ' circular_p_h d-flex';
		
		if( !empty($id) ){
			$str .= '<div class="'.$class_w.'">';

				$review_data    = array(
						array(
							'review_q' => get_post_meta( $id, 'review_q1', true ),
							'review_p' => get_post_meta( $id, 'review_p1', true ),
						),
						array(
							'review_q' => get_post_meta( $id, 'review_q2', true ),
							'review_p' => get_post_meta( $id, 'review_p2', true ),
						),
						array(
							'review_q' => get_post_meta( $id, 'review_q3', true ),
							'review_p' => get_post_meta( $id, 'review_p3', true ),
						),
						array(
							'review_q' => get_post_meta( $id, 'review_q4', true ),
							'review_p' => get_post_meta( $id, 'review_p4', true ),
						),
						array(
							'review_q' => get_post_meta( $id, 'review_q5', true ),
							'review_p' => get_post_meta( $id, 'review_p5', true ),
						),

					);

				if( $circular == 'yes' ){
					foreach ( $review_data as $data ) {
						if ( ! empty( $data['review_q'] ) ) {	
							$str .= '<div class="cr_progress"><div class="crp_percent">';
							$str .= '<svg><circle cx="25" cy="25" r="23"></circle><circle cx="25" cy="25" r="23" style="--percent: '. ($data['review_p'] * 10) .'"></circle></svg>';
							$str .= '<div class="crp_number"><p>'. round($data['review_p'], 1) .'</p></div>';
							$str .= '</div><div class="crp_label">'. $data['review_q'] .'<span>از 10 امتیاز</span></div></div>';
						}
					}
				}else{
					foreach ( $review_data as $data ) {
						if ( ! empty( $data['review_q'] ) ) {	
							$str .= '<p class="progress-label">' . esc_attr( $data['review_q'] ) . ' <span>' . esc_attr( $data['review_p'] ) . '</span></p>';
							$str .= '<div class="progress progress-animation progress-xs right">';
							$str .= '  <div class="progress-bar" role="progressbar" data-transitiongoal="' . esc_attr( $data['review_p'] * 10 ) . '"></div>';
							$str .= '</div>';
						}
					}
				}

			$str .= '</div>';
		
		}
	
		return $str;
	}
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode woocommerce order count // [wc_order_count status="completed,pending"] 
	 */
	static function mweb_woocommerce_order_count( $atts, $content = null ) {

		$args = shortcode_atts( array(
			'status' => 'completed',
		), $atts );

		$statuses    = array_map( 'trim', explode( ',', $args['status'] ) );
		$order_count = 0;

		foreach ( $statuses as $status ) {

			// if we didn't get a wc- prefix, add one
			if ( 0 !== strpos( $status, 'wc-' ) ) {
				$status = 'wc-' . $status;
			}

			$order_count += wp_count_posts( 'shop_order' )->$status;
		}

		ob_start();

		echo number_format( $order_count );

		return ob_get_clean();
	}
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode barcode liner // usage ex = [barcode data="123" size="25"]
	 */
	static function mweb_barcode( $attrs ) {
		
		extract( shortcode_atts(
			array(
				'data' => '0',
				'size' => '25',
				'orientation' => 'horizontal',
				'code_type' => 'code128',
				'print' => false,
				'SizeFactor' => 1,
			), $attrs ) );
		
		$code_string = "";
		// Translate the $data into barcode the correct $code_type
		if ( in_array(strtolower($code_type), array("code128", "code128b")) ) {
			$chksum = 104;
			// Must not change order of array elements as the checksum depends on the array's key to validate final code
			$code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","\`"=>"111422","a"=>"121124","b"=>"121421","c"=>"141122","d"=>"141221","e"=>"112214","f"=>"112412","g"=>"122114","h"=>"122411","i"=>"142112","j"=>"142211","k"=>"241211","l"=>"221114","m"=>"413111","n"=>"241112","o"=>"134111","p"=>"111242","q"=>"121142","r"=>"121241","s"=>"114212","t"=>"124112","u"=>"124211","v"=>"411212","w"=>"421112","x"=>"421211","y"=>"212141","z"=>"214121","{"=>"412121","|"=>"111143","}"=>"111341","~"=>"131141","DEL"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","FNC 4"=>"114131","CODE A"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
			$code_keys = array_keys($code_array);
			$code_values = array_flip($code_keys);
			for ( $X = 1; $X <= strlen($data); $X++ ) {
				$activeKey = substr( $data, ($X-1), 1);
				$code_string .= $code_array[$activeKey];
				$chksum=($chksum + ($code_values[$activeKey] * $X));
			}
			$code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

			$code_string = "211214" . $code_string . "2331112";
		} elseif ( strtolower($code_type) == "code128a" ) {
			$chksum = 103;
			$data = strtoupper($data); // Code 128A doesn't support lower case
			// Must not change order of array elements as the checksum depends on the array's key to validate final code
			$code_array = array(" "=>"212222","!"=>"222122","\""=>"222221","#"=>"121223","$"=>"121322","%"=>"131222","&"=>"122213","'"=>"122312","("=>"132212",")"=>"221213","*"=>"221312","+"=>"231212",","=>"112232","-"=>"122132","."=>"122231","/"=>"113222","0"=>"123122","1"=>"123221","2"=>"223211","3"=>"221132","4"=>"221231","5"=>"213212","6"=>"223112","7"=>"312131","8"=>"311222","9"=>"321122",":"=>"321221",";"=>"312212","<"=>"322112","="=>"322211",">"=>"212123","?"=>"212321","@"=>"232121","A"=>"111323","B"=>"131123","C"=>"131321","D"=>"112313","E"=>"132113","F"=>"132311","G"=>"211313","H"=>"231113","I"=>"231311","J"=>"112133","K"=>"112331","L"=>"132131","M"=>"113123","N"=>"113321","O"=>"133121","P"=>"313121","Q"=>"211331","R"=>"231131","S"=>"213113","T"=>"213311","U"=>"213131","V"=>"311123","W"=>"311321","X"=>"331121","Y"=>"312113","Z"=>"312311","["=>"332111","\\"=>"314111","]"=>"221411","^"=>"431111","_"=>"111224","NUL"=>"111422","SOH"=>"121124","STX"=>"121421","ETX"=>"141122","EOT"=>"141221","ENQ"=>"112214","ACK"=>"112412","BEL"=>"122114","BS"=>"122411","HT"=>"142112","LF"=>"142211","VT"=>"241211","FF"=>"221114","CR"=>"413111","SO"=>"241112","SI"=>"134111","DLE"=>"111242","DC1"=>"121142","DC2"=>"121241","DC3"=>"114212","DC4"=>"124112","NAK"=>"124211","SYN"=>"411212","ETB"=>"421112","CAN"=>"421211","EM"=>"212141","SUB"=>"214121","ESC"=>"412121","FS"=>"111143","GS"=>"111341","RS"=>"131141","US"=>"114113","FNC 3"=>"114311","FNC 2"=>"411113","SHIFT"=>"411311","CODE C"=>"113141","CODE B"=>"114131","FNC 4"=>"311141","FNC 1"=>"411131","Start A"=>"211412","Start B"=>"211214","Start C"=>"211232","Stop"=>"2331112");
			$code_keys = array_keys($code_array);
			$code_values = array_flip($code_keys);
			for ( $X = 1; $X <= strlen($data); $X++ ) {
				$activeKey = substr( $data, ($X-1), 1);
				$code_string .= $code_array[$activeKey];
				$chksum=($chksum + ($code_values[$activeKey] * $X));
			}
			$code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

			$code_string = "211412" . $code_string . "2331112";
		} elseif ( strtolower($code_type) == "code39" ) {
			$code_array = array("0"=>"111221211","1"=>"211211112","2"=>"112211112","3"=>"212211111","4"=>"111221112","5"=>"211221111","6"=>"112221111","7"=>"111211212","8"=>"211211211","9"=>"112211211","A"=>"211112112","B"=>"112112112","C"=>"212112111","D"=>"111122112","E"=>"211122111","F"=>"112122111","G"=>"111112212","H"=>"211112211","I"=>"112112211","J"=>"111122211","K"=>"211111122","L"=>"112111122","M"=>"212111121","N"=>"111121122","O"=>"211121121","P"=>"112121121","Q"=>"111111222","R"=>"211111221","S"=>"112111221","T"=>"111121221","U"=>"221111112","V"=>"122111112","W"=>"222111111","X"=>"121121112","Y"=>"221121111","Z"=>"122121111","-"=>"121111212","."=>"221111211"," "=>"122111211","$"=>"121212111","/"=>"121211121","+"=>"121112121","%"=>"111212121","*"=>"121121211");

			// Convert to uppercase
			$upper_text = strtoupper($data);

			for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
				$code_string .= $code_array[substr( $upper_text, ($X-1), 1)] . "1";
			}

			$code_string = "1211212111" . $code_string . "121121211";
		} elseif ( strtolower($code_type) == "code25" ) {
			$code_array1 = array("1","2","3","4","5","6","7","8","9","0");
			$code_array2 = array("3-1-1-1-3","1-3-1-1-3","3-3-1-1-1","1-1-3-1-3","3-1-3-1-1","1-3-3-1-1","1-1-1-3-3","3-1-1-3-1","1-3-1-3-1","1-1-3-3-1");

			for ( $X = 1; $X <= strlen($data); $X++ ) {
				for ( $Y = 0; $Y < count($code_array1); $Y++ ) {
					if ( substr($data, ($X-1), 1) == $code_array1[$Y] )
						$temp[$X] = $code_array2[$Y];
				}
			}

			for ( $X=1; $X<=strlen($data); $X+=2 ) {
				if ( isset($temp[$X]) && isset($temp[($X + 1)]) ) {
					$temp1 = explode( "-", $temp[$X] );
					$temp2 = explode( "-", $temp[($X + 1)] );
					for ( $Y = 0; $Y < count($temp1); $Y++ )
						$code_string .= $temp1[$Y] . $temp2[$Y];
				}
			}

			$code_string = "1111" . $code_string . "311";
		} elseif ( strtolower($code_type) == "codabar" ) {
			$code_array1 = array("1","2","3","4","5","6","7","8","9","0","-","$",":","/",".","+","A","B","C","D");
			$code_array2 = array("1111221","1112112","2211111","1121121","2111121","1211112","1211211","1221111","2112111","1111122","1112211","1122111","2111212","2121112","2121211","1121212","1122121","1212112","1112122","1112221");

			// Convert to uppercase
			$upper_text = strtoupper($data);

			for ( $X = 1; $X<=strlen($upper_text); $X++ ) {
				for ( $Y = 0; $Y<count($code_array1); $Y++ ) {
					if ( substr($upper_text, ($X-1), 1) == $code_array1[$Y] )
						$code_string .= $code_array2[$Y] . "1";
				}
			}
			$code_string = "11221211" . $code_string . "1122121";
		}

		// Pad the edges of the barcode
		$code_length = 20;
		if ($print) {
			$data_height = 30;
		} else {
			$data_height = 0;
		}
		
		for ( $i=1; $i <= strlen($code_string); $i++ ){
			$code_length = $code_length + (integer)(substr($code_string,($i-1),1));
			}

		if ( strtolower($orientation) == "horizontal" ) {
			$img_width = $code_length*$SizeFactor;
			$img_height = $size;
		} else {
			$img_width = $size;
			$img_height = $code_length*$SizeFactor;
		}

		$image = imagecreate($img_width, $img_height + $data_height);
		$black = imagecolorallocate ($image, 0, 0, 0);
		$white = imagecolorallocate ($image, 255, 255, 255);

		imagefill( $image, 0, 0, $white );
		if ( $print ) {
			imagestring($image, 5, 31, $img_height, $data, $black );
		}

		$location = 10;
		for ( $position = 1 ; $position <= strlen($code_string); $position++ ) {
			$cur_size = $location + ( substr($code_string, ($position-1), 1) );
			if ( strtolower($orientation) == "horizontal" )
				imagefilledrectangle( $image, $location*$SizeFactor, 0, $cur_size*$SizeFactor, $img_height, ($position % 2 == 0 ? $white : $black) );
			else
				imagefilledrectangle( $image, 0, $location*$SizeFactor, $img_width, $cur_size*$SizeFactor, ($position % 2 == 0 ? $white : $black) );
			$location = $cur_size;
		}

		ob_start();
			imagepng($image);
			imagedestroy($image);	
		echo '<img src="data:image/png;base64,' . base64_encode(ob_get_clean()) . '" />';		
		
	}
	
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode qrcode // usage ex = [mqrcode data="exapmle" type="M" size="2" padding="1"]
	 */
	static function mweb_qrcode( $attrs ) {
		
		extract( shortcode_atts(
			array(
				'data' => '',
				'type' => 'M',
				'size' => 2,
				'padding' => 1,
			), $attrs ) );
		$type = in_array($type, array('L', 'M', 'Q', 'H')) ? $type : 'M';
		$size = $size > 0 && $size <= 10 ? $size : 2;
		
		switch( $data ){
			case 'id' : 
				global $product;
				$data = get_the_ID();
			break;
			case 'url' : 
				$data = get_permalink( get_the_ID() );
			break;
			case 'sku' : 
				global $product;
				$data = $product->get_sku();
			break;
			default :
				$data = $data;
		}
		
		
		if( !empty($data) ){
			ob_start();
				$returnData = QRcode::pngString($data, false, $type, $size, $padding);
				$imageString = base64_encode(ob_get_contents());
			ob_end_clean();
			$str = "data:image/png;base64," . $imageString;
			return '<img src="'.$str.'" />';		
		} 
		return false;
		
	}
	
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode get post meta value // usage ex = [mmeta id="0" meta=""]
	 */
	static function mweb_metapost( $attrs ) {
		
		extract( shortcode_atts(
			array(
				'id' => '',
				'meta' => '',
			), $attrs ) );
		
		$id = empty($id) ? get_the_ID() : $id;
		$meta_data = get_post_meta( $id, $meta, true );
		
		return !empty($meta_data) ? $meta_data : false;
		
	}
	
	
	
	
	/**-------------------------------------------------------------------------------------------------------------------------
	 * Shortcode get single term attribute // usage ex = [single_product_term taxonomy="pa_color"]
	 */
	static function mweb_show_single_product_term_with_image($atts) {
		$atts = shortcode_atts([
			'taxonomy' => '', // مثل: pa_color یا product_brand
		], $atts, 'single_product_term');

		if (!is_product() || empty($atts['taxonomy'])) {
			return 'اطلاعات کافی وارد نشده یا در صفحه محصول نیستید.';
		}

		$product_id = get_the_ID();
		$taxonomy   = sanitize_text_field($atts['taxonomy']);

		$terms = get_the_terms($product_id, $taxonomy);
		if (!$terms || is_wp_error($terms)) {
			//return 'ترم مرتبطی یافت نشد.';
			return false;
		}

		$taxonomy_obj = get_taxonomy($taxonomy);
		$taxonomy_label = $taxonomy_obj ? $taxonomy_obj->labels->singular_name : ucfirst($taxonomy);

		$term = $terms[0];
		$image_id = get_term_meta($term->term_id, 'mwebshop_product_attribute_image_id', true);
		$term_link = get_term_link($term);

		if (is_wp_error($term_link)) {
			$term_link = '';
		}

		ob_start();
		?>
		<div class="mweb-product-term-box" style="display: flex; align-items: center; gap: 10px;">
			<strong class="term-taxonomy-title"><?php echo esc_html($taxonomy_label); ?>:</strong>
			<div class="term-item">
				<?php if ($image_id): ?>
					<div class="term-image">
						<?php echo wp_get_attachment_image($image_id, 'thumbnail', false, ['alt' => esc_attr($term->name)]); ?>
					</div>
				<?php endif; ?>
				<div class="term-name">
					<?php if ($term_link): ?>
						<a href="<?php echo esc_url($term_link); ?>">
							<?php echo esc_html($term->name); ?>
						</a>
					<?php else: ?>
						<?php echo esc_html($term->name); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
		return ob_get_clean();
	}


		

	}
	new mweb_theme_shortcode();
}




function rebar_calculator_shortcode() {
    ob_start(); ?>
    
    <div id="rebar-calculator" class="iron_calculator">
      <h3 class="title">ماشین حساب وزن میلگرد</h3>
      <p class="desc">قطر، طول و تعداد شاخه میلگرد را وارد کنید تا وزن تقریبی کل محاسبه شود.</p>
      
      <div class="row_fields">
        <div class="row_field">
          <label>قطر</label>
          <select id="rebar-diameter">
            <?php for($i=8;$i<=40;$i+=2): ?>
              <option value="<?php echo $i; ?>">سایز <?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        
        <div class="row_field">
          <label>طول</label>
          <select id="rebar-length">
            <option value="12">12 متر</option>
			<option value="6">6 متر</option>
          </select>
        </div>
        
        <div class="row_field">
          <label>تعداد</label>
          <input type="number" id="rebar-quantity" value="1" min="1">
        </div>
      </div>
      
      <button id="calculate-weight">محاسبه وزن</button>
      
      <p id="rebar-result" class="result"></p>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
      const btn = document.getElementById('calculate-weight');
      if(btn){
        btn.addEventListener('click', function() {
          const diameter = parseFloat(document.getElementById('rebar-diameter').value);
          const length = parseFloat(document.getElementById('rebar-length').value);
          const quantity = parseInt(document.getElementById('rebar-quantity').value);
          
          if(isNaN(diameter) || isNaN(length) || isNaN(quantity) || quantity < 1){
              alert('لطفاً مقادیر معتبر وارد کنید.');
              return;
          }
          
          const weightPerMeter = Math.pow(diameter, 2) / 162;
          const totalWeight = weightPerMeter * length * quantity;
          
          document.getElementById('rebar-result').innerHTML = `وزن تقریبی کل میلگرد: <b>${totalWeight.toFixed(2)}</b> کیلوگرم`;
		  
        });
      }
    });
    </script>
    
    <?php
    return ob_get_clean();
}
add_shortcode('rebar_calculator', 'rebar_calculator_shortcode');





function beam_calculator_shortcode() {
    ob_start(); ?>
    
    <div id="beam-calculator" class="iron_calculator">
      <h3 class="title">ماشین حساب وزن تیرآهن</h3>
      <p class="desc">سایز تیرآهن را انتخاب کنید تا وزن تقریبی شاخه ۱۲ متری محاسبه شود.</p>
      
      <div class="row_fields grid_2">
        <div class="row_field">
          <label>سایز</label>
          <select id="beam-size">
            <?php for($i=8;$i<=60;$i+=2): ?>
              <option value="<?php echo $i; ?>">سایز <?php echo $i; ?></option>
            <?php endfor; ?>
          </select>
        </div>
        
        <div class="row_field">
          <label>طول</label>
          <select id="beam-length">
            <option value="12">شاخه ۱۲ متری</option>
          </select>
        </div>
      </div>
      
      <button id="calculate-beam">محاسبه وزن</button>
      
      <p id="beam-result" class="result"></p>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
      const beamWeights = {
        8: 6.0, 10: 8.1, 12: 10.4, 14: 12.9, 16: 15.8,
        18: 18.8, 20: 22.4, 22: 26.2, 24: 30.1, 27: 36.1,
        30: 43.2, 33: 50.6, 36: 58.6, 40: 71.8, 45: 89.6,
        50: 107.0, 55: 133.0, 60: 161.0
      };
      
      document.getElementById('calculate-beam').addEventListener('click', function() {
        const size = parseInt(document.getElementById('beam-size').value);
        const length = parseFloat(document.getElementById('beam-length').value);
        
        if(!beamWeights[size]){
          alert("وزن این سایز موجود نیست.");
          return;
        }
        
        const weight = beamWeights[size] * length;
        document.getElementById('beam-result').innerHTML = `وزن تقریبی تیرآهن : <b>${weight.toFixed(2)}</b> کیلوگرم`;
      });
    });
    </script>
    
    <?php
    return ob_get_clean();
}
add_shortcode('beam_calculator', 'beam_calculator_shortcode');




function profile_calculator_shortcode() {
    ob_start(); ?>
    
	<div id="profile-calculator" class="iron_calculator">
      <h3 class="title">ماشین حساب وزن پروفیل</h3>
      
      <div class="row_fields">
        <div class="row_field">
          <label>ابعاد (mm)</label>
          <select id="profile-size">
            <?php
              $sizes = ["10×10","10×20","20×20","25×25","10×30","20×30","30×30","35×35",
              "20×40","30×40","40×40","50×50","30×50","40×50","20×60","30×60","40×60","60×60",
              "70×70","80×80","40×80","60×80","90×90","40×100","50×100","100×100",
              "60×120","120×120","135×135","138×138","140×140","100×150","150×150",
              "160×160","180×180","200×200","100×200","300×300","150×300","200×400","400×400","500×500"];
              foreach($sizes as $s) { echo "<option value='$s'>$s</option>"; }
            ?>
          </select>
        </div>

        <div class="row_field">
          <label>ضخامت (mm)</label>
          <select id="profile-thickness">
            <?php
              $thicknesses = ["0.5","0.6","0.7","0.8","0.9","1","1.25","1.5","1.8","2","2.2","2.35","2.5","2.8","3","3.5","4","5","6","8","10","12","15","20"];
              foreach($thicknesses as $t) { echo "<option value='{$t}'>{$t} mm</option>"; }
            ?>
          </select>
        </div>
		
		<div class="row_field">
		  <label>طول شاخه</label>
		  <select id="profile-length">
			<option value="6">شاخه ۶ متری</option>
			<option value="12">شاخه ۱۲ متری</option>
		  </select>
		</div>
		
      </div>
	  <div class="row_fields grid_1">
        <div class="row_field">
          <label>تعداد</label>
          <input type="number" id="profile-quantity" value="1" min="1">
        </div>
      </div>

      <button id="calculate-profile">محاسبه وزن</button>
      
      <p id="profile-result" class="result"></p>
      
    </div>

    <script>
	document.addEventListener("DOMContentLoaded", function() {
	  document.getElementById('calculate-profile').addEventListener('click', function() {
		const size = document.getElementById('profile-size').value.split("×");
		const W = parseFloat(size[0]); 
		const H = parseFloat(size[1]); 
		const T = parseFloat(document.getElementById('profile-thickness').value); 
		const L = parseFloat(document.getElementById('profile-length').value); 
		const qty = parseInt(document.getElementById('profile-quantity').value) || 1;

		if (isNaN(W) || isNaN(H) || isNaN(T) || isNaN(L) || qty < 1) {
		  alert("لطفاً همه مقادیر را صحیح وارد کنید.");
		  return;
		}

		const density = 7.86;

		const Wcm = W / 10;
		const Hcm = H / 10;
		const Tcm = T / 10;
		const Lcm = L * 100; 

		const weightOne = 2 * (Wcm + Hcm) * Tcm * Lcm * density / 1000; 
		const total = weightOne * qty;

		document.getElementById('profile-result').innerHTML =
		  `وزن تقریبی کل: <b>${total.toFixed(3)}</b> کیلوگرم`;
	  });
	});
	</script>

    
    <?php
    return ob_get_clean();
}
add_shortcode('profile_calculator', 'profile_calculator_shortcode');



function pipe_calculator_shortcode() {
    ob_start();
    ?>
	
	<div id="pipe-calculator" class="iron_calculator">
      <h3 class="title">ماشین حساب وزن لوله</h3>
      <p class="desc">قطر، ضخامت، طول و تعداد را انتخاب کنید تا وزن تقریبی کل لوله محاسبه شود.</p>

      <div class="row_fields">
        <div class="row_field">
	      <label>قطر (خارجی)</label>
          <select id="pipe-diameter">
            <?php
            $diameters = [
              "10","10.3","13","13.7","16","17.1","18","19","20","21.3","22","25","26.7",
              "28","32","33.4","35","38","42","42.2","48","48.3","50","60","60.3","73",
              "88.9","101.6","114.3","141.3","168.3","219.1","273.1","323.9","355.6","406.4",
              "457","506","559","610","660","711","762","813","864","914","965","1016","1067",
              "1118","1168","1219"
            ];
            foreach($diameters as $d){
                echo "<option value=\"{$d}\">{$d} mm</option>";
            }
            ?>
          </select>
        </div>

        <div class="row_field">
          <label>ضخامت</label>
          <select id="pipe-thickness">
            <?php
            $th = ["0.6","0.7","0.8","0.9","1","1.15","1.25","1.5","1.8","2","2.2","2.35","2.5","3","3.5","4","5","6","8","10","12","15","20"];
            foreach($th as $t){
              echo "<option value=\"{$t}\">{$t} mm</option>";
            }
            ?>
          </select>
        </div>

        <div class="row_field">
          <label>طول شاخه</label>
          <select id="pipe-length">
            <option value="6">6 متر</option>
            <option value="12">12 متر</option>
          </select>
        </div>

        
      </div>
	  <div class="row_fields grid_1">
		<div class="row_field">
          <label>تعداد</label>
          <input type="number" id="pipe-quantity" value="1" min="1">
        </div>
	  </div>
      <button id="pipe-calc">
        محاسبه وزن
      </button>

      <p id="pipe-result" class="result"></p>

    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function(){
      const btn = document.getElementById('pipe-calc');
      btn.addEventListener('click', function(){
        const D = parseFloat(document.getElementById('pipe-diameter').value); 
        const t = parseFloat(document.getElementById('pipe-thickness').value); 
        const length = parseFloat(document.getElementById('pipe-length').value); 
        const qty = parseInt(document.getElementById('pipe-quantity').value) || 1;
        const density = 8.25; 

        if(isNaN(D) || isNaN(t) || isNaN(length) || qty < 1){
          alert('مقادیر معتبر وارد کنید.');
          return;
        }

        let Din = D - 2 * t;
        if (Din < 0) Din = 0;

        const area = Math.PI * (Math.pow(D,2) - Math.pow(Din,2)) / 4.0;

        const weightKg = area * length * density / 1000.0 * qty;

        document.getElementById('pipe-result').innerHTML = 
          `وزن تقریبی کل: <b>${weightKg.toFixed(3)}</b> کیلوگرم`;
      });
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('pipe_calculator', 'pipe_calculator_shortcode');



function sheet_calculator_shortcode() {
    ob_start();
    ?>
    <div id="sheet-calculator" class="iron_calculator">
      <h3 class="title">ماشین حساب وزن ورق آهن</h3>
      <p class="desc">ابعاد و ضخامت ورق را وارد کنید.</p>

      <div class="row_fields">
        <div class="row_field">
          <label>طول (متر)</label>
          <input type="number" id="sheet-length" step="0.01" value="1" min="0.1">
        </div>
        <div class="row_field">
          <label>عرض (متر)</label>
          <input type="number" id="sheet-width" step="0.01" value="1" min="0.1">
        </div>
        <div class="row_field">
          <label>ضخامت (میلی متر)</label>
          <select id="sheet-thickness">
            <?php
            $thicknesses = ["0.3","0.4","0.5","0.6","0.7","0.8","0.9","1","1.2","1.25","1.5","2","3","4","5","6","8","10","12","15","20","25","30","35","40","45","50","55","60"];
            foreach($thicknesses as $t){
              echo "<option value=\"{$t}\">{$t} mm</option>";
            }
            ?>
          </select>
        </div>
	  </div>
	  <div class="row_fields grid_1">
        <div class="row_field">
          <label>تعداد</label>
          <input type="number" id="sheet-quantity" value="1" min="1">
        </div>
      </div>

      <button id="sheet-calc">
        محاسبه وزن
      </button>

      <p id="sheet-result" class="result"></p>

    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function(){
      const btn = document.getElementById('sheet-calc');
      btn.addEventListener('click', function(){
        const length = parseFloat(document.getElementById('sheet-length').value);
        const width = parseFloat(document.getElementById('sheet-width').value);
        const thickness = parseFloat(document.getElementById('sheet-thickness').value);
        const qty = parseInt(document.getElementById('sheet-quantity').value) || 1;
        const density = 7.85; 

        if(isNaN(length) || isNaN(width) || isNaN(thickness) || qty < 1){
          alert('لطفاً مقادیر معتبر وارد کنید.');
          return;
        }

        const weightOne = length * width * thickness * density;
        const weightTotal = weightOne * qty;

        document.getElementById('sheet-result').innerHTML =
          `وزن تقریبی کل: <b>${weightTotal.toFixed(3)}</b> کیلوگرم`;
      });
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('sheet_calculator', 'sheet_calculator_shortcode');



function angle_calculator_shortcode() {
    ob_start(); ?>
    <div id="angle-calculator" class="iron_calculator">
      <h3 class="title">ماشین حساب وزن نبشی</h3>
      <div <div class="row_fields">
        <div <div class="row_field">
          <label>سایز نبشی (mm)</label>
          <select id="angle-size">
            <?php
              $sizes = [30,40,50,60,70,80,100,120,150];
              foreach($sizes as $s){ echo "<option value='{$s}'>{$s} × {$s}</option>"; }
            ?>
          </select>
        </div>
        <div <div class="row_field">
          <label>ضخامت (mm)</label>
          <select id="angle-thickness">
            <?php
              $ths = ["2","2.5","3","4","5","6","7","8","9","10","11","12","14","15"];
              foreach($ths as $t){ echo "<option value='{$t}'>{$t}</option>"; }
            ?>
          </select>
        </div>
        <div <div class="row_field">
          <label>طول شاخه</label>
          <select id="angle-length">
            <option value="6">۶ متر</option>
            <option value="12">۱۲ متر</option>
          </select>
        </div>
	  </div>
	  <div <div class="row_fields grid_1">
        <div <div class="row_field">
          <label>تعداد</label>
          <input type="number" id="angle-qty" value="1" min="1">
        </div>
      </div>

      <button id="angle-calc">
        محاسبه وزن
      </button>

      <p id="angle-result" class="result"> </p>
      
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function(){
      document.getElementById('angle-calc').addEventListener('click', function(){
        const b = parseFloat(document.getElementById('angle-size').value);     
        const t = parseFloat(document.getElementById('angle-thickness').value);
        const L = parseFloat(document.getElementById('angle-length').value);   
        const qty = parseInt(document.getElementById('angle-qty').value) || 1;
        const density = 7.85; 

        if(isNaN(b) || isNaN(t) || isNaN(L) || qty < 1){
          alert('لطفاً مقادیر معتبر وارد کنید.');
          return;
        }

        const area_mm2 = t * (2 * b - t); 

        const weight_one = area_mm2 * L * density / 1000.0; 
        const total = weight_one * qty;

        document.getElementById('angle-result').innerHTML =
          `وزن تقریبی کل: <b>${total.toFixed(3)}</b> کیلوگرم`;
      });
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('angle_calculator', 'angle_calculator_shortcode');
