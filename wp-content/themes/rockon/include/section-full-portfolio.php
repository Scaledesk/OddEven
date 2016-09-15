<?php
global $post;
$image = $attachment_url = $catname = $filetype = $src = $type = $a = $audiopop = '';
global $i;
$terms = get_the_terms( $post->ID, 'portfolio_categories' );
$cats = array();
if(is_array($terms))
{   
	if(count($terms) > 0 )
	{
		foreach ( $terms as $term )
		{
			$cats[] = $term->name;
			$catname = join("  ",$cats);		
			$catname = preg_replace('/\s/',' ', $catname);
		}   
	} 	
} 
echo '<div class="col-md-4 col-sm-6 portfolio-item mix '.esc_attr($catname).'">
      <div class="rock_club_photo_slider_item">
        <div class="rock_club_photo_item">'; 
		if (has_post_thumbnail($post->ID)) {					
			$thumb = get_post_thumbnail_id($post->ID);
			$thumb_w = '360';
			$thumb_h = '273';
			$attachment_url = wp_get_attachment_url($thumb, 'full');
			$image = aq_resize($attachment_url, $thumb_w, $thumb_h, true);							
		}
echo '<img src="'.esc_url($image).'" alt="" />';
$src = get_post_meta( $post->ID, 'rockon_audio_src', true );
if(!empty($src)){
	$filetype = wp_check_filetype($src);
	$type = $filetype['type'];
	if($type == 'audio/mpeg'){
		$a = '<a  class="fancybox" href="#rockongallery_audio'.$i.'">';
		echo $audiopop = '<div class="rock_audio_player" style="display:none;" id="rockongallery_audio'.$i.'">
<div class="rock_audio_player_title"><span class="track_artist">'.esc_html(get_the_title($post->ID)).'</span></div>
<div class="rock_audio_player_track_image"> <img src="'.esc_url($attachment_url).'" alt="track 1" />
 <div class="rock_audio_player_track_image_overlay">'.esc_html(get_the_title($post->ID)).'</div>
</div>
<div class="audio-player">
 <audio class="rock_player" controls><source src="'.esc_url($src).'" type="audio/mpeg" ></audio>
</div>
</div>';
	}else{
		$vi = 'https:'.$src;
		$a = '<a class="fancybox-video iframe" data-fancybox-group="group3" href="'.esc_url($vi).'">';
	}
}else{
	$a = '<a class="fancybox" data-fancybox-group="group1" href="'.esc_url($attachment_url).'">';
}
echo '<div class="rock_club_photo_overlay" >
            <div class="photo_link animated fadeInDown"> '.$a.' <i class="fa fa-search-plus"></i></a> <a class="main_gallery_item_link" href="'.esc_url(get_the_permalink($post->ID)).'"><i class="fa fa-link"></i></a> </div>
            <a class="rock_club_photo_detail animated fadeInUp" href="">'.esc_html(get_the_title($post->ID)).'</a> </div>
        </div>
      </div>
    </div>';
$i++;
?>