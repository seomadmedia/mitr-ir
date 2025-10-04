<?php
class mweb_product_brand {
	
	 
	public function __construct() {
		
		
		//add_action('init', array($this, 'createProductsTaxonomies'));
		
		// if( is_admin() ){
			
			// add_action('product_brand_add_form_fields', [$this, 'addBrandsFields']);
			// add_action('product_brand_edit_form_fields', [$this, 'editBrandsFields'], 10);
			// add_action('created_term', [$this, 'saveBrandsFields'], 10, 3);
			// add_action('edit_term', [$this, 'saveBrandsFields'], 10, 3);
			// add_filter('manage_edit-product_brand_columns', [$this, 'productBrandColumns']);
			// add_filter('manage_product_brand_custom_column', [$this, 'productCatColumn'], 10, 3);
			// add_action('quick_edit_custom_box', [$this, 'quickEdit'], 10, 2);
			// add_action('woocommerce_product_bulk_edit_start', [$this, 'bulkEdit']);
			// add_action('manage_product_posts_custom_column', [$this, 'renderProductColumns']);
			// add_action('woocommerce_product_bulk_and_quick_edit', [$this, 'saveEditPost']);
			// add_action('woocommerce_product_bulk_edit_save', [$this, 'bulkEditSave']);
			
		// }
		
		
		add_action('woocommerce_product_meta_start', [$this, 'addProductBrand']);
		//add_filter('woocommerce_get_breadcrumb', [$this, 'changeBreadcrumb']);
		add_shortcode('brands_page', [$this, 'brandsPage']);
	

	}

	public static function init() {
		
		static $instance = false;
        if ( ! $instance ) {
            $instance = new mweb_product_brand();
        }
        return $instance;
	}
	
	
	
	public function createProductsTaxonomies(){
		$labels = [
			'name'              => __('برندها', 'mweb'),
			'singular_name'     => __('برند', 'mweb'),
			'search_items'      => __('جستجوی برند', 'mweb'),
			'all_items'         => __('کلیه برندها', 'mweb'),
			'parent_item'       => __('برند والد', 'mweb'),
			'parent_item_colon' => __('برند والد:', 'mweb'),
			'edit_item'         => __('ویرایش برند', 'mweb'),
			'update_item'       => __('بروزرسانی برند', 'mweb'),
			'add_new_item'      => __('افزودن برند جدید', 'mweb'),
			'new_item_name'     => __('نام برند جدید', 'mweb'),
			'menu_name'         => __('برندها', 'mweb'),
		];

		$args = [
			'hierarchical'       => true,
			'labels'             => $labels,
			'show_ui'            => true,
			'query_var'          => true,
			'show_admin_column' => true,
            'show_in_rest' => true,
			'show_in_quick_edit' => false,
			'meta_box_cb'        => [$this, 'productBrandMetaBox'],
		];

		register_taxonomy('product_brand', 'product', $args);
		register_taxonomy_for_object_type('product_brand', 'product');
		//flush_rewrite_rules();
	}
	
	
	/**
	 * Change brands meta box to radio
	 *
	 * @param \WP_Post $post
	 */
	public function productBrandMetaBox(\WP_Post $post){
		$terms = get_terms(self::get_brand_taxonomy_name(), ['hide_empty' => false]);
		$brand = wp_get_object_terms($post->ID, self::get_brand_taxonomy_name(), ['orderby' => 'term_id', 'order' => 'ASC']);
		$name  = '';

		if(!is_wp_error($brand)){
			if(isset($brand[0]) && isset($brand[0]->name)){
				$name = $brand[0]->name;
			}
		}
		?>
		<select name="product_brand">
			<option value="0"><?php _e('متفرقه', 'mweb'); ?></option>

		<?php foreach ($terms as $term) : ?>
			<option value="<?php esc_attr_e($term->name); ?>" <?php selected($term->name, $name); ?>><?php esc_html_e($term->name); ?></option>
		<?php endforeach ?>
		</select>
		<?php
	}
	
	
	/**
	 * Include add_brands_fields template
	 */
	public function addBrandsFields(){
		/* wp_enqueue_media();
		wp_enqueue_style('mweb', $this->fileManager->locateAsset('admin/css/premmerce-brands.css'));
		wp_enqueue_script('mweb', $this->fileManager->locateAsset('admin/js/premmerce-brands.js')); */

		?>
		<div class="form-field term-thumbnail-wrap">
			<label><?php _e('Thumbnail', 'woocommerce'); ?></label>
			<div data-type="brands_thumbnail" class="brands_thumbnail"><img width="60" height="60" src="<?= esc_url(wc_placeholder_img_src()); ?>"/></div>
			<div class="brands_thumbnail_buttons">
				<input type="hidden" data-type="brands_thumbnail_id" name="brands_thumbnail_id"/>
				<button type="button" data-type="upload_image" class="upload_image_button button"><?php _e('Upload/Add image', 'woocommerce'); ?></button>
				<button type="button" data-type="remove_image" class="remove_image_button button" style="display: none"><?php _e('Remove image', 'woocommerce'); ?></button>
			</div>

			<div field-name="choose-image" field-value="<?php _e("Choose an image", "woocommerce"); ?>"></div>
			<div field-name="use-image" field-value="<?php _e("Use image", "woocommerce"); ?>"></div>
			<div field-name="placeholder-img-src" field-value="<?= esc_js(wc_placeholder_img_src()); ?>"></div>

			<div class="clear"></div>
		</div>

		<?php
	}

