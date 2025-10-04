<?php
/**
 * Dokan Seller Single product tab Template
 *
 * @since 2.4
 *
 * @package dokan
 */
?>


<ul class="list-unstyled row">
    <?php do_action( 'dokan_product_seller_tab_start', $author, $store_info ); ?>
	<div class="col-sm-18 col-xs-36">
		<?php if ( !empty( $store_info['store_name'] ) ) { ?>
			<li class="store-name">
				<span><?php esc_html_e( 'Store Name:', 'dokan-lite' ); ?></span>
				<span class="details">
					<?php echo esc_html( $store_info['store_name'] ); ?>
				</span>
			</li>
		<?php } ?>

		<li class="seller-name">
			<span>
				<?php esc_html_e( 'Vendor:', 'dokan-lite' ); ?>
			</span>

			<span class="details">
				<?php printf( '<a href="%s">%s</a>', esc_url( dokan_get_store_url( $author->ID ) ), esc_attr( $author->display_name ) ); ?>
			</span>
		</li>
		<li class="clearfix">
			<?php echo wp_kses_post( dokan_get_readable_seller_rating( $author->ID ) ); ?>
		</li>
		
	</div>
	
	<?php if ( !empty( $store_info['address'] ) ) { ?>
	<div class="col-sm-18 col-xs-36">
        <li class="store-address">
            <span><?php esc_html_e( 'Address:', 'dokan-lite' ); ?></span>
            <span class="details">
                <?php echo wp_kses_post( dokan_get_seller_address( $author->ID ) ) ?>
            </span>
        </li>
	</div>
    <?php } ?>

    <?php do_action( 'dokan_product_seller_tab_end', $author, $store_info ); ?>
</ul>
