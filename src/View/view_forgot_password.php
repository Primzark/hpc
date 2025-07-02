<?php include_once(__DIR__ . '/../../templates/head.php'); ?>

<div class="custom-bg min-vh-100 d-flex align-items-center">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="form-section-bg rounded p-4 shadow">
          <?php if (!empty($sent)): ?>
            <p class="text-light">Si un compte existe avec cet email, un lien de réinitialisation vous a été envoyé.</p>
          <?php else: ?>
            <form method="POST" action="">
              <p class="fs-4 fw-bold text-white mb-4 text-center">Mot de passe oublié</p>
              <div class="mb-3">
                <label for="email" class="form-label field-text">Email</label>
                <input type="email" class="form-control custom-add <?php if (!empty($errors['email']))
                  echo 'is-invalid'; ?>" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"
                  placeholder="Entrez votre email">
                <?php if (!empty($errors['email'])): ?>
                  <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
                <?php endif; ?>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-warning fw-semibold">Envoyer</button>
              </div>
            </form>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once(__DIR__ . '/../../templates/footer.php'); ?>