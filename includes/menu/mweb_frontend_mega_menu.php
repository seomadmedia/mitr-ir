<?php

/**-------------------------------------------------------------------------------------------------------------------------
 * Class mweb_menu_Walker
 * this file display front end mega menu
 */
class mweb_mega_menu_walker extends Walker_Nav_Menu {
	
	protected $background_image;
	
	function start_lvl(&$output, $depth = 0, $args = array()) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );
	 
		// Default class.
		$classes = array( 'sub-menu' );
	 
		$attr_names  = '';

		if($this->background_image !== '' && $depth == 0) {
			$attr_names  = 'style="background-image:url('. $this->background_image .')"';
		}
				
		$class_names = implode( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
	 
		$output .= "{$n}{$indent}<ul$class_names $attr_names>{$n}";
	}

		
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = $full_width = $mega_menu_cols = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
		
		$classes_array = array(); 
		$classes_array[] = empty( $item->megamenu ) ? "std-menu" : "mega-menu";
		//if ( ! empty( $item->megamenu ) && ! empty( $item->submegamenu )) {
		if ( $depth == 0 && ! empty( $item->megamenu ) ) {
			$classes_array[] = empty( $item->isfullwidth ) ? "mega-menu-fw" : "mega-menu-fullwidth-width";
			if(! empty( $item->submegamenu ))
				$classes_array[] = 'menu-item-has-children menu_has_sub_megamenu';
		}
		$menu_width        = empty( $item->menuwidth ) ? "" : 'style="width: ' . esc_attr( $item->menuwidth ) . 'px;"';
		$classes_array[]   = empty( $item->loggedin ) ? "" : "menu-item-loggedin";
		$classes_array[]   = empty( $item->loggedout ) ? "" : "menu-item-loggedout";
		$classes_array[]   = empty( $item->newbadge ) ? "" : "menu-item-new-badge";
		$classes_array[]   = empty( $item->salebadge ) ? "" : "menu-item-sale-badge";
		$classes_array[]   = empty( $item->htmlcontent ) ? "" : "menu-item-html";
		$classes_array[]   = empty( $item->icon ) ? "" : "menu-icon-image";
		$classes_array[]   = empty( $item->hidetitle ) ? "" : "menu-hide-title";
		
		if(!empty($item->imagemenu)){
			$this->background_image = $item->imagemenu;
			$classes_array[] = "menu-item-bg";
		}else{
			$this->background_image = '';
		}
		
		
		if ( !empty( $item->megamenu ) && empty( $item->submegamenu ) ) {
			$item_col = empty($item->menucol) ? '3' : $item->menucol;
			$classes_array[] = 'menu-has-col item-inrow-'.$item_col;
			if($item->direction == 'vertical')
				$classes_array[] = 'item-dir-'.$item->direction;
		}
		
		
		$classes_array[] = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="level-'.esc_attr( $depth ).' menu-item-' . esc_attr($item->ID) . ' '.esc_attr(implode(' ', array_filter($classes_array))).'" ' . esc_attr($menu_width);
		$output .= $indent . '<li ' .$class_names . '>';
		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';
		$prepend = '<span class="el_text">';
		$append  = '</span>';
		//$description = ! empty( $item->description ) ? '<span class="menu-item-desc">' . esc_attr( $item->description ) . '</span>' : '';
		$description = '';
		if ( $depth != 0 ) {
			$append = $prepend = "";
		}
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before;
		if ( ! empty( $item->icon ) ) {
			$item_output .= '<div class="el_icon">'.$item->icon.'</div>';
		}				
		$item_output .= $prepend;

		if ( ! empty( $item->imagemenu ) ) {
			//$item_output .= '<span class="menu-img"><img src="'.esc_url($item->imagemenu).'" alt="'.esc_attr__('تصویر پس زمینه', 'mweb').'"/></span>';
		}
			
		$item_output .= apply_filters( 'the_title', $item->title, $item->ID ) . $append;
		$item_output .= $description . $args->link_after;
		
		if( !empty( $item->newbadge ) ){
			$item_output .= '<span class="new-badge">'.esc_html__('جدید', 'mweb').'</span>';
		}
		if( !empty( $item->salebadge ) ){
			$item_output .= '<span class="sale-badge">داغ</span>';
		}		
		
		if($args->walker->has_children || $item->megamenu){
			$item_output .= '<span class="el_arrow"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-down"></use></svg></span>';
        }  
		
		$item_output .= '</a>';
		if ( ! empty( $item->megamenu) && ! empty( $item->submegamenu ) && in_array( 'elementor/elementor.php', apply_filters('active_plugins', get_option( 'active_plugins' ))) ) {
			$elementor_instance = Elementor\Plugin::instance();
			$item_output .= '<div class="sub-menu">';
			$item_output .= $elementor_instance->frontend->get_builder_content_for_display( $item->submegamenu );
			$item_output .= '</div>';
		}			
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	
}





