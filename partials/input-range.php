<?php
  $value = $args['values'][0] ?? '';
  $value = isset($_POST[$args['name']]) && $_POST[$args['name']] ? $_POST[$args['name']] : $value;
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
    list="values"
    max="<?= $args['max'] ?>"
    min="<?= $args['min'] ?>"
    name="<?= $args['name'] ?>"
    step="<?= $args['step'] ?>"
    type="range"
    value="<?= $value ?>"
  >

  <datalist id="values">
    <option value="0" style="left: 0;">0</option>
    <option value="8" style="left: 80%;">A lil' bit more</option>
    <option value="10" style="left: 100%;">Ah yes!</option>
  </datalist>

  <?php do_action('after_apm_input', $args) ?>
</div>
