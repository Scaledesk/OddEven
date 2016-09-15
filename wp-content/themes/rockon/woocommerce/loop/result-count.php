<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wp_query;

if ( ! woocommerce_products_will_display() )
	return;
?>
<div class="col-lg-6 col-md-6 col-sm-6">
	<ul class="unstyled">
		<li id="goGrid" class="btooltip active" data-toggle="tooltip" data-placement="top" title="" data-original-title="Grid">
		<i class="fa fa-th-large"></i>
		</li>
		<li id="goList" class="btooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="List">
		<i class="fa fa-th-list"></i>
		</li>
	</ul>
</div>
<div class="col-lg-3 col-md-3 col-sm-3">
<p class="woocommerce-result-count">
	<?php
	$paged    = max( 1, $wp_query->get( 'paged' ) );
	$per_page = $wp_query->get( 'posts_per_page' );
	$total    = $wp_query->found_posts;
	$first    = ( $per_page * $paged ) - $per_page + 1;
	$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

	if ( 1 == $total ) {
		_e( 'Showing the single result', 'woocommerce' );
	} elseif ( $total <= $per_page || -1 == $per_page ) {
		printf( __( 'Showing all %d results', 'woocommerce' ), $total );
	} else {
		printf( _x( 'Showing %1$d&ndash;%2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total', 'woocommerce' ), $first, $last, $total );
	}
	?>
</p>
</div>