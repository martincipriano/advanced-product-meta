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
    'class' => 'username',
    'condition' => [
      [
        'action' => 'show',
        'operator' => '==',
        'value' => 'test1',
      ]
    ],
    'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum ab veritatis commodi possimus eligendi. Quis!',
    'hidden' => true,
    'id' => '',
    'label' => 'Your Bungie username',
    'name' => 'userame',
    'placeholder' => 'Eg. Bungie#1234',
    'price' => [
      [
        'value' => 'test value',
        'price' => 100
      ]
    ],
    'required' => true,
    'type' => 'text',
    'values' => ['test value']
  ],
  [
    'class' => 'apm-number-input',
    'description' => '',
    'hidden' => false,
    'id' => 'apm-number-input',
    'label' => 'Test Number Field',
    'max' => '10',
    'min' => '0',
    'name' => 'apm-number-input',
    'placeholder' => 'Sample Placeholder',
    'price' => [
      [
        'max' => '10',
        'min' => '1',
        'price' => 10
      ]
    ],
    'required' => true,
    'type' => 'number',
    'values' => [0]
  ],
  [
    'class' => 'apm-range-input',
    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro, culpa quo? Natus ad nobis atque, minus earum repudiandae eius voluptas!',
    'hidden' => false,
    'id' => '',
    'label' => 'Your charcter level',
    'max' => '99',
    'min' => '1',
    'name' => 'level',
    'price' => [
      [
        'value' => 'test',
        'price' => 10
      ]
    ],
    'required' => true,
    'step' => 1,
    'ticks'  => [
      [
        'label' => 'What a newb!',
        'value' => 0
      ],
      [
        'label' => 'You\'re getting there!',
        'value' => 50
      ],
      [
        'label' => 'You\'re a pro!',
        'value' => 99
      ]
    ],
    'type' => 'range',
    'values' => [1]
  ],
  [
    'class' => 'test1',
    'description' => '',
    'hidden' => false,
    'label' => 'Test Select Field',
    'name' => 'test1',
    'options' => [
      [
        'value' => 1,
        'label' => 'Option 1',
      ],
      [
        'value' => 2,
        'label' => 'Option 2',
      ],
      [
        'value' => 3,
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
    'type' => 'select',
    'values' => [1]
  ],
  [
    'class' => '',
    'description' => '',
    'hidden' => false,
    'id' => 'platform',
    'label' => 'Select your platform',
    'name' => 'platform',
    'options' => [
      [
        'value' => 'PC',
        'label' => 'PC',
      ],
      [
        'value' => 'Playstation',
        'label' => 'Playstation',
      ],
      [
        'value' => 'Xbox',
        'label' => 'Xbox',
      ]
    ],
    'price' => [
      [
        'value' => 'PC',
        'price' => 30
      ],
      [
        'value' => 'Playstation',
        'price' => 30
      ],
      [
        'value' => 'Xbox',
        'price' => 30
      ]
    ],
    'required' => true,
    'type' => 'radio',
    'values'  => ['PC']
  ],
  [
    'class' => 'character',
    'description' => '',
    'hidden' => false,
    'id' => 'character',
    'label' => 'Select your character',
    'name' => 'character',
    'options' => [
      [
        'label' => 'Warlock',
        'value' => 'Warlock'
      ],
      [
        'label' => 'Hunter',
        'value' => 'Hunter'
      ],
      [
        'label' => 'Titan',
        'value' => 'Titan'
      ]
    ],
    'price' => [
      [
        'value' => 'Warlock',
        'price' => 30
      ],
      [
        'value' => 'Hunter',
        'price' => 30
      ],
      [
        'value' => 'Titan',
        'price' => 30
      ]
    ],
    'required' => true,
    'type' => 'checkbox',
    'values' => ['Warlock', 'Hunter']
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

if (!function_exists('apm_head_styles')) {
  add_action('wp_head', 'apm_head_styles');
  function apm_head_styles() {
    global $apm_config;
    if ($apm_config) { ?>
      
    <?php }
  }
}

/**
 * Get the total price of the advanced product meta
 * 
 * @return int
 */
if (!function_exists('apm_get_price')) {
  function apm_get_price() {
    global $apm_config;
  
    // Set a default subtotal
    $subtotal = 0;
  
    foreach($apm_config as $input) {
  
      // Text input
      if ($input['type'] == 'text') {
        foreach($input['price'] as $price) {
          if (isset($input['values'][0]) && $input['values'][0] == $price['value']) {
            $subtotal += $price['price'];
          }
        }
      }
    }
    return $subtotal;
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
    global $post;

    $product = wc_get_product($post->ID);

    // Check if the product is a variable product
    // Also check if it's the price range if it has "-" in the price
    if ($product->is_type('variable')) {
      if ( substr_count($price, '<bdi>') < 2) {
        $price = apm_partial('partials/price', 'variable', $product);
      }
    } else {
      // If the product is on sale
      if ($product->is_on_sale()) {
        $price = apm_partial('partials/price', 'sale', $product);
      } else {
        $price = apm_partial('partials/price', 'regular', $product);
      }
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
    foreach($apm_config as $key => $input) {

      // Add the input key to the input array
      // The key will be used if an ID is not set for input IDs and label attributes
      $input['key'] = $key;

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
