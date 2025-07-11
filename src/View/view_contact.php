<?php include_once(__DIR__ . '/../../templates/head.php'); ?>
<?php include_once(__DIR__ . '/../../templates/navbar.php'); ?>

<div class="custom-bg min-vh-100 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">


                <!-- Titre de la page -->
                <p class="display-6 fw-bold text-light mb-4">Nous Contacter</p>

                <!-- Section des informations de contact -->
                <div class="form-section-bg p-4 rounded text-light mb-4">

                    <p class="fw-semibold text-light mb-3">
                        <i class="bi bi-info-circle-fill text-warning me-2"></i>Informations de Contact
                    </p>
                    <div class="section-divider"></div>

                    <div class="mb-3">
                        <i class="bi bi-geo-alt-fill contact-icon"></i>
                        <span class="fw-semibold text-warning">Adresse :</span>
                        Harfleur Poker Club, Maison des Associations, 5 rue Friedrich Engels, 76700 Harfleur, France
                    </div>

                    <div class="mb-3">
                        <i class="bi bi-envelope-fill contact-icon"></i>
                        <span class="fw-semibold text-warning">Email :</span>
                        patrick.piednoel@sfr.fr
                    </div>

                    <div class="mb-3">
                        <i class="bi bi-telephone-fill contact-icon"></i>
                        <span class="fw-semibold text-warning">Téléphone :</span>
                        +33 6 28 20 64 35
                    </div>

                    <div>
                        <i class="bi bi-share-fill contact-icon"></i>
                        <span class="fw-semibold text-warning">Réseaux Sociaux :</span>
                        Facebook | Twitter | Instagram
                    </div>
                </div>

                <!-- Section de la carte -->
                <div class="form-section-bg p-4 rounded text-light">
                    <p class="fw-semibold text-light mb-3">
                        <i class="bi bi-geo-fill text-warning me-2"></i>Notre Localisation
                    </p>
                    <div class="section-divider"></div>

                    <div class="ratio ratio-16x9 rounded overflow-hidden">
                        <iframe data-map-src="https://www.google.com/maps?q=Maison+des+Associations,+5+rue+Friedrich+Engels,+76700+Harfleur,+France&output=embed" style="border:0;"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <p class="small text-warning mt-2" id="map-consent-msg">La carte apparaîtra après acceptation des cookies.</p>
                </div>

            </div>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../templates/VisualFooter.php'); ?>
    <?php include_once(__DIR__ . '/../../templates/footer.php'); ?></div>