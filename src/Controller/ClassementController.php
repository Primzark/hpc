<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-classement.php';

$classement = Classement::getAll();

include_once __DIR__ . '/../View/view_classement.php';
