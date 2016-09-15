<?php

/**
 * Plugin Name: Facebook Feed WD
 * Plugin URI: https://web-dorado.com/products/wordpress-facebook-feed-plugin.html
 * Description:Facebook Feed WD is a completely customizable, responsive solution to help you display your Facebook feed on your WordPress website.
 * Version: 1.0.5
 * Author: WebDorado
 * Author URI: https://web-dorado.com/
 * License: GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

define('WD_FFWD_DIR', WP_PLUGIN_DIR . "/" . plugin_basename(dirname(__FILE__)));
define('WD_FFWD_URL', plugins_url(plugin_basename(dirname(__FILE__))));
define('WD_FFWD_PRO', true);
define('WD_FB_PREFIX', 'ffwd');
if (session_id() == '')
    session_start();

function ffwd_use_home_url()
{
    $home_url = str_replace("http://", "", home_url());
    $home_url = str_replace("https://", "", $home_url);
    $pos = strpos($home_url, "/");
    if ($pos) {
        $home_url = substr($home_url, 0, $pos);
    }

    $site_url = str_replace("http://", "", WD_FFWD_URL);
    $site_url = str_replace("https://", "", $site_url);
    $pos = strpos($site_url, "/");
    if ($pos) {
        $site_url = substr($site_url, 0, $pos);
    }
    return $site_url != $home_url;
}

if (ffwd_use_home_url()) {
    define('WD_FFWD_FRONT_URL', home_url("wp-content/plugins/" . plugin_basename(dirname(__FILE__))));
} else {
    define('WD_FFWD_FRONT_URL', WD_FFWD_URL);
}

// Plugin menu.
function ffwd_menu_panel()
{
    $galleries_page = add_menu_page('Facebook Feed WD', 'Facebook Feed WD', 'manage_options', 'info_ffwd', 'ffwd_menu', WD_FFWD_URL . '/images/ffwd/ffwd_logo_small.png');

    $galleries_page = add_submenu_page('info_ffwd', 'Feeds', 'Feeds', 'manage_options', 'info_ffwd', 'ffwd_menu');
    add_action('admin_print_styles-' . $galleries_page, 'ffwd_styles');
    add_action('admin_print_scripts-' . $galleries_page, 'ffwd_scripts');
    add_action('load-' . $galleries_page, 'ffwd_add_ffwd_info_per_page_option');

    $options_page = add_submenu_page('info_ffwd', 'Options', 'Options', 'manage_options', 'options_ffwd', 'ffwd_menu');
    add_action('admin_print_styles-' . $options_page, 'ffwd_styles');
    add_action('admin_print_scripts-' . $options_page, 'ffwd_admin_scripts');

    $themes_page = add_submenu_page('info_ffwd', 'Themes', 'Themes', 'manage_options', 'themes_ffwd', 'ffwd_menu');
    add_action('admin_print_styles-' . $themes_page, 'ffwd_styles');
    add_action('admin_print_scripts-' . $themes_page, 'ffwd_admin_scripts');
    add_action('load-' . $themes_page, 'ffwd_add_themes_per_page_option');

    $licensing_page = add_submenu_page('info_ffwd', 'Buy Pro', 'Buy Pro', 'manage_options', 'ffwd_licensing', 'ffwd_licensing_page');
    add_action('admin_print_styles-' . $licensing_page, 'ffwd_styles');


    add_submenu_page('info_ffwd', 'Featured Plugins', 'Featured Plugins', 'manage_options', 'featured_plugins_ffwd', 'ffwd_featured');
    add_submenu_page('info_ffwd', 'Featured Themes', 'Featured Themes', 'manage_options', 'featured_themes_ffwd', 'ffwd_featured_themes');


    $uninstall_page = add_submenu_page('info_ffwd', 'Uninstall', 'Uninstall', 'manage_options', 'uninstall_ffwd', 'ffwd_menu');
    add_action('admin_print_styles-' . $uninstall_page, 'ffwd_styles');
    add_action('admin_print_scripts-' . $uninstall_page, 'ffwd_admin_scripts');
}

add_action('admin_menu', 'ffwd_menu_panel');

function ffwd_menu()
{
    global $wpdb;
    require_once(WD_FFWD_DIR . '/framework/WDW_FFWD_Library.php');
    $page = WDW_FFWD_Library::get('page');
    if (($page != '') && (($page == 'info_ffwd') || ($page == 'options_ffwd') || ($page == 'themes_ffwd') || ($page == 'uninstall_ffwd') || ($page == 'FFWDShortcode'))) {
        require_once(WD_FFWD_DIR . '/admin/controllers/FFWDController' . (($page == 'FFWDShortcode') ? $page : ucfirst(strtolower($page))) . '.php');
        $controller_class = 'FFWDController' . ucfirst(strtolower($page));
        $controller = new $controller_class();
        $controller->execute();
    }
}

function ffwd_featured()
{
    if (function_exists('current_user_can')) {
        if (!current_user_can('manage_options')) {
            die('Access Denied');
        }
    } else {
        die('Access Denied');
    }
    require_once(WD_FFWD_DIR . '/featured/featured.php');
    wp_register_style('ffwd_featured', WD_FFWD_URL . '/featured/style.css', array(), ffwd_get_version());
    wp_print_styles('ffwd_featured');
    spider_featured('facebook-feed-wd');
}

function ffwd_featured_themes()
{
    if (function_exists('current_user_can')) {
        if (!current_user_can('manage_options')) {
            die('Access Denied');
        }
    } else {
        die('Access Denied');
    }
    require_once(WD_FFWD_DIR . '/featured/featured_themes.php');
    wp_register_style('featured_themes', WD_FFWD_URL . '/featured/themes_style.css', array(), ffwd_get_version());
    wp_print_styles('featured_themes');
    spider_featured_themes('facebook-feed-wd');
}


function FFWD_licensing_page()
{
    $controller_class = 'FFWDControllerLicensing_ffwd';
    require_once(WD_FFWD_DIR . '/admin/controllers/' . $controller_class . '.php');
    $controller = new $controller_class();
    $controller->execute();
}


function ffwd_ajax_frontend()
{
    require_once(WD_FFWD_DIR . '/framework/WDW_FFWD_Library.php');
    $page = WDW_FFWD_Library::get('action');
    if ($page != '' && $page == 'PopupBox') {
        require_once(WD_FFWD_DIR . '/frontend/controllers/FFWDController' . ucfirst($page) . '.php');
        $controller_class = 'FFWDController' . ucfirst($page);
        $controller = new $controller_class();
        $controller->execute();
    }
}

add_action('wp_ajax_PopupBox', 'ffwd_ajax_frontend');
add_action('wp_ajax_nopriv_PopupBox', 'ffwd_ajax_frontend');
// For facebook feed
add_action('wp_ajax_nopriv_save_facebook_feed', 'ffwd_ajax');
add_action('wp_ajax_save_facebook_feed', 'ffwd_ajax');
// For check app
add_action('wp_ajax_nopriv_check_app', 'ffwd_ajax');
add_action('wp_ajax_check_app', 'ffwd_ajax');
// For drop objects
add_action('wp_ajax_nopriv_dropp_objects', 'ffwd_ajax');
add_action('wp_ajax_dropp_objects', 'ffwd_ajax');

function ffwd_ajax()
{
    if (function_exists('current_user_can')) {
        if (!current_user_can('manage_options')) {
            die('Access Denied');
        }
    } else {
        die('Access Denied');
    }
    require_once(WD_FFWD_DIR . '/framework/WDW_FFWD_Library.php');
    $page = WDW_FFWD_Library::get('action');
    $nonce = ($page == 'save_facebook_feed' || $page == 'dropp_objects') ? 'info_ffwd' : (($page == 'check_app') ? 'options_ffwd' : $page);
    if (($page != 'FFWDShortcode') && !WDW_FFWD_Library::verify_nonce($nonce)) {
        die('Sorry, your nonce did not verify.');
    }
    if ($page == 'FFWDShortcode') {
        require_once(WD_FFWD_DIR . '/admin/controllers/FFWDController' . ucfirst($page) . '.php');
        $controller_class = 'FFWDController' . ucfirst($page);
        $controller = new $controller_class();
        $controller->execute();
    } elseif ($page == 'check_app' || $page == 'save_facebook_feed' || $page == 'dropp_objects') {
        require_once(WD_FFWD_DIR . '/framework/WDFacebookFeed.php');
        WDFacebookFeed::execute();
    }
}

function ffwd_shortcode($params)
{
    require_once(WD_FFWD_DIR . '/framework/WDW_FFWD_Library.php');


    global $wpdb;

    $check_fb_feed = $wpdb->get_var($wpdb->prepare("SELECT id FROM " . $wpdb->prefix . "wd_fb_info WHERE id='%d'", $params['id']));
    if (!$check_fb_feed) {
        echo WDW_FFWD_Library::message(__('Feed Doesn\'t exists', 'bwg'), 'error');
        return;
    }
    $params['fb_id'] = $params['id'];
    ob_start();
    ffwd_front_end($params);
    return str_replace(array("\r\n", "\n", "\r"), '', ob_get_clean());
}

add_shortcode('WD_FB', 'ffwd_shortcode');

$ffwd = 0;
function ffwd_front_end($params)
{
    global $ffwd;
    global $wpdb;
    require_once(WD_FFWD_DIR . '/frontend/controllers/FFWDControllerMain.php');

    $fb_view_type = $wpdb->get_var($wpdb->prepare("SELECT fb_view_type FROM " . $wpdb->prefix . "wd_fb_info WHERE id='%s'", $params['fb_id']));

    $controller = new FFWDControllerMain($params, 1, $ffwd, ucfirst($fb_view_type));
    $ffwd++;
    return;
}

// Add the Facebook Feed WD button.
function ffwd_add_button($buttons)
{
    array_push($buttons, "wd_fb_mce");
    return $buttons;
}

// Register Facebook Feed WD button.
function ffwd_register($plugin_array)
{
    $url = WD_FFWD_URL . '/js/ffwd_editor_button.js';
    $plugin_array["wd_fb_mce"] = $url;
    return $plugin_array;
}

function ffwd_admin_ajax()
{
    $query_url = wp_nonce_url(admin_url('admin-ajax.php'), '', 'ffwd_nonce');
    ?>
    <script>
        var ffwd_admin_ajax = '<?php echo add_query_arg(array('action' => 'FFWDShortcode'), admin_url('admin-ajax.php')); ?>';
        var ffwd_plugin_url = '<?php echo WD_FFWD_URL; ?>';
        var ajax_url = '<?php echo $query_url; ?>';
    </script>
    <?php
}

add_action('admin_head', 'ffwd_admin_ajax');

// Add the Facebook Feed WD button to editor.
add_action('wp_ajax_FFWDShortcode', 'ffwd_ajax');
add_filter('mce_external_plugins', 'ffwd_register');
add_filter('mce_buttons', 'ffwd_add_button', 0);

// Activate plugin.
function ffwd_activate()
{
    global $wpdb;
    $wd_fb_shortcode = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "wd_fb_shortcode` (
    `id` bigint(20) NOT NULL,
    `tagtext` mediumtext NOT NULL,
    PRIMARY KEY (`id`)
  ) DEFAULT CHARSET=utf8;";
    $wpdb->query($wd_fb_shortcode);

    $wd_fb_info = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "wd_fb_info` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `content_type` varchar(15) NOT NULL,
  `content` varchar(256) NOT NULL,
  `content_url` varchar(512) NOT NULL,
  `timeline_type` varchar(16) NOT NULL,
  `from` varchar(32) NOT NULL,
  `limit` int(11) NOT NULL,
  `app_id` varchar(128) NOT NULL,
  `app_secret` varchar(256) NOT NULL,
  `exist_access` tinyint(1) NOT NULL,
  `access_token` varchar(256) NOT NULL,
  `order` bigint(20) DEFAULT NULL,
  `published` tinyint(1) NOT NULL,
  `update_mode` varchar(16) NOT NULL,
  `fb_view_type` varchar(25) NOT NULL,
  `theme` int(11) DEFAULT NULL,
  `masonry_hor_ver` varchar(255) DEFAULT NULL,
  `image_max_columns` int(11) DEFAULT NULL,
  `thumb_width` int(11) DEFAULT NULL,
  `thumb_height` int(11) DEFAULT NULL,
  `thumb_comments` int(11) DEFAULT NULL,
  `thumb_likes` int(11) DEFAULT NULL,
  `thumb_name` int(11) DEFAULT NULL,
  `blog_style_width` int(11) DEFAULT NULL,
  `blog_style_height` varchar(15) DEFAULT NULL,
  `blog_style_view_type` int(11) DEFAULT NULL,
  `blog_style_comments` int(11) DEFAULT NULL,
  `blog_style_likes` int(11) DEFAULT NULL,
  `blog_style_message_desc` int(11) DEFAULT NULL,
  `blog_style_shares` int(11) DEFAULT NULL,
  `blog_style_shares_butt` int(11) DEFAULT NULL,
  `blog_style_facebook` int(11) DEFAULT NULL,
  `blog_style_twitter` int(11) DEFAULT NULL,
  `blog_style_google` int(11) DEFAULT NULL,
  `blog_style_author` int(11) DEFAULT NULL,
  `blog_style_name` int(11) DEFAULT NULL,
  `blog_style_place_name` int(11) DEFAULT NULL,
  `fb_name` int(11) DEFAULT NULL,
  `fb_plugin` int(11) DEFAULT NULL,
  `album_max_columns` int(11) DEFAULT NULL,
  `album_title` varchar(15) DEFAULT NULL,
  `album_thumb_width` int(11) DEFAULT NULL,
  `album_thumb_height` int(11) DEFAULT NULL,
  `album_image_max_columns` int(11) DEFAULT NULL,
  `album_image_thumb_width` int(11) DEFAULT NULL,
  `album_image_thumb_height` int(11) DEFAULT NULL,
  `pagination_type` int(11) DEFAULT NULL,
  `objects_per_page` int(11) DEFAULT NULL,
  `popup_fullscreen` int(11) DEFAULT NULL,
  `popup_width` int(11) NOT NULL,
  `popup_height` int(11) DEFAULT NULL,
  `popup_effect` varchar(255) DEFAULT NULL,
  `popup_autoplay` int(11) DEFAULT NULL,
  `open_commentbox` int(11) DEFAULT NULL,
  `popup_interval` int(11) DEFAULT NULL,
  `popup_enable_filmstrip` int(11) DEFAULT NULL,
  `popup_filmstrip_height` int(11) DEFAULT NULL,
  `popup_comments` int(11) DEFAULT NULL,
  `popup_likes` int(11) DEFAULT NULL,
  `popup_shares` int(11) DEFAULT NULL,
  `popup_author` int(11) DEFAULT NULL,
  `popup_name` int(11) DEFAULT NULL,
  `popup_place_name` int(11) DEFAULT NULL,
  `popup_enable_ctrl_btn` int(11) DEFAULT NULL,
  `popup_enable_fullscreen` int(11) DEFAULT NULL,
  `popup_enable_info_btn` int(11) DEFAULT NULL,
  `popup_message_desc` int(11) DEFAULT NULL,
  `popup_enable_facebook` int(11) DEFAULT NULL,
  `popup_enable_twitter` int(11) DEFAULT NULL,
  `popup_enable_google` int(11) DEFAULT NULL,
  `view_on_fb` tinyint(1) NOT NULL,
  `post_text_length` bigint(20) NOT NULL,
  `event_street` tinyint(1) NOT NULL,
  `event_city` tinyint(1) NOT NULL,
  `event_country` tinyint(1) NOT NULL,
  `event_zip` tinyint(1) NOT NULL,
  `event_map` tinyint(1) NOT NULL,
  `event_date` tinyint(1) NOT NULL,
  `event_desp_length` bigint(20) NOT NULL,
  `comments_replies` tinyint(1) NOT NULL,
  `comments_filter` varchar(32) NOT NULL,
  `comments_order` varchar(32) NOT NULL,
  `page_plugin_pos` varchar(8) NOT NULL,
  `page_plugin_fans` tinyint(1) NOT NULL,
  `page_plugin_cover` tinyint(1) NOT NULL,
  `page_plugin_header` tinyint(1) NOT NULL,
  `page_plugin_width` int(4) NOT NULL,
  `image_onclick_action` varchar(32) NOT NULL,
  `event_order` tinyint(4) NOT NULL,
  `upcoming_events` tinyint(4) NOT NULL,
    PRIMARY KEY (`id`)
  ) DEFAULT CHARSET=utf8;";


    $wpdb->query($wd_fb_info);
    //message-i , description , name encoding --> utf16_bin
    $wd_fb_data = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "wd_fb_data` (
    `id` bigint(20) NOT NULL AUTO_INCREMENT,
    `fb_id` int NOT NULL,
    `from` varchar(32) NOT NULL,
    `object_id` varchar(64) NOT NULL,
    `name` text CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
    `description` mediumtext CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
    `type` varchar(32) NOT NULL,
    `message` mediumtext CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
    `story` mediumtext NOT NULL,
    `place` mediumtext NOT NULL,
    `message_tags` mediumtext NOT NULL,
    `with_tags` mediumtext NOT NULL,
    `story_tags` mediumtext NOT NULL,
    `status_type` mediumtext NOT NULL,
    `link` mediumtext NOT NULL,
    `source` mediumtext NOT NULL,
    `thumb_url` varchar(512) NOT NULL,
    `main_url` varchar(512) NOT NULL,
    `width` varchar(32) NOT NULL,
    `height` varchar(32) NOT NULL,
    `created_time` varchar(64) NOT NULL,
    `updated_time` varchar(64) NOT NULL,
    `created_time_number` bigint(255) NOT NULL,
    PRIMARY KEY (`id`)
  ) DEFAULT CHARSET=utf8;";
    $wpdb->query($wd_fb_data);

    $wd_fb_option = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "wd_fb_option` (
   `id` bigint(20) NOT NULL,
   `autoupdate_interval` int(4) NOT NULL,
   `app_id` varchar(255) NOT NULL,
   `app_secret` varchar(255) NOT NULL,
   `access_token` varchar(255) NOT NULL,
   `date_timezone` varchar(64) NOT NULL,
   `post_date_format` varchar(64) NOT NULL,
   `event_date_format` varchar(64) NOT NULL
   ) DEFAULT CHARSET=utf8;";
    $wpdb->query($wd_fb_option);

    /*$ffwd_settings = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "ffwd_settings` (
    `id` bigint(20) NOT NULL AUTO_INCREMENT,
        `autoupdate_interval` int(4) NOT NULL,
    `app_id` varchar(255) NOT NULL,
    `app_secret` varchar(255) NOT NULL,
    `date_timezone` varchar(64) NOT NULL,
    PRIMARY KEY (`id`)
  ) DEFAULT CHARSET=utf8;";
  $wpdb->query($ffwd_settings);*/

    $wd_fb_theme = "CREATE TABLE IF NOT EXISTS `" . $wpdb->prefix . "wd_fb_theme` (
    `id` bigint(20) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `params` longtext,
    `default_theme` tinyint(1) NOT NULL,
    PRIMARY KEY (`id`)
  ) DEFAULT CHARSET=utf8;";
    $wpdb->query($wd_fb_theme);

    $exists_default = $wpdb->get_var('SELECT count(id) FROM ' . $wpdb->prefix . 'wd_fb_option');
    if (!$exists_default) {
        $save = $wpdb->insert($wpdb->prefix . 'wd_fb_option', array(
            'id' => 1,
            'autoupdate_interval' => 90,
            'app_id' => '',
            'date_timezone' => '',
            'access_token' => '',
            'post_date_format' => 'ago',
            'event_date_format' => 'F j, Y, g:i a',


        ));
    }

    $exists_default = $wpdb->get_var('SELECT count(id) FROM ' . $wpdb->prefix . 'wd_fb_theme');
    if (!$exists_default) {
        $wpdb->insert($wpdb->prefix . 'wd_fb_theme', array(
            'name' => 'Theme 1',
            'default_theme' => 1,
            'params' => '{"thumb_margin":"10","thumb_padding":"2","thumb_border_radius":"2px","thumb_border_width":"1","thumb_border_style":"none","thumb_border_color":"000000","thumb_bg_color":"FFFFFF","thumbs_bg_color":"FFFFFF","thumb_bg_transparent":"100","thumb_box_shadow":"0px 0px 1px #000000","thumb_transparent":"100","thumb_align":"center","thumb_hover_effect":"rotate","thumb_hover_effect_value":"2deg","thumb_transition":"1","thumb_title_font_color":"797979","thumb_title_font_style":"inherit","thumb_title_pos":"bottom","thumb_title_font_size":"14","thumb_title_font_weight":"normal","thumb_title_margin":"10","thumb_title_shadow":"","thumb_like_comm_pos":"bottom","thumb_like_comm_font_size":"14","thumb_like_comm_font_color":"FFFFFF","thumb_like_comm_font_style":"inherit","thumb_like_comm_font_weight":"normal","thumb_like_comm_shadow":"0px 0px 1px #000000","masonry_thumb_padding":"4","masonry_thumb_border_radius":"2px","masonry_thumb_border_width":"1","masonry_thumb_border_style":"solid","masonry_thumb_border_color":"FFFFFF","masonry_thumbs_bg_color":"FFFFFF","masonry_thumb_bg_transparent":"100","masonry_thumb_transparent":"100","masonry_thumb_align":"center","masonry_thumb_hover_effect":"scale","masonry_thumb_hover_effect_value":"1.1","masonry_thumb_transition":"1","masonry_description_font_size":"14","masonry_description_color":"A3A3A3","masonry_description_font_style":"inherit","masonry_like_comm_pos":"bottom","masonry_like_comm_font_size":"14","masonry_like_comm_font_color":"FFFFFF","masonry_like_comm_font_style":"inherit","masonry_like_comm_font_weight":"normal","masonry_like_comm_shadow":"0px 0px 1px #000000","blog_style_align":"left","blog_style_bg_color":"FFFFFF","blog_style_fd_name_bg_color":"000000","blog_style_fd_name_align":"center","blog_style_fd_name_padding":"10","blog_style_fd_name_color":"FFFFFF","blog_style_fd_name_size":"15","blog_style_fd_name_font_weight":"normal","blog_style_fd_icon":"","blog_style_fd_icon_color":"","blog_style_fd_icon_size":"","blog_style_transparent":"100","blog_style_obj_img_align":"center","blog_style_margin":"10","blog_style_box_shadow":"","blog_style_border_width":"1","blog_style_border_style":"solid","blog_style_border_color":"C9C9C9","blog_style_border_type":"top","blog_style_border_radius":"","blog_style_obj_icons_color":"gray","blog_style_obj_date_pos":"after","blog_style_obj_font_family":"inherit","blog_style_obj_info_bg_color":"FFFFFF","blog_style_page_name_color":"000000","blog_style_obj_page_name_size":"13","blog_style_obj_page_name_font_weight":"bold","blog_style_obj_story_color":"000000","blog_style_obj_story_size":"14","blog_style_obj_story_font_weight":"normal","blog_style_obj_place_color":"000000","blog_style_obj_place_size":"13","blog_style_obj_place_font_weight":"normal","blog_style_obj_name_color":"000000","blog_style_obj_name_size":"13","blog_style_obj_name_font_weight":"bold","blog_style_obj_message_color":"000000","blog_style_obj_message_size":"14","blog_style_obj_message_font_weight":"normal","blog_style_obj_hashtags_color":"000000","blog_style_obj_hashtags_size":"12","blog_style_obj_hashtags_font_weight":"normal","blog_style_obj_likes_social_bg_color":"EAEAEA","blog_style_obj_likes_social_color":"656565","blog_style_obj_likes_social_size":"14","blog_style_obj_likes_social_font_weight":"normal","blog_style_obj_comments_bg_color":"FFFFFF","blog_style_obj_comments_color":"000000","blog_style_obj_comments_font_family":"inherit","blog_style_obj_comments_font_size":"14","blog_style_obj_users_font_color":"000000","blog_style_obj_comments_social_font_weight":"normal","blog_style_obj_comment_border_width":"1","blog_style_obj_comment_border_style":"solid","blog_style_obj_comment_border_color":"C9C9C9","blog_style_obj_comment_border_type":"top","blog_style_evt_str_color":"000000","blog_style_evt_str_size":"14","blog_style_evt_str_font_weight":"normal","blog_style_evt_ctzpcn_color":"000000","blog_style_evt_ctzpcn_size":"14","blog_style_evt_ctzpcn_font_weight":"normal","blog_style_evt_map_color":"000000","blog_style_evt_map_size":"14","blog_style_evt_map_font_weight":"normal","blog_style_evt_date_color":"000000","blog_style_evt_date_size":"14","blog_style_evt_date_font_weight":"normal","blog_style_evt_info_font_family":"inherit","album_compact_back_font_color":"000000","album_compact_back_font_style":"inherit","album_compact_back_font_size":"16","album_compact_back_font_weight":"bold","album_compact_back_padding":"0","album_compact_title_font_color":"797979","album_compact_title_font_style":"inherit","album_compact_thumb_title_pos":"bottom","album_compact_title_font_size":"13","album_compact_title_font_weight":"normal","album_compact_title_margin":"2px","album_compact_title_shadow":"0px 0px 0px #888888","album_compact_thumb_margin":"4","album_compact_thumb_padding":"0","album_compact_thumb_border_radius":"0","album_compact_thumb_border_width":"0","album_compact_thumb_border_style":"none","album_compact_thumb_border_color":"CCCCCC","album_compact_thumb_bg_color":"FFFFFF","album_compact_thumbs_bg_color":"FFFFFF","album_compact_thumb_bg_transparent":"0","album_compact_thumb_box_shadow":"0px 0px 0px #888888","album_compact_thumb_transparent":"100","album_compact_thumb_align":"center","album_compact_thumb_hover_effect":"scale","album_compact_thumb_hover_effect_value":"1.1","album_compact_thumb_transition":"0","lightbox_overlay_bg_color":"000000","lightbox_overlay_bg_transparent":"70","lightbox_bg_color":"000000","lightbox_ctrl_btn_pos":"bottom","lightbox_ctrl_btn_align":"center","lightbox_ctrl_btn_height":"20","lightbox_ctrl_btn_margin_top":"10","lightbox_ctrl_btn_margin_left":"7","lightbox_ctrl_btn_transparent":"100","lightbox_ctrl_btn_color":"","lightbox_toggle_btn_height":"14","lightbox_toggle_btn_width":"100","lightbox_ctrl_cont_bg_color":"000000","lightbox_ctrl_cont_transparent":"65","lightbox_ctrl_cont_border_radius":"4","lightbox_close_btn_transparent":"100","lightbox_close_btn_bg_color":"000000","lightbox_close_btn_border_width":"2","lightbox_close_btn_border_radius":"16px","lightbox_close_btn_border_style":"none","lightbox_close_btn_border_color":"FFFFFF","lightbox_close_btn_box_shadow":"0","lightbox_close_btn_color":"","lightbox_close_btn_size":"10","lightbox_close_btn_width":"20","lightbox_close_btn_height":"20","lightbox_close_btn_top":"-10","lightbox_close_btn_right":"-10","lightbox_close_btn_full_color":"","lightbox_rl_btn_bg_color":"000000","lightbox_rl_btn_transparent":"80","lightbox_rl_btn_border_radius":"20px","lightbox_rl_btn_border_width":"0","lightbox_rl_btn_border_style":"none","lightbox_rl_btn_border_color":"FFFFFF","lightbox_rl_btn_box_shadow":"","lightbox_rl_btn_color":"","lightbox_rl_btn_height":"40","lightbox_rl_btn_width":"40","lightbox_rl_btn_size":"20","lightbox_close_rl_btn_hover_color":"","lightbox_obj_pos":"left","lightbox_obj_width":"350","lightbox_obj_icons_color":"gray","lightbox_obj_date_pos":"after","lightbox_obj_font_family":"inherit","lightbox_obj_info_bg_color":"E2E2E2","lightbox_page_name_color":"4B4B4B","lightbox_obj_page_name_size":"14","lightbox_obj_page_name_font_weight":"bold","lightbox_obj_story_color":"4B4B4B","lightbox_obj_story_size":"14","lightbox_obj_story_font_weight":"normal","lightbox_obj_place_color":"000000","lightbox_obj_place_size":"13","lightbox_obj_place_font_weight":"normal","lightbox_obj_name_color":"4B4B4B","lightbox_obj_name_size":"14","lightbox_obj_name_font_weight":"bold","lightbox_obj_message_color":"000000","lightbox_obj_message_size":"14","lightbox_obj_message_font_weight":"normal","lightbox_obj_hashtags_color":"000000","lightbox_obj_hashtags_size":"12","lightbox_obj_hashtags_font_weight":"normal","lightbox_obj_likes_social_bg_color":"878787","lightbox_obj_likes_social_color":"FFFFFF","lightbox_obj_likes_social_size":"14","lightbox_obj_likes_social_font_weight":"normal","lightbox_obj_comments_bg_color":"EAEAEA","lightbox_obj_comments_color":"4A4A4A","lightbox_obj_comments_font_family":"inherit","lightbox_obj_comments_font_size":"14","lightbox_obj_users_font_color":"4B4B4B","lightbox_obj_comments_social_font_weight":"normal","lightbox_obj_comment_border_width":"1","lightbox_obj_comment_border_style":"solid","lightbox_obj_comment_border_color":"C9C9C9","lightbox_obj_comment_border_type":"top","lightbox_filmstrip_pos":"top","lightbox_filmstrip_rl_bg_color":"3B3B3B","lightbox_filmstrip_rl_btn_size":"20","lightbox_filmstrip_rl_btn_color":"","lightbox_filmstrip_thumb_margin":"0 1px","lightbox_filmstrip_thumb_border_width":"1","lightbox_filmstrip_thumb_border_style":"solid","lightbox_filmstrip_thumb_border_color":"000000","lightbox_filmstrip_thumb_border_radius":"0","lightbox_filmstrip_thumb_deactive_transparent":"80","lightbox_filmstrip_thumb_active_border_width":"0","lightbox_filmstrip_thumb_active_border_color":"FFFFFF","lightbox_rl_btn_style":"","lightbox_evt_str_color":"000000","lightbox_evt_str_size":"14","lightbox_evt_str_font_weight":"normal","lightbox_evt_ctzpcn_color":"000000","lightbox_evt_ctzpcn_size":"14","lightbox_evt_ctzpcn_font_weight":"normal","lightbox_evt_map_color":"000000","lightbox_evt_map_size":"14","lightbox_evt_map_font_weight":"normal","lightbox_evt_date_color":"000000","lightbox_evt_date_size":"14","lightbox_evt_date_font_weight":"normal","lightbox_evt_info_font_family":"inherit","page_nav_position":"bottom","page_nav_align":"center","page_nav_number":"0","page_nav_font_size":"12","page_nav_font_style":"inherit","page_nav_font_color":"666666","page_nav_font_weight":"bold","page_nav_border_width":"1","page_nav_border_style":"solid","page_nav_border_color":"E3E3E3","page_nav_border_radius":"0","page_nav_margin":"0","page_nav_padding":"3px 6px","page_nav_button_bg_color":"FFFFFF","page_nav_button_bg_transparent":"100","page_nav_box_shadow":"0","page_nav_button_transition":"1","page_nav_button_text":"0","lightbox_obj_icons_color_likes_comments_count":"white"}',
        ));


    }
    wp_schedule_event(time(), 'wd_fb_autoupdate_interval', 'wd_fb_schedule_event_hook');

    $old_version=ffwd_get_version();

    $new_version = ffwd_version();
    $newer = version_compare($new_version, $old_version, '>');
    if ($newer) {
        require_once WD_FFWD_DIR . '/update/ffwd_update.php';
        /*adds new params for new versions*/
        ffwd_update_diff($new_version, $old_version);


    }


    /*$version = get_option("ffwd_version");
    $new_version = '1.0.0';
    if ($version && version_compare($version, $new_version, '<')) {
      require_once WD_FFWD_DIR . "/update/ffwd_update.php";
      ffwd_update($version);
      update_option("ffwd_version", $new_version);
    }
    else {
      add_option("ffwd_version", $new_version, '', 'no');
    }
    */

}

