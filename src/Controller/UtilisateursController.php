<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-utilisateur.php';

$utilisateurs = Utilisateur::getAll();

include_once __DIR__ . '/../View/view_utilisateurs.php';
