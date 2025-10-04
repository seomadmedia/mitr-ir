<?php
defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!--meta tag-->
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Type" content="text/html;">
	<title><?= @$title ?></title>
	<style type="text/css">
	<?php
	
		$mweb_font_family = mweb_theme_util::get_theme_option( 'mweb_font_family' ); 
		
		$site_url = THEME_ASSET;
		$str = '';
		$str_font = '';

		if( $mweb_font_family == 'dana' ){
			$font_array = ['Dana', 'Dananum'];
			$str_font .= '@font-face {
				font-family: "Dana";
				font-style: normal;
				font-weight: 500;
				font-display:block;
				src: url("[site_url]/fonts/Dana-medium.woff") format("woff"), 
				url("[site_url]/fonts/Dana-medium.woff2") format("woff2"), 
				url("[site_url]/fonts/Dana-medium.ttf") format("truetype");
			}
			@font-face {
				font-family: "Dana";
				font-style: normal;
				font-weight: normal;
				font-display:block;
				src: url("[site_url]/fonts/Dana-regular.woff") format("woff"), 
				url("[site_url]/fonts/Dana-regular.woff2") format("woff2"), 
				url("[site_url]/fonts/Dana-regular.ttf") format("truetype");
			}
			@font-face {
				font-family: "Dananum";
				font-style: normal;
				font-weight: 500;
				font-display:block;
				src: url("[site_url]/fonts/Dana-medium-fanum.woff") format("woff"), 
				url("[site_url]/fonts/Dana-medium-fanum.woff2") format("woff2"), 
				url("[site_url]/fonts/Dana-medium-fanum.ttf") format("truetype");
			}
			@font-face {
				font-family: "Dananum";
				font-style: normal;
				font-weight: normal;
				font-display:block;
				src: url("[site_url]/fonts/Dana-regular-fanum.woff") format("woff"), 
				url("[site_url]/fonts/Dana-regular-fanum.woff2") format("woff2"), 
				url("[site_url]/fonts/Dana-regular-fanum.ttf") format("truetype");
			}';
		} elseif( $mweb_font_family == 'iranyekan' ){
			$font_array = ['IRANYekan', 'IRANYekannum'];
			$str_font .= '@font-face {
				font-family: "IRANYekan";
				font-style: normal;
				font-weight: 500;
				font-display:block;
				src: url("[site_url]/fonts/IRYekan-medium.eot");
				src: url("[site_url]/fonts/IRYekan-medium.eot?#iefix") format("embedded-opentype"), 
				url("[site_url]/fonts/IRYekan-medium.woff") format("woff"), 
				url("[site_url]/fonts/IRYekan-medium.ttf") format("truetype");
			}
			@font-face {
				font-family: "IRANYekan";
				font-style: normal;
				font-weight: normal;
				font-display:block;
				src: url("[site_url]/fonts/IRYekan-regular.eot");
				src: url("[site_url]/fonts/IRYekan-regular.eot?#iefix") format("embedded-opentype"), 
				url("[site_url]/fonts/IRYekan-regular.woff") format("woff"), 
				url("[site_url]/fonts/IRYekan-regular.ttf") format("truetype");
			}
			@font-face {
				font-family: "IRANYekannum";
				font-style: normal;
				font-weight: 500;
				font-display:block;
				src: url("[site_url]/fonts/IRYekan-medium-fanum.eot");
				src: url("[site_url]/fonts/IRYekan-medium-fanum.eot?#iefix") format("embedded-opentype"), 
				url("[site_url]/fonts/IRYekan-medium-fanum.woff") format("woff"), 
				url("[site_url]/fonts/IRYekan-medium-fanum.ttf") format("truetype");
			}
			@font-face {
				font-family: "IRANYekannum";
				font-style: normal;
				font-weight: normal;
				font-display:block;
				src: url("[site_url]/fonts/IRYekan-regular-fanum.eot");
				src: url("[site_url]/fonts/IRYekan-regular-fanum.eot?#iefix") format("embedded-opentype"), 
				url("[site_url]/fonts/IRYekan-regular-fanum.woff") format("woff"), 
				url("[site_url]/fonts/IRYekan-regular-fanum.ttf") format("truetype");
			}';
		} elseif( $mweb_font_family == 'yekanbakh' ){
			$font_array = ['YekanBakh', 'YekanBakhnum'];
			$str_font .= '@font-face {
				font-family: "YekanBakh";
				font-style: normal;
				font-weight: 500;
				font-display:block;
				src: url("[site_url]/fonts/YekanBakh-semibold.woff") format("woff"), 
				url("[site_url]/fonts/YekanBakh-semibold.woff2") format("woff2");
			}
			@font-face {
				font-family: "YekanBakh";
				font-style: normal;
				font-weight: normal;
				font-display:block;
				src: url("[site_url]/fonts/YekanBakh-regular.woff") format("woff"), 
				url("[site_url]/fonts/YekanBakh-regular.woff2") format("woff2");
			}
			@font-face {
				font-family: "YekanBakhnum";
				font-style: normal;
				font-weight: 500;
				font-display:block;
				src: url("[site_url]/fonts/YekanBakh-semibold-fanum.woff") format("woff"), 
				url("[site_url]/fonts/YekanBakh-semibold-fanum.woff2") format("woff2");
			}
			@font-face {
				font-family: "YekanBakhnum";
				font-style: normal;
				font-weight: normal;
				font-display:block;
				src: url("[site_url]/fonts/YekanBakh-regular-fanum.woff") format("woff"), 
				url("[site_url]/fonts/YekanBakh-regular-fanum.woff2") format("woff2");
			}';
		} else{
			$font_array = ['IRANSans', 'IRANSansnum'];
			$str_font .= '@font-face {
				font-family: "IRANSans";
				font-style: normal;
				font-weight: 500;
				font-display:block;
				src: url("[site_url]/fonts/IRANSans-medium.eot");
				src: url("[site_url]/fonts/IRANSans-medium.eot?#iefix") format("embedded-opentype"), 
				url("[site_url]/fonts/IRANSans-medium.woff") format("woff"), 
				url("[site_url]/fonts/IRANSans-medium.ttf") format("truetype");
			}
			@font-face {
				font-family: "IRANSans";
				font-style: normal;
				font-weight: normal;
				font-display:block;
				src: url("[site_url]/fonts/IRANSans.eot");
				src: url("[site_url]/fonts/IRANSans.eot?#iefix") format("embedded-opentype"), 
				url("[site_url]/fonts/IRANSans.woff") format("woff"), 
				url("[site_url]/fonts/IRANSans.ttf") format("truetype");
			}
			@font-face {
				font-family: "IRANSansnum";
				font-style: normal;
				font-weight: 500;
				font-display:block;
				src: url("[site_url]/fonts/IRANSans-medium-fanum.eot");
				src: url("[site_url]/fonts/IRANSans-medium-fanum.eot?#iefix") format("embedded-opentype"), 
				url("[site_url]/fonts/IRANSans-medium-fanum.woff") format("woff"), 
				url("[site_url]/fonts/IRANSans-medium-fanum.ttf") format("truetype");
			}
			@font-face {
				font-family: "IRANSansnum";
				font-style: normal;
				font-weight: normal;
				font-display:block;
				src: url("[site_url]/fonts/IRANSans-fanum.eot");
				src: url("[site_url]/fonts/IRANSans-fanum.eot?#iefix") format("embedded-opentype"), 
				url("[site_url]/fonts/IRANSans-fanum.woff") format("woff"), 
				url("[site_url]/fonts/IRANSans-fanum.ttf") format("truetype");
			}';
		}
			
		
		$str_font .= '@font-face {
			font-family: "Font Awesome 6";
			font-style: normal;
			font-weight: 300;
			font-display: swap;
			src: url("[site_url]/fonts/fa-light-300.woff2") format("woff2"),
			url("[site_url]/fonts/fa-light-300.ttf") format("truetype"); 
		}
		@font-face {
			font-family: "Font Awesome 6 Brands";
			font-style: normal;
			font-weight: 400;
			font-display: swap;
			src: url("[site_url]/fonts/fa-brands-400.woff2") format("woff2"),
			url("[site_url]/fonts/fa-brands-400.ttf") format("truetype");
		}
		'; 

		$str .= str_replace('[site_url]', $site_url, $str_font);
		$str .= ':root {';
			$str .= '--mainfont: '.$font_array[0].';';
			$str .= '--mainfontnum: '.$font_array[1].';';
		$str .= '}';
		
		$label_size = mweb_theme_util::get_theme_option('invoice_label_size');
		if( isset($type) && $type == 'label' ){
			
			$str .= '@media print{@page{size:'.$label_size['Width'].'cm '.$label_size['Height'].'cm;margin:0}}';
			$str .= 'body{ padding: 0; margin: 0 }';
			$str .= '.container_label{ width:'.$label_size['Width'].'cm; height:'.$label_size['Height'].'cm; }';
		}

		echo $str;

	?>
	</style>
	<link href="<?= THEME_ASSET.'/css/invoice.css' ?>" rel="stylesheet" media="screen,print" />

</head>
<body>
