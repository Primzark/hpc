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
                <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1): ?>
                    <div class="d-none d-md-block col-md-1">Action</div>
                <?php endif; ?>
            </div>

            <!-- Lignes de données -->
        <?php foreach ($classement as $entry): ?>
                <div class="row border-bottom py-2 custom-text align-items-center">
                    <div class="col-4 col-md-1"><?php echo htmlspecialchars($entry['cla_rang']); ?></div>
                    <div class="col-4 col-md-7"><?php echo htmlspecialchars($entry['cla_nomjoueur']); ?></div>
                    <div class="col-4 col-md-3"><?php echo htmlspecialchars($entry['cla_points']); ?></div>
                    <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1): ?>
                        <div class="col-12 col-md-1 text-md-end mt-2 mt-md-0">
                            <button class="btn btn-sm custom-add text-light" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-gen-id="<?php echo $entry['cla_id_gen']; ?>">Supprimer</button>
                        </div>
                    <?php endif; ?>
                </div>
        <?php endforeach; ?>
        </div>

        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1): ?>
            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content custom-bg text-light">
                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmer la suppression</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer ce joueur du classement ?
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Annuler</button>
                            <a href="#" class="btn custom-add text-light" id="confirmDeleteBtn">Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php include_once(__DIR__ . '/../../templates/VisualFooter.php'); ?>
        <?php include_once(__DIR__ . '/../../templates/footer.php'); ?>
    </div>
</div>

<?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1): ?>
    <script>
        const deleteModal = document.getElementById('confirmDeleteModal');
        if (deleteModal) {
            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const genId = button.getAttribute('data-gen-id');
                const confirmBtn = document.getElementById('confirmDeleteBtn');
                confirmBtn.href = '/supprimer-classement?id=' + genId;
            });
        }
    </script>
<?php endif; ?>