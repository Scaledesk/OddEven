<?php
$taxonomy = 'portfolio_categories';
$categories = get_terms( $taxonomy, array( 'parent' => 0, ) );
$image = $src = '';
global $i;
$i = 0;
echo '<div class="clearfix"></div>
<div class="rock_portfolio index_portfolio rockon_portfolio_width">
  <div class="container"> 
    <!-- /.title -->
    <div id="portfolio_filter_slider">
      <ul class="portfolio-filter portfolio_filter_slider">';
		if(count($categories) > 0)
		{    
			echo '<li> <a href="#" class="filter-item active" data-filter="all"> <img src="'.ROCKON_PATH.'/images/gallery/portfolio_mix.png" alt="" />
          <p>'.esc_html__('All','rockon').'</p>
          </a> </li>';
			foreach($categories as $category){
				$catasclass = $category->name;
				$catasclass = preg_replace('/\s/', '', $catasclass); 
				$thumbnail_id = get_option( '_wpfifc_taxonomy_term_'.$category->term_id.'_thumbnail_id_' );
				$image = wp_get_attachment_image_src( $thumbnail_id );
				if(isset($image[0])){
					$src = $image[0];
				}
				echo '<li><a href="#" class="filter-item" data-filter="'.esc_attr($category->name).'"><img src="'.esc_url($src).'" alt="" /><p>'.esc_html($category->name).'</p></a></li>'; 						
			} 
		}
echo '</ul>
    </div>
    <!-- /portfolio-filter --> 
    
  </div>
</div>';
$args = array(   
  'post_type' => 'portfolio',
  'posts_per_page' => -1
);  
$query = new WP_Query( $args );
echo '<div class="container rock_margin_30">
  <div class="clearfix"></div>
  <div class="row portfolio-grid index_portfolio_content rock_margin_30" id="grid">';
if (have_posts()) :
	 while ( have_posts() ) : the_post(); 
			   get_template_part('include/section-full-portfolio');
		 endwhile;
	else : 
		get_template_part( 'content', 'none' ); 
endif;
echo '<!-- /.col-md-4 portfolio-item mix --> 
  </div>
</div>';
wp_reset_postdata();
?> 