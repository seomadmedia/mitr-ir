<?php
/**
 * Class mweb_theme_query
 * This file handling query data for theme
 */
if ( ! class_exists( 'mweb_theme_query' ) ) {
    class mweb_theme_query {

        private static $cache_prefix = 'mweb_query_';


        private static function run_query($args) {
            $cache_key = self::$cache_prefix . md5( maybe_serialize($args) );
            $cached = get_transient($cache_key);

            if ( false !== $cached ) {
                return $cached;
            }

            $query = new WP_Query($args);
            set_transient($cache_key, $query, HOUR_IN_SECONDS);

            return $query;
        }

      
        public static function clear_cache() {
            global $wpdb;
            $search = '_transient_' . self::$cache_prefix . '%';
            $search_timeout = '_transient_timeout_' . self::$cache_prefix . '%';
            $wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->options WHERE option_name LIKE %s OR option_name LIKE %s", $search, $search_timeout ) );
        }

    
        public static function maybe_clear_product_cache( $post_id ) {
            $post_type = get_post_type( $post_id );
            if ( in_array( $post_type, [ 'product', 'product_variation' ], true ) ) {
                self::clear_cache();
            }
        }

     
        private static function build_tax_query($post_type, $categories = [], $brand_id = null) {
            $tax_query = [];

            if ($post_type === 'product') {
                if (!empty($brand_id)) {
                    $tax_query[] = [
                        'taxonomy' => 'product_brand',
                        'terms'    => (array) $brand_id
                    ];
                }
                if (!empty($categories)) {
                    $tax_query[] = [
                        'taxonomy' => 'product_cat',
                        'terms'    => (array) $categories
                    ];
                }
                $tax_query[] = [
                    'taxonomy' => 'product_visibility',
                    'field'    => 'slug',
                    'terms'    => ['exclude-from-search', 'exclude-from-catalog'],
                    'operator' => 'NOT IN',
                ];
            }
			
			if ($post_type === 'slider') {
				$tax_query[] = [
					'taxonomy' => 'slider_category',
					'terms'    => (array) $categories
				];
			}

            return $tax_query;
        }

   
        private static function wc_meta_query($in_stock = false, $min_price = null, $max_price = null) {
            $meta_query = [];
            if ($in_stock) {
                //$meta_query[] = WC()->query->stock_status_meta_query();
                $meta_query[] = array(
				   'key' => '_stock_status',
				   'value' => 'instock',
				   'compare' => 'IN'
				 );
            }
            if (!is_null($min_price) || !is_null($max_price)) {
                $price_range = [];
                if (!is_null($min_price)) $price_range[] = (float) $min_price;
                if (!is_null($max_price)) $price_range[] = (float) $max_price;
                $meta_query[] = [
                    'key'     => '_price',
                    'value'   => $price_range,
                    'compare' => 'BETWEEN',
                    'type'    => 'NUMERIC'
                ];
            }
            return $meta_query;
        }


        static function mweb_query_search($search_data) {
            return self::run_query([
                's'           => esc_sql($search_data),
                'post_type'   => ['product'],
                'post_status' => 'publish',
            ]);
        }


        static function mweb_query_discount($array_arg = []) {
            $range_values = !empty($array_arg['array_range']) ? explode('-', $array_arg['array_range']) : [];
            $posts_per_page = $array_arg['posts_per_page'] ?? -1;

            return self::run_query([
                'post_type'      => 'product',
                'orderby'        => '_discount',
                'order'          => 'ASC',
                'posts_per_page' => $posts_per_page,
                'meta_query'     => array_merge([
                    [
                        'key'     => '_discount',
                        'value'   => $range_values,
                        'compare' => 'BETWEEN',
                        'type'    => 'NUMERIC'
                    ]
                ], self::wc_meta_query(true))
            ]);
        }


static function get_custom_query($args = [], $paged = 1) {
    $post_type       = $args['post_type']       ?? 'post';
    $posts_per_page  = $args['posts_per_page']  ?? 5;
    $category_ids    = $args['category_ids']    ?? [];
    $category_id     = $args['category_id']     ?? '';
    $brand_id        = $args['brand_id']        ?? '';
    $orderby         = $args['orderby']         ?? 'date_post';
    $in_stock        = ($post_type === 'product') ? true : false; // فقط برای محصولات
    $min_price       = $args['min_price']       ?? null;
    $max_price       = $args['max_price']       ?? null;
    $offset          = $args['offset']          ?? 0;

    $args_query = [
        'ignore_sticky_posts' => 1,
        'post_status'         => 'publish',
        'post_type'           => $post_type,
        'paged'               => max(1, $paged),
        'posts_per_page'      => $posts_per_page,
    ];

    // دسته‌بندی و برند
    if (!empty($category_ids) || !empty($category_id) || !empty($brand_id)) {
        $categories = !empty($category_ids) ? $category_ids : $category_id;
        if ($post_type !== 'post') {
            $args_query['tax_query'] = self::build_tax_query($post_type, $categories, $brand_id);
        } else {
            if (!empty($category_ids)) {
                $args_query['category__in'] = $categories;
            } else {
                $args_query['cat'] = $categories;
            }
        }
    }

    // افست
    if (!empty($offset)) {
        if ($paged > 1) {
            $args_query['offset'] = intval($offset) + intval(($paged - 1) * intval($args_query['posts_per_page']));
        } else {
            $args_query['offset'] = intval($offset);
        }
    }

    // سایر فیلترها
    if (!empty($args['author_id'])) $args_query['author'] = $args['author_id'];
    if (!empty($args['post__in'])) $args_query['post__in'] = (array) $args['post__in'];
    if (!empty($args['post_not_in'])) $args_query['post__not_in'] = (array) $args['post_not_in'];
    if (!empty($args['tags'])) $args_query['tag'] = esc_attr(preg_replace('/\s+/', '', $args['tags']));
    if (!empty($args['tag_in'])) $args_query['tag__in'] = (array) $args['tag_in'];

    // فقط برای محصولات موجود اعمال شود
    if ($post_type === 'product') {
        $args_query['meta_query'] = self::wc_meta_query($in_stock, $min_price, $max_price);
    }

    // مرتب‌سازی
    $order_map = [
        'date_post' => ['orderby' => 'date', 'order' => 'DESC'],
        'comment_count' => ['orderby' => 'comment_count'],
        'rand' => ['orderby' => 'rand'],
        'alphabetical_order_asc' => ['orderby' => 'title', 'order' => 'ASC'],
        'alphabetical_order_decs' => ['orderby' => 'title', 'order' => 'DESC'],
        'recent_product' => ['orderby' => 'date', 'order' => 'DESC'],
        'featured' => ['tax_query' => [[
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'featured',
            'operator' => 'IN'
        ]]],
        'on_sale' => ['post__in' => array_merge([0], wc_get_product_ids_on_sale())],
        'best_selling' => ['meta_key' => 'total_sales', 'orderby' => 'meta_value_num'],
        'most_discount' => ['meta_key' => '_discount', 'orderby' => 'meta_value_num', 'order' => 'DESC'],
        'min_price' => ['meta_key' => '_price', 'orderby' => 'meta_value_num', 'order' => 'ASC'],
        'max_price' => ['meta_key' => '_price', 'orderby' => 'meta_value_num', 'order' => 'DESC'],
        'rate' => ['meta_key' => '_wc_average_rating', 'orderby' => 'meta_value_num', 'order' => 'DESC'],
    ];

    if (isset($order_map[$orderby])) {
        $args_query = array_merge_recursive($args_query, $order_map[$orderby]);
    }

    return self::run_query($args_query);
}

    }


    add_action('save_post', ['mweb_theme_query', 'maybe_clear_product_cache']);
    add_action('delete_post', ['mweb_theme_query', 'maybe_clear_product_cache']);

    add_action('woocommerce_product_set_stock_status', ['mweb_theme_query', 'clear_cache']);
    add_action('woocommerce_variation_set_stock_status', ['mweb_theme_query', 'clear_cache']);
	
    add_action('elementor/editor/after_save', ['mweb_theme_query', 'clear_cache']);
}





