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
        <label for="<?= $args['id'] . '-' . $option['value'] ?>"><?= $option['label'] ?> &mdash; <?= wc_price(apm_get_price($args['price'], $option['value'])) ?></label>
      </div>
    <?php endforeach; ?>
  </div>

  <?php do_action('after_apm_input', $args) ?>
</div>