register_activation_hook(__FILE__, 'ffwd_activate');


/* On deactivation, remove all functions from the scheduled action hook.*/
function ffwd_deactivate()
{
    wp_clear_scheduled_hook('wd_fb_schedule_event_hook');
}

register_deactivation_hook(__FILE__, 'ffwd_deactivate');

function ffwd_update_hook()
{
    /*$version = get_option("ffwd_version");
  $new_version = '1.0.0';
  if ($version && version_compare($version, $new_version, '<')) {
    require_once WD_FFWD_DIR . "/update/ffwd_update.php";
    ffwd_update($version);
    update_option("ffwd_version", $new_version);
  }*/

    return false;
}

if (!isset($_GET['action']) || $_GET['action'] != 'deactivate') {
    add_action('admin_init', 'ffwd_update_hook');
}

// Plugin styles.
function ffwd_styles()
{
    wp_admin_css('thickbox');
    wp_enqueue_style('ffwd_tables', WD_FFWD_URL . '/css/ffwd_tables.css', array(), ffwd_get_version());
}

// Plugin scripts.
function ffwd_scripts()
{
    wp_enqueue_script('thickbox');
    wp_enqueue_script('ffwd_admin', WD_FFWD_URL . '/js/ffwd.js', array(), ffwd_get_version());

    global $wp_scripts;
    if (isset($wp_scripts->registered['jquery'])) {
        $jquery = $wp_scripts->registered['jquery'];
        if (!isset($jquery->ver) OR version_compare($jquery->ver, '1.8.2', '<')) {
            wp_deregister_script('jquery');
            wp_register_script('jquery', FALSE, array('jquery-core', 'jquery-migrate'), '1.10.2');
        }
    }
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-sortable');
}

