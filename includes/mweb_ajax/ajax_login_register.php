<?php
add_action( 'wp_ajax_nopriv_ajax_login', 'ajax_login' );
add_action( 'wp_ajax_ajax_login', 'ajax_login' );


function ajax_login(){
 
   // check_ajax_referer( 'ajax-login-nonce', 'security-login' );
	if ( isset( $_POST['security-login'] ) && wp_verify_nonce( $_POST['security-login'], 'mweb-ajax-nonce' ) ) {
		$is_valid = apply_filters('google_invre_is_valid_request_filter', true);
		if( ! $is_valid ){
			wp_send_json_error(array('message' => 'خطا در ارسال اطلاعات - منبع نامشخص'));
		}else{
		
			$username_var = sanitize_text_field(trim($_POST['signin_email']));

			$info = array();
			$info['user_login'] = $username_var;
			$info['user_password'] = sanitize_text_field(trim( $_POST['signin_password']));
			$info['remember'] =  isset($_POST['remember-me']) ? true : false;
			
			
			
			if ( !$username_var ) {
					wp_send_json_error(array('message' => 'نام کاربری و یا شماره موبایل خالی است', 'for'=>'signin_email'));
				}

			if ( !$info['user_password'] ) {
				wp_send_json_error(array('message' => 'گذرواژه خالی است', 'for'=>'signin_password'));
			}
			
			if (is_numeric($username_var)) {
				
				$matchingUsers = get_users(array(
					'meta_key'     => 'user_meta_mobile',
					'meta_value'   => $username_var,
					'meta_compare' => 'LIKE'
				));

				if (is_array($matchingUsers)) {
					$info['user_login'] = $matchingUsers[0]->user_login;
				}
			}

			
			$user_signon = wp_signon( $info, false );
			
			 if ( is_wp_error($user_signon) ){

				wp_send_json_error(array('message'=>implode('<br/>', $user_signon->get_error_messages())));
			} else {
				wp_send_json_success(array('logged_in' => true,'message'=> 'ورود شما موفقیت آمیز بود . لطفا صبر کنید ...'));
			}
			
		} // check recaptcha
	}else{
		wp_send_json_error(array('message' => 'خطا در ارسال از منبع نامشخص'));
	}
}
 

if(is_recaptcha_activated()){
	add_filter( 'google_invre_language_code_filter', 'myprefix_change_recaptcha_language' );
	function myprefix_change_recaptcha_language($language_code){
		$language_code = 'fa'; // Farsi
		return $language_code;
	}
 
}

 

