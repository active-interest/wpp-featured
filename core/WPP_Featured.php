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

class WPP_Featured {
	private static $_initialized = false;
	private static $_settings = array();
	
	const postmetaAlias = '_wpp_is_featured';
	const settingsNonceName = 'wpp_featured_settings_noncename';
	
	
	public static function get_featured_posts($count = 5, $addArgs = array()) {
		if(!array_key_exists('meta_query', $addArgs) || !is_array($addArgs['meta_query'])) {
			$addArgs['meta_query'] = array();
		}
		$addArgs['meta_query'][] = array('key' => self::postmetaAlias, 'compare' => '=', value => 'true');
		
		$args = array_merge(array(
			'numberposts' => $count,
			'offset' => 0,
			'orderby' => 'post_date',
			'order' => 'DESC',
			'post_status' => 'publish'
		), $addArgs);
		
		return get_posts($args, OBJECT);
	}
	
	
	
	/** interal **/
	public static function init() {
		if(self::$_initialized) return;
		if(is_admin()) {
			add_action('save_post', array(__CLASS__, 'save_post'));
			add_action('post_submitbox_misc_actions', array(__CLASS__, 'post_submitbox_misc_actions'));
			
			add_filter('manage_posts_columns' , array(__CLASS__, 'manage_posts_columns'));
			add_action('manage_posts_custom_column' , array(__CLASS__, 'manage_posts_custom_column'), 10, 2);
		}
	}
	
	public static function manage_posts_columns($columns) {
		return array_merge($columns, array(self::postmetaAlias => 'Featured'));
	}
	
	public static function manage_posts_custom_column($column, $post_id) {
		switch($column) {
			case self::postmetaAlias: {
				$is_featured = get_post_meta($post_id, self::postmetaAlias, false);
				echo '<input type="checkbox" disabled', ( $is_featured ?  ' checked="checked"' : ''), '/>';
			} break;
		}
	}
	
	public static function save_post($post_id) {
		if (!isset($_POST['post_type']))
			return $post_id;
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
			return $post_id;
		if (!current_user_can('edit_post', $post_id))
			return $post_id;

		if(wp_is_post_revision($post_id)) 
			return; //Check to make sure it is not a revision

		if (!wp_verify_nonce($_POST[self::settingsNonceName], plugin_basename(__FILE__)))
			return $post_id;

		delete_post_meta($post_id, self::postmetaAlias);

		if (!isset($_POST[self::postmetaAlias]))
			return $post_id;
		
		$is_featured = $_POST[self::postmetaAlias];
		update_post_meta($post_id, self::postmetaAlias, $is_featured);
	}
	
	public static function post_submitbox_misc_actions() {
		global $post;
		$featured = get_post_meta($post->ID, self::postmetaAlias, true);
        echo '<div class="misc-pub-section misc-pub-section-last" style="border-top: 1px solid #eee;">';
        wp_nonce_field(plugin_basename(__FILE__), self::settingsNonceName);
		echo '<label for="' . self::postmetaAlias . '" style="font-weight: bold;">Is Featured: </label>';
		echo '<input name="' . self::postmetaAlias . '" type="checkbox" id="' . self::postmetaAlias . '" ' . (!empty($featured) ? 'checked="checked"' : '') . ' value="true" />';
        echo '</div>';
	}
}