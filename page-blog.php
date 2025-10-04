<?php
/*
Template Name: وبلاگ
*/


//get header
get_header(); 

$mweb_sidebar_name       = mweb_get_page_sidebar_name();
$mweb_sidebar_position   = mweb_get_page_sidebar_position();


//create single class
$mweb_single_class   = array();
$mweb_single_class[] = 'is-page';
$mweb_single_class[] = 'inner_wrap';
$mweb_single_class[] = 'post-wrapper';
$mweb_single_class   = implode( ' ', $mweb_single_class );

mweb_open_page_wrap( 'page-layout-wrap', $mweb_sidebar_position );
mweb_open_page_inner( 'page-layout-inner', $mweb_sidebar_position );



$loop_options['posts_per_page'] = get_option( 'posts_per_page' );

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$query_data = mweb_theme_query::get_custom_query($loop_options, $paged);
	
	

	//render
	if ( $query_data->have_posts() ) {

		while ( $query_data->have_posts() ) {
		$query_data->the_post();

		echo mweb_loop_template_blog_archive();
		
	}


	//pagination
	mweb_pagination_standard($query_data);


	} 


	
mweb_close_page_inner();
//render sidebar
if ( ! empty( $mweb_sidebar_position ) && 'none' != $mweb_sidebar_position ) {
	mweb_get_sidebar( $mweb_sidebar_name );
}

mweb_close_page_wrap();


//get footer
get_footer();