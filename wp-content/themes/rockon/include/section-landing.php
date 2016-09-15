<?php
global $rockon_data;
if(isset($rockon_data['rockon_landingimgswitch']) && $rockon_data['rockon_landingimgswitch']){
if(isset($rockon_data['rockon_landingimgurl']['url'])){
$images = $rockon_data['rockon_landingimgurl']['url'];
}else{
$images = ROCKON_PATH.'/images/madbars.gif';
}

	if(is_home() || is_front_page() || $rockon_data['rockon_loadin_img']){
?>
	<!--Pre loader start-->
	<div id="preloader">
	  <div id="status"><img src="<?php echo esc_url($images); ?>" id="preloader_image" width="36" height="36" alt="loading image"/></div>
	</div>
	<!--pre loader end--> 
<?php 
	}
} ?>