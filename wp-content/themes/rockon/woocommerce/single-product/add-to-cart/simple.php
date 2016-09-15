<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

if ( ! $product->is_purchasable() ) return;
?>

<?php
	// Availability
	$availability      = $product->get_availability();
	$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';
	
	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" method="post" enctype='multipart/form-data'>
	 	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
<div class="number">
	<span class="minus">-</span>
	 	<?php
	 		if ( ! $product->is_sold_individually() )
	 			woocommerce_quantity_input( array(
	 				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
	 				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
	 			) ); 
	 	?>
	<span class="plus">+</span>
</div>
	 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

	 	<button type="submit" class="single_add_to_cart_button btn btn-arrow btn-4a icon-arrow-right" data="<?php echo esc_attr( $product->id ); ?>"><?php echo $product->single_add_to_cart_text(); ?></button> 
		<?php
			if(isset($_POST['add-to-cart'])){
				global $woocommerce;
				$cart_url = $woocommerce->cart->get_cart_url();
				echo '<a class="btn btn-arrow btn-4a icon-arrow-right" href="'.esc_url($cart_url).'">'.__('View Cart','rockon').'</a>';
			}
		?>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form> 

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
<?php
global $rockon_data;
if(isset($rockon_data['rockon_woo_product']) && $rockon_data['rockon_woo_product']){
	get_template_part('include/section-social-share'); 
}
?>