<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!--meta tag-->
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>

	<?php wp_head(); ?>

</head>
<body <?php body_class(); mweb_theme_schema::makeup( 'body' ); ?>>
	<?php wp_body_open(); ?>
	<?php $mweb_preloader = mweb_theme_util::get_theme_option('mweb_preloader');
		if( $mweb_preloader )
			echo '<div id="preloader"></div>';
	?>
	<?php get_template_part( 'templates/section', 'header' ); ?>
	<?php //remove_all_actions( 'mweb_theme_header' ); ?>
	<?php do_action( 'mweb_theme_header' ); ?>
	<?php if( is_singular( array('post', 'product') ) );
		mweb_theme_post_view_add();
	?>
	
	<div class="mweb-site-mask"></div>
	<?php do_action('mweb_after_header_hook'); ?>
	