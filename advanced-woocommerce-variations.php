<?php
/**
 * Plugin Name: Advanced WooCommerce Variations
 * Description: Create advanced variations for WooCommerce.
 * Author: WPBuoy
 * Version 0.0.1
 */

/**
 * Inlcude plugin partials
 * 
 * @param string $slug
 * @param string $name
 * @param array $args
 * 
 * @return string
 */
if (!function_exists('awv_partial')) {
  function awv_partial( $slug, $name, $args = [] ) {
    ob_start();
      require plugin_dir_path( __DIR__ ) . $slug . $name . '.php';
      $content = ob_get_contents();
    ob_end_clean();
    return $content;
  }
}

/**
 * Modify the price based on the initial values of the advanced variations
 *
 * @param string $price
 * 
 * @return string
 */
if (!function_exists('awv_price')) {
  add_filter('woocommerce_get_price_html', 'awv_price', 10, 1);
  function awv_price($price) {

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
