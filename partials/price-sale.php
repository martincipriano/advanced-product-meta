<?php
  $product = $args['product'];
  $sale_price = get_post_meta($product->get_id(), '_sale_price', true);
  $regular_price = get_post_meta($product->get_id(), '_regular_price', true);
  $apm_price = apm_get_subtotal();

  $total = $sale_price + apm_get_subtotal();
?>

<del><?= wc_price($regular_price) ?></del> <ins><?= wc_price($sale_price) ?></ins><br>
<span class="apm-price"><?= wc_price($total) ?></span>
