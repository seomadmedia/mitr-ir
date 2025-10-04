<?php
add_action('widgets_init', 'mweb_register_brands_widget');

function mweb_register_brands_widget()
{
    register_widget('mweb_brands_widget');
}

class mweb_brands_widget extends WP_Widget
{

	//register widget
    function __construct()
    {
        $widget_ops = array('classname' => 'brands-widget', 'description' => '');
        parent::__construct('mweb_brand_widget', THEME_NAME .' - برندها', $widget_ops);
    }


	//render widget
    function widget($args, $instance)
    {
		
		extract($args);
		
        $title     = $instance['title'];
		$onlyPhoto = $instance['only_photo']? true : false;
		$limit     = isset($instance['limit'])? $instance['limit'] : null;
		$selected  = $instance['selected'];
		$mode      = $instance['mode'];

		$params = [
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => false,
		];

		if($mode == 'custom'){
			$params['term_taxonomy_id'] = $selected;
		}else{
			$params['number'] = $limit;

			if($onlyPhoto){
				$params['meta_query'][] = [
					'key'     => 'thumbnail_id',
					'value'   => 0,
					'compare' => '!=',
				];
			}
		}

		$brands = get_terms('product_brand', $params);

		

        echo $before_widget;

	    if ( ! empty( $title ) ) {
		    echo $before_title . esc_attr( $title ) . $after_title;
	    }
		
		if(!empty($brands) && !is_wp_error($brands)){
		?>
			<div class="brands-widget">
				<?php foreach ($brands as $brand) : ?>
					<a class="brands-widget__item" href="<?= get_term_link($brand->slug, 'product_brand'); ?>">
						<?php if ($imageURL = wp_get_attachment_image_url(get_term_meta($brand->term_id, 'thumbnail_id', true), 'thumbnail')) : ?>
							<img class="brands-widget__image" src="<?= $imageURL; ?>">
						<?php endif ?>
						<?php if(!$onlyPhoto): ?>
						<div class="brands-widget__title">
							<?= $brand->name ?>
						</div>
						<?php endif ?>
					</a>
				<?php endforeach ?>
			</div>
		<?php	
		}
        echo $after_widget;
    }


	//update forms
	function update( $new_instance, $old_instance ) {
		
		$instance               = $old_instance;
		$instance['title']      = sanitize_text_field($new_instance['title']);
		$instance['only_photo'] = $new_instance['only_photo'];
		$instance['limit']      = ((int)$new_instance['limit'] > 0)? intval($new_instance['limit']) : '';
		$instance['selected']   = $new_instance['selected'];
		$instance['mode']       = $new_instance['mode'];

		return $instance;
	}


	//form settinga
    function form($instance)
    {
	    
		wp_enqueue_script(THEME_NAME.'-brands', get_template_directory_uri() . '/includes/admin/js/brands.js', array('jquery'), THEME_VERSION, true);
		wp_enqueue_script(THEME_NAME.'-select2', get_template_directory_uri() . '/includes/admin/js/select2.min.js', array('jquery'), THEME_VERSION, true);
		wp_enqueue_style(THEME_NAME.'-select2', get_template_directory_uri() . '/includes/admin/css/select2.css', array(), THEME_VERSION, 'all');
		
		$title     = isset($instance['title'])? $instance['title'] : '';
		$mode      = isset($instance['mode'])? $instance['mode'] : 'auto';
		$onlyPhoto = isset($instance['only_photo'])? true : false;
		$limit     = isset($instance['limit'])? $instance['limit'] : null;
		$selected  = (isset($instance['selected']) && is_array($instance['selected']))? $instance['selected'] : [];
		


		$brands = get_terms('product_brand', [
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => false,
		]);

		?>


	    <p>
			<label for="<?= $this->get_field_id('title') ?>">عنوان</label>
			<input id="<?= $this->get_field_id('title'); ?>" class="widefat" type="text" name="<?= $this->get_field_name('title'); ?>" value="<?= $title; ?>">
		</p>
		<p>
			<label for="<?= $this->get_field_id('mode') ?>"><?php _e('نوع', 'mweb'); ?></label>
			<select id="<?= $this->get_field_id('mode') ?>" name="<?=	$this->get_field_name('mode'); ?>" class="widefat mweb-carousel-select">
				<option value="auto" <?php selected(($mode == 'auto') ? 1 : 0); ?>><?php _e('خودکار', 'mweb'); ?></option>
				<option value="custom" <?php selected(($mode == 'custom') ? 1 : 0); ?>><?php _e('سفارشی', 'mweb'); ?></option>
			</select>
		</p>
		<div data-select="mweb-filter-auto" <?= ($mode == 'auto') ?: 'style="display: none"'; ?>>
			<p>
				<input id="<?= $this->get_field_id('only_photo') ?>" type="checkbox" <?php checked($onlyPhoto ? 1 : 0); ?> name="<?= $this->get_field_name('only_photo'); ?>">
				<label for="<?= $this->get_field_id('only_photo'); ?>">فقط نمایش عکس</label>
			</p>
			<p>
				<label for="<?= $this->get_field_id('limit') ?>">تعداد</label>
				<input id="<?= $this->get_field_id('limit'); ?>" class="tiny-text" type="number" min="0" name="<?= $this->get_field_name('limit'); ?>" value="<?= $limit; ?>">
			</p>
		</div>
		<div data-select="mweb-filter-custom" <?= ($mode == 'custom') ?: 'style="display: none"'; ?>>
			<p>
				<label for="<?= $this->get_field_id('selected[]') ?>">انتخاب</label>
				<select style="width: 100%;" data-select="brands" id="<?= $this->get_field_id('selected[]'); ?>" name="<?=
				$this->get_field_name('selected[]'); ?>" multiple>
					<?php foreach ($brands as $brand) : ?>

						<option value="<?= $brand->term_id; ?>" <?php selected(in_array($brand->term_id, $selected) ? 1 : 0); ?>><?= $brand->name; ?></option>

					<?php endforeach; ?>
				</select>
			</p>
		</div>

    <?php
    }
}

?>