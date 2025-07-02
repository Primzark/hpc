<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-evenement.php';


$evenements = Evenement::getAll();

include_once __DIR__ . '/../View/view_evenements.php';
