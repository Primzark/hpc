<?php
require_once 'src/Router.php';

// Front controller : associe les routes aux contrôleurs et les exécute
// Exemple d'ajout de route :
// $router->add('/contact', 'src/Controller/ContactController.php');

$router = new Router();

$router->add('/', 'src/Controller/IndexController.php');
$router->add('/connexion', 'src/Controller/ConnexionController.php');
$router->add('/deconnexion', 'src/Controller/DeconnexionController.php');
$router->add('/deconnexion/confirm', 'src/Controller/DeconnexionConfirmController.php');
$router->add('/evenements', 'src/Controller/EvenementsController.php');
$router->add('/ajouter-evenement', 'src/Controller/AjouterEvenementController.php');
$router->add('/modifier-evenement', 'src/Controller/ModifierEvenementController.php');
$router->add('/supprimer-evenement', 'src/Controller/SupprimerEvenementController.php');
$router->add('/page-evenement', 'src/Controller/PageEvenementController.php');
$router->add('/rejoindre-page', 'src/Controller/RejoindrePageController.php');
$router->add('/utilisateurs', 'src/Controller/UtilisateursController.php');
$router->add('/utilisateur/inscription', 'src/Controller/UtilisateurInscriptionController.php');
$router->add('/inscription/confirm', 'src/Controller/InscriptionConfirmController.php');
$router->add('/supprimer-utilisateur', 'src/Controller/SupprimerUtilisateurController.php');
$router->add('/classement', 'src/Controller/ClassementController.php');
$router->add('/ajouter-classement', 'src/Controller/AjouterClassementController.php');
$router->add('/modifier-classement', 'src/Controller/ModifierClassementController.php');
$router->add('/classement-general', 'src/Controller/ClassementGeneralController.php');
$router->add('/trombinoscope', 'src/Controller/TrombinoscopeController.php');
$router->add('/ajouter-trombinoscope', 'src/Controller/AjouterTrombinoscopeController.php');
$router->add('/supprimer-trombinoscope', 'src/Controller/SupprimerTrombinoscopeController.php');
$router->add('/partenaires', 'src/Controller/PartenaireController.php');
$router->add('/regles', 'src/Controller/RegleController.php');
$router->add('/contact', 'src/Controller/ContactController.php');
$router->add('/propos', 'src/Controller/ProposController.php');
$router->add('/politique', 'src/Controller/PolitiqueController.php');
$router->add('/ajax/rejoindre-evenement', 'src/Controller/ajax_rejoindre_evenement.php');
$router->add('/approve-registration', 'src/Controller/ApproveRegistrationController.php');
$router->add('/reject-registration', 'src/Controller/RejectRegistrationController.php');
$router->add('/forgot-password', 'src/Controller/ForgotPasswordController.php');
$router->add('/reset-password', 'src/Controller/ResetPasswordController.php');
$router->add('/participants-evenement', 'src/Controller/ParticipantsEvenementController.php');

$router->dispatch();
