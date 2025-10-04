<?php
/**
 * this file support views of post
 */

 
 
/**-------------------------------------------------------------------------------------------------------------------------
 * @param $post_id
 *
 * @return bool
 * add post view
 */
if ( ! function_exists( 'mweb_theme_post_view_add' ) ) {
	function mweb_theme_post_view_add( $post_id = null ) {
		
		if( !mweb_theme_util::get_theme_option('enable-postviews') ){
			return false;
		}

		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		if ( empty( $post_id ) ) {
			return false;
		}

		$total   = get_post_meta( $post_id, 'mweb_theme_view_total', true );
		$forgery = get_post_meta( $post_id, 'mweb_theme_meta_forgery_view', true );

		if ( ! empty( $total ) ) {
			$total ++;
			update_post_meta( $post_id, 'mweb_theme_view_total', $total );
		} else {
			update_post_meta( $post_id, 'mweb_theme_view_total', 1 );
		}

		$total_forgery = intval( $total ) + intval( $forgery );
		update_post_meta( $post_id, 'mweb_theme_view_total_forgery', $total_forgery );

		$date_id              = date( 'Ymd' );
		$week_view_total_data = get_post_meta( $post_id, 'mweb_theme_week_view_total', true );

		if ( empty( $week_view_total_data ) ) {
			add_post_meta( $post_id, 'mweb_theme_week_view_total', array() );
			add_post_meta( $post_id, 'mweb_theme_week_view_total_num', '' );

			$week_view_total_data = array();
		}

		if ( is_array( $week_view_total_data ) ) {
			if ( array_key_exists( $date_id, $week_view_total_data ) ) {
				$week_view_total_data[ $date_id ] ++;
			} else {
				$week_view_total_data[ $date_id ] = 1;
			}

			$check = get_transient( 'mweb_theme_week_view_check_' . $post_id );
			if ( ! $check ) {
				foreach ( $week_view_total_data as $k => $v ) {
					if ( strtotime( $k . ' +7 days' ) < strtotime( key( array_slice( $week_view_total_data, - 1, 1, true ) ) ) ) {
						unset ( $week_view_total_data[ $k ] );
					} else {
						break;
					}
				};
				set_transient( 'mweb_theme_week_view_check_' . $post_id, 1, 6 * 3600 );
			}

			update_post_meta( $post_id, 'mweb_theme_week_view_total', $week_view_total_data );
			update_post_meta( $post_id, 'mweb_theme_week_view_total_num', array_sum( $week_view_total_data ) );
		}

		return false;
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @param $post_id
 *
 * @return bool
 * init save post
 */
if ( ! function_exists( 'mweb_theme_post_view_init' ) ) {
	function mweb_theme_post_view_init( $post_id ) {

		$total_forgery = get_post_meta( $post_id, 'mweb_theme_view_total_forgery', true );
		$forgery       = get_post_meta( $post_id, 'mweb_theme_meta_forgery_view', true );

		if ( ! empty( $forgery ) && empty( $total_forgery ) ) {
			update_post_meta( $post_id, 'mweb_theme_view_total_forgery', $forgery );
		}

		return false;
	}

	add_action( 'save_post', 'mweb_theme_post_view_init' );
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @param $post_id
 *
 * @return bool|mixed
 * get real post view
 */
if ( ! function_exists( 'mweb_theme_post_view_real' ) ) {
	function mweb_theme_post_view_real( $post_id = null ) {

		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		$total = get_post_meta( $post_id, 'mweb_theme_view_total', true );

		return $total;
	}
}


/**-------------------------------------------------------------------------------------------------------------------------
 * @param null $post_id
 *
 * @return int|mixed|string
 * get post view
 */
if ( ! function_exists( 'mweb_theme_post_view_total' ) ) {
	function mweb_theme_post_view_total( $post_id = null ) {

		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		$total = get_post_meta( $post_id, 'mweb_theme_view_total_forgery', true );
		$total = mweb_theme_show_over_100k( $total );

		return $total;
	}
}




/**-------------------------------------------------------------------------------------------------------------------------
 * @param $number
 *
 * @return int|string
 * show over 100k
 */
if ( ! function_exists( 'mweb_theme_show_over_100k' ) ) {
	function mweb_theme_show_over_100k( $number ) {
		$number = intval( $number );

		if ( $number > 1000000 ) {
			$number = round( $number / 1000000, 2 ) . 'میلیون';
		} elseif ( $number > 10000 ) {
			$number = round( $number / 1000, 1 ) . 'هزار';
		} elseif ( $number > 1000 ) {
			$number = round( $number / 1000, 2 ) . 'هزار';
		}

		return $number;
	}
}