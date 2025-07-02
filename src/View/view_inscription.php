<?php include_once(__DIR__ . '/../../templates/head.php'); ?>

<div class="custom-bg min-vh-100 d-flex align-items-center">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">

                <!-- Logo HPC -->
                <div class="text-center mb-4">
                    <img src="/asset/img/Harfleur_poker_logo.png" alt="Harfleur Poker Club Logo" class="img-fluid"
                        style="max-height: 6.25rem;">
                </div>

                <!-- Titre -->
                <p class="display-6 fw-bold text-center mb-4 text-light">Créer un compte</p>

                <!-- Conteneur du formulaire -->
                <div class="form-section-bg p-4 rounded text-light">
                    <form action="/utilisateur/inscription" method="post" novalidate>

                        <!-- Nom -->
                        <div class="mb-3">
                            <label for="nom" class="form-label fw-semibold custom-text">Pseudo joueur</label>
                            <div class="form-text login-hint mb-1">Minimum 4 caractères. Lettres, chiffres, . _ - +
                            </div>
                            <input type="text"
                                class="form-control custom-bg <?php if (isset($errors['nom'])) { echo 'is-invalid'; } else { echo ''; } ?>" id="nom"
                                name="nom" placeholder="Entrez votre nom d'utilisateur"
                                value="<?php if (isset($nom)) { echo htmlspecialchars($nom); } else { echo ''; } ?>">
                            <?php if (isset($errors['nom'])): ?>
                                <div class="invalid-feedback"><?php echo $errors['nom']; ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- E-mail -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold custom-text">Adresse email</label>
                            <div class="form-text login-hint mb-1">Exemple : nom@domaine.com</div>
                            <input type="email"
                                class="form-control custom-bg <?php if (isset($errors['email'])) { echo 'is-invalid'; } else { echo ''; } ?>"
                                id="email" name="email" placeholder="Entrer votre mail"
                                value="<?php if (isset($email)) { echo htmlspecialchars($email); } else { echo ''; } ?>">
                            <?php if (isset($errors['email'])): ?>
                                <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Âge -->
                        <div class="mb-3">
                            <label for="age" class="form-label fw-semibold custom-text">Âge</label>
                            <div class="form-text login-hint mb-1">Vous devez avoir 18 ans ou plus</div>
                            <input type="number"
                                class="form-control custom-bg <?php if (isset($errors['age'])) { echo 'is-invalid'; } else { echo ''; } ?>" id="age"
                                name="age" min="0" placeholder="Entrez votre âge"
                                value="<?php if (isset($age)) { echo htmlspecialchars($age); } else { echo ''; } ?>">
                            <?php if (isset($errors['age'])): ?>
                                <div class="invalid-feedback"><?php echo $errors['age']; ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Mot de passe -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold custom-text">Mot de passe</label>
                            <div class="form-text login-hint mb-1">Minimum 4 caractères. Lettres, chiffres, . @ -</div>
                            <input type="password"
                                class="form-control custom-bg <?php if (isset($errors['password'])) { echo 'is-invalid'; } else { echo ''; } ?>"
                                id="password" name="password" placeholder="Entrer votre mot de passe">
                            <?php if (isset($errors['password'])): ?>
                                <div class="invalid-feedback"><?php echo $errors['password']; ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Confirmation mot de passe -->
                        <div class="mb-4">
                            <label for="confirm_password" class="form-label fw-semibold custom-text">Confirmer le mot de
                                passe</label>
                            <input type="password"
                                class="form-control custom-bg <?php if (isset($errors['confirm_password'])) { echo 'is-invalid'; } else { echo ''; } ?>"
                                id="confirm_password" name="confirm_password" placeholder="Confirmer mot de passe">
                            <?php if (isset($errors['confirm_password'])): ?>
                                <div class="invalid-feedback"><?php echo $errors['confirm_password']; ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Bouton de validation -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-warning">S'inscrire</button>
                        </div>

                        <!-- Lien de connexion -->
                        <p class="text-center login-hint small">
                            Déjà un compte ? <a href="/connexion">Connectez-vous ici</a>
                        </p>

                        <!-- reCAPTCHA -->
                        <div class="mb-3 mt-4">
                            <div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_SITE_KEY; ?>"></div>
                            <?php if (isset($errors['captcha'])): ?>
                                <div class="invalid-feedback d-block"><?php echo $errors['captcha']; ?></div>
                            <?php endif; ?>
                        </div>

                    </form>
                </div>

            </div>
        </div>


    </div>
    <?php include_once(__DIR__ . '/../../templates/footer.php'); ?>
</div>