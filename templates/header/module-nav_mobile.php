<div class="off-canvas-wrap">
	<div class="close-off-canvas-wrap"><a href="#" id="mweb-close-off-canvas"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M324.5 411.1c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L214.6 256 347.1 123.5c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L192 233.4 59.5 100.9c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L169.4 256 36.9 388.5c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L192 278.6 324.5 411.1z"/></svg></a></div>
	<div class="off-canvas-inner">
	<?php
		if ( function_exists( 'elementor_theme_do_location' ) && elementor_theme_do_location( 'menu_mobile' ) ) {
			elementor_theme_do_location( 'menu_mobile' );
		} else { ?>
			<div id="mobile-nav" class="mobile-menu-wrap">
				<?php wp_nav_menu(
					array(
						'theme_location' => 'two-menu',
						'container'      => '',
						'menu_class'     => 'mobile-menu',
						'depth'          => 6,
						//'echo'           => true,
						'walker'         => new mweb_alt_menu_walker(),
						'before'         => '',
						'link_before'    => '',
						'link_after'     => '',
						'after'          => '',
						)
				); ?>
			</div>
	<?php }	?>
	</div>
</div> 