<?php
/*
Template Name: فروش ویژه
*/

//get header
get_header(); 

$query_options = array();
$query_data = array();
$query_options['post_type'] = 'product';
$query_options['orderby'] = 'on_sale';
$query_options['posts_per_page'] = get_option('posts_per_page'); 
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$query_data = mweb_theme_query::get_custom_query($query_options,$paged);
		  

//create single class
$mweb_single_class   = array();
$mweb_single_class[] = 'is-page';
$mweb_single_class[] = 'inner_wrap';
$mweb_single_class[] = 'post-wrapper';
$mweb_single_class   = implode( ' ', $mweb_single_class );

mweb_open_page_wrap( 'page-layout-wrap', 'none' );
mweb_open_page_inner( 'page-layout-inner page_onsale', 'none' );
?>
<div class="block-title"><h1 class="title"><?php the_title(); ?></h1></div>


<?php

echo '<div class="row">';

if ( $query_data->have_posts() ) {
//render
while ( $query_data->have_posts() ) : 
	$query_data->the_post(); 
					
		echo '<div class="onsale_col col-12 col-sm-6 col-md-4 col-lg-3 item">';
			echo mweb_loop_template_product_onsale_loop();
		echo '</div>';

		
endwhile; 
 
} else {
	echo mweb_no_content();
}
echo '</div>';

mweb_pagination_standard($query_data , true);

mweb_close_page_inner();

mweb_close_page_wrap();



//get footer
get_footer();