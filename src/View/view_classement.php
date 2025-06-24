<?php
include_once(__DIR__ . '/../../templates/head.php');
include_once(__DIR__ . '/../../templates/navbar.php');
?>

<div class="custom-bg min-vh-100 py-5">
    <div class="container">
        <p class="display-6 fw-bold text-light mb-4">Classement</p>

        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1): ?>
            <div class="mt-4">
                <a href="/ajouter-classement"
                    class="btn btn-warning btn-rounded w-100 fw-semibold">
                    <i class="bi bi-plus-lg me-2"></i> Ajouter un classement
                </a>
            </div>
        <?php endif; ?>

        <div class="form-section-bg p-4 rounded">
            <!-- Ligne d'en-tête -->
            <div class="row text-light fw-bold border-bottom py-2">
                <div class="col-3 col-md-1">Rang</div>
                <div class="col-3 col-md-6">Joueur</div>
                <div class="col-3 col-md-3">Points</div>
                <div class="col-3 col-md-2 text-center">Action</div>
            </div>

            <!-- Lignes de données -->
            <?php foreach ($classement as $entry): ?>
                <div class="row border-bottom py-2 custom-text align-items-center">
                    <div class="col-3 col-md-1"><?php echo htmlspecialchars($entry['cla_rang']); ?></div>
                    <div class="col-3 col-md-6"><?php echo htmlspecialchars($entry['cla_nomjoueur']); ?></div>
                    <div class="col-3 col-md-3"><?php echo htmlspecialchars($entry['cla_points']); ?></div>

                    <div class="col-3 col-md-2 text-center">
                        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1): ?>
                            <a href="/modifier-classement?id=<?php echo $entry['id_cla']; ?>"
                                class="btn btn-warning btn-sm mb-1">Modifier</a>
                            <a href="/supprimer-classement?id=<?php echo $entry['id_cla']; ?>"
                                class="btn btn-warning btn-sm">Supprimer</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php include_once(__DIR__ . '/../../templates/VisualFooter.php'); ?>
        <?php include_once(__DIR__ . '/../../templates/footer.php'); ?>
    </div>
</div>