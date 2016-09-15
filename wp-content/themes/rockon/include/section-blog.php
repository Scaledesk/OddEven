<?php
global $rockon_data;
if(!is_page_template()){
	$position = $rockon_data['rockon_sidebarposition'];
	switch($position){
		case 1:
			$position = 'full';
		break;
		case 2:
			$position = 'left';
		break;
		case 3:
			$position = 'right';
		break;
	}
}else{
	$position = get_post_meta($post->ID, 'rockon_page_sidebarposition', true);
	global $cls;
	if($position == 'left') $cls = 'rockon left';
	if($position == 'right') $cls = 'col-lg-offset-2 col-md-offset-2 col-sm-offset-2';
}
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(   
  'post_type' => 'post',
  'paged' => $paged
);  
$query = new WP_Query( $args );
if ($query->have_posts()) :
	 while ( $query->have_posts() ) : $query->the_post(); 
			   if(isset($position) && $position == 'full'){
					get_template_part('content-full', get_post_format() );
				}
				else{
					get_template_part( 'content', get_post_format() );	
				}
		 endwhile;
		 echo '<div class="col-lg-12 col-md-12 col-sm-12 text-center">';
			rockon_paging_nav_template( $query ); 
		echo '</div>';
	else : 
		get_template_part( 'content', 'none' ); 
endif;
wp_reset_postdata();
?>