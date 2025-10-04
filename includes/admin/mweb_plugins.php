<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */

require_once get_template_directory() . '/includes/admin/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'mweb_register_required_plugins' );

function mweb_register_required_plugins() {
    $plugins = array(

       
		/* array(
            'name' 		=> 'wp-jalali',
            'slug' 		=> 'wp-jalali',
            'required' 	=> true
        ), */
		array(
            'name' 		=> 'classic widgets',
            'slug' 		=> 'classic-widgets',
            'required' 	=> true
        ),
		array(
            'name' 		=> 'WooCommerce',
            'slug' 		=> 'woocommerce',
            'required' 	=> true
        ),
		array(
			'name'               => 'Persian Woocommerce SMS',
			'slug'               => 'persian-woocommerce-sms',
			'required'           => false,
			'force_activation'   => false,
			'force_deactivation' => false,
		),
		array(
			'name'               => 'Elementor Page Builder',
			'slug'               => 'elementor',
			'required'           => false,
			'force_activation'   => false,
			'force_deactivation' => false,
		),
		array(
            'name' 		=> 'YITH WooCommerce Ajax Product Filter Premium',
            'slug' 		=> 'yith-woocommerce-ajax-product-filter-premium',
            'source'    => get_stylesheet_directory() . '/plugins/yith-woocommerce-ajax-product-filter-premium.zip', // The plugin source.
            'required' 	=> false
        ),	
		array(
            'name' 		=> 'MailChimp for WordPress',
            'slug' 		=> 'mailchimp-for-wp',
            'required' 	=> false
        ),
        array(
            'name' 		=> 'Contact Form 7',
            'slug' 		=> 'contact-form-7',
            'required' 	=> false
        )
    );

    $config = array(
        'id'           => 'digiland',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'mweb-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => false,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

    );

    tgmpa( $plugins, $config );
}