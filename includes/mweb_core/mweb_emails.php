<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
    // Exit if accessed directly
}


if ( ! class_exists( 'Wc_Email_Cancel_Request_Approved_Order' ) ) :

    class Wc_Email_Cancel_Request_Approved_Order extends WC_Email {
        /**
         * Constructor
         */
        function __construct() {

            $this->id = 'cancel_request_approved_order';
            $this->customer_email = true;
            $this->title = __( 'درخواست لغو پذیرفته شد', 'mweb' );
            $this->description= __( 'این یک اطلاعیه است که هنگام پذیرش درخواست لغو سفارش به مشتری ارسال می شود.', 'mweb' );
            $this->heading = __( 'درخواست لغو سفارش پذیرفته شد', 'mweb' );
            $this->subject      = __( 'شناسه سفارش: {order_number} درخواست لغو پذیرفته شد ', 'mweb' );
            $this->template_base = THEME_INC.'/templates/';
            $this->template_html = 'emails/cancel-request-approve-order.php';
            $this->template_plain = 'emails/plain/cancel-request-approve-order.php';
	        $this->placeholders   = array(
		        '{site_title}'   => $this->get_blogname(),
		        '{order_date}'   => '',
		        '{order_number}' => '',
	        );
            parent::__construct();
        }

        /**
         * trigger function.
         *
         * @access public
         * @return void
         */
        function trigger( $order_id ) {
	        $this->setup_locale();
	        $order = wc_get_order( $order_id );
	        if ( is_a( $order, 'WC_Order' ) ) {
		        $this->object                         = $order;
		        $this->recipient                      = $this->object->get_billing_email();
		        $this->placeholders['{order_date}']   = wc_format_datetime( $this->object->get_date_created() );
		        $this->placeholders['{order_number}'] = $this->object->get_order_number();
	        }
	        if ( $this->is_enabled() && $this->get_recipient() ) {
		        $this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
	        }
	        $this->restore_locale();
        }

        /**
         * get_content_html function.
         *
         * @access public
         * @return string
         */
        function get_content_html() {

            return wc_get_template_html(
                $this->template_html,
                array(
                'order' => $this->object,
                'email_heading' => $this->get_heading(),
                'sent_to_admin' => false,
                'plain_text'=>false,
                'email' => $this),
                '',
                $this->template_base);
        }

        /**
         * get_content_plain function.
         *
         * @access public
         * @return string
         */
        function get_content_plain() {

            return wc_get_template_html(
                $this->template_plain,
                array(
                'order' => $this->object,
                'email_heading' => $this->get_heading(),
                'sent_to_admin' => false,
                'plain_text'=>true,
                'email' => $this),
                '',
                $this->template_base);

        }


    }

endif;


