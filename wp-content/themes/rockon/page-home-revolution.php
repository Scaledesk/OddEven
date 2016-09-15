<?php
/*
Template Name: Home Revolution Page
*/
get_header(); 
global $rockon_data;
$titl = $des = $pos = $row = '';
	/*********** Welcome note and serveices Start *************/
	echo '<div class="rockon_container rockon_home_container">';
	/* Welcome Content */
	if(isset($rockon_data['rockon_wel_title'])){
		$titl = $rockon_data['rockon_wel_title'];
	}
	if(isset($rockon_data['rockon_wel_desc'])){
		$des = $rockon_data['rockon_wel_desc'];
	}
	$content = '[rockon_welcome_content title="'.esc_attr($titl).'" content="'.esc_attr($des).'"]';
	if($titl != '' && $des != ''){
		echo '<div class="container">';
		echo do_shortcode( $content );
		echo '</div>';
	}
$titl = $des = $pos = $row = '';
	/* Serveice section */
	if(isset($rockon_data['rockon_sevices_title'])){
		$titl = $rockon_data['rockon_sevices_title'];
	}
	if(isset($rockon_data['rockon_sevices_post'])){
		$pos = $rockon_data['rockon_sevices_post'];
	}
	if($titl != '' && $pos != ''){
		echo '<div class="container">';
		echo '<div class="rock_heading_div">
		<div class="rock_heading">
		  <h1>'.esc_html($titl).'</h1>
		  <p>X</p>
		</div>
	  </div>';
		$content = '[rockon_services_post title="'.esc_attr($titl).'" no_of_post="'.esc_attr($pos).'"]';
		echo do_shortcode( $content );
		echo '</div>';
		echo '<div class="clearfix"></div>';
	}
$titl = $des = $pos = $row = '';
	/*********** Welcome note and serveices End *************/
	/* Event section */
	echo '<div class="rock_service_div">';
	echo '<div class="container">';
	if(isset($rockon_data['rockon_event_title'])){
		$titl = $rockon_data['rockon_event_title'];
	}
	if(isset($rockon_data['rockon_event_post'])){
		$pos = $rockon_data['rockon_event_post'];
	}
	$content = '[rockon_event_shortchode title="'.esc_attr($titl).'" no_of_post="'.esc_attr($pos).'" event_look="slider"]';
	if($titl != '' && $pos != ''){
		echo do_shortcode( $content );
	}
$titl = $des = $pos = $row = '';
	echo '<div class="clearfix"></div>';
	/* Portfolio section */
	if(isset($rockon_data['rockon_portfolio_title'])){
		$titl = $rockon_data['rockon_portfolio_title'];
	}
	if(isset($rockon_data['rockon_portfolio_post'])){
		$pos = $rockon_data['rockon_portfolio_post'];
	}
	if(isset($rockon_data['rockon_portfolio_row'])){
		$row = $rockon_data['rockon_portfolio_row'];
	}
	$content = '[rockon_club_post title="'.esc_attr($titl).'" no_of_post="'.esc_attr($pos).'" no_of_row="'.esc_attr($row).'"]';
	if($titl != '' && $pos != '' && $row != ''){
		echo do_shortcode( $content );
	}
$titl = $des = $pos = $row = '';
	echo '<div class="clearfix"></div>';
	/* Audio Track section */
	if(isset($rockon_data['rockon_audiotrack_title'])){
		$titl = $rockon_data['rockon_audiotrack_title'];
	}
	if(isset($rockon_data['rockon_audiotrack_post'])){
		$pos = $rockon_data['rockon_audiotrack_post'];
	}
	$content = '[rockon_track_post title="'.esc_attr($titl).'" no_of_post="'.esc_attr($pos).'" ]';
	if($titl != '' && $pos != ''){
		echo do_shortcode( $content );
	}
	echo '</div>';
	echo '</div>';
	echo '</div>';
get_footer();
?>