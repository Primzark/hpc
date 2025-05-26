<?php include_once('../../templates/head.php'); ?>


<div class="custom-bg min-vh-100 d-flex align-items-center">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">

        <!-- HPC Logo -->
        <div class="text-center mb-4">
          <img src="/Poker_website/asset/img/Harfleur_poker_logo.png" alt="Harfleur Poker Club Logo" class="img-fluid"
            style="max-height: 150px;">
        </div>

        <!-- Title -->
        <p class="display-6 fw-bold text-center mb-4 text-light">Se connecter</p>

        <!-- Form Container -->
        <div class="form-section-bg p-4 rounded text-light">
          <form action="/Poker_website/src/Controller/ConnexionController.php" method="post">
            <div class="mb-3">
              <label for="email" class="form-label fw-semibold custom-text">Adresse email</label>
              <input type="email" class="form-control custom-bg" id="email" name="username"
                placeholder="Entrer votre email" required>
            </div>


            <div class="mb-4">
              <label for="password" class="form-label fw-semibold custom-text">Mot de passe</label>
              <input type="password" class="form-control custom-bg" id="password" name="password"
                placeholder="Entrer votre mot de passe" required>
            </div>

            <div class="d-grid mb-3">
              <button type="submit" class="btn btn-warning">Se connecter</button>
            </div>

            <p class="text-center login-hint small">
              Pas encore inscrit ? <a href="/Poker_website/src/Controller/UtilisateurInscriptionController.php">Créer un
                compte</a>
            </p>
          </form>
        </div>

      </div>
    </div>
    <?php include_once('../../templates/VisualFooter.php'); ?>
    <?php include_once('../../templates/footer.php'); ?>
  </div>
</div>