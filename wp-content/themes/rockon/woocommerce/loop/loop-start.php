<?php 
global $rockon_data;
$woo_cls = '';
if(isset($rockon_data['woo_rockon_sidebarposition']) && $rockon_data['woo_rockon_sidebarposition'] != 'full'){
	$woo_cls = ' rock_shop_wrapper_sidebar';
}
?>
<div class="rock_shop_wrapper <?php echo $woo_cls; ?>">
<div class="row">