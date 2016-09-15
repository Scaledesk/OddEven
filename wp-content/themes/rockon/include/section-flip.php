<?php
global $rockon_data;
global $post;
$gallery = '';
if(isset($rockon_data['rockon_slidergallery']))
{	$gallery = $rockon_data['rockon_slidergallery']; }
?>
<div class="rock_page_title_bg">
    <div class="main">
      <div id="rock_page_title_bg" class="ri-grid ri-grid-size-3">
        <ul>
         <?php
			$gallery = explode(',',$gallery);
			$cnt = count($gallery);
			for($i=0,$j=1;$i<$cnt;$i++,$j++){
				if($gallery[$i]){
					echo '<li><a href="#"><img src="'.esc_url(wp_get_attachment_url( $gallery[$i] )).'" alt="" /></a></li>';
					if($i == (count($gallery)-1)){
					if($j<=9){
						$cnt = 10 - count($gallery);
						$i = 0;
						echo '<li><a href="#"><img src="'.esc_url(wp_get_attachment_url( $gallery[$i] )).'" alt="" /></a></li>';
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