class Mweb_SelectApi_Handler {
	public $request;

	public function __construct() {
		$this->request = [
			's'   => sanitize_text_field($_GET['s'] ?? ''),
			'ids' => sanitize_text_field($_GET['ids'] ?? '')
		];
	}

	public function get_post_list() {
		if ( ! current_user_can( 'edit_posts' ) ) return;
		$query_args = [
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => 15,
		];
		if ( ! empty( $this->request['ids'] ) ) {
			$query_args['post__in'] = explode(',', $this->request['ids']);
		}
		if ( ! empty( $this->request['s'] ) ) {
			$query_args['s'] = $this->request['s'];
		}
		return $this->wp_query_to_results($query_args);
	}

	public function get_page_list() {
		if ( ! current_user_can( 'edit_posts' ) ) return;
		$query_args = [
			'post_type'      => 'page',
			'post_status'    => 'publish',
			'posts_per_page' => 15,
		];
		if ( ! empty( $this->request['ids'] ) ) {
			$query_args['post__in'] = explode(',', $this->request['ids']);
		}
		if ( ! empty( $this->request['s'] ) ) {
			$query_args['s'] = $this->request['s'];
		}
		return $this->wp_query_to_results($query_args);
	}

	public function get_product_list() {
		$query_args = [
			'post_type'      => 'product',
			'post_status'    => 'publish',
			'posts_per_page' => 15,
		];
		if ( ! empty( $this->request['ids'] ) ) {
			$query_args['post__in'] = explode(',', $this->request['ids']);
		}
		if ( ! empty( $this->request['s'] ) ) {
			$query_args['s'] = $this->request['s'];
		}
		return $this->wp_query_to_results($query_args);
	}

	public function get_product_cat() {
		$query_args = [
			'taxonomy'   => [ 'product_cat' ],
			'orderby'    => 'name',
			'order'      => 'DESC',
			'hide_empty' => false,
			'number'     => 6,
		];
		if ( ! empty( $this->request['ids'] ) ) {
			$query_args['include'] = explode(',', $this->request['ids']);
		}
		if ( ! empty( $this->request['s'] ) ) {
			$query_args['name__like'] = $this->request['s'];
		}
		$terms = get_terms( $query_args );
		$options = [];
		if ( ! is_wp_error($terms) && count($terms) > 0 ) {
			foreach ( $terms as $term ) {
				$options[] = [
					'id'   => $term->term_id,
					'text' => $term->name,
				];
			}
		}
		return [ 'results' => $options ];
	}

	private function wp_query_to_results($query_args) {
		$query = new WP_Query($query_args);
		$options = [];
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$options[] = [
					'id'   => get_the_ID(),
					'text' => get_the_title(),
				];
			}
			wp_reset_postdata();
		}
		return [ 'results' => $options ];
	}
}



add_action('wp_ajax_mweb_selectapi_source', function () {
	check_ajax_referer('mweb_selectapi_nonce', 'nonce');

	$source  = sanitize_text_field($_GET['source'] ?? '');

	$handler = new Mweb_SelectApi_Handler();
	$method  = "get_{$source}";

	if ( method_exists($handler, $method) ) {
		wp_send_json( $handler->$method() );
	} else {
		wp_send_json([ 'results' => [] ]);
	}
});
