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
              <a href="/agenda/tournois" class="btn btn-outline-warning btn-sm">Vue liste des tournois</a>
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
                <div class="col-sm-4 text-sm-end mt-2 mt-sm-0 d-flex flex-column gap-2 justify-content-sm-end align-items-sm-end align-items-start">
                  <div class="d-flex gap-2">
                    <button type="button" class="btn btn-outline-warning btn-sm" id="check-all">Tout cocher</button>
                    <button type="button" class="btn btn-outline-warning btn-sm" id="uncheck-all">Tout décocher</button>
                  </div>
                  <div class="form-check text-start">
                    <input class="form-check-input" type="checkbox" name="use_selection" value="1" id="use-selection">
                    <label class="form-check-label small" for="use-selection">N'envoyer que les évènements cochés</label>
                  </div>
                  <button type="submit" class="btn btn-warning btn-sm">Envoyer</button>
                </div>
              </div>
            </div>
            <div class="form-section-bg p-3 rounded text-light mb-4">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <p class="mb-0 fw-semibold">Évènements de la période sélectionnée</p>
                <span class="badge bg-warning text-dark" id="agenda-selection-count">0</span>
              </div>
              <p class="small custom-text mb-3">La liste se met à jour selon les dates ci-dessus. Décochez uniquement si vous cochez l'option "N'envoyer que les évènements cochés".</p>
              <div id="agenda-selection-status" class="small custom-text">Chargement en cours…</div>
              <div id="agenda-selection-list" class="d-flex flex-column gap-2"></div>
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
                      echo '<a class="text-decoration-none text-warning" href="' . $url . '"><strong>' . $time . '</strong> ' . $title . '</a>';
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
              if (!form) {
                return;
              }

              const checkAllBtn = document.getElementById('check-all');
              const uncheckAllBtn = document.getElementById('uncheck-all');
              const startInput = form.querySelector('input[name="start_date"]');
              const endInput = form.querySelector('input[name="end_date"]');
              const listContainer = document.getElementById('agenda-selection-list');
              const status = document.getElementById('agenda-selection-status');
              const countBadge = document.getElementById('agenda-selection-count');

              function toggleCheckboxes(val) {
                if (!listContainer) return;
                listContainer.querySelectorAll('input[type="checkbox"]').forEach(cb => {
                  cb.checked = val;
                });
              }

              function getCurrentlyCheckedIds() {
                if (!listContainer) return new Set();
                const ids = [];
                listContainer.querySelectorAll('input[name="selected_ids[]"]:checked').forEach(cb => {
                  ids.push(Number(cb.value));
                });
                return new Set(ids);
              }

              function formatDate(value) {
                if (!value) return '';
                const parts = value.split('-');
                if (parts.length !== 3) return value;
                return parts[2] + '/' + parts[1] + '/' + parts[0];
              }

              function createEventItem(event, isChecked) {
                const wrapper = document.createElement('div');
                wrapper.className = 'form-check d-flex gap-2 align-items-start p-2 border rounded border-secondary';

                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.className = 'form-check-input mt-1';
                checkbox.name = 'selected_ids[]';
                checkbox.value = String(event.id);
                checkbox.checked = isChecked;

                const details = document.createElement('div');

                const titleLink = document.createElement('a');
                titleLink.className = 'text-decoration-none text-warning fw-semibold';
                titleLink.href = '/page-evenement?id=' + encodeURIComponent(event.id);
                titleLink.textContent = event.title || 'Évènement';

                const meta = document.createElement('div');
                meta.className = 'small custom-text';
                const time = event.time ? event.time.substring(0, 5) : '';
                const location = event.location ? ' • ' + event.location : '';
                meta.textContent = formatDate(event.date) + (time ? ' ' + time : '') + location;

                details.appendChild(titleLink);
                details.appendChild(meta);

                wrapper.appendChild(checkbox);
                wrapper.appendChild(details);
                return wrapper;
              }

              function renderEvents(events, previouslyCheckedIds) {
                if (!listContainer || !status || !countBadge) {
                  return;
                }

                const previouslyChecked = previouslyCheckedIds instanceof Set ? previouslyCheckedIds : new Set();
                const hadManualSelection = previouslyChecked.size > 0;

                listContainer.innerHTML = '';

                if (!events.length) {
                  countBadge.textContent = '0';
                  status.textContent = 'Aucun évènement dans cette période.';
                  status.classList.remove('d-none');
                  return;
                }

                status.textContent = '';
                status.classList.add('d-none');
                countBadge.textContent = String(events.length);

                events.forEach(event => {
                  const isChecked = hadManualSelection ? previouslyChecked.has(event.id) : true;
                  listContainer.appendChild(createEventItem(event, isChecked));
                });
              }

              function fetchEvents() {
                if (!startInput || !endInput || !status) {
                  return;
                }
                const start = startInput.value;
                const end = endInput.value;
                if (!start || !end) {
                  return;
                }

                const previouslyChecked = getCurrentlyCheckedIds();
                status.textContent = 'Chargement en cours…';
                status.classList.remove('d-none');
                listContainer.innerHTML = '';
                countBadge.textContent = '0';

                const params = new URLSearchParams({ start, end });
                fetch('/agenda/events-range?' + params.toString(), {
                  headers: { 'Accept': 'application/json' }
                })
                  .then(response => {
                    if (!response.ok) {
                      throw new Error('Erreur');
                    }
                    return response.json();
                  })
                  .then(data => {
                    if (!data || !Array.isArray(data.events)) {
                      throw new Error('Format inattendu');
                    }
                    renderEvents(data.events, previouslyChecked);
                  })
                  .catch(() => {
                    status.textContent = 'Impossible de récupérer les évènements pour cette période.';
                    status.classList.remove('d-none');
                  });
              }

              if (checkAllBtn) {
                checkAllBtn.addEventListener('click', () => toggleCheckboxes(true));
              }

              if (uncheckAllBtn) {
                uncheckAllBtn.addEventListener('click', () => toggleCheckboxes(false));
              }

              if (startInput) {
                startInput.addEventListener('change', fetchEvents);
              }

              if (endInput) {
                endInput.addEventListener('change', fetchEvents);
              }

              fetchEvents();
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
