<?php include_once(__DIR__ . '/../../templates/head.php'); ?>
<?php include_once(__DIR__ . '/../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10">

        <!-- Titre + Modifier + Supprimer -->
        <div class="row align-items-center mb-4">
          <div class="col-md-6">
            <p class="display-6 fw-bold text-light mb-0">Info évènement</p>
          </div>
          <?php if (isset($_SESSION['user_id'])): ?>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
              <a href="/modifier-evenement?id=<?php echo $evenement['id_eve']; ?>"
                class="btn btn-warning">Modifier</a>

              <!-- Bouton de déclenchement -->
              <button class="btn btn-sm custom-add text-light px-3 py-2" data-bs-toggle="modal"
                data-bs-target="#confirmDeleteModal" data-event-id="<?php echo $evenement['id_eve']; ?>">
                Supprimer
              </button>

              <!-- Fenêtre de confirmation de suppression -->
              <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content custom-bg text-light">
                    <div class="modal-header border-0">
                      <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmer la suppression</h5>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                      Êtes-vous sûr de vouloir supprimer cet évènement ?
                    </div>
                    <div class="modal-footer border-0">
                      <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Annuler</button>
                      <a href="#" class="btn custom-add text-light" id="confirmDeleteBtn">Supprimer</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>

        <!-- Carte principale -->
        <div class="form-section-bg p-4 rounded text-light">

          <!-- Titre de l'évènement -->
          <div class="row mb-4">
            <div class="col-12">
              <h2 class="fw-bold mb-0 text-light"><?php echo htmlspecialchars($evenement['eve_titre']); ?></h2>
            </div>
          </div>

          <div class="row g-4 mb-4">
            <!-- Colonnes d'informations -->
            <div class="col-md-6">

              <div class="row mb-3">
                <div class="col-6">
                  <i class="bi bi-calendar-event text-warning me-2"></i>
                  <span class="fw-semibold text-warning">Date et heure</span><br>
                  <span class="custom-text">
                    <?php echo date('d/m/Y', strtotime($evenement['eve_date'])); ?>,
                    <?php echo date('H:i', strtotime($evenement['eve_heure'])); ?>
                  </span>
                </div>
                <div class="col-6">
                  <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                  <span class="fw-semibold text-warning">Lieu</span><br>
                  <span class="custom-text"><?php echo htmlspecialchars($evenement['eve_lieu']); ?></span>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-12">
                  <i class="bi bi-info-circle text-warning me-2"></i>
                  <span class="fw-semibold text-warning">Description</span><br>
                  <span class="custom-text"><?php echo nl2br(htmlspecialchars($evenement['eve_description'])); ?></span>
                </div>
              </div>

            </div>

            <!-- Colonne de l'image droite -->
            <div class="col-md-6 text-center">
              <img src="/asset/img/<?php echo htmlspecialchars($evenement['eve_image']); ?>" alt="Image de l'évènement"
                class="img-fluid rounded" style="max-height: 280px;">
            </div>
          </div>

          <!-- Boutons d'action -->
          <div class="row g-3 mt-4">
            <?php if ($evenement['id_type_eve'] == 2): ?>
              <?php if (isset($_SESSION['user_id'])): ?>
                <div class="col-md-6">
                  <a href="/rejoindre-page?event=<?php echo $evenement['id_eve']; ?>"
                    class="btn btn-warning btn-rounded w-100 fw-semibold">
                    <i class="bi bi-plus-lg me-2"></i> S’inscrire à l’évènement
                  </a>
                </div>
              <?php else: ?>
                <div class="col-md-6 d-flex align-items-center">
                  <p class="text-warning mb-0 fw-semibold">
                    Vous devez vous <a href="/connexion"
                      class="text-warning text-decoration-underline">connecter</a> pour pouvoir rejoindre l'évènement.
                  </p>
                </div>
              <?php endif; ?>
            <?php endif; ?>

            <div class="col-md-6">
              <a href="/evenements"
                class="btn btn-outline-warning btn-rounded w-100 fw-semibold text-center">
                <i class="bi bi-arrow-left me-2"></i> Retour
              </a>
            </div>
          </div>


        </div>

      </div>
    </div>
  </div>
  <?php include_once(__DIR__ . '/../../templates/VisualFooter.php'); ?>
  <?php include_once(__DIR__ . '/../../templates/footer.php'); ?>
</div>

<script>
  const deleteModal = document.getElementById('confirmDeleteModal');
  if (deleteModal) {
    deleteModal.addEventListener('show.bs.modal', function (event) {
      const button = event.relatedTarget;
      const eventId = button.getAttribute('data-event-id');
      const confirmBtn = document.getElementById('confirmDeleteBtn');
      confirmBtn.href = '/supprimer-evenement?id=' + eventId;
    });
  }
</script>