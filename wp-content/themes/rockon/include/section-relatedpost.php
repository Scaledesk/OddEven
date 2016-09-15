<?php 
global $post; 
$image = $audiosrc = $fancyaudio = '';
$type = get_post_type($post->ID);
$taxonomy_names = get_object_taxonomies($type);
$categories=array();
if(isset($taxonomy_names[0]))
$categories = get_the_terms($post->ID,$taxonomy_names[0]);
$category_in=array();

if(is_array($categories) && !empty($categories))
{
foreach($categories as $category) {      
  $category_in[]=$category->term_id;
	}
if($type == 'post'){
	$noofpost = get_post_meta($post->ID, 'rockon_post_relatedpost', true);
	$val = $noofpost;
}else{
	$noofpost = get_post_meta($post->ID, 'rockon_portfolio_relatedpost', true);
	$val = $noofpost;
}
	$args=array(
	 'post_type' => $type,
	 'post__not_in' => array($post->ID),
	 'posts_per_page' => $val,
	  'tax_query' => array(
        array( 
        'taxonomy' => $taxonomy_names[0],
       'terms' => $category_in)
		)
    );
$myposts = get_posts($args);
echo '<div class="rock_heading_div">
			<div class="rock_heading">
			  <h1>'.esc_html__('Related','rockon').' '.esc_html($type).'</h1>
			  <p>X</p>
			</div>
		</div>
		<div class="rock_related_post_wrapper">
			<div class="row">';
if ($myposts){  
$i = $j = 0;
	foreach ($myposts as $postrl ) : setup_postdata( $postrl ); 
		if($i == $j){ echo '<div class="clearfix"></div>'; $j = $j + 3; }
		echo '<div class="col-lg-4">
					<div class="rock_club_photo_slider_item">
						<div class="rock_club_photo_item">';
		if (has_post_thumbnail($postrl->ID)) {					
			$thumb = get_post_thumbnail_id($postrl->ID);
			$thumb_w = '300';
			$thumb_h = '270';
			$attachment_url = wp_get_attachment_url($thumb, 'full');
			$image = aq_resize($attachment_url, $thumb_w, $thumb_h, true);	
		}
		if(empty($image)){
			echo '<img src="'.ROCKON_PATH.'/images/no_image.jpg" alt="" />';
			$a = '<a class="fancybox" data-fancybox-group="group3" href="'.ROCKON_PATH.'/images/no_image.jpg">';	
		}else{
			echo '<img src="'.esc_url($image).'" alt="" />';
			$a = '<a class="fancybox" data-fancybox-group="group3" href="'.esc_url($attachment_url).'">';
		}
		$audiosrc = get_post_meta( $postrl->ID, 'rockon_audio_src', true );
		if(!empty($audiosrc)){
			$filetype = wp_check_filetype($audiosrc);
			$type = $filetype['type'];
			if($type == 'audio/mpeg'){
				$thumb_w = '525';
				$thumb_h = '280';
				$thumb = get_post_thumbnail_id($postrl->ID);
				$attachment_url = wp_get_attachment_url($thumb, 'full');
				$src = aq_resize($attachment_url, $thumb_w, $thumb_h, true);
				$a = '<a class="fancybox" href="#rockongallery_audio'.$i.'">';
					$fancyaudio = '<div class="rock_audio_player" style="display:none;" id="rockongallery_audio'.$i.'">
<div class="rock_audio_player_title"><span class="track_artist">'.esc_html(get_the_title($postrl->ID)).'</span></div>
<div class="rock_audio_player_track_image"> <img src="'.esc_url($src).'" alt="track 1" />
  <div class="rock_audio_player_track_image_overlay">'.esc_html(get_the_title($postrl->ID)).'</div>
</div>
<div class="audio-player">
  <audio class="rock_portfolio_player" controls><source src="'.esc_url($audiosrc).'" type="audio/mpeg"></audio>
</div>
</div>';
			}else{
				if(function_exists('rockoncore_parseVideoURL')) $url = rockoncore_parseVideoURL($audiosrc); else $url ='';
				$a = '<a class="fancybox-video iframe" data-fancybox-group="group3" href="'.esc_url($url).'">';
			}
		}
		echo '<div class="rock_club_photo_overlay" style="display: none;">
							<div class="photo_link animated fadeInDown"> '.$a.' <i class="fa fa-search-plus"></i></a> <a class="main_gallery_item_link"  href="'.esc_url(get_the_permalink($postrl->ID)).'"><i class="fa fa-link"></i></a> </div>
							<a class="rock_club_photo_detail animated fadeInUp" href="'.esc_url(get_the_permalink($postrl->ID)).'">'.esc_html(get_the_title($postrl->ID)).'</a> </div>';
		echo $fancyaudio;
		$fancyaudio = '';
		echo '</div>
					</div>
				</div>';
		$i++;
		$image='';
	endforeach; 
}
else{
	echo '<div class="span4 hs_post_related wow fadeInDown"> <p>'.esc_html__('No Realted Post Found.','rockon').'</p></div>';
}
echo '</div>
		</div>';
}//is _array  
wp_reset_postdata();
?>