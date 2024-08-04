<?php
  $value = $args['values'][0] ?? '';
  $value = isset($_POST[$args['name']]) && $_POST[$args['name']] ? $_POST[$args['name']] : $value;

  // Set a fallback ID if none is set
  if (!isset($args['id']) || (isset($args['id']) && !$args['id'])) {
    $args['id'] = 'apm-input-' . $args['key'];
  }
?>

<div class="apm-form-group <?= $args['class'] ?>" id="<?= $args['id'] ?>">

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

  <input
    id="<?= $args['id'] ?>"
    name="<?= $args['name'] ?>"
    placeholder="<?= $args['placeholder'] ?>"
    type="<?= $args['type'] ?>"
    value="<?= $value ?>"
  >

  <?php do_action('after_apm_input', $args) ?>
</div>
