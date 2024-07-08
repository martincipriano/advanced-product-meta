<div class="apm-form-group">
  <label><?= $args['label'] ?></label>
  <div class="apm-radio-group">
    <?php foreach ($args['options'] as $option): ?>
      <div class="apm-radio">
        <input type="radio" name="<?= $args['name'] ?>" id="<?= $args['id'] . '-' . $option['value'] ?>" value="<?= $option['value'] ?>">
        <label for="<?= $args['id'] . '-' . $option['value'] ?>"><?= $option['label'] ?> &mdash; <?= wc_price(apm_get_price($args['price'], $option['value'])) ?></label>
      </div>
    <?php endforeach; ?>
  </div>
</div>