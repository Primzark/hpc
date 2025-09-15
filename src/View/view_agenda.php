<?php include_once(__DIR__ . '/../../templates/head.php'); ?>
<?php include_once(__DIR__ . '/../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10">
        <div class="d-flex align-items-center justify-content-between mb-4">
          <p class="display-6 fw-bold text-light mb-0">Agenda</p>
          <div class="d-flex gap-2">
            <a class="btn btn-outline-warning btn-sm" href="/agenda?month=<?php echo $prevMonth; ?>&year=<?php echo $prevYear; ?>">&laquo; Mois précédent</a>
            <a class="btn btn-warning btn-sm" href="/agenda?month=<?php echo $nextMonth; ?>&year=<?php echo $nextYear; ?>">Mois suivant &raquo;</a>
          </div>
        </div>

        <?php if (isset($_GET['sent'])): ?>
          <?php if ($_GET['sent'] == '1'): ?>
            <div class="alert alert-success">Agenda envoyé aux membres.</div>
          <?php else: ?>
            <div class="alert alert-danger">Erreur lors de l'envoi de l'agenda. Voir les logs.</div>
          <?php endif; ?>
        <?php endif; ?>

        <div class="form-section-bg p-3 rounded text-light mb-4">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <?php
                $moisNoms = [1=>'janvier','février','mars','avril','mai','juin','juillet','août','septembre','octobre','novembre','décembre'];
                $titreMois = $moisNoms[(int)date('n', strtotime($firstDay))] . ' ' . date('Y', strtotime($firstDay));
              ?>
              <p class="mb-0 fw-semibold"><?php echo $titreMois; ?></p>
              <small class="custom-text">Consultez les évènements du club et les tournois.</small>
            </div>
            <div class="d-flex gap-2">
              <a href="/agenda.ics" class="btn btn-outline-warning btn-sm">Télécharger l'agenda (.ics)</a>
            </div>
          </div>
        </div>

        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1): ?>
          <form method="post" action="/agenda/envoyer" id="send-agenda-form" onsubmit="return confirm('Envoyer l\'agenda aux membres avec la sélection en cours ?');">
            <div class="form-section-bg p-3 rounded text-light mb-3">
              <div class="row g-2 align-items-end">
                <div class="col-sm-4">
                  <label class="form-label small">Début</label>
                  <input type="date" class="form-control custom-add" name="start_date" value="<?php echo htmlspecialchars($firstDay); ?>">
                </div>
                <div class="col-sm-4">
                  <label class="form-label small">Fin</label>
                  <input type="date" class="form-control custom-add" name="end_date" value="<?php echo htmlspecialchars($lastDay); ?>">
                </div>
                <div class="col-sm-4 text-sm-end mt-2 mt-sm-0 d-flex gap-2 justify-content-sm-end">
                  <button type="button" class="btn btn-outline-warning btn-sm" id="check-all">Tout cocher</button>
                  <button type="button" class="btn btn-outline-warning btn-sm" id="uncheck-all">Tout décocher</button>
                  <button type="submit" class="btn btn-warning btn-sm">Envoyer la sélection</button>
                </div>
              </div>
            </div>
        <?php endif; ?>

        <?php
          // Prépare calendrier
          $daysInMonth = (int) date('t', strtotime($firstDay));
          $firstWeekday = (int) date('N', strtotime($firstDay)); // 1 (Lun) .. 7 (Dim)
          $weekdays = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
        ?>

        <div class="table-responsive">
          <table class="table table-dark table-bordered align-middle">
            <thead>
              <tr>
                <?php foreach ($weekdays as $wd): ?>
                  <th class="text-center"><?php echo $wd; ?></th>
                <?php endforeach; ?>
              </tr>
            </thead>
            <tbody>
              <?php
                $day = 1;
                $cell = 1;
                echo '<tr>';
                // cellules vides avant le 1er du mois
                for ($i = 1; $i < $firstWeekday; $i++, $cell++) {
                  echo '<td class="bg-transparent"></td>';
                }
                while ($day <= $daysInMonth) {
                  $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
                  echo '<td class="form-section-bg" style="vertical-align: top;">';
                  $dayBadge = '<span class="badge bg-warning text-dark">' . $day . '</span>';
                  if (isset($_SESSION['user_id']) && isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1) {
                    $addUrl = '/ajouter-evenement?date=' . $dateStr;
                    $dayBadge = '<a class="text-decoration-none" href="' . $addUrl . '" title="Ajouter un évènement">' . $dayBadge . '</a>';
                  }
                  echo '<div class="d-flex justify-content-between align-items-center mb-2">' . $dayBadge . '</div>';
                  if (isset($eventsByDate[$dateStr])) {
                    foreach ($eventsByDate[$dateStr] as $ev) {
                      $time = date('H:i', strtotime($ev['eve_heure']));
                      $title = htmlspecialchars($ev['eve_titre']);
                      $url = '/page-evenement?id=' . $ev['id_eve'];
                      echo '<div class="mb-2">';
                      if (isset($_SESSION['user_id']) && isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1) {
                        echo '<div class="form-check mb-1">'
                          . '<input class="form-check-input" type="checkbox" name="selected_ids[]" value="' . (int)$ev['id_eve'] . '" id="ev-' . (int)$ev['id_eve'] . '" checked>'
                          . '<label class="form-check-label" for="ev-' . (int)$ev['id_eve'] . '">'
                          . '<a class="text-decoration-none text-warning" href="' . $url . '"><strong>' . $time . '</strong> ' . $title . '</a>'
                          . '</label>'
                          . '</div>';
                      } else {
                        echo '<a class="text-decoration-none text-warning" href="' . $url . '"><strong>' . $time . '</strong> ' . $title . '</a>';
                      }
                      echo '<div class="small custom-text">' . htmlspecialchars($ev['eve_lieu']) . '</div>';
                      echo '</div>';
                    }
                  } else {
                    echo '<div class="small custom-text">Aucun évènement</div>';
                  }
                  echo '</td>';
                  if ($cell % 7 == 0) {
                    echo '</tr>';
                    if ($day < $daysInMonth) echo '<tr>';
                  }
                  $day++;
                  $cell++;
                }
                // cellules vides après le dernier jour
                while (($cell - 1) % 7 != 0) {
                  echo '<td class="bg-transparent"></td>';
                  $cell++;
                }
                if (($cell - 1) % 7 == 0) {
                  echo '</tr>';
                }
              ?>
            </tbody>
          </table>
        </div>

        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1): ?>
          </form>
          <script>
            (function(){
              const form = document.getElementById('send-agenda-form');
              const checkAllBtn = document.getElementById('check-all');
              const uncheckAllBtn = document.getElementById('uncheck-all');
              function toggleCheckboxes(val) {
                if (!form) return;
                form.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = val);
              }
              if (checkAllBtn) checkAllBtn.addEventListener('click', () => toggleCheckboxes(true));
              if (uncheckAllBtn) uncheckAllBtn.addEventListener('click', () => toggleCheckboxes(false));
            })();
          </script>
        <?php endif; ?>

        <div class="mt-4">
          <p class="text-light fw-semibold mb-2">Astuces</p>
          <ul class="text-light small mb-0">
            <li>Le bouton ".ics" permet d'importer l'agenda dans Google Calendar, Outlook, etc.</li>
            <li>Vous pouvez aussi vous abonner directement: <a class="text-warning" href="/agenda.ics">/agenda.ics</a>.</li>
          </ul>
        </div>

      </div>
    </div>
  </div>
  <?php include_once(__DIR__ . '/../../templates/VisualFooter.php'); ?>
  <?php include_once(__DIR__ . '/../../templates/footer.php'); ?>
</div>
