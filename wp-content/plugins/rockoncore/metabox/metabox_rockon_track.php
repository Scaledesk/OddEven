<?php
$meta_boxes[] = array(
	'id'         => 'rockon_Settingaudio',
	'title'      => esc_html__( 'Audio Track Setting', 'rockon' ),
	'post_types' => 'rockon_track',
	'context'    => 'normal',
	'priority'   => 'high',
	'autosave'   => false,
	'fields'     => array(
		array(
			'name'  => esc_html__( 'Audio File', 'rockon' ),
			'id'    => "{$prefix}audio_track",
			'desc'  => esc_html__( 'Choose an Audio File', 'rockon' ),
			'type'  => 'file',
			'max_file_uploads'  => '5',
		),
		array(
			'name'  => esc_html__( 'Upload image', 'rockon' ),
			'id'    => "{$prefix}image_src",
			'desc'  => esc_html__( 'Choose an thaaumnail for representing audio.', 'rockon' ),
			'type'  => 'image_advanced',
			'max_file_uploads'  => '1',
		),
	)	
);
?>