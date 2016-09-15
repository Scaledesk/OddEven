<?php 
/*********=============== Save event booking data ============*****************/
add_action( 'wp_ajax_rockon_save_event_booking_data', 'rockon_save_event_booking_data' );
add_action( 'wp_ajax_nopriv_rockon_save_event_booking_data', 'rockon_save_event_booking_data' );
function rockon_save_event_booking_data(){
	$ticket = get_option('rockon_noofticket_'.$_POST['event_id']); 
	if($ticket != 0 || $ticket > 0){
		$coupon = '';
		//$coupon = get_post_meta($_POST['event_id'],'rockon_coupon',true);
		if(!empty($_POST['couponcode'])){
			$coupon = $_POST['couponcode'];
		}
		/*$limit = get_option('rockon_limit'.$coupon);
		if($limit > 0 ){
			update_option('rockon_limit'.$coupon,$limit - 1);
		}*/
		global $wpdb;
		$table_name = $wpdb->prefix . "event_booking_info";
		$custom = wp_rand(0,100000);
		$data = array( 
			'name' => $_POST['name'], 
			'email' => $_POST['email'],		
			'phonenumber' => $_POST['number'],		
			'address' => $_POST['adderss'],		
			'event_id' => $_POST['event_id'],		
			'qty' => $_POST['qty'],		
			'coupon_code' => $coupon,		
			'status' => $custom,		
		);
		$result = $wpdb->insert( $table_name, $data);
		//update_option('rockon_noofticket_'.$_POST['event_id'],$ticket - 1);
		if($result){
			$args = array(
			  'name'        => $coupon,
			  'post_type'   => 'event_coupons',
			  'post_status' => 'publish',
			  'numberposts' => 1
			);
			$my_posts = get_posts($args);
			$id = '';
			if( $my_posts ) :
				$id = $my_posts[0]->ID;
			endif;
			echo $custom.'-'.$id.'-'.$_POST['event_id'];
		}else{
			echo 'Something Wrong..!!';
		}
	}else{
		echo 'Sorry no more ticket..!!';
	}
	die();
}
/*********=============== Save event booking data ============*****************/

/*********=============== Check coupon code ============*****************/
add_action( 'wp_ajax_rockon_checkcouponcode', 'rockon_checkcouponcode' );
add_action( 'wp_ajax_nopriv_rockon_checkcouponcode', 'rockon_checkcouponcode' );
function rockon_checkcouponcode(){
	$args = array(
	  'name'        => $_POST['slug'],
	  'post_type'   => 'event_coupons',
	  'post_status' => 'publish',
	  'numberposts' => 1
	);
	$my_posts = get_posts($args);
	$id = '';
	if( $my_posts ) :
		$id = $my_posts[0]->ID;
	endif;
	$coupon = get_post_meta($_POST['postid'],'rockon_coupon',true);
	if($id == $coupon ){
		$limit = get_option('rockon_limit'.$id);
		if($limit == -1 || $limit > 0 ){
			//update_option('rockon_limit'.$id,$limit - 1);
			$discount_on = get_post_meta($id,'rockon_discounton',true);
			$amount = get_post_meta($id,'rockon_discount',true);
			if($discount_on < $_POST['qty']){
				echo json_encode(array('1',$amount,'coupon applied.'));
			}else{
				echo json_encode(array('sorry ticket quanty low.'));
			}
		}else{
			echo json_encode(array('sorry Coupon has expired'));
		}
	}else{
		echo json_encode(array('sorry Coupon not valid, please try again.'));
	}
	die();
}
/*********=============== Check coupon code ============*****************/

/*********=============== Get Fixed Content ============*****************/
if(!function_exists('get_excerpt')){
	function get_excerpt($count){
	  global $post;
	  $permalink = get_permalink($post->ID);
	  $excerpt = get_the_content();
	  $excerpt = strip_tags($excerpt);
	  $excerpt = substr($excerpt, 0, $count);
	  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	  $excerpt = $excerpt.'... ';
	  return $excerpt;
	}
}

/*********=============== Edit Search Form ============*****************/
if(!function_exists('rockon_search_form')){
	function rockon_search_form( $form ) {
		$form = '<form class="form-inline" role="search" method="get" action="' .esc_url(home_url( '/' )) . '" >
            <div class="form-group has-feedback">
				<label class="screen-reader-text" for="s">' . __( 'Search for:' ,'rockon' ) . '</label>
              <input type="text" class="form-control" placeholder="'.esc_html__('Search Keyword','rockon').'" id="s" value="'.get_search_query().'"  name="s">
              <span class="glyphicon glyphicon-search form-control-feedback"></span> </div>
          </form>';

		return $form;
	}
}
add_filter( 'get_search_form', 'rockon_search_form' );

/*********=============== Footer ============*****************/
if(!function_exists('rockon_youtubevideo_single')){
	function rockon_youtubevideo_single(  ) {
		if(is_single()){	
			$video = '';
			global $post;
			$audiosrc = get_post_meta( $post->ID, 'rockon_audio_src', true );
			if(!empty($audiosrc)){
				$filetype = wp_check_filetype($audiosrc);
				$type = $filetype['type'];
				if(function_exists('rockoncore_parseVideoURL')) $audiosrc = esc_url(rockoncore_parseVideoURL($audiosrc));
				if($type != 'audio/mpeg'){
					$video = '<script>var youtube = {"@type": "VideoObject","playerType": "iframe","embedURL":"'.esc_js($audiosrc).'"};mediaFactory.insert(youtube, {strategy: "mediaElement", width: 1140, height: 540}, "rockon_youtube_player");</script>';
				}
			}
			echo $video;
		}
	}
}
add_action( 'wp_footer', 'rockon_youtubevideo_single' );

