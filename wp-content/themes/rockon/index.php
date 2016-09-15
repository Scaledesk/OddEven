<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Artist
 */
 get_header(); get_template_part('include/section-pagetitle');	?>
 <!-- Blog Content Area
================================================== -->
<?php
global $post; 
global $rockon_data; 
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
global $rsi;
$rsi = 0;
if((isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'portfolio') || 
(isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'services'))
	get_template_part('include/section-pagetitle');
 ?>
	<div class="blogcategory_container">
	<?php
	if(isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'portfolio'){
		$side = '1';
	}else{
		$side = '0';
	}
	?>
   <!-- Blog-Part-Start -->  
	<?php if(isset($position) && $position == 'left' && $side == '0'){ ?>
	 <div class="col-lg-4 col-md-4 col-sm-5 blogcategory_small_part">
		<div class="col-lg-8 col-md-8 col-sm-12 col-lg-offset-4  col-md-offset-4 col-sm-offset-0 rockon_sidebar_wrapper">
		<?php get_sidebar(); ?>
		</div>
	</div>
	<?php } ?>
	<?php if(isset($position) && $position == 'full' || $side == '1'){ ?>
	
	<?php }else{ ?> 
	<div class="col-lg-8 col-md-7 col-sm-8 blogcategory_big_part">
	<?php } ?>
		<?php 
		if(isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'blog'){
			get_template_part('include/section-blog');
		}elseif(isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'portfolio'){
			get_template_part('include/section-portfolio');
		}elseif(isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'services'){
			get_template_part('include/section-services');
		}else{ 
			get_template_part('include/section-blog');
		} 
	?>
	<?php if(isset($position) && $position == 'full' || $side == '1'){ ?>
	
	<?php }else{ ?> 
	</div>
	<?php } ?>
	<?php  if(isset($position) && $position == 'right' && $side == '0'){  ?>
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