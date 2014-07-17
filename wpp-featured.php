<?php
/*
Plugin Name: WPP Featured
Plugin URI: http://wppoets.com/plugins/featured.html
Description: Mark posts, pages, and custom content as "featured" and display using a Widget, Shortcode, or theme functions
Version: 1.0.1
Author: WP Poets <plugins@wppoets.com>
Author URI: http://wppoets.com
License: GPLv2 (dual licensed)
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
/**  
 * Copyright (c) 2013, WP Poets and/or its affiliates <plugins@wppoets.com>
 * Portions of this distribution are copyrighted by:
 *   Copyright (c) 2013 David Higgins <higginsd@zoulcreations.com>
 * All rights reserved.
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

if (!defined('ABSPATH')) die(); // We should not be loading this outside of wordpress
if (!defined('WPP_FEATURE_VERSION_NUM')) define('WPP_FEATURE_VERSION_NUM', '1.0');
if (!defined('WPP_FEATURE_PLUGIN_FILE')) define('WPP_FEATURE_PLUGIN_FILE', __FILE__);
if (!defined('WPP_FEATURE_PLUGIN_PATH')) define('WPP_FEATURE_PLUGIN_PATH', dirname(__FILE__));
if (!defined('WPP_FEATURE_FILTER_FILE')) define('WPP_FEATURE_FILTER_FILE', 'wpp-content-alias/wpp-featured.php');

if(!class_exists('WPP_Featured')) require_once(WPP_FEATURE_PLUGIN_PATH . '/core/WPP_Featured.php');
WPP_Featured::init();

// widgets
if(!class_exists('WPP_FeaturedListWidget')) require_once(WPP_FEATURE_PLUGIN_PATH . '/widgets/WPP_FeaturedList.php');
