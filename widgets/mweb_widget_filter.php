<?php
class WC_Advanced_Layered_Nav_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'wc_advanced_layered_nav',
            THEME_NAME .' - فیلتر پیشرفته محصولات',
            array(
                'description' => 'فیلتر پیشرفته محصولات با امکانات بیشتر (موجودی، قیمت، برند، ویژگی‌ها)'
            )
        );
		
		//wp_enqueue_script( 'jquery-ui-slider' );
		//wp_enqueue_script('jquery-ui-core');

    }

    public function widget($args, $instance) {
        if (!is_shop() && !is_product_taxonomy()) {
            return;
        }

        echo $args['before_widget'];
        echo $args['before_title'] . 'فیلتر محصولات' . $args['after_title'];
        ?>
        <div class="advanced-layered-nav-widget">

            <?php if (!empty($instance['enable_stock'])): ?>
                <div class="filter-block">
					<div class="filter_stock_c">
						<label class="ui_input_switch">
							<input type="checkbox" name="in_stock" class="mweb-filter" name="in_stock"
										<?php checked(isset($_GET['in_stock']) && $_GET['in_stock'] == '1'); ?>
													value="1">
												
							<span class="slider"></span>
						</label>
						فقط کالاهای موجود
					</div>
                </div>
            <?php endif; ?>

            <?php if (!empty($instance['enable_price'])): 
			
				$prices = $this->get_filtered_price();
				$min    = $prices->min_price ? floor( $prices->min_price ) : 0;
				$max    = $prices->max_price ? ceil( $prices->max_price ) : 0;

				if ( $min !== $max ) {
			
					$min_price = isset( $_GET['min_price'] ) ? esc_attr( $_GET['min_price'] ) : apply_filters( 'woocommerce_price_filter_widget_min_amount', $min );
					$max_price = isset( $_GET['max_price'] ) ? esc_attr( $_GET['max_price'] ) : apply_filters( 'woocommerce_price_filter_widget_max_amount', $max );
					
					$currency = get_woocommerce_currency_symbol();
					
					?>
						<div class="filter-block">
							<div class="filter-toggle">قیمت <svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path().'#arrow-down' ?>"></use></svg></div>
							<div class="filter-content widget_price_filter" style="display: block;">
								<div class="price-slider-wrapper">
									<div id="price-range-slider" 
										 data-min="<?= $min_price ?>"
										 data-max="<?= $max_price ?>"
									></div>
									<div class="price-inputs">
										<div class="price-input">
											<label>محدوده قیمت از <b><?= $currency ?></b></label>
											<input type="text" name="min_price" id="imin_price" class="mweb-filter" readonly>
										</div>
										<div class="price-input">
											<label>محدوده قیمت تا <b><?= $currency ?></b></label>
											<input type="text" name="max_price" id="imax_price" class="mweb-filter" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php 
				}
			
			endif; ?>

            <?php if (!empty($instance['enable_brands'])): 
                $brands = get_terms(['taxonomy' => 'product_brand', 'hide_empty' => true]);
                if (!empty($brands)): 
                    $current_brands = explode(',', $_GET['get_brand'] ?? '');
                    ?>
                    <div class="filter-block filter-brand"  data-type="brand">
                        <div class="filter-toggle">برند <svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path().'#arrow-down' ?>"></use></svg></div>
                        <div class="filter-content">
                            <input type="text" class="term-search-input" placeholder="جستجو برند...">
                            <ul class="wc-layered-nav-term-list woocommerce-widget-layered-nav-list">
                                <?php foreach ($brands as $brand): ?>
                                    <li class="wc-layered-nav-term">
					
                                        <label>
                                            <?php if ($imageURL = wp_get_attachment_image_url(get_term_meta($brand->term_id, 'thumbnail_id', true), 'thumbnail')) : ?>
											<img class="image-swatch swatch-brand" src="<?= $imageURL; ?>">
										<?php endif ?>
                                            <input type="checkbox" class="mweb-filter" value="<?php echo esc_attr($brand->slug); ?>"
                                                <?php checked(in_array($brand->slug, $current_brands)); ?>>
                                            <span class="term-name"><?php echo esc_html($brand->name); ?></span>
                                        </label>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; 
            endif; ?>

            <?php 
            if (!empty($instance['attributes']) && is_array($instance['attributes'])):
                foreach ($instance['attributes'] as $attr): 
                    $attribute = $attr['name'];
                    $display_type = $attr['display_type'] ?? 'list';
                    if (!$attribute) continue;

                    $taxonomy = wc_attribute_taxonomy_name($attribute);
                    if (!taxonomy_exists($taxonomy)) continue;

                    //$terms = get_terms(['taxonomy' => $taxonomy, 'hide_empty' => true]);
                    
					$terms = $this->get_active_terms($taxonomy);
					if (empty($terms)) continue;
					
					
                    /* $current_values = (array)($_GET["get_$attribute"] ?? []);
                    if (!is_array($current_values)) {
                        $current_values = explode(',', $current_values);
                    } */
					
					$current_values = $_GET["get_pa_$attribute"] ?? '';
					if ($current_values) {
						$current_values = explode(',', $current_values);
						//$current_values = array_map('urldecode', $current_values);
					} else {
						$current_values = [];
					}
		
										

                    $attribute_label = wc_attribute_label($taxonomy);
                    ?>
                    <div class="filter-block" data-attribute="<?php echo esc_attr($attribute); ?>">
                        <div class="filter-toggle"><?php echo esc_html($attribute_label); ?><svg class="pack-theme" viewBox="0 0 24 24"><use xlink:href="<?= mweb_print_sprites_path().'#arrow-down' ?>"></use></svg></div>
                        <div class="filter-content">
                            <?php if ($display_type === 'list'): ?>
                                <input type="text" class="term-search-input" placeholder="جستجو...">
                            <?php endif; ?>

                            <?php
                            switch ($display_type) {
                                case 'color': $this->display_color_swatches($terms, $current_values); break;
                                case 'image': $this->display_image_swatches($terms, $current_values); break;
                                case 'button': $this->display_buttons($terms, $current_values); break;
                                default: $this->display_list($terms, $current_values); break;
                            }
                            ?>
                        </div>
                    </div>
                <?php endforeach; 
            endif;
            ?>

            <button id="mweb-clear-filters">حذف همه فیلترها</button>
        </div>
        <?php
        echo $args['after_widget'];

        if (!wp_script_is('wc-advanced-layered-nav', 'enqueued')) {
            wp_enqueue_script('wc-advanced-layered-nav');
            wp_enqueue_style('wc-advanced-layered-nav');
        }
    }

    private function display_list($terms, $current_values) {
        echo '<ul class="wc-layered-nav-term-list woocommerce-widget-layered-nav-list">';
        foreach ($terms as $term) {
            $is_selected = in_array($term->slug, $current_values);
            printf(
                '<li class="wc-layered-nav-term"><label><input type="checkbox" class="mweb-filter" value="%s" %s> <span class="term-name">%s</span></label></li>',
                esc_attr($term->slug),
                checked($is_selected, true, false),
                esc_html($term->name)
            );
        }
        echo '</ul>';
    }

    private function display_color_swatches($terms, $current_values) {
        echo '<div class="wc-layered-nav-term-colors">';
        foreach ($terms as $term) {
            $color = get_term_meta($term->term_id, 'mwebshop_product_attribute_color', true);
            $is_selected = in_array($term->slug, $current_values);
            printf(
                '<span class="color-swatch %s" data-value="%s" style="background:%s"></span>',
                $is_selected ? 'selected' : '',
                esc_attr($term->slug),
                esc_attr($color ?: '#ccc')
            );
        }
        echo '</div>';
    }

    private function display_image_swatches($terms, $current_values) {
        echo '<div class="wc-layered-nav-term-images">';
        foreach ($terms as $term) {
            $image_id = get_term_meta($term->term_id, 'image', true);
            $url = wp_get_attachment_image_url($image_id, 'thumbnail');
            $is_selected = in_array($term->slug, $current_values);
            printf(
                '<span class="image-swatch %s" data-value="%s"><img src="%s" alt="%s"></span>',
                $is_selected ? 'selected' : '',
                esc_attr($term->slug),
                esc_url($url),
                esc_attr($term->name)
            );
        }
        echo '</div>';
    }

    private function display_buttons($terms, $current_values) {
        echo '<div class="wc-layered-nav-term-buttons">';
        foreach ($terms as $term) {
            $is_selected = in_array($term->slug, $current_values);
            printf(
                '<button class="term-button %s" data-value="%s">%s</button>',
                $is_selected ? 'selected' : '',
                esc_attr($term->slug),
                esc_html($term->name)
            );
        }
        echo '</div>';
    }
	
	protected function get_filtered_price() {
		global $wpdb;

		$args       = wc()->query->get_main_query()->query_vars;
		$tax_query  = isset( $args['tax_query'] ) ? $args['tax_query'] : array();
		$meta_query = isset( $args['meta_query'] ) ? $args['meta_query'] : array();

		if ( ! is_post_type_archive( 'product' ) && ! empty( $args['taxonomy'] ) && ! empty( $args['term'] ) ) {
			$tax_query[] = array(
				'taxonomy' => $args['taxonomy'],
				'terms'    => array( $args['term'] ),
				'field'    => 'slug',
			);
		}

		foreach ( $meta_query + $tax_query as $key => $query ) {
			if ( ! empty( $query['price_filter'] ) || ! empty( $query['rating_filter'] ) ) {
				unset( $meta_query[ $key ] );
			}
		}

		$meta_query = new WP_Meta_Query( $meta_query );
		$tax_query  = new WP_Tax_Query( $tax_query );

		$meta_query_sql = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
		$tax_query_sql  = $tax_query->get_sql( $wpdb->posts, 'ID' );

		$sql  = "SELECT min( FLOOR( price_meta.meta_value ) ) as min_price, max( CEILING( price_meta.meta_value ) ) as max_price FROM {$wpdb->posts} ";
		$sql .= " LEFT JOIN {$wpdb->postmeta} as price_meta ON {$wpdb->posts}.ID = price_meta.post_id " . $tax_query_sql['join'] . $meta_query_sql['join'];
		$sql .= " 	WHERE {$wpdb->posts}.post_type IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_post_type', array( 'product' ) ) ) ) . "')
					AND {$wpdb->posts}.post_status = 'publish'
					AND price_meta.meta_key IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price' ) ) ) ) . "')
					AND price_meta.meta_value > '' ";
		$sql .= $tax_query_sql['where'] . $meta_query_sql['where'];

		if ( $search = WC_Query::get_main_search_query_sql() ) {
			$sql .= ' AND ' . $search;
		}

		return $wpdb->get_row( $sql );
	}
	
	
	
