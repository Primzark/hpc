<?php
session_start();
require_once '../../config.php';
require_once '../Model/model-trombinoscope.php';

$members = Trombinoscope::getAll();

include_once '../View/view_trombinoscope.php';
?>
