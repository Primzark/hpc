<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_admin']) || $_SESSION['user_admin'] != 1) {
    header('Location: /');
    exit;
}
?>