private function get_active_terms( $taxonomy ) {
    global $wpdb;

    // اگر میخوای فقط دسته‌بندی فعلی را محدود کنی، می‌توان اضافه کرد
    $category_filter = '';
    if ( is_product_category() ) {
        $term = get_queried_object();
        $category_id = intval($term->term_id);
        $category_filter = $wpdb->prepare(
            " AND EXISTS (
                SELECT 1 FROM {$wpdb->term_relationships} tr2
                INNER JOIN {$wpdb->term_taxonomy} tt2 ON tr2.term_taxonomy_id = tt2.term_taxonomy_id
                WHERE tt2.taxonomy = 'product_cat'
                AND tt2.term_id = %d
                AND tr2.object_id = p.ID
            )",
            $category_id
        );
    }

    // کوئری مستقیم برای گرفتن ترم‌های فعال مرتبط با محصولات منتشر شده
    $terms = $wpdb->get_results( $wpdb->prepare("
        SELECT DISTINCT t.term_id, t.name, t.slug
        FROM {$wpdb->terms} AS t
        INNER JOIN {$wpdb->term_taxonomy} AS tt ON t.term_id = tt.term_id
        INNER JOIN {$wpdb->term_relationships} AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id
        INNER JOIN {$wpdb->posts} AS p ON p.ID = tr.object_id
        WHERE tt.taxonomy = %s
          AND p.post_type = 'product'
          AND p.post_status = 'publish'
          $category_filter
        ORDER BY t.name ASC
    ", $taxonomy ) );

    return $terms;
}





    public function form($instance) {
        $enable_stock = !empty($instance['enable_stock']);
        $enable_price = !empty($instance['enable_price']);
        $enable_brands = !empty($instance['enable_brands']);
		$attr_count    = $instance['attr_count'] ?? 3;
        $attributes = $instance['attributes'] ?? [];

        $attribute_taxonomies = wc_get_attribute_taxonomies();
        ?>
        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('enable_stock'); ?>"
                name="<?php echo $this->get_field_name('enable_stock'); ?>" <?php checked($enable_stock); ?>>
            <label for="<?php echo $this->get_field_id('enable_stock'); ?>">فعال‌سازی فیلتر موجودی</label>
        </p>

        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('enable_price'); ?>"
                name="<?php echo $this->get_field_name('enable_price'); ?>" <?php checked($enable_price); ?>>
            <label for="<?php echo $this->get_field_id('enable_price'); ?>">فعال‌سازی فیلتر قیمت</label>
        </p>

        <p>
            <input type="checkbox" id="<?php echo $this->get_field_id('enable_brands'); ?>"
                name="<?php echo $this->get_field_name('enable_brands'); ?>" <?php checked($enable_brands); ?>>
            <label for="<?php echo $this->get_field_id('enable_brands'); ?>">فعال‌سازی فیلتر برندها</label>
        </p>
		<p>
			<label for="<?php echo $this->get_field_id('attr_count'); ?>">تعداد ویژگی‌ها:</label>
			<input type="number" min="1" max="10"
				id="<?php echo $this->get_field_id('attr_count'); ?>"
				name="<?php echo $this->get_field_name('attr_count'); ?>"
				value="<?php echo esc_attr($attr_count); ?>">
		</p>
        <hr>
        <p><strong>ویژگی‌ها:</strong></p>
        <?php
		for ($i = 0; $i < $attr_count; $i++):
            $attr_name = $attributes[$i]['name'] ?? '';
            $display_type = $attributes[$i]['display_type'] ?? 'list';
            ?>
            <p>
                <label>ویژگی:</label>
                <select name="<?php echo $this->get_field_name('attributes'); ?>[<?php echo $i; ?>][name]">
                    <option value="">انتخاب کنید</option>
                    <?php foreach ($attribute_taxonomies as $tax): ?>
                        <option value="<?php echo esc_attr($tax->attribute_name); ?>"
                            <?php selected($attr_name, $tax->attribute_name); ?>>
                            <?php echo esc_html($tax->attribute_label); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p>
                <label>نوع نمایش:</label>
                <select name="<?php echo $this->get_field_name('attributes'); ?>[<?php echo $i; ?>][display_type]">
                    <option value="list" <?php selected($display_type, 'list'); ?>>لیست</option>
                    <option value="color" <?php selected($display_type, 'color'); ?>>رنگ</option>
                    <option value="image" <?php selected($display_type, 'image'); ?>>تصویر</option>
                    <option value="button" <?php selected($display_type, 'button'); ?>>دکمه</option>
                </select>
            </p>
            <hr>
        <?php endfor;
    }

    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance['enable_stock'] = !empty($new_instance['enable_stock']);
        $instance['enable_price'] = !empty($new_instance['enable_price']);
        $instance['enable_brands'] = !empty($new_instance['enable_brands']);
		$instance['attr_count']    = !empty($new_instance['attr_count']) ? intval($new_instance['attr_count']) : 3;
        $instance['attributes'] = $new_instance['attributes'] ?? [];
        return $instance;
    }
}

