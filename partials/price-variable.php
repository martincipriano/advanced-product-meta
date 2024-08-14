<?php
  // Extract the raw price
  preg_match('/[0-9]+\.[0-9]{2}/', $args['price'], $matches);
  $price = (float) $matches[0];

  // The current product
  $product = $args['product'];

  // Get the initial price set for the advanced product meta
  $apm_subtotal = apm_get_subtotal();
?>
<div class="apm-price">
  <?= wc_price($price + $apm_subtotal) ?>
</div>