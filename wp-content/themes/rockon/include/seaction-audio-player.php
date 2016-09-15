<?php
global $rockon_data;
if(isset($rockon_data) && $rockon_data['rockon_audiotrackswitch'] == '1'){
?>
<div class="rockon_player rockon_player2" >
	<audio id="mejs" controls autoplay>
	<?php
	global $post;
	$track_query = new WP_Query( array( 'post_type' => 'rockon_track', 'posts_per_page' => '1'/*, 'orderby' => 'rand'*/) );
	 if($track_query->have_posts()):
		while($track_query->have_posts()) : $track_query->the_post();
			$audio = get_post_meta( $post->ID, 'rockon_audio_track', false );
			if (!empty($audio)){
				for($i=0;$i<count($audio);$i++){
					$audiosrcs = wp_get_attachment_url($audio[$i]);			
					echo '<source src="'.esc_url($audiosrcs).'" title="'.esc_attr(get_the_title($post->ID)).'" type="audio/mpeg">';	
				}
			}			
		 endwhile;
	 endif;
	 wp_reset_postdata();
	?>
    </audio>
</div>
<?php
}
?>
