<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Rockon
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
 <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="rock_comment_main">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( '<div class="rock_heading_div"><div class="rock_heading"><h1>%1$s Comments</h1><p>X</p></div></div>', '<div class="rock_heading_div"><div class="rock_heading"><h1>%1$s Comments</h1><p>X</p></div></div>', get_comments_number(), 'comments title', 'rockon' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'rockon' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'rockon' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'rockon' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>
			<ul>
			<?php
				wp_list_comments( 'type=comment&callback=rockon_custom_comments' );
			?>
			</ul>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'rockon' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'rockon' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'rockon' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'rockon' ); ?></p>
	<?php endif; ?>
		</div>
	</div>
</div>
<?php
if ( !have_comments() ) :
echo '<div class="rockon_no_comments">
	<i class="fa fa-comments"></i>
	<h5>'.esc_html__('No Comments Yet!', 'rockon' ).'</h5>
	<p>'.esc_html__('Leave A Comment...Your data will be safe!', 'rockon').'</p>
</div>';
 endif;
$commenter = wp_get_current_commenter();
$aria_req = ( $req ? " aria-required='true'" : '' );
$fields =  array(
    'author' => '<div class="col-lg-4 col-md-4 col-sm-4 form-group"><input type="text" class="form-control" id="your_name" name="author" placeholder="'.esc_html__('Your First Name','rockon').'" value="' . esc_attr( $commenter['comment_author'] ).'" ' . $aria_req .'  /></div>',
    'email'  => '<div class="col-lg-4 col-md-4 col-sm-4 form-group"><input type="text" id="your_email" value="' . esc_attr( $commenter['comment_author_email'] ).'" ' . $aria_req .' placeholder="'.esc_html__('Your Email','rockon').'" name="email" class="form-control" /></div>',
	'website'  => '<div class="col-lg-4 col-md-4 col-sm-4 form-group"><input type="url" class="form-control" id="website" name="website" placeholder="'.esc_html__('Website','rockon').'"></div>',
);
$comments_args = array(
    'fields' =>  $fields,
	'id_form'           => 'artist_commentform',
  'comment_field'         => '<div class="col-lg-12 form-group">
		<textarea rows="10" class="form-control" id="comment" name="comment" placeholder="'.esc_html__('Your Comment','rockon').'"></textarea>
	  </div>',
  'comment_notes_before'=>'',
  'comment_notes_after'=>'',
  'id_submit'=>'commentsubmit',
  'title_reply'=>'',  
);
echo '<div class="row"><div class="rock_leave_comment">';
comment_form($comments_args);
echo '</div></div>';
?>