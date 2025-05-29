<?php include_once('../../templates/head.php'); ?>
<?php include_once('../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 d-flex align-items-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="pitch-black p-5 rounded-4">
                    <p class="display-6 fw-bold text-light mb-4">Modifier</p>

                    <!-- Form -->
                    <form
                        action="/Poker_website/src/Controller/ModifierEvenementController.php?id=<?= $evenement['id_eve'] ?>"
                        method="post" enctype="multipart/form-data">
                        <div class="row g-4 mb-4">

                            <!-- Lieu -->
                            <div class="col-md-6">
                                <label for="lieu" class="form-label fw-semibold text-light">Lieu</label>
                                <input type="text" class="form-control custom-add" id="lieu" name="lieu"
                                    value="<?= htmlspecialchars($evenement['eve_lieu']) ?>" required>
                            </div>

                            <!-- Date -->
                            <div class="col-md-6">
                                <label for="date" class="form-label fw-semibold text-light">Date</label>
                                <input type="date" class="form-control custom-input custom-add" id="date" name="date"
                                    value="<?= $evenement['eve_date'] ?>" required>
                            </div>

                            <!-- Heure -->
                            <div class="col-md-6">
                                <label for="heure" class="form-label fw-semibold text-light">Heure</label>
                                <input type="time" class="form-control custom-input custom-add" id="heure" name="heure"
                                    value="<?= $evenement['eve_heure'] ?>" required>
                            </div>

                            <!-- Description -->
                            <div class="col-12">
                                <label for="details" class="form-label fw-semibold text-light">Détails de
                                    l'évènement</label>
                                <textarea class="form-control custom-input custom-add" id="details" name="description"
                                    rows="5" required><?= htmlspecialchars($evenement['eve_description']) ?></textarea>
                            </div>

                            <!-- Image actuelle -->
                            <div class="col-12">
                                <label class="form-label fw-semibold text-light">Image actuelle</label><br>
                                <img src="/Poker_website/asset/img/<?= htmlspecialchars($evenement['eve_image']) ?>"
                                    alt="Image actuelle" class="img-thumbnail" style="max-height: 200px;">
                            </div>

                            <!-- Nouvelle image -->
                            <div class="col-12">
                                <label for="image" class="form-label fw-semibold text-light">Changer l’image</label>
                                <input type="file" class="form-control custom-add" id="image" name="image"
                                    accept="image/*">
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex flex-column flex-md-row gap-3">
                            <button type="submit" class="btn btn-warning btn-rounded px-4">Confirmer
                                modification</button>
                            <a href="/Poker_website/src/Controller/PageEvenementController.php"
                                class="btn btn-outline-warning btn-rounded px-4 d-flex align-items-center justify-content-center">
                                <span class="me-2">&#8592;</span> Retour
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