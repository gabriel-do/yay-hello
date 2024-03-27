<?php

/**
 * The plugin bootstrap file
 *
 * @link              https://yaycommerce.vn
 * @since             1.0.0
 * @package           Yay_Hello
 *
 * @wordpress-plugin
 * Plugin Name:       Yay Hello
 * Plugin URI:         https://yaycommerce.vn/
 * Description:       For training purpose
 * Version:           1.0.0
 * Author:            Gabriel Do
 * Author URI:        https://yaycommerce.vn/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       yay-hello
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('YAY_HELLO_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-yay-hello-activator.php
 */
function activate_yay_hello()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-yay-hello-activator.php';
	Yay_Hello_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-yay-hello-deactivator.php
 */
function deactivate_yay_hello()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-yay-hello-deactivator.php';
	Yay_Hello_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_yay_hello');
register_deactivation_hook(__FILE__, 'deactivate_yay_hello');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-yay-hello.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_yay_hello()
{

	$plugin = new Yay_Hello();
	$plugin->run();
}
run_yay_hello();
