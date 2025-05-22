<?php
session_start();
session_unset();
session_destroy();
header('Location: /Poker_website/public/index.php');
exit;
