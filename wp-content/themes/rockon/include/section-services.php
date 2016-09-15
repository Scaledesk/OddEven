<?php
$result = '';
   $result .= '<div class="rockon_service_main">';
   $services_query = new WP_Query( array( 'post_type' => 'services', 'posts_per_page' => -1) );
   if($services_query->have_posts()): 	
   $result .= ' <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">';
		while($services_query->have_posts()) : $services_query->the_post();	
			$result .= '<div class="col-lg-4 col-md-4 col-sm-4"><div class="rockon_service">';
			$image = get_the_post_thumbnail( $post->ID, 'rockon-small-very-size' );
			if (has_post_thumbnail($post->ID) && !empty($image))
			{	
			$result .= '<div class="rock_service_icon">'.$image.'</div>';
			}else{
				$svg = get_post_meta( $post->ID, 'rockon_svgiconcode', true );
				if(!empty($svg)){
					$result .= '<div class="rock_service_icon">'.$svg.'</div>';
				}else{
					$result .= '<div class="rock_service_icon"><img src="'.ROCKON_PATH.'/images/no_image.jpg" class="rockon_nothumservices" alt=""></div>';
				}	
			}				
			$result .= '<h3>'.esc_html(get_the_title($post->ID)).'</h3>
			<p>'.get_excerpt(300).'</p>
			 </div>
			</div>';		  
		 endwhile; 
	$result .= '</div></div>';
	endif; 
	wp_reset_postdata();
	$result .= '</div>';
	echo $result;	
?>