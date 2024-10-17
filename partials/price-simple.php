<?php
  $product = $args['product'];
  $sale_price = get_post_meta($product->get_id(), '_sale_price', true);
  $sale_price = $sale_price ? (float) $sale_price : 0;

  $regular_price = get_post_meta($product->get_id(), '_regular_price', true);
  $regular_price = $regular_price ? (float) $regular_price : 0;

  // Get the initial price set for the advanced product meta
  $apm_subtotal = apm_get_subtotal();
?>

<div class="apm-price">
  <p>
    <strong>Initial price:</strong>
    <?php if ($sale_price): ?>
      <del><?= wc_price($regular_price) ?></del> <ins><?= wc_price($sale_price) ?></ins>
    <?php else: ?>
      <?= wc_price($regular_price) ?>
    <?php endif; ?>
  </p>
  <p><strong>Additional price based on selection:</strong> <span class="apm-price"><?= wc_price($apm_subtotal) ?></span></p>
  <p><strong>Total:</strong> <span class="apm-price"><?= wc_price($sale_price + $apm_subtotal) ?></span></p>
</div>