if(!class_exists('WC_Email_Cancel_Request_Order')):

    class WC_Email_Cancel_Request_Order extends WC_Email {
        /**
         * Constructor
         */
        function __construct() {

            $this->id = 'cancel_request_order';
            $this->title = __( 'درخواست لغو سفارش', 'mweb' );
            $this->description= __( 'این یک اطلاعیه است که هنگام ارسال درخواست لغو سفارش توسط مشتری ، به مدیر سایت ارسال می شود.', 'mweb' );
            $this->heading = __( 'درخواست لغو سفارش دریافت شد', 'mweb' );
            $this->subject      = __( 'شناسه سفارش: {order_number} درخواست لغو دریافت شد', 'mweb' );
            $this->template_base = THEME_INC.'/templates/';
            $this->template_html = 'emails/cancel-request-order.php';
            $this->template_plain = 'emails/plain/cancel-request-order.php';
            $this->recipient = $this->get_option( 'recipient', get_option( 'admin_email' ) );
	        $this->placeholders   = array(
		        '{site_title}'   => $this->get_blogname(),
		        '{order_date}'   => '',
		        '{order_number}' => '',
	        );

            parent::__construct();
        }

        /**
         * trigger function.
         *
         * @access public
         * @return void
         */
        function trigger( $order_id ) {
	        $this->setup_locale();
	        $order = wc_get_order( $order_id );
	        if ( is_a( $order, 'WC_Order' ) ) {
		        $this->object                         = $order;
		        $this->placeholders['{order_date}']   = wc_format_datetime( $this->object->get_date_created() );
		        $this->placeholders['{order_number}'] = $this->object->get_order_number();
	        }

	        if ( $this->is_enabled() && $this->get_recipient() ) {
		        $this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
	        }
	        $this->restore_locale();
        }

        /**
         * get_content_html function.
         *
         * @access public
         * @return string
         */
        function get_content_html() {

            return wc_get_template_html(
                $this->template_html,
                array(
                'order' => $this->object,
                'email_heading' => $this->get_heading(),
                'sent_to_admin' => true,
                'plain_text'=>false,
                'email' => $this),
                '',
	            $this->template_base);

        }

        /**
         * get_content_plain function.
         *
         * @access public
         * @return string
         */
        function get_content_plain() {

            return wc_get_template_html(
                $this->template_plain,
                array(
                'order' => $this->object,
                'email_heading' => $this->get_heading(),
                'sent_to_admin' => true,
                'plain_text'=>true,
                'email' => $this),
                '',
	            $this->template_base);

        }

        function init_form_fields() {
			$placeholder_text  = sprintf( __( 'Available placeholders: %s', 'woocommerce' ), '<code>' . esc_html( implode( '</code>, <code>', array_keys( $this->placeholders ) ) ) . '</code>' );
            $this->form_fields = array(
                'enabled' => array(
                    'title'         => __( 'Enable/Disable', 'woocommerce' ),
                    'type'          => 'checkbox',
                    'label'         => __( 'Enable this email notification', 'woocommerce' ),
                    'default'       => 'yes'
                ),
                'recipient' => array(
                    'title'         => __( 'Recipient(s)', 'woocommerce' ),
                    'type'          => 'text',
					'description'   => sprintf( __( 'Enter recipients (comma separated) for this email. Defaults to %s.', 'woocommerce' ), '<code>' . esc_attr( get_option( 'admin_email' ) ) . '</code>' ),
                    'placeholder'   => '',
                    'default'       => esc_attr( get_option('admin_email') ),
                    'desc_tip'      => true
                ),
                'subject' => array(
                    'title'         => __( 'Subject', 'woocommerce' ),
                    'type'          => 'text',
					'description' => $placeholder_text,
                    'placeholder'   => '',
                    'default'       => '',
                    'desc_tip'      => true
                ),
                'heading' => array(
					'title'         => __( 'Email heading', 'woocommerce' ),
                    'type'          => 'text',
					'description' => $placeholder_text,
                    'placeholder'   => '',
                    'default'       => '',
                    'desc_tip'      => true
                ),
                'email_type' => array(
                    'title'         => __( 'Email type', 'woocommerce' ),
                    'type'          => 'select',
                    'description'   => __( 'Choose which format of email to send.', 'woocommerce' ),
                    'default'       => 'html',
                    'class'         => 'email_type wc-enhanced-select',
                    'options'       => $this->get_email_type_options(),
                    'desc_tip'      => true
                )
            );
        }

    }

endif;


if ( ! class_exists( 'Wc_Email_Cancel_Request_Reject_Order' ) ) :

    class Wc_Email_Cancel_Request_Reject_Order extends WC_Email {
        /**
         * Constructor
         */
        function __construct() {
            $this->id = 'cancel_request_reject_order';
            $this->customer_email = true;
            $this->title = __( 'درخواست لغو سفارش رد شد', 'mweb' );
            $this->description= __( 'این یک اطلاعیه است که هنگام رد درخواست لغو سفارش به مشتری ارسال می شود.', 'mweb' );
            $this->heading = __( 'درخواست لغو سفارش رد شد', 'mweb' );
            $this->template_base = THEME_INC.'/templates/';
            $this->subject      = __( 'شناسه سفارش: {order_number} درخواست لغو رد شد', 'mweb' );
            $this->template_html = 'emails/cancel-request-rejecte-order.php';
            $this->template_plain = 'emails/plain/cancel-request-rejecte-order.php';
	        $this->placeholders   = array(
		        '{site_title}'   => $this->get_blogname(),
		        '{order_date}'   => '',
		        '{order_number}' => '',
	        );
            parent::__construct();
        }

        /**
         * trigger function.
         *
         * @access public
         * @return void
         */
        function trigger($order_id){
	        $this->setup_locale();
	        $order = wc_get_order($order_id);
	        if ( is_a( $order, 'WC_Order' ) ) {
		        $this->object                         = $order;
		        $this->recipient                      = $this->object->get_billing_email();
		        $this->placeholders['{order_date}']   = wc_format_datetime( $this->object->get_date_created() );
		        $this->placeholders['{order_number}'] = $this->object->get_order_number();
	        }
	        if ( $this->is_enabled() && $this->get_recipient() ) {
		        $this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
	        }
	        $this->restore_locale();
        }

        /**
         * get_content_html function.
         *
         * @access public
         * @return string
         */
        function get_content_html() {

            return wc_get_template_html(
                $this->template_html,
                array(
                'order' => $this->object,
                'email_heading' => $this->get_heading(),
                'sent_to_admin' => false,
                'plain_text'=>false,
                'email' => $this),
                '',
                $this->template_base);

        }

        /**
         * get_content_plain function.
         *
         * @access public
         * @return string
         */
        function get_content_plain() {

            return wc_get_template_html(
                $this->template_plain,
                array(
                'order' => $this->object,
                'email_heading' => $this->get_heading(),
                'sent_to_admin' => false,
                'plain_text'=>true,
                'email' => $this),
                '',
                $this->template_base);

        }

    }

endif;