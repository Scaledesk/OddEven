<?php global $post; ?>
 <div class="row" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="col-lg-12">
		<div class="rock_blog_single">
			<?php 
			$comments_count = wp_count_comments($post->ID);
			$filetype = wp_check_filetype(wp_get_attachment_url());
			$type = $filetype['type'];
			if($type == 'audio/mpeg'){
				echo '<div class="rock_audio_player"><div class="audio-player">
                       <audio class="rock_portfolio_player" controls autoplay><source src="'.esc_url( wp_get_attachment_url() ).'" type="audio/mpeg" ></audio>
                     </div></div>';	
			}elseif($type == 'text/plain'){
				echo '<span class="full-size-link"><a href="'.esc_url( wp_get_attachment_url() ).'"><img src="'.ROCKON_PATH.'/images/text.jpg" alt=""></a></span>';
			}else{
				echo '<span class="full-size-link"><a href="'.esc_url( wp_get_attachment_url() ).'"><img src="'.esc_url( wp_get_attachment_url() ).'" alt=""></a></span>';
			}
			?>
			
			<?php the_title( '<h3>', '</h3>' ); ?>
			<div class="blog_entry_meta">
          <ul>
            <li><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="fa fa-user"></i><?php echo esc_html(get_the_author()); ?></a></li>
            <li><a href=""><i class="fa fa-calendar"></i><?php rockon_posted_on(); ?></a></li>
            <li><a href=""><i class="fa fa-comments"></i><?php echo esc_html($comments_count->approved); ?> <?php echo esc_html__('Comments','rockon');?></a></li>
          </ul>
        </div>
        <hr>
        <p><?php the_content(); ?></p>
		</div>
	 </div>
</div>