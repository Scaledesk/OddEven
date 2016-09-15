<div class="rock_slider_div">
<?php
global $rockon_data;
if(is_page_template('page-home.php') || is_page_template('page-home-revolution.php')){
	if(isset($rockon_data['rockon_sliderswitch']) && $rockon_data['rockon_sliderswitch']){
		switch(basename( get_page_template() )){
			case 'page-home.php':
				themeslider();
			break;
			case 'page-home-revolution.php':
				revolutionslider();
			break;
			default:
				themeslider();
		}		
	}
}
function themeslider(){
	$gallery = '';
	$slides = '';
	$cls = '';
	$slidelogo = '';
	global $rockon_data;
	if(isset($rockon_data['rockon_slidergallery']))
			{	$gallery = $rockon_data['rockon_slidergallery']; }
			if(isset($rockon_data['rockon_sliderslides']))
			{	$slides = $rockon_data['rockon_sliderslides']; }
			if(isset($rockon_data['rockon_sliderlogo']['url']))
			{	$slidelogo = $rockon_data['rockon_sliderlogo']['url']; }
			$gallery = explode(',',$gallery);
			echo '<!--slider start-->
	
	  <div class="main">
		<div id="ri-grid" class="ri-grid ri-grid-size-3">
		  <ul>';
		  $cnt = count($gallery);
			for($i=0,$j=1;$i<$cnt;$i++,$j++){
				echo '<li><a href="#"><img src="'.esc_url(wp_get_attachment_url( $gallery[$i] )).'" alt="" /></a></li>';
				if($i == (count($gallery)-1)){
					if($j<=32){
						$cnt = 33 - count($gallery);
						$i = 0;
						echo '<li><a href="#"><img src="'.esc_url(wp_get_attachment_url( $gallery[$i] )).'" alt="" /></a></li>';
					}else{
						break;
					}
				}
			}
		  echo '</ul>
		</div>
	  </div>
	  <div class="rock_slider">
		<div id="carousel" class="carousel slide carousel-fade">
		  <ol class="carousel-indicators">';
			 for($i=0;$i<count($slides);$i++){
				if($i == 0){
					$cls = 'active';
				}
				echo '<li data-target="#carousel" data-slide-to="'.esc_attr($i).'" class="'.esc_attr($cls).'"></li>';
				$cls = '';
			}
		  echo '</ol>
		  <div class="carousel-inner">';
		for($i=0;$i<count($slides);$i++){
				if($i == 0){
					$cls = 'active';
				} 
			echo '<div class="'.esc_attr($cls).' item"> 
				<img class="animated bounceInLeft" src="'.esc_url($slides[$i]['image']).'" alt="" />
			  <div class="carousel-caption">
				<div class="rock_logo_slider"> <a href="'.esc_url(site_url()).'"><img class="animated bounceIn" src="'.esc_url($slidelogo).'" alt="" /></a> </div>
				<div class="rock_slider_content">';
			if(!empty($slides[$i]['title'])){
				echo '<a href="'.esc_url($slides[$i]['url']).'" class="btn btn-default btn-lg rock_slider_btn animated fadeInDown">'.esc_html($slides[$i]['title']).'</a>';
			}
			echo '<p class="animated fadeInDown">'.esc_html($slides[$i]['description']).'</p>
				</div>
			  </div>
			</div>';
			$cls = '';
		}
		  echo '</div>
		</div>
	  </div>
	
	<!--slider end-->';
}
function revolutionslider(){ 
	global $rockon_data;
	$revslidersrtcode=$rockon_data['shortcode_Revolution'];
	echo do_shortcode($revslidersrtcode);
}
?>