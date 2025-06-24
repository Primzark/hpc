<nav class="navbar navbar-expand-lg navbar-dark custom-bg px-4 py-3 sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="/">
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
                        <a class="nav-link text-warning fw-semibold text-nowrap" href="/deconnexion/confirm">Se
                            déconnecter</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link text-warning fw-semibold" href="/connexion">Se
                            connecter</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link text-white text-nowrap" href="/">Accueil</a>
                </li>

                <?php if (isset($_SESSION['user_id']) && isset($_SESSION['user_admin']) && $_SESSION['user_admin'] == 1): ?>
                    <!-- Admin dropdown visible uniquement pour l'admin -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-warning text-nowrap" href="#" id="adminDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu custom-bg border-0 m-0 p-0" aria-labelledby="adminDropdown">
                            <li>
                                <a class="dropdown-item text-white py-3 px-4" href="/evenements">Evènements</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-white py-3 px-4" href="/classement">Classement</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-white py-3 px-4" href="/trombinoscope">Trombinoscope</a>
                            </li>
                        </ul>
                    </li>

                    <!-- Lien direct vers Liste des membres -->
                    <li class="nav-item">
                        <a class="nav-link text-white text-nowrap" href="/utilisateurs">Liste
                            des membres</a>
                    </li>
                <?php else: ?>
                    <!-- Classement visible uniquement si pas connecté -->
                    <li class="nav-item">
                        <a class="nav-link text-white text-nowrap" href="/classement">Classement</a>
                    </li>

                    <!-- Evènements visible uniquement si pas connecté -->
                    <li class="nav-item">
                        <a class="nav-link text-white text-nowrap" href="/evenements">Evènements</a>
                    </li>

                    <!-- Membres inscrits avec trombinoscope en dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white text-nowrap" href="#" id="membresDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Membres inscrits
                        </a>
                        <ul class="dropdown-menu custom-bg border-0 m-0 p-0" aria-labelledby="membresDropdown">
                            <li>
                                <a class="dropdown-item text-white py-3 px-4" href="/utilisateurs">Liste des membres</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-white py-3 px-4" href="/trombinoscope">Trombinoscope</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link text-white text-nowrap" href="/regles">Règles du
                        poker</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white text-nowrap" href="/partenaires">Partenaires</a>
                </li>

                <!-- Lien direct vers Contact -->
                <li class="nav-item">
                    <a class="nav-link text-white text-nowrap" href="/contact">Contact</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white text-nowrap" href="/propos">À propos</a>
                </li>

            </ul>
        </div>
    </div>
</nav>