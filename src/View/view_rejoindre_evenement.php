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

                <!-- Page Title -->
                <p class="display-6 fw-bold text-light mb-3">Rejoindre l’évènement</p>
                <p class="fw-semibold custom-text mb-4">Inscription au tournoi</p>

                <!-- Form -->
                <div class="form-section-bg p-4 rounded text-light">
                    <form action="?page=valider_rejoindre_evenement" method="post">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label fw-semibold text-warning">Nom</label>
                                <input type="text" class="form-control custom-bg" id="nom" name="nom"
                                    placeholder="Entrez votre nom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label fw-semibold text-warning">Prénom</label>
                                <input type="text" class="form-control custom-bg" id="prenom" name="prenom"
                                    placeholder="Entrez votre prénom" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-warning">Adresse e-mail</label>
                            <input type="email" class="form-control custom-bg" id="email" name="email"
                                placeholder="Entrez votre e-mail" required>
                        </div>

                        <div class="mb-4">
                            <label for="commentaires" class="form-label fw-semibold text-warning">Commentaires
                                (optionnel)</label>
                            <textarea class="form-control custom-bg" id="commentaires" name="commentaires" rows="4"
                                placeholder="Ajoutez des commentaires si nécessaire"></textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-warning btn-rounded w-100 fw-semibold">
                                    <i class="bi bi-check2-circle me-2"></i>Confirmer l’inscription
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="/Poker_website/src/Controller/RejoindreController.php"
                                    class="btn btn-outline-warning btn-rounded w-100 d-flex align-items-center justify-content-center fw-semibold">
                                    <i class="bi bi-arrow-left me-2"></i>Retour
                                </a>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
        <?php include_once('../../templates/footer.php'); ?>
    </main>
</div>