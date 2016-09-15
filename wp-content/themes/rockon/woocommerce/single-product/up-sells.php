<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="upsells upsells_products">

		<h2><?php _e( 'You may also like&hellip;', 'woocommerce' ) ?></h2>

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
