<?php
/**-------------------------------------------------------------------------------------------------------------------------
 * @param $mweb_options
 *
 * @return string
 * render general layout
 */
if ( ! class_exists( 'mweb_theme_general_layout' ) ) {
	class mweb_theme_general_layout {

		/**-------------------------------------------------------------------------------------------------------------------------
		 * @param $mweb_options
		 * render layout
		 */
		static function render( $mweb_options ) {

			//render
			mweb_open_page_inner( 'block-wrapper', $mweb_options['sidebar_position'], 'grid-layout' );
			mweb_get_breadcrumbs();
			mweb_open_content_inner();
			
			?>

			<header class="block-title">
				<h1 class="title"><?php single_cat_title(); ?></h1>
			</header>
			<?php
				ob_start();
				echo category_description();
				$my_desc = ob_get_clean();
			?>
			<?php if( !empty( $my_desc ) ){ ?>
				<div class="term-description-wrap">
					<?php echo $my_desc; ?>
					<div class="loadmore">اطلاعات بیشتر ...</div>
				</div>
			<?php } 
			$loop_name = isset($mweb_options['loop_name']) ? $mweb_options['loop_name']	: 'mweb_loop_template_blog_archive';					
			if( isset($mweb_options['row']) )
				echo '<div class="row">';
			
				while ( have_posts() ) {
					the_post();

					echo $loop_name();

				}
			
			if( isset($mweb_options['row']) )
				echo '</div>';


			//pagination
			mweb_pagination();

			
			mweb_close_content_inner();

			
			mweb_close_page_inner();
		}

	}
}
