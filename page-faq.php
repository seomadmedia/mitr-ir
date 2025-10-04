<?php
/*
Template Name: پرسش و پاسخ
*/

//get header
get_header(); 

$mweb_sidebar_name       = mweb_get_page_sidebar_name();
$mweb_sidebar_position   = mweb_get_page_sidebar_position();
$mweb_enable_comment_box = mweb_check_page_comment_box();

//create single class
$mweb_single_class   = array();
$mweb_single_class[] = 'is-page';
$mweb_single_class[] = 'inner_wrap';
$mweb_single_class[] = 'post-wrapper';
$mweb_single_class   = implode( ' ', $mweb_single_class );

mweb_open_page_wrap( 'page-layout-wrap', $mweb_sidebar_position );
mweb_open_page_inner( 'page-layout-inner', $mweb_sidebar_position );

//render
if ( have_posts() ) {
	while ( have_posts() ) {

		the_post();

		mweb_open_single_wrap( $mweb_single_class );

	echo '<div class="blog_top">';
		echo '<div class="blog_icon"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#message-question"></use></svg></div>';
		echo '<h1 class="blog_title">'. mweb_post_title(false) .'</h1>';
	echo  '</div>';


get_template_part( 'templates/single/block', 'entry' );
mweb_show_faq(); 
get_template_part( 'templates/single/block', 'tags' );



mweb_close_single_wrap();

		if ( ! empty( $mweb_enable_comment_box ) && 'none' != $mweb_enable_comment_box ) {
			get_template_part( 'templates/single/block', 'comment' );
		}
		
		
	}
}



mweb_close_page_inner();
//render sidebar
if ( ! empty( $mweb_sidebar_position ) && 'none' != $mweb_sidebar_position ) {
	mweb_get_sidebar( $mweb_sidebar_name );
}

mweb_close_page_wrap();



//get footer
get_footer();