	/**
	 * Include edit_brands_fields template
	 *
	 * @param \WP_Term $term
	 */
	public function editBrandsFields(\WP_Term $term){
		/* wp_enqueue_media();
		wp_enqueue_style('mweb', $this->fileManager->locateAsset('admin/css/premmerce-brands.css'));
		wp_enqueue_script('mweb', $this->fileManager->locateAsset('admin/js/premmerce-brands.js')); */

		$thumbnailId = absint(get_term_meta($term->term_id, 'thumbnail_id', true));

		if($thumbnailId){
			$image = wp_get_attachment_thumb_url($thumbnailId);
		}else{
			$image = wc_placeholder_img_src();
		}

		?>
		<tr class="form-field">
			<th valign="top"><label><?php _e('Thumbnail', 'woocommerce'); ?></label></th>
			<td>
				<div data-type="brands_thumbnail" class="brands_thumbnail"><img width="60" height="60" src="<?= esc_url($image); ?>"/></div>
				<div class="brands_thumbnail_buttons">
					<input type="hidden" data-type="brands_thumbnail_id" name="brands_thumbnail_id" value="<?= $thumbnailId; ?>"/>
					<button type="button" data-type="upload_image" class="upload_image_button button"><?php _e('Upload/Add image', 'woocommerce'); ?></button>
					<button type="button" data-type="remove_image" class="remove_image_button button"><?php _e('Remove image', 'woocommerce'); ?></button>
				</div>

				<div field-name="choose-image" field-value="<?php _e("Choose an image", "woocommerce"); ?>"></div>
				<div field-name="use-image" field-value="<?php _e("Use image", "woocommerce"); ?>"></div>
				<div field-name="placeholder-img-src" field-value="<?= esc_js(wc_placeholder_img_src()); ?>"></div>

				<div class="clear"></div>
			</td>
		</tr>

		
		<?php
	}

	/**
	 * Update custom brands fields
	 *
	 * @param int $termId
	 * @param string $ttId
	 * @param string $taxonomy
	 */
	public function saveBrandsFields($termId, $ttId = '', $taxonomy = ''){
		if(isset($_POST['brands_thumbnail_id']) && self::get_brand_taxonomy_name() === $taxonomy){
			update_term_meta($termId, 'thumbnail_id', absint($_POST['brands_thumbnail_id']));
		}
	}

	/**
	 * Ad image column to brands page
	 *
	 * @param array $columns
	 *
	 * @return array
	 */
	public function productBrandColumns($columns){
		$newColumns = [];

		if(isset($columns['cb'])){
			$newColumns['cb'] = $columns['cb'];
			unset($columns['cb']);
		}

		$newColumns['thumb'] = __('تصویر', 'mweb');

		return array_merge($newColumns, $columns);
	}

	/**
	 * Display brand image
	 *
	 * @param array $columns
	 * @param string $column
	 * @param int $id
	 *
	 * @return string
	 */
	public function productCatColumn($columns, $column, $id){
		if($column == 'thumb'){
			$thumbnailId = get_term_meta($id, 'thumbnail_id', true);

			if($thumbnailId){
				$image = wp_get_attachment_thumb_url($thumbnailId);
			}else{
				$image = wc_placeholder_img_src();
			}

			$columns .= '<img src="' . esc_url($image) . '" alt="' . esc_attr__('تصویر', 'mweb') . '" class="wp-post-image" height="48" width="48" />';
		}

		return $columns;
	}

