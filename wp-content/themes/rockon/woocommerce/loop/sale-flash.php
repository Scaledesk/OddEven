<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<?php if ( $product->is_on_sale() ) : ?>

	<?php echo apply_filters( 'woocommerce_sale_flash', '<div class="tag new"><span>' . __( 'Sale', 'woocommerce' ) . '</span></div>', $post, $product ); ?>

<?php endif; ?>