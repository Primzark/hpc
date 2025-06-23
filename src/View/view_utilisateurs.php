<?php include_once(__DIR__ . '/../../templates/head.php'); ?>
<?php include_once(__DIR__ . '/../../templates/navbar.php'); ?>

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
                    <li class="list-group-item form-section-bg text-light d-flex justify-content-between align-items-center">
                        <?php echo htmlspecialchars($utilisateur['uti_nom']); ?>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-user-id="<?php echo $utilisateur['id_uti']; ?>">Supprimer</button>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Modal de confirmation -->
            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content custom-bg text-light">
                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmer la suppression</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer ce membre ?
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Annuler</button>
                            <a href="#" class="btn custom-add text-light" id="confirmDeleteBtn">Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </div>
    <?php include_once(__DIR__ . '/../../templates/VisualFooter.php'); ?>
    <?php include_once(__DIR__ . '/../../templates/footer.php'); ?>
    <?php if (isset($_SESSION['user_id'])): ?>
        <script>
            const deleteModal = document.getElementById('confirmDeleteModal');
            if (deleteModal) {
                deleteModal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const userId = button.getAttribute('data-user-id');
                    const confirmBtn = document.getElementById('confirmDeleteBtn');
                    confirmBtn.href = '/supprimer-utilisateur?id=' + userId;
                });
            }
        </script>
    <?php endif; ?>
</div>