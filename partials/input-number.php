<div class="apm-form-group">

  <?php if($args['label']): ?>
    <label for="<?= $args['id'] ?>"><?= $args['label'] ?></label>
  <?php endif; ?>

  <?php if($args['description']): ?>
    <p class="description"><?= $args['description'] ?></p>
  <?php endif; ?>

  <?php do_action('before_apm_input', $args) ?>

  <input id="<?= $args['id'] ?>" max="<?= $args['max'] ?>" min="<?= $args['min'] ?>" name="<?= $args['name'] ?>" placeholder="<?= $args['placeholder'] ?>" type="<?= $args['type'] ?>">

  <?php do_action('after_apm_input', $args) ?>
</div>
