<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop, $rockon_data;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

if(isset($rockon_data['woo_rockon_relatedproduct']) && !$rockon_data['woo_rockon_relatedproduct']){
	return;
}
$posts_per_page = $rockon_data['woo_rockon_no_relatedproduct'];

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="related related_products">

		<h2><?php _e( 'Related Products', 'woocommerce' ); ?></h2>

		<?php woocommerce_product_loop_start(); ?>
		
			<div class="related_product_slider owl-carousel owl-theme">
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
				<div class="col-lg-12">
				<div class="product_wrapper">
				<?php wc_get_template_part( 'content', 'product' ); ?>
				</div>
				</div>
			<?php endwhile; // end of the loop. ?>
			</div>
			<div class="customNavigation"> <a class="rock_slider_button prev"><i class="fa fa-angle-left"></i></a> <a class="rock_slider_button next"><i class="fa fa-angle-right"></i></a> </div>
		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
