const joinBtn = document.getElementById('joinEventBtn');
const countElem = document.getElementById('participantsCount');

if (joinBtn) {
    joinBtn.addEventListener('click', function () {
        const btn = this;
        const eventId = btn.getAttribute('data-event-id');

        fetch('/ajax/rejoindre-evenement', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'event=' + encodeURIComponent(eventId)
        })
            .then(response => response.json())
            .then(data => {
                if (data.status == 'success') {
                    if (data.action == 'inscrit') {
                        btn.innerHTML = '<i class="bi bi-check2-circle me-2"></i>Cliquer pour vous desinscrire';
                        btn.classList.remove('btn-warning');
                        btn.classList.add('btn-success');
                    } else if (data.action == 'desinscrit') {
                        btn.innerHTML = '<i class="bi bi-check2-circle me-2"></i>Cliquer pour vous inscrire';
                        btn.classList.remove('btn-success');
                        btn.classList.add('btn-warning');
                    }
                    if (countElem && typeof data.count !== 'undefined') {
                        countElem.textContent = data.count;
                    }
                } else {
                    alert('Erreur: ' + data.message);
                }
            })
            .catch(() => alert('Erreur reseau, veuillez reessayer.'));
    });
}
