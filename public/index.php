<?php include_once(__DIR__ . '/../templates/head.php'); ?>
<?php include_once(__DIR__ . '/../templates/navbar.php'); ?>

<div class="custom-bg text-white py-5">
    <div class="container">
        <!-- Hero Section -->
        <div class="row mb-5 justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="row g-4 align-items-center">

                    <!-- Image Section -->
                    <div class="col-12 col-md-6">
                        <div class="row">
                            <div class="col-12">
                                <img src="/asset/img/bandeau_du_club.png" alt="Bandeau du club"
                                    class="img-fluid rounded shadow w-100"
                                    style="max-height: 18.75rem; object-fit: cover;">
                            </div>
                        </div>
                    </div>

                    <!-- Text + bouton section -->
                    <div class="col-12 col-md-6 text-center text-md-start">
                        <p class="mb-3 text-warning">
                            Fondé en 2016, HPC est une communauté de passionnés de poker à Harfleur.
                            Rejoignez-nous pour participer à des tournois amateurs.
                        </p>

                        <?php if (isset($_SESSION['user_id'])): ?>
                            <div class="d-flex flex-column align-items-center align-items-md-start">
                                <div class="btn btn-warning fw-bold fs-4 mb-2">
                                    Bienvenue <?php if (isset($utiNom)) {
                                        echo htmlspecialchars($utiNom);
                                    } else {
                                        echo '';
                                    } ?>
                                </div>
                                <a href="/vos-tournois" class="btn btn-outline-warning fw-semibold">Vos prochains tournois</a>
                            </div>
                        <?php else: ?>
                            <a href="/utilisateur/inscription" class="btn btn-warning fw-bold fs-4">
                                S'inscrire au club
                            </a>
                        <?php endif; ?>



                    </div>


                </div>
            </div>
        </div>


        <!-- Section des tournois -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <p class="display-6 fw-semibold">Tournois à venir</p>
            </div>
        </div>

        <div class="row g-3 mb-5">
            <?php if (empty($tournois)): ?>
                <div class="col-12">
                    <p class="text-warning text-center">Aucun tournoi à venir pour le moment.</p>
                </div>
            <?php else: ?>
                <?php foreach ($tournois as $tournoi): ?>
                    <div class="col-12 col-md-4">
                        <div class="p-2 custom-bg rounded h-100">
                            <div class="ratio ratio-16x9 mb-2 rounded overflow-hidden">
                                <img src="/asset/img/<?php echo htmlspecialchars($tournoi['eve_image']); ?>"
                                    class="w-100 h-100 object-fit-cover" alt="Image du tournoi">
                            </div>
                            <p class="text-light fw-semibold small mb-1"><?php echo htmlspecialchars($tournoi['eve_titre']); ?>
                            </p>
                            <p class="custom-text small mb-2">
                                <?php echo date('d/m/Y', strtotime($tournoi['eve_date'])); ?> -
                                <?php echo htmlspecialchars($tournoi['eve_lieu']); ?>
                            </p>
                            <a href="/page-evenement?id=<?php echo $tournoi['id_eve']; ?>"
                                class="btn btn-sm btn-outline-warning w-100">Détails</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Section des actualités -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <p class="display-6 fw-semibold">Actualités</p>
            </div>
        </div>

        <div class="row g-3">
            <?php if (empty($actus)): ?>
                <div class="col-12">
                    <p class="text-warning text-center">Aucune actualité pour le moment.</p>
                </div>
            <?php else: ?>
                <?php foreach ($actus as $actu): ?>
                    <div class="col-12 col-md-4">
                        <div class="p-2 custom-bg rounded h-100">
                            <div class="ratio ratio-16x9 mb-2 rounded overflow-hidden">
                                <img src="/asset/img/<?php echo htmlspecialchars($actu['eve_image']); ?>"
                                    class="w-100 h-100 object-fit-cover" alt="Image de l’actualité">
                            </div>
                            <p class="text-light fw-semibold small mb-1"><?php echo htmlspecialchars($actu['eve_titre']); ?></p>
                            <p class="custom-text small mb-2">
                                <?php echo date('d/m/Y', strtotime($actu['eve_date'])); ?> –
                                <?php echo substr(htmlspecialchars($actu['eve_description']), 0, 20); ?>…
                            </p>
                            <a href="/page-evenement?id=<?php echo $actu['id_eve']; ?>"
                                class="btn btn-sm btn-outline-warning w-100">Lire</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="py-4">
        <div class="container">
            <p class="text-center display-6 fw-semibold mb-3">Nos partenaires</p>
            <div class="row justify-content-center g-3">
                <div class="col-4 col-sm-3 col-md-2">
                    <img src="/asset/img/Winamax.png" alt="Winamax"
                        style="width: 5.625rem; height: 5.625rem; border-radius: 20%; object-fit: cover;">
                </div>
                <div class="col-4 col-sm-3 col-md-2">
                    <img src="/asset/img/namur_casino.png" alt="Circus Casino Namur"
                        style="width: 5.625rem; height: 5.625rem; border-radius: 20%; object-fit: cover;">
                </div>
                <div class="col-4 col-sm-3 col-md-2">
                    <img src="/asset/img/logo-pasino-havre.png" alt="Pasino Le Havre"
                        style="width: 5.625rem; height: 5.625rem; border-radius: 20%; object-fit: cover;">
                </div>
                <div class="col-4 col-sm-3 col-md-2">
                    <img src="/asset/img/confo.png" alt="Conforama"
                        style="width: 5.625rem; height: 5.625rem; border-radius: 20%; object-fit: cover;">
                </div>
                <div class="col-4 col-sm-3 col-md-2">
                    <img src="/asset/img/auto-ecole.jpeg" alt="Auto-école d'Ingouville"
                        style="width: 5.625rem; height: 5.625rem; border-radius: 20%; object-fit: cover;">
                </div>
                <div class="col-4 col-sm-3 col-md-2">
                    <img src="/asset/img/cavalbrod.jpg" alt="Caval Brod"
                        style="width: 5.625rem; height: 5.625rem; border-radius: 20%; object-fit: cover;">
                </div>
                <div class="col-4 col-sm-3 col-md-2">
                    <img src="/asset/img/dfds.png" alt="DFDS"
                        style="width: 5.625rem; height: 5.625rem; border-radius: 20%; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../templates/VisualFooter.php'); ?>
    <?php include_once(__DIR__ . '/../templates/footer.php'); ?>
</div>