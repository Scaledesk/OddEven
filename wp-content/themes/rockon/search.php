<?php
/**
 * The template for displaying search results pages.
 *
 * @package Rockon
 */

get_header(); 
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
$gallery = '';
if(isset($rockon_data['rockon_slidergallery']))
{	$gallery = $rockon_data['rockon_slidergallery']; }
?>
<div class="rock_page_title_main <?php if(empty($gallery)) echo 'no_flip_gallery'; ?>">
<?php
	get_template_part('include/section-flip');
	echo '<div class="rock_page_title">';
	rockon_the_breadcrumb('Search Results for : '.get_search_query());
	echo '</div>';
?>
</div>
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

		<?php if ( have_posts() ) : ?>
			
			
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
		
<?php if(isset($position) && $position == 'full'){ ?>

<?php }else{ ?> 
</div>
<?php } ?>
<?php  if(isset($position) && $position == 'right'){  ?>
 <div class="col-lg-4 col-md-5 col-sm-4 blogcategory_small_part">
 <div class="col-lg-12 col-md-12 col-sm-12 rockon_sidebar_wrapper">
<?php get_sidebar(); ?>
</div>
</div>
<?php } ?>
</div>	
<?php get_footer(); ?>