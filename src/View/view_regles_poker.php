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
                <p class="display-6 fw-bold text-light mb-4">Règles du poker</p>

                <!-- Content Section -->
                <div class="form-section-bg p-4 rounded text-light">

                    <!-- Texas Hold'em -->
                    <p class="fw-bold mb-1">Texas Hold’em</p>
                    <p class="custom-text mb-4">
                        On te donne 2 cartes rien qu’à toi, et 5 cartes sont posées au milieu pour tout le monde,
                        révélées en 3 étapes.
                        Ton but : faire la meilleure combinaison avec 5 cartes au total. Tu peux miser à chaque étape :
                        avant les cartes du milieu,
                        puis après chaque nouvelle carte.
                    </p>

                    <!-- Omaha -->
                    <p class="fw-bold mb-1">Omaha</p>
                    <p class="custom-text mb-4">
                        On te donne 4 cartes rien qu’à toi, et 5 cartes sont au milieu pour tous, révélées en 3 étapes
                        aussi. Ton but :
                        faire la meilleure combinaison de 5 cartes, mais tu dois utiliser exactement 2 de tes cartes et
                        3 cartes du milieu.
                        Parfois, on joue à une version où celui qui a les cartes les plus faibles peut aussi gagner.
                    </p>

                    <!-- Combinations -->
                    <p class="fw-bold mb-2">Voici les meilleures combinaisons de cartes, de la plus forte à la moins
                        forte :</p>
                    <ul class="custom-text mb-4">
                        <li>Quinte Flush Royale : 5 cartes qui se suivent (10, Valet, Dame, Roi, As) de la même couleur
                            (par exemple, tous des cœurs).</li>
                        <li>Carré : 4 cartes identiques (par exemple, quatre 7).</li>
                    </ul>

                    <!-- Important Terms -->
                    <p class="fw-bold mb-2">Quelques mots importants à connaître :</p>
                    <ul class="custom-text mb-0">
                        <li>Blinds : Ce sont des mises que certains joueurs doivent mettre avant de commencer, pour
                            qu’il y ait de l’argent à gagner.</li>
                        <li>Flop : Les 3 premières cartes posées au milieu pour tout le monde.</li>
                    </ul>

                </div>
            </div>
        </div>
    </main>
    <?php include_once('../../templates/footer.php'); ?>
</div>