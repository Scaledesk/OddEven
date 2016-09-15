<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Rockon
 */
get_header();

$post = rockon_post();
extract( rockon_pagemeta() );
if($pagetitle == 'enable'){
	get_template_part('include/section-pagetitle');	
}

	echo "<div class='clearfix'></div>";
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
		
			get_template_part( 'content', 'page' );

		endwhile; // end of the loop. 
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