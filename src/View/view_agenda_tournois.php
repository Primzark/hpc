<?php include_once(__DIR__ . '/../../templates/head.php'); ?>
<?php include_once(__DIR__ . '/../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center align-items-start gap-3 mb-4">
          <div>
            <p class="display-6 fw-bold text-light mb-1">Tournois à venir</p>
            <p class="small custom-text mb-0">Parcourez la liste complète des tournois programmés et accédez aux fiches détaillées en un clic.</p>
          </div>
          <div class="d-flex gap-2">
            <a href="/agenda" class="btn btn-outline-warning btn-sm">Retour agenda calendrier</a>
            <a href="/agenda.ics" class="btn btn-warning btn-sm">Télécharger (.ics)</a>
          </div>
        </div>

        <?php if (empty($tournois)): ?>
          <div class="form-section-bg p-4 rounded text-light">
            <p class="mb-0">Aucun tournoi n'est prévu pour le moment.</p>
          </div>
        <?php else: ?>
          <?php
            $grouped = [];
            $monthNames = [
              1 => 'janvier',
              2 => 'février',
              3 => 'mars',
              4 => 'avril',
              5 => 'mai',
              6 => 'juin',
              7 => 'juillet',
              8 => 'août',
              9 => 'septembre',
              10 => 'octobre',
              11 => 'novembre',
              12 => 'décembre'
            ];
            foreach ($tournois as $event) {
              $timestamp = strtotime($event['eve_date']);
              $monthKey = date('Y-m', $timestamp);
              if (!isset($grouped[$monthKey])) {
                $monthNumber = (int) date('n', $timestamp);
                $label = $monthNames[$monthNumber] ?? date('F', $timestamp);
                $grouped[$monthKey] = [
                  'label' => $label . ' ' . date('Y', $timestamp),
                  'events' => [],
                ];
              }
              $grouped[$monthKey]['events'][] = $event;
            }
          ?>
          <?php foreach ($grouped as $month => $data): ?>
            <div class="mb-5">
              <div class="d-flex align-items-center gap-3 mb-3">
                <span class="badge bg-warning text-dark text-uppercase"><?php echo htmlspecialchars(ucfirst($data['label'])); ?></span>
                <div class="flex-grow-1 border-top border-warning border-opacity-50"></div>
              </div>
              <div class="d-flex flex-column gap-3">
                <?php foreach ($data['events'] as $event): ?>
                  <div class="form-section-bg p-3 rounded text-light shadow-sm">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
                      <div>
                        <p class="mb-1 fw-semibold text-warning">
                          <?php echo date('d/m/Y', strtotime($event['eve_date'])); ?> à <?php echo date('H:i', strtotime($event['eve_heure'])); ?>
                        </p>
                        <p class="mb-1 h5 text-light"><?php echo htmlspecialchars($event['eve_titre']); ?></p>
                        <p class="mb-2 small custom-text">
                          <?php echo htmlspecialchars($event['eve_lieu']); ?>
                        </p>
                        <p class="mb-0 small custom-text">
                          <?php echo nl2br(htmlspecialchars($event['eve_description'])); ?>
                        </p>
                      </div>
                      <div class="d-flex flex-column justify-content-start align-items-md-end align-items-start gap-2">
                        <a href="/page-evenement?id=<?php echo $event['id_eve']; ?>" class="btn btn-outline-warning btn-sm">Voir le détail</a>
                        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1): ?>
                          <a href="/modifier-evenement?id=<?php echo $event['id_eve']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>

      </div>
    </div>
  </div>
  <?php include_once(__DIR__ . '/../../templates/VisualFooter.php'); ?>
  <?php include_once(__DIR__ . '/../../templates/footer.php'); ?>
</div>
