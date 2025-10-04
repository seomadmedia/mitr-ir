<?php
	
$mweb_product_sidebar  = mweb_theme_util::get_theme_option( 'mweb_product_sidebar' );
//render sidebar
mweb_get_sidebar( $mweb_product_sidebar );
