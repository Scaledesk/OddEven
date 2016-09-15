<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Rockon
 */
global $rockon_data;
?>
<div class="rock_footer">
    <div class="container">
        <div class="row">
			<?php if ( ! dynamic_sidebar( 'rockonfooter' ) ) : ?>
			<?php endif; ?> 
		</div>
	</div>
</div>
<?php 
get_template_part('include/section-footer');	
if(isset($rockon_data['rockon_googleanalytics'])){
echo stripslashes($rockon_data['rockon_googleanalytics']); 
}
?>

<?php wp_footer(); ?>
</body>
</html>