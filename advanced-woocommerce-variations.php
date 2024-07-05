<?php
/**
 * Plugin Name: Advanced WooCommerce Variations
 * Description: Create advanced variations for WooCommerce.
 * Author: WPBuoy
 * Version 0.0.1
 */

/**
 * Modify the price based on the initial values of the advanced variations
 *
 * @param string $price
 * @return string
 */
if (!function_exists('awv_price_filter')) {
  add_filter('woocommerce_get_price_html', 'awv_price_filter', 10, 1);
  function awv_price_filter($price) {

    // Check if the price string contains the class 'amount'
    preg_match_all('/\b amount\b/', $price, $amount);

    // Check if the price string contains a del tag
    preg_match_all('/\bdel\b/', $price, $discount);

    // If there are two displayed amounts and no del tag, the price is a variation range
    // Do not modify the price
    if (count($amount[0]) === 2 && count($discount[0]) === 0) {
      return $price;
    }

    // ! Modify the price based on the initial values of the advanced variations
    return $price;
  }
}