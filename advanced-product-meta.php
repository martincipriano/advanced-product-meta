<?php
/**
 * Plugin Name: Advanced Product Meta
 * Description: Create an advanced metadata for WooCommerce products.
 * Author: WPBuoy
 * Version 0.0.1
 */

$apm_config = [
  [
    'class' => 'test',
    'id' => 'test',
    'label' => 'Test Text Field',
    'name' => 'test',
    'placeholder' => 'Sample Placholder',
    'type' => 'text'
  ],
  [
    'class' => 'test1',
    'id' => 'test1',
    'label' => 'Test Select Field',
    'name' => 'test1',
    'type' => 'select',
    'options' => [
      [
        'value' => '1',
        'label' => 'Option 1',
        'price' => 10
      ],
      [
        'value' => '2',
        'label' => 'Option 2',
        'price' => 10
      ],
      [
        'value' => '3',
        'label' => 'Option 3',
        'price' => 10
      ]
    ],
    'placeholder' => 'Sample Placholder'
  ]
];

/**
 * Inlcude plugin partials
 * 
 * @param string $slug
 * @param string $name
 * @param array $args
 * 
 * @return string
 */
if (!function_exists('apm_partial')) {
  function apm_partial( $slug, $name, $args = [] ) {
    ob_start();
      require plugin_dir_path(__FILE__) . $slug . '-' . $name . '.php';
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
if (!function_exists('apm_price')) {
  add_filter('woocommerce_get_price_html', 'apm_price', 10, 1);
  function apm_price($price) {

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

/**
 * Add custom input fields to the product page
 * 
 * @return void
 */
if (!function_exists('apm_fields')) {
  add_action('woocommerce_before_add_to_cart_button', 'apm_fields');
  function apm_fields() {
    global $apm_config;
    $html = '';

    // Display the input from the configuration
    foreach($apm_config as $input) {
      $html .= apm_partial('partials/input', $input['type'], $input);
    }

    // Wrap the custom input fields in a div for styling purposes
    echo '<div class="advanced-woocommerce-variations">' . $html . '</div>';
  }
}

if (!function_exists('apm_validate_fields')) {
  add_action('woocommerce_add_to_cart_validation', 'apm_validate_fields', 10, 3);
  function apm_validate_fields($passed, $product_id, $quantity) {
    global $apm_config;

    if (!isset($_POST['test']) || (isset($_POST['test']) && !$_POST['test'])) {
      wc_add_notice('Please enter a value for the test field.', 'error');
      $passed = false;
    }

    if (!isset($_POST['test1']) || (isset($_POST['test1']) && !$_POST['test1'])) {
      wc_add_notice('Please select a value for the test1 field.', 'error');
      $passed = false;
    }

    return $passed;
  }
}