<?php
/**
 * Template Name: در دست ساخت
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div class="under_construction">
		<div class="container">
		<header class="construction_head">
		<?php get_template_part( 'templates/header/module', 'logo' ); ?>
		</header>
		
		<?php 
		
			$under_construction_title = mweb_theme_util::get_theme_option( 'under_construction_title' );
			$under_construction_content = mweb_theme_util::get_theme_option( 'under_construction_content' );


			echo '<h2>'.$under_construction_title.'</h2>';
			if($under_construction_content){
				echo '<div class="construction_entry entry">'.$under_construction_content.'</div>';
			}
			$under_construction_time = mweb_theme_util::get_theme_option( 'under_construction_time' );
			if( !empty($under_construction_time) ){
				printf('<div class="construction_countdown"><div class="product-date" data-date="%s"></div></div>', $under_construction_time);
			}

		?>
	

		</div>
        </div> 
        <?php wp_footer(); ?>
    </body>
</html>