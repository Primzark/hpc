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
                        <a class="nav-link text-warning fw-semibold"
                            href="/Poker_website/src/Controller/DeconnexionController.php">Se déconnecter</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link text-warning fw-semibold"
                            href="/Poker_website/src/Controller/ConnexionController.php">Se connecter</a>
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
                <li class="nav-item"><a class="nav-link text-white"
                        href="/Poker_website/src/Controller/ProposController.php">À
                        propos</a></li>
                <li class="nav-item"><a class="nav-link text-white"
                        href="/Poker_website/src/ControllerContactController.php">Nous
                        contacter</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="custom-bg min-vh-100 py-5">
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">


                <!-- Page Title -->
                <p class="display-6 fw-bold text-light mb-4">Nous Contacter</p>

                <!-- Contact Info Section -->
                <div class="form-section-bg p-4 rounded text-light mb-4">

                    <p class="fw-semibold text-light mb-3">
                        <i class="bi bi-info-circle-fill text-warning me-2"></i>Informations de Contact
                    </p>
                    <div class="section-divider"></div>

                    <div class="mb-3">
                        <i class="bi bi-geo-alt-fill contact-icon"></i>
                        <span class="fw-semibold text-warning">Adresse :</span>
                        Harfleur Poker Club, 123 Rue de la Passion, 76600 Le Havre, France
                    </div>

                    <div class="mb-3">
                        <i class="bi bi-envelope-fill contact-icon"></i>
                        <span class="fw-semibold text-warning">Email :</span>
                        patrick.piednoel@sfr.fr
                    </div>

                    <div class="mb-3">
                        <i class="bi bi-telephone-fill contact-icon"></i>
                        <span class="fw-semibold text-warning">Téléphone :</span>
                        +33 123 45 67 89
                    </div>

                    <div>
                        <i class="bi bi-share-fill contact-icon"></i>
                        <span class="fw-semibold text-warning">Réseaux Sociaux :</span>
                        Facebook | Twitter | Instagram
                    </div>
                </div>

                <!-- Map Section -->
                <div class="form-section-bg p-4 rounded text-light">
                    <p class="fw-semibold text-light mb-3">
                        <i class="bi bi-geo-fill text-warning me-2"></i>Notre Localisation
                    </p>
                    <div class="section-divider"></div>

                    <div class="ratio ratio-16x9 rounded overflow-hidden">
                        <iframe src="https://www.google.com/maps?q=Harfleur,France&output=embed" style="border:0;"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <?php include_once('../../templates/footer.php'); ?>
</div>