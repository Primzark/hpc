<?php if (!empty($showPartners)): ?>
    <div class="py-4">
        <div class="container">
            <p class="text-center text-warning fw-semibold mb-3">Nos partenaires</p>
            <div class="row justify-content-center g-3">
                <div class="col-4 col-sm-3 col-md-2">
                    <img src="/asset/img/Logo-POKERSTARS.png" alt="PokerStars" class="img-fluid partner-circle">
                </div>
                <div class="col-4 col-sm-3 col-md-2">
                    <img src="/asset/img/namur_casino.png" alt="Circus Casino Namur"
                        class="img-fluid partner-circle">
                </div>
                <div class="col-4 col-sm-3 col-md-2">
                    <img src="/asset/img/logo-pasino-havre.png" alt="Pasino Le Havre"
                        class="img-fluid partner-circle">
                </div>
                <div class="col-4 col-sm-3 col-md-2">
                    <img src="/asset/img/confo.png" alt="Conforama" class="img-fluid partner-circle">
                </div>
                <div class="col-4 col-sm-3 col-md-2">
                    <img src="/asset/img/auto-ecole.jpeg" alt="Auto-école d’Ingouville"
                        class="img-fluid partner-circle">
                </div>
                <div class="col-4 col-sm-3 col-md-2">
                    <img src="/asset/img/caval_brod.jpg" alt="Caval Brod" class="img-fluid partner-circle">
                </div>
                <div class="col-4 col-sm-3 col-md-2">
                    <img src="/asset/img/dfds.png" alt="DFDS" class="img-fluid partner-circle">
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<footer class="custom-bg text-light mt-5 py-4">
    <div class="container text-center">
        <p class="mb-1 custom-text"> Harfleur Poker Club. Tous droits réservés.</p>
        <ul class="list-inline mb-0">
            <li class="list-inline-item">
                <a href="/src/Controller/ProposController.php" class="text-decoration-none login-hint">À
                    propos</a>
            </li>
            <li class="list-inline-item">
                <a href="/src/Controller/ContactController.php" class="text-decoration-none login-hint">Contact</a>
            </li>
            <li class="list-inline-item">
                <a href="/src/Controller/RegleController.php" class="text-decoration-none login-hint">Règles</a>
            </li>
        </ul>
    </div>
</footer>