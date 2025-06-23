<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once '../Model/model-classement.php';

$classement = Classement::getAll();

include_once '../View/view_classement.php';
