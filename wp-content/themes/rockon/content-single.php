<?php
/**
 * @package Rockon
 */
 global $post;
?>
<div class="row">
 <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="col-lg-12">
		<div class="rock_blog_single">
			<?php 
			$comments_count = wp_count_comments($post->ID);
			$image = get_the_post_thumbnail( $post->ID, 'rockon-full-size' );
			$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			$audiosrc = get_post_meta( $post->ID, 'rockon_audio_src', true );
			if(!empty($audiosrc)){
				$filetype = wp_check_filetype($audiosrc);
				$type = $filetype['type'];
				if($type == 'audio/mpeg'){
					echo '<div class="rock_audio_player">
                     <div class="rock_audio_player_track_image">';
					if (has_post_thumbnail($post->ID)){	
						echo '<img src="'.esc_url($image).'" alt="" >';
					}
					echo '<div class="rock_audio_player_track_image_overlay">'.esc_html(get_the_title($post->ID)).'</div>
                     </div>
                     <div class="audio-player">
                       <audio class="rock_portfolio_player" controls autoplay><source src="'.esc_url($audiosrc).'" type="audio/mpeg" ></audio>
                     </div>
                   </div>';	
				}else{     					  
					echo '<div id="rockon_youtube_player"></div>';
				}
			}else{
				if (has_post_thumbnail($post->ID) && !empty($image))
				{
					echo '<img src="'.esc_url($image).'" alt="">';
				}
			}
			?>
			<?php the_title( '<h3>', '</h3>' ); ?>
			<div class="blog_entry_meta">
          <ul>
			<?php if(get_post_type($post->ID)!='rockon_event'){ ?>
            <li><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="fa fa-user"></i><?php echo esc_html(get_the_author()); ?></a></li>
			<li><a href="<?php echo esc_url( get_permalink() ); ?>"><i class="fa fa-calendar"></i><?php rockon_posted_on(); ?></a></li>
			<li><a href=""><i class="fa fa-comments"></i><?php echo esc_html($comments_count->approved); ?> <?php echo esc_html__('Comments','rockon'); ?></a></li>
			<?php }else{ 
			$Ftime = get_post_meta( $post->ID, 'rockon_event_systimefrom', true );
			$Ttime =  get_post_meta( $post->ID, 'rockon_event_systimeto', true );
			$loc =  get_post_meta( $post->ID, 'rockon_event_sysloaction', true );
			$map =  get_post_meta( $post->ID, 'rockon_event_syscomma', true );
			$date = get_post_meta( $post->ID, 'rockon_event_sysdate', true );
			?>
			<li><a href="<?php echo esc_url( get_permalink() ); ?>"><i class="fa fa-calendar"></i><?php 
			echo date('d',strtotime($date));
			global $rockon_data;
			if(isset($rockon_data['rockon_language']))
				setlocale(LC_TIME, $rockon_data['rockon_language']);
			echo ' '.strftime("%B",strtotime($date)).' ';
			echo date('Y',strtotime($date)); ?></a></li>
			<li><a href=""><i class="fa fa-clock-o"></i> <?php echo esc_html($Ftime),' - ',esc_html($Ttime); ?></a></li>
			<li><a href="<?php echo esc_url('https://maps.google.com/maps?q='.$map); ?>" target="_blank"><i class="fa fa-map-marker"></i> <?php echo esc_html($loc); ?></a></li>
			<?php } ?>
          </ul>
        </div>
        <hr>
		<?php 
		if(get_post_type($post->ID)!='rockon_event'){ 
			the_content(); 
		}else{
			$desc =  get_post_meta( $post->ID, 'rockon_event_sysdesc', true );	
			echo '<p>'.esc_html($desc).'</p>';
		}
		?>		
		</div>
	 </div>
  </div>
</div><!-- #post-## -->
<?php 
global $rockon_data;
if(isset($rockon_data['rockon_event_sharing']) && $rockon_data['rockon_event_sharing'] == '1'){
	get_template_part('include/section-social-share'); 
}elseif(isset($rockon_data['rockon_post_sharing']) && $rockon_data['rockon_post_sharing'] == '1'){
	get_template_part('include/section-social-share'); 
}elseif(isset($rockon_data['rockon_portfolio_sharing']) && $rockon_data['rockon_portfolio_sharing'] == '1'){
	get_template_part('include/section-social-share'); 
}
?>
<?php get_template_part('include/section-relatedpost'); ?>
<?php get_template_part('include/section-event-gallery'); ?>