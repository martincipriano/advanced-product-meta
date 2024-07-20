<?php
  $subtotal = 0;
  foreach ($args['values'] as $value) {
    $subtotal += apm_get_price($args['price'], $value);
  }
?>

<div class="apm-form-group <?= $args['class'] ?>" id="<?= $args['id'] ?>" data-subtotal="<?= $subtotal ?>">

  <?php if($args['label']): ?>
    <label for="<?= $args['id'] ?>">
      <?= $args['label'] ?>
      <?php if($args['required']): ?>
        <span class="apm-req">*</span>
      <?php endif; ?>
    </label>
  <?php endif; ?>

  <?php if($args['description']): ?>
    <p class="description"><?= $args['description'] ?></p>
  <?php endif; ?>

  <?php do_action('before_apm_input', $args) ?>

  <div class="apm-checkbox-group">
    <?php foreach ($args['options'] as $option): ?>
      <div class="apm-checkbox">
        <input
          <?= in_array($option['value'], $args['values']) ? 'checked' : '' ?>
          id="<?= $args['id'] . '-' . $option['value'] ?>"
          name="<?= $args['name'] ?>"
          type="checkbox"
          value="<?= $option['value'] ?>"
        >
        <label for="<?= $args['id'] . '-' . $option['value'] ?>">

          <?= $option['label'] ?>

          <?php if(apm_get_price($args['price'], $option['value'])): ?>
            &mdash; <?= wc_price(apm_get_price($args['price'], $option['value'])) ?>
          <?php endif; ?>
        </label>
      </div>
    <?php endforeach; ?>
  </div>

  <?php do_action('after_apm_input', $args) ?>
</div>
