<?php
/*********** Sent Mail ***********/
add_action( 'wp_ajax_rockon_sndadminmail', 'rockon_sndadminmail' );
add_action( 'wp_ajax_nopriv_rockon_sndadminmail', 'rockon_sndadminmail' );
function rockon_sndadminmail(){
	global $rockon_data;
	$message = '';
	$to = $rockon_data['rockon_contactemailaddrs'];
	if(isset($_POST['name'])){
		$nm = $_POST['name'];
		$message .= "NAME : ".$_POST['name']."\n";
	}
	if(isset($_POST['email'])){
		$email = $_POST['email'];
		$message .= "EMAIL : ".$_POST['email']."\n";
	}
	if(isset($_POST['phono'])){
		$phone = $_POST['phono'];
		$message .= "NUMBER : ".$_POST['phono']."\n";
	}
	if(isset($_POST['web'])){
		$web = $_POST['web'];
		$message .= "WEB : ".$_POST['web']."\n";
	}
	if(isset($_POST['Message'])){
		$meg = $_POST['Message'];
		$message .= "MESSAGE : ".$_POST['Message'];
	}
	$message .= "\n\n";
	$header = "From: rockon@example.com\r\n"; 
	$header.= "MIME-Version: 1.0\r\n"; 
	$header.= "Content-Type: text/plain; charset=utf-8\r\n"; 
	$header.= "X-Priority: 1\r\n"; 
	$sub = "Inquiry rockon";
	if(mail($to,$sub,$message,$header)){
		$meg = $rockon_data['rockon_successmessage'];
	}
	else{
		$meg = "Sorry. your mail has not been send successfully."; 
	}
	echo __(esc_attr($meg),'rockon');
	die();
}
/*********** Sent Mail ***********/
/*********** Style Switcher ***********/
add_action( 'wp_ajax_rockon_style_swticher_setting', 'rockon_style_swticher_setting' );
add_action( 'wp_ajax_nopriv_rockon_style_swticher_setting', 'rockon_style_swticher_setting' );
function rockon_style_swticher_setting(){
	global $current_user;
	get_currentuserinfo();
	$user_info= get_userdata( $current_user->ID );
	$lvl=$user_info->user_level;     
	if ($lvl == '8' || $lvl == '9' || $lvl == '10')
	{
		global $rockon_data;
		if(isset($rockon_data['rockon_cssversion']) && $rockon_data['rockon_cssversion'] == 'dark'){
			if(isset($_POST['colorcssfile_url'])){
				$color = $_POST['colorcssfile_url'];
				global $sampleReduxFramework;
				$sampleReduxFramework = new Redux_Framework_sample_config();
				$sampleReduxFramework->ReduxFramework->set('rockon_style_switcher_color', $color);
				//echo 'Successful change color';
			}else{
				$pattern = $_POST['patterncssfile_url'];
				global $sampleReduxFramework;
				$sampleReduxFramework = new Redux_Framework_sample_config();
				$sampleReduxFramework->ReduxFramework->set('rockon_style_switcher_background', $pattern);
				//echo 'Successful change pattern';
			}
		}else{
			if(isset($_POST['colorcssfile_url'])){
				$color = $_POST['colorcssfile_url'];
				global $sampleReduxFramework;
				$sampleReduxFramework = new Redux_Framework_sample_config();
				$sampleReduxFramework->ReduxFramework->set('rockon_style_switcher_color_l', $color);
				//echo 'Successful change color';
			}else{
				$pattern = $_POST['patterncssfile_url'];
				global $sampleReduxFramework;
				$sampleReduxFramework = new Redux_Framework_sample_config();
				$sampleReduxFramework->ReduxFramework->set('rockon_style_switcher_background_l', $pattern);
				//echo 'Successful change pattern';
			}
		}
	}
	die();
}
/*********** Style Switcher ***********/
?>