/* Add pagination to gallery admin pages.*/
function ffwd_add_ffwd_info_per_page_option()
{
    $option = 'per_page';
    $args_galleries = array(
        'label' => 'Items',
        'default' => 20,
        'option' => 'ffwd_info_per_page'
    );
    add_screen_option($option, $args_galleries);
}

function ffwd_add_themes_per_page_option()
{
    $option = 'per_page';
    $args_themes = array(
        'label' => 'Themes',
        'default' => 20,
        'option' => 'ffwd_themes_per_page'
    );
    add_screen_option($option, $args_themes);
}

add_filter('set-screen-option', 'ffwd_set_option_galleries', 10, 3);
add_filter('set-screen-option', 'ffwd_set_option_themes', 10, 3);

function ffwd_set_option_galleries($status, $option, $value)
{
    if ('ffwd_info_per_page' == $option) return $value;
    return $status;
}

function ffwd_set_option_themes($status, $option, $value)
{
    if ('ffwd_themes_per_page' == $option) return $value;
    return $status;
}

function ffwd_admin_scripts()
{
    wp_enqueue_script('thickbox');
    wp_enqueue_script('ffwd_admin', WD_FFWD_URL . '/js/ffwd.js', array(), ffwd_get_version());
    global $wp_scripts;
    if (isset($wp_scripts->registered['jquery'])) {
        $jquery = $wp_scripts->registered['jquery'];
        if (!isset($jquery->ver) OR version_compare($jquery->ver, '1.8.2', '<')) {
            wp_deregister_script('jquery');
            wp_register_script('jquery', FALSE, array('jquery-core', 'jquery-migrate'), '1.10.2');
        }
    }
    wp_enqueue_script('jquery');
    wp_enqueue_script('jscolor', WD_FFWD_URL . '/js/jscolor/jscolor.js', array(), '1.3.9');
    wp_enqueue_style('ffwd_font-awesome', WD_FFWD_URL . '/css/font-awesome/font-awesome.css', array(), '4.4.0');
}

