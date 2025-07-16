<?php include_once(__DIR__ . '/../../templates/head.php'); ?>
<?php include_once(__DIR__ . '/../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <p class="display-6 fw-bold text-light mb-4">Vos prochains tournois</p>

                <?php if (empty($tournois)): ?>
                    <p class="text-light">Vous n'êtes inscrit à aucun tournoi.</p>
                <?php else: ?>
                    <?php foreach ($tournois as $tournoi): ?>
                        <div class="form-section-bg p-3 rounded text-light mb-4">
                            <div class="row align-items-center">
                                <div class="col-md-10">
                                    <p class="mb-1 fw-bold"><?php echo htmlspecialchars($tournoi['eve_titre']); ?></p>
                                    <p class="mb-0 custom-text">
                                        <?php echo date('d/m/Y', strtotime($tournoi['eve_date'])); ?> -
                                        <?php echo htmlspecialchars($tournoi['eve_lieu']); ?>
                                    </p>
                                </div>
                                <div class="col-md-2 text-md-end mt-3 mt-md-0">
                                    <a href="/page-evenement?id=<?php echo $tournoi['id_eve']; ?>" class="btn btn-warning btn-rounded fw-semibold btn-sm w-100">Détails</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../templates/VisualFooter.php'); ?>
    <?php include_once(__DIR__ . '/../../templates/footer.php'); ?>
</div>
