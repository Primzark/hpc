<?php include_once('../../templates/head.php'); ?>
<?php include_once('../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">

                <!-- Page Title -->
                <p class="display-6 fw-bold text-light mb-3">Rejoindre l’évènement</p>
                <p class="fw-semibold custom-text mb-4">Inscription au tournoi</p>

                <!-- Form -->
                <div class="form-section-bg p-4 rounded text-light">
                    <form action="?page=valider_rejoindre_evenement" method="post">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label fw-semibold text-warning">Nom</label>
                                <input type="text" class="form-control custom-bg" id="nom" name="nom"
                                    placeholder="Entrez votre nom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label fw-semibold text-warning">Prénom</label>
                                <input type="text" class="form-control custom-bg" id="prenom" name="prenom"
                                    placeholder="Entrez votre prénom" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-warning">Adresse e-mail</label>
                            <input type="email" class="form-control custom-bg" id="email" name="email"
                                placeholder="Entrez votre e-mail" required>
                        </div>

                        <div class="mb-4">
                            <label for="commentaires" class="form-label fw-semibold text-warning">Commentaires
                                (optionnel)</label>
                            <textarea class="form-control custom-bg" id="commentaires" name="commentaires" rows="4"
                                placeholder="Ajoutez des commentaires si nécessaire"></textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <button type="button" id="joinEventBtn"
                                        data-event-id="<?= htmlspecialchars($event_id) ?>"
                                        class="btn btn-warning btn-rounded w-100 fw-semibold">
                                        <i class="bi bi-check2-circle me-2"></i>Confirmer l’inscription
                                    </button>

                                </div>


                            </div>
                            <div class="col-md-6">
                                <a href="/Poker_website/src/Controller/PageEvenementController.php"
                                    class="btn btn-outline-warning btn-rounded w-100 d-flex align-items-center justify-content-center fw-semibold">
                                    <i class="bi bi-arrow-left me-2"></i>Retour
                                </a>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php include_once('../../templates/VisualFooter.php'); ?>
    <?php include_once('../../templates/footer.php'); ?>
</div>