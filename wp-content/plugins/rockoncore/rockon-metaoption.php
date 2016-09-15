<?php
$prefix = 'rockon_';
/*
 *	Start Page MetaBox
 */
$page_option_meta = array(
    'id' => 'section-page-meta',
    'title' => __('Sidebar Setting','rockon'),
    'page' => 'page',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
		array(
            'name' => 'Choose Sidebar Postion For This Section',
            'desc' => '',
            'id' => $prefix.'page_sidebarposition',
            'type' => 'sidebarradio',
            'std' => 'full',
			'option' => array(
				'full' => get_template_directory_uri().'/admin/assets/img/1col.png',
				'left' => get_template_directory_uri().'/admin/assets/img/2cl.png',
				'right' => get_template_directory_uri().'/admin/assets/img/2cr.png'
			)
        ),
		array(
            'name' => 'Page Title',
            'desc' => '',
            'id' => $prefix.'pagetitle',
            'type' => 'select',
			'options' => array(
				'enable' => 'enable',
				'disable' => 'disable'
			)
        ),
	)
);
// create boxes for team
add_action('admin_menu', 'add_page_meta_boxes');
if(!function_exists('add_page_meta_boxes')){	
	function add_page_meta_boxes()
	{
		global  $page_option_meta;
		add_meta_box($page_option_meta['id'], $page_option_meta['title'], 'show_page_options', $page_option_meta['page'], $page_option_meta['context'], $page_option_meta['priority']);
	}
}
if(!function_exists('show_page_options')){	
	function show_page_options()
	{
		global $page_option_meta, $post;
		// Use nonce for verification
		echo '<input type="hidden" name="meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		echo '<table class="form-table">';
		foreach ($page_option_meta['fields'] as $field) {
			// get current post meta data
			$meta = get_post_meta($post->ID, $field['id'], true);
			switch ($field['type']) {
				case 'sidebarradio':
					echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					if(empty($meta)){
						$meta = 'full';
					}
					foreach($field['option'] as $k=>$v){
						echo '<div class="', ($meta == $k) ? 'rockon_chooseborder '
						: '' ,'rockon-select-sidebar">
						<div style="display:none;">
						<input type="radio" value="'.$k.'" ',($meta == $k) ? 'checked'
						: '','  name="'.$field['id'].'" ></div>';
						echo '<img src="'.$v.'" alt=""></div>';
					}
				break;
				case 'select':
					echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					echo'<select name="' . $field['id'] . '" id="' . $field['id'] . '">';
					foreach ($field['options'] as $option) {
						echo'<option';
						if ($meta == $option) {
							echo ' selected="selected"';
						}
						echo'>' . $option . '</option>';
					}
					echo'</select>';
				break;
			}
		}
		echo '</table>';
	}
}
add_action('save_post', 'page_save_options');
if(!function_exists('page_save_options')){	
	function page_save_options($post_id)
	{	
		global $page_option_meta;
		$new = '';
		// verify nonce
		if (isset($_POST['meta_box_nonce']) && !wp_verify_nonce($_POST['meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		if (defined('DOING_AJAX') && DOING_AJAX)
			return;
		// check permissions
		if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		foreach ($page_option_meta['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			if (isset($_POST[$field['id']])) {
				 $new = $_POST[$field['id']];
			}
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
	}
}
/*
 *	End Page MetaBox
 */
/*$audiosection_option_meta = array(
    'id' => 'audiotrack-section-meta',
    'title' => __('Audio Track Setting','rockon'),
    'page' => 'rockon_track',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
		 array(
            'name' => __('Audio File', 'rockon'),
            'desc' => __('Choose an Audio File', 'rockon'),
            'id' => $prefix.'audio_src',
            "type" => "text",
            'std' => ''
        ),
	    array(
            'name' => '',
            'desc' => '',
            'id' => $prefix.'audio_button',
            'type' => 'button',
            'std' => 'Browse',
            'suggest' => 'upload mp3 audio file',
        ),
		 array(
            'name' => __('Upload Image', 'rockon'),
            'desc' => __('Choose an thaaumnail for representing audio.', 'rockon'),
            'id' => $prefix.'image_src',
            "type" => "text",
            'std' => ''
        ),
		 array(
            'name' => '',
            'desc' => '',
            'id' => $prefix.'image_button',
            'type' => 'button',
            'std' => 'Browse',
			'suggest' => '',
        )
	)		
);
// create boxes for home sections
add_action('admin_menu', 'add_audiotrack_section_meta_boxes');
if(!function_exists('add_audiotrack_section_meta_boxes')){	
	function add_audiotrack_section_meta_boxes(){
		global  $audiosection_option_meta;
		add_meta_box($audiosection_option_meta['id'], $audiosection_option_meta['title'], 'audiotrack_section_options', $audiosection_option_meta['page'], $audiosection_option_meta['context'], $audiosection_option_meta['priority']);
	} 
}
if(!function_exists('audiotrack_section_options')){	
	function audiotrack_section_options(){
		global $audiosection_option_meta, $post;
		// Use nonce for verification
		echo '<input type="hidden" name="meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		echo '<table class="form-table">';
		foreach ($audiosection_option_meta['fields'] as $field) {
			// get current post meta data
			$meta = get_post_meta($post->ID, $field['id'], true);
			switch ($field['type']) {
				case 'text':
					echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta
						: stripslashes(htmlspecialchars(($field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
					break;
				case 'button':
					echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '" value="Browse" />';
					echo '<span style="text-align: center;float: left;font-size: 14px;color: #999;margin-top: 5px;">'.$field['suggest'].'</span>';
					echo '<div style="float: right;margin-top: -40px;">';
					if(!empty($meta))
						echo '<img src="'.$meta.'" width="50" height="50" class="rockon_iconimgsrc" alt="">';
					echo '</div>';
					echo     '</td>',
					'</tr>';
					break;
			}
		}
		echo '</table>';
	}
}
add_action('save_post', 'section_audiotrack_options');
// save metadata
if(!function_exists('section_audiotrack_options')){	
	function section_audiotrack_options($post_id)
	{ 
		global $audiosection_option_meta,$post;
		$new = '';
		// verify nonce
		if (isset($_POST['meta_box_nonce']) && !wp_verify_nonce($_POST['meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		if (defined('DOING_AJAX') && DOING_AJAX)
			return;
		// check permissions
		if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		foreach ($audiosection_option_meta['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			if (isset($_POST[$field['id']])) {
				$new = $_POST[$field['id']];
			   // echo $new;
			}
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
	}  
}*/
/*****************Event System******************/
$eventsys_option_meta = array(
    'id' => 'eventsystem-section-meta',
    'title' => __('Rockon Event Setting','rockon'),
    'page' => 'rockon_event',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
		 array(
            'name' => __('Event Description', 'rockon'),
            'desc' => __('', 'rockon'),
            'id' => $prefix.'event_sysdesc',
            "type" => "textarea",
            'std' => ''
        ),
	    array(
            'name' => 'Event Date',
            'desc' => '',
            'id' => $prefix.'event_sysdate',
            'type' => 'date',
			'std' => ''
        ),
		array(
            'name' => 'Event Time From',
            'desc' => '',
            'id' => $prefix.'event_systimefrom',
            'type' => 'time',
			'std' => ''
        ),
		array(
            'name' => 'Event Time To',
            'desc' => '',
            'id' => $prefix.'event_systimeto',
            'type' => 'time',
			'std' => ''
        ),
		array(
            'name' => 'Location',
            'desc' => '',
            'id' => $prefix.'event_sysloaction',
            'type' => 'text',
			'std' => ''
        ),
		array(
            'name' => 'Latitude and Longitude',
            'desc' => 'separate with ,',
            'id' => $prefix.'event_syscomma',
            'type' => 'text',
			'std' => ''
        ),
		array(
            'name' => 'Select Images',
            'desc' => '',
            'id' => $prefix.'event_album',
            'type' => 'multiple-images',
            'std' => 'full',
        ),
		array(
            'name' => 'Heading Event Gallery',
            'desc' => '',
            'id' => $prefix.'event_Hevent_gallry',
            'type' => 'text',
			'std' => 'Event Gallery'
        )
	)		
);
// create boxes for home sections
add_action('admin_menu', 'add_eventsys_section_meta_boxes');
if(!function_exists('add_eventsys_section_meta_boxes')){	
	function add_eventsys_section_meta_boxes(){
		global  $eventsys_option_meta;
		add_meta_box($eventsys_option_meta['id'], $eventsys_option_meta['title'], 'eventsys_section_options', $eventsys_option_meta['page'], $eventsys_option_meta['context'], $eventsys_option_meta['priority']);
	} 
}
if(!function_exists('eventsys_section_options')){	
	function eventsys_section_options(){
		global $eventsys_option_meta, $post;
		// Use nonce for verification
		echo '<input type="hidden" name="meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		echo '<table class="form-table">';
		foreach ($eventsys_option_meta['fields'] as $field) {
			// get current post meta data
			$meta = get_post_meta($post->ID, $field['id'], true);
			switch ($field['type']) {
				case 'date':
					echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta
						: stripslashes(htmlspecialchars(($field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" class="rockon_event_date" />';
					break;
				case 'time':
					echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta
						: stripslashes(htmlspecialchars(($field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" class="rockon_event_time" />';
					break;
				case 'text':
					echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta
						: stripslashes(htmlspecialchars(($field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
					break;
				case 'button':
					echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '" value="Browse" />';
					echo '<span style="text-align: center;float: left;font-size: 14px;color: #999;margin-top: 5px;">'.$field['suggest'].'</span>';
					echo '<div style="float: right;margin-top: -40px;">';
					if(!empty($meta))
						echo '<img src="'.$meta.'" width="50" height="50" class="rockon_iconimgsrc" alt="">';
					echo '</div>';
					echo     '</td>',
					'</tr>';
					break;
				case 'textarea':
					echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					$args = array(
						'textarea_rows' => 5,
						'media_buttons' => false,
						'teeny' => true,
						'quicktags' => false
					);
					wp_editor($meta ? $meta : stripslashes(htmlspecialchars(($field['std']), ENT_QUOTES)), $field['id'],$args);
					break;
				case 'multiple-images':
					echo '<tr>','<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					// adjust values here
					$id = $field['id']; // this will be the name of form field. Image url(s) will be submitted in $_POST using this key. So if $id == “img1” then $_POST[“img1”] will have all the image urls
					$svalue = ($meta ? $meta:''); // this will be initial value of the above form field. Image urls.
					$multiple = true; // allow multiple files upload
					$width = null; // If you want to automatically resize all uploaded images then provide width here (in pixels)
					$height = null; // If you want to automatically resize all uploaded images then provide height here (in pixels)
					?>
					<label>Upload Images</label>  
					<input type="hidden" name="<?php echo $id; ?>" id="<?php echo $id; ?>" value="<?php echo $svalue; ?>" />  
					<div class="plupload-upload-uic hide-if-no-js <?php if ($multiple): ?>plupload-upload-uic-multiple<?php endif; ?>" id="<?php echo $id; ?>plupload-upload-ui">  
						<input id="<?php echo $id; ?>plupload-browse-button" type="button" value="<?php esc_attr_e('Select Files'); ?>" class="button" />
						<span class="ajaxnonceplu" id="ajaxnonceplu<?php echo wp_create_nonce($id . 'pluploadan'); ?>"></span>
						<?php if ($width && $height): ?>
								<span class="plupload-resize"></span><span class="plupload-width" id="plupload-width<?php echo $width; ?>"></span>
								<span class="plupload-height" id="plupload-height<?php echo $height; ?>"></span>
						<?php endif; ?>
						<div class="filelist"></div>
					</div>  
					<div class="plupload-thumbs <?php if ($multiple): ?>plupload-thumbs-multiple<?php endif; ?>" id="<?php echo $id; ?>plupload-thumbs">  
					</div>  
					<div class="clear"></div>   
					<?php
					break;
			}
		}
		echo '</table>';
	}
}
add_action('save_post', 'section_saveevent_options');
// save metadata
if(!function_exists('section_saveevent_options')){
	function section_saveevent_options($post_id)
	{
		global $eventsys_option_meta,$post;
		$new = '';
		// verify nonce
		if (isset($_POST['meta_box_nonce']) && !wp_verify_nonce($_POST['meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		if (defined('DOING_AJAX') && DOING_AJAX)
			return;
		// check permissions
		if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		foreach ($eventsys_option_meta['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			if (isset($_POST[$field['id']])) {
				$new = $_POST[$field['id']];
			   // echo $new;
			}
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
	}  
}
/*************************************************/
$portfoli_option_meta = array(
    'id' => 'audiotrack-section-meta',
    'title' => __('Portfolio Setting','rockon'),
    'page' => 'portfolio',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
		 array(
            'name' => __('Choose Audio File Or Put Youtube Url', 'rockon'),
            'desc' => __('Choose an Audio File/Put Youtube Url.', 'rockon'),
            'id' => $prefix.'audio_src',
            "type" => "text",
            'std' => ''
        ),
	    array(
            'name' => '',
            'desc' => '',
            'id' => $prefix.'audio_button',
            'type' => 'button',
            'std' => 'Browse',
            'suggest' => 'upload mp3 audio file',
        ),
		array(
            'name' => __('Show No. Of Related Post', 'rockon'),
            'desc' =>'',
            'id' => $prefix.'portfolio_relatedpost',
            "type" => "text",
            'std' => ''
        )
	)		
);
// create boxes for home sections
add_action('admin_menu', 'add_portfolio_section_meta_boxes');
if(!function_exists('add_portfolio_section_meta_boxes')){
	function add_portfolio_section_meta_boxes(){
		global  $portfoli_option_meta;
		add_meta_box($portfoli_option_meta['id'], $portfoli_option_meta['title'], 'portfolio_section_options', $portfoli_option_meta['page'], $portfoli_option_meta['context'], $portfoli_option_meta['priority']);
	} 
}
if(!function_exists('portfolio_section_options')){
	function portfolio_section_options(){
		global $portfoli_option_meta, $post;
		// Use nonce for verification
		echo '<input type="hidden" name="meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		echo '<table class="form-table">';
		foreach ($portfoli_option_meta['fields'] as $field) {
			// get current post meta data
			$meta = get_post_meta($post->ID, $field['id'], true);
			switch ($field['type']) {
				case 'text':
					echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta
						: stripslashes(htmlspecialchars(($field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
					break;
				case 'button':
					echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '" value="Browse" />';
					echo '<span style="text-align: center;float: left;font-size: 14px;color: #999;margin-top: 5px;">'.$field['suggest'].'</span>';
					echo     '</td>',
					'</tr>';
					break;
			}
		}
		echo '</table>';
	}
}
add_action('save_post', 'section_saveportfolio_options');
// save metadata
if(!function_exists('section_saveportfolio_options')){
	function section_saveportfolio_options($post_id)
	{
		global $portfoli_option_meta,$post;
		$new = '';
		// verify nonce
		if (isset($_POST['meta_box_nonce']) && !wp_verify_nonce($_POST['meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		if (defined('DOING_AJAX') && DOING_AJAX)
			return;
		// check permissions
		if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		foreach ($portfoli_option_meta['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			if (isset($_POST[$field['id']])) {
				$new = $_POST[$field['id']];
			   // echo $new;
			}
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
	}  
}
/*************************************************/
/*
 *	Start Post MetaBoxes
 */
$postsection_option_meta = array(
    'id' => 'postpage-section-meta',
    'title' => __('Post Meta settings','rockon'),
    'page' => 'post',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
		array(
            'name' => __('Show No. Of Related Post', 'rockon'),
            'desc' => '',
            'id' => $prefix.'post_relatedpost',
            "type" => "text",
            'std' => ''
        )
	)		
);
add_action('admin_menu', 'add_post_section_meta_boxes');
if(!function_exists('add_post_section_meta_boxes')){
	function add_post_section_meta_boxes(){
		global  $postsection_option_meta;
		add_meta_box($postsection_option_meta['id'], $postsection_option_meta['title'], 'post_show_section_options', $postsection_option_meta['page'], $postsection_option_meta['context'], $postsection_option_meta['priority']);
	} 
}
if(!function_exists('post_show_section_options')){
	function post_show_section_options(){
		global $postsection_option_meta, $post;
		// Use nonce for verification
		echo '<input type="hidden" name="meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		echo '<table class="form-table">';
		foreach ($postsection_option_meta['fields'] as $field) {
			// get current post meta data
			$meta = get_post_meta($post->ID, $field['id'], true);
			switch ($field['type']) {
				case 'text':
					echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta
						: stripslashes(htmlspecialchars(($field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
					break;
			}
		}
		echo '</table>';
	}
}
add_action('save_post', 'section_savepost_options');
// save metadata
if(!function_exists('section_savepost_options')){
	function section_savepost_options($post_id)
	{
		global $postsection_option_meta,$post;
		$new = '';
		// verify nonce
		if (isset($_POST['meta_box_nonce']) && !wp_verify_nonce($_POST['meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		if (defined('DOING_AJAX') && DOING_AJAX)
			return;
		// check permissions
		if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		foreach ($postsection_option_meta['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			if (isset($_POST[$field['id']])) {
				$new = $_POST[$field['id']];
			   // echo $new;
			}
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
	}
}
/*
 *	End Post MetaBoxes
 */
 /*
 *	Start Serveice MetaBox
 */
$servicesvg_option_meta = array(
    'id' => 'section-page-meta',
    'title' => __('Serveice Setting','rockon'),
    'page' => 'services',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
		 array(
            'name' => 'Enter SVG Code',
            'desc' => 'This code will display the SVG icon in serveices.',
            'id' => $prefix.'svgiconcode',
            'type' => 'textarea',
			'std' => ''
        )
	)
);
// create boxes for team
add_action('admin_menu', 'add_servicesvg_meta_boxes');
if(!function_exists('add_servicesvg_meta_boxes')){	
	function add_servicesvg_meta_boxes()
	{
		global  $servicesvg_option_meta;
		add_meta_box($servicesvg_option_meta['id'], $servicesvg_option_meta['title'], 'show_servicesvg_options', $servicesvg_option_meta['page'], $servicesvg_option_meta['context'], $servicesvg_option_meta['priority']);
	}
}
if(!function_exists('show_servicesvg_options')){	
	function show_servicesvg_options()
	{
		global $servicesvg_option_meta, $post;
		// Use nonce for verification
		echo '<input type="hidden" name="meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		echo '<table class="form-table">';
		foreach ($servicesvg_option_meta['fields'] as $field) {
			// get current post meta data
			$meta = get_post_meta($post->ID, $field['id'], true);
			switch ($field['type']) {
				case 'textarea':
					echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					echo '<textarea rows="20" cols="80" name="', $field['id'], '" id="', $field['id'], '" >', $meta ? $meta
						: stripslashes(htmlspecialchars(($field['std']), ENT_QUOTES)), '</textarea>';
					break;
			}
		}
		echo '</table>';
	}
}
add_action('save_post', 'section_servicesvg_options');
// save metadata
if(!function_exists('section_servicesvg_options')){
	function section_servicesvg_options($post_id)
	{
		global $servicesvg_option_meta,$post;
		$new = '';
		// verify nonce
		if (isset($_POST['meta_box_nonce']) && !wp_verify_nonce($_POST['meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		if (defined('DOING_AJAX') && DOING_AJAX)
			return;
		// check permissions
		if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		foreach ($servicesvg_option_meta['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			if (isset($_POST[$field['id']])) {
				$new = $_POST[$field['id']];
			   // echo $new;
			}
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
	}
}
 /*
 *	End Serveice MetaBox
 */
/*$booking_option_meta = array(
    'id' => 'booking-section-meta',
    'title' => __('Rockon Event Setting','rockon'),
    'page' => 'event_booking',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
		array(
            'name' => 'Ticket Cost',
            'desc' => 'value present in $',
            'id' => $prefix.'ticketcost',
            'type' => 'text',
			'std' => ''
        ),
		array(
            'name' => 'Number of ticket',
            'desc' => '',
            'id' => $prefix.'noofticket',
            'type' => 'text',
			'std' => ''
        ),
	    array(
            'name' => 'Event Booking start Date',
            'desc' => '',
            'id' => $prefix.'booking_s',
            'type' => 'date',
			'std' => ''
        ),
		array(
            'name' => 'Event booking End Date',
            'desc' => '',
            'id' => $prefix.'booking_e',
            'type' => 'date',
			'std' => ''
        ),
	    array(
            'name' => 'Event start Date',
            'desc' => '',
            'id' => $prefix.'event_s',
            'type' => 'date',
			'std' => ''
        ),
		array(
            'name' => 'Event End Date',
            'desc' => '',
            'id' => $prefix.'event_e',
            'type' => 'date',
			'std' => ''
        ),
		array(
            'name' => 'Location',
            'desc' => '',
            'id' => $prefix.'event_loaction',
            'type' => 'map_text',
			'std' => ''
        ),
		array(
            'name' => 'Map Zoom',
            'desc' => '',
            'id' => $prefix.'zoomlevel',
            'type' => 'select',
			'std' => '',
			'options' => array('5','6','7','8','9','10','11','12','13','14','15','16'),
        ),
		array(
            'name' => 'Paypal Mode',
            'desc' => '',
            'id' => $prefix.'paypal',
            'type' => 'select',
			'std' => '',
			'options' => array('enable','disable'),
        ),
		array(
            'name' => 'Select Coupons',
            'desc' => '',
            'id' => $prefix.'coupon',
            'type' => 'multiselect',
			'std' => '',
        )
	)		
);
// create boxes for home sections
add_action('admin_menu', 'add_booking_section_meta_boxes');
if(!function_exists('add_booking_section_meta_boxes')){	
	function add_booking_section_meta_boxes(){
		global  $booking_option_meta;
		add_meta_box($booking_option_meta['id'], $booking_option_meta['title'], 'booking_section_options', $booking_option_meta['page'], $booking_option_meta['context'], $booking_option_meta['priority']);
	} 
}
if(!function_exists('booking_section_options')){	
	function booking_section_options(){
		global $booking_option_meta, $post;
		// Use nonce for verification
		echo '<input type="hidden" name="meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		echo '<table class="form-table">';
		foreach ($booking_option_meta['fields'] as $field) {
			// get current post meta data
			$meta = get_post_meta($post->ID, $field['id'], true);
			switch ($field['type']) {
				case 'select':
					echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					echo'<select name="' . $field['id'] . '" id="' . $field['id'] . '">';
					foreach ($field['options'] as $option) {
						echo'<option';
						if ($meta == $option) {
							echo ' selected="selected"';
						}
						echo'>' . $option . '</option>';
					}
					echo'</select>';
				break;
				case 'map_text':
					$content_address= get_post_meta($post->ID,$field['id'],true);
					$lat = get_post_meta($post->ID,'rockon_event_lat',true);
					$log = get_post_meta($post->ID,'rockon_event_log',true);
					echo '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
					 <script>var geocoder;var map;var marker;function initialize(){
					var latlng = new google.maps.LatLng("'.$lat.'","'.$log.'");var options = {zoom: 12,center: latlng,
						mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("map_canvas"), options);
					geocoder = new google.maps.Geocoder();
					marker = new google.maps.Marker({
					map: map,
					draggable: true,
					position :latlng
					});
					}
					jQuery(document).ready(function($) { 
					initialize();
					jQuery(function() {
						jQuery("#address").autocomplete({
						  //This bit uses the geocoder to fetch address values
						  source: function(request, response) {
							geocoder.geocode( {"address": request.term }, function(results, status) {
							  response(jQuery.map(results, function(item) {
								return {
								  label:  item.formatted_address,
								  value: item.formatted_address,
								  latitude: item.geometry.location.lat(),
								  longitude: item.geometry.location.lng()
								}
							  }));
							})
						  },
						  //This bit is executed upon selection of an address
						  select: function(event, ui) {
							jQuery("#latitude").val(ui.item.latitude);
							jQuery("#longitude").val(ui.item.longitude);
							var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);
							marker.setPosition(location);
							map.setCenter(location);
						  }
						});
					  });
					//Add listener to marker for reverse geocoding
					  google.maps.event.addListener(marker,"drag", function() {
						geocoder.geocode({"latLng": marker.getPosition()}, function(results, status) {
						  if (status == google.maps.GeocoderStatus.OK) {
							if (results[0]) {
							  jQuery("#address").val(results[0].formatted_address);
							  jQuery("#latitude").val(marker.getPosition().lat());
							  jQuery("#longitude").val(marker.getPosition().lng());
							}
						  }
						}); 
					  });
					});
					</script>';
					?>
					<tr>
					<th>
					 <label>Address: </label></th><td>
					 <input id="address"  type="text" value="<?php echo $content_address; ?>" name="<?php echo $field['id']; ?>" style="width:75%; margin-right: 20px; float:left;"/>
					 <div id="map_canvas" style="width:600px; height:400px;"></div>
					 <input id="latitude" type="hidden" value="<?php echo $lat; ?>" name="rockon_event_lat" />
					<input id="longitude" type="hidden" value="<?php echo $log; ?>" name="rockon_event_log"/>
					</td>
					</tr>
					<?php
				break;
				case 'date':
					echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta
						: stripslashes(htmlspecialchars(($field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" class="rockon_event_date" />';	
				break;
				case 'text':
					echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta
						: stripslashes(htmlspecialchars(($field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;"';
					echo '/>';
					break;
				case 'button':
					echo '<input style="float: left;" type="button" class="button" name="', $field['id'], '" id="', $field['id'], '" value="Browse" />';
					echo '<span style="text-align: center;float: left;font-size: 14px;color: #999;margin-top: 5px;">'.$field['suggest'].'</span>';
					echo '<div style="float: right;margin-top: -40px;">';
					if(!empty($meta))
						echo '<img src="'.$meta.'" width="50" height="50" class="rockon_iconimgsrc" alt="">';
					echo '</div>';
					echo     '</td>',
					'</tr>';
					break;
				case 'textarea':
					echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					$args = array(
						'textarea_rows' => 5,
						'media_buttons' => false,
						'teeny' => true,
						'quicktags' => false
					);
					wp_editor($meta ? $meta : stripslashes(htmlspecialchars(($field['std']), ENT_QUOTES)), $field['id'],$args);
					break;
					case 'multiselect':
					echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					echo'<select name="' . $field['id'] . '" id="' . $field['id'] . '">';
					echo'<option';
					if (''==$meta) {
						echo ' selected="selected"';
					}
					echo' value="">select</option>';
					global $post;
					$query = new WP_Query( array( 'post_type' => 'event_coupons' ) );
					// The Loop
					$counpon = array();
					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
							$query->the_post();
							echo'<option';
							if ($post->ID==$meta) {
								echo ' selected="selected"';
							}
							echo' value="',$post->ID,'">' . get_the_title($post->ID) . '</option>';
						}
					} 
					echo'</select>';
					wp_reset_postdata();
					break;
			}
		}
		echo '</table>';
	}
}
add_action('save_post', 'section_save_booking');
// save metadata
if(!function_exists('section_save_booking')){
	function section_save_booking($post_id)
	{
		global $booking_option_meta,$post;
		$new = '';
		// verify nonce
		if (isset($_POST['meta_box_nonce']) && !wp_verify_nonce($_POST['meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		if (defined('DOING_AJAX') && DOING_AJAX)
			return;
		// check permissions
		if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		
		$ticket_old = get_post_meta($post_id, 'rockon_noofticket', true);
		
		foreach ($booking_option_meta['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			if (isset($_POST[$field['id']])) {
				$new = $_POST[$field['id']];
			   // echo $new;
			}
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
		if(isset($_POST['rockon_event_lat']))
			update_post_meta($post_id,'rockon_event_lat',$_POST['rockon_event_lat']);
		if(isset($_POST['rockon_event_log']))
			update_post_meta($post_id,'rockon_event_log',$_POST['rockon_event_log']);
		if(isset($_POST['rockon_noofticket']) && $_POST['rockon_noofticket'] != $ticket_old){
			$ticket = $_POST['rockon_noofticket'] - $ticket_old;
			$ticket = get_option('rockon_noofticket_'.$post_id) + $ticket;
			update_option('rockon_noofticket_'.$post_id,$ticket);
		}
	}  
} 
$coupon_option_meta = array(
    'id' => 'conpons-section-meta',
    'title' => __('conpons Setting','rockon'),
    'page' => 'event_coupons',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
		array(
            'name' => __('Conpon code', 'rockon'),
            'desc' => __('', 'rockon'),
            'id' => $prefix.'conponcode',
            "type" => "textdisable",
            'std' => ''
        ),
	    array(
            'name' => __('Discount (%)', 'rockon'),
            'desc' => __('calculate with percentage', 'rockon'),
            'id' => $prefix.'discount',
            "type" => "text",
            'std' => ''
        ),
		array(
            'name' => __('Discount on ticket bundle', 'rockon'),
            'desc' => __('select ticket', 'rockon'),
            'id' => $prefix.'discounton',
            "type" => "select",
            'std' => '',
			'options' => array('1','2','3','4','5','6','7','8','9','10')
        ),
		array(
            'name' => __('Limit ', 'rockon'),
            'desc' => __('-1 for unlimited', 'rockon'),
            'id' => $prefix.'limit',
            "type" => "text",
            'std' => '',
			'options' => array('per ticket','total cost')
        )
	)		
);
// create boxes for home sections
add_action('admin_menu', 'add_conpon_section_meta_boxes');
if(!function_exists('add_conpon_section_meta_boxes')){	
	function add_conpon_section_meta_boxes(){
		global  $coupon_option_meta;
		add_meta_box($coupon_option_meta['id'], $coupon_option_meta['title'], 'conpon_section_options', $coupon_option_meta['page'], $coupon_option_meta['context'], $coupon_option_meta['priority']);
	} 
}
if(!function_exists('conpon_section_options')){	
	function conpon_section_options(){
		global $coupon_option_meta, $post;
		// Use nonce for verification
		echo '<input type="hidden" name="meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		echo '<table class="form-table">';
		foreach ($coupon_option_meta['fields'] as $field) {
			// get current post meta data
			$meta = get_post_meta($post->ID, $field['id'], true);
			switch ($field['type']) {
				case 'select':
					echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					echo'<select name="' . $field['id'] . '" id="' . $field['id'] . '">';
					foreach ($field['options'] as $option) {
						echo'<option';
						if ($meta == $option) {
							echo ' selected="selected"';
						}
						echo'>' . $option . '</option>';
					}
					echo'</select>';
				break;
				case 'text':
					echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta
						: stripslashes(htmlspecialchars(($field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;"/>';
				break;
				case 'textdisable':
					echo '<tr>',
					'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">' . $field['desc'] . '</span></label></th>',
					'<td>';
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta
						: $post->post_name, '" size="30" style="width:75%; margin-right: 20px; float:left;" disabled/>';
				break;
			}
		}
		echo '</table>';
	}
}
add_action('save_post', 'section_savecoupon');
// save metadata
if(!function_exists('section_savecoupon')){
	function section_savecoupon($post_id)
	{
		global $coupon_option_meta,$post;
		$new = '';
		// verify nonce
		if (isset($_POST['meta_box_nonce']) && !wp_verify_nonce($_POST['meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		if (defined('DOING_AJAX') && DOING_AJAX)
			return;
		// check permissions
		if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		foreach ($coupon_option_meta['fields'] as $field) {
			$old = get_post_meta($post_id, $field['id'], true);
			if (isset($_POST[$field['id']])) {
				$new = $_POST[$field['id']];
			   // echo $new;
			}
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}
		if(isset($_POST['rockon_limit']))
			update_option('rockon_limit'.$post_id,$_POST['rockon_limit']);
	}  
}*/
?>