<?php include('../ConnexionBD/connexion.php');

if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

$idMessage = $_GET['idMessage'];

$query = "DELETE FROM messages WHERE idMessages = ?";
$stmt = $connexion->prepare($query);

if (!$stmt) {
    die('Error in query preparation: ' . $connexion->error);
}

$stmt->bind_param("i", $idMessage);
$stmt->execute();

$stmt->close();
$connexion->close();

// Respond with JSON
$response = array(
    "reponse" => "estSupprimer"
);
echo json_encode($response);
?>