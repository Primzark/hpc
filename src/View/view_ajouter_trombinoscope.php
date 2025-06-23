<?php include_once(__DIR__ . '/../../templates/head.php'); ?>
<?php include_once(__DIR__ . '/../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-8">
        <p class="display-6 fw-bold text-light mb-4">Ajouter au trombinoscope</p>
        <div class="form-section-bg p-4 rounded">
          <?php if (!empty($errors['general'])): ?>
            <div class="form-error mb-3"><?php echo htmlspecialchars($errors['general']); ?></div>
          <?php endif; ?>
          <form action="/ajouter-trombinoscope" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="pseudo" class="form-label field-text">Pseudo</label>
              <input type="text" class="form-control custom-add <?php echo isset($errors['pseudo']) ? 'is-invalid' : ''; ?>"
                id="pseudo" name="pseudo" value="<?php echo isset($pseudo) ? htmlspecialchars($pseudo) : ''; ?>">
              <?php if (isset($errors['pseudo'])): ?>
                <div class="invalid-feedback"><?php echo htmlspecialchars($errors['pseudo']); ?></div>
              <?php endif; ?>
            </div>
            <div class="mb-3">
              <label for="image" class="form-label field-text">Image</label>
              <input type="file"
                class="form-control custom-input custom-add <?php echo isset($errors['image']) ? 'is-invalid' : ''; ?>"
                id="image" name="image" accept="image/*">
              <?php if (isset($errors['image'])): ?>
                <div class="invalid-feedback"><?php echo htmlspecialchars($errors['image']); ?></div>
              <?php endif; ?>
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-warning">Ajouter</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php include_once(__DIR__ . '/../../templates/VisualFooter.php'); ?>
    <?php include_once(__DIR__ . '/../../templates/footer.php'); ?>
  </div>
</div>