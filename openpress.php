<?php

/**
 * WordPress to OpenPress exporter
 *
 * @package   OpenPress
 * @license   GPL-2.0+
 * @link      https://openpress.ai
 * @copyright 2024 OpenAgents, Inc.
 *
 * @openpress
 * Plugin Name: OpenPress Exporter
 * Plugin URI:  https://openpress.ai
 * Description: Plugin to export your WordPress blog so you can import it into your OpenPress installation
 * Version:     0.1.0
 * Author:      OpenPress
 * Author URI:  https://openpress.ai
 * Text Domain: wp2openpress
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /lang
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

// Plug the `wp_get_current_user` function, which isn't normally available in plugins
if (!function_exists('wp_get_current_user')) {
    include(ABSPATH . 'wp-includes/pluggable.php');
}

// If the user is an `administrator`, init the plugin
if (current_user_can('administrator')) {
    require_once(plugin_dir_path(__FILE__) . 'class-openpress.php');

    // Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
    register_activation_hook(__FILE__, array('OpenPress', 'activate'));
    register_deactivation_hook(__FILE__, array('OpenPress', 'deactivate'));

    OpenPress::get_instance();
}
