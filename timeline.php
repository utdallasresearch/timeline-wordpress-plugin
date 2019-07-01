<?php
/**
 * The plugin bootstrap file
 *
 * @wordpress-plugin
 * Plugin Name:       UT Dallas Research Timeline
 * Plugin URI:        https://github.com/utdallasresearch/utdresearch-timeline
 * Description:       A WordPress plugin for generating a custom-post-based timeline.
 * Version:           1.0.2
 * Author:            UT Dallas Research Information Systems
 * Author URI:        https://research.utdallas.edu/oris
 * License:           MIT
 * License URI:       http://opensource.org/licenses/MIT
 * Text Domain:       timeline
 * Domain Path:       /languages
 */
define('Timeline\VERSION', '1.0.2');

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Autoload classes
spl_autoload_register(function ($class_name) {
    $prefix = 'Timeline\\';
    $prefix_length = strlen($prefix);

    if (strncmp($prefix, $class_name, $prefix_length) !== 0) { // Only autoload Timeline classes
        return;
    }

    $relative_class = substr($class_name, $prefix_length);
    $filename = plugin_dir_path(__FILE__) . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($filename)) {
        include_once $filename;
    }
});

// Load the plugin
(new Timeline\TimelinePlugin())->load();