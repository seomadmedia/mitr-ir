<?php
/**
 * The template for displaying single posts and pages.
 * @package mweb themes
 */

get_header();
?>

<main id="site-content" role="main">

	<?php
	
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			if( 'post' == get_post_type() || is_singular('portfolio') )
				get_template_part( 'templates/single/style', '1' );
			else
				the_content();
		}
	}

	?>

</main>

<?php get_footer(); ?>
