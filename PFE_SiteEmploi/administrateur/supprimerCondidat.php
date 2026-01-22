<?php include('../ConnexionBD/connexion.php');

if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

$idCondidat = $_GET['idCondidat'];
$query = "SELECT nom,prenom FROM candidat WHERE id_candidat = ?";
$stmt = $connexion->prepare($query);
if (!$stmt) {
    die('Erreur lors de la préparation de la requête : ' . $connexion->error);
}
$stmt->bind_param("i", $idCondidat);
$stmt->execute();
$result = $stmt->get_result();
$ligne = $result->fetch_assoc();
$nomDossier = "../candidatCV/".$ligne['nom']."_".$ligne['prenom']."/";
$nomDossier2 = "../candidatPhotoProfil/".$ligne['nom']."_".$ligne['prenom']."/";
function supprimerDossier($dossier) {
    $contenu = scandir($dossier);
    foreach ($contenu as $element) {
        if ($element != "." && $element != "..") {
            $chemin = $dossier . "/" . $element;
            if (is_file($chemin)) {
                unlink($chemin);
            }
            elseif (is_dir($chemin)) {
                supprimerDossier($chemin);
            }
        }
    }
    rmdir($dossier);
}

if (is_dir($nomDossier)) {
    supprimerDossier($nomDossier);
} 
if (is_dir($nomDossier2)) {
    supprimerDossier($nomDossier2);
} 


$query = "DELETE FROM candidat WHERE id_candidat = ?";
$stmt = $connexion->prepare($query);

if (!$stmt) {
    die('Error in query preparation: ' . $connexion->error);
}

$stmt->bind_param("i", $idCondidat);
$stmt->execute();

$stmt->close();
$connexion->close();

$response = array(
    "reponse" => "estSupprimer"
);
echo json_encode($response);
?>