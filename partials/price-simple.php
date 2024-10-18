<?php
  $product = $args['product'];
  $sale_price = get_post_meta($product->get_id(), '_sale_price', true);
  $sale_price = $sale_price ? (float) $sale_price : 0;

  $regular_price = get_post_meta($product->get_id(), '_regular_price', true);
  $regular_price = $regular_price ? (float) $regular_price : 0;

  $price = get_post_meta($product->get_id(), '_price', true);

  // Get the initial price set for the advanced product meta
  $apm_subtotal = apm_get_subtotal();
?>

<div class="apm-price">
  <p class="apm-initial-price">
    <strong>Initial Price:</strong>
    <?php if ($sale_price): ?>
      <del><?= wc_price($regular_price) ?></del> <ins><?= wc_price($sale_price) ?></ins>
    <?php else: ?>
      <?= wc_price($price) ?>
    <?php endif; ?>
  </p>
  <p class="apm-selection-price"><strong>Selection Price:</strong> <span class="apm-price"><?= wc_price($apm_subtotal) ?></span></p>
  <p class="apm-total-price"><strong>Total:</strong> <span class="apm-price"><?= wc_price($price + $apm_subtotal) ?></span></p>
</div>