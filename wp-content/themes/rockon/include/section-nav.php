<?php
global $rockon_data;
$sitelogo = $revcls = ''; 
if(isset($rockon_data['rockon_weblogo']['url']) && !empty($rockon_data['rockon_weblogo']['url'])){
	$sitelogo = $rockon_data['rockon_weblogo']['url'];
}else{
	$sitelogo = ROCKON_PATH.'/images/Logo1.png';
}
if(!isset($_REQUEST['post_type'])){
	if(is_home() || is_front_page()){
		if(isset($rockon_data['rockon_sliderswitch']) && $rockon_data['rockon_sliderswitch']){
			$id = 'rock_header';
		}else{
			$id = 'rock_header_otherpage';
		}
	}else{
		$id = 'rock_header_otherpage';
	}
}else{
	$id = 'rock_header_otherpage';
}
if(!is_category()){
	if(is_page_template('page-home-revolution.php')){
		$revcls = 'rockon_menu_revols_head';
	}
}
?>
<!--header start-->
<header id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($revcls); ?>">
  <div class="container">
    <div class="row">
		<div class="col-lg-3 col-md-3 col-sm-12">
          <div class="rock_logo"> <a href="<?php echo esc_url(home_url()); ?>"><img src="<?php echo esc_url($sitelogo); ?>" alt="logo"  /></a> </div>
		  <div class="rock_menu_toggle"><i class="fa fa-bars"></i></div>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12">
          <div class="rock_menu">
		   <div class="menu_close"><i class="fa fa-long-arrow-left"></i></div>	
		   <?php wp_nav_menu( array('menu_id'=> 'bs-example-navbar-collapse-1','menu_class' => 'collapse navbar-collapse', 'theme_location' => 'rockon_primary_menu', 'depth' => 3 )); ?>
		   
		   <?php 
			if(isset($rockon_data['woo_rockon_cart']) && $rockon_data['woo_rockon_cart']){
				if ( class_exists( 'WooCommerce' ) ) {
					$cart_view = rockon_header_add_to_cart_fragment( $fragments );
					echo $cart_view['a.cart-contents'];
				} 
			} ?>
		   
          </div>
        </div>
	</div>
  </div>
</header>
</div><!--rock_slider_div close div--> 

<!--header end--> 