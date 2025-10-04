<?php
/*
Template Name: المنتور
*/

//get header
get_header(); 

		

//render
if ( have_posts() ) {
	while ( have_posts() ) {

		the_post();
		the_content();
		
	}
}



//get footer
get_footer();