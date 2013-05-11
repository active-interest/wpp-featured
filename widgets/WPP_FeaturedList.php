<?php
/**  
 * Copyright (c) 2013, WP Poets and/or its affiliates <plugins@wppoets.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
/**
 * @author David Higgins <higginsd@zoulcreations.com>
 */

add_action('widgets_init', 'wpp_featured_list_register');
function wpp_featured_list_register() {
	register_widget('WPP_FeaturedListWidget');
}

class WPP_FeaturedListWidget extends WP_Widget
{
	const widgetName = 'WPP Featured List';
	const widgetClassName = 'WPP_FeaturedListWidget';
	const widgetIdBase = 'wpp-featured-widget';
	
	public function __construct() {
		$widget_ops = array(
			'classname' => self::widgetClassName, 
			'description' => 'Displays a list of Featured Posts',
		);
		$control_ops = array(
			'width'=> 300,
			'id_base' => self::widgetIdBase,
		);
		parent::__construct(self::widgetIdBase, self::widgetName, $widget_ops, $control_ops);

	}

	public function widget($args, $instance) {
		extract($args);
		$title = isset($instance['title']) ? apply_filters('widget_title', $instance['title']) : null;
		$numposts = isset($instance['numberposts']) ? $instance['numberposts'] : null;
		$slug = isset($instance['author_slug']) ? $instance['author_slug'] : null;
		$user = get_user_by('slug', $slug);
		$post_args = array(
			'numberposts' => $numposts,
		);
		if(!empty($slug)) {
			$user = get_user_by('slug', $slug);
			if($user) $post_args['author'] = $user->ID;
		}

		$posts = get_posts($post_args);
		if(count($posts) > 0) {
			echo $before_widget;
			if($title) echo '<h3 class="widget-title">' . $title . '</h3>';
			
			echo '<ul class="' . self::widgetIdBase . '">';
			$lcv = 0;
			foreach($posts as $post) {
				echo '<li class="' . ($lcv == 0 ? 'first item' : ($lcv == count($posts)-1 ? 'last item' : 'item')) . '">';
				echo '<a href="' . get_permalink($post->ID) . '" title="' . get_the_title($post->ID) . '">';
				echo get_the_title($post->ID);
				echo '</a></li>';
				$lcv++;
			}
			echo '</ul>';
			echo $after_widget;
		}
	}

	public function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['numberposts'] = $new_instance['numberposts'];
		if(!is_numeric($instance['numberposts'])) $instance['numberposts'] = 5;
		$instance['author_slug'] = $new_instance['author_slug'];
		$user = get_user_by('slug', $instance['author_slug']);
		if(!$user) $instance['author_slug'] = null;
		return $instance;
	}

	public function form($instance) {
		$title = '';
		$numposts = 5;
		$slug = '';
		if(isset($instance['title'])) $title = $instance['title'];
		if(isset($instance['numberposts'])) $numposts = $instance['numberposts'];
		if(isset($instance['author_slug'])) $slug = $instance['author_slug'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('author_slug'); ?>"><?php _e('User Slug:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('author_slug'); ?>" name="<?php echo $this->get_field_name('author_slug'); ?>" type="text" value="<?php echo esc_attr($slug); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('numberposts'); ?>"><?php _e('Post Count:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('numberposts'); ?>" name="<?php echo $this->get_field_name('numberposts'); ?>" type="text" value="<?php echo esc_attr($numposts); ?>" />
		</p>

		<?php
	}

}