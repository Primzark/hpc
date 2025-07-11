<?php include_once(__DIR__ . '/../../templates/head.php'); ?>
<?php include_once(__DIR__ . '/../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <p class="display-6 fw-bold text-light">Participants inscrits</p>
            </div>
        </div>

        <?php if (empty($participants)): ?>
            <p class="text-light">Aucun participant inscrit pour cet &eacute;v&egrave;nement.</p>
        <?php else: ?>
            <ul class="list-group mb-4">
                <?php foreach ($participants as $participant): ?>
                    <li class="list-group-item form-section-bg text-light">
                        <?php echo htmlspecialchars($participant['uti_nom']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <a href="/page-evenement?id=<?php echo $event_id; ?>" class="btn btn-outline-warning btn-rounded">
            <i class="bi bi-arrow-left me-2"></i> Retour
        </a>
    </div>
    <?php include_once(__DIR__ . '/../../templates/VisualFooter.php'); ?>
    <?php include_once(__DIR__ . '/../../templates/footer.php'); ?>
</div>
