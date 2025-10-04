<?php
/**
 * This file display search page
 */

//get header
get_header();  
 
//get blog options
$mweb_options = array();

$mweb_options['page_layout']      = mweb_theme_util::get_theme_option( 'archive_layouts' );
$mweb_options['sidebar_name']     = mweb_theme_util::get_theme_option( 'archive_sidebar' );
$mweb_options['sidebar_position'] = mweb_theme_util::get_theme_option( 'archive_sidebar_position' );

if ( 'default' == $mweb_options['sidebar_position'] ) {
	$mweb_options['sidebar_position'] = mweb_theme_util::get_theme_option( 'home_sidebar_position' );
}

if ( have_posts() ) {
	//render
	mweb_theme_blog_layout::render( $mweb_options );
} else {
	get_template_part( 'templates/search', 'no_content' );
}


//get footer
get_footer();