function register_wc_advanced_layered_nav_widget() {
    register_widget('WC_Advanced_Layered_Nav_Widget');
}
add_action('widgets_init', 'register_wc_advanced_layered_nav_widget');




// Enqueue necessary scripts and styles
function enqueue_advanced_layered_nav_assets() {
    if (is_shop() || is_product_taxonomy()) {

        wp_enqueue_script(
            'wc-advanced-layered-nav',
            THEME_ASSET . '/js/advanced-layered-nav.js',
            array('jquery', 'jquery-ui-core', 'jquery-ui-slider'),
            '1.0',
            true
        );

        wp_localize_script('wc-advanced-layered-nav', 'wcLayeredNav', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('wc-layered-nav')
        ));
    }
}
add_action('wp_enqueue_scripts', 'enqueue_advanced_layered_nav_assets'); 



add_action('woocommerce_product_query', 'mweb_get_products_by_arg');
function mweb_get_products_by_arg($query) {
    if ( ! is_admin() && $query->is_main_query() && (is_shop() || is_product_taxonomy()) ) {
		
		if (isset($_GET['in_stock']) && $_GET['in_stock'] == '1') {
			$meta_query   = $query->get('meta_query') ?: [];
			$meta_query[] = [
				'key'     => '_stock_status',
				'value'   => 'instock',
				'compare' => '='
			];
			$query->set('meta_query', $meta_query);
		}

		if (!empty($_GET['min_price']) || !empty($_GET['max_price'])) {
			$meta_query = $query->get('meta_query') ?: [];
			$range      = ['key' => '_price', 'type' => 'NUMERIC'];

			if (!empty($_GET['min_price']) && !empty($_GET['max_price'])) {
				$range['value']   = [ floatval($_GET['min_price']), floatval($_GET['max_price']) ];
				$range['compare'] = 'BETWEEN';
			} elseif (!empty($_GET['min_price'])) {
				$range['value']   = floatval($_GET['min_price']);
				$range['compare'] = '>=';
			} elseif (!empty($_GET['max_price'])) {
				$range['value']   = floatval($_GET['max_price']);
				$range['compare'] = '<=';
			}

			$meta_query[] = $range;
			$query->set('meta_query', $meta_query);
		}

		if (!empty($_GET['get_brand'])) {
			$brand = rawurldecode($_GET['get_brand']);
			
			$brand = sanitize_title($brand);
			
			$tax_query = (array) $query->get('tax_query');
			$tax_query[] = [
				'taxonomy' => 'product_brand',
				'field'    => 'slug',
				'terms'    => $brand,
				'operator' => 'IN',
				//'include_children' => true
			];
			
			if (!empty($tax_query)) {
				$tax_query['relation'] = 'AND';
			}
			
			$query->set('tax_query', $tax_query);
		}

	   foreach ($_GET as $key => $value) {
			if (strpos($key, 'get_pa_') === 0 && !empty($value)) {
				$attribute = str_replace('get_pa_', '', $key);
				$taxonomy  = 'pa_' . $attribute;
				
				if (!taxonomy_exists($taxonomy)) continue;

				$terms = array_map(function($term) {
					return rawurldecode($term);
				}, explode(',', $value));

				$tax_query = $query->get('tax_query') ?: [];
				$tax_query[] = [
					'taxonomy' => $taxonomy,
					'field'    => 'slug',
					'terms'    => $terms,
					'operator' => 'IN',
					'include_children' => false
				];
				$query->set('tax_query', $tax_query);
			}
		}

		$tax_query = $query->get('tax_query');
		if (!empty($tax_query)) {
			$tax_query['relation'] = 'AND';
			$query->set('tax_query', $tax_query);
		}
		
	}
}

/* add_action('woocommerce_product_query', 'mweb_get_products_by_brand');
function mweb_get_products_by_brand($query) {
    if ( ! is_admin() && $query->is_main_query() && (is_shop() || is_product_taxonomy()) ) {
        
        if ( isset($_GET['get_b']) && ! empty($_GET['get_b']) ) {
            $brand = sanitize_text_field($_GET['get_b']);

            $tax_query = (array) $query->get('tax_query');
            $tax_query[] = array(
                'taxonomy' => 'product_brand', 
                'field'    => 'slug',          
                'terms'    => $brand,
            );
            $query->set('tax_query', $tax_query);
        }
    }
} */


