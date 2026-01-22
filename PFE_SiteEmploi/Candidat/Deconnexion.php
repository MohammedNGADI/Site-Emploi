<?php
    session_start();
    $_SESSION = array();
    session_destroy();
    header('Location: ../INDEX.php');
    exit(); // Assurez-vous de terminer le script après la redirection
?>
