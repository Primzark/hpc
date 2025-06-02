<?php include_once('../../templates/head.php'); ?>
<?php include_once('../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">

                <!-- Page Title -->
                <p class="display-6 fw-bold text-light mb-4">Évènements</p>

                <?php if (empty($evenements)): ?>
                    <p class="text-light">Aucun évènement à afficher pour le moment.</p>
                <?php else: ?>
                    <?php foreach ($evenements as $evenement): ?>
                        <div class="form-section-bg p-3 rounded text-light mb-4">
                            <div class="row">
                                <div class="col-md-10">
                                    <p class="mb-1 custom-text small"><?= date('d/m/Y', strtotime($evenement['eve_date'])) ?>
                                    </p>
                                    <p class="mb-1 fw-bold"><?= htmlspecialchars($evenement['eve_titre']) ?></p>
                                    <p class="mb-0 text-light"><?= nl2br(htmlspecialchars($evenement['eve_description'])) ?></p>
                                </div>
                                <div class="col-md-2 d-flex align-items-center justify-content-end">
                                    <a href="/Poker_website/src/Controller/PageEvenementController.php?id=<?= $evenement['id_eve'] ?>"
                                        class="btn btn-warning btn-rounded fw-semibold">En savoir plus</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="mt-4">
                        <a href="/Poker_website/src/Controller/AjouterEvenementController.php"
                            class="btn btn-warning btn-rounded w-100 fw-semibold">
                            <i class="bi bi-plus-lg me-2"></i> Ajouter un évènement
                        </a>
                    </div>
                <?php endif; ?>


            </div>
        </div>
    </div>
    <?php include_once('../../templates/VisualFooter.php'); ?>
    <?php include_once('../../templates/footer.php'); ?>
</div>