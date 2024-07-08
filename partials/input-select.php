<div class="awv-form-group">
  <label for="<?= $args['id'] ?>"><?= $args['label'] ?></label>
  <select class="<?= $args['class'] ?>" name="<?= $args['name'] ?>" id="<?= $args['id'] ?>">
    <?php if ($args['placeholder']): ?>
      <option selected disabled value=""><?= $args['placeholder'] ?></option>
    <?php endif; ?>
    <?php foreach ($args['options'] as $key => $option): ?>
      <option value="<?= $option['value'] ?>"><?= $option['label'] ?> &mdash; <?= wc_price(apm_get_price($args['price'], $option['value'])) ?></option>
    <?php endforeach; ?>
  </select>
</div>