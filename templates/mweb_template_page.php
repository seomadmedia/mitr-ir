<?php


//mweb_theme_page


/**
 * @return mixed|string
 * get sidebar position setting
 */
function mweb_get_page_sidebar_position() {

	//sidebar position
	$sidebar_position = get_post_meta( get_the_ID(), 'mweb_sidebar_position', true );

	//override sidebar position
	if ( 'default' == $sidebar_position || empty( $sidebar_position ) ) {
		$sidebar_position = mweb_theme_util::get_theme_option( 'page_sidebar_position' );
	}

	return $sidebar_position;
}





/**
 * @return mixed|string
 * get sidebar name of page
 */
function mweb_get_page_sidebar_name() {

	//sidebar position
	$sidebar_name = get_post_meta( get_the_ID(), 'mweb_sidebar_title', true );

	if ( 'mweb_default_from_theme_options' == $sidebar_name || empty( $sidebar_name ) ) {
		$sidebar_name = mweb_theme_util::get_theme_option( 'page_sidebar' );
	}

	return $sidebar_name;
}





/**
 * @return mixed|string
 * get first_paragraph setting
 */
function mweb_check_page_comment_box() {

	$mweb_comment_box = get_post_meta( get_the_ID(), 'mweb_single_comment_box', true );
	if ( 'default' == $mweb_comment_box || empty( $mweb_comment_box ) ) {
		$mweb_comment_box = mweb_theme_util::get_theme_option( 'mweb_single_comment' );
	};

	return $mweb_comment_box;
}

