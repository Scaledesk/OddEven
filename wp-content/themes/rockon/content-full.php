<div class="rock_blog_full_page">
<?php 
global $rsi;
global $post;
$comments_count = wp_count_comments($post->ID);
if (has_post_thumbnail($post->ID))
{	
	$thumb = get_post_thumbnail_id($post->ID);
	$thumb_w = '899';
	$thumb_h = '454';
	$attachment_url = wp_get_attachment_url($thumb, 'full');
	$image = aq_resize($attachment_url, $thumb_w, $thumb_h, true);
}else{
	$image = ROCKON_PATH.'/images/no_image.jpg';
}	
if($rsi%2 == 0){ ?>
<div class="col-lg-7 col-md-6 col-sm-12 blogcategory_big_part">
  <div class="rock_blog">
<?php
	echo '<div class="blogcategory_image">';
	$content = $post->post_content;
	if( has_shortcode( $content, 'soundcloud' ) ) {
		//if( is_single() && is_main_query() ){
			$pattern = get_shortcode_regex();
			preg_match('/'.$pattern.'/s', $content, $matches);
			if ( isset( $matches[2] ) && is_array($matches) && $matches[2] == 'soundcloud'){
				echo do_shortcode( $matches['0'] );
			}
		//}
	}else{	
		echo '<img src="'.esc_url($image).'" alt="">
		<div class="blogcategory_image_overlay">
		<div class="photo_link"> <a href="'.esc_url( get_permalink() ).'"><i class="fa fa-link"></i></a> </div>
		</div>';
	}
	echo '</div>';
?>
  </div>
</div>
<?php } ?>
<div class="col-lg-4 col-md-5 col-sm-12 full_page_blog_detail <?php if($rsi%2 != 0){ echo 'col-lg-offset-1 col-md-offset-1'; }?>">
  <div class="rock_blog_detail rock_padding_30">
	<h3><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html(get_the_title($post->ID)); ?></a></h3>
	<div class="blog_entry_meta">
	  <ul>
		<li><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><i class="fa fa-user"></i><?php echo esc_html(get_the_author()); ?></a></li>
		<li><a href=""><i class="fa fa-calendar"></i> <?php the_time('j F y'); ?></a></li>
		<li><a href="<?php echo esc_url( get_permalink() ); ?>"><i class="fa fa-comments"></i> <?php echo esc_html($comments_count->approved); ?> <?php esc_html_e('Comments','rockon'); ?></a></li>
	  </ul>
	</div>
	<hr>
	<?php the_excerpt(); ?>
	<p><a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-arrow btn-4a icon-arrow-right"><?php esc_html_e('Read More','rockon'); ?></a></p> </div>
</div>
<?php if($rsi%2 != 0){ ?>
<div class="col-lg-7 col-md-6 col-sm-12 blogcategory_big_part">
  <div class="rock_blog">
<?php
	echo '<div class="blogcategory_image"><img src="'.esc_url($image).'" alt="">
        <div class="blogcategory_image_overlay">
          <div class="photo_link"> <a href="'.esc_url( get_permalink() ).'"><i class="fa fa-link"></i></a> </div>
        </div>
      </div>';
?>
  </div>
</div>
<?php } 
$rsi++;
?>
</div>