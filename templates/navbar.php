<nav class="navbar navbar-expand-lg navbar-dark custom-bg px-4 py-3 sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="../../src/Controller/IndexController.php">
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
                        <a class="nav-link text-warning fw-semibold text-nowrap"
                            href="/src/Controller/DeconnexionConfirmController.php">Se déconnecter</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link text-warning fw-semibold" href="/src/Controller/ConnexionController.php">Se
                            connecter</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link text-white text-nowrap"
                        href="../../src/Controller/IndexController.php">Accueil</a>
                </li>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Admin dropdown visible uniquement si connecté -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-warning text-nowrap" href="#" id="adminDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu custom-bg border-0 m-0 p-0" aria-labelledby="adminDropdown">
                            <li>
                            <a class="dropdown-item text-white py-3 px-4"
                                    href="/src/Controller/AjouterEvenementController.php">Ajouter un évènement</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-white py-3 px-4" href="/src/Controller/AjouterTrombinoscopeController.php">Ajouter trombinoscope</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-white py-3 px-4"
                                    href="/src/Controller/EvenementsController.php">Evènements</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-white py-3 px-4"
                                    href="/src/Controller/ClassementController.php">Classement</a>
                            </li>
                        </ul>
                    </li>
                <?php else: ?>
                    <!-- Classement visible uniquement si pas connecté -->
                    <li class="nav-item">
                        <a class="nav-link text-white text-nowrap"
                            href="/src/Controller/ClassementController.php">Classement</a>
                    </li>

                    <!-- Evènements visible uniquement si pas connecté -->
                    <li class="nav-item">
                        <a class="nav-link text-white text-nowrap"
                            href="/src/Controller/EvenementsController.php">Evènements</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link text-white text-nowrap" href="/src/Controller/RegleController.php">Règles du
                        poker</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white text-nowrap"
                        href="/src/Controller/PartenaireController.php">Partenaires</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white text-nowrap" href="#" id="contactDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Nous contacter
                    </a>
                    <ul class="dropdown-menu custom-bg border-0 m-0 p-0" aria-labelledby="contactDropdown">
                        <li>
                            <a class="dropdown-item text-white py-3 px-4"
                                href="/src/Controller/ContactController.php">Contact</a>
                        </li>
                        <li>
                            <a class="dropdown-item text-white py-3 px-4"
                                href="/src/Controller/TrombinoscopeController.php">Trombinoscope</a>
                        </li>
                        <li>
                            <a class="dropdown-item text-white py-3 px-4" href="/src/Controller/UtilisateursController.php">Membres inscrits</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white text-nowrap" href="/src/Controller/ProposController.php">À propos</a>
                </li>

            </ul>
        </div>
    </div>
</nav>