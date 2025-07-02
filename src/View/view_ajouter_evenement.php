<?php include_once(__DIR__ . '/../../templates/head.php'); ?>
<?php include_once(__DIR__ . '/../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 d-flex align-items-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">

                <!-- Titre -->
                <div class="pitch-black p-5 rounded-4">
                    <p class="display-6 fw-bold text-light mb-4">Ajouter un nouvel évènement</p>

                    <!-- Formulaire -->
                    <form action="/ajouter-evenement" method="post" enctype="multipart/form-data">
                        <div class="row g-4 mb-4">

                            <!-- Téléversement d'image -->
                            <div class="col-12">
                                <label for="image" class="form-label fw-semibold text-light">Image de
                                    l'évènement</label>
                                <input type="file" lang="fr" class="form-control custom-input custom-add <?php if (isset($errors['image']))
                                    echo 'is-invalid'; ?>" id="image" name="image" accept="image/*">
                                <?php if (isset($errors['image'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['image']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Titre -->
                            <div class="col-md-6">
                                <label for="titre" class="form-label fw-semibold text-light">Titre de
                                    l’évènement</label>
                                <select class="form-select custom-select <?php if (isset($errors['titre']))
                                    echo 'is-invalid'; ?>" id="titre" name="titre">
                                    <option value="">Choisir un évènement</option>
                                    <option value="Tournois" <?php if (isset($titre) && $titre == 'Tournois') {
                                        echo 'selected';
                                    } else {
                                        echo '';
                                    } ?>>Tournois</option>
                                    <option value="Actualité" <?php if (isset($titre) && $titre == 'Actualité') {
                                        echo 'selected';
                                    } else {
                                        echo '';
                                    } ?>>Actualités</option>
                                </select>
                                <?php if (isset($errors['titre'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['titre']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Lieu -->
                            <div class="col-md-6">
                                <label for="lieu" class="form-label fw-semibold text-light">Lieu</label>
                                <input type="text" class="form-control custom-add <?php if (isset($errors['lieu']))
                                    echo 'is-invalid'; ?>" id="lieu" name="lieu" placeholder="Lieu" value="<?php if (isset($lieu)) {
                                          echo htmlspecialchars($lieu);
                                      } else {
                                          echo '';
                                      } ?>">
                                <?php if (isset($errors['lieu'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['lieu']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Date -->
                            <div class="col-md-6">
                                <label for="date" class="form-label fw-semibold text-light">Date</label>
                                <input type="date" lang="fr" class="form-control custom-input custom-add <?php if (isset($errors['date']))
                                    echo 'is-invalid'; ?>" id="date" name="date" value="<?php if (isset($date)) {
                                          echo htmlspecialchars($date);
                                      } else {
                                          echo '';
                                      } ?>">
                                <?php if (isset($errors['date'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['date']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Heure -->
                            <div class="col-md-6">
                                <label for="heure" class="form-label fw-semibold text-light">Heure</label>
                                <input type="time" class="form-control custom-input custom-add <?php if (isset($errors['heure']))
                                    echo 'is-invalid'; ?>" id="heure" name="heure" value="<?php if (isset($heure)) {
                                          echo htmlspecialchars($heure);
                                      } else {
                                          echo '';
                                      } ?>">
                                <?php if (isset($errors['heure'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['heure']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Détails -->
                            <div class="col-12">
                                <label for="details" class="form-label fw-semibold text-light">Détails de
                                    l'évènement</label>
                                <textarea class="form-control custom-input custom-add <?php if (isset($errors['details']))
                                    echo 'is-invalid'; ?>" id="details" name="details" rows="5"
                                    placeholder="Détails de l'évènement"><?php if (isset($details)) {
                                        echo htmlspecialchars($details);
                                    } else {
                                        echo '';
                                    } ?></textarea>
                                <?php if (isset($errors['details'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['details']; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="d-flex flex-column flex-md-row gap-3">
                            <button type="submit" class="btn btn-warning btn-rounded px-4">Ajouter</button>
                            <a href="/evenements"
                                class="btn btn-outline-warning btn-rounded px-4 d-flex align-items-center justify-content-center">
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