<?php
  $value = $args['values'][0];
  $value = isset($_POST[$args['name']]) && $_POST[$args['name']] ? (int) $_POST[$args['name']] : $value;
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

  <div class="apm-range-group">
    <span class="apm-range-tooltip" style="left: <?= ((($value - $args['min']) / ($args['max'] - $args['min'])) * 100) ?>%; transform: translateX(-<?= (2 * ($value / $args['max'])) ?>rem);"><?= $value ?></span>
    <span class="apm-range-trail" style="width: calc(<?= ((($value - $args['min']) / ($args['max'] - $args['min'])) * 100) ?>% - <?= (2 * ($value / $args['max'])) ?>rem);"></span>
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
      <?php if($args['ticks']): ?>
        <?php foreach($args['ticks'] as $tick): ?>
          <option value="<?= $tick['value'] ?>" style="left: <?= ($tick['value'] / $args['max']) * 100 ?>%;">
            <?= $tick['label'] ?>
          </option>
        <?php endforeach; ?>
      <?php else: ?>
        <option value="<?= $args['min'] ?>" style="left: 0;"><?= $args['min'] ?></option>
        <option value="<?= $args['max'] ?>" style="left: <?= ($args['max'] / $args['max']) * 100 ?>%"><?= $args['max'] ?></option>
      <?php endif; ?>
    </datalist>
  </div>

  <?php do_action('after_apm_input', $args) ?>
</div>
