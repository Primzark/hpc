<?php include_once(__DIR__ . '/../../templates/head.php'); ?>

<div class="custom-bg min-vh-100 d-flex align-items-center">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="form-section-bg rounded p-4 shadow">
          <?php if ($success): ?>
            <p class="text-light">Votre mot de passe a \xC3\xA9t\xC3\xA9 r\xC3\xA9initialis\xC3\xA9.</p>
          <?php else: ?>
            <form method="POST" action="">
              <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
              <p class="fs-4 fw-bold text-white mb-4 text-center">Nouveau mot de passe</p>
              <div class="mb-3">
                <label for="password" class="form-label field-text">Mot de passe</label>
                <input type="password"
                  class="form-control custom-add <?php if (!empty($errors['password']))
                    echo 'is-invalid'; ?>"
                  id="password" name="password" placeholder="Entrez votre mot de passe">
                <?php if (!empty($errors['password'])): ?>
                  <div class="invalid-feedback"><?php echo $errors['password']; ?></div>
                <?php endif; ?>
              </div>
              <div class="mb-3">
                <label for="confirm_password" class="form-label field-text">Confirmer le mot de passe</label>
                <input type="password"
                  class="form-control custom-add <?php if (!empty($errors['confirm_password']))
                    echo 'is-invalid'; ?>"
                  id="confirm_password" name="confirm_password" placeholder="Confirmer le mot de passe">
                <?php if (!empty($errors['confirm_password'])): ?>
                  <div class="invalid-feedback"><?php echo $errors['confirm_password']; ?></div>
                <?php endif; ?>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-warning fw-semibold">Valider</button>
              </div>
            </form>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once(__DIR__ . '/../../templates/footer.php'); ?>