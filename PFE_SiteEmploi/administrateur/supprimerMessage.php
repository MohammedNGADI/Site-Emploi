<?php include('../ConnexionBD/connexion.php');

if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

$condition = $_GET['Condition'];

$query = "DELETE FROM messages ".$condition ;
$stmt = $connexion->prepare($query);

if (!$stmt) {
    die('Error in query preparation: ' . $connexion->error);
}

$stmt->execute();

$nombreDeLignesSupprimees = $stmt->affected_rows;

$stmt->close();
$connexion->close();

// Respond with JSON
$response = array(
    "reponse" => "estSupprimer" ,
    "nbSupprimer" => $nombreDeLignesSupprimees
);
echo json_encode($response);
?>