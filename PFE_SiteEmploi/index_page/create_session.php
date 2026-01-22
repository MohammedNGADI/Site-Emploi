<?php
session_start();

// Vérifie si des données sont reçues via POST
if (isset($_POST['id'])) {
    // Stocke l'ID de l'offre dans la session
    $_SESSION['idOffreAfficher'] = $_POST['id'];
    $response = array(
        "reponse" => "estSupprimer"
    );
} else {
    // Ajoute un message de débogage si aucune donnée n'est reçue
    $response = array(
        "reponse" => "non"
    );
}

// Envoyer la réponse JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
