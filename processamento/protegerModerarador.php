<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_moderador'])) {
    header("Location: loginModerador.php");
    exit;
}