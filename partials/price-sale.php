<?php
  $product = $args;
  $sale_price = get_post_meta($product->get_id(), '_sale_price', true);
  $regular_price = get_post_meta($product->get_id(), '_regular_price', true);
  $apm_price = apm_get_price();

  $total = $sale_price + apm_get_price();
?>
<div class="apm-price">
  <strong>Base Price:</strong> <del><?= wc_price($regular_price) ?></del> <ins><?= wc_price($sale_price) ?></ins><br>
  <strong>Total Price:</strong> <ins><?= wc_price($total) ?></ins>
</div>