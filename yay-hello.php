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

function init()
{
	PostTitleModifier::getInstance();
	ShortCodeGabriel::getInstance();
	DiscountByCartItems::getInstance();
}

add_action('plugins_loaded', 'init');
