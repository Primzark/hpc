<?php include_once(__DIR__ . '/../../templates/head.php'); ?>
<?php include_once(__DIR__ . '/../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-8">
        <p class="display-6 fw-bold text-light mb-4">Ajouter au classement</p>

        <div class="form-section-bg p-4 rounded">
          <?php if (!empty($errors['general'])): ?>
            <div class="invalid-feedback d-block mb-3"><?php echo htmlspecialchars($errors['general']); ?></div>
          <?php endif; ?>

          <form action="/ajouter-classement" method="post">
            <div class="mb-3">
              <label for="nom" class="form-label field-text">Nom du joueur</label>
              <input type="text"
                class="form-control custom-add <?php echo isset($errors['nomjoueur']) ? 'is-invalid' : ''; ?>" id="nom"
                name="cla_nomjoueur" placeholder="Ex: Jean Dupuis"
                value="<?php echo isset($cla_nomjoueur) ? htmlspecialchars($cla_nomjoueur) : ''; ?>">
              <?php if (isset($errors['nomjoueur'])): ?>
                <div class="invalid-feedback"><?php echo htmlspecialchars($errors['nomjoueur']); ?></div>
              <?php endif; ?>
            </div>

            <div class="mb-3">
              <label for="rang" class="form-label field-text">Rang</label>
              <input type="number"
                class="form-control custom-add <?php echo isset($errors['rang']) ? 'is-invalid' : ''; ?>" id="rang"
                name="cla_rang" placeholder="Ex: 1"
                value="<?php echo isset($cla_rang) ? (int) $cla_rang : ''; ?>">
              <?php if (isset($errors['rang'])): ?>
                <div class="invalid-feedback"><?php echo htmlspecialchars($errors['rang']); ?></div>
              <?php endif; ?>
            </div>

            <div class="mb-3">
              <label for="points" class="form-label field-text">Points</label>
              <input type="number"
                class="form-control custom-add <?php echo isset($errors['points']) ? 'is-invalid' : ''; ?>" id="points"
                name="cla_points" placeholder="Ex: 1250" min="0"
                value="<?php echo isset($cla_points) ? (int) $cla_points : ''; ?>">
              <?php if (isset($errors['points'])): ?>
                <div class="invalid-feedback"><?php echo htmlspecialchars($errors['points']); ?></div>
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