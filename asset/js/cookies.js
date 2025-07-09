document.addEventListener('DOMContentLoaded', () => {
  const match = document.cookie.match(/cookie_consent=(accepted|declined)/);
  const consent = match ? match[1] : null;

  if (consent === 'accepted') {
    enableThirdParties();
  } else if (!consent) {
    const banner = document.createElement('div');
    banner.className = 'cookie-banner';
    banner.innerHTML =
      'Ce site utilise des cookies tiers pour Google\u00a0reCAPTCHA et Google\u00a0Maps.' +
      '<button id="cookie-accept" class="btn btn-sm btn-success ms-2">Accepter</button>' +
      '<button id="cookie-decline" class="btn btn-sm btn-secondary ms-2">Refuser</button>';
    document.body.appendChild(banner);

    document.getElementById('cookie-accept').addEventListener('click', () => {
      document.cookie = 'cookie_consent=accepted;path=/;max-age=' + 60 * 60 * 24 * 180;
      banner.remove();
      enableThirdParties();
    });
    document.getElementById('cookie-decline').addEventListener('click', () => {
      document.cookie = 'cookie_consent=declined;path=/;max-age=' + 60 * 60 * 24 * 180;
      banner.remove();
    });
  }
});

function enableThirdParties() {
  if (window.requiresRecaptcha && !document.getElementById('recaptcha-script')) {
    const script = document.createElement('script');
    script.id = 'recaptcha-script';
    script.src = 'https://www.google.com/recaptcha/api.js';
    script.async = true;
    script.defer = true;
    document.body.appendChild(script);
  }

  document.querySelectorAll('iframe[data-map-src]').forEach(frame => {
    if (!frame.src) {
      frame.src = frame.dataset.mapSrc;
    }
  });
}
