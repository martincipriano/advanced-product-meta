<?php
/**
 * Plugin Name: Advanced Product Meta
 * Description: Create an advanced metadata for WooCommerce products.
 * Author: WPBuoy
 * Version 0.0.1
 */

include_once 'helpers.php';

$apm_config = [
  [
    'class' => 'test',
    'condition' => [
      [
        'action' => 'show',
        'operator' => '==',
        'value' => 'test1',
      ]
    ],
    'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum ab veritatis commodi possimus eligendi. Quis!',
    'hidden' => true,
    'id' => 'test',
    'label' => 'Test Text Field',
    'name' => 'test',
    'placeholder' => 'Sample Placeholder',
    'price' => [
      [
        'value' => 'test',
        'price' => 10
      ]
    ],
    'required' => true,
    'type' => 'text',
    'value' => ''
  ],
  [
    'class' => 'test-number',
    'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum ab veritatis commodi possimus eligendi. Quis!',
    'hidden' => false,
    'id' => 'test-number',
    'label' => 'Test Number Field',
    'max' => '10',
    'min' => '0',
    'name' => 'test-number',
    'placeholder' => 'Sample Placeholder',
    'price' => [
      [
        'value' => 'test',
        'price' => 10
      ]
    ],
    'required' => true,
    'type' => 'number',
    'value' => ''
  ],
  [
    'class' => 'test1',
    'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum ab veritatis commodi possimus eligendi. Quis!',
    'hidden' => false,
    'id' => 'test1',
    'label' => 'Test Select Field',
    'name' => 'test1',
    'options' => [
      [
        'value' => '1',
        'label' => 'Option 1',
      ],
      [
        'value' => '2',
        'label' => 'Option 2',
      ],
      [
        'value' => '3',
        'label' => 'Option 3',
      ]
    ],
    'price' => [
      [
        'value' => '1',
        'price' => 10
      ],
      [
        'value' => '2',
        'price' => 20
      ],
      [
        'value' => '3',
        'price' => 30
      ]
    ],
    'placeholder' => 'Sample Placeholder',
    'required' => false,
    'type' => 'select'
  ],
  [
    'class' => 'test2',
    'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum ab veritatis commodi possimus eligendi. Quis!',
    'hidden' => false,
    'id' => 'test2',
    'label' => 'Select One',
    'name' => 'test2',
    'options' => [
      [
        'value' => '1',
        'label' => 'Option 1',
      ],
      [
        'value' => '2',
        'label' => 'Option 2',
      ],
      [
        'value' => '3',
        'label' => 'Option 3',
      ]
    ],
    'price' => [
      [
        'value' => '1',
        'price' => 10
      ],
      [
        'value' => '2',
        'price' => 20
      ],
      [
        'value' => '3',
        'price' => 30
      ]
    ],
    'required' => true,
    'type' => 'radio'
  ],
  [
    'class' => 'test3',
    'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum ab veritatis commodi possimus eligendi. Quis!',
    'hidden' => false,
    'id' => 'test3',
    'label' => 'Select One',
    'name' => 'test3',
    'options' => [
      [
        'value' => '1',
        'label' => 'Option 1',
      ],
      [
        'value' => '2',
        'label' => 'Option 2',
      ],
      [
        'value' => '3',
        'label' => 'Option 3',
      ]
    ],
    'price' => [
      [
        'value' => '1',
        'price' => 10
      ],
      [
        'value' => '2',
        'price' => 20
      ],
      [
        'value' => '3',
        'price' => 30
      ]
    ],
    'required' => false,
    'type' => 'checkbox'
  ]
];

if (!function_exists('apm_enqueue_scripts')) {
  add_action('wp_enqueue_scripts', 'apm_enqueue_scripts');
  function apm_enqueue_scripts() {
    global $apm_config;

    // Only load the styles and scripts if on the product page if there's a configuration
    if ($apm_config) {
      wp_enqueue_style('apm-styles', plugin_dir_url(__FILE__) . 'css/advanced-product-meta.css');
      wp_enqueue_script('apm-scripts', plugin_dir_url(__FILE__) . 'js/advanced-product-meta.js', [], filemtime(plugin_dir_path(__FILE__) . 'js/advanced-product-meta.js'), true);
    }
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
    } ?>

    <div id="advanced-product-meta">
      <?php
        do_action('before_apm_fields', $apm_config);

        echo $html;

        do_action('after_apm_fields', $apm_config);
      ?>
    </div>

  <?php }
}

/**
 * Validate the custom input fields
 *
 * @param bool $passed
 * @param int $product_id
 * @param int $quantity
 *
 * @return bool
 */
if (!function_exists('apm_validate_fields')) {
  add_action('woocommerce_add_to_cart_validation', 'apm_validate_fields', 10, 3);
  function apm_validate_fields($passed, $product_id, $quantity) {
    global $apm_config;
    foreach($apm_config as $input) {

      // Check if the input is required
      if ($input['required']) {

        // Check if the input is set and if it has a value
        if(!isset($_POST[$input['name']]) || (isset($_POST[$input['name']]) && !$_POST[$input['name']])) {
          wc_add_notice($input['label'] . ' is required.' , 'error');
          $passed = false;
        }
      }
    }
    return $passed;
  }
}
