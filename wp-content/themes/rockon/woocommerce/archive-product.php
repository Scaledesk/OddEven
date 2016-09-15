<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header( 'shop' ); 
extract( rockon_pagemeta() );
	/**
	 * woocommerce_before_main_content hook
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 */
	do_action( 'woocommerce_before_main_content' );
	
	echo "<div class='clearfix'></div><div class='rock_margin_30'></div>";
	echo '<div class="container">';
	
	/**
	 * woocommerce_sidebar hook
	 *
	 * @hooked woocommerce_get_sidebar - 10
	 */
	if($position == 'left'){ 
		do_action( 'woocommerce_sidebar' );
		woo_rockon_sidebar();
	}
	if($position != 'full'){
		echo '<div class="col-lg-8 col-md-8 col-sm-7">';
	}
	
	do_action( 'woocommerce_archive_description' ); 
	
	if ( have_posts() ) : 
		/**
		 * woocommerce_before_shop_loop hook
		 *
		 * @hooked woocommerce_result_count - 20
		 * @hooked woocommerce_catalog_ordering - 30
		 */
		echo '<div class="row">'; 
		do_action( 'woocommerce_before_shop_loop' );
		echo '</div>';
		
		woocommerce_product_loop_start();
		
		woocommerce_product_subcategories();
		
		$i = 0;
		
		while ( have_posts() ) : the_post(); 
			if($i%3 == 0)
				echo '<div class="clearfix"></div>';
			echo '<div class="col-lg-4 col-md-4 col-sm-4 product_wrapper ">';
			wc_get_template_part( 'content', 'product' );
			echo '</div>';
			$i++;
		endwhile; // end of the loop.
		
		woocommerce_product_loop_end(); 
		
		/**
		 * woocommerce_after_shop_loop hook
		 *
		 * @hooked woocommerce_pagination - 10
		 */
		do_action( 'woocommerce_after_shop_loop' );
		
	elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : 
		wc_get_template( 'loop/no-products-found.php' );  
	endif; 
	
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
	get_footer( 'shop' ); ?>