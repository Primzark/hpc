<?php include_once('../../templates/head.php'); ?>
<?php include_once('../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 d-flex align-items-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="pitch-black p-5 rounded-4">
                    <p class="display-6 fw-bold text-light mb-4">Modifier</p>

                    <!-- Formulaire -->
                    <form action="/src/Controller/ModifierEvenementController.php?id=<?php echo $evenement['id_eve']; ?>"
                        method="post" enctype="multipart/form-data">
                        <div class="row g-4 mb-4">

                            <!-- Lieu -->
                            <div class="col-md-6">
                                <label for="lieu" class="form-label fw-semibold text-light">Lieu</label>
                                <input type="text"
                                    class="form-control custom-add <?php echo isset($errors['lieu']) ? 'is-invalid' : ''; ?>"
                                    id="lieu" name="lieu"
                                    value="<?php echo isset($lieu) ? htmlspecialchars($lieu) : htmlspecialchars($evenement['eve_lieu']); ?>">
                                <?php if (isset($errors['lieu'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['lieu']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Date -->
                            <div class="col-md-6">
                                <label for="date" class="form-label fw-semibold text-light">Date</label>
                                <input type="date"
                                    class="form-control custom-input custom-add <?php echo isset($errors['date']) ? 'is-invalid' : ''; ?>"
                                    id="date" name="date"
                                    value="<?php echo isset($date) ? htmlspecialchars($date) : $evenement['eve_date']; ?>">
                                <?php if (isset($errors['date'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['date']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Heure -->
                            <div class="col-md-6">
                                <label for="heure" class="form-label fw-semibold text-light">Heure</label>
                                <input type="time"
                                    class="form-control custom-input custom-add <?php echo isset($errors['heure']) ? 'is-invalid' : ''; ?>"
                                    id="heure" name="heure"
                                    value="<?php echo isset($heure) ? htmlspecialchars($heure) : $evenement['eve_heure']; ?>">
                                <?php if (isset($errors['heure'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['heure']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <label for="details" class="form-label fw-semibold text-light">Détails de
                                    l'évènement</label>
                                <textarea
                                    class="form-control custom-input custom-add <?php echo isset($errors['details']) ? 'is-invalid' : ''; ?>"
                                    id="details" name="description"
                                    rows="5"><?php echo isset($details) ? htmlspecialchars($details) : htmlspecialchars($evenement['eve_description']); ?></textarea>
                                <?php if (isset($errors['details'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['details']; ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Image actuelle -->
                            <div class="col-12">
                                <label class="form-label fw-semibold text-light">Image actuelle</label><br>
                                <img src="/asset/img/<?php echo htmlspecialchars($evenement['eve_image']); ?>"
                                    alt="Image actuelle" class="img-thumbnail" style="max-height: 200px;">
                            </div>

                            <!-- Nouvelle image -->
                            <div class="col-12">
                                <label for="image" class="form-label fw-semibold text-light">Changer l’image</label>
                                <input type="file"
                                    class="form-control custom-add <?php echo isset($errors['image']) ? 'is-invalid' : ''; ?>"
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
                            <a href="/src/Controller/PageEvenementController.php?id=<?php echo $evenement['id_eve']; ?>"
                                class="btn btn-outline-warning btn-rounded px-4 d-flex align-items-center justify-content-center">
                                <span class="me-2"></span> Retour
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php include_once('../../templates/VisualFooter.php'); ?>
        <?php include_once('../../templates/footer.php'); ?>
    </div>
</div>