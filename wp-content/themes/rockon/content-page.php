<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Rockon
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'rockon' ),
				'after'  => '</div>',
			) );
		?>

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'rockon' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</div><!-- #post-## -->