function ffwd_front_end_scripts()
{
    $version = ffwd_get_version();
    global $wp_scripts;
    if (isset($wp_scripts->registered['jquery'])) {
        $jquery = $wp_scripts->registered['jquery'];
        if (!isset($jquery->ver) OR version_compare($jquery->ver, '1.8.2', '<')) {
            wp_deregister_script('jquery');
            wp_register_script('jquery', FALSE, array('jquery-core', 'jquery-migrate'), '1.10.2');
        }
    }
    wp_enqueue_script('jquery');
    wp_enqueue_script('ffwd_frontend', WD_FFWD_FRONT_URL . '/js/ffwd_frontend.js', array(), $version);
    wp_enqueue_style('ffwd_frontend', WD_FFWD_FRONT_URL . '/css/ffwd_frontend.css', array(), $version);
    // Styles/Scripts for popup.
    wp_enqueue_style('ffwd_font-awesome', WD_FFWD_FRONT_URL . '/css/font-awesome/font-awesome.css', array(), '4.4.0');
    wp_enqueue_script('ffwd_jquery_mobile', WD_FFWD_FRONT_URL . '/js/jquery.mobile.js', array(), $version);
    wp_enqueue_script('ffwd_mCustomScrollbar', WD_FFWD_FRONT_URL . '/js/jquery.mCustomScrollbar.concat.min.js', array(), $version);
    wp_enqueue_style('ffwd_mCustomScrollbar', WD_FFWD_FRONT_URL . '/css/jquery.mCustomScrollbar.css', array(), $version);
    wp_enqueue_script('jquery-fullscreen', WD_FFWD_FRONT_URL . '/js/jquery.fullscreen-0.4.1.js', array(), '0.4.1');
    wp_enqueue_script('ffwd_gallery_box', WD_FFWD_FRONT_URL . '/js/ffwd_gallery_box.js', array(), $version);
    wp_localize_script('ffwd_gallery_box', 'ffwd_objectL10n', array(
        'ffwd_field_required' => __('field is required.', 'bwg'),
        'ffwd_mail_validation' => __('This is not a valid email address.', 'bwg'),
        'ffwd_search_result' => __('There are no images matching your search.', 'bwg'),
    ));
}

