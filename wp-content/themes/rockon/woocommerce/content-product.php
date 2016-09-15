<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
$classes[] = 'products';
$img_src = '';
if ( has_post_thumbnail() ) {
	$img_src = wp_get_attachment_url( get_post_thumbnail_id() );	
}
?>
    <div <?php post_class( $classes ); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	<div class="product-image">
		<div class="image"> 
			<a href="<?php the_permalink(); ?>">

				<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
				?>

			</a>
			<div class="image_overlay">
				<div class="photo_link animated fadeInDown"> 
				<a class="fancybox" data-fancybox-group="productgallery<?php echo $product->id; ?>" href="<?php echo esc_url($img_src); ?>"><i class="fa fa-search-plus"></i></a></div>
			</div>
		<div class="woo_product_gallery">
			<?php 
				$attachment_ids = $product->get_gallery_attachment_ids();
				$loop = 0; 
				$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
				if ( $attachment_ids ) {
					foreach ( $attachment_ids as $attachment_id ) {

						$image_link = wp_get_attachment_url( $attachment_id );

						if ( ! $image_link )
							continue;
						$image_class = esc_attr( implode( ' ', array('fancybox') ) );

						echo sprintf( '<a href="%s" class="%s" data-fancybox-group="productgallery%s"></a>', $image_link, $image_class,  $product->id );

						$loop++;
					}
				}
			?>	
		</div>
		</div>
	</div>
	
	<div class="product-info">
	<h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<div class="product-price"> 
	<?php
		/**
		 * woocommerce_after_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
	?>
	
	</div>
	<!-- /.product-price --> 
	<p class="rockon_product_shop_content"><?php echo get_excerpt(400); ?></p>
	</div>
	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

	</div>