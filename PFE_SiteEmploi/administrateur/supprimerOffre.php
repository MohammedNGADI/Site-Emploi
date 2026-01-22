<?php include('../ConnexionBD/connexion.php');

if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

$idOffre = $_GET['idOffre'];

$query = "DELETE FROM offreemploi WHERE id_offre = ?";
$stmt = $connexion->prepare($query);

if (!$stmt) {
    die('Error in query preparation: ' . $connexion->error);
}

$stmt->bind_param("i", $idOffre);
$stmt->execute();

$stmt->close();
$connexion->close();

// Respond with JSON
$response = array(
    "reponse" => "estSupprimer"
);
echo json_encode($response);
?>