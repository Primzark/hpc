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
                        href="/Poker_website/src/Controller/ClassementController.php">Classement</a></li>
                <li class="nav-item"><a class="nav-link text-white"
                        href="/Poker_website/src/Controller/RegleController.php">Règles du poker</a></li>
                <li class="nav-item"><a class="nav-link text-white"
                        href="/Poker_website/src/Controller/PartenaireController.php">Partenaires</a></li>
                <li class="nav-item"><a class="nav-link text-white"
                        href="/Poker_website/src/Controller/AjouterEvenementController.php">Ajouter un évènement</a>
                </li>
                <li class="nav-item"><a class="nav-link text-white"
                        href="/Poker_website/src/Controller/EvenementsController.php">Liste des évènements</a></li>
                <li class="nav-item"><a class="nav-link text-white"
                        href="/Poker_website/src/Controller/ProposController.php">À propos</a></li>
                <li class="nav-item"><a class="nav-link text-white"
                        href="/Poker_website/src/Controller/ContactController.php">Nous contacter</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="custom-bg min-vh-100 py-5">
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">

                <!-- Page Title -->
                <p class="display-6 fw-bold text-light mb-4">Évènements</p>

                <?php if (empty($evenements)): ?>
                    <p class="text-light">Aucun évènement à afficher pour le moment.</p>
                <?php else: ?>
                    <?php foreach ($evenements as $evenement): ?>
                        <div class="form-section-bg p-3 rounded text-light mb-4">
                            <div class="row">
                                <div class="col-md-10">
                                    <p class="mb-1 custom-text small"><?= date('d/m/Y', strtotime($evenement['eve_date'])) ?>
                                    </p>
                                    <p class="mb-1 fw-bold"><?= htmlspecialchars($evenement['eve_titre']) ?></p>
                                    <p class="mb-0 text-light"><?= nl2br(htmlspecialchars($evenement['eve_description'])) ?></p>
                                </div>
                                <div class="col-md-2 d-flex align-items-center justify-content-end">
                                    <a href="/Poker_website/src/Controller/PageEvenementController.php?id=<?= $evenement['id_eve'] ?>"
                                        class="btn btn-warning btn-rounded fw-semibold">En savoir plus</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <div class="mt-4">
                    <a href="/Poker_website/src/Controller/AjouterEvenementController.php"
                        class="btn btn-warning btn-rounded w-100 fw-semibold">
                        <i class="bi bi-plus-lg me-2"></i> Ajouter un évènement
                    </a>
                </div>

            </div>
        </div>
    </main>
    <?php include_once('../../templates/footer.php'); ?>
</div>