<?php
global $post;
global $rockon_data;
$image = get_the_post_thumbnail( $post->ID, 'rockon-full-size' );
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$title = get_the_title($post->ID);
if(get_post_type($post->ID)!='rockon_event'){ 
	$str = get_excerpt(200); 
}else{
	$str =  get_post_meta( $post->ID, 'rockon_event_sysdesc', true );	
}
if(isset($rockon_data['rockon_fbapi']) && !empty($rockon_data['rockon_fbapi'])){
	$fbid = $rockon_data['rockon_fbapi'];
}else{
	$fbid = '1055386267820317';
}
$fb = "https://www.facebook.com/dialog/feed?app_id=".$fbid."&display=popup&name=".$title."&link=".get_permalink( $post->ID )."&redirect_uri=".get_permalink( $post->ID )."&description=".$str."&picture=".$image; 
$tw = "https://twitter.com/share?url=".get_permalink( $post->ID )."&text=".$str;
$gp = "https://plus.google.com/share?url=".get_permalink( $post->ID );
if(isset($rockon_data['rockon_singlesharepost']))
	$sp_title = $rockon_data['rockon_singlesharepost'];
?>
<div class="rock_share_social">
<div class="rock_social">
	<h3><?php echo esc_attr($sp_title); ?></h3>
	<ul>
	  <li><a href="<?php echo esc_url($fb); ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"><i class="fa fa-facebook"></i></a></li>
	  <li><a href="<?php echo esc_url($tw); ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"><i class="fa fa-twitter"></i></a></li>
	  <li><a href="<?php echo esc_url($gp); ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"><i class="fa fa-google-plus"></i></a></li>
	 <!-- <li class="rockon_linkdin"><script src="//platform.linkedin.com/in.js" type="text/javascript">
  lang: en_US
</script>
<script type="IN/Share"></script><a href=""><i class="fa fa-linkedin"></i></a></li>-->
	</ul>
</div>
</div>