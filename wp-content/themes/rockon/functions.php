<?php
/**
 * Rockon functions and definitions
 *
 * @package Rockon
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}
define('ROCKON_PATH', get_template_directory_uri() );
define('ROCKON_PATH_SERVER_PATH', get_template_directory() );
define('ROCKON_AJAX_URL', admin_url('admin-ajax.php') );
if ( ! function_exists( 'rockon_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function rockon_setup() {
	load_theme_textdomain( 'rockon', get_template_directory() . '/languages' );
	load_theme_textdomain( 'rockon_framework', get_template_directory() . '/admin/languages'  );
	add_theme_support( 'automatic-feed-links' );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'rockon_primary_menu' => esc_html__( 'Main Menu', 'rockon' ),
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );
	if ( function_exists( 'add_theme_support' )){
		add_theme_support('post-thumbnails',array('post','services','portfolio','disc_jockey_team','rockon_event'));
	}
	if ( function_exists( 'add_image_size' ) ) {
		add_image_size('full-size',9999,9999,true);
		add_image_size('rockon-full-size',1140,489,true);
		add_image_size('rockon-common-size',899,454, true);
		add_image_size('rockon-small-size',100,100, true);
		add_image_size('rockon-small-very-size',80,80, true);
		add_image_size('rockon-team-img-size',320,377, true);
		add_image_size('rockon_service',360,461, true);
		add_image_size('rockon_trackposterimg',525,280, true);
		add_image_size('rockon_trackposterthumbimg',100,80, true);
	}
	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'rockon_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_theme_support( 'woocommerce' );
}
endif; // rockon_setup
add_action( 'after_setup_theme', 'rockon_setup' );
/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
if(!function_exists('rockon_widgets_init')){
	function rockon_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'rockon' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		) );
		register_sidebar(array(
			'name' => esc_html__('Footer sidebar','rockon'),
			'id' => 'rockonfooter',
			'description' => 'Widgets in this area will be shown in the footer.',
			'before_widget' => '<div class="col-lg-4 col-md-4 col-sm-4"><aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside></div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
		register_sidebar( array(
			'name'          => esc_html__( 'Woocommerce Sidebar', 'rockon' ),
			'id'            => 'main_woocommerce',
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'rockon_widgets_init' );
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/*
 * Load redux-framework
 */
if (file_exists(dirname(__FILE__).'/admin/framework.php')) {
    require_once( dirname(__FILE__).'/admin/framework.php' );
}
if (file_exists(dirname(__FILE__).'/admin/rockon-config.php')) {
    require_once( dirname(__FILE__).'/admin/rockon-config.php' );
}

/*********=============== Require File ============*****************/
require get_template_directory() . '/theme_plugin/rockon-plugin-activate-config.php';
require get_template_directory() . '/aq_resizer.php';

require get_template_directory() . '/include/rockon-enqueue.php';
require get_template_directory() . '/include/rockon-comment.php';
require get_template_directory() . '/include/rockon_breadcrumb.php';
require_once get_template_directory() . '/include/sent_mail_contactform.php';
require_once get_template_directory() . '/include/section-function.php';
if(class_exists( 'WooCommerce' )){
	require_once get_template_directory() . '/include/woocommerce-modify-function.php';
}
?>
