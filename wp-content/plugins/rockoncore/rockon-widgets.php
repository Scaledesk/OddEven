<?php
class location_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'location_Widget',
			__('Rockon Address Location', 'rockon'), 
			array( 'description' => __( 'Footer Address Location Widget', 'rockon' ), 'rockon')
		);
	}
	public function widget( $args, $instance ) {
		if( isset($instance['rockon_imgurl']) ||
			isset($instance['rockon_location_head']) ||
			isset($instance['rockon_opening_hours_head']) ||
			isset($instance['rockon_happy_hours_head']) ||
			isset($instance['rockon_location_desc']) ||
			isset($instance['rockon_opening_hours_desc']) ||
			isset($instance['rockon_happy_hours_desc'])
		)
		{
			$img = $instance['rockon_imgurl'];
			$l_heading = $instance['rockon_location_head'];
			$l_desc = $instance['rockon_location_desc'];
			$oh_heading = $instance['rockon_opening_hours_head'];
			$oh_desc = $instance['rockon_opening_hours_desc'];
			$hh_heading = $instance['rockon_happy_hours_head'];
			$hh_desc = $instance['rockon_happy_hours_desc'];
		}
		else {
			$img = '';
			$l_heading = '';
			$l_desc = '';
			$oh_heading = '';
			$oh_desc = '';
			$hh_heading = '';
			$hh_desc = '';
		}
		echo $args['before_widget'];
		echo '<div class="rock_footer_logo"> <img src="'.esc_url($img).'" alt="footer logo" /> </div>
            <h3>'.__(esc_attr($l_heading),'rockon').'</h3>
            <p>'.__(esc_attr($l_desc),'rockon').'</p>
            <h3>'.__(esc_attr($oh_heading),'rockon').'</h3>
            <p>'.__(esc_attr($oh_desc),'rockon').'</p>
            <h3>'.__(esc_attr($hh_heading),'rockon').'</h3>
            <p>'.__(esc_attr($hh_desc),'rockon').'</p>';
		echo $args['after_widget'];
	}
	public function form( $instance ) {
		if( isset($instance['rockon_imgurl']) ||
			isset($instance['rockon_location_head']) ||
			isset($instance['rockon_opening_hours_head']) ||
			isset($instance['rockon_happy_hours_head']) ||
			isset($instance['rockon_location_desc']) ||
			isset($instance['rockon_opening_hours_desc']) ||
			isset($instance['rockon_happy_hours_desc'])
		)
		{
			$img = $instance['rockon_imgurl'];
			$l_heading = $instance['rockon_location_head'];
			$l_desc = $instance['rockon_location_desc'];
			$oh_heading = $instance['rockon_opening_hours_head'];
			$oh_desc = $instance['rockon_opening_hours_desc'];
			$hh_heading = $instance['rockon_happy_hours_head'];
			$hh_desc = $instance['rockon_happy_hours_desc'];
		}
		else {
			$img = '';
			$l_heading = '';
			$l_desc = '';
			$oh_heading = '';
			$oh_desc = '';
			$hh_heading = '';
			$hh_desc = '';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'rockon_imgurl' ); ?>"><?php echo 'Upload Image:'; ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'rockon_imgurl' ); ?>" name="<?php echo $this->get_field_name( 'rockon_imgurl' ); ?>" type="text" value="<?php if(isset($img)) echo esc_attr($img); ?>" >
		<input type="button" class="rockon_upload_image_button button button-primary" value="upload">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'rockon_imgurl' ); ?>"><?php echo 'Heading'; ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'rockon_location_head' ); ?>" name="<?php echo $this->get_field_name( 'rockon_location_head' ); ?>" type="text" value="<?php if(isset($l_heading)) echo esc_attr($l_heading);?>" Placeholder="Location" > 
		<br><br>
		<input class="widefat" id="<?php echo $this->get_field_id( 'rockon_opening_hours_head' ); ?>" name="<?php echo $this->get_field_name( 'rockon_opening_hours_head' ); ?>" type="text" value="<?php if(isset($oh_heading)) echo esc_attr($oh_heading);?>" Placeholder="Opening Hours" > 
		<br><br>
		<input class="widefat" id="<?php echo $this->get_field_id( 'rockon_happy_hours_head' ); ?>" name="<?php echo $this->get_field_name( 'rockon_happy_hours_head' ); ?>" type="text" value="<?php if(isset($hh_heading)) echo esc_attr($hh_heading);?>" Placeholder="Happy Hours" > 
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'rockon_imgurl' ); ?>"><?php echo 'Description'; ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'rockon_location_desc' ); ?>" name="<?php echo $this->get_field_name( 'rockon_location_desc' ); ?>" type="text" value="<?php if(isset($l_desc)) echo esc_attr($l_desc);?>" Placeholder="PO Box 16122 Collins Street West Victoria 8007 Australia" > 
		<br><br>
		<input class="widefat" id="<?php echo $this->get_field_id( 'rockon_opening_hours_desc' ); ?>" name="<?php echo $this->get_field_name( 'rockon_opening_hours_desc' ); ?>" type="text" value="<?php if(isset($oh_desc)) echo esc_attr($oh_desc);?>" Placeholder="MON - FRI 9 AM TO 10 PM" > 
		<br><br>
		<input class="widefat" id="<?php echo $this->get_field_id( 'rockon_happy_hours_desc' ); ?>" name="<?php echo $this->get_field_name( 'rockon_happy_hours_desc' ); ?>" type="text" value="<?php if(isset($hh_desc)) echo esc_attr($hh_desc);?>" Placeholder="MON - FRI 2 PM TO 06 PM" > 
		</p>
	<?php 
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['rockon_imgurl'] = (!empty($new_instance['rockon_imgurl']))?strip_tags($new_instance['rockon_imgurl']):'';
		$instance['rockon_location_head'] = (!empty($new_instance['rockon_location_head']))?strip_tags($new_instance['rockon_location_head']):'';
		$instance['rockon_location_desc'] = (!empty($new_instance['rockon_location_desc']))?strip_tags($new_instance['rockon_location_desc']):'';
		$instance['rockon_opening_hours_head'] = (!empty($new_instance['rockon_opening_hours_head']))?strip_tags($new_instance['rockon_opening_hours_head']):'';
		$instance['rockon_opening_hours_desc'] = (!empty($new_instance['rockon_opening_hours_desc']))?strip_tags($new_instance['rockon_opening_hours_desc']):'';
		$instance['rockon_happy_hours_head'] = (!empty($new_instance['rockon_happy_hours_head']))?strip_tags($new_instance['rockon_happy_hours_head']):'';
		$instance['rockon_happy_hours_desc'] = (!empty($new_instance['rockon_happy_hours_desc']))?strip_tags($new_instance['rockon_happy_hours_desc']):'';
		return $instance;
	}
}
function register_address_location() {
    register_widget( 'location_Widget' );
}
add_action( 'widgets_init', 'register_address_location' );
class Recent_post extends WP_Widget {
	function __construct() {
		parent::__construct(
			'Recent_post', // Base ID
			__('Rockon Recent work', 'rockon'), // Name
			array( 'description' => __( 'Footer Recent work Widget', 'rockon' ), ) // Args
		);
	} 
	public function widget( $args, $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
			$no_of_post = $instance[ 'no_of_post' ];
		}
		else {
			$title = '';
			$no_of_post = '';
		}
		echo $args['before_widget'];
		echo '<div class="rock_recent_post">';
		echo $args['before_title'] . __(esc_attr($title),'rockon') . $args['after_title'];
		echo '<ul class="bxslider">';
		global $post;
		$arg = array(
			'post_type'=>'post',
			'posts_per_page'=>$no_of_post,
			//'post__in' => get_option( 'sticky_posts' )
		);
		query_posts( $arg );   
		if ( have_posts() ) : while ( have_posts() ) : the_post(); 
			echo '<li>';
				if ( has_post_thumbnail() ) {
					the_post_thumbnail('rockon-small-size');
				}else{
					echo '<img src="'.ROCKON_PATH.'/images/no_image.jpg">';
				}	
			echo '<div class="rock_post_detail"> <a href="'.esc_url(get_permalink()).'">'.__(get_excerpt(60),'rockon').'</a>
                    <p><span class="label label-default">';
			the_time('F j, Y');
			echo '</span></p>
                  </div>
                </li>';
		endwhile; endif;	
		wp_reset_query();
		echo '</ul>';
		echo '</div>';
		echo $args['after_widget'];
	}
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) || isset( $instance[ 'no_of_post' ] ) ) {
			$title = $instance[ 'title' ];
			$no_of_post = $instance[ 'no_of_post' ];
		}
		else {
			$title = '';
			$no_of_post = '';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'no_of_post' ); ?>"><?php echo 'No Of Post:'; ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'no_of_post' ); ?>" name="<?php echo $this->get_field_name( 'no_of_post' ); ?>" type="text" value="<?php echo esc_attr( $no_of_post ); ?>">
		</p>
		  <?php 
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['no_of_post'] = ( ! empty( $new_instance['no_of_post'] ) ) ? strip_tags( $new_instance['no_of_post'] ) : '';
    return $instance;
	}
}
function register_recentpost_widget() {
    register_widget( 'Recent_post' );
}
add_action( 'widgets_init', 'register_recentpost_widget' );
class Twitter_feed extends WP_Widget {
	function __construct() {
		parent::__construct(
			'Twitter_feed', // Base ID
			__('Rockon Twitter Feed', 'rockon'), // Name
			array( 'description' => __( 'Footer Twitter Feed Widget', 'rockon' ), ) // Args
		);
	} 
	public function widget( $args, $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
			$key = $instance[ 'consumer_key' ];
			$secret = $instance[ 'consumer_secret' ];
			$access_token = $instance[ 'oauth_access_token' ];
			$access_token_secret = $instance[ 'oauth_access_token_secret' ];
			$count = $instance[ 'count_feed' ];
		}
		else {
			$title = '';
			$key = '';
			$secret = '';
			$access_token = '';
			$access_token_secret = '';
			$count = 2;
		}
		require_once (get_template_directory() . '/twitter/TwitterAPIExchange.php');
		/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
		if(!empty($instance['oauth_access_token']) && !empty($instance['oauth_access_token_secret']) && !empty($instance['consumer_key']) && !empty($instance['consumer_secret']) ){
			$settings = array(
				'oauth_access_token' => esc_attr($access_token),
				'oauth_access_token_secret' => esc_attr($access_token_secret),
				'consumer_key' => esc_attr($key),
				'consumer_secret' => esc_attr($secret)
			);
			$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
			$getfield = '?username=loklove123&skip_status=1';
			$requestMethod = 'GET';
			$twitter = new TwitterAPIExchange($settings);
			$twisss= $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest(); 
			$myarr=json_decode($twisss);
			echo $args['before_widget'];
			if(!$myarr)
			{
				echo ' <div class="item"> 
				<div class="hs_twitter_feed_content">
				<h2>'.__('YOu have not created the twitter app , Please create the twitter app for your site. Thankyou','rockon').'</h2>
				</div>
				<div class="carousel-caption"></div>
				</div>';
			}
			else{
				echo '<div class="rock_twitter_feed">';
				echo $args['before_title'] . __(esc_attr($title),'rockon') . $args['after_title'];
				echo '<ul>';
				for($i=0;$i<$count;$i++)
				{
					echo '<li> <i class="fa fa-twitter"></i>
                  <div class="rock_feed"> <a href="">'.__($myarr[$i]->text,'rockon').'</a>
                    <p><span class="label label-default">'.__(human_time_diff( strtotime($myarr[$i]->created_at), strtotime(date('Y-m-d H:i:s')) ).' Ago','rockon').'</span></p>
                  </div>
                </li>';
				}
				echo '</ul></div>';
			}
		}else{
			echo ' <div class="item"> 
				<div class="hs_twitter_feed_content">
				<h2>'.__('YOu have not created the twitter app , Please create the twitter app for your site. Thankyou','rockon').'</h2>
				</div>
				<div class="carousel-caption"></div>
				</div>';
		}
		echo $args['after_widget'];
	}
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
			$key = $instance[ 'consumer_key' ];
			$secret = $instance[ 'consumer_secret' ];
			$access_token = $instance[ 'oauth_access_token' ];
			$access_token_secret = $instance[ 'oauth_access_token_secret' ];
			$count = $instance[ 'count_feed' ];
		}
		else {
			$title = '';
			$key = '';
			$secret = '';
			$access_token = '';
			$access_token_secret = '';
			$count = 2;
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo 'Title:'; ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php if(isset($title)) echo esc_attr( $title ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'count_feed' ); ?>"><?php echo 'Show No Of Feed:'; ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'count_feed' ); ?>" name="<?php echo $this->get_field_name( 'count_feed' ); ?>" type="text" value="<?php if(isset($count)) echo esc_attr( $count ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'consumer_key' ); ?>"><?php echo 'Consumer Key:'; ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'consumer_key' ); ?>" name="<?php echo $this->get_field_name( 'consumer_key' ); ?>" type="text" value="<?php if(isset($key)) echo esc_attr( $key ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'consumer_secret' ); ?>"><?php echo 'Consumer Secret:'; ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'consumer_secret' ); ?>" name="<?php echo $this->get_field_name( 'consumer_secret' ); ?>" type="text" value="<?php if(isset($secret)) echo esc_attr( $secret ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'oauth_access_token' ); ?>"><?php echo 'Access Token:'; ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'oauth_access_token' ); ?>" name="<?php echo $this->get_field_name( 'oauth_access_token' ); ?>" type="text" value="<?php if(isset($access_token)) echo esc_attr( $access_token ); ?>">
		</p>
		<p>
		<label for="<?php echo $this->get_field_id( 'oauth_access_token_secret' ); ?>"><?php echo 'Access Token Secret:'; ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'oauth_access_token_secret' ); ?>" name="<?php echo $this->get_field_name( 'oauth_access_token_secret' ); ?>" type="text" value="<?php if(isset($access_token_secret)) echo esc_attr( $access_token_secret ); ?>">
		</p>
		  <?php 
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['consumer_key'] = ( ! empty( $new_instance['consumer_key'] ) ) ? strip_tags( $new_instance['consumer_key'] ) : '';
		$instance['consumer_secret'] = ( ! empty( $new_instance['consumer_secret'] ) ) ? strip_tags( $new_instance['consumer_secret'] ) : '';
		$instance['oauth_access_token'] = ( ! empty( $new_instance['oauth_access_token'] ) ) ? strip_tags( $new_instance['oauth_access_token'] ) : '';
		$instance['oauth_access_token_secret'] = ( ! empty( $new_instance['oauth_access_token_secret'] ) ) ? strip_tags( $new_instance['oauth_access_token_secret'] ) : '';
		$instance['count_feed'] = ( ! empty( $new_instance['count_feed'] ) ) ? strip_tags( $new_instance['count_feed'] ) : '';
		return $instance;
	}
}
function register_twitter_feed_widget() {
    register_widget( 'Twitter_feed' );
}
add_action( 'widgets_init', 'register_twitter_feed_widget' );
?>