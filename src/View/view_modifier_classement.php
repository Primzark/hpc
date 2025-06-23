<?php include_once(__DIR__ . '/../../templates/head.php'); ?>
<?php include_once(__DIR__ . '/../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <p class="display-6 fw-bold text-light mb-4">Modifier classement</p>

                <div class="form-section-bg p-4 rounded">
                    <form action="/modifier-classement?id=<?php echo $classement['id_cla']; ?>" method="post">
                        <div class="mb-3">
                            <label for="nom" class="form-label field-text">Nom du joueur</label>
                            <input type="text" class="form-control custom-add <?php echo isset($errors['nomjoueur']) ? 'is-invalid' : ''; ?>" id="nom" name="cla_nomjoueur" value="<?php echo htmlspecialchars($cla_nomjoueur); ?>">
                            <?php if (isset($errors['nomjoueur'])): ?>
                                <div class="invalid-feedback"><?php echo htmlspecialchars($errors['nomjoueur']); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="rang" class="form-label field-text">Rang</label>
                            <input type="number" class="form-control custom-add <?php echo isset($errors['rang']) ? 'is-invalid' : ''; ?>" id="rang" name="cla_rang" min="1" value="<?php echo htmlspecialchars($cla_rang); ?>">
                            <?php if (isset($errors['rang'])): ?>
                                <div class="invalid-feedback"><?php echo htmlspecialchars($errors['rang']); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="points" class="form-label field-text">Points</label>
                            <input type="number" class="form-control custom-add <?php echo isset($errors['points']) ? 'is-invalid' : ''; ?>" id="points" name="cla_points" min="0" value="<?php echo htmlspecialchars($cla_points); ?>">
                            <?php if (isset($errors['points'])): ?>
                                <div class="invalid-feedback"><?php echo htmlspecialchars($errors['points']); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex flex-column flex-md-row gap-3">
                            <button type="submit" class="btn btn-warning btn-rounded px-4">Confirmer modification</button>
                            <a href="/classement" class="btn btn-outline-warning btn-rounded px-4 d-flex align-items-center justify-content-center">
                                <span class="me-2"></span> Retour
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include_once(__DIR__ . '/../../templates/VisualFooter.php'); ?>
        <?php include_once(__DIR__ . '/../../templates/footer.php'); ?>
    </div>
</div>
