<?php
/*
Template Name: Blog Page
*/
 get_header(); ?>
 <!-- Blog Content Area
================================================== -->
<?php
wp_reset_postdata();
get_template_part('include/section-pagetitle');
global $post; 
global $rockon_data; 
$position = get_post_meta($post->ID, 'rockon_page_sidebarposition', true);
global $rsi;
$rsi = 0;
 ?>
	<div class="blogcategory_container">
   <!-- Blog-Part-Start -->  
	<?php if(isset($position) && $position == 'left'){ ?>
	 <div class="col-lg-4 col-md-4 col-sm-5 blogcategory_small_part">
		<div class="col-lg-8 col-md-8 col-sm-12 col-lg-offset-4  col-md-offset-4 col-sm-offset-0 rockon_sidebar_wrapper">
		<?php get_sidebar(); ?>
		</div>
	</div>
	<?php } ?>
	<?php if(isset($position) && $position == 'full'){ ?>
	
	<?php }else{ ?> 
	<div class="col-lg-8 col-md-7 col-sm-8 blogcategory_big_part">
	<?php } ?>
		<?php get_template_part('include/section-blog'); //get_the_content($post->ID); ?>
	<?php if(isset($position) && $position == 'full'){ ?>
	
	<?php }else{ ?> 
	</div>
	<?php } ?>
	<?php  if(isset($position) && $position == 'right'){  ?>
	 <div class="col-lg-4 col-md-5 col-sm-4 blogcategory_small_part">
	 <div class="col-lg-8 col-md-8 col-sm-12 rockon_sidebar_wrapper">
	<?php get_sidebar(); ?>
	</div>
	</div>
	<?php } ?>
	</div>	
 <!-- Blog Content Area End
================================================== -->
<?php get_footer(); ?>