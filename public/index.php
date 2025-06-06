<?php include_once('../../templates/head.php'); ?>
<?php include_once('../../templates/navbar.php'); ?>

<div class="custom-bg text-white py-5">
    <div class="container">
        <!-- Hero Section -->
        <div class="row mb-5 justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="row align-items-center">
                    <div class="col-md-7 text-center text-md-start mb-4 mb-md-0 pe-md-4 hero-text-bg">
                        <div class="d-flex justify-content-center justify-content-md-start">
                            <a href="/src/Controller/UtilisateurInscriptionController.php"
                                class="btn btn-warning">Rejoindre le club</a>
                        </div>
                    </div>
                    <div class="col-md-5 ps-md-4 border-start border-3 border-warning">
                        <div class="p-3">
                            <p class="mb-0 text-warning">
                                Fondé en 2016, HPC est une communauté de passionnés de poker à Harfleur.
                                Rejoignez-nous pour participer à des tournois amateurs dans une ambiance conviviale.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tournaments Section -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <p class="display-6 fw-semibold">Tournois à venir</p>
            </div>
        </div>

        <div class="row g-3 mb-5">
            <?php foreach ($tournois as $tournoi): ?>
                <div class="col-12 col-md-4">
                    <div class="p-2 custom-bg rounded h-100">
                        <div class="ratio ratio-16x9 mb-2 rounded overflow-hidden">
                            <img src="/asset/img/<?= htmlspecialchars($tournoi['eve_image']) ?>"
                                class="w-100 h-100 object-fit-cover" alt="Image du tournoi">
                        </div>
                        <p class="text-light fw-semibold small mb-1"><?= htmlspecialchars($tournoi['eve_titre']) ?></p>
                        <p class="custom-text small mb-2">
                            <?= date('d/m/Y', strtotime($tournoi['eve_date'])) ?> -
                            <?= htmlspecialchars($tournoi['eve_lieu']) ?>
                        </p>
                        <a href="/src/Controller/PageEvenementController.php?id=<?= $tournoi['id_eve'] ?>"
                            class="btn btn-sm btn-outline-warning w-100">Détails</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- News Section -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <p class="display-6 fw-semibold">Actualités</p>
            </div>
        </div>

        <div class="row g-3">
            <?php foreach ($actus as $actu): ?>
                <div class="col-12 col-md-4">
                    <div class="p-2 custom-bg rounded h-100">
                        <div class="ratio ratio-16x9 mb-2 rounded overflow-hidden">
                            <img src="/asset/img/<?= htmlspecialchars($actu['eve_image']) ?>"
                                class="w-100 h-100 object-fit-cover" alt="Image de l’actualité">
                        </div>
                        <p class="text-light fw-semibold small mb-1"><?= htmlspecialchars($actu['eve_titre']) ?></p>
                        <p class="custom-text small mb-2">
                            <?= date('d/m/Y', strtotime($actu['eve_date'])) ?> –
                            <?= substr(htmlspecialchars($actu['eve_description']), 0, 50) ?>…
                        </p>
                        <a href="/src/Controller/PageEvenementController.php?id=<?= $actu['id_eve'] ?>"
                            class="btn btn-sm btn-outline-warning w-100">Lire</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include_once('../../templates/VisualFooter.php'); ?>
    <?php include_once('../../templates/footer.php'); ?>

</div>