	/**
	 * Add brands radio to quick edit
	 *
	 * @param string $columnName
	 * @param string $postType
	 */
	public function quickEdit($columnName, $postType){
		if($postType == 'product' && $columnName == 'product_cat'){
			$brands = get_terms(self::get_brand_taxonomy_name(), [
				'orderby'    => 'name',
				'order'      => 'ASC',
				'hide_empty' => false,
			]);

			?>
			<fieldset class="inline-edit-col-right">
				<div class="inline-edit-col">
					<span class="title"><?php _e('برند', 'mweb'); ?></span>
					<select name="product_brand" id="">
						<option value="0" selected><?php _e('متفرقه', 'mweb'); ?></option>

						<?php foreach ($brands as $brand) : ?>
							<option value="<?= $brand->slug; ?>"><?= $brand->name; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</fieldset>
			<?php
		}
	}
	
	
	/**
	 * Add brands bulk edit
	 *
	 */
	public function bulkEdit(){
			$brands = get_terms(self::get_brand_taxonomy_name(), [
				'orderby'    => 'name',
				'order'      => 'ASC',
				'hide_empty' => false,
			]);

			?>
			<fieldset class="inline-edit-group">
				<label class="alignleft">
					<span class="title"><?php _e('برند', 'mweb'); ?></span>
					<span class="input-text-wrap">
						<select name="product_brand" id="">
							<option value="0" selected><?php _e('متفرقه', 'mweb'); ?></option>

							<?php foreach ($brands as $brand) : ?>
								<option value="<?= $brand->slug; ?>"><?= $brand->name; ?></option>
							<?php endforeach; ?>
						</select>
					</span>
				</label>
			</fieldset>
			<?php
	}

	/**
	 * View hidden input for js (because no flexible WP)
	 *
	 * @param string $column
	 */
	public function renderProductColumns($column){
		//wp_enqueue_script('mweb', $this->fileManager->locateAsset('admin/js/premmerce-brands.js'));

		if($column == 'name'){
			global $post;

			$brands = get_the_terms($post->ID, self::get_brand_taxonomy_name());

			if(isset($brands[0])){
				echo '<input type="hidden" data-input="product_brand" value="' . $brands[0]->slug . '">';
			}
		}
	}

	/**
	 * Save brand from quick edit form
	 *
	 * @param int $postId
	 */
	public function saveEditPost($postId){
		if(isset($_POST['product_brand'])){
			wp_set_post_terms($postId, $_POST['product_brand'], self::get_brand_taxonomy_name());
		}else{
			wp_set_post_terms($postId, '', self::get_brand_taxonomy_name());
		}
	}
	
	
	/**
	 * Save brand from quick edit form
	 *
	 * @param int $postId
	 */
	public function bulkEditSave( $product ) {
		$post_id = $product->get_id();    
	   if ( isset( $_REQUEST['product_brand'] ) ) {
			wp_set_post_terms($post_id, $_REQUEST['product_brand'], self::get_brand_taxonomy_name());
		}else{
			wp_set_post_terms($post_id, '', self::get_brand_taxonomy_name());
		}
	}
	
	
	
	
	/**
	 * Change breadcrumbs in brands page
	 *
	 * @param array $breadcrumbs
	 *
	 * @return array
	 */
	public function changeBreadcrumb($breadcrumbs){
		if(is_tax(self::get_brand_taxonomy_name())){
			$breadcrumbs[1][1] = get_site_url() . '/brands/';
		}

		return $breadcrumbs;
	}

	/**
	 * Add brand to product page
	 */
	public function addProductBrand(){
		
		$brands = get_the_terms(get_the_ID(), self::get_brand_taxonomy_name());
		$brand = isset($brands[0]) ? $brands[0] : null;
			if(!is_object($brand))
				return false;
			
			echo '<span class="brand_wrapper detail-container"><span class="detail-label">برند </span> <span class="brandlink"><a href="'. get_term_link($brand->slug, self::get_brand_taxonomy_name()) .'">'. $brand->name .'</a></span></span>';
			
		
	}

	/**
	 * Include brands page template
	 */
	public function brandsPage(){
		$brands = get_terms(self::get_brand_taxonomy_name(), [
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => false,
		]);


		if(!empty($brands) && !is_wp_error($brands)){
			?>
			<div class="brands-list">
				<?php foreach ($brands as $brand) :
					$imageURL = wp_get_attachment_image_url(get_term_meta($brand->term_id, 'thumbnail_id', true), 'medium');
					$imageURL = $imageURL ?: wc_placeholder_img_src();
					?>
					<div class="brands-list__col">
						<a class="brands-list__item" href="<?= get_term_link($brand->slug, self::get_brand_taxonomy_name()); ?>">
							<div class="brands-list__image">
								<img src="<?= $imageURL; ?>" alt="<?= $brand->name; ?>">
							</div>
							<div class="brands-list__title"><?= $brand->name; ?></div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
			<?php
		}
	}
	
	
	public static function get_brand_taxonomy_name(){
		$product_brand = apply_filters('mweb_product_brand_taxonomy', 'product_brand');
		return $product_brand;
	}
	

}


mweb_product_brand::init();