add_action('wp_enqueue_scripts', 'ffwd_front_end_scripts');

/* Add bwg scheduled event for autoupdatable galleries.*/
add_filter('cron_schedules', 'wd_fb_add_autoupdate_interval');
function wd_fb_add_autoupdate_interval($schedules)
{
    require_once(WD_FFWD_DIR . '/framework/WDFacebookFeed.php');
    $autoupdate_interval = WDFacebookFeed::get_autoupdate_interval();
    // var_dump($autoupdate_interval);
    $schedules['wd_fb_autoupdate_interval'] = array(
        'interval' => 60 * $autoupdate_interval,
        'display' => __('WD Facebook plugin autoupdate interval.')
    );
    return $schedules;
}


add_action('wd_fb_schedule_event_hook', 'wd_fb_update');
// wd_fb_update();
function wd_fb_update()
{
    global $wpdb;
    $query = "SELECT * FROM " . $wpdb->prefix . "wd_fb_info WHERE `update_mode` <> 'no_update'";
    $rows = $wpdb->get_results($query);
    require_once(WD_FFWD_DIR . '/framework/WDFacebookFeed.php');
    WDFacebookFeed::update_from_shedule($rows);
    die;
}

// Facebook feed wd Widget.
if (class_exists('WP_Widget')) {
    require_once(WD_FFWD_DIR . '/admin/controllers/FFWDControllerWidget.php');
    add_action('widgets_init', create_function('', 'return register_widget("FFWDControllerWidget");'));
}

// Languages localization.
function ffwd_language_load()
{
    load_plugin_textdomain('bwg', FALSE, basename(dirname(__FILE__)) . '/languages');
}

add_action('init', 'ffwd_language_load');

function ffwd_version()
{

    $version = '1.0.5';

    if (get_option('ffwd_version') === false) {
        add_option('ffwd_version', $version);
    } else {
        update_option('ffwd_version', $version);


    }


    return $version;

}

function ffwd_get_version()
{
    if(get_option('ffwd_version') === false) {
        ffwd_version();

    }
    return get_option('ffwd_version');


}

if (is_admin() && (!defined('DOING_AJAX') || !DOING_AJAX)) {

    include_once(WD_FFWD_DIR . '/facebook-feed-wd-notices.php');
    new FFWD_Notices();
}


?>
