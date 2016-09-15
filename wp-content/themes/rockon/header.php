<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Rockon
 */
global $rockon_data;
if (empty($feed_url)) { $feed_url = get_bloginfo('rss2_url'); }
$favicon = '';$auth = '';$keys = '';$desc = '';
if(empty($rockon_data['rockon_faviconurl']['url'])){ 
$favicon = get_template_directory_uri().'/images/favicon.ico'; 
}else{
$favicon = $rockon_data['rockon_faviconurl']['url'];
}	
if(!empty($rockon_data['rockon_authorname'])){ 
$auth = $rockon_data['rockon_authorname']; 
}
if(!empty($rockon_data['rockon_metakeywords'])){ 
$keys = $rockon_data['rockon_metakeywords']; 
}
if(!empty($rockon_data['rockon_metadescription'])){ 
$desc = $rockon_data['rockon_metadescription']; 
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author"  content="<?php echo esc_attr($auth); ?>"/>
<meta name="keywords" content="<?php echo esc_attr($keys); ?>">
<meta name="description" content="<?php echo esc_attr($desc); ?>"/>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
/*
 * include Landing Sites
 */
	get_template_part('include/section-landing'); 
/*
 * include Stylling option frontend
 */
	get_template_part('include/section-slider'); 	
/*
 * include slider
 */
	get_template_part('include/section-colorpicker'); 	
/*
 *	include header nav menu
 */
	get_template_part('include/section-nav'); 
/*
 *	include Audio Player
 */
	 
	get_template_part('include/seaction-audio-player');
?>