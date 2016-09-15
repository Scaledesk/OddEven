<?php
/*
Plugin Name: RockonCore
Plugin URI: http://kamleshyadav.com/wp/rockon
Description: This plugin create custom post type and some meta option.
Version: 1.0.0
Author: Himanshu Mehta - himanshusofttech.com
Author URI: http://himanshusofttech.com/
*/
define('PLUGIN_PATH', plugin_dir_url( __FILE__ ) );
function rockon_adminload_script(){
	wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	wp_enqueue_script('uploadmedia', PLUGIN_PATH. 'js/upload-media.js');
	wp_enqueue_style('admincss', PLUGIN_PATH. 'css/admin.css');
	wp_enqueue_script('jquery-ui-js', 'http://code.jquery.com/ui/1.11.4/jquery-ui.js');
	wp_enqueue_style('jquery-ui-css', 'http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css');
	wp_enqueue_script('admindatepickerjs', PLUGIN_PATH. 'js/jquery.simple-dtpicker.js');
	wp_enqueue_style('admindatepickercss', PLUGIN_PATH. 'css/jquery.simple-dtpicker.css');
	wp_enqueue_script('adminmultipleimagesjs', PLUGIN_PATH. 'js/upload_multipleimages.js');
	wp_enqueue_style('dataTables_css', PLUGIN_PATH. 'css/jquery.dataTables.min.css');
	wp_enqueue_script('dataTables_js', PLUGIN_PATH. 'js/jquery.dataTables.min.js');
	wp_enqueue_style('perfect_scrollbar_css', PLUGIN_PATH. 'css/perfect-scrollbar.css');
	wp_enqueue_script('perfect_scrollbar_js', PLUGIN_PATH. 'js/perfect-scrollbar.js');
}
add_action('admin_enqueue_scripts','rockon_adminload_script');

function rockoncore_activate() {
	global $wpdb;
	$table_name = $wpdb->prefix . "event_booking_info";
	$charset_collate = $wpdb->get_charset_collate();
	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
 		id mediumint(9) NOT NULL AUTO_INCREMENT,
  		name varchar(55),
  		email varchar(100),
  		phonenumber varchar(20),
  		address varchar(200),
  		paypal_reciever_email varchar(100),
  		paypal_sender_email varchar(100),
  		event_id int(20),
  		qty int(20),
  		payment_status varchar(55),
  		txn_id varchar(100),
  		payment int(20),
  		coupon_code varchar(55),
  		date_time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		status int(20),
  		UNIQUE KEY id (id)
	) $charset_collate;";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}
register_activation_hook( __FILE__, 'rockoncore_activate' );

require_once 'rockon-custompost.php';
//require_once 'view_booking_page.php';
require_once 'rockon-widgets.php';
require_once 'rockon-metaoption.php';
require_once 'shortcodes.php';


add_filter( 'rwmb_meta_boxes', 'rockoncore_register_meta_boxes' );
function rockoncore_register_meta_boxes(){
	
	$prefix = 'rockon_';
	
	/**
	 * post_type rockon_track.
	 */
	require_once 'metabox/metabox_rockon_track.php';
	
	return $meta_boxes;
}

function rockoncore_parseVideoURL($url){
	if(strpos($url, 'youtube.com/embed') > 0 || strpos($url, 'player.vimeo.com/video') > 0){
		return $url;
	}else{
		if (strpos($url, 'youtube') > 0) {
			preg_match('/v=(.{11})/', $url, $matches);
			return 'https://www.youtube.com/embed/'.$matches[1];
		} elseif (strpos($url, 'vimeo') > 0) {
			preg_match('/vimeo\.com\/([0-9]{1,10})/', $url, $matches);
			return 'https://player.vimeo.com/video/'.$matches[1];
		} else {
			return $url;
		}
	}
}


?>