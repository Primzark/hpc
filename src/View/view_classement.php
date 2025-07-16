<?php
include_once(__DIR__ . '/../../templates/head.php');
include_once(__DIR__ . '/../../templates/navbar.php');
?>

<div class="custom-bg min-vh-100 py-5">
    <div class="container">
        <p class="display-6 fw-bold text-light mb-4">Classement</p>

        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1): ?>
            <div class="mt-4 d-flex flex-column gap-2">
                <a href="/ajouter-classement" class="btn btn-warning btn-rounded w-100 fw-semibold">
                    <i class="bi bi-plus-lg me-2"></i> Ajouter un classement
                </a>
                <a href="/classement-general" class="btn btn-warning btn-rounded w-100 fw-semibold">
                    Classement g&eacute;n&eacute;ral
                </a>
            </div>
        <?php endif; ?>

        <div class="form-section-bg p-4 rounded">
            <!-- Ligne d'en-tête -->
            <div class="row text-light fw-bold border-bottom py-2">
                <div class="col-4 col-md-1">Rang</div>
                <div class="col-4 col-md-7">Joueur</div>
                <div class="col-4 col-md-3">Points</div>
                <?php // Action column removed ?>
            </div>

            <!-- Lignes de données -->
        <?php foreach ($classement as $entry): ?>
                <div class="row border-bottom py-2 custom-text align-items-center">
                    <div class="col-4 col-md-1"><?php echo htmlspecialchars($entry['cla_rang']); ?></div>
                    <div class="col-4 col-md-7"><?php echo htmlspecialchars($entry['cla_nomjoueur']); ?></div>
                    <div class="col-4 col-md-3"><?php echo htmlspecialchars($entry['cla_points']); ?></div>
                    <?php // Delete button removed ?>
                </div>
        <?php endforeach; ?>
        </div>

        <?php // Delete confirmation modal removed ?>

        <?php include_once(__DIR__ . '/../../templates/VisualFooter.php'); ?>
        <?php include_once(__DIR__ . '/../../templates/footer.php'); ?>
    </div>
</div>

<?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1): ?>
    <!-- Delete script removed -->
<?php endif; ?>