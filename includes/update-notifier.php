<?php
 
/*-----------------------------------------------------------------------------------*/
/* Provides a notification to the user everytime 
/* your WordPress theme is updated  
/*-----------------------------------------------------------------------------------*/



define( 'NOTIFIER_THEME_NAME', THEME_NAME_Fa ); 
define( 'NOTIFIER_THEME_FOLDER_NAME', Theme_Folder ); 
define( 'NOTIFIER_XML_FILE', 'http://www.mahdisweb.net/themes/' . Theme_Folder . '/notifier.xml' ); 
define( 'NOTIFIER_CACHE_INTERVAL', 86400 ); // (21600 seconds = 6 hours)

// Adds an update notification to the WordPress Dashboard menu
function update_notifier_menu() {
	if (function_exists('simplexml_load_string')) { 
	    $xml = get_latest_theme_version(NOTIFIER_CACHE_INTERVAL); 
		$last_notify = get_option( 'mw_last_notify', THEME_VERSION );

		if( (float)$xml->latest > (float)$last_notify ) { // Compare current theme version with the remote XML version
			add_theme_page( NOTIFIER_THEME_NAME . ' اطلاعیه ها', 'اطلاعیه <span class="update-plugins count-1"><span class="update-count">جدید</span></span>', 'administrator', 'mahdisweb-notifier', 'update_notifier');
		}
	
	}
}
add_action('admin_menu', 'update_notifier_menu');



// Adds an update notification to the WordPress 3.1+ Admin Bar
function update_notifier_bar_menu() {
	if (function_exists('simplexml_load_string')) { 
		global $wp_admin_bar, $wpdb;

		if ( !is_super_admin() || !is_admin_bar_showing() ) 
		return;

		$xml = get_latest_theme_version(NOTIFIER_CACHE_INTERVAL); 
		$last_notify = get_option( 'mw_last_notify', THEME_VERSION );

		if( (float)$xml->latest > (float)$last_notify) { 
			$wp_admin_bar->add_menu( array( 'id' => 'update_notifier', 'title' => '<span>' . NOTIFIER_THEME_NAME . ' <span id="ab-updates">اطلاعیه جدید</span></span>', 'href' => get_admin_url() . 'themes.php?page=mahdisweb-notifier' ) );
		}
	}
}
add_action( 'admin_bar_menu', 'update_notifier_bar_menu', 1000 );



// The notifier page
function update_notifier() {
	$xml = get_latest_theme_version(NOTIFIER_CACHE_INTERVAL); 
	update_option( 'mw_last_notify', (float)$xml->latest );
	?>

	<style>
	    #wpadminbar .quicklinks a span#ab-updates{	font-weight:normal; 	padding: 1px 7px 3px;    font-size: 11px;}
		.update-nag { display: none; }
		#instructions {max-width: 100%;    min-height: 300px;}
		.uptit,h3.title { font-family:Tahoma !important; margin: 30px 0 0 0; padding: 30px 0 0 0; border-top: 1px solid #ddd; font-weight:normal !important}
		.notify_block{display:flex;background-color:#FFF;border-radius:10px;padding:15px;box-shadow:0 0 15px -5px #00000012;flex-wrap:nowrap;position:relative; margin: 5px 15px;}
		.notify_block.is_new:after{content:'New';content:'New';position:absolute;left:10px;top:10px;background-color:#F44336;color:#FFF;border-radius:10px;padding:0 10px;font-size:11px}
		.notify_right{margin-left:15px;text-align:center;padding:0 0 0 15px;border-left:1px dashed #ddd}
		.notify_right img{display:block;margin-bottom:2px}
		.notify_right span{font-size:18px;font-family:sans-serif;font-weight:500;display:block}
		.notify_right sup{font-weight:400;font-size:10px;position:relative;color: #a2a2a2;letter-spacing: 1px;text-transform: uppercase;}
		.notify_left h3{margin:.5em 0;font-family:Tahoma,Arial;font-size:13px}
		.notify_left .desc{color:#555;display:block}
		.notify_left>a{display:inline-block;text-decoration:none;background-color:#ffece8;border-radius:15px;padding:5px 15px;height:25px;line-height:12px;box-sizing:border-box;font-size:11px;margin-top:10px;color:#555}
		.notify_left>a:hover{background-color:#9c9c9c;color:#fff}
	</style>

	<div class="wrap">

	    <?php echo $xml->changelog; ?>

	</div>

<?php }



// Get the remote XML file contents and return its data (Version and Changelog)
// Uses the cached version if available and inside the time interval defined
function get_latest_theme_version($interval) {
	$notifier_file_url = NOTIFIER_XML_FILE;
	$db_cache_field = Theme_Folder . '-notifier-cache';
	$db_cache_field_last_updated = Theme_Folder . '-notifier-cache-last-updated';
	$last = get_option( $db_cache_field_last_updated );
	$now = time();
	// check the cache
	if ( !$last || (( $now - $last ) > $interval) ) {

		$cache = '';
		$response = wp_remote_get($notifier_file_url);
		if (!is_wp_error($response)) {
			$cache = $response['body'];
		}

		if ($cache) {
			// we got good results
			update_option( $db_cache_field, $cache );
			update_option( $db_cache_field_last_updated, time() );
		}
		// read from the cache file
		$notifier_data = get_option( $db_cache_field );
	}
	else {
		// cache file is fresh enough, so read from it
		$notifier_data = get_option( $db_cache_field );
	}

	// Let's see if the $xml data was returned as we expected it to.
	// If it didn't, use the default 1.0 as the latest version so that we don't have problems when the remote server hosting the XML file is down
	if( strpos((string)$notifier_data, '<notifier>') === false ) {
		$notifier_data = '<?xml version="1.0" encoding="UTF-8"?><notifier><latest>1.0</latest><changelog></changelog></notifier>';
	}

	// Load the remote XML data into a variable and return it
	$xml = simplexml_load_string($notifier_data);

	return $xml;
}
