<?php
//get header
get_header();

/**
 * This file display home layout
 */
//get home options
$mweb_options['page_layout']      = mweb_theme_util::get_theme_option( 'blog_layout' );
$mweb_options['sidebar_name']     = mweb_theme_util::get_theme_option( 'home_sidebar' );
$mweb_options['sidebar_position'] = mweb_theme_util::get_theme_option( 'home_sidebar_position' );


if ( 'default' == $mweb_options['sidebar_position'] ) {
	$mweb_options['sidebar_position'] = mweb_theme_util::get_theme_option( 'home_sidebar_position' );
}

//render layout
mweb_theme_blog_layout::render( $mweb_options );

//get footer
get_footer();