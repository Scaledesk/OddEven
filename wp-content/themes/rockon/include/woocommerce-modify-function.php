<?php
/*
 * Hook in on activation
 * Define image sizes
 */
add_action( 'init', 'woo_rockon_image_dimensions', 1 );
function woo_rockon_image_dimensions() {
  	$catalog = array(
		'width' 	=> '500',	// px
		'height'	=> '500',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '600',	// px
		'height'	=> '600',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '120',	// px
		'height'	=> '120',	// px
		'crop'		=> 0 		// false
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

/*********************===== woocommerce_breadcrumb =====*********************/
if(!function_exists('woo_rockon_the_breadcrumb')){
	function woo_rockon_the_breadcrumb(){
		echo '<!-- Breadcrumb-Start -->
		<div class="container">
		<div class="rock_heading_div">
		<div class="rock_heading">
		<h1>';
		if(is_product()){
			the_title();
		}else{
			woocommerce_page_title();
		}
		echo '</h1>
		<p>X</p>
		</div>
		</div>
		<div class="rock_pager">
		';	
		$args = array(
            'delimiter'   => '',
            'wrap_before' => '<ul class="hs_breadcrumb">',
            'wrap_after'  => '</ul>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
		woocommerce_breadcrumb($args);
		echo '</div>
		</div>';
	}
}
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
add_action('woocommerce_before_main_content','woo_rockon_pagetitle', 20 );
if(!function_exists('woo_rockon_pagetitle')){
	function woo_rockon_pagetitle(){
		get_template_part('include/section-pagetitle');
	}
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/*********************===== woocommerce_sidebar =====*********************/
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10); 
function woo_rockon_sidebar(){
	echo '<div class="col-lg-4 col-md-4 col-sm-5 blogcategory_small_part">
	<div class="col-lg-12 col-md-12 col-sm-12 rockon_sidebar_wrapper">';
	echo '<div id="secondary" class="widget-area" role="complementary">';
	dynamic_sidebar( 'main_woocommerce' );
	echo '</div><!-- #secondary -->';
	echo '</div></div>';
}

/*********==== Woocommerce Sidebar Position ====*****************/
function woo_rockon_sidebar_position(){
	global $rockon_data; 
	$position = $rockon_data['woo_rockon_sidebarposition'];
	if(empty($position)){
		$position = 'right';
	}
	return $position;
}

/*********==== woocommerce stylesheet responsive ====*****************/
add_filter( 'woocommerce_enqueue_styles', 'rockon_woocommerce_styles' );
function rockon_woocommerce_styles($styles){
	unset( $enqueue_styles['woocommerce-general'] );
	unset($styles['woocommerce-layout']);
	unset($styles['woocommerce-smallscreen']);
	return $styles;
}
?>