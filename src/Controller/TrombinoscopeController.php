<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../Model/model-trombinoscope.php';

$members = Trombinoscope::getAll();

include_once __DIR__ . '/../View/view_trombinoscope.php';
?>
