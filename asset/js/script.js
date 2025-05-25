document.getElementById('joinEventBtn').addEventListener('click', function() {
    const btn = this;
    const eventId = btn.getAttribute('data-event-id');

    fetch('/Poker_website/src/Controller/rejoindre_evenement.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'event=' + encodeURIComponent(eventId)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.action === 'registered') {
                btn.innerHTML = '<i class="bi bi-check2-circle me-2"></i>Vous êtes inscrit';
                btn.classList.remove('btn-warning');
                btn.classList.add('btn-success');
            } else if (data.action === 'unregistered') {
                btn.innerHTML = '<i class="bi bi-check2-circle me-2"></i>Confirmer l’inscription';
                btn.classList.remove('btn-success');
                btn.classList.add('btn-warning');
            }
        } else {
            alert('Erreur: ' + data.message);
        }
    })
    .catch(() => alert('Erreur réseau, veuillez réessayer.'));
});



