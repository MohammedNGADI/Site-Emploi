<?php
// Démarrez la session
session_start();

// Démarrez la session "recreteur"
$_SESSION['recreteur'] = true;

// Réponse JSON (vous pouvez personnaliser selon vos besoins)
echo json_encode(['reponse' => 'Session recreteur démarrée avec succès.']);
?>
