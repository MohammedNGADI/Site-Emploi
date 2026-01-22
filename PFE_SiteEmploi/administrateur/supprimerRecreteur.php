<?php include('../ConnexionBD/connexion.php');

if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

$idRecreteur = $_GET['idRecreteur'];
$query = "SELECT nom FROM entreprise WHERE id_entreprise = ?";
$stmt = $connexion->prepare($query);
if (!$stmt) {
    die('Erreur lors de la préparation de la requête : ' . $connexion->error);
}
$stmt->bind_param("i", $idRecreteur);
$stmt->execute();
$result = $stmt->get_result();
$ligne = $result->fetch_assoc();
$nomDossier = "../EntLogo/".$ligne['nom']."/";

// Fonction pour supprimer récursivement un dossier et son contenu
function supprimerDossier($dossier) {
    // Ouvrir le dossier
    $contenu = scandir($dossier);
    // Parcourir les éléments du dossier
    foreach ($contenu as $element) {
        // Ignorer les éléments . et ..
        if ($element != "." && $element != "..") {
            // Construire le chemin complet de l'élément
            $chemin = $dossier . "/" . $element;
            // Si c'est un fichier, le supprimer
            if (is_file($chemin)) {
                unlink($chemin);
            }
            // Si c'est un dossier, appeler récursivement cette fonction
            elseif (is_dir($chemin)) {
                supprimerDossier($chemin);
            }
        }
    }
    // Supprimer le dossier lui-même une fois que son contenu est vidé
    rmdir($dossier);
}

// Vérifier si le dossier existe
if (is_dir($nomDossier)) {
    // Appeler la fonction de suppression récursive
    supprimerDossier($nomDossier);
} 


$query = "DELETE FROM entreprise WHERE id_entreprise = ?";
$stmt = $connexion->prepare($query);

if (!$stmt) {
    die('Error in query preparation: ' . $connexion->error);
}

$stmt->bind_param("i", $idRecreteur);
$stmt->execute();

$stmt->close();
$connexion->close();

// Respond with JSON
$response = array(
    "reponse" => "estSupprimer"
);
echo json_encode($response);
?>