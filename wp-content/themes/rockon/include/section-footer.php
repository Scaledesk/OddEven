<?php
global $rockon_data;
$stycon = $copytext = $gallery = '';
$fb = $twt = $link = $fkr = $yt = $dr = $gp = $sky = $pin = $social = '';
$cnt = 0;
if(isset($rockon_data['rockon_stayconnect']) && $rockon_data['rockon_stayconnect']){
$stycon = $rockon_data['rockon_stayconnect'];
}
if(isset($rockon_data['rockon_copyrighttext']) && $rockon_data['rockon_copyrighttext']){
$copytext = $rockon_data['rockon_copyrighttext'];
}
if(isset($rockon_data['rockon_slidergallery']))
{	
	$gallery = $rockon_data['rockon_slidergallery']; 
	$gallery = explode(',',$gallery);
	$cnt = count($gallery);
}
if(isset($rockon_data['rockon_facebookurl']))
	$fb = $rockon_data['rockon_facebookurl'];
if(isset($rockon_data['rockon_twitterurl']))
	$twt = $rockon_data['rockon_twitterurl'];
if(isset($rockon_data['rockon_linkedinurl']))
	$link = $rockon_data['rockon_linkedinurl'];
if(isset($rockon_data['rockon_flickrurl']))
	$fkr = $rockon_data['rockon_flickrurl'];
if(isset($rockon_data['rockon_youtubeurl']))
	$yt = $rockon_data['rockon_youtubeurl'];
if(isset($rockon_data['rockon_dribbbleurl']))
	$dr = $rockon_data['rockon_dribbbleurl'];
if(isset($rockon_data['rockon_gpurl']))
	$gp = $rockon_data['rockon_gpurl'];
if(isset($rockon_data['rockon_skypeurl']))
	$sky = $rockon_data['rockon_skypeurl'];
if(isset($rockon_data['rockon_pinteresturl']))
	$pin = $rockon_data['rockon_pinteresturl'];
if(isset($rockon_data['rockon_displaysocial']))
	$social = $rockon_data['rockon_displaysocial'];
?>
<div class="rock_copyright">
  <div class="rock_copyright_bg">
	<div class="main">
	  <div id="ri-grid2" class="ri-grid ri-grid-size-3">
		<ul>
		  <?php
			for($i=0,$j=1;$i<$cnt;$i++,$j++){
				if($gallery[$i]){
					echo '<li><a><img src="'.esc_url(wp_get_attachment_url( $gallery[$i] )).'" alt="" /></a></li>';
					if($i == (count($gallery)-1)){
					if($j<=9){
						$cnt = 10 - count($gallery);
						$i = 0;
						echo '<li><a><img src="'.esc_url(wp_get_attachment_url( $gallery[$i] )).'" alt="" /></a></li>';
					}else{
						break;
					}
					}
				}
			}
		  ?>
		</ul>
	  </div>
	</div>
  </div>
  <div class="rock_copyright_div">
	<div class="container">
	  <div class="row">
		<div class="col-lg-3 col-md-6 col-sm-12">
		  <p><?php echo esc_html($stycon); ?></p>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-12">
		  <div class="rock_social">
			<ul>
				<?php if(isset($social['SHOW']['Facebook'])){ ?>
			  <li><a href="<?php echo esc_url($fb) ; ?>"><i class="fa fa-facebook"></i></a></li>
				<?php } ?>
				<?php if(isset($social['SHOW']['Twitter'])){ ?>
			  <li><a href="<?php echo esc_url($twt) ; ?>"><i class="fa fa-twitter"></i></a></li>
				<?php } ?>
				<?php if(isset($social['SHOW']['Google'])){ ?>
			  <li><a href="<?php echo esc_url($gp); ?>"><i class="fa fa-google-plus"></i></a></li>
				<?php } ?>
				<?php if(isset($social['SHOW']['Skype'])){ ?>
			  <li><a href="<?php echo esc_url($sky); ?>"><i class="fa fa-skype"></i></a></li>
				<?php } ?>
				<?php if(isset($social['SHOW']['Linkedin'])){ ?>
			  <li><a href="<?php echo esc_url($link); ?>"><i class="fa fa-linkedin"></i></a></li>
				<?php } ?>
				<?php if(isset($social['SHOW']['Pinterest'])){ ?>
			  <li><a href="<?php echo esc_url($pin); ?>"><i class="fa fa-pinterest"></i></a></li>
				<?php } ?>
				<?php if(isset($social['SHOW']['Flickr'])){ ?>
			  <li><a href="<?php echo esc_url($fkr); ?>"><i class="fa fa-flickr"></i></a></li>
				<?php } ?>
				<?php if(isset($social['SHOW']['Youtube'])){ ?>
			  <li><a href="<?php echo esc_url($yt); ?>"><i class="fa fa-youtube"></i></a></li>
				<?php } ?>
				<?php if(isset($social['SHOW']['Dribbble'])){ ?>
			  <li><a href="<?php echo esc_url($dr); ?>"><i class="fa fa-dribbble"></i></a></li>
				<?php } ?>
			</ul>
		  </div>
		</div>
		<div class="col-lg-5 col-md-8 col-sm-12 col-lg-offset-0 col-md-offset-2 col-sm-offset-0">
		  <p><?php echo esc_html($copytext); ?></p>
		</div>
	  </div>
	</div>
  </div>
</div>