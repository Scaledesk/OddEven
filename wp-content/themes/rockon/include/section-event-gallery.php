<?php 
if(get_post_type($post->ID)=='rockon_event'){
	global $post;
	$img_src = get_post_meta( $post->ID, 'rockon_event_album', true );
	$e_head = get_post_meta( $post->ID, 'rockon_event_Hevent_gallry', true );
	if(!empty($e_head)){
		echo '<div class="rock_heading_div">
			<div class="rock_heading">
			  <h1>'.esc_html($e_head).'</h1>
			  <p>X</p>
			</div>
		</div>';
	}
	if(!empty($img_src)){ 
		echo '<div class="rock_event_gallery">';
		$arr = explode(',',$img_src);
		for($i=0;$i<count($arr);$i++){
			$thumb_w = '237';
			$thumb_h = '158';
			$image = aq_resize($arr[$i], $thumb_w, $thumb_h, true);	
			echo '<div class="col-lg-4 col-md-4 col-sm-4 main_gallery_item">
			<div class="rock_club_photo_slider_item">
				<div class="rock_club_photo_item"><img src="'.esc_url($image).'" alt=""><div class="rock_club_photo_overlay" style="display: none;">
				  <div class="photo_link animated">
					  <a class="fancybox" data-fancybox-group="group1" href="'.esc_url($arr[$i]).'"> <i class="fa fa-search-plus"></i></a> 
				  </div>
				   </div>
				</div>
				</div>
			</div>';	
		}
		echo '</div>';
	} 
}
?>