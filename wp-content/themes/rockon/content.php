<?php
/**
 * @package Rockon
 */
?> 
<div class="rock_blog">
<?php 
	global $post;
	global $cls;
	global $rockon_data; 
	if($cls == ''){
		$position = $rockon_data['rockon_sidebarposition'];	
		if($position == 3) $cls = 'col-lg-offset-2 col-md-offset-2 col-sm-offset-2';
	}
	$comments_count = wp_count_comments($post->ID);
	if (has_post_thumbnail($post->ID))
    {
		$thumb = get_post_thumbnail_id($post->ID);
		$thumb_w = '899';
		$thumb_h = '454';
		$attachment_url = wp_get_attachment_url($thumb, 'full');
		$image = aq_resize($attachment_url, $thumb_w, $thumb_h, true);	
		echo '<div class="blogcategory_image"><img src="'.esc_url($image).'" alt="">
			<div class="blogcategory_image_overlay">
			  <div class="photo_link"> <a href="'.esc_url( get_permalink() ).'"><i class="fa fa-link"></i></a> </div>
			</div>
		</div>';
	} 
	$content = $post->post_content;
	if( has_shortcode( $content, 'soundcloud' ) ) {
		//if( is_single() && is_main_query() ){
			$pattern = get_shortcode_regex();
			preg_match('/'.$pattern.'/s', $content, $matches);
			if ( isset( $matches[2] ) && is_array($matches) && $matches[2] == 'soundcloud'){
				echo do_shortcode( $matches['0'] );
			}
		//}
	}	
    echo '<div class="col-lg-10 col-md-10 col-sm-10 '.$cls.'">
          <div class="rock_blog_detail">
            <h3><a href="'.esc_url( get_permalink() ).'">'.esc_html(get_the_title($post->ID)).'</a></h3>
            <div class="blog_entry_meta">
              <ul>
                <li><a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'"><i class="fa fa-user"></i> '.esc_html(get_the_author()).'</a></li>
                <li><a href=""><i class="fa fa-calendar"></i> ';
				the_time('j F y');
				echo '</a></li>
                <li><a href="'.esc_url( get_permalink() ).'"><i class="fa fa-comments"></i> '.esc_attr($comments_count->approved).' '.esc_html__('Comments','rockon').'</a></li>
              </ul>
            </div>
            ';
			the_excerpt();
	echo '<p><a href="'.esc_url( get_permalink() ).'" class="btn btn-arrow btn-4a icon-arrow-right">'.esc_html__('Read More','rockon').'</a></p> </div>
        </div>';
	?>
</div>