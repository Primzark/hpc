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
                        href="/Poker_website/src/Controller/controller_classement.php">Classement</a>
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

                <!-- Title -->
                <p class="display-6 fw-bold text-light mb-4">Classement</p>

                <!-- Ranking Grid -->
                <div class="form-section-bg p-4 rounded">
                    <div class="row g-0 text-light">
                        <!-- Header Row -->
                        <div class="row border-bottom py-2">
                            <div class="col-2 col-md-1 fw-bold">Rang</div>
                            <div class="col-4 col-md-4 fw-bold">Joueur</div>
                            <div class="col-2 col-md-2 fw-bold">Points</div>
                            <div class="col-2 col-md-3 fw-bold">Tournois joués</div>
                            <div class="col-2 col-md-2 fw-bold">Victoires</div>
                        </div>
                        <!-- Data Rows -->
                        <div class="row border-bottom py-2 custom-text">
                            <div class="col-2 col-md-1">1</div>
                            <div class="col-4 col-md-4">Alexandre Dupont</div>
                            <div class="col-2 col-md-2">1250</div>
                            <div class="col-2 col-md-3">15</div>
                            <div class="col-2 col-md-2">3</div>
                        </div>
                        <div class="row border-bottom py-2 custom-text">
                            <div class="col-2 col-md-1">2</div>
                            <div class="col-4 col-md-4">Sophie Martin</div>
                            <div class="col-2 col-md-2">1100</div>
                            <div class="col-2 col-md-3">14</div>
                            <div class="col-2 col-md-2">2</div>
                        </div>
                        <div class="row border-bottom py-2 custom-text">
                            <div class="col-2 col-md-1">3</div>
                            <div class="col-4 col-md-4">Thomas Leclerc</div>
                            <div class="col-2 col-md-2">950</div>
                            <div class="col-2 col-md-3">12</div>
                            <div class="col-2 col-md-2">1</div>
                        </div>
                        <div class="row border-bottom py-2 custom-text">
                            <div class="col-2 col-md-1">4</div>
                            <div class="col-4 col-md-4">Marie Dubois</div>
                            <div class="col-2 col-md-2">800</div>
                            <div class="col-2 col-md-3">10</div>
                            <div class="col-2 col-md-2">0</div>
                        </div>
                        <div class="row py-2 custom-text">
                            <div class="col-2 col-md-1">5</div>
                            <div class="col-4 col-md-4">Julien Bernard</div>
                            <div class="col-2 col-md-2">700</div>
                            <div class="col-2 col-md-3">9</div>
                            <div class="col-2 col-md-2">0</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <?php include_once('../../templates/footer.php'); ?>
</div>