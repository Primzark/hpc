<?php include_once(__DIR__ . '/../../templates/head.php'); ?>
<?php include_once(__DIR__ . '/../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 py-5">
    <div class="container">
        <p class="display-6 fw-bold text-light mb-4">Classement g&eacute;n&eacute;ral</p>
        <form method="get" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher un membre" value="<?php echo htmlspecialchars($search ?? ''); ?>">
                <button class="btn btn-outline-warning" type="submit">Rechercher</button>
            </div>
        </form>
        <form method="post">
            <div class="form-section-bg p-4 rounded mb-3">
                <div class="row fw-bold text-light border-bottom pb-2">
                    <div class="col-6">Membre</div>
                    <div class="col-3">Points</div>
                    <div class="col-3">Bounty</div>
                </div>
                <?php foreach ($classementGeneral as $entry): ?>
                    <div class="row align-items-center border-bottom py-2 text-light">
                        <div class="col-6">
                            <?php echo htmlspecialchars($entry['uti_nom']); ?>
                        </div>
                        <div class="col-3">
                            <input type="number" name="entries[<?php echo $entry['id_gen']; ?>][points]" value="<?php echo (int)$entry['points']; ?>" class="form-control form-control-sm">
                        </div>
                        <div class="col-3">
                            <input type="number" name="entries[<?php echo $entry['id_gen']; ?>][bounty]" value="<?php echo (int)$entry['bounty']; ?>" class="form-control form-control-sm">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-warning">Enregistrer</button>
            </div>
        </form>
        <?php include_once(__DIR__ . '/../../templates/VisualFooter.php'); ?>
        <?php include_once(__DIR__ . '/../../templates/footer.php'); ?>
    </div>
</div>
