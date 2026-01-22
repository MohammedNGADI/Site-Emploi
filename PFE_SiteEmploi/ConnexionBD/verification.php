<?php
    if (!isset($_SESSION['id_candidat'])) {
        // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
        header("Location: ../login");
        exit();
    }
?>