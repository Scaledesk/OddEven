<?php
add_action( 'vc_before_init', 'rockon_VC_Map_inti' );
function rockon_VC_Map_inti(){
	/* Club Photos */
	vc_map( array(
		"name" => __("Rockon Club Photos",'rockon'),
		"base" => "rockon_club_post",
		"class" => "",
		"category" => __('Content','rockon'),
		'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Title",'rockon'),
				"param_name" => "title",
				"value" => __("Rockon Club Photos",'rockon'),
				"description" => __("Title text Here.",'rockon')
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Number Of Row",'rockon'),
				"param_name" => "no_of_row",
				"value" => array('1','2','3'),
				"description" => __("Choose no of row.",'rockon')
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Number Of Post",'rockon'),
				"param_name" => "no_of_post",
				"value" => array('4','8','12','16','20'),
				"description" => __("Choose no of post.",'rockon')
			)
		)
	));
	/* Club Photos */
	/* contact */
	vc_map( array(
		"name" => __("Rockon contact",'rockon'),
		"base" => "rockon_contact_post",
		"class" => "",
		"category" => __('Content','rockon'),
		'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Title",'rockon'),
				"param_name" => "title",
				"value" => __("Contact",'rockon'),
				"description" => __("Title text Here.",'rockon')
			)
		)
	) );
	/* contact */
	/* Event */
	vc_map( array(
		"name" => __("Rockon Event",'rockon'),
		"base" => "rockon_event_shortchode",
		"class" => "",
		"category" => __('Content','rockon'),
		'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title",'rockon'),
			"param_name" => "title",
			"value" => __("Event of the month",'rockon'),
			"description" => __("Title text Here.",'rockon')
		 ),
		  array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Number Of Post",'rockon'),
			"param_name" => "no_of_post",
			"value" => array('6','12','18','24','30','36','42','48'),
			"description" => __("Choose no of post.",'rockon')
		 ),
		 array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Show Custom Post As",'rockon'),
			"param_name" => "event_look",
			"value" => array('simple','slider'),
			"description" => ''
		 )
		)
	) );
	/* Event */
	/* Show Post As Gallery */
	$taxonomy = 'portfolio_categories';
	$categories = get_terms( $taxonomy, array( 'parent' => 0, ) );
	$catasclass = array();
	$catasclass['select'] = 'null';
	foreach($categories as $category)
	{
		$catasclass[$category->name] = $category->slug;
	}
	vc_map( array(
		"name" => __("Rockon Show Post As Gallery",'rockon'),
		"base" => "rockon_gallery_shortchode",
		"class" => "",
		"category" => __('Content','rockon'),
		'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		"params" => array(
		 array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title",'rockon'),
			"param_name" => "title",
			"value" => __("Gallery 2 Column",'rockon'),
			"description" => __("Title text Here.",'rockon')
		 )/*,
		 array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Indicate For Sharing",'rockon'),
			"param_name" => "share",
			"value" => __("SHARE THIS IMAGE",'rockon'),
			"description" => __("change text for showing sharing icon.",'rockon')
		 )*/,
		 array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Number Of Column",'rockon'),
			"param_name" => "no_of_column",
			"value" => array('2','3','4'),
			"description" => __("Choose no of column.",'rockon')
		 ),
		  array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Number Of Post",'rockon'),
			"param_name" => "no_of_post",
			"value" => '',
			"description" => __("Choose no of post.",'rockon')
		 ),
		 array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Post Type (Either select post type or the post category, one at a time)",'rockon'),
			"param_name" => "post_type",
			"value" => array('null'=>'Select','services'=>'Services','portfolio'=>'Portfolio','disc_jockey_team'=>'Disc Jockey Team','post'=>'Post'),
			"description" => ''
		 ),
		 array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Portfolio Category (Either select post type or the portfolio category, one at a time)",'rockon'),
			"param_name" => "category",
			"value" => $catasclass,
			"description" => ''
		 )
		)
	) );
	/* Show Post As Gallery */
	/* Portfolio Filter (Note : Use Without Sidebar) */
	vc_map( array(
		"name" => __("Rockon Portfolio Filter (Note : Use Without Sidebar)",'rockon'),
		"base" => "rockon_portfolio_filter_shortchode",
		"class" => "",
		"category" => __('Content','rockon'),
		'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Title",'rockon'),
				"param_name" => "title",
				"value" => __("Portfolio Filter",'rockon'),
				"description" => __("Title text Here.",'rockon')
			)
		)
	) );
	/* Portfolio Filter (Note : Use Without Sidebar) */
	/* about post */
	vc_map( array(
		"name" => __("rockon about post",'rockon'),
		"base" => "rockonaboutpost",
		"class" => "",
		"category" => __('Content','rockon'),
		'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Title",'rockon'),
				"param_name" => "title",
				"value" => __("What we Offers",'rockon'),
				"description" => __("Title text Here.",'rockon')
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Description",'rockon'),
				"param_name" => "description",
				"value" => __("Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ut semper erat. In sagittis vulputate nisi, a tristique massa porttitor ac. Phasellus nisi magna, feugiat at orci in, laoreet sagittis purus. Donec eu bibendum ipsum. Quisque vulputate imperdiet dignissim. Sed venenatis dui vel sollicitudin tincidunt.",'rockon'),
				"description" => __("Title text Here.",'rockon')
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Number Of Post",'rockon'),
				"param_name" => "no_of_post",
				"value" => array('2','4','6','8','10'),
				"description" => __("choose No of Post.",'rockon')
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Post Type",'rockon'),
				"param_name" => "post_type",
				"value" => array('null'=>'select','services'=>'Services','club'=>'Club','disc_jockey_team'=>'Disc Jockey Team','post'=>'Post'),
				"description" => __("choose No of Post.",'rockon')
			)
		)
	) );
	/* about post */
	/* Custom Services Post */
	vc_map( array(
		"name" => __("Custom Services Post",'rockon'),
		"base" => "rockon_services_post",
		"class" => "",
		"category" => __('Content','rockon'),
		'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		"params" => array(
			 array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Title",'rockon'),
				"param_name" => "title",
				"value" => __("Services",'rockon'),
				"description" => __("Title text Here.",'rockon')
			 ),
			 array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Number Of Post",'rockon'),
				"param_name" => "no_of_post",
				"value" => array('3','6','9'),
				"description" => __("choose No of Post.",'rockon')
			 )/*,
			 array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Change Text"),
				"param_name" => "readmore",
				"value" => __("Read More"),
				"description" => __("Read More Text Change Here.")
			 )*/
		)
	) );
	/* Custom Services Post */
	/* Team */
	vc_map( array(
		"name" => __("Rockon Team",'rockon'),
		"base" => "rockon_team_post",
		"class" => "",
		"category" => __('Content','rockon'),
		'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Title",'rockon'),
				"param_name" => "title",
				"value" => __("Rockon Disc Jockey",'rockon'),
				"description" => __("Title text Here.",'rockon')
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Number Of Post",'rockon'),
				"param_name" => "no_of_post",
				"value" => array('4','8','12'),
				"description" => __("Choose no of post.",'rockon')
			)
		)
	) );
	/* Team */
	/* Club Track */
	vc_map( array(
		"name" => __("Rockon Club Track",'rockon'),
		"base" => "rockon_track_post",
		"class" => "",
		"category" => __('Content','rockon'),
		'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Title",'rockon'),
				"param_name" => "title",
				"value" => __("Rockon Club Track",'rockon'),
				"description" => __("Title text Here.",'rockon')
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => __("Number Of Post",'rockon'),
				"param_name" => "no_of_post",
				"value" => array('3','6','9'),
				"description" => __("Choose no of post.",'rockon')
			)
		)
	) );
	/* Club Track */
	/* Welcome Block */
	vc_map( array(
		"name" => __("Welcome Block",'rockon'),
		"base" => "rockon_welcome_content",
		"class" => "",
		"category" => __('Content','rockon'),
		'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
		'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __("Title",'rockon'),
				"param_name" => "title",
				"value" => __("WELCOME IN ROCKON CLUB",'rockon'),
				"description" => __("Title text Here.",'rockon')
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => __("Description",'rockon'),
				"param_name" => "content",
				"value" => __("<p>Mauris a massa id leo aliquam consequat porttitor vitae est. Proin ultricies velit sed porttitor viverra. Pellentesque eget tristique est. Donec volutpat, eros et bibendum lacinia, enim ipsum gravida enim, quis viverra odio elit sit amet orci. Aenean eget mi quam.</p>",'rockon'),
				"description" => __("Enter your content.",'rockon')
			)
		)
	) );
	/* Welcome Block */
}
add_shortcode( 'rockon_welcome_content', 'rockon_welcome_content_func' );
function rockon_welcome_content_func( $atts ) { 
   extract( shortcode_atts( array(
      'title' => 'something',
	  'content' => 'Mauris a massa id leo aliquam consequat porttitor vitae est. Proin ultricies velit sed porttitor viverra. Pellentesque eget tristique est. Donec volutpat, eros et bibendum lacinia, enim ipsum gravida enim, quis viverra odio elit sit amet orci. Aenean eget mi quam.'
   ), $atts ) );
	$result = '<div class="rock_welcome_note"><div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <h1 class="rock_welcome">'.__(esc_attr($title),'rockon').'</h1>
        <p>'.__(esc_attr($content),'rockon').'</p>
      </div>
      <div class="clearfix"></div>
      <div class="col-lg-12">
        <div class="rock_divider"></div>
      </div>
    </div></div>';
	return $result;
}
add_shortcode( 'rockon_track_post', 'rockon_track_post_func' );
function rockon_track_post_func( $atts ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'title' => 'something',
	  'no_of_post' => '3'
   ), $atts ) );
   $result = '';
   $result .= '<div class="rock_audio_player_wrapper"><div class="col-lg-12 col-md-12 col-sm-12"><div class="col-lg-6 col-md-6">';
   $args = array('post_type' => 'rockon_track','numberposts' => 1);
   $recent_postsresult = wp_get_recent_posts( $args, array() );
   global $post;
   $audio = $image = '';
   if(!empty($recent_postsresult)){
	   foreach( $recent_postsresult as $rst ){
			$result .= '<div class="rock_audio_player">
						<div class="rock_audio_player_title">'.esc_html(get_the_title($rst->ID)).'</div>
						<div class="rock_audio_player_track_image">'; 
			$id = get_post_meta( $rst->ID, 'rockon_image_src', true );	
			$image = wp_get_attachment_image_src($id, 'rockon_trackposterimg');
			if (!empty($image[0])){	
				$result .= '<img src="'.esc_url($image[0]).'" alt="track 1" />';
			}	
			$result .= '<div class="rock_audio_player_track_image_overlay">'.esc_html(get_the_title($rst->ID)).'</div>
						</div>
						<div class="audio-player">';
			$audio = get_post_meta( $rst->ID, 'rockon_audio_track', false );
			if (!empty($audio))
			{	
				$result .= '<audio class="rock_player" controls>';
				
					for($i=0;$i<count($audio);$i++){
						$src = wp_get_attachment_url($audio[$i]);
						$result .= '<source  src="'.esc_url($src).'"  type="audio/mpeg">';
					}
				
					$result .= '<object width="320" height="240" type="application/x-shockwave-flash" data="flashmediaelement.swf"><param name="movie" value="flashmediaelement.swf" /><param name="flashvars" value="controls=true&file=myvideo.mp4" /></object>';
				
				$result .= '</audio>';
			}       
			$result .= '</div>
					  </div>';
			$image = '';		  
	   }
   }
   $result .= '</div><div class="col-lg-6 col-md-6">';
	$result .= '<div class="rock_track_playlist">
	<h1>'.__(esc_attr($title),'rockon').'</h1>
	<ul class="rock_track_playlist_slider">';
	
	$audiosrcs = '';
	$track_query = new WP_Query( array( 'post_type' => 'rockon_track', 'posts_per_page' => $no_of_post) );
	if($track_query->have_posts()): 
		while($track_query->have_posts()) : $track_query->the_post();
			$result .= '<li>';
			$id = get_post_meta( $post->ID, 'rockon_image_src', true );	
			$image = wp_get_attachment_image_src($id, 'rockon_trackposterimg');
			$src = wp_get_attachment_image_src($id, 'rockon_trackposterthumbimg');
			if (!empty($src[0])){	
				$result .= '<img src="'.esc_url($src[0]).'" alt="track 1" />';
			}
			$audio = get_post_meta( $post->ID, 'rockon_audio_track', false );
			if (!empty($audio)){
				for($i=0;$i<count($audio);$i++){
					$audiosrcs .= wp_get_attachment_url($audio[$i]).',';					
				}
				$audiosrcs = rtrim($audiosrcs,',');
			}
			$result .= '<div class="rock_track_detail"> <a href="#" class="rock_track_title">'.esc_html(get_the_title($post->ID)).'</a><a class="rock_track_play btn btn-default btn-sm play_music" data-audio="'.esc_attr($audiosrcs).'" data-src="'.esc_attr($image[0]).'" data-title="'.esc_attr(get_the_title($post->ID)).'">Play</a>
			</div>
			</li>';
			$audiosrcs = $image = '';
		endwhile; 
	endif;
	 wp_reset_postdata();
	$result .= '</ul>
	<div class="rock_playlist_slider_control"> <span id="rock_track_playlist_slider_prev"></span> <span id="rock_track_playlist_slider_next"></span> </div>
	</div>';
	//$i = 0;
	/*$track_query = new WP_Query( array( 'post_type' => 'rockon_track', 'posts_per_page' => $no_of_post) );
	 if($track_query->have_posts()): 
		while($track_query->have_posts()) : $track_query->the_post();
		  $result .= '<div class="modal animated fadeInDown rockon_myModal'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel'.$i.'" aria-hidden="false">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title rock_audio_player_title" id="myModalLabel'.$i.'">'.__(get_the_title($post->ID),'rockon').'</h4>
                  </div>
                  <div class="modal-body">
                    <div class="rock_audio_player">
                      <div class="rock_audio_player_track_image">';
			$src = get_post_meta( $post->ID, 'rockon_image_src', true );;	
			if (!empty($src))
			{	
				$thumb_w = '558';
				$thumb_h = '280';
				$image = aq_resize($src, $thumb_w, $thumb_h, true);
				$result .= '<img src="'.esc_url($image).'" alt="">';
			}else{
				$image = ROCKON_PATH.'/images/no_image.jpg';
				$result .= '<img src="'.ROCKON_PATH.'/images/no_image.jpg" alt="" />';	
			}
            $result .= '<div class="rock_audio_player_track_image_overlay">'.__(get_the_title($post->ID),'rockon').'</div>
                      </div>
                      <div class="audio-player">';
			$audio = get_post_meta( $post->ID, 'rockon_audio_src', true );
			if (!empty($audio))
			{	
			$result .= '<audio class="rock_player" controls><source  src="'.esc_url($audio).'" type="audio/mpeg"></audio>';
			}
             $result .= '</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
		  $i++; 
	  endwhile; 
	 endif;*/
	 //wp_reset_postdata();
	 $result .= '</div></div></div>';
	return $result;
}
add_shortcode( 'rockon_team_post', 'rockon_team_post_func' );
function rockon_team_post_func( $atts ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'title' => 'something',
	  'no_of_post' => '8'
   ), $atts ) );
   $result = '';
   $result .= '<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="rock_heading_div">
        <div class="rock_heading">
          <h1>'.__(esc_attr($title),'rockon').'</h1>
          <p>X</p>
        </div>
      </div>
      <div class="rock_disc_jockcy">
        <div id="rock_disc_jockcy_slider" class="owl-carousel owl-theme">';
		$i = 0;
	  $club_query = new WP_Query( array( 'post_type' => 'disc_jockey_team', 'posts_per_page' => $no_of_post) );
	 if($club_query->have_posts()): 
		while($club_query->have_posts()) : $club_query->the_post();
          $result .= '<div class="rock_disc_jockcy_slider_item">'; 
		  //$image = get_the_post_thumbnail( $post->ID, 'rockon-team-img-size' );
		  if (has_post_thumbnail($post->ID))
		  {	
			$src = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) , 'full' );
			$thumb_w = '265';
			$thumb_h = '312';
			$image = aq_resize($src, $thumb_w, $thumb_h, true);
			$result .= '<img src="'.esc_url($image).'"  alt="">';
			//$result .= $image;
    	  }
		  $result .= '<a href="#rockondj'.$i.'" class="fancybox">
            <h4>'.__(get_the_title($post->ID),'rockon').'</h4>
            </a> </div>';
		 $i++;
		 $image = '';
		endwhile; 
	 endif; 	
	 wp_reset_postdata();
    $result .= '</div>
        <div class="customNavigation"> <a class="rock_slider_button  prev"><i class="fa fa-angle-left"></i></a> <a class="rock_slider_button  next"><i class="fa fa-angle-right"></i></a> </div>
      </div>
    </div>
  </div>';
	$i = 0;
	$club_query = new WP_Query( array( 'post_type' => 'disc_jockey_team', 'posts_per_page' => $no_of_post) );
	if($club_query->have_posts()): 
	while($club_query->have_posts()) : $club_query->the_post();
	  //$image = get_the_post_thumbnail( $post->ID, 'rockon-team-img-size' );
	  $result .= '<div id="rockondj'.$i.'" class="rock_dj_profile">
		<div class="row">
		  <div class="col-lg-6"> ';
		if (has_post_thumbnail($post->ID))
		{	
			$src = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) , 'full' );
			$thumb_w = '265';
			$thumb_h = '312';
			$image = aq_resize($src, $thumb_w, $thumb_h, true);
			$result .= '<img src="'.esc_url($image).'"  alt="">';
		}
		  $result .=' </div>
		  <div class="col-lg-6">
			<h2><i class="fa fa-headphones"></i> '.__(get_the_title($post->ID),'rockon').'</h2>
			<p>'.__(get_excerpt(550),'rockon').'</p>
		  </div>
		</div>
	  </div>';
	 $i++;
	  $image = '';
	endwhile; 
	endif; 	
	wp_reset_postdata();
	return $result;
}
add_shortcode( 'rockon_services_post', 'rockon_services_post_func' );
function rockon_services_post_func( $atts ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'title' => 'something',
	  'no_of_post' => '3',
	  'readmore' => ''
   ), $atts ) );
   $result = $image = $svg = '';
   global $post;
   $result .= '<div class="rockon_service_main">';
   $services_query = new WP_Query( array( 'post_type' => 'services', 'posts_per_page' => $no_of_post) );
   if($services_query->have_posts()): 	
   $result .= ' <div class="row">';
		while($services_query->have_posts()) : $services_query->the_post();	
			$result .= '<div class="col-lg-4 col-md-4 col-sm-4"><div class="rockon_service">';
			$image = get_the_post_thumbnail( $post->ID, 'rockon-small-very-size' );
			if (has_post_thumbnail($post->ID) && !empty($image))
			{	
				$result .= '<div class="rock_service_icon">'.$image.'</div>';
			}else{
				$svg = get_post_meta( $post->ID, 'rockon_svgiconcode', true );
				if(!empty($svg)){
					$result .= '<div class="rock_service_icon">'.$svg.'</div>';
				}else{
					$result .= '<div class="rock_service_icon"><img src="'.ROCKON_PATH.'/images/no_image.jpg" class="rockon_nothumservices" alt=""></div>';
				}	
			}	
			$result .= '<h3>'.__(get_the_title($post->ID),'rockon').'</h3>
			<p>'.__(get_excerpt(200),'rockon').'</p>
			 </div>
			</div>';	
			$image = '';	
		 endwhile; 
	$result .= '</div>';
	endif; 
	wp_reset_postdata();
	$result .= '</div>';
	return $result;
}
add_shortcode( 'rockonaboutpost', 'rockonaboutpost_func' );
function rockonaboutpost_func( $atts ) {
   extract( shortcode_atts( array(
      'title' => 'something',
	  'description' => '',
	  'no_of_post' => '3',
	  'post_type' => 'null'
   ), $atts ) );
   $result = '';
   $result .= '<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 rock_what_we_offer">
      <div class="rock_heading_div">
        <div class="rock_heading">
          <h1>'.__(esc_attr($title),'rockon').'</h1>
          <p>X</p>
        </div>
      </div>
      <div class="clearfix"></div>
      <p>'.__(esc_attr($description),'rockon').'</p>
    </div>
  </div>';
  global $post;
  $i = 0;
  if($post_type != 'null'){
  $query = new WP_Query( array( 'post_type' => $post_type, 'posts_per_page' => $no_of_post) );
	if($query->have_posts()):
		while($query->have_posts()) : $query->the_post();
			if($i%2==0){
				$result .= '<div class="row">';
			}
			$result .= '<div class="col-lg-6 col-md-6 col-sm-6">
			  <div class="rock_about_offer">';
				$image = get_the_post_thumbnail( $post->ID, 'rockon-small-very-size' );
				if (has_post_thumbnail($post->ID) && !empty($image))
				{	
					$result .= $image;
				}else{
					$svg = get_post_meta( $post->ID, 'rockon_svgiconcode', true );
					if(!empty($svg)){
						$result .= '<div class="rock_service_icon">'.$svg.'</div>';
					}
				}
			   $result .= '<a href="">
				<h3>'.__(get_the_title($post->ID),'rockon').'</h3>
				</a>
				<p>'.__(get_excerpt(150)).'</p>
			  </div>
			</div>';
			if($i%2!=0){
				$result .= '</div>';
			}
			$i++;
			$image = '';
		endwhile; 
	endif; 
	wp_reset_postdata();
	}
	return $result;
}
add_shortcode( 'rockon_portfolio_filter_shortchode', 'rockon_portfolio_filter_shortchode_func' );
function rockon_portfolio_filter_shortchode_func( $atts ) { 
	extract( shortcode_atts( array(
		'title' => 'something'
	), $atts ) );
	$result = '';
	$taxonomy = 'portfolio_categories';
	$categories = get_terms( $taxonomy, array( 'parent' => 0, ) );
	$image = $src = '';
	global $i;
	$i = 0;
	$result .= '<div class="clearfix"></div>
	<div class="rock_portfolio index_portfolio rockon_portfolio_width">
	  <div class="container"> 
		<!-- /.title -->
		<div id="portfolio_filter_slider">
		  <ul class="portfolio-filter portfolio_filter_slider">';
			if(count($categories) > 0)
			{    
				$result .= '<li> <a href="#" class="filter-item active" data-filter="all"> <img src="'.ROCKON_PATH.'/images/gallery/portfolio_mix.png" alt="" />
			  <p>'.__('All','rockon').'</p>
			  </a> </li>';
				foreach($categories as $category)
				{
					$catasclass = $category->name;
					$catasclass = preg_replace('/\s/', '', $catasclass); 
					$thumbnail_id = get_option( '_wpfifc_taxonomy_term_'.$category->term_id.'_thumbnail_id_' );
					$image = wp_get_attachment_image_src( $thumbnail_id );
					if(isset($image[0])){
						$src = $image[0];
					}
					$result .= '<li><a href="#" class="filter-item" data-filter="'.$category->name.'"><img src="'.esc_url($src).'" alt="" /><p>'.__(esc_attr($category->name),'rockon').'</p></a></li>'; 						
				} 
			}
	$result .= '</ul>
		</div>
		<!-- /portfolio-filter --> 
	  </div>
	</div>';
	$args = array(   
	  'post_type' => 'portfolio',
	  'posts_per_page' => -1
	);  
	$query = new WP_Query( $args );
	$result .= '<div class="container rock_margin_30">
	  <div class="clearfix"></div>
	  <div class="row portfolio-grid index_portfolio_content rock_margin_30" id="grid">';
	if ($query->have_posts()) :
		while ( $query->have_posts() ) : $query->the_post(); 
			global $post;
			$image = $attachment_url = $catname = $filetype = $src = $type = $a = $audiopop = '';
			global $i;
			$terms = get_the_terms( $post->ID, 'portfolio_categories' );
			$cats = array();
			if(is_array($terms))
			{   
				if(count($terms) > 0 )
				{
					foreach ( $terms as $term )
					{
						$cats[] = $term->name;
						$catname = join("  ",$cats);		
						$catname = preg_replace('/\s/',' ', $catname);
					}   
				} 	
			} 
			$result .= '<div class="col-md-4 col-sm-6 portfolio-item mix '.$catname.'">
				  <div class="rock_club_photo_slider_item">
					<div class="rock_club_photo_item">'; 
					if (has_post_thumbnail($post->ID)) {					
						$thumb = get_post_thumbnail_id($post->ID);
						$thumb_w = '360';
						$thumb_h = '273';
						$attachment_url = wp_get_attachment_url($thumb, 'full');
						$image = aq_resize($attachment_url, $thumb_w, $thumb_h, true);							
					}
			$result .= '<img src="'.esc_url($image).'" alt="" />';
			$src = get_post_meta( $post->ID, 'rockon_audio_src', true );
			if(!empty($src)){
				$filetype = wp_check_filetype($src);
				$type = $filetype['type'];
				if($type == 'audio/mpeg'){
					$a = '<a  class="fancybox" href="#rockongallery_audio'.$i.'">';
					$result .= '<div class="rock_audio_player" style="display:none;" id="rockongallery_audio'.$i.'">
			<div class="rock_audio_player_title"><span class="track_artist">'.__(get_the_title($post->ID),'rockon').'</span></div>
			<div class="rock_audio_player_track_image"> <img src="'.esc_url($attachment_url).'" alt="track 1" />
			 <div class="rock_audio_player_track_image_overlay">'.__(get_the_title($post->ID),'rockon').'</div>
			</div>
			<div class="audio-player">
			 <audio class="rock_player" controls><source src="'.esc_url($src).'" type="audio/mpeg" ></audio>
			</div>
			</div>';
				}else{
					$vi = 'https:'.$src;
					$a = '<a class="fancybox-video iframe" data-fancybox-group="group3" href="'.esc_url($vi).'">';
				}
			}else{
				$a = '<a class="fancybox" data-fancybox-group="group1" href="'.esc_url($attachment_url).'">';
			}
			$result .= '<div class="rock_club_photo_overlay" >
						<div class="photo_link animated fadeInDown"> '.$a.' <i class="fa fa-search-plus"></i></a> <a class="main_gallery_item_link" href="'.esc_url(get_the_permalink($post->ID)).'"><i class="fa fa-link"></i></a> </div>
						<a class="rock_club_photo_detail animated fadeInUp" href="">'.__(get_the_title($post->ID),'rockon').'</a> </div>
					</div>
				  </div>
				</div>';
			$i++;
		endwhile;
	endif;
	$result .= '<!-- /.col-md-4 portfolio-item mix --> 
	  </div>
	</div>';
	wp_reset_postdata();
}
add_shortcode( 'rockon_gallery_shortchode', 'rockon_gallery_club_post_func' );
function rockon_gallery_club_post_func( $atts ) { 
   extract( shortcode_atts( array(
      'title' => 'something',
	  'no_of_column' => '2',
	  'no_of_post' => '8',
	  'post_type' => 'portfolio',
	  'category' => 'null'
   ), $atts ) );
   global $post;
   $result = '';
   $src = $openpostdesc = $a = $fancyaudio = $image1 = $image2 = '';
   $i = $j = 0;
   $result .= '<div class="clearfix"></div>
	<div class="rock_main_gallery">
		<div class="main_gallery">
			<div id="photo_tab" class="main_gallery_tab_content animated fadeInDown">';
	if($category != 'null'){
		$args = array(
		  'post_type' => $post_type,
		  'tax_query' => array(
				array(
					'taxonomy' => 'portfolio_categories',
					'field' => 'slug',
					'terms' => $category,
				)
			),
		  'posts_per_page' => $no_of_post
		);	
	}else{
		$args = array( 'post_type' => $post_type, 'posts_per_page' => $no_of_post); 
	}
	$query = new WP_Query( $args );
	if($query->have_posts()):	
		while($query->have_posts()) : $query->the_post();
			if($i == $j){
				$result .= '<div class="row">';
				if($no_of_column == '2'){
					$j = $j + 2;
				}elseif($no_of_column == '3'){
					$j = $j + 3;
				}elseif($no_of_column == '4'){
					$j = $j + 4;
				}
			}
			if (has_post_thumbnail($post->ID)){	
				$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) , 'full' );
				if($no_of_column == '2'){
					$thumb_w = '560';
					$thumb_h = '420';
					$image1 = aq_resize($image, $thumb_w, $thumb_h, true);
					$thumb_w = '630';
					$thumb_h = '470';
					$image2 = aq_resize($image, $thumb_w, $thumb_h, true);
				}elseif($no_of_column == '3'){
					$thumb_w = '371';
					$thumb_h = '280';	
					$image1 = aq_resize($image, $thumb_w, $thumb_h, true);
					$thumb_w = '630';
					$thumb_h = '470';
					$image2 = aq_resize($image, $thumb_w, $thumb_h, true);
				}elseif($no_of_column == '4'){
					$thumb_w = '277';
					$thumb_h = '210';
					$image1 = aq_resize($image, $thumb_w, $thumb_h, true);
					$thumb_w = '630';
					$thumb_h = '470';
					$image2 = aq_resize($image, $thumb_w, $thumb_h, true);
				}
			}
			if($no_of_column == '2'){
				$result .='<div class="col-lg-6 col-md-6 col-sm-6 main_gallery_item">';
			}elseif($no_of_column == '3'){
				$result .='<div class="col-lg-4 col-md-4 col-sm-4 main_gallery_item">';
			}elseif($no_of_column == '4'){
				$result .='<div class="col-lg-3 col-md-3 col-sm-3 main_gallery_item">';
			}
				$result .= '<div class="rock_club_photo_slider_item">
					  <div class="rock_club_photo_item">';
			//$image = get_the_post_thumbnail( $post->ID, 'rockon-common-size' );
			$audiosrc = get_post_meta( $post->ID, 'rockon_audio_src', true );
			if (has_post_thumbnail($post->ID)){	
				$result .= '<img src="'.esc_url($image1).'" alt="">';
				$src = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) , 'full' );
			}else{
				$result .= '<img src="'.ROCKON_PATH.'/images/no_image.jpg" alt="">';
				$src = ROCKON_PATH.'/images/no_image.jpg"';
			}
			if(!empty($audiosrc)){
				$filetype = wp_check_filetype($audiosrc);
				$type = $filetype['type'];
				if($type == 'audio/mpeg'){
					$thumb_w = '525';
					$thumb_h = '280';
					$src = aq_resize($src, $thumb_w, $thumb_h, true);
					$a = '<a class="fancybox" href="#rockongallery_audio'.$i.'">';
					$fancyaudio = '<div class="rock_audio_player" style="display:none;" id="rockongallery_audio'.$i.'">
<div class="rock_audio_player_title"><span class="track_artist">'.esc_html(get_the_title($post->ID)).'</span></div>
<div class="rock_audio_player_track_image"> <img src="'.esc_url($src).'" alt=""/>
  <div class="rock_audio_player_track_image_overlay">'.esc_html(get_the_title($post->ID)).'</div>
</div>
<div class="audio-player">
  <audio class="rock_portfolio_player" controls><source src="'.esc_url($audiosrc).'" type="audio/mpeg"></audio>
</div>
</div>';
				}else{
					$url = rockoncore_parseVideoURL($audiosrc);
					$a = '<a class="fancybox-video iframe" href="'.esc_url($url).'">';
				}
			}else{
				$a = '<a class="fancybox" data-fancybox-group="group1" href="'.esc_url($src).'">';	
			}		
				$result .= '<div class="rock_club_photo_overlay">
						  <div class="photo_link animated fadeInDown">'.$a.' <i class="fa fa-search-plus"></i></a> <a class="main_gallery_item_link" id="rockon_sha_photo'.$i.'"><i class="fa fa-link"></i></a> </div>
						  <a class="rock_club_photo_detail animated fadeInUp" href="'.esc_url(get_the_permalink($post->ID)).'">'.__(get_the_title($post->ID),'rockon').'</a> </div>
					  </div>
					</div>';
			$result .= '</div>';
			$result .= $fancyaudio;
			$fancyaudio = '';
			if(!empty($audiosrc)){
					$filetype = wp_check_filetype($audiosrc);
					$type = $filetype['type'];
				if($type == 'audio/mpeg'){
						$openpostdesc .= '<div class="main_gallery_item_popup audio_popup rockon_sha_photo'.$i.'">
					<div class="row">
					  <div class="col-lg-12 col-md-12 col-sm-12">
							<div class="col-lg-7 col-md-7 col-sm-10 col-lg-offset-0 col-md-offset-0 col-sm-offset-1">';
						if (has_post_thumbnail($post->ID))
						{	
							$openpostdesc .= '<img src="'.esc_url($image2).'" alt="">';
							$src = wp_get_attachment_image( $post->ID, 'full' );
						}else{
							$openpostdesc .= '<img src="'.ROCKON_PATH.'/images/no_image.jpg" alt="">';
							$src = ROCKON_PATH.'/images/no_image.jpg"';
						}	
						 $openpostdesc .= '<div class="rock_audio_player"><div class="audio-player">
                      <audio class="rock_portfolio_player" controls><source src="'.esc_url($audiosrc).'" type="audio/mpeg"></audio>
                    </div></div>';	
				   $openpostdesc .=  '</div><div class="col-lg-5 col-md-5 col-sm-10 col-lg-offset-0 col-md-offset-0 col-sm-offset-1"> <a href="">
						  <h1>'.__(get_the_title($post->ID),'rockon').'</h1>
						  </a>
						  <p>'.__(get_excerpt(300),'rockon').'</p>
						  <a href="'.esc_url(get_the_permalink($post->ID)).'" class="btn btn-arrow btn-4a icon-arrow-right">Read More</a>
						</div>
					  </div>
					</div>
					<a class="main_gallery_item_popup_close">X</a> </div>';
				}else{ 
				$openpostdesc .= '<div class="main_gallery_item_popup video_popup rockon_sha_photo'.$i.'">
				<div class="row">
				  <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="rock_audio_player rock_video_player">
                  <div class="audio-player">
                    <video width="640" height="400" style="width: 100%; height: 100%;">
                      <source type="video/youtube" src="'.esc_attr($audiosrc).'" />
                    </video>
                  </div>
                  </div>
				  </div>
				</div>
				<a class="main_gallery_item_popup_close">X</a> </div>';
				}
			}else{
				$openpostdesc .= '<div class="main_gallery_item_popup rockon_sha_photo'.$i.'">
				<div class="row">
				  <div class="col-lg-12 col-md-12 col-sm-12">
					<div class="col-lg-7 col-md-7 col-sm-10 col-lg-offset-0 col-md-offset-0 col-sm-offset-1">';
					if (has_post_thumbnail($post->ID))
					{	
						$openpostdesc .= '<img src="'.esc_url($image2).'" alt="">';
						$src = wp_get_attachment_image( $post->ID, 'full' );
					}else{
						$openpostdesc .= '<img src="'.ROCKON_PATH.'/images/no_image.jpg" alt="">';
						$src = ROCKON_PATH.'/images/no_image.jpg"';
					}		 
			   $openpostdesc .=  '</div><div class="col-lg-5 col-md-5 col-sm-10 col-lg-offset-0 col-md-offset-0 col-sm-offset-1"> <a href="">
					  <h1>'.__(get_the_title($post->ID),'rockon').'</h1>
					  </a>
					  <p>'.__(get_excerpt(300),'rockon').'</p>
					<a href="'.esc_url(get_the_permalink($post->ID)).'" class="btn btn-arrow btn-4a icon-arrow-right">Read More</a>
					</div>
				  </div>
				</div>
				<a class="main_gallery_item_popup_close">X</a> </div>';
			}
		if(($i+1) == $j){
			$result .= $openpostdesc;	
			$openpostdesc = '';
			$result .= '</div>';
		}
			$i++;
		endwhile; 
	endif;
	wp_reset_postdata();
	if(($i+1) <= $j){
		$result .= $openpostdesc;	
		$openpostdesc = '';
		$result .= '</div>';
	}
	$result .= '
			</div>
		</div>
	</div>';
	return $result;
}
add_shortcode( 'rockon_club_post', 'rockon_club_post_func' );
function rockon_club_post_func( $atts ) { // New function parameter $content is added!
   extract( shortcode_atts( array(
      'title' => 'something',
	  'no_of_row' => '2',
	  'no_of_post' => '8'
   ), $atts ) );
   $result = '';
   global $post;
   $result .= '<div class="rock_heading_div">
        <div class="rock_heading">
          <h1>'.__(esc_attr($title),'rockon').'</h1>
          <p>X</p>
        </div>
      </div>
      <div class="rock_club_photo">
        <div id="rock_club_photo_slider" class="owl-carousel owl-theme">';
	 $j = $i = 0;
	 $club_query = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => $no_of_post) );
	 if($club_query->have_posts()): 
		while($club_query->have_posts()) : $club_query->the_post();
		 if($j == $i){
          $result .= '<div class="rock_club_photo_slider_item">';
		  $j = $j + $no_of_row;
		 }
            $result .= '<div class="rock_club_photo_item">';
				$src = '';
				if (has_post_thumbnail($post->ID))
				{	
					$thumb = get_post_thumbnail_id($post->ID);
					$thumb_w = '380';
					$thumb_h = '283';
					$src = wp_get_attachment_url($thumb, 'full');
					$image = aq_resize($src, $thumb_w, $thumb_h, true);
					$result .= '<img src="'.esc_url($image).'"  alt="">';
				}else{
					$src = ROCKON_PATH.'/images/no_image.jpg';
					$result .= '<img src="'.ROCKON_PATH.'/images/no_image.jpg" alt="">';
				}
				$result .= '<div class="rock_club_photo_overlay">
                <div class="photo_link animated fadeInDown"> <a href="'.esc_url(get_permalink($post->ID)).'"><i class="fa fa-link"></i></a> <a class="fancybox" data-fancybox-group="group1" href="'.esc_url($src).'"><i class="fa fa-search-plus"></i></a> </div>
                <a class="rock_club_photo_detail animated fadeInUp" href="'.esc_url(get_permalink($post->ID)).'">'.__(get_the_title($post->ID),'').'</a> </div>';
            $result .= '</div>';
		 if(($j-1) == $i){
          $result .= '</div>';
		 }
		 $i++;
		endwhile; 
	 endif; 
	 wp_reset_postdata();
     $result .= '</div><div class="customNavigation"> <a class="rock_slider_button prev"><i class="fa fa-angle-left"></i></a> <a class="rock_slider_button next"><i class="fa fa-angle-right"></i></a> </div>
      </div>';
	return $result;
}
add_shortcode( 'rockon_contact_post', 'rockon_contact_post_func' );
function rockon_contact_post_func( $atts ) {
   extract( shortcode_atts( array( 
	'title' => 'title'
   ), $atts ) );
   global $rockon_data;
	$mapon = $rockon_data['rockon_contactmaponoff'];
	$maptitle = $rockon_data['rockon_maptitle'];
	$mapaddrs = $rockon_data['rockon_Latitude_Longitude']; 
	$weburl = esc_attr($rockon_data['rockon_contactweburl']); 
	$contactphone = esc_attr($rockon_data['rockon_contactphone']); 
	$contactemail = esc_attr($rockon_data['rockon_contactemail']);  
	$contactaddress = esc_attr($rockon_data['rockon_contactaddress']);
	$fields = $rockon_data['rockon_fieldsenable_disable'];
	$require = $rockon_data['rockon_fieldsrequire'];
	$mapzoom = $rockon_data['rockon_mapzoom'];
	$validate = '';
	$result = '';
	$result .= '<div class="container">';
		$result .= '<div class="rock_contact">';
		$result .= '<div class="row">';
		$result .= '<div class="col-lg-5 col-md-5 col-sm-5">';
        $result .= '<form id="rockon_contactform" method="post">';
		$result .= '<input type="hidden" value="'.ROCKON_AJAX_URL.'"  id="rockon_ajaxurl">';
		foreach($fields['ENABLE'] as $key=>$val){
			switch($key){
				case 'NAME':
					if(isset($require['REQUIRE']['NAME'])){
						$validate = 'data-validation="required"';
					}
				  $result .= '<div class="form-group">
				  <input type="text" '.$validate.' value="" placeholder="'.__('Name','rockon').'" name="name" class="form-control"/></div>';
				break;
				case 'EMAIL' :
					if(isset($require['REQUIRE']['EMAIL'])){
						$validate = 'data-validation="email"';
					}
					$result .= '<div class="form-group"><input value="" placeholder="'.__('Email','rockon').'"  type="text" name="email" '.$validate.' class="form-control"/></div>';
				break;
				case 'PHONENUMBER' :
					if(isset($require['REQUIRE']['PHONENUMBER'])){
						$validate = 'data-validation="number"';
					}
					$result .= '<div class="form-group"><input type="text" value="" placeholder="'.__('Phone No','rockon').'" name="phono" '.$validate.' class="form-control"/></div>';
				break;
				case 'WEBSITE':
					if(isset($require['REQUIRE']['WEBSITE'])){
						$validate = 'data-validation="url"';
					}
					$result .= '<div class="form-group"><input value="" placeholder="'.__('Weburl','rockon').'"  type="text" '.$validate.' name="web" class="form-control"/></div>';
				break;
				case 'MESSAGE' :
					if(isset($require['REQUIRE']['MESSAGE'])){
						$validate = 'data-validation="required"';
					}
					 $result .= '<div class="form-group"><textarea name="Message" id="Message" '.$validate.' class="form-control" rows="10" placeholder="'.__('Your Message','rockon').'"></textarea></div>';
				break;	
			}
			$validate = '';
		}
		$result .= '<input type="submit" id="em_sub" class="btn btn-default btn-lg" value="'.__('Submit Your Message','rockon').'">
          <p id="rockon_infotext"></p>
        </form>
      </div>
      <div class="col-lg-7 col-md-7 col-sm-7">
        <div class="rock_contact_detail">
          <div>
            <p><i class="fa fa-envelope"></i> <a href="mailto:'.esc_attr($contactemail).'">'.esc_html($contactemail).'</a></p>
            <p><i class="fa fa-mobile"></i> <a href="">+'.esc_attr($contactphone).'</a></p>
          </div>
          <div>
            <p><i class="fa fa-map-marker"></i> <a href="">'.esc_attr($contactaddress).'</a></p>
            <p><i class="fa fa-globe"></i> <a href="#">'.esc_attr($weburl).'</a></p>
          </div>
        </div>
        <div class="rock_map">';
		if($mapon == '1'){
			$result .= '<script>
var myCenter=new google.maps.LatLng('.esc_js($mapaddrs).');
function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:'.esc_js($mapzoom).',
  scrollwheel: false,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };
var map=new google.maps.Map(document.getElementById("rockon_googleMap"),mapProp);
var marker=new google.maps.Marker({
  position:myCenter,
   map: map,
  title: \''.esc_js($maptitle).'\'
  });
marker.setMap(map);
var infowindow = new google.maps.InfoWindow({
  content:""
  });
google.maps.event.addListener(marker, \'click\', function() {
  infowindow.open(map,marker);
  });
}
google.maps.event.addDomListener(window, \'load\', initialize);
</script>';
			$result .= '<div id="rockon_googleMap" style="width:100%;height:355px;"></div>';
		}
		$result .= '</div>
			  </div>
			</div>
		  </div>
		</div>';
	return $result;
}
add_shortcode( 'rockon_event_shortchode', 'rockon_event_shortchode_func' );
function rockon_event_shortchode_func( $atts ) { 
   extract( shortcode_atts( array(
	  'title' => 'Title',	
	  'no_of_post' => '8',
	  'event_look' => 'simple',
   ), $atts ) );
   global $post;
   $i = 0;
   $result = $src = $date = $Ftime = $Ttime = $map = $ln_mon = '';
   if($event_look == 'simple'){
	   $result .= '<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12">';	
		$today = date('m/d/Y');
		$argrs = array(
			'post_type' => 'rockon_event',
			'meta_key'  => 'rockon_event_sysdate',
			'meta_query' => array(
				array(
					'key' => 'rockon_event_sysdate',
					'value' => $today,
					'compare' => '>='
				)
			),
			'orderby'   => 'meta_value',
			'order'     => 'ASC',
			'posts_per_page' => $no_of_post
		);
		$query = new WP_Query( $argrs );
		if($query->have_posts()):	
			while($query->have_posts()) : $query->the_post();
			$result .= '<div class="col-lg-6 col-md-6 col-sm-6">
			<div class="rock_main_event">
			  <div class="rock_main_event_image">';
				if (has_post_thumbnail($post->ID)){	
					$src = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) , 'full' );
					$thumb_w = '540';
					$thumb_h = '307';
					$image = aq_resize($src, $thumb_w, $thumb_h, true);
				}else{
					$image = ROCKON_PATH.'/images/no_image.jpg';
				}
				$date = get_post_meta( $post->ID, 'rockon_event_sysdate', true );
				$Ftime = get_post_meta( $post->ID, 'rockon_event_systimefrom', true );
				$Ttime =  get_post_meta( $post->ID, 'rockon_event_systimeto', true );
				$desc =  get_post_meta( $post->ID, 'rockon_event_sysdesc', true );
				$loc =  get_post_meta( $post->ID, 'rockon_event_sysloaction', true );
				$map =  get_post_meta( $post->ID, 'rockon_event_syscomma', true );
				//$map = explode(',',$map);
				global $rockon_data;
				if(isset($rockon_data['rockon_language']))
					setlocale(LC_TIME, $rockon_data['rockon_language']);
				$ln_mon = strftime("%B",strtotime($date));
			  $result .= '<img src="'.esc_url($image).'" alt="" /><div class="rock_main_event_image_overlay">
				</div>
			  </div>
			  <div class="rock_main_event_detail">
				<div class="rock_event_date">
				  <div class="event_date">
					<h1>'.date('d',strtotime($date)).'</h1>
					<p>'.esc_attr($ln_mon).'</p>
				  </div>
				</div>
				<h2><a href="'.esc_url(get_the_permalink($post->ID)).'">'.__(get_the_title($post->ID),'rockon').'</a></h2>
				<div class="blog_entry_meta">
				  <ul>
					<li><a href=""><i class="fa fa-clock-o"></i> '.esc_attr($Ftime).' - '.esc_attr($Ttime).'</a></li>
					<li><a href="'.esc_url('https://maps.google.com/maps?q='.$map).'" target="_blank"><i class="fa fa-map-marker"></i> '.__(esc_attr($loc),'rockon').'</a></li>
				  </ul>
				</div>
				<p>'.esc_attr($desc).'</p>
			  </div>
			</div>
		  </div>';
		  $i++;
			if($i%2 == 0){
				$result .= '<div class="clearfix"></div>';
			}
		  endwhile; 
		endif;
	   $result .= '</div></div>';	
   }else{
   $i = 0;
   $cls = 'class="active"';
   $today = date('m/d/Y');
	$argrs = array(
		'post_type' => 'rockon_event',
		'meta_key'  => 'rockon_event_sysdate',
		'meta_query' => array(
			array(
				'key' => 'rockon_event_sysdate',
				'value' => $today,
				'compare' => '>='
			)
		),
		'orderby'   => 'meta_value',
		'order'     => 'ASC',
		'posts_per_page' => $no_of_post
	);
	$query = new WP_Query( $argrs );
	 $result .= '<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="rock_heading_div">
            <div class="rock_heading">
              <h1>'.__(esc_attr($title),'rockon').'</h1>
              <p>X</p>
            </div>
          </div>
          <div class="rock_event">
            <div class="rock_event_tab">
              <ul>';
		if($query->have_posts()):	
			while($query->have_posts()) : $query->the_post();
				$date = get_post_meta( $post->ID, 'rockon_event_sysdate', true );
				global $rockon_data;
				if(isset($rockon_data['rockon_language']))
					setlocale(LC_TIME, $rockon_data['rockon_language']);
				$ln_mon = strftime("%B",strtotime($date));
                 $result .= '<li><a href="#tab'.$i.'" '.$cls.'>
                  <p class="rock_event_date">'.date('d',strtotime($date)).'</p>
                  <p class="rock_event_month">'.esc_attr($ln_mon).'</p>
                  </a></li>';
				  $i++;
				  $cls = '';
		   endwhile; 
		endif;
        $result .= '</ul>
            </div>';
		$i = 0;
		if($query->have_posts()):	
			while($query->have_posts()) : $query->the_post();
				$desc =  get_post_meta( $post->ID, 'rockon_event_sysdesc', true );
				$result .= '<div class="rock_event_tab_content_main">
					  <div id="tab'.$i.'" class="rock_event_tab_content">
						<div class="row">
						  <div class="col-lg-7 col-md-12 col-sm-12">'; 
				if (has_post_thumbnail($post->ID))
				{	
					$thumb = get_post_thumbnail_id($post->ID);
					$thumb_w = '674';
					$thumb_h = '487';
					$src = wp_get_attachment_url($thumb, 'full');
					$image = aq_resize($src, $thumb_w, $thumb_h, true);
					$result .= '<img class="animated fadeInLeft" src="'.esc_url($image).'" alt="">';
				}else{
					$result .= '<img src="'.ROCKON_PATH.'/images/no_image.jpg" class="rockon_nothumservices" class="animated fadeInLeft" alt="">';
				}
				$date = get_post_meta( $post->ID, 'rockon_event_sysdate', true );
				$Ftime = get_post_meta( $post->ID, 'rockon_event_systimefrom', true );
				$Ttime =  get_post_meta( $post->ID, 'rockon_event_systimeto', true );
				$loc =  get_post_meta( $post->ID, 'rockon_event_sysloaction', true );
				$map =  get_post_meta( $post->ID, 'rockon_event_syscomma', true );
				$result .= '</div>
						  <div class="col-lg-5 col-md-12 col-sm-12">
							<div class="rock_event_detail animated fadeInLeft">
							  <h1><a href="'.esc_url(get_the_permalink($post->ID)).'">'.__(get_the_title($post->ID),'rockon').'</a></h1>
							  <p>'.esc_attr($desc).'</p>
							  <div class="blog_entry_meta">
							  <ul>
								<li><a href=""><i class="fa fa-clock-o"></i> '.esc_attr($Ftime).' - '.esc_attr($Ttime).'</a></li>
								<li><a href="'.esc_url('https://maps.google.com/maps?q='.$map).'" target="_blank"><i class="fa fa-map-marker"></i> '.__(esc_attr($loc),'rockon').'</a></li>
							  </ul>
							</div>
							</div>
						  </div>
						</div>
					  </div>
					</div>';
			$i++;
		  endwhile; 
		endif;
      $result .= '<div class="clearfix"></div>
          </div>
        </div>
      </div>';
   }
   wp_reset_postdata();
   return $result;   
}
?>