<?php

/**-------------------------------------------------------------------------------------------------------------------------
 * Class mweb_menu_walker_backend
 * this file edit menu in backend
 */
//admin menu setting

 class mweb_mega_menu {

        function __construct() {
			// add new fields via hook
			add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'mweb_mega_menu_add_custom_fields' ), 10, 5 );
            // add custom menu fields to menu
            add_filter( 'wp_setup_nav_menu_item', array( $this, 'mweb_mega_menu_add_custom_nav_fields' ) );
            // save menu custom fields
            add_action( 'wp_update_nav_menu_item', array( $this, 'mweb_mega_menu_update_custom_nav_fields' ), 10, 3 );
            // edit menu walker
            add_filter( 'wp_edit_nav_menu_walker', array( $this, 'mweb_mega_menu_edit_walker' ), 10, 2 );
        } 
		
		
		function mweb_get_megamenu() {
			$megamenu = array();
			$megamenus = get_posts( array('posts_per_page' => -1, 'post_type' => 'mweb_megamenu') );
			foreach ($megamenus as $value) {
				$megamenu[$value->ID] = $value->post_title;
			}
			return $megamenu;
		}
		
		
        function mweb_mega_menu_add_custom_fields( $item_id, $item, $depth, $args ) {
			?>
        	<div class="menu-options">
				<?php if ( $depth == 0 ) { ?>
					<p><b><?php esc_html_e( 'تنظیمات مگامنو', 'mweb' ); ?></b></p>
					<p class="field-custom description description-wide">
						<label for="edit-menu-megamenu-<?php echo esc_attr($item_id); ?>">
							<input type="checkbox" id="edit-menu-megamenu-<?php echo esc_attr($item_id); ?>"
								   class="edit-menu-item-custom" id="menu-megamenu[<?php echo esc_attr($item_id); ?>]"
								   name="menu-megamenu[<?php echo esc_attr($item_id); ?>]"
								   value="1" <?php echo checked( ! empty( $item->megamenu ), 1, false ); ?> />
							<?php esc_html_e( 'فعال سازی مگامنو', 'mweb' ); ?>
						</label>
					</p>
					<?php $megamenus = self::mweb_get_megamenu(); ?>
					<p class="field-custom description description-wide">
						<label for="edit-menu-submegamenu-<?php echo esc_attr($item_id); ?>">
							<select class="fat" id="edit-menu-submegamenu-<?php echo esc_attr($item_id); ?>" name="menu-submegamenu[<?php echo esc_attr($item_id); ?>]">
								<?php echo '<option value = "">' . esc_html__('هیچ','mweb') . '</option>'; ?>
								<?php foreach($megamenus as $key => $submenu) {
									if ( $key == $item->submegamenu ) {
										echo '<option value = "'.esc_html($key).'" selected="selected">' . esc_html($submenu) . '</option>';
									} else {
										echo '<option value = "'.esc_html($key).'">' . esc_html($submenu) . '</option>';
									}
								}
								?>
							</select>
						</label>
					</p>
					<p class="field-custom description description-wide">
						<label for="edit-menu-item-col-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e('تعداد ستون (در صورت عدم استفاده از گزینه بالا)', 'mweb'); ?>
							<select class="fat" id="edit-menu-item-col-<?php echo esc_attr($item_id); ?>" name="menu-item-col[<?php echo esc_attr($item_id); ?>]">
								<option value="" <?php if($item->menucol == "") { echo 'selected="selected"'; } ?>></option>
								<option value="2" <?php if($item->menucol == "2") { echo 'selected="selected"'; } ?>>2</option>
								<option value="3" <?php if($item->menucol == "3") { echo 'selected="selected"'; } ?>>3</option>
								<option value="4" <?php if($item->menucol == "4") { echo 'selected="selected"'; } ?>>4</option>
								<option value="5" <?php if($item->menucol == "5") { echo 'selected="selected"'; } ?>>5</option>
							</select>
						</label>
					</p>
					<p class="field-custom description description-wide">
						<label for="edit-menu-item-dir-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e('جهت (در صورت عدم استفاده از گزینه "انتخاب مگامنو")', 'mweb'); ?>
							<select class="fat" id="edit-menu-item-dir-<?php echo esc_attr($item_id); ?>" name="menu-item-dir[<?php echo esc_attr($item_id); ?>]">
								<option value="horizontal" <?php if($item->direction == "horizontal" || empty($item->direction)) { echo 'selected="selected"'; } ?>>افقی</option>
								<option value="vertical" <?php if($item->direction == "vertical" ) { echo 'selected="selected"'; } ?>>عمودی</option>
							</select>
						</label>
					</p>
					<p class="field-custom description description-wide">
						<label for="edit-menu-is-fullwidth-<?php echo esc_attr($item_id); ?>">
							<input type="checkbox" id="edit-menu-is-fullwidth-<?php echo esc_attr($item_id); ?>"
								   class="edit-menu-item-custom" id="menu-is-fullwidth[<?php echo esc_attr($item_id); ?>]"
								   name="menu-is-fullwidth[<?php echo esc_attr($item_id); ?>]"
								   value="1" <?php echo checked( ! empty( $item->isfullwidth ), 1, false ); ?> />
							<?php esc_html_e( 'مگامنو تمام عرض', 'mweb' ); ?>
						</label>
					</p>
				<?php } ?>
				<p class="field-custom description description-wide" style="height: 10px;"></p>

                <p class="field-custom description description-wide">
                    <label for="edit-menu-loggedin-<?php echo esc_attr($item_id); ?>">
                        <input type="checkbox" id="edit-menu-loggedin-<?php echo esc_attr($item_id); ?>"
                               class="edit-menu-item-custom" id="menu-loggedin[<?php echo esc_attr($item_id); ?>]"
                               name="menu-loggedin[<?php echo esc_attr($item_id); ?>]"
                               value="1" <?php echo checked( ! empty( $item->loggedin ), 1, false ); ?> />
						<?php esc_html_e( 'نمایش تنها برای کاربران وارد شده', 'mweb' ); ?>
                    </label>
                </p>
                <p class="field-custom description description-wide">
                    <label for="edit-menu-loggedout-<?php echo esc_attr($item_id); ?>">
                        <input type="checkbox" id="edit-menu-loggedout-<?php echo esc_attr($item_id); ?>"
                               class="edit-menu-item-custom" id="menu-loggedout[<?php echo esc_attr($item_id); ?>]"
                               name="menu-loggedout[<?php echo esc_attr($item_id); ?>]"
                               value="1" <?php echo checked( ! empty( $item->loggedout ), 1, false ); ?> />
						<?php esc_html_e( 'نمایش تنها برای کاربران وارد نشده', 'mweb' ); ?>
                    </label>
                </p>
				<p class="field-custom description description-wide">
					<label for="edit-menu-newbadge-<?php echo esc_attr($item_id); ?>">
						<input type="checkbox" id="edit-menu-newbadge-<?php echo esc_attr($item_id); ?>"
							   class="edit-menu-item-custom" id="menu-newbadge[<?php echo esc_attr($item_id); ?>]"
							   name="menu-newbadge[<?php echo esc_attr($item_id); ?>]"
							   value="1" <?php echo checked( ! empty( $item->newbadge ), 1, false ); ?> />
						<?php esc_html_e( 'نشان جدید', 'mweb' ); ?>
					</label>
				</p>
				<p class="field-custom description description-wide">
					<label for="edit-menu-salebadge-<?php echo esc_attr($item_id); ?>">
						<input type="checkbox" id="edit-menu-salebadge-<?php echo esc_attr($item_id); ?>"
							   class="edit-menu-item-custom" id="menu-salebadge[<?php echo esc_attr($item_id); ?>]"
							   name="menu-salebadge[<?php echo esc_attr($item_id); ?>]"
							   value="1" <?php echo checked( ! empty( $item->salebadge ), 1, false ); ?> />
						<?php esc_html_e( 'نشان ویژه', 'mweb' ); ?>
					</label>
				</p>
				<?php if ( $depth == 0 || $depth == 1 ) { ?>
					<div class="field-custom description description-wide" style="padding: 10px 0;">
						<label for="edit-menu-item-icon-<?php echo esc_attr($item_id); ?>">
							<?php esc_html_e( 'آیکن منو', 'mweb' ); ?>
							<input type="text" id="edit-menu-item-icon<?php echo esc_attr($item_id); ?>" class="code edit-menu-item-icon" name="menu-item-icon[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item->icon); ?>" />
							<div id="preview_icon_picker_<?php echo esc_attr( $item_id ); ?>" data-target="#edit-menu-item-icon<?php echo esc_attr( $item_id ); ?>" class="button icon-picker"><?php echo empty($item->icon) ? 'انتخاب' : $item->icon; ?></div>
								   
						</label>
					</div>	
				<?php } ?>
                <?php if ( $depth == 0 ) { ?>
					<p class="field-imagemenu description description-wide">
						<label for="edit-menu-item-imagemenu-<?php echo esc_attr($item_id); ?>">
						<?php esc_html_e( 'تصویر پس زمینه منو', 'mweb' ); ?>
						<input id="edit-menu-item-imagemenu-<?php echo esc_attr($item_id); ?>" class="code edit-menu-item-imagemenu" name="menu-item-imagemenu[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->imagemenu ); ?>" type="hidden">
						<?php if($item->imagemenu){?>
							<img class="edit-menu-item-imagemenu-<?php echo esc_attr($item_id);?>" src="<?php echo esc_url( $item->imagemenu ); ?>" style="display: block; width:100px;height:auto;">
						<?php }else{?>
							<img class="edit-menu-item-imagemenu-<?php echo esc_attr($item_id);?>" src="" style="display: none; width:100px;height:auto;">
						<?php } ?>
						<a class="mw_upload_image_button" href="javascript:void(0);" data-image_id="edit-menu-item-imagemenu-<?php echo esc_attr($item_id);?>"><?php esc_html_e( 'انتخاب', 'mweb' ); ?></a>
						<a class="mw_remove_image_button delete" href="javascript:void(0);" data-image_id="edit-menu-item-imagemenu-<?php echo esc_attr($item_id);?>"><?php esc_html_e( 'حذف', 'mweb' ); ?></a>
						</label>
					</p>					
                <?php } ?>
            </div>
        	<?php
        }
        
		
		
        function mweb_mega_menu_add_custom_nav_fields( $menu_item ) {
            $menu_item->menucol         = get_post_meta( $menu_item->ID, '_menu_item_col', true );
            $menu_item->direction       = get_post_meta( $menu_item->ID, '_menu_item_dir', true );
            $menu_item->megamenu        = get_post_meta( $menu_item->ID, '_menu_megamenu', true );
			$menu_item->submegamenu     = get_post_meta( $menu_item->ID, '_menu_submegamenu', true );
            $menu_item->isfullwidth 	= get_post_meta( $menu_item->ID, '_menu_is_fullwidth', true );
            $menu_item->loggedin     	= get_post_meta( $menu_item->ID, '_menu_loggedin', true );
            $menu_item->loggedout    	= get_post_meta( $menu_item->ID, '_menu_loggedout', true );
            $menu_item->newbadge   		= get_post_meta( $menu_item->ID, '_menu_newbadge', true );
			$menu_item->salebadge   	= get_post_meta( $menu_item->ID, '_menu_salebadge', true );
            $menu_item->icon        	= get_post_meta( $menu_item->ID, '_menu_item_icon', true );
			$menu_item->imagemenu       = get_post_meta( $menu_item->ID, '_menu_item_imagemenu', true );
            return $menu_item;
        }
      
	  
	  
        function mweb_mega_menu_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
            // Check if element is properly sent
        
			if ( isset( $_POST['menu-item-col'][ $menu_item_db_id ] ) ) {
                $menu_col_value = $_POST['menu-item-col'][ $menu_item_db_id ];
                update_post_meta( $menu_item_db_id, '_menu_item_col', $menu_col_value );
            }
			
			if ( isset( $_POST['menu-item-dir'][ $menu_item_db_id ] ) ) {
                $menu_dir_value = $_POST['menu-item-dir'][ $menu_item_db_id ];
                update_post_meta( $menu_item_db_id, '_menu_item_dir', $menu_dir_value );
            }
			
            if ( isset( $_POST['menu-item-icon'][ $menu_item_db_id ] ) ) {
                $menu_icon_value = $_POST['menu-item-icon'][ $menu_item_db_id ];
                update_post_meta( $menu_item_db_id, '_menu_item_icon', $menu_icon_value );
            }
            if ( isset( $_POST['menu-item-imagemenu'][ $menu_item_db_id ] ) ) {
                $menu_imagemenu_value = $_POST['menu-item-imagemenu'][ $menu_item_db_id ];
                update_post_meta( $menu_item_db_id, '_menu_item_imagemenu', $menu_imagemenu_value );
            }			
            if ( isset( $_POST['menu-megamenu'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_megamenu', 1 );
            } else {
                delete_post_meta( $menu_item_db_id, '_menu_megamenu');
            }
            if ( isset( $_POST['menu-submegamenu'][ $menu_item_db_id ] ) ) {
                $menu_submegamenu_value = $_POST['menu-submegamenu'][ $menu_item_db_id ];
                update_post_meta( $menu_item_db_id, '_menu_submegamenu', $menu_submegamenu_value );
            }
            if ( isset( $_POST['menu-is-fullwidth'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_is_fullwidth', 1 );
            } else {
                delete_post_meta( $menu_item_db_id, '_menu_is_fullwidth' );
            }
            if ( isset( $_POST['menu-loggedin'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_loggedin', 1 );
            } else {
                delete_post_meta( $menu_item_db_id, '_menu_loggedin' );
            }
            if ( isset( $_POST['menu-loggedout'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_loggedout', 1 );
            } else {
                delete_post_meta( $menu_item_db_id, '_menu_loggedout');
            }
            if ( isset( $_POST['menu-newbadge'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_newbadge', 1 );
            } else {
                delete_post_meta( $menu_item_db_id, '_menu_newbadge');
            }
            if ( isset( $_POST['menu-salebadge'][ $menu_item_db_id ] ) ) {
                update_post_meta( $menu_item_db_id, '_menu_salebadge', 1 );
            } else {
                delete_post_meta( $menu_item_db_id, '_menu_salebadge');
            }
        }
       
	   
	   
	   
        function mweb_mega_menu_edit_walker( $walker, $menu_id ) {
            return 'Walker_Nav_Menu_Edit_Custom';
        }
    }
    $GLOBALS['mweb_mega_menu'] = new mweb_mega_menu();
