<?php
if(!function_exists('rockon_service')){
	function rockon_service(){
		 $labels = array( 
			'name' => _x( 'Services', 'services', 'rockon' ),
			'singular_name' => _x( 'Services', 'services', 'rockon' ),
			'add_new' => _x( 'Add New', 'services', 'rockon' ),
			'add_new_item' => _x( 'Add New Services', 'services', 'rockon' ),
			'edit_item' => _x( 'Edit Services', 'services', 'rockon' ),
			'new_item' => _x( 'New Services', 'services', 'rockon' ),
			'view_item' => _x( 'View Services', 'services', 'rockon' ),
			'search_items' => _x( 'Search Services', 'services', 'rockon' ),
			'not_found' => _x( 'No services found', 'services', 'rockon' ),
			'not_found_in_trash' => _x( 'No services member found in Trash', 'services', 'rockon' ),
			'parent_item_colon' => _x( 'Parent Services:', 'services', 'rockon' ),
			'menu_name' => _x( 'Services ', 'services', 'rockon' ),
			'all_items' => _x( 'All Services ', 'services', 'rockon' ),
			'search_items' => _x( 'No services found', 'services', 'rockon' )
		);
		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'supports' => array( 'title', 'editor' ,'thumbnail' ),
			'public' => false,  
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'has_archive' => false,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => true,
			'menu_icon' => PLUGIN_PATH.'images/icon/services.svg',
		);
		register_post_type( 'services', $args );
	}
	add_action( 'init', 'rockon_service' );
}
if(!function_exists('rockon_club')){
	function rockon_club(){
		 $labels = array( 
			'name' => _x( 'Portfolio', 'portfolio', 'rockon' ),
			'singular_name' => _x( 'Portfolio', 'portfolio', 'rockon' ),
			'add_new' => _x( 'Add New', 'portfolio', 'rockon' ),
			'add_new_item' => _x( 'Add New Portfolio', 'portfolio', 'rockon' ),
			'edit_item' => _x( 'Edit Portfolio', 'portfolio', 'rockon' ),
			'new_item' => _x( 'New Portfolio', 'portfolio', 'rockon' ),
			'view_item' => _x( 'View Portfolio', 'portfolio', 'rockon' ),
			'search_items' => _x( 'Search Portfolio', 'portfolio', 'rockon' ),
			'not_found' => _x( 'No Portfolio found', 'portfolio', 'rockon' ),
			'not_found_in_trash' => _x( 'No Portfolio member found in Trash', 'portfolio', 'rockon' ),
			'parent_item_colon' => _x( 'Parent Portfolio:', 'portfolio', 'rockon' ),
			'menu_name' => _x( 'Portfolio ', 'portfolio', 'rockon' ),
			'all_items' => _x( 'All Portfolio ', 'portfolio', 'rockon' ),
			'search_items' => _x( 'No Portfolio found', 'portfolio', 'rockon' )
		);
		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'supports' => array( 'title', 'editor' ,'thumbnail' ),
			'public' => true,  
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'has_archive' => false,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => true,
			'menu_icon' => PLUGIN_PATH.'images/icon/portfolio.svg',
		);
		register_post_type( 'portfolio', $args );
	}
	add_action( 'init', 'rockon_club' );
}
if(!function_exists('portfoliobuild_taxonomies')){
	function portfoliobuild_taxonomies() {
		register_taxonomy("portfolio_categories", array("portfolio"), array("hierarchical" => true, "label" => "Categories", "singular_label" => "Category", "rewrite" => true));
	} 
	// add taxonomies to categorize different custom post types
	add_action( 'init', 'portfoliobuild_taxonomies', 0);
}
if(!function_exists('rockon_track_func')){
	function rockon_track_func(){
		 $labels = array( 
			'name' => _x( 'Audio Track', 'rockon_track', 'rockon' ),
			'singular_name' => _x( 'Audio Track', 'rockon_track', 'rockon' ),
			'add_new' => _x( 'Add New', 'rockon_track', 'rockon' ),
			'add_new_item' => _x( 'Add Audio Track', 'rockon_track', 'rockon' ),
			'edit_item' => _x( 'Edit Audio Track', 'rockon_track', 'rockon' ),
			'new_item' => _x( 'New Audio Track', 'rockon_track', 'rockon' ),
			'view_item' => _x( 'View Audio Track', 'rockon_track', 'rockon' ),
			'search_items' => _x( 'Search audio track post', 'rockon_track', 'rockon' ),
			'not_found' => _x( 'No audio track post found', 'rockon_track', 'rockon' ),
			'not_found_in_trash' => _x( 'No audio track post found in Trash', 'rockon_track', 'rockon' ),
			'parent_item_colon' => _x( 'Parent audio track post', 'rockon_track', 'rockon' ),
			'menu_name' => _x( 'Audio Track ', 'rockon_track', 'rockon' ),
			'all_items' => _x( 'All Audio Track ', 'rockon_track', 'rockon' ),
			'search_items' => _x( 'No audio track post found', 'rockon_track', 'rockon' )
		);
		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'supports' => array( 'title' ),
			'public' => false,  
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'has_archive' => false,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => true,
			'menu_icon' => PLUGIN_PATH.'images/icon/audio_track.svg',
		);
		register_post_type( 'rockon_track', $args );
	}
	add_action( 'init', 'rockon_track_func' );
}
if(!function_exists('rockon_disc_jockey_team')){
	function rockon_disc_jockey_team(){
		 $labels = array( 
			'name' => _x( 'Disc Jockey (Team)', 'team', 'rockon' ),
			'singular_name' => _x( 'Disc Jockey (Team)', 'team', 'rockon' ),
			'add_new' => _x( 'Add New', 'team', 'rockon' ),
			'add_new_item' => _x( 'Add New Member', 'team', 'rockon' ),
			'edit_item' => _x( 'Edit Member', 'team', 'rockon' ),
			'new_item' => _x( 'New Member', 'team', 'rockon' ),
			'view_item' => _x( 'View Member', 'team', 'rockon' ),
			'search_items' => _x( 'Search Disc Jockey (Team)', 'team', 'rockon' ),
			'not_found' => _x( 'No Disc Jockey (Team) found', 'team', 'rockon' ),
			'not_found_in_trash' => _x( 'No Disc Jockey(Team) member found in Trash', 'team', 'rockon' ),
			'parent_item_colon' => _x( 'Parent Disc Jockey (Team):', 'team', 'rockon' ),
			'menu_name' => _x( 'Disc Jockey (Team) ', 'team', 'rockon' ),
			'all_items' => _x( 'All Disc Jockey (Team) ', 'team', 'rockon' ),
			'search_items' => _x( 'No disc jockey found', 'team', 'rockon' )
		);
		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'supports' => array( 'title', 'editor' ,'thumbnail' ),
			'public' => false,  
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'has_archive' => false,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => true,
			'menu_icon' => PLUGIN_PATH.'images/icon/disk_jockey.svg',
		);
		register_post_type( 'disc_jockey_team', $args );
	}
	add_action( 'init', 'rockon_disc_jockey_team' );
}
if(!function_exists('rockon_eventsys')){
	function rockon_eventsys(){
		 $labels = array( 
			'name' => _x( 'Event showcase', 'rockon_event', 'rockon' ),
			'singular_name' => _x( 'Event showcase', 'rockon_event', 'rockon' ),
			'add_new' => _x( 'Add New', 'rockon_event', 'rockon' ),
			'add_new_item' => _x( 'Add New Event', 'rockon_event', 'rockon' ),
			'edit_item' => _x( 'Edit Event', 'rockon_event', 'rockon' ),
			'new_item' => _x( 'New Event', 'rockon_event', 'rockon' ),
			'view_item' => _x( 'View Event', 'rockon_event', 'rockon' ),
			'search_items' => _x( 'Search Event showcase', 'rockon_event', 'rockon' ),
			'not_found' => _x( 'No Event showcase found', 'rockon_event', 'rockon' ),
			'not_found_in_trash' => _x( 'No Event showcase member found in Trash', 'rockon_event', 'rockon' ),
			'parent_item_colon' => _x( 'Parent Event showcase', 'rockon_event', 'rockon' ),
			'menu_name' => _x( 'Event showcase', 'rockon_event', 'rockon' ),
			'all_items' => _x( 'All showcase', 'rockon_event', 'rockon' ),
			'search_items' => _x( 'No showcase found', 'rockon_event', 'rockon' )
		);
		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'supports' => array( 'title', 'thumbnail' ),
			'public' => true,  
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'has_archive' => false,
			'query_var' => true,
			'can_export' => true,
			'menu_icon' => PLUGIN_PATH.'images/icon/event_booking.svg',
			'rewrite' => array( 'slug' => 'event')
		);
		register_post_type( 'rockon_event', $args );
	}
	add_action( 'init', 'rockon_eventsys' );
}
/***************** add and edit image portfolio category ****************/
add_action( 'portfolio_categories_edit_form_fields',  'rockon_taxonomies_edit_meta', 10, 2 );
add_action( 'portfolio_categories_add_form_fields',  'rockon_taxonomies_edit_meta', 10, 2 );
if(!function_exists('rockon_taxonomies_edit_meta')){
function rockon_taxonomies_edit_meta( $term ) {
		global $wpdb;
 		// put the term ID into a variable
		if(isset($term->term_id)) $term_id = $term->term_id; else $term_id = '';
		$post = get_default_post_to_edit( 'post', true );
		$post_ID = $post->ID;
	?>
        <tr class="form-field">
			<th>Set Featured Image</th>
            <td>
            	<div id="postimagediv" class="postbox" style="width:95%;" >
                    <div class="inside">
                        <?php wp_enqueue_media( array('post' => $post_ID) ); ?>
                        <?php
							$thumbnail_id = get_option( '_wpfifc_taxonomy_term_'.$term_id.'_thumbnail_id_', 0 );
                            echo _wp_post_thumbnail_html( $thumbnail_id, $post_ID );
                        ?>
                    </div>
					<input type="hidden" name="" value="<?php echo ROCKON_AJAX_URL; ?>" id="rockon_ajaxurl">
                    <input type="hidden" name="wpfifc_taxonomies_edit_post_ID" id="wpfifc_taxonomies_edit_post_ID_id" value="<?php echo $post_ID; ?>" />
                    <input type="hidden" name="wpfifc_taxonomies_edit_term_ID" id="wpfifc_taxonomies_edit_term_ID_id" value="<?php echo $term_id; ?>" />
                </div>
        	</td>
		</tr>
	<?php
}
}
add_action('edited_portfolio_categories', 'wpfifc_taxonomies_save_meta' , 10, 2 );  
add_action('created_portfolio_categories','wpfifc_taxonomies_save_meta'); 
if(!function_exists('wpfifc_taxonomies_save_meta')){
	function wpfifc_taxonomies_save_meta( $term_id ) {
			if ( isset( $_POST['wpfifc_taxonomies_create_post_ID'] ) ) {
				$default_post_ID = $_POST['wpfifc_taxonomies_create_post_ID'];
			}else if ( isset( $_POST['wpfifc_taxonomies_edit_post_ID'] ) ) {
				$default_post_ID = $_POST['wpfifc_taxonomies_edit_post_ID'];
			}
			$thumbnail_id = get_post_meta( $default_post_ID, '_thumbnail_id', true );
			if( $thumbnail_id ){
				update_option( '_wpfifc_taxonomy_term_'.$term_id.'_thumbnail_id_', $thumbnail_id );
			}
	} 
}
// when a category is removed
add_filter('deleted_term_portfolio_categories', 'remove_tax_Extras');
if(!function_exists('remove_tax_Extras')){
	function remove_tax_Extras($term_id) {
		if ( isset( $_POST['wpfifc_taxonomies_create_post_ID'] ) ) {
			$default_post_ID = $_POST['wpfifc_taxonomies_create_post_ID'];
		}else if ( isset( $_POST['wpfifc_taxonomies_edit_post_ID'] ) ) {
			$default_post_ID = $_POST['wpfifc_taxonomies_edit_post_ID'];
		}
		$thumbnail_id = get_post_meta( $default_post_ID, '_thumbnail_id', true );
		if( $thumbnail_id ){
			delete_option( '_wpfifc_taxonomy_term_'.$term_id.'_thumbnail_id_', $thumbnail_id );
		}
	}
}
add_action( 'wp_ajax_wpfifc-remove-image', 'wpfifc_ajax_set_post_thumbnail' );
if(!function_exists('wpfifc_ajax_set_post_thumbnail')){
	function wpfifc_ajax_set_post_thumbnail() {
		global $current_user;
		if ( $current_user->ID < 0 ){
			wp_die( 'ERROR:You are not allowed to do the operation.' );
		}
		$post_ID = intval( $_POST['post_id'] );
		if ( $post_ID < 1 ){
			wp_die( "ERROR:Invalid post ID.".$post_ID );
		}
		delete_post_thumbnail( $post_ID );
		$thumbnail_id = intval( $_POST['thumbnail_id'] );
		if ( $thumbnail_id == '-1' ){
			//delete option which used to saving thumbnail id
			if( $_POST['term_id'] > 0 ){
				delete_option( '_wpfifc_taxonomy_term_'.$_POST['term_id'].'_thumbnail_id_' );
			}
			$return = _wp_post_thumbnail_html( null, $post_ID );
			wp_die( $return );
		}
		wp_die( "ERROR" );
	}
}
/*if(!function_exists('rockon_event_booking')){
	function rockon_event_booking(){
		 $labels = array( 
			'name' => _x( 'Event Booking', 'booking', 'rockon' ),
			'singular_name' => _x( 'Event Booking', 'booking', 'rockon' ),
			'add_new' => _x( 'Add New', 'booking', 'rockon' ),
			'add_new_item' => _x( 'Add New Event Booking', 'booking', 'rockon' ),
			'edit_item' => _x( 'Edit Event Booking', 'booking', 'rockon' ),
			'new_item' => _x( 'New Event Booking', 'booking', 'rockon' ),
			'view_item' => _x( 'View Event Booking', 'booking', 'rockon' ),
			'search_items' => _x( 'Search Event Booking', 'booking', 'rockon' ),
			'not_found' => _x( 'No Event Booking found', 'booking', 'rockon' ),
			'not_found_in_trash' => _x( 'No Event Booking member found in Trash', 'booking', 'rockon' ),
			'parent_item_colon' => _x( 'Parent Event Booking:', 'booking', 'rockon' ),
			'menu_name' => _x( 'Event Booking ', 'booking', 'rockon' ),
			'all_items' => _x( 'Event Booking ', 'booking', 'rockon' ),
			'search_items' => _x( 'No Event Booking found', 'booking', 'rockon' )
		);
		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'thumbnail'),
			'public' => true,  
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'has_archive' => false,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => true
		);
		register_post_type( 'event_booking', $args );
	}
	add_action( 'init', 'rockon_event_booking' );
}
if(!function_exists('rockon_event_coupons')){
	function rockon_event_coupons(){
		 $labels = array( 
			'name' => _x( 'coupon', 'coupon', 'rockon' ),
			'singular_name' => _x( 'coupon', 'coupon', 'rockon' ),
			'add_new' => _x( 'Add New', 'coupon', 'rockon' ),
			'add_new_item' => _x( 'Add New coupon', 'coupon', 'rockon' ),
			'edit_item' => _x( 'Edit coupon', 'coupon', 'rockon' ),
			'new_item' => _x( 'New coupon', 'coupon', 'rockon' ),
			'view_item' => _x( 'View coupon', 'coupon', 'rockon' ),
			'search_items' => _x( 'Search coupon', 'coupon', 'rockon' ),
			'not_found' => _x( 'No coupon found', 'coupon', 'rockon' ),
			'not_found_in_trash' => _x( 'No coupon member found in Trash', 'coupon', 'rockon' ),
			'parent_item_colon' => _x( 'Parent coupon:', 'coupon', 'rockon' ),
			'menu_name' => _x( 'coupon ', 'coupon', 'rockon' ),
			'all_items' => _x( 'coupon ', 'coupon', 'rockon' ),
			'search_items' => _x( 'No coupon found', 'coupon', 'rockon' )
		);
		$args = array( 
			'labels' => $labels,
			'hierarchical' => false,
			'supports' => array( 'title'),
			'public' => false,  
			'show_ui' => true,
			'show_in_menu' => 'edit.php?post_type=event_booking',
			'show_in_nav_menus' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => true,
			'has_archive' => false,
			'query_var' => true,
			'can_export' => true,
			'rewrite' => true
		);
		register_post_type( 'event_coupons', $args );
	}
	add_action( 'init', 'rockon_event_coupons' );
}*/
?>