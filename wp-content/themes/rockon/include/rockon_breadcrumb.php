<?php
if(!function_exists('rockon_the_breadcrumb')){
	function rockon_the_breadcrumb($title = null) {
		global $post;
		echo '<!-- Breadcrumb-Start -->
<div class="container">
      <div class="rock_heading_div">
        <div class="rock_heading">
          <h1>'.esc_html($title).'</h1>
          <p>X</p>
        </div>
      </div>
      <div class="rock_pager">
       ';
		echo '<ul class="hs_breadcrumb">';
		if (!is_home()) {
			echo '<li><a href="';
			echo home_url();
			echo '">';
			echo 'Home';
			echo '</a></li>';
			if (is_category() || is_single()) {
				$categories = get_the_category($post->ID);
				if($categories){
					foreach($categories as $category) {
						echo '<li>';
						echo '<a href="'.esc_url(get_category_link( $category->term_id )).'" >'.esc_html($category->cat_name).'</a>';
						echo '</li>';
					}
				}
				//the_category(' </li><li> ');  
				if (is_single()) {
					echo '</li><li>';
					the_title();
					echo '</li>';
				}
			} elseif (is_page()) {
				if($post->post_parent){
					$anc = get_post_ancestors( $post->ID );
					$title = get_the_title($post->ID);
					foreach ( $anc as $ancestor ) {
						$output = '<li><a href="'.esc_url(get_permalink($ancestor)).'" title="'.esc_attr(get_the_title($ancestor)).'">'.esc_html(get_the_title($ancestor)).'</a></li> ';
					}
					echo $output;
					echo '<li><strong title="'.esc_attr($title).'"> '.esc_html($title).'</strong></li>';
				} else {
					echo '<li><strong> '.esc_html(get_the_title($post->ID)).'</strong></li>';
				}
			}
		}
		elseif (is_tag()) {single_tag_title();}
		elseif (is_day()) {echo"<li>Archive for "; the_time('F jS, Y'); echo'</li>';}
		elseif (is_month()) {echo"<li>Archive for "; the_time('F, Y'); echo'</li>';}
		elseif (is_year()) {echo"<li>Archive for "; the_time('Y'); echo'</li>';}
		elseif (is_author()) {echo"<li>Author Archive"; echo'</li>';}
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {echo "<li>Blog Archives"; echo'</li>';}
		elseif (is_search()) {echo"<li>";esc_html_e('Search Results','rockon'); echo'</li>';}
		echo ' </ul>
      </div>
    </div>';
	}
}
?>