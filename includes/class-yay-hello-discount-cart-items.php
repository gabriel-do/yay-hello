<?php

defined('ABSPATH') || exit;

class DiscountByCartItems
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function apply_discount_by_cart_items()
    {
        add_filter('woocommerce_calculated_total', 'custom_calculated_total', 10, 2);
        function custom_calculated_total($total, $cart)
        {
            if (!function_exists('quantity_array')) {
                function quantity_array($item)
                {
                    return $item['quantity'];
                }
            }

            if (!function_exists('sum')) {
                function sum($acc, $item)
                {
                    $acc += $item;
                    return $acc;
                }
            }
            $cart_quantity = array_map('quantity_array', $cart->cart_contents);
            $total_quantity = array_reduce($cart_quantity, 'sum');
            switch ($total_quantity) {
                case $total_quantity < 5 && $total_quantity >= 2:
                    return $total = $total - (5 * ($total / 100));
                case $total_quantity >= 5:
                    return $total = $total - (10 * ($total / 100));
                default:
                    return $total;
            }
        }
    }
}
