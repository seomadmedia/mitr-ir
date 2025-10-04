<?php


if ( ! function_exists( 'mweb_theme_ajax_view_get' ) ) {
	add_action( 'wp_ajax_nopriv_mweb_theme_ajax_view_get', 'mweb_theme_ajax_view_get' );
	add_action( 'wp_ajax_mweb_theme_ajax_view_get', 'mweb_theme_ajax_view_get' );

	function mweb_theme_ajax_view_get() {

		if ( ! empty( $_POST['post_id'] ) ) {
			$post_id = esc_attr( $_POST['post_id'] );
		}

		if ( empty( $post_id ) && ! function_exists( 'mweb_theme_post_view_total' ) ) {
			die( json_encode( '' ) );
		}

		$total_view = mweb_theme_post_view_total( $post_id );

		die( json_encode( $total_view ) );
	}
}


if ( ! function_exists( 'mweb_theme_ajax_view_add' ) ) {
	add_action( 'wp_ajax_nopriv_mweb_theme_ajax_view_add', 'mweb_theme_ajax_view_add' );
	add_action( 'wp_ajax_mweb_theme_ajax_view_add', 'mweb_theme_ajax_view_add' );

	function mweb_theme_ajax_view_add() {

		if ( ! empty( $_POST['post_id'] ) && function_exists( 'mweb_theme_post_view_add' ) ) {
			$post_id = esc_attr( $_POST['post_id'] );
		}

		if ( empty( $post_id ) ) {
			die( json_encode( '' ) );
		}

		mweb_theme_post_view_add( $post_id );

		die( json_encode( '1' ) );
	}
}