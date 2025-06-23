<?php
session_start();
require_once __DIR__ . '/../../config.php';
require_once '../Model/model-trombinoscope.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Controller/IndexController.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: ../Controller/IndexController.php');
    exit;
}

$id_tro = (int) $_GET['id'];

$member = Trombinoscope::getById($id_tro);
if (!$member) {
    header('Location: ../Controller/TrombinoscopeController.php');
    exit;
}

if (!empty($member['tro_image'])) {
    $imagePath = '../../asset/img/' . $member['tro_image'];
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }
}

Trombinoscope::delete($id_tro);

header('Location: ../Controller/TrombinoscopeController.php');
exit;
?>
