<?php include_once(__DIR__ . '/../../templates/head.php'); ?>
<?php include_once(__DIR__ . '/../../templates/navbar.php'); ?>


<div class="custom-bg min-vh-100 py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">

                <!-- Titre de la page -->
                <p class="display-6 fw-bold text-light mb-4">Règles du poker</p>

                <!-- Section de contenu -->
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

                    <!-- Combinaisons -->
                    <p class="fw-bold mb-2">Voici les meilleures combinaisons de cartes, de la plus forte à la moins
                        forte :</p>
                    <ul class="custom-text mb-4">
                        <li>Quinte Flush Royale : 5 cartes qui se suivent (10, Valet, Dame, Roi, As) de la même couleur
                            (par exemple, tous des cœurs).</li>
                        <li>Carré : 4 cartes identiques (par exemple, quatre 7).</li>
                    </ul>

                    <!-- Termes importants -->
                    <p class="fw-bold mb-2">Quelques mots importants à connaître :</p>
                    <ul class="custom-text mb-0">
                        <li>Blinds : Ce sont des mises que certains joueurs doivent mettre avant de commencer, pour
                            qu’il y ait de l’argent à gagner.</li>
                        <li>Flop : Les 3 premières cartes posées au milieu pour tout le monde.</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <?php include_once(__DIR__ . '/../../templates/VisualFooter.php'); ?>
    <?php include_once(__DIR__ . '/../../templates/footer.php'); ?>
</div>