<?php
  // Set a fallback ID if none is set
  if (!isset($args['id']) || (isset($args['id']) && !$args['id'])) {
    $args['id'] = 'apm-input-' . $args['key'];
  }
?>
<div class="apm-form-group <?= $args['class'] ?>" id="<?= $args['id'] ?>">

  <?php if($args['label']): ?>
    <label id="<?= $args['id'] ?>">
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

  <div aria-labelledby="<?= $args['id'] ?>" class="apm-radio-group" role="radiogroup">
    <?php foreach ($args['options'] as $key => $option):
      $checked = in_array($option['value'], $args['values']); ?>
      <div class="apm-radio">
        <input
          aria-checked="<?= $checked ? 'true': 'false' ?>"
          <?= $checked ? 'checked': '' ?>
          id="<?= $args['id'] . '-' . $key ?>"
          name="<?= $args['name'] ?>"
          type="radio"
          value="<?= $option['value'] ?>"
        >
        <label for="<?= $args['id'] . '-' . $key ?>">
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
