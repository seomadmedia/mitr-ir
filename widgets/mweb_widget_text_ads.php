<?php
//ads text widget
class Link_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'link_widget', 
            __('تبلیغات متنی', 'mweb'),   
            array( 'description' => __( '', 'mweb' ), ) // Args
        );
    }

	function form($instance) {

		$defaults = array(
			'title' => __('تبلیغات متنی', 'mweb'),
			'links' => array(),
		);
		$instance = wp_parse_args((array) $instance, $defaults);
		$title = $instance['title'];
		$links = $instance['links'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('عنوان:', 'mweb'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<div class="link-fields">
			<?php foreach ($links as $key => $link) { ?>
				<p>
					<label for="<?php echo $this->get_field_id('title_' . $key); ?>"><?php _e('عنوان لینک:', 'mweb'); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id('title_' . $key); ?>" name="<?php echo $this->get_field_name('links') . '[' . $key . '][title]'; ?>" type="text" value="<?php echo esc_attr($link['title']); ?>" />
					<label for="<?php echo $this->get_field_id('link_' . $key); ?>"><?php _e('لینک:', 'mweb'); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id('link_' . $key); ?>" name="<?php echo $this->get_field_name('links') . '[' . $key . '][link]'; ?>" type="text" value="<?php echo esc_attr($link['link']); ?>" />
					<button type="button" class="button-link-remove"><?php _e('حذف', 'mweb'); ?></button>
				</p>
			<?php } ?>
		</div>
		<button type="button" class="button-link-add"><?php _e('افزودن جدید', 'mweb'); ?></button>
		<script>
			jQuery(document).ready(function($) {
				$('.button-link-add').off('click').on('click', function(e) {
					var $linkFields = $(this).closest('div').find('.link-fields');
					var newIndex = $linkFields.children('p').length;

					var $newField = $('<p>' +
						'<label for="<?php echo $this->get_field_id('title'); ?>_' + newIndex + '"><?php _e('عنوان لینک:', 'mweb'); ?></label>' +
						'<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>_' + newIndex + '" name="<?php echo $this->get_field_name('links'); ?>[' + newIndex + '][title]" type="text" value="" />' +
						'<label for="<?php echo $this->get_field_id('link'); ?>_' + newIndex + '"><?php _e('لینک:', 'mweb'); ?></label>' +
						'<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>_' + newIndex + '" name="<?php echo $this->get_field_name('links'); ?>[' + newIndex + '][link]" type="text" value="" />' +
						'<button type="button" class="button-link-remove"><?php _e('حذف', 'mweb'); ?></button>' +
						'</p>');

					$linkFields.append($newField);
				});

				$(document).on('click', '.button-link-remove', function() {
					$(this).closest('p').remove();
				});
			});
		</script>
		<?php
	}




    // Widget update
    function update($new_instance, $old_instance) {
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['links'] = array();

		// Process links
		if (isset($new_instance['links']) && is_array($new_instance['links'])) {
			foreach ($new_instance['links'] as $link) {
				// Ensure both title and link are set before adding
				if (!empty($link['title']) && !empty($link['link'])) {
					$instance['links'][] = array(
						'title' => strip_tags($link['title']),
						'link' => esc_url_raw($link['link'])
					);
				}
			}
		}

		return $instance;
	}


    // Display widget
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $links = $instance['links'];
        echo $before_widget;
        if ($title) {
            echo $before_title . $title . $after_title;
        }
        echo '<div class="widget-text wp_widget_plugin_box">';
        foreach ($links as $link) {
            if (!empty($link['title']) && !empty($link['link'])) {
                echo '<a href="' . esc_url($link['link']) . '">' . esc_html($link['title']) . '</a><br />';
            }
        }
        echo '</div>';
        echo $after_widget;
    }
}

// Register the widget
function register_link_widget() {
    register_widget('Link_Widget');
}
add_action('widgets_init', 'register_link_widget');