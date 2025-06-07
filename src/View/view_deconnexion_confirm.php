<?php include_once('../../templates/head.php'); ?>
<?php include_once('../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 d-flex align-items-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="form-section-bg rounded p-4 text-center">
                    <p class="fs-5 fw-semibold text-light mb-4">Êtes-vous sûr de vouloir vous déconnecter ?</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="/src/Controller/DeconnexionController.php" class="btn btn-warning fw-semibold">Se déconnecter</a>
                        <a href="/src/Controller/IndexController.php" class="btn btn-outline-warning fw-semibold">Annuler</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('../../templates/footer.php'); ?>