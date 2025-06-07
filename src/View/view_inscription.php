<?php include_once('../../templates/head.php'); ?>

<div class="custom-bg min-vh-100 d-flex align-items-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">

                <!-- HPC Logo -->
                <div class="text-center mb-4">
                    <img src="/asset/img/Harfleur_poker_logo.png" alt="Harfleur Poker Club Logo" class="img-fluid"
                        style="max-height: 100px;">
                </div>

                <!-- Title -->
                <p class="display-6 fw-bold text-center mb-4 text-light">Créer un compte</p>

                <!-- Form Container -->
                <div class="form-section-bg p-4 rounded text-light">
                    <form action="/src/Controller/UtilisateurInscriptionController.php" method="post" novalidate>

                        <!-- Nom -->
                        <div class="mb-3">
                            <label for="nom" class="form-label fw-semibold custom-text">Pseudo joueur</label>
                            <div class="form-text login-hint mb-1">Minimum 4 caractères. Lettres, chiffres, . _ - +
                            </div>
                            <input type="text"
                                class="form-control custom-bg <?= isset($errors['nom']) ? 'is-invalid' : '' ?>" id="nom"
                                name="nom" placeholder="Entrez votre nom d'utilisateur"
                                value="<?= isset($nom) ? htmlspecialchars($nom) : '' ?>">
                            <?php if (isset($errors['nom'])): ?>
                                <div class="invalid-feedback"><?= $errors['nom'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold custom-text">Adresse email</label>
                            <div class="form-text login-hint mb-1">Exemple : nom@domaine.com</div>
                            <input type="email"
                                class="form-control custom-bg <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                                id="email" name="email" placeholder="Entrer votre mail"
                                value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
                            <?php if (isset($errors['email'])): ?>
                                <div class="invalid-feedback"><?= $errors['email'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Mot de passe -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold custom-text">Mot de passe</label>
                            <div class="form-text login-hint mb-1">Minimum 4 caractères. Lettres, chiffres, . @ -</div>
                            <input type="password"
                                class="form-control custom-bg <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                                id="password" name="password" placeholder="Entrer votre mot de passe">
                            <?php if (isset($errors['password'])): ?>
                                <div class="invalid-feedback"><?= $errors['password'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Confirmation mot de passe -->
                        <div class="mb-4">
                            <label for="confirm_password" class="form-label fw-semibold custom-text">Confirmer le mot de
                                passe</label>
                            <input type="password"
                                class="form-control custom-bg <?= isset($errors['confirm_password']) ? 'is-invalid' : '' ?>"
                                id="confirm_password" name="confirm_password" placeholder="Confirmer mot de passe">
                            <?php if (isset($errors['confirm_password'])): ?>
                                <div class="invalid-feedback"><?= $errors['confirm_password'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-warning">S'inscrire</button>
                        </div>

                        <!-- Login Link -->
                        <p class="text-center login-hint small">
                            Déjà un compte ? <a href="/src/Controller/ConnexionController.php">Connectez-vous ici</a>
                        </p>
                    </form>
                </div>

            </div>
        </div>


    </div>
    <?php include_once('../../templates/footer.php'); ?>
</div>