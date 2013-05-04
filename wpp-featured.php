<?php
/*
 Plugin Name: WPP Featured
 Description: Mark posts, pages, and custom content as "featured" and display using a Widget, Shortcode, or theme functions
 Version: 1.0
 Author: David Higgins <higginsd@zoulcreations.com>
 Author URI: http://www.dphcoders.com
 */

new WPP_Featured;

define('__WPP_FEATURED', 'wpp_is_featured');
define('__WPP_FEATURED_NONCE', 'wpp_featured_nonce');

class WPP_Featured {
	public function __construct() {
		if(is_admin()) {
			add_action('save_post', array($this, 'save_post'));
			add_action('post_submitbox_misc_actions', array($this, 'post_submitbox_misc_actions'));
			
			add_filter('manage_posts_columns' , array($this, 'manage_posts_columns'));
			add_action('manage_posts_custom_column' , array($this, 'manage_posts_custom_column'), 10, 2);
		}
	}
	
	public function manage_posts_columns($columns) {
		return array_merge($columns, array(__WPP_FEATURED => 'Featured'));
	}
	
	public function manage_posts_custom_column($column, $post_id) {
		switch($column) {
			case __WPP_FEATURED: {
				$is_featured = get_post_meta($post_id, '_' . __WPP_FEATURED, false);
				echo '<input type="checkbox" disabled', ( $is_featured ?  ' checked="checked"' : ''), '/>';
			} break;
		}
	}
	
	public function save_post($post_id) {
		if (!isset($_POST['post_type']))
			return $post_id;

		if (!wp_verify_nonce( $_POST[__WPP_FEATURED_NONCE], plugin_basename(__FILE__)))
			return $post_id;

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
			return $post_id;

		if (!current_user_can( 'edit_post', $post_id))
			return $post_id;

		if (!isset($_POST[__WPP_FEATURED])) {
			return $post_id;
		} 
		
		$is_featured = $_POST[__WPP_FEATURED];
		$was_featured = get_post_meta($post_id, '_' . __WPP_FEATURED, false);
//		var_dump($is_featured); var_dump($was_featured);
		update_post_meta( $post_id, '_' . __WPP_FEATURED, $is_featured);
	}
	
	public function post_submitbox_misc_actions() {
		global $post;
		$featured = get_post_meta($post->ID, '_' . __WPP_FEATURED, TRUE);
        echo '<div class="misc-pub-section misc-pub-section-last" style="border-top: 1px solid #eee;">';
        wp_nonce_field(plugin_basename(__FILE__), __WPP_FEATURED_NONCE);
		echo '<label for="' . __WPP_FEATURED . '" style="font-weight: bold;">Is Featured: </label>';
		echo '<input name="' . __WPP_FEATURED . '" type="checkbox" id="' . __WPP_FEATURED . '" ' . (!empty($featured) ? 'checked="checked"' : '') . ' value="true" />';
        echo '</div>';
	}
}