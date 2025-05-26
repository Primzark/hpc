<?php include_once('../../templates/head.php'); ?>
<?php include_once('../../templates/navbar.php'); ?>



<div class="custom-bg min-vh-100 d-flex align-items-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">

                <!-- Title -->
                <div class="pitch-black p-5 rounded-4">
                    <p class="display-6 fw-bold text-light mb-4">Ajouter un nouvel évènement</p>

                    <!-- Form -->


                    <form action="/Poker_website/src/Controller/AjouterEvenementController.php" method="post"
                        enctype="multipart/form-data">
                        <div class="row g-4 mb-4">

                            <!-- Image Upload -->
                            <div class="col-12">
                                <label for="image" class="form-label fw-semibold text-light">Image de
                                    l'évènement</label>
                                <input type="file" class="form-control custom-input custom-add" id="image" name="image"
                                    accept="image/*" required>
                            </div>

                            <div class="col-md-6">
                                <label for="titre" class="form-label fw-semibold text-light">Titre de
                                    l’évènement</label>
                                <select class="form-select custom-select" id="titre" name="titre" required>
                                    <option value="">Choisir un évènement</option>
                                    <option value="Tournois">Tournois</option>
                                    <option value="Actualité">Actualités</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="lieu" class="form-label fw-semibold text-light">Lieu</label>
                                <input type="text" class="form-control custom-add" id="lieu" name="lieu"
                                    placeholder="Lieu" required>
                            </div>

                            <div class="col-md-6">
                                <label for="date" class="form-label fw-semibold text-light">Date</label>
                                <input type="date" class="form-control custom-input custom-add" id="date" name="date"
                                    required>
                            </div>

                            <div class="col-md-6">
                                <label for="heure" class="form-label fw-semibold text-light">Heure</label>
                                <input type="time" class="form-control custom-input custom-add" id="heure" name="heure"
                                    required>
                            </div>

                            <div class="col-12">
                                <label for="details" class="form-label fw-semibold text-light">Détails de
                                    l'évènement</label>
                                <textarea class="form-control custom-input custom-add" id="details" name="details"
                                    rows="5" placeholder="Détails de l'évènement" required></textarea>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex flex-column flex-md-row gap-3">
                            <button type="submit" class="btn btn-warning btn-rounded px-4">Ajouter</button>
                            <a href="/Poker_website/src/Controller/EvenementsController.php"
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