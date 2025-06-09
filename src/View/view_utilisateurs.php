<?php include_once('../../templates/head.php'); ?>
<?php include_once('../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <p class="display-6 fw-bold text-light">Membres inscrits</p>
            </div>
        </div>

        <?php if (empty($utilisateurs)): ?>
            <p class="text-light">Aucun membre n'est enregistré.</p>
        <?php else: ?>
            <ul class="list-group">
                <?php foreach ($utilisateurs as $utilisateur): ?>
                    <li class="list-group-item form-section-bg text-light">
                        <?= htmlspecialchars($utilisateur['uti_nom']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    </div>
    <?php include_once('../../templates/VisualFooter.php'); ?>
    <?php include_once('../../templates/footer.php'); ?>
</div>
