<?php include_once(__DIR__ . '/../../templates/head.php'); ?>

<div class="custom-bg min-vh-100 d-flex align-items-center">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">

        <!-- Logo HPC -->
        <div class="text-center mb-4">
          <img src="/asset/img/Harfleur_poker_logo.png" alt="Harfleur Poker Club Logo" class="img-fluid"
            style="max-height: 6.25rem;">
        </div>

        <div class="form-section-bg rounded p-4 shadow">
          <form method="POST" action="">
            <p class="fs-4 fw-bold text-white mb-4 text-center">Connexion</p>

            <!-- E-mail -->
            <div class="mb-3">
              <label for="email" class="form-label field-text">Email</label>
              <input type="email" class="form-control custom-add <?php if (!empty($errors['email']))
                echo 'is-invalid'; ?>" id="email" name="email" value="<?php if (isset($email)) {
                    echo htmlspecialchars($email);
                  } else {
                    echo '';
                  } ?>" placeholder="Entrez votre email">
              <?php if (!empty($errors['email'])): ?>
                <div class="invalid-feedback">
                  <?php echo $errors['email']; ?>
                </div>
              <?php endif; ?>
            </div>

            <!-- Mot de passe -->
            <div class="mb-3">
              <label for="password" class="form-label field-text">Mot de passe</label>
              <input type="password" class="form-control custom-add <?php if (!empty($errors['password']))
                echo 'is-invalid'; ?>" id="password" name="password" placeholder="Entrez votre mot de passe">
              <?php if (!empty($errors['password'])): ?>
                <div class="invalid-feedback">
                  <?php echo $errors['password']; ?>
                </div>
              <?php endif; ?>
            </div>

            <!-- Erreur générale -->
            <?php if (!empty($errors['general'])): ?>
              <div class="alert alert-danger">
                <?php echo $errors['general']; ?>
              </div>
            <?php endif; ?>

            <div class="d-grid">
              <button type="submit" class="btn btn-warning fw-semibold">Se connecter</button>
            </div>

            <div class="text-center login-hint mt-3">
              <small>Pas encore de compte ? <a href="/utilisateur/inscription">S'inscrire</a></small>
            </div>
            <div class="text-center login-hint mt-1">
              <small><a href="/forgot-password">Mot de passe oubli&eacute; ?</a></small>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>
<?php include_once(__DIR__ . '/../../templates/footer.php'); ?>