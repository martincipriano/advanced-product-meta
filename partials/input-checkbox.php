<div class="apm-form-group <?= $args['class'] ?>" id="<?= $args['id'] ?>">

  <?php if($args['label']): ?>
    <label><?= $args['label'] ?></label>
  <?php endif; ?>

  <?php if($args['description']): ?>
    <p class="description"><?= $args['description'] ?></p>
  <?php endif; ?>

  <?php do_action('before_apm_input', $args) ?>

  <div class="apm-checkbox-group">
    <?php foreach ($args['options'] as $option): ?>
      <div class="apm-checkbox">
        <input type="checkbox" name="<?= $args['name'] ?>" id="<?= $args['id'] . '-' . $option['value'] ?>" value="<?= $option['value'] ?>">
        <label for="<?= $args['id'] . '-' . $option['value'] ?>"><?= $option['label'] ?> &mdash; <?= wc_price(apm_get_price($args['price'], $option['value'])) ?></label>
      </div>
    <?php endforeach; ?>
  </div>

  <?php do_action('after_apm_input', $args) ?>
</div>
