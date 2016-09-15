<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); 
$position = woo_rockon_sidebar_position();

	/**
	* woocommerce_before_main_content hook
	*
	* @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	* @hooked woocommerce_breadcrumb - 20
	*/
	do_action( 'woocommerce_before_main_content' );
	
	echo "<div class='clearfix'></div><div class='rock_margin_30'></div>";
	echo '<div class="container">';
	
	if($position == 'left'){ 
		do_action( 'woocommerce_sidebar' );
		woo_rockon_sidebar();
	}
	if($position != 'full'){
		echo '<div class="col-lg-8 col-md-8 col-sm-7">';
	}
	
	while ( have_posts() ) : the_post(); 
	wc_get_template_part( 'content', 'single-product' ); 
	endwhile; // end of the loop. 
	
	if($position != 'full'){
		echo '</div>';
	}
	/**
	* woocommerce_sidebar hook
	*
	* @hooked woocommerce_get_sidebar - 10
	*/
	if($position == 'right'){ 
		do_action( 'woocommerce_sidebar' );
		woo_rockon_sidebar();
	}
	
	/**
	* woocommerce_after_main_content hook
	*
	* @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	*/
	do_action( 'woocommerce_after_main_content' );
	
	echo '</div>';
get_footer( 'shop' ); 
?>