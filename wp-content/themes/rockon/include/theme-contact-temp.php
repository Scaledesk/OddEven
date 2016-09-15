<?php
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
?>
<div class="container">
  <div class="rock_contact">
    <div class="row">
      <div class="col-lg-5 col-md-5 col-sm-5">
        <form id="rockon_contactform" method="post">
		<input type="hidden" value="<?php echo ROCKON_AJAX_URL; ?>"  id="rockon_ajaxurl">
			<?php 
			foreach($fields['ENABLE'] as $key=>$val){
			switch($key){
				case 'NAME':
					if(isset($require['REQUIRE']['NAME'])){
						$validate = 'data-validation="required"';
					}
				  echo '<div class="form-group">
				  <input type="text" '.$validate.' value="" placeholder="'.esc_html__('Name','rockon').'" name="name" class="form-control"/></div>';
				break;
				case 'EMAIL' :
					if(isset($require['REQUIRE']['EMAIL'])){
						$validate = 'data-validation="email"';
					}
					echo '<div class="form-group"><input value="" placeholder="'.esc_html__('Email','rockon').'"  type="text" name="email" '.$validate.' class="form-control"/></div>';
				break;
				case 'PHONENUMBER' :
					if(isset($require['REQUIRE']['PHONENUMBER'])){
						$validate = 'data-validation="number"';
					}
					echo '<div class="form-group"><input type="text" value="" placeholder="'.esc_html__('Phone No','rockon').'" name="phono" '.$validate.' class="form-control"/></div>';
				break;
				case 'WEBSITE':
					if(isset($require['REQUIRE']['WEBSITE'])){
						$validate = 'data-validation="url"';
					}
					echo '<div class="form-group"><input value="" placeholder="'.esc_html__('Weburl','rockon').'"  type="text" '.$validate.' name="web" class="form-control"/></div>';
				break;
				case 'MESSAGE' :
					if(isset($require['REQUIRE']['MESSAGE'])){
						$validate = 'data-validation="required"';
					}
					 echo '<div class="form-group"><textarea name="Message" id="Message" '.$validate.' class="form-control" rows="10" placeholder="'.esc_html__('Your Message','rockon').'"></textarea></div>';
				break;	
			}
			$validate = '';
		}
			?>
          <input type="submit" id="em_sub" class="btn btn-default btn-lg" value="<?php esc_html_e('Submit Your Message','rockon'); ?>">
          <p id="rockon_infotext"></p>
        </form>
      </div>
      <div class="col-lg-7 col-md-7 col-sm-7">
        <div class="rock_contact_detail">
          <div>
            <p><i class="fa fa-envelope"></i> <a href="mailto:<?php esc_attr($contactemail); ?>"><?php esc_html($contactemail); ?></a></p>
            <p><i class="fa fa-mobile"></i> <a href="">+<?php esc_html($contactphone); ?></a></p>
          </div>
          <div>
            <p><i class="fa fa-map-marker"></i> <a href=""><?php esc_html($contactaddress); ?></a></p>
            <p><i class="fa fa-globe"></i> <a href="#"><?php echo esc_html($weburl); ?></a></p>
          </div>
        </div>
        <div class="rock_map">
<?php if($mapon == '1'){ ?>
<script>
var myCenter=new google.maps.LatLng(<?php echo esc_js($mapaddrs); ?>);
function initialize()
{
var mapProp = {
  center:myCenter,
  zoom:<?php echo esc_js($mapzoom); ?>,
  scrollwheel: false,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };
var map=new google.maps.Map(document.getElementById("rockon_googleMap"),mapProp);
var marker=new google.maps.Marker({
  position:myCenter,
   map: map,
  title: '<?php echo esc_js($maptitle); ?>'
  });
marker.setMap(map);
var infowindow = new google.maps.InfoWindow({
  content:""
  });
google.maps.event.addListener(marker, 'click', function() {
  infowindow.open(map,marker);
  });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
          <div id="rockon_googleMap" style="width:100%;height:355px;"></div>
<?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>