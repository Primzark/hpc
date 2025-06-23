<?php include_once(__DIR__ . '/../../templates/head.php'); ?>
<?php include_once(__DIR__ . '/../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">

                <!-- Titre de la page -->
                <p class="display-6 fw-bold text-light mb-3">Rejoindre l’évènement</p>
                <p class="fw-semibold custom-text mb-4">Inscription au tournoi</p>

                <!-- Bloc de confirmation -->
                <div class="form-section-bg p-4 rounded text-light">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold custom-text">Confirmation d’inscription</h2>
                        <p class="fs-5 field-text">Veuillez confirmer votre inscription en cliquant ci-dessous :</p>
                    </div>

                    <!-- Boutons -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <?php
                            $btnClass = $isRegistered ? 'btn-success' : 'btn-warning';
                            $btnText = $isRegistered ? 'Vous êtes inscrit' : 'Confirmer l’inscription';
                            ?>
                            <button type="button" id="joinEventBtn"
                                data-event-id="<?php echo htmlspecialchars($event_id); ?>"
                                class="btn <?php echo $btnClass; ?> btn-rounded w-100 fw-semibold py-2">
                                <i class="bi bi-check2-circle me-2"></i><?php echo $btnText; ?>
                            </button>

                        </div>

                        <div class="col-md-6">
                            <a href="/page-evenement?id=<?php echo htmlspecialchars($event_id); ?>"
                                class="btn btn-outline-warning btn-rounded w-100 d-flex align-items-center justify-content-center fw-semibold py-2">
                                <i class="bi bi-arrow-left me-2"></i>Retour
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include_once(__DIR__ . '/../../templates/VisualFooter.php'); ?>
    <?php include_once(__DIR__ . '/../../templates/footer.php'); ?>
</div>