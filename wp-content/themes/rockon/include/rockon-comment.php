<?php
function rockon_custom_comments($comment, $args, $depth){
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	}else{
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
		<div class="col-lg-12 col-md-12 col-sm-12 rock_comment">
          <div class="col-lg-2 col-md-2 col-sm-2"> <?php echo get_avatar($comment,$size='100'); ?> </div>
          <div class="col-lg-10 col-md-10 col-sm-10">
            <div class="rock_comment_auther"> <a href="<?php echo get_comment_link(); ?>">
              <h4><?php echo esc_html($comment->comment_author); ?></h4>
              </a>
              <h5><?php rockon_posted_on(); ?></h5>
            </div>
            <?php if ( $comment->comment_approved == '0' ) { ?>
			<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.','rockon' ); ?></p>
			<br />
			<?php }else{ ?>		
			<?php comment_text(); } ?>
            <?php comment_reply_link( array_merge( $args, array(  'add_below' => $add_below,'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div>
		</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; 
}
?>