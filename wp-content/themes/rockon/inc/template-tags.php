<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Rockon
 */

if ( ! function_exists( 'rockon_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function rockon_paging_nav() {
	if( is_singular() )
		return;
	global $wp_query;
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );
	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;
	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}
	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}
	echo '<div class="rock_pagination"><ul>' . "\n";
	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li class="rockon_prevpage">%s</li>' . "\n", get_previous_posts_link('«') );
	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}
	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}
	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";
		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}
	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li class="rockon_nextpage">%s</li>' . "\n", get_next_posts_link('»') );
	echo '</ul></div>' . "\n";
}
endif;

if ( ! function_exists( 'rockon_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function rockon_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'rockon' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'rockon' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'rockon' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'rockon_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function rockon_posted_on() {

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'rockon' ),
		 get_the_date(get_option('date_format'))
	);

	echo $posted_on;

}
endif;

if ( ! function_exists( 'rockon_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function rockon_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'rockon' ) );
		if ( $categories_list && rockon_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'rockon' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'rockon' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'rockon' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'rockon' ), esc_html__( '1 Comment', 'rockon' ), esc_html__( '% Comments', 'rockon' ) );
		echo '</span>';
	}

	edit_post_link( esc_html__( 'Edit', 'rockon' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function rockon_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'rockon_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'rockon_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so rockon_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so rockon_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in rockon_categorized_blog.
 */
function rockon_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'rockon_categories' );
}
add_action( 'edit_category', 'rockon_category_transient_flusher' );
add_action( 'save_post',     'rockon_category_transient_flusher' );

function rockon_paging_nav_template( $query ){
	if ( $GLOBALS['query']->max_num_pages < 2 ) {
		return;
	}
	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $query->max_num_pages );
	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;
	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}
	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}
	echo '<div class="rock_pagination"><ul>' . "\n";
	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li class="rockon_prevpage">%s</li>' . "\n", get_previous_posts_link('«') );
	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}
	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}
	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";
		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}
	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li class="rockon_nextpage">%s</li>' . "\n", get_next_posts_link('»') );
	echo '</ul></div>' . "\n";
}
