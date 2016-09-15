<?php
/*
 * Enqueue scripts and styles.
 */
function rockon_scripts() {	
	global $rockon_data;
	
	wp_enqueue_script('jquery_ImageGrid_modernizr', ROCKON_PATH . '/js/plugin/ImageGrid/js/modernizr.custom.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('jquery_ImageGrid_gridrotator', ROCKON_PATH . '/js/plugin/ImageGrid/js/jquery.gridrotator.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('jquery_owl_carousel', ROCKON_PATH . '/js/plugin/owl-carousel/owl.carousel.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('jquery_bootstrap', ROCKON_PATH . '/js/bootstrap.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('jquery_bootstrap_select',  ROCKON_PATH . '/js/bootstrap-select.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('jquery_player_mediaelement', ROCKON_PATH . '/js/plugin/player/js/mediaelement-and-player.min.js', array('jquery'), '1.0.0', true);
	
	if ( is_single()) {
		wp_enqueue_script('mediaplayerlib', ROCKON_PATH . '/js/plugin/player/js/mediaplayerlib.js', array('jquery'), '1.0.0', false);
	}
	
	wp_enqueue_script('jquery_easing', ROCKON_PATH . '/js/plugin/easing/jquery.easing.1.3.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('jquery_bxslider',  ROCKON_PATH . '/js/plugin/bxslider/jquery.bxslider.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('jquery_fancybox',  ROCKON_PATH . '/js/plugin/fancybox/jquery.fancybox.js', array('jquery'), '1.0.0',true);
	wp_enqueue_script('jquery_mixitup', ROCKON_PATH . '/js/plugin/mixitup/jquery.mixitup.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('jquery_smoothscroll', ROCKON_PATH . '/js/plugin/smoothscroll/smoothscroll.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script('jquery_single', ROCKON_PATH . '/js/plugin/single-page/single-0.1.0.js', array('jquery'), null, true);
	wp_enqueue_script('jquery_perfect_scrollbar', ROCKON_PATH . '/js/perfect-scrollbar.js', array('jquery'),null,true);
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_enqueue_script('jquery_datetimepicker', ROCKON_PATH . '/js/plugin/datetime/jquery.datetimepicker.js', array('jquery'), null, true);
	wp_enqueue_script('mapjuery','http://maps.googleapis.com/maps/api/js?sensor=false', array('jquery'));
	
	if(isset($rockon_data['rockon_cssversion']) && $rockon_data['rockon_cssversion'] == 'nightclub'){
		wp_enqueue_script('jquery_custom_nightclub', ROCKON_PATH . '/js/custom_nightclub.js', array('jquery'),null,true);
		wp_localize_script('jquery_custom_nightclub', 'ajax_custom', array(
		   'ajaxurl' => admin_url('admin-ajax.php')
		));
	}else{
		wp_register_script('jquery.cookie', ROCKON_PATH . '/js/jquery.cookie.js',array(),null,true);
		wp_enqueue_script('jquery_custom', ROCKON_PATH . '/js/custom.js', array('jquery','jquery.cookie'),null,true);
		wp_localize_script('jquery_custom', 'ajax_custom', array(
		   'ajaxurl' => admin_url('admin-ajax.php')
		));
	}	
	
	wp_enqueue_script('rockon_validation', ROCKON_PATH . '/js/validation.js', array('jquery'),null,true);
}
add_action( 'wp_enqueue_scripts', 'rockon_scripts' );
function rockon_styles() {
	wp_enqueue_style('bootstrap', ROCKON_PATH . '/css/bootstrap.css', array(), '1', 'all');	
	wp_enqueue_style('b_slect', ROCKON_PATH . '/css/bootstrap-select.css', array(), '1', 'all');
	wp_enqueue_style('defaultbasic', get_stylesheet_uri(), array(), '1', 'all');
	global $rockon_data;
	if(isset($rockon_data['rockon_cssversion'])){
		wp_enqueue_style('rockon_basic', ROCKON_PATH . '/css/style.css', array(), '1', 'all');
		wp_enqueue_style('rockon_woo_layout', ROCKON_PATH . '/css/woocommerce-layout.css', array(), '1', 'all');
		if($rockon_data['rockon_cssversion'] == 'dark'){
			
			if(isset($rockon_data['rockon_style_switcher_color'])){
				$color = $rockon_data['rockon_style_switcher_color'];
				if($color != 'style' && $color != 'style_light_version'){
					wp_register_style('basic_color', ROCKON_PATH . '/css/color/'.$color.'.css', array(), '1', 'all');
					wp_enqueue_style('basic_color');
				}else{
					wp_register_style('basic_color', ROCKON_PATH . '/css/color/demo.css', array(), '1', 'all');
				wp_enqueue_style('basic_color');
				}
			}else{
				wp_register_style('basic_color', ROCKON_PATH . '/css/color/demo.css', array(), '1', 'all');
				wp_enqueue_style('basic_color');
			}
			if(isset($rockon_data['rockon_style_switcher_background'])){
				$pattern = $rockon_data['rockon_style_switcher_background'];
				wp_register_style('basic_patern', ROCKON_PATH . '/css/pattern/'.$pattern.'.css', array(), '1', 'all');
				wp_enqueue_style('basic_patern');	
			}else{
				wp_register_style('basic_patern', ROCKON_PATH . '/css/pattern/demo.css', array(), '1', 'all');
				wp_enqueue_style('basic_patern');
			}
		}elseif($rockon_data['rockon_cssversion'] == 'nightclub'){
			wp_register_style('nightclub', ROCKON_PATH . '/css/nightclub.css', array(), '1', 'all'); 		
			wp_enqueue_style('nightclub');
		}else{	
			wp_enqueue_style('style_light', ROCKON_PATH . '/css/style_light_version.css', array(), '1', 'all');
			wp_enqueue_style('style_light_woo_layout', ROCKON_PATH . '/css/woocommerce-layout-light.css', array(), '1', 'all');
			if(isset($rockon_data['rockon_style_switcher_color_l'])){
				$color = $rockon_data['rockon_style_switcher_color_l'];
				if($color != 'style' && $color != 'style_light_version'){
					wp_register_style('basic_color', ROCKON_PATH . '/css/color/'.$color.'.css', array(), '1', 'all');
					wp_enqueue_style('basic_color');
				}else{
					wp_register_style('basic_color', ROCKON_PATH . '/css/color/demo.css', array(), '1', 'all');
				wp_enqueue_style('basic_color');
				}
			}else{
				wp_register_style('basic_color', ROCKON_PATH . '/css/color/demo.css', array(), '1', 'all');
				wp_enqueue_style('basic_color');
			}
			if(isset($rockon_data['rockon_style_switcher_background_l'])){
				$pattern = $rockon_data['rockon_style_switcher_background_l'];
				wp_register_style('basic_patern', ROCKON_PATH . '/css/pattern/'.$pattern.'.css', array(), '1', 'all');
				wp_enqueue_style('basic_patern');	
			}else{
				wp_register_style('basic_patern', ROCKON_PATH . '/css/pattern/demo.css', array(), '1', 'all');
				wp_enqueue_style('basic_patern');
			}	
		}
	}
	if(isset($rockon_data['rockon_style_switcher_color']) && 
	isset($rockon_data['rockon_style_switcher_background']) &&
	isset($rockon_data['rockon_style_switcher_color_l']) &&
	isset($rockon_data['rockon_style_switcher_background_l']) &&
	$rockon_data['rockon_style_switcher_color'] == 'style' &&
	$rockon_data['rockon_style_switcher_background'] == 'demo' &&
	$rockon_data['rockon_style_switcher_color_l'] == 'style_light_version' &&
	$rockon_data['rockon_style_switcher_background_l'] == 'demo' &&
	!empty($rockon_data['rockon_ownthemecolor'])
	){
		//read the entire string
		$str=file_get_contents(ROCKON_PATH_SERVER_PATH.'/css/color/dark_color1.css');

		//replace something in the file string - this is a VERY simple example
		$str=str_replace('#B268F4', $rockon_data['rockon_ownthemecolor'],$str);
		$str=str_replace('#8906FF', $rockon_data['rockon_ownthemecolor'],$str);

		//write the entire string
		file_put_contents(ROCKON_PATH_SERVER_PATH.'/css/color/other_color.css', $str);
		wp_register_style('basic_color_rs', ROCKON_PATH . '/css/color/other_color.css', array(), '1', 'all');
		wp_enqueue_style('basic_color_rs');
	}
	
	wp_enqueue_style('fontawsm', ROCKON_PATH . '/css/font-awesome.css', array(), '1', 'all');
	wp_enqueue_style('animate', ROCKON_PATH . '/css/animate.min.css', array(), '1', 'all');
	wp_enqueue_style('ImageGrid', ROCKON_PATH . '/js/plugin/ImageGrid/css/style.css', array(), '1', 'all');
	wp_enqueue_style('carousel', ROCKON_PATH . '/js/plugin/owl-carousel/owl.carousel.css', array(), '1', 'all');
	wp_enqueue_style('carousel_theme', ROCKON_PATH . '/js/plugin/owl-carousel/owl.theme.css', array(), '1', 'all');
	wp_enqueue_style('carousel_transitions', ROCKON_PATH . '/js/plugin/owl-carousel/owl.transitions.css', array(), '1', 'all');
	wp_enqueue_style('bxslider', ROCKON_PATH . '/js/plugin/bxslider/jquery.bxslider.css', array(), '1', 'all');
	wp_enqueue_style('fancybox', ROCKON_PATH . '/js/plugin/fancybox/jquery.fancybox.css', array(), '1', 'all');
	wp_enqueue_style('datetimepicker', ROCKON_PATH . '/js/plugin/datetime/jquery.datetimepicker.css', array(), '1', 'all');
	wp_enqueue_style('perfect_scrollbar', ROCKON_PATH . '/css/perfect-scrollbar.css', array(), '1', 'all');
	wp_enqueue_style('mediaelementplayer', ROCKON_PATH . '/js/plugin/video/mediaelementplayer.css', array(), '1', 'all');
	wp_enqueue_style('responsive', ROCKON_PATH . '/css/responsive.css', array(), '1', 'all');
}
add_action( 'wp_enqueue_scripts', 'rockon_styles' ); 
?>