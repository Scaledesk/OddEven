<?php global $post; ?>
<div class="row">
 <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="col-lg-12">
		<div class="rock_blog_single">
			<?php 
			$image = get_the_post_thumbnail( $post->ID, 'full' );
			$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			if (has_post_thumbnail($post->ID)){	
				echo '<img src="'.esc_url($image).'" alt="" >';
			}				
			?>
			<?php the_title( '<h3>', '</h3>' ); ?>
        <hr>
		<?php the_content(); ?>		
		</div>
	 </div>
  </div>
</div>
<?php
$b_end = get_post_meta($post->ID,'rockon_booking_e',true); 

$date1 = current_time( 'Y-m-d G:i', 0 );
$date2 = $b_end;

if(strtotime($date1) < strtotime($date2)){
$diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24)); 
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

$hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60));

$minuts = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
}else{
	$minuts = 0;
}
?>

<div class="event_time">
<?php esc_html_e('Event Time','rockon'); ?> : 

<?php esc_html_e('from','rockon'); ?> 
<?php echo esc_html(get_post_meta($post->ID,'rockon_event_s',true)); ?> 

<?php esc_html_e('to','rockon'); ?> 
<?php echo esc_html(get_post_meta($post->ID,'rockon_event_e',true)); ?>
</div>
<div class="booking_time">
<?php esc_html_e('Event Booking Time','rockon'); ?> : 

<?php esc_html_e('from','rockon'); ?> 
<?php 
$b_start = get_post_meta($post->ID,'rockon_booking_s',true); 
echo $b_start;
?> 

<?php esc_html_e('to','rockon'); ?> 
<?php 
echo esc_html($b_end);
?>
</div>


<?php 
$ticket = 10; 

if($ticket != 0){

if($minuts != 0 || $minuts > 0){ ?>
<div class="rockon_event_sec">
	<div class="left_time">
	<?php 
		echo esc_html($days);
		esc_html_e(' days','rockon');
		echo esc_html($hours);
		esc_html_e(' hours','rockon');
		echo esc_html($minuts);
		esc_html_e(' minuts','rockon'); 
		esc_html_e(' left','rockon'); 	
	?> 
	</div>
	<div class="book_btn_div">
		<a href="" class="book_btn"><?php esc_html_e('Book','rockon'); ?></a>
	</div>
	</div>
<?php }else{ 
	esc_html_e('Event Passed','rockon');
}
}else{
	esc_html_e('No more ticket','rockon');
}

 ?>

<div class="location" style="width: 100%;">
<?php esc_html_e('Event Location','rockon'); ?> : 
<div id="event_location" style="height:400px;"></div>

<?php 
$mapaddrs = get_post_meta($post->ID,'rockon_event_lat',true).','.get_post_meta($post->ID,'rockon_event_log',true);
$mapzoom = get_post_meta($post->ID,'rockon_zoomlevel',true);
$maptitle = get_post_meta($post->ID,'rockon_event_loaction',true);
?>

