<div class="togglesidebar categories_sidebar">
	<div class="cart_sidebar_wrap">
		<div class="cart_sidebar_head">
			<div class="cart_sidebar_close close_sidebar" data-class="open_categories_sidebar"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#close-square"></use></svg></div>
			<strong>دسته بندی ها</strong>
		</div>
		<div class="sidebar_toggle_content">
			<?php 
				$args = array(
						'before_widget' => '<div class="widget wt_filter %1$s">',
						'after_widget'  => '</div></div>',
						'before_title'  => '<div class="wt_title">',
						'after_title'   => '</div><div class="widget-content">'
					);
				the_widget( 'WC_Widget_Product_Categories', null, $args );
				
			?>
		</div>
	</div>
</div>
