<?php include_once '../../templates/head.php'; ?>

<nav class="navbar navbar-expand-lg navbar-dark custom-bg px-4 py-3 sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center gap-2" href="/Poker_website/public/index.php">
      <span class="fw-bold text-white">Harfleur Poker Club</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
      aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php if (isset($_SESSION['user_id'])): ?>
          <li class="nav-item">
            <a class="nav-link text-warning fw-semibold" href="/Poker_website/src/Controller/DeconnexionController.php">Se
              déconnecter</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link text-warning fw-semibold" href="/Poker_website/src/Controller/ConnexionController.php">Se
              connecter</a>
          </li>
        <?php endif; ?>
        <li class="nav-item"><a class="nav-link text-white" href="/Poker_website/public/index.php">Accueil</a>
        </li>
        <li class="nav-item"><a class="nav-link text-white"
            href="/Poker_website/src/Controller/ClassementController.php">Classement</a>
        </li>
        <li class="nav-item"><a class="nav-link text-white"
            href="/Poker_website/src/Controller/RegleController.php">Règles du poker</a></li>
        <li class="nav-item"><a class="nav-link text-white"
            href="/Poker_website/src/Controller/PartenaireController.php">Partenaires</a></li>
        <li class="nav-item"><a class="nav-link text-white"
            href="/Poker_website/src/Controller/AjouterEvenementController.php">Ajouter un
            évènement</a>
        </li>
        <li class="nav-item"><a class="nav-link text-white"
            href="/Poker_website/src/Controller/EvenementsController.php">Liste des évènements</a>
        </li>
        <li class="nav-item"><a class="nav-link text-white" href="/Poker_website/src/Controller/ProposController.php">À
            propos</a></li>
        <li class="nav-item"><a class="nav-link text-white"
            href="/Poker_website/src/Controller/ContactController.php">Nous
            contacter</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="custom-bg min-vh-100 py-5">
  <main class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10">

        <!-- Title + Modifier Button -->
        <div class="row align-items-center mb-4">
          <div class="col-md-6">
            <p class="display-6 fw-bold text-light mb-0">Info évènement</p>
          </div>
          <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <a href="/Poker_website/src/Controller/ModifierEvenementController.php?id=<?= $evenement['id_eve'] ?>"
              class="btn btn-warning">Modifier</a>
            <!-- Trigger Button -->
            <button class="btn btn-sm custom-add text-light px-3 py-2" data-bs-toggle="modal"
              data-bs-target="#confirmDeleteModal" data-event-id="<?= $evenement['id_eve'] ?>">
              Supprimer
            </button>
            <!-- Delete Confirmation Modal -->
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
        </div>


        <!-- Main Card -->
        <div class="form-section-bg p-4 rounded text-light">

          <!-- Event Title -->
          <div class="row mb-4">
            <div class="col-12">
              <h2 class="fw-bold mb-0 text-light"><?= htmlspecialchars($evenement['eve_titre']) ?></h2>
            </div>
          </div>

          <div class="row g-4 mb-4">
            <!-- Info Columns -->
            <div class="col-md-6">

              <div class="row mb-3">
                <div class="col-6">
                  <i class="bi bi-calendar-event text-warning me-2"></i>
                  <span class="fw-semibold text-warning">Date et heure</span><br>
                  <span class="custom-text">
                    <?= date('d/m/Y', strtotime($evenement['eve_date'])) ?>,
                    <?= date('H:i', strtotime($evenement['eve_heure'])) ?>
                  </span>
                </div>
                <div class="col-6">
                  <i class="bi bi-geo-alt-fill text-warning me-2"></i>
                  <span class="fw-semibold text-warning">Lieu</span><br>
                  <span class="custom-text"><?= htmlspecialchars($evenement['eve_lieu']) ?></span>
                </div>
              </div>


              <div class="row mb-3">
                <div class="col-6">
                  <i class="bi bi-cash-coin text-warning me-2"></i>
                  <span class="fw-semibold text-warning">Buy-in</span><br>
                  <span class="custom-text">50 €</span>
                </div>
                <div class="col-6">
                  <i class="bi bi-trophy-fill text-warning me-2"></i>
                  <span class="fw-semibold text-warning">Prize Pool</span><br>
                  <span class="custom-text">5 000 € garanti</span>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-12">
                  <i class="bi bi-info-circle text-warning me-2"></i>
                  <span class="fw-semibold text-warning">Description</span><br>
                  <span class="custom-text"><?= nl2br(htmlspecialchars($evenement['eve_description'])) ?></span>
                </div>
              </div>


            </div>

            <!-- Right Image Column -->
            <div class="col-md-6 text-center">
              <img src="/Poker_website/asset/img/<?= htmlspecialchars($evenement['eve_image']) ?>"
                alt="Image de l'évènement" class="img-fluid rounded" style="max-height: 280px;">

            </div>
          </div>

          <!-- Action Buttons -->
          <div class="row g-3 mt-4">
            <div class="col-md-6">
              <a href="/Poker_website/src/Controller/RejoindreController.php?id=<?= $evenement['id_eve'] ?>"
                class="btn btn-warning btn-rounded w-100 fw-semibold">
                <i class="bi bi-plus-lg me-2"></i> S’inscrire à l’évènement
              </a>

            </div>
            <div class="col-md-6">
              <a href="/Poker_website/public/index.php"
                class="btn btn-outline-warning btn-rounded w-100 d-flex align-items-center justify-content-center fw-semibold">
                <i class="bi bi-arrow-left me-2"></i> Retour
              </a>
            </div>
          </div>

        </div>

      </div>
    </div>
  </main>
  <?php include_once('../../templates/footer.php'); ?>
</div>

<script>
  const deleteModal = document.getElementById('confirmDeleteModal');
  deleteModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const eventId = button.getAttribute('data-event-id');
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    confirmBtn.href = '/Poker_website/src/Controller/SupprimerEvenementController.php?id=' + eventId;

  });
</script>