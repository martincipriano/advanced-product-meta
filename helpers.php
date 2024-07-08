<?php

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
 * Get the price of a product using the input value
 * 
 * @param array $array
 * @param string $value
 * 
 * @return int|bool
 */
if (!function_exists('apm_get_price')) {
  function apm_get_price($array, $value) {
    foreach ($array as $item) {
      if ($item['value'] == $value) {
        return $item['price'];
      }
    }
    return false;
  }
}
