<?php include_once(__DIR__ . '/../../templates/head.php'); ?>
<?php include_once(__DIR__ . '/../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 d-flex align-items-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="pitch-black p-5 rounded-4">
                    <p class="display-6 fw-bold text-light mb-4">Modifier</p>

                    <!-- Formulaire -->
                    <form action="/modifier-evenement?id=<?php echo $evenement['id_eve']; ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="row g-4 mb-4">

                            <!-- Lieu -->
                            <div class="col-md-6">
                                <label for="lieu" class="form-label fw-semibold text-light">Lieu</label>
                                <input type="text"
                                    class="form-control custom-add <?php if (isset($errors['lieu'])) {
                                        echo 'is-invalid';
                                    } else {
                                        echo '';
                                    } ?>"
                                    id="lieu" name="lieu"
                                    value="<?php if (isset($lieu)) {
                                        echo htmlspecialchars($lieu);
                                    } else {
                                        echo htmlspecialchars($evenement['eve_lieu']);
                                    } ?>">
                                <?php if (isset($errors['lieu'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['lieu']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Date -->
                            <div class="col-md-6">
                                <label for="date" class="form-label fw-semibold text-light">Date</label>
                                <input type="date" lang="fr"
                                    class="form-control custom-input custom-add <?php if (isset($errors['date'])) {
                                        echo 'is-invalid';
                                    } else {
                                        echo '';
                                    } ?>"
                                    id="date" name="date"
                                    value="<?php if (isset($date)) {
                                        echo htmlspecialchars($date);
                                    } else {
                                        echo $evenement['eve_date'];
                                    } ?>">
                                <?php if (isset($errors['date'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['date']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Heure -->
                            <div class="col-md-6">
                                <label for="heure" class="form-label fw-semibold text-light">Heure</label>
                                <input type="time"
                                    class="form-control custom-input custom-add <?php if (isset($errors['heure'])) {
                                        echo 'is-invalid';
                                    } else {
                                        echo '';
                                    } ?>"
                                    id="heure" name="heure"
                                    value="<?php if (isset($heure)) {
                                        echo htmlspecialchars($heure);
                                    } else {
                                        echo $evenement['eve_heure'];
                                    } ?>">
                                <?php if (isset($errors['heure'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['heure']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <label for="details" class="form-label fw-semibold text-light">Détails de
                                    l'évènement</label>
                                <textarea
                                    class="form-control custom-input custom-add <?php if (isset($errors['details'])) {
                                        echo 'is-invalid';
                                    } else {
                                        echo '';
                                    } ?>"
                                    id="details" name="description"
                                    rows="5"><?php if (isset($details)) {
                                        echo htmlspecialchars($details);
                                    } else {
                                        echo htmlspecialchars($evenement['eve_description']);
                                    } ?></textarea>
                                <?php if (isset($errors['details'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['details']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Image actuelle -->
                            <div class="col-12">
                                <label class="form-label fw-semibold text-light">Image actuelle</label><br>
                                <img src="/asset/img/<?php echo htmlspecialchars($evenement['eve_image']); ?>"
                                    alt="Image actuelle" class="img-thumbnail" style="max-height: 12.5rem;">
                            </div>

                            <!-- Nouvelle image -->
                            <div class="col-12">
                                <label for="image" class="form-label fw-semibold text-light">Changer l’image</label>
                                <input type="file" lang="fr"
                                    class="form-control custom-add <?php if (isset($errors['image'])) {
                                        echo 'is-invalid';
                                    } else {
                                        echo '';
                                    } ?>"
                                    id="image" name="image" accept="image/*">
                                <?php if (isset($errors['image'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['image']; ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="d-flex flex-column flex-md-row gap-3">
                            <button type="submit" class="btn btn-warning btn-rounded px-4">Confirmer
                                modification</button>
                            <a href="/page-evenement?id=<?php echo $evenement['id_eve']; ?>"
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