<?php

/**
 * The plugin bootstrap file
 *
 * @link              https://yaycommerce.com
 * @since             1.0.0
 * @package           Yay_Hello
 *
 * @wordpress-plugin
 * Plugin Name:       Yay Hello
 * Plugin URI:        https://yaycommerce.com
 * Description:       For training purpose
 * Version:           1.0.0
 * Author:            Gabriel Do
 * Author URI:        https://yaycommerce.com
 */

defined('ABSPATH') || exit;

define('YAY_HELLO_VERSION', '1.0.0');

require_once(dirname(__FILE__) . '/includes/class-yay-hello-modify-post-title.php');
require_once(dirname(__FILE__) . '/includes/class-yay-hello-shortcode.php');
require_once(dirname(__FILE__) . '/includes/class-yay-hello-discount-cart-items.php');
require_once ABSPATH . '/wp-admin/includes/plugin.php';
require_once ABSPATH . WPINC . '/pluggable.php';

function activate_yay_hello()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-yay-hello-activator.php';
	Yay_Hello_Activator::activate();
}

function deactivate_yay_hello()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-yay-hello-deactivator.php';
	Yay_Hello_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_yay_hello');
register_deactivation_hook(__FILE__, 'deactivate_yay_hello');

function init()
{
	$modifier = PostTitleModifier::getInstance();
	$modifier->apply();

	$shortcode_gabriel = ShortCodeGabriel::getInstance();
	$shortcode_gabriel->apply_the_shortcode();

	$discount_by_items = DiscountByCartItems::getInstance();
	$discount_by_items->apply_discount_by_cart_items();
}

add_action('plugins_loaded', 'init');
