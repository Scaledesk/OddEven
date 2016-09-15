<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Rockon
 */

get_header(); ?>
	<div class="clearfix"></div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
			<div class="rock_404">
			<p><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'rockon' ); ?></p>
			<div>
			<h1><?php esc_html_e('404','rockon'); ?></h1>
			<h5><?php esc_html_e('error','rockon'); ?></h5>
			</div>
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'rockon' ); ?></p>
			</div>
			</div>
		</div>
		<div class="row">
			<div class="rock_404_search">
			<?php get_search_form(); ?>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3">
		<div class="rockon_sidebar_wrapper">
			<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>
		</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3">
		<div class="rockon_sidebar_wrapper">
			<?php if ( rockon_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
			<div class="widget widget_categories">
			<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'rockon' ); ?></h2>
			<ul>
			<?php
			wp_list_categories( array(
			'orderby'    => 'count',
			'order'      => 'DESC',
			'show_count' => 1,
			'title_li'   => '',
			'number'     => 10,
			) );
			?>
			</ul>
			</div><!-- .widget -->

			<?php endif; ?>
		</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3">
		<div class="rockon_sidebar_wrapper">
		<?php
		/* translators: %1$s: smiley */
		$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'rockon' ), convert_smilies( ':)' ) ) . '</p>';
		the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
		?>
		</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3">
		<div class="rockon_sidebar_wrapper">
		<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
		</div>
		</div>
	</div><!-- .page-content -->
	<div class="clearfix"></div>
<?php get_footer(); ?>