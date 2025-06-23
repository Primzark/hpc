<?php include_once(__DIR__ . '/../../templates/head.php'); ?>
<?php include_once(__DIR__ . '/../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <p class="display-6 fw-bold text-light">Trombinoscope</p>
            </div>
        </div>

        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="mb-4">
                <a href="/ajouter-trombinoscope" class="btn btn-warning btn-rounded w-100 fw-semibold">
                    <i class="bi bi-plus-lg me-2"></i> Ajouter au trombinoscope
                </a>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            <?php foreach ($members as $member): ?>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card custom-add border-0 rounded-3 shadow p-3 text-center">
                        <img src="/asset/img/<?php echo htmlspecialchars($member['tro_image']); ?>" class="mx-auto mb-3"
                            alt="<?php echo htmlspecialchars($member['tro_pseudo']); ?>"
                            style="width:200px; height:200px; object-fit:cover; border-radius:50%;">
                        <p class="field-text mb-1"><?php echo htmlspecialchars($member['tro_pseudo']); ?></p>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="/supprimer-trombinoscope?id=<?php echo $member['id_tro']; ?>"
                                class="btn btn-warning btn-sm mt-2">Supprimer</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include_once(__DIR__ . '/../../templates/footer.php'); ?>