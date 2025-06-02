<?php
include_once('../../templates/head.php');
include_once('../../templates/navbar.php');
?>

<div class="custom-bg min-vh-100 py-5">
    <div class="container">
        <p class="display-6 fw-bold text-light mb-4">Classement</p>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/Poker_website/src/Controller/AjouterClassementController.php" class="btn btn-warning mb-4">
                Ajouter un classement
            </a>
        <?php endif; ?>

        <div class="form-section-bg p-4 rounded">
            <div class="row g-0 text-light">
                <div class="row border-bottom py-2">
                    <div class="col-1 fw-bold">Rang</div>
                    <div class="col-6 fw-bold">Joueur</div>
                    <div class="col-3 fw-bold">Points</div>
                    <div class="col-2 fw-bold text-center">Action</div>
                </div>

                <?php foreach ($classement as $entry): ?>
                    <div class="row border-bottom py-2 custom-text align-items-center">
                        <div class="col-1"><?= htmlspecialchars($entry['cla_rang']) ?></div>
                        <div class="col-6"><?= htmlspecialchars($entry['cla_nomjoueur']) ?></div>
                        <div class="col-3"><?= htmlspecialchars($entry['cla_points']) ?></div>

                        <div class="col-2 text-center">
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <a href="/Poker_website/src/Controller/SupprimerClassementController.php?id=<?= $entry['id_cla'] ?>"
                                    class="btn btn-warning">
                                    Supprimer
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php include_once('../../templates/VisualFooter.php'); ?>
        <?php include_once('../../templates/footer.php'); ?>
    </div>
</div>