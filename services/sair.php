<?php 

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    session_unset();

    header('Location: login.php');
    exit;

?>