/*********=============== Header ============*****************/
add_action('wp_head','customcss_rockonoption');
if(!function_exists('customcss_rockonoption')){
	function customcss_rockonoption(){
		global $rockon_data;
		$css = $rockon_data['rockon_customcss'];
		$css_output = "<!-- Custom CSS -->\n<style type=\"text/css\">\n" . $css . "\n</style>";
		if(!empty($css)) {
			echo $css_output;
		}
	}
}

/**
 * Add custom HTML between the `</h3>` and the `<form>` tags in the comment_form() output.
 */
function rockon_wpse_156112_rs( $comment_registration )
{
     // Adjust this to your needs:
     echo '<div class="rock_heading_div">
        <div class="rock_heading">
          <h1>'.esc_html__('Leave a Comment','rockon').'</h1>
          <p>X</p>
        </div>
      </div>'; 

    remove_filter( current_filter(), __FUNCTION__ );
    return $comment_registration;
}
add_action( 'comment_form_before', 'rockon_fun_comment_form' );
function rockon_fun_comment_form(){
    add_filter( 'pre_option_comment_registration', 'rockon_wpse_156112_rs' );
}

/*********==== Sidebar Position ====*****************/
function sidebar_position_post(){
	global $rockon_data; 
	$position = $rockon_data['rockon_sidebarposition'];
	switch($position){
		case 1:
			$position = 'full';
		break;
		case 2:
			$position = 'left';
		break;
		case 3:
			$position = 'right';
		break;
		default :
			$position = 'right';
		break;
	}
	return $position;
}

function rockon_plupload_admin_head() {  
// place js config array for plupload
    $plupload_init = array(
        'runtimes' => 'html5,silverlight,flash,html4',
        'browse_button' => 'plupload-browse-button', // will be adjusted per uploader
        'container' => 'plupload-upload-ui', // will be adjusted per uploader
        'drop_element' => 'drag-drop-area', // will be adjusted per uploader
        'file_data_name' => 'async-upload', // will be adjusted per uploader
        'multiple_queues' => true,
        'max_file_size' => wp_max_upload_size() . 'b',
        'url' => admin_url('admin-ajax.php'),
        'flash_swf_url' => includes_url('js/plupload/plupload.flash.swf'),
        'silverlight_xap_url' => includes_url('js/plupload/plupload.silverlight.xap'),
        'filters' => array(array('title' => esc_html__('Allowed Files','rockon'), 'extensions' => '*')),
        'multipart' => true,
        'urlstream_upload' => true,
        'multi_selection' => false, // will be added per uploader
         // additional post data to send to our ajax hook
        'multipart_params' => array(
            '_ajax_nonce' => "", // will be added per uploader
            'action' => 'plupload_action', // the ajax action name
            'imgid' => 0 // will be added per uploader
        )
    );
	echo '<script type="text/javascript"> var base_plupload_config='.json_encode($plupload_init).'</script>';
}
add_action("admin_head", "rockon_plupload_admin_head"); 

function rockon_g_plupload_action() {
 
    // check ajax noonce
    $imgid = $_POST["imgid"];
    check_ajax_referer($imgid . 'pluploadan');
 
    // handle file upload
    $status = wp_handle_upload($_FILES[$imgid . 'async-upload'], array('test_form' => true, 'action' => 'plupload_action'));
 
    // send the uploaded file url in response
    echo $status['url'];
    exit;
}
add_action('wp_ajax_plupload_action', "rockon_g_plupload_action"); 

function rockon_pagemeta(){
	$id = rockon_return_id();
	
	$pagetitle = get_post_meta($id, 'rockon_pagetitle', true);
	$position = get_post_meta($id, 'rockon_page_sidebarposition', true);
	
	return array(
		'pagetitle' => empty($pagetitle) ? 'enable' : $pagetitle,
		'position' => empty($position) ? 'right' : $position,
	);
}

function rockon_post(){
	global $post;
	return $post;
}

function rockon_return_id(){
	global $post, $wp_query;
	$current_page_id = '';
	// Get The Page ID You Need
	//wp_reset_postdata();
	if( class_exists('woocommerce') ) {
		if( is_shop() ){ 
			$current_page_id  =  get_option ( 'woocommerce_shop_page_id' );
		}elseif(is_cart()) {
			$current_page_id  =  get_option ( 'woocommerce_cart_page_id' );
		}elseif(is_checkout()){
			$current_page_id  =  get_option ( 'woocommerce_checkout_page_id' );
		}elseif(is_account_page()){
			$current_page_id  =  get_option ( 'woocommerce_myaccount_page_id' );
		}elseif(is_view_order_page()){
			$current_page_id  = get_option ( 'woocommerce_view_order_page_id' );
		}
	}
	
	if($current_page_id=='') {
		if ( is_home () && is_front_page () ) {
			$current_page_id = '';
		} elseif ( is_home () ) {
			$current_page_id = get_option ( 'page_for_posts' );
		} elseif ( is_search () || is_category () || is_tag () || is_tax () ) {
			$current_page_id = '';
		} elseif ( !is_404 () ) {
		   $current_page_id = $post->ID;
		} 
	}
	return $current_page_id;
	
}

function rockon_header_add_to_cart_fragment( $fragments ) {
 
    ob_start();
    $count = WC()->cart->cart_contents_count;
    ?><a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'rockon' ); ?>"><?php if ( $count > 0 ) echo '<span>' . $count . '</span>'; ?></a><?php
  
    $fragments['a.cart-contents'] = ob_get_clean();
     
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'rockon_header_add_to_cart_fragment' );
?>