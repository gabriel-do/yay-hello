<?php

defined('ABSPATH') || exit;

class DiscountByCartItems
{
    private static $instance = null;
    private static $quantity;

    private function __construct()
    {
        add_action('woocommerce_cart_totals_before_order_total', [$this, 'add_discount_on_cart_total'], 11);
        add_action('woocommerce_review_order_before_order_total', [$this, 'add_discount_on_cart_total'], 12);
        add_filter('woocommerce_calculated_total', [$this, 'custom_calculated_total'], 10, 2);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function custom_calculated_total($total, $cart)
    {
        $cart_quantity = array_map(fn ($item) => $item['quantity'], $cart->cart_contents);
        $total_quantity = array_reduce(
            $cart_quantity,
            fn ($acc, $item) => $acc += $item
        );
        self::$quantity = $total_quantity;
        switch ($total_quantity) {
            case $total_quantity < 5 && $total_quantity >= 2:
                return $total = $total - (5 * ($total / 100));
            case $total_quantity >= 5:
                return $total = $total - (10 * ($total / 100));
            default:
                return $total;
        }
    }

    public function add_discount_on_cart_total()
    {
        $total_quantity_to_discount = self::$quantity;
        switch ($total_quantity_to_discount) {
            case $total_quantity_to_discount < 5 && $total_quantity_to_discount >= 2:
                $this->print_discount(5);
                break;
            case $total_quantity_to_discount >= 5:
                $this->print_discount(10);
                break;
            default:
                break;
        }
    }

    private function print_discount($discount = 0)
    {
        $content = '<tr class="cart-total-discount">';
        $content .= '<th>' . __("Discount by Quantity", "woocommerce") . '</th>';
        $content .= '<td data-title="total-discount">' . $discount . '%</td>';
        $content .= '</tr>';
        echo $content;
    }
}