class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu {
	/**
	 * @see   Walker_Nav_Menu::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
	}
	/**
	 * @see   Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
	}
	/**
	 * @see   Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		ob_start();
		$item_id      = esc_attr( $item->ID );
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);
		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) ) {
				$original_title = false;
			}
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			if ( isset( $original_object ) ) {
				$original_title = $original_object->post_title;
			}
		}
		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive' ),
		);
		$title = $item->title;
		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			$title = sprintf( esc_html__( '%s (غیر معتبر)', 'mweb' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			$title = sprintf( esc_html__( '%s (در انتظار)', 'mweb' ), $item->title );
		}
		$title = empty( $item->label ) ? $title : $item->label;
		?>
	<li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo esc_attr(implode( ' ', $classes )); ?>">
	<dl class="menu-item-bar">
		<dt class="menu-item-handle">
			<span class="item-title"><?php echo esc_html( $title ); ?></span>
				<span class="item-controls">
					<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
					<span class="item-order hide-if-js">
						<a href="<?php
							echo esc_url(wp_nonce_url(
								add_query_arg(
									array(
										'action'    => 'move-up-menu-item',
										'menu-item' => $item_id,
									),
									remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
								),
								'move-menu_item'
							));
						?>" class="item-move-up"><abbr
								title="<?php esc_attr__( 'انتقال به بالا', 'mweb' ); ?>">
								&#8593;</abbr></a>
						|
						<a href="<?php
							echo esc_url(wp_nonce_url(
								add_query_arg(
									array(
										'action'    => 'move-down-menu-item',
										'menu-item' => $item_id,
									),
									remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
								),
								'move-menu_item'
							));
						?>" class="item-move-down"><abbr
								title="<?php esc_attr__( 'انتقال به پایین', 'mweb' ); ?>">&#8595;</abbr></a>
					</span>
					<a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>"
					   title="<?php esc_attr__( 'ویرایش مورد', 'mweb' ); ?>" href="<?php
						echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
					?>"><?php esc_html_e( 'ویرایش مورد', 'mweb' ); ?></a>
				</span>
		</dt>
	</dl>
	<div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr($item_id); ?>">
		<?php if ( 'custom' == $item->type ) : ?>
			<p class="field-url description description-wide">
				<label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
					<?php esc_html_e( 'آدرس', 'mweb' ); ?><br/>
					<input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>"
						   class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]"
						   value="<?php echo esc_attr( $item->url ); ?>"/>
				</label>
			</p>
		<?php endif; ?>
		<p class="description description-thin">
			<label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
				<?php esc_html_e( 'برچسب', 'mweb' ); ?><br/>
				<input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>"
					   class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]"
					   value="<?php echo esc_attr( $item->title ); ?>"/>
			</label>
		</p>
		<p class="description description-thin">
			<label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
				<?php esc_html_e( 'مشخصه عنوان', 'mweb' ); ?><br/>
				<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>"
					   class="widefat edit-menu-item-attr-title"
					   name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]"
					   value="<?php echo esc_attr( $item->post_excerpt ); ?>"/>
			</label>
		</p>
		<p class="description">
			<label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
				<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank"
					   name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
				<?php esc_html_e( 'بازکردن در تب جدید', 'mweb' ); ?>
			</label>
		</p>
		<p class="description description-thin">
			<label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
				<?php esc_html_e( 'کلاس CSS / اختیاری', 'mweb' ); ?><br/>
				<input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>"
					   class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]"
					   value="<?php echo esc_attr( implode( ' ', $item->classes ) ); ?>"/>
			</label>
		</p>
		<p class="description description-thin">
			<label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
				<?php esc_html_e( 'پیوند ارتباط (XFN)', 'mweb' ); ?><br/>
				<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>"
					   class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]"
					   value="<?php echo esc_attr( $item->xfn ); ?>"/>
			</label>
		</p>
		<p class="description description-wide">
			<label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
				<?php esc_html_e( 'توضیحات', 'mweb' ); ?><br/>
				<textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>"
						  class="widefat edit-menu-item-description" rows="3" cols="20"
						  name="menu-item-description[<?php echo esc_attr($item_id); ?>]"><?php echo esc_textarea( $item->description ); // textarea_escaped ?></textarea>
				<span
					class="description"><?php esc_html_e( 'توضیحات در منو نمایش داده خواهد شد اگر قالب فعلی آن را پشتیبانی کند.', 'mweb' ); ?></span>
			</label>
		</p>
		<?php 
			// This is the added section
			do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args );
		?>
		<div class="menu-item-actions description-wide submitbox">
			<?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
				<p class="link-to-original">
					<?php printf( __( 'اصلی: %s', 'mweb' ), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
				</p>
			<?php endif; ?>
			<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
				echo wp_nonce_url(
					add_query_arg(
						array(
							'action'    => 'delete-menu-item',
							'menu-item' => $item_id,
						),
						remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
					),
					'delete-menu_item_' . $item_id
				); ?>">
				<?php esc_html_e( 'حذف', 'mweb' ); ?></a> <span class="meta-sep"> | </span> <a
				class="item-cancel submitcancel" id="cancel-<?php echo esc_attr($item_id); ?>"
				href="<?php echo esc_url( add_query_arg( array(
							'edit-menu-item' => $item_id,
							'cancel'         => time()
						), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) ) ) );
				?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e( 'انصراف', 'mweb' ); ?></a>
		</div>
		<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]"
			   value="<?php echo esc_attr($item_id); ?>"/>
		<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]"
			   value="<?php echo esc_attr( $item->object_id ); ?>"/>
		<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]"
			   value="<?php echo esc_attr( $item->object ); ?>"/>
		<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]"
			   value="<?php echo esc_attr( $item->menu_item_parent ); ?>"/>
		<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]"
			   value="<?php echo esc_attr( $item->menu_order ); ?>"/>
		<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]"
			   value="<?php echo esc_attr( $item->type ); ?>"/>
	</div>
	<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}
}





class mweb_alt_menu_walker extends Walker_Nav_Menu {
	function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = $mega_menu_cols = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes_array = array();
		$classes_array[] = empty( $item->loggedin ) ? "" : "menu-item-loggedin";
		$classes_array[] = empty( $item->loggedout ) ? "" : "menu-item-loggedout";
		
		$classes_array[] = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="menu-item-' . esc_attr($item->ID) . ' ' . esc_attr(implode(' ', array_filter($classes_array))) . '"';
		$output .= $indent . '<li ' . esc_attr($value) . $class_names . '>';
		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';
		$prepend = '';
		$append  = '';
		//$description = ! empty( $item->description ) ? '<span class="menu-item-desc">' . esc_attr( $item->description ) . '</span>' : '';
		$description = '';
		if ( $depth != 0 ) {
			$append = $prepend = "";
		}
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		if ( ! empty( $item->icon ) ) {
			$item_output .= '<div class="el_icon">'.$item->icon.'</div>';
		}
		$item_output .= $args->link_before . $prepend;
		$item_output .= apply_filters( 'the_title', $item->title, $item->ID ) . $append;
		$item_output .= $description . $args->link_after;
		if($args->walker->has_children){
			$item_output .= '<span class="explain-menu"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="'.mweb_print_sprites_path().'#arrow-left-1"></use></svg></span>';
        }  
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}	





/**-------------------------------------------------------------------------------------------------------------------------
 * fallback navigation
 */
if ( ! function_exists( 'mweb_menu_navigation_fallback' ) ) {
	function mweb_menu_navigation_fallback() {

		echo '<div class="no-menu is-error">';
		echo  'از پنل مدیریت فهرستی را انتخاب کنید '. '<a href="' . get_admin_url( get_current_blog_id(), 'nav-menus.php' ) . '">فهرست ها</a>';
		echo '</div>';

	}
}
