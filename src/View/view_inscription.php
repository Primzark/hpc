<?php include_once '../../templates/head.php'; ?>

<div class="custom-bg min-vh-100 d-flex align-items-center">
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">

                <!-- HPC Logo -->
                <div class="text-center mb-4">
                    <img src="/Poker_website/asset/img/Harfleur_poker_logo.png" alt="Harfleur Poker Club Logo"
                        class="img-fluid" style="max-height: 100px;">
                </div>

                <!-- Title -->
                <p class="display-6 fw-bold text-center mb-4 text-light">Créer un compte</p>

                <!-- Form Container -->
                <div class="form-section-bg p-4 rounded text-light">

                    <!-- Display Errors -->
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="/Poker_website/src/Controller/UtilisateurInscriptionController.php" method="post">
                        <div class="mb-3">
                            <label for="pseudo" class="form-label fw-semibold custom-text">Nom d'utilisateur</label>
                            <input type="text" class="form-control custom-bg" id="pseudo" name="pseudo"
                                placeholder="Entrez votre nom d'utilisateur"
                                value="<?= htmlspecialchars($_POST['pseudo'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold custom-text">Adresse email</label>
                            <input type="email" class="form-control custom-bg" id="email" name="email"
                                placeholder="Entrer votre mail" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold custom-text">Mot de passe</label>
                            <input type="password" class="form-control custom-bg" id="password" name="password"
                                placeholder="Entrer votre mot de passe" required>
                        </div>

                        <div class="mb-4">
                            <label for="confirm_password" class="form-label fw-semibold custom-text">Confirmer le mot de
                                passe</label>
                            <input type="password" class="form-control custom-bg" id="confirm_password"
                                name="confirm_password" placeholder="Confirmer mot de passe" required>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-warning">S'inscrire</button>
                        </div>

                        <p class="text-center login-hint small">
                            Déjà un compte ? <a
                                href="/Poker_website/src/Controller/ConnexionController.php">Connectez-vous ici</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>