<?php 
global $rockon_data; 
function dark_style_switcher(){ 
echo '<!-- color picker start --><div id="style-switcher" class="hs_color_set"><div><h3>color options</h3><ul class="colors"><li> <p class="colorchange" id="dark_color1"></p> </li> <li> <p class="colorchange" id="dark_color2"></p> </li> <li> <p class="colorchange" id="dark_color3"></p> </li> <li> <p class="colorchange" id="dark_color4"></p> </li> <li> <p class="colorchange" id="dark_color5"></p> </li> <li> <p class="colorchange" id="style"></p> </li> </ul> <h3>Background Pattern</h3> <ul class="pattern"> <li> <p class="pattern_change" id="dark_pattern1"></p> </li> <li> <p class="pattern_change" id="dark_pattern2"></p> </li> <li> <p class="pattern_change" id="dark_pattern3"></p> </li> <li> <p class="pattern_change" id="dark_pattern4"></p> </li> <li> <p class="pattern_change" id="dark_pattern5"></p> </li> </ul> </div> <div class="bottom"> <a class="settings"><i class="fa fa-gear"></i></a> </div> </div> <input type="hidden" value="'.ROCKON_AJAX_URL.'"  id="rockon_style_ajaxurl"><input type="hidden" value="'.ROCKON_PATH.'"  id="rockon_style_siteurl"> <!-- color picker end --> '; } 
function light_style_switcher(){ 
echo '<!-- color picker start --><div id="style-switcher" class="rockon_light_color_option"><div><h3>color options</h3><ul class="colors"><li> <p class="colorchange" id="light_color1"></p> </li> <li> <p class="colorchange" id="light_color2"></p> </li> <li> <p class="colorchange" id="light_color3"></p> </li> <li> <p class="colorchange" id="light_color4"></p> </li> <li> <p class="colorchange" id="light_color5"></p> </li> <li> <p class="colorchange" id="style_light_version"></p> </li> </ul> <h3>Background Pattern</h3> <ul class="pattern"> <li> <p class="pattern_change" id="light_pattern1"></p> </li> <li> <p class="pattern_change" id="light_pattern2"></p> </li> <li> <p class="pattern_change" id="light_pattern3"></p> </li> <li> <p class="pattern_change" id="light_pattern4"></p> </li> <li> <p class="pattern_change" id="light_pattern5"></p> </li> </ul> </div> <div class="bottom"> <a class="settings"><i class="fa fa-gear"></i></a> </div> </div> <input type="hidden" value="'.ROCKON_AJAX_URL.'"  id="rockon_style_ajaxurl"><input type="hidden" value="'.ROCKON_PATH.'"  id="rockon_style_siteurl"> <!-- color picker end --> '; } 
global $current_user;
wp_get_current_user();
$user_info= get_userdata( $current_user->ID );    
if (isset($user_info->user_level) && ($user_info->user_level == '8' || $user_info->user_level == '9' || $user_info->user_level == '10'))
{
	if(isset($rockon_data['rockon_style_switcher_A']) && $rockon_data['rockon_style_switcher_A'] == '1'){
		if(isset($rockon_data['rockon_cssversion']) && $rockon_data['rockon_cssversion'] == 'dark'){
			dark_style_switcher();
		}else{
			light_style_switcher();
		}
	} 
}else{
	if(isset($rockon_data['rockon_style_switcher_U']) && $rockon_data['rockon_style_switcher_U'] == '1'){
		if(isset($rockon_data['rockon_cssversion']) && $rockon_data['rockon_cssversion'] == 'dark'){
			dark_style_switcher();
		}else{
			light_style_switcher();
		}
	} 
}
?>