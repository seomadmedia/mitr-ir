<?php
$store_user    = dokan()->vendor->get( get_query_var( 'author' ) );

$vendor_info = get_userdata($store_user->get_id());
$vendor_info_register = $vendor_info->user_registered;

$dokan_store_time_enabled = isset( $store_info['dokan_store_time_enabled'] ) ? $store_info['dokan_store_time_enabled'] : '';
$store_open_notice        = isset( $store_info['dokan_store_open_notice'] ) && ! empty( $store_info['dokan_store_open_notice'] ) ? $store_info['dokan_store_open_notice'] : __( 'Store Open', 'dokan-lite' );
$store_closed_notice      = isset( $store_info['dokan_store_close_notice'] ) && ! empty( $store_info['dokan_store_close_notice'] ) ? $store_info['dokan_store_close_notice'] : __( 'Store Closed', 'dokan-lite' );
$show_store_open_close    = dokan_get_option( 'store_open_close', 'dokan_general', 'on' );

$social_fields = dokan_get_social_profile_fields();
$social_info   = $store_user->get_social_profiles();

$store_info   = $store_user->get_shop_info();
$map_location = $store_user->get_location();

$store_address = dokan_get_seller_short_address( $store_user->get_id(), false );


?>
<aside class="sidebar-wrap col-12 col-sm-12 col-md-3" role="complementary" itemscope="" itemtype="http://schema.org/WPSideBar">
	<div class="sidebar-inner">
	
		<div class="widget widget_vendor_info">
			<div class="widget-content">
			
				<div class="vendor_info_warp">
					<div class="profile_img">
                        <?php echo get_avatar( $store_user->get_id(), 150, '', $store_user->get_shop_name() ); ?>
						<span><i class="fa fa-home"></i></span>
                    </div>
					
					<?php if ( ! empty( $store_user->get_shop_name() ) ) { ?>
                        <h1 class="store_name"><?php echo esc_html( $store_user->get_shop_name() ); ?></h1>
                    <?php } ?>
					
					<div class="vendor_total_rate"><?php dokan_get_readable_seller_rating( $store_user->get_id() ); ?></div>
				
					<div class="vendor_line"></div>
					
					<div class="vendor_info_line">تعداد محصول <span><?php echo count_user_posts( $store_user->get_id() , "product" ); ?></span></div>
					<div class="vendor_info_line">عضویت از <span><?php echo date_i18n( get_option( 'date_format' ), strtotime( $vendor_info_register ) );  ?></span></div>
					
				
					<div class="vendor_line"></div>
					
					<?php if ( $show_store_open_close == 'on' && $dokan_store_time_enabled == 'yes') : ?>
						<div class="vendor_info_line">
							<?php if ( dokan_is_store_open( $store_user->get_id() ) ) {
								echo esc_attr( $store_open_notice );
							} else {
								echo esc_attr( $store_closed_notice );
							} ?>
						</div>
					<?php endif ?>
					
					<?php if ( ! dokan_is_vendor_info_hidden( 'address' ) && isset( $store_address ) && !empty( $store_address ) ) { ?>
                            <div class="vendor_info_line dokan-store-address"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#map"></use></svg>
                                <?php echo $store_address; ?>
                            </div>
                        <?php } ?>

                        <?php if ( ! dokan_is_vendor_info_hidden( 'phone' ) && !empty( $store_user->get_phone() ) ) { ?>
                            <div class="vendor_info_line dokan-store-phone">
                                <svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#call"></use></svg>
                                <a href="tel:<?php echo esc_html( $store_user->get_phone() ); ?>"><?php echo esc_html( $store_user->get_phone() ); ?></a>
                            </div>
                        <?php } ?>

                        <?php if ( ! dokan_is_vendor_info_hidden( 'email' ) && $store_user->show_email() == 'yes' ) { ?>
                            <div class="vendor_info_line dokan-store-email">
                                <svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#sms"></use></svg>
                                <a href="mailto:<?php echo esc_attr( antispambot( $store_user->get_email() ) ); ?>"><?php echo esc_attr( antispambot( $store_user->get_email() ) ); ?></a>
                            </div>
                        <?php } ?>

					<?php do_action( 'dokan_store_header_info_fields',  $store_user->get_id() ); ?>
				
					<?php if ( $social_fields ) { ?>
                        <div class="store-social-wrapper">
                            <ul class="store-social">
                                <?php foreach( $social_fields as $key => $field ) { ?>
                                    <?php if ( !empty( $social_info[ $key ] ) ) { ?>
                                        <li>
                                            <a href="<?php echo esc_url( $social_info[ $key ] ); ?>" target="_blank"><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path() ?>#<?php echo $field['icon']; ?>"></use></svg></a>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php } ?>
					
					
					<?php 
					$store_link = dokan_get_store_url( $store_user->get_id() );
					echo '<a href="'.$store_link.'" class="store_link">'.$store_link.'</a>';
					
					?>
				
				</div>

			
			</div>
		</div>
		
	<?php if ( dokan_get_option( 'enable_theme_store_sidebar', 'dokan_general', 'off' ) == 'off' ) { ?>

                <?php do_action( 'dokan_sidebar_store_before', $store_user->data, $store_info ); ?>
                <?php
                if ( ! dynamic_sidebar( 'vendor_sidebar' ) ) {
                    $args = array(
                        'before_widget' => '<aside class="widget %s">',
						'after_widget'  => '</div></aside>',
						'before_title'  => '<div class="widget_title">',
						'after_title'   => '</div><div class="widget-content">',
                    );

                    if ( class_exists( 'Dokan_Store_Location' ) ) {
                        the_widget( 'Dokan_Store_Category_Menu', array( 'title' => __( 'Store Category', 'dokan-lite' ) ), $args );

                        if ( dokan_get_option( 'store_map', 'dokan_general', 'on' ) == 'on'  && !empty( $map_location ) ) {
                            the_widget( 'Dokan_Store_Location', array( 'title' => __( 'Store Location', 'dokan-lite' ) ), $args );
                        }

                        if ( dokan_get_option( 'store_open_close', 'dokan_general', 'on' ) == 'on' ) {
                            the_widget( 'Dokan_Store_Open_Close', array( 'title' => __( 'Store Time', 'dokan-lite' ) ), $args );
                        }

                        if ( dokan_get_option( 'contact_seller', 'dokan_general', 'on' ) == 'on' ) {
                            the_widget( 'Dokan_Store_Contact_Form', array( 'title' => __( 'Contact Vendor', 'dokan-lite' ) ), $args );
                        }
                    }
                }
                ?>

                <?php do_action( 'dokan_sidebar_store_after', $store_user->data, $store_info ); ?>

    <?php
    } else {
        get_sidebar( 'vendor_sidebar' );
    }
    ?>
	
		
	</div>
</aside>