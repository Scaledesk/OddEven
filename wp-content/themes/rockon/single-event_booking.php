<?php
/**
 * The template for displaying all single posts.
 *
 * @package Rockon
 */
global $rockon_data; 
$position = sidebar_position_post();
get_header();
wp_reset_postdata();
get_template_part('include/section-pagetitle');
echo "<div class='clearfix'></div>
<div class='rock_margin_30'></div>";
	echo '<div class="container">';	
		if($position == 'left'){
			echo '<div class="col-lg-4 col-md-4 col-sm-5 blogcategory_small_part"><div class="col-lg-12 col-md-12 col-sm-12 rockon_sidebar_wrapper">';
				get_sidebar();
			echo '</div></div>';
		}
		if($position != 'full'){
			echo '<div class="col-lg-8 col-md-8 col-sm-7">';
		}
		while ( have_posts() ) : the_post(); 
			get_template_part( 'content', 'event' ); 
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() ) :
				comments_template();
			endif;
		endwhile; 
		if($position != 'full'){
			echo '</div>';
		}
		if($position == 'right'){
			echo '<div class="col-lg-4 col-md-4 col-sm-5 blogcategory_small_part"><div class="col-lg-12 col-md-12 col-sm-12 rockon_sidebar_wrapper">';
				get_sidebar();
			echo '</div></div>';
		}
	echo '</div>';
get_footer(); ?>