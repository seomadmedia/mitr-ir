<?php
/*
Template Name: تمام عرض
*/

//get header
get_header(); 

		  
//create single class
$mweb_single_class   = array();
$mweb_single_class[] = 'is-page';
$mweb_single_class[] = 'inner_wrap';
$mweb_single_class[] = 'post-wrapper';
$mweb_single_class   = implode( ' ', $mweb_single_class );

mweb_open_page_wrap( 'page-layout-wrap', 'none' );
mweb_open_page_inner( 'page-layout-inner page_onsale', 'none' );
?>
<div class="block-title"><h1 class="title"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#document"></use></svg><?php the_title(); ?></h1></div>


<?php

echo '<div class="row">';

//render
if ( have_posts() ) {
	while ( have_posts() ) {

		the_post();
					
		echo '<div class="compare col-12">';
			the_content();
		echo '</div>';

		
	}
}
 

echo '</div>';


mweb_close_page_inner();
mweb_close_page_wrap();


//get footer
get_footer();