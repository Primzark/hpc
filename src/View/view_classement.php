<?php include_once('../../templates/head.php'); ?>
<?php include_once('../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 py-5">
    <div class="container">
        <!-- Title -->
        <p class="display-6 fw-bold text-light mb-4">Classement</p>

        <!-- Add button -->
        <a href="/Poker_website/src/Controller/AjouterClassementController.php" class="btn btn-primary mb-4">
            Ajouter un classement
        </a>

        <!-- Ranking Grid -->
        <div class="form-section-bg p-4 rounded">
            <div class="row g-0 text-light">
                <!-- Header Row -->
                <div class="row border-bottom py-2">
                    <div class="col-2 col-md-1 fw-bold">Rang</div>
                    <div class="col-6 col-md-7 fw-bold">Joueur</div>
                    <div class="col-4 col-md-4 fw-bold">Points</div>
                </div>

                <!-- Data Rows -->
                <?php foreach ($classement as $entry): ?>
                    <div class="row border-bottom py-2 custom-text">
                        <div class="col-2 col-md-1"><?= htmlspecialchars($entry['cla_rang']) ?></div>
                        <div class="col-6 col-md-7"><?= htmlspecialchars($entry['cla_nomjoueur']) ?></div>
                        <div class="col-4 col-md-4"><?= htmlspecialchars($entry['cla_points']) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php include_once('../../templates/VisualFooter.php'); ?>
        <?php include_once('../../templates/footer.php'); ?>
    </div>
</div>