<script>
var myCenter=new google.maps.LatLng(<?php echo esc_js($mapaddrs); ?>);
function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:<?php echo esc_js($mapzoom); ?>,
  scrollwheel: false, 
  mapTypeId:google.maps.MapTypeId.ROADMAP,
  styles: [{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#5c5c5c"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#191919"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#03ac89"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#272727"}]}]
  };
var map=new google.maps.Map(document.getElementById("event_location"),mapProp); 
var marker=new google.maps.Marker({
  position:myCenter,
   map: map,
  title: '<?php echo esc_js($maptitle); ?>'
  });
marker.setMap(map);
var infowindow = new google.maps.InfoWindow({
  content:"<?php echo esc_js($maptitle); ?>"
  });
google.maps.event.addListener(marker, 'click', function() {
  infowindow.open(map,marker);
  });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>

</div>

<?php 
global $rockon_data;
if(isset($rockon_data['rockon_event_sharing']) && $rockon_data['rockon_event_sharing'] == '1'){
	get_template_part('include/section-social-share'); 
}elseif(isset($rockon_data['rockon_post_sharing']) && $rockon_data['rockon_post_sharing'] == '1'){
	get_template_part('include/section-social-share'); 
}elseif(isset($rockon_data['rockon_portfolio_sharing']) && $rockon_data['rockon_portfolio_sharing'] == '1'){
	get_template_part('include/section-social-share'); 
}
?>

<br>
<br>
<br>
<br>
<br>   

<?php 
if($ticket != 0){ 
$action = '';
global $rockon_data;
if($rockon_data['rockon_paypalmode']){
$action = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
}else{
$action = 'https://www.paypal.com/cgi-bin/webscr';
}
$paypalid = $rockon_data['rockon_paypalid'];
$page_id = $rockon_data['rockon_pageid'];
?>

<!-- <form action="" method="post"> -->
<div class="rockon_event_form">
<a href="#" class="rockon_event_close_tag"></a>
<div class="rockon_event_form_inner">
<h2>Event with loaded features</h2>
<p>
<span class="ticket_left"><?php echo get_option('rockon_noofticket_'.$post->ID); ?>
</span>
</p>
<?php
$cost = 0;
$cost = get_post_meta($post->ID,'rockon_ticketcost',true);
?>
<table class="rockon_event_table">
	<tr>
		<td><strong><?php esc_html_e('Quantity','rockon'); ?></strong></td>
		<td><strong><?php esc_html_e('Single Cost','rockon'); ?></strong></td>
		<td><strong><?php esc_html_e('Total Cost','rockon'); ?></strong></td>
	</tr>
	<tr>
		<td>		
		<div class="input-group">
          <span class="input-group-btn ">
              <button type="button" class="btn btn-default btn-number event_minus">
                  <span class="glyphicon glyphicon-minus"></span>
              </button>
          </span>
          <input type="text" name="quant" class="form-control input-number" value="1" disabled>
          <span class="input-group-btn">
              <button type="button" class="btn btn-default btn-number event_plus">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
          </span>
      </div></td>
		<td>$<span class="change_cost_single"><?php echo esc_html($cost); ?></span></td>
		<td>$<span class="change_cost_total"><?php echo esc_html($cost); ?></span></td>
	</tr>
</table>
<form action="<?php echo $action; ?>" method="post" id="event_paypal_form">
<div class="rockon_input_tags">
<?php 
$coupon = get_post_meta($post->ID,'rockon_coupon',true);
if(!empty($coupon)){
?>
<div>
<input type="text" placeholder="Coupon" name="" id="coupon_code">   
<input type="hidden" placeholder="" name="" id="p_coupon_code">    
<input type="button" class="btn btn-arrow btn-4a apply_coupon" name="apply_coupon" value="Apply Coupon">
<p><img src="<?php echo ROCKON_PATH; ?>/images/madbars.gif" class="loading_event">
<span class="success_msg"></span></p>
</div>
<?php } ?>
<div class="rockon_bottom_form">
	<input type="hidden" placeholder="" name="" id="event_ajaxurl" value="<?php echo ROCKON_AJAX_URL; ?>">
	<input type="hidden" placeholder="" name="" class="event_post_id" value="<?php echo esc_attr($post->ID); ?>"> 
	<input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="business" value="<?php echo $paypalid; ?>">
    <input type="hidden" name="item_name" value="<?php echo esc_html(get_the_title($post->ID)); ?>">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="amount" value="<?php echo esc_html($cost); ?>" class="paypal_amount">
    <input type="hidden" name="no_shipping" value="0">
    <input type="hidden" name="no_note" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="lc" value="AU">
    <input type="hidden" name="bn" value="PP-BuyNowBF">
    <input type="hidden" name="custom" value="8564" class="usr_information">
    <input type="hidden" name="notify_url" value="<?php echo esc_url(get_page_link($page_id)); ?>">
    <input type="hidden" name="return" value="<?php echo esc_url(get_permalink($post->ID)); ?>">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
	<input type="text" name="name" placeholder="Full Name" value="" title="Full Name" data-validation="required" class="e_name"></div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><input type="text" name="email" placeholder="Email Address" value="" title="Email Address" data-validation="email" class="e_email"></div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><input type="text" id="bookPhone" name="phone" placeholder="Phone Number" value="" title="Phone Number" data-validation="number" class="e_number"></div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><input type="text" id="bookAddress" name="address" placeholder="Your Address" value="" title="Your Address" data-validation="required" class="e_address"></div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center"><input type="submit" value="Paypal Now"><input type="submit" value="Paypal Later"></div>
	</div>
	</div>
</form>
</div>
<div class="rockon_form_overlay"></div>
</div>

<?php } ?>