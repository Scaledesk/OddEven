<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Rockon
 */
 global $post; 
global $rockon_data;
$gallery = ""; 
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
if(isset($rockon_data['rockon_slidergallery']))
{	$gallery = $rockon_data['rockon_slidergallery']; }
get_header(); 
?>
	<div class="rock_page_title_main <?php if(empty($gallery)) echo 'no_flip_gallery'; ?>">
			<?php
				get_template_part('include/section-flip');
				echo '<div class="rock_page_title">';
				if ( is_category() ) :
					rockon_the_breadcrumb(single_cat_title("", false));

				elseif ( is_tag() ) :
					rockon_the_breadcrumb(single_tag_title("", false));

				elseif ( is_author() ) :
					rockon_the_breadcrumb( 'Author : ' . get_the_author() );

				elseif ( is_day() ) :
					rockon_the_breadcrumb( 'Day: ' . get_the_date() );

				elseif ( is_month() ) :
					rockon_the_breadcrumb( 'Month: '. get_the_date( _x( 'F Y', 'monthly archives date format', 'rockon' ) ) );

				elseif ( is_year() ) :
					rockon_the_breadcrumb( 'Year: ' . get_the_date( _x( 'Y', 'yearly archives date format', 'rockon' ) ) );

				elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
					rockon_the_breadcrumb( 'Asides');

				elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
					rockon_the_breadcrumb( 'Galleries' );

				elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
					rockon_the_breadcrumb( 'Images' );

				elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
					rockon_the_breadcrumb( 'Videos' );

				elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
					rockon_the_breadcrumb( 'Quotes' );

				elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
					rockon_the_breadcrumb( 'Links' );

				elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
					rockon_the_breadcrumb( 'Statuses' );

				elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
					rockon_the_breadcrumb( 'Audios' );

				elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
					rockon_the_breadcrumb( 'Chats' );

				else :
					rockon_the_breadcrumb( 'Archives' );

				endif;
				echo '</div>';
			?>
		
		<?php
			// Show an optional term description.
			$term_description = term_description();
			if ( ! empty( $term_description ) ) :
				printf( '<div class="taxonomy-description">%s</div>', $term_description );
			endif;
		?>
	</div>
		<?php if ( have_posts() ) : ?>
			<div class="blogcategory_container">
		   <!-- Blog-Part-Start -->  
			<?php if(isset($position) && $position == 'left'){ ?>
			 <div class="col-lg-4 col-md-4 col-sm-5 blogcategory_small_part">
				<div class="col-lg-8 col-md-8 col-sm-12 rockon_sidebar_wrapper">
					<?php get_sidebar(); ?>
					</div>
				</div>
			<?php } ?>
			<?php if(isset($position) && $position == 'full'){ ?>
	
			<?php }else{ ?> 
			<div class="col-lg-8 col-md-7 col-sm-8 blogcategory_big_part">
			<?php } ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					if(isset($position) && $position == 'full'){
						get_template_part('content-full', get_post_format() );
					}
					else{
						get_template_part( 'content', get_post_format() );	
					}
				?>

			<?php endwhile; ?>

			<?php 
				echo '<div class="row">','<div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">';
					rockon_paging_nav(); 
				echo '</div>','</div>';
			?>
			<?php if(isset($position) && $position == 'full'){ ?>
	
			<?php }else{ ?> 
			</div>
			<?php } ?>
			<?php  if(isset($position) && $position == 'right'){  ?>
			 <div class="col-lg-4 col-md-4 col-sm-5 blogcategory_small_part">
				<div class="col-lg-8 col-md-8 col-sm-12 rockon_sidebar_wrapper">
				<?php get_sidebar(); ?>
				</div>
			</div>
			<?php } ?>
			</div>	
			
		<?php else : ?>
			<div class="container">
		   <!-- Blog-Part-Start -->  
			<?php if(isset($position) && $position == 'left'){ ?>
			 <div class="col-lg-4 col-md-4 col-sm-5 blogcategory_small_part">
				<div class="col-lg-12 col-md-12 col-sm-12 rockon_sidebar_wrapper">
					<?php get_sidebar(); ?>
					</div>
				</div>
			<?php } ?>
			<?php if(isset($position) && $position == 'full'){ ?>
	
			<?php }else{ ?> 
			<div class="col-lg-8 col-md-7 col-sm-8 blogcategory_big_part">
			<?php } ?>
			<?php get_template_part( 'content', 'none' ); ?>
			<?php if(isset($position) && $position == 'full'){ ?>
	
			<?php }else{ ?> 
			</div>
			<?php } ?>
			<?php  if(isset($position) && $position == 'right'){  ?>
			 <div class="col-lg-4 col-md-4 col-sm-5 blogcategory_small_part">
				<div class="col-lg-12 col-md-12 col-sm-12 rockon_sidebar_wrapper">
				<?php get_sidebar(); ?>
				</div>
			</div>
			<?php } ?>
			</div>				
		<?php endif; ?>
			
<?php get_footer(); ?>