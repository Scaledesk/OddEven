<?php
add_action('admin_menu', 'rockoncore_submenu_event');
function rockoncore_submenu_event() {
	add_submenu_page( 'edit.php?post_type=event_booking', 'view booking', 'view booking', 'manage_options', 'event_view_booking', 'event_view_booking' );
}
function event_view_booking(){
	global $wpdb,$post;
	/*
	$sql = "SELECT * FROM $table_name WHERE ";*/
	$table_name = $wpdb->prefix . "event_booking_info";
	$args = array(
		'post_type' => 'event_booking', 
		'posts_per_page' => -1
	);
	$query = new WP_Query($args);
	
	if ( $query->have_posts() ) :
		echo '<h3>Event List</h3><table id="event_booking_tbl">';
			echo '<thead>';
			echo '<tr>';
			echo '<th>S. No.</th>';
			echo '<th>Name</th>';
			echo '<th>Total Ticket</th>';
			echo '<th>Sold Ticket</th>';
			echo '<th>Total Payment</th>';
			echo '<th>Use Coupon</th>';
			echo '<th>Details</th>';
			echo '</tr>';
			echo '</thead>';
			$i = 0;
			echo '<tbody>';
		while ( $query->have_posts() ) : $query->the_post();
			$i++;
			$ticket = get_post_meta($post->ID,'rockon_noofticket',true);
			$sale_ticket = $ticket - get_option('rockon_noofticket_'.$post->ID);
			$total_payment = $wpdb->get_var( "SELECT SUM(payment) FROM $table_name where event_id = ".$post->ID );
			$total_coupon = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE event_id = ".$post->ID." AND coupon_code  != '' " );
			echo '<tr>';
			echo '<td>'.esc_html($i).'</td>';
			echo '<td>'.esc_html(get_the_title($post->ID)).'</td>';
			echo '<td>'.esc_html($ticket).'</td>';
			echo '<td>'.esc_html($sale_ticket).'</td>';
			echo '<td>$'.esc_html($total_payment).'</td>';
			echo '<td>'.esc_html($total_coupon).'</td>';
			echo '<td><a href="" class="event_detail" data="'.esc_attr($post->ID).'">'.__('View Details','rockon').'</a></td>';
			echo '</tr>';
		endwhile; 
			echo '</tbody>';
		echo '</table>';
		echo '<input type="hidden" name="" value="'.ROCKON_AJAX_URL.'" id="rockon_ajaxurl">';
		echo '<div class="event_maindetail_cls">';
		echo '<a href="javascript:;" class="event_close"></a>';
		echo '<div class="event_table_text"><div class="event_container view_detials">';
		echo '</div><div class="event_popup_overlay"></div></div></div>';
	else :
		echo '<p>'; _e( 'Sorry, no event found.' ); echo '</p>';
	endif;
	wp_reset_postdata();
}

add_action( 'wp_ajax_view_event_details', 'view_event_details' );

function view_event_details() {
	if($_POST['event_id']){
		global $wpdb;
		$id = $_POST['event_id'];
		$table_name = $wpdb->prefix . "event_booking_info";
		$sql = "SELECT * FROM $table_name WHERE event_id = $id";
		$result = $wpdb->get_results($sql);
		echo json_encode(array(
			'event_name'=>get_the_title($id),
			'result'=>$result,
			'ticket_left'=> get_option('rockon_noofticket_'.$id)
		));
	}else{
		echo 'No event exist';
	}
    die();
}
?>