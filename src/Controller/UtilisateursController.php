<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once '../Model/model-utilisateur.php';

$utilisateurs = Utilisateur::getAll();

include_once '../View/view_utilisateurs.php';
