<?php
include('../ConnexionBD/connexion.php');
$id = 3;
$query = "SELECT image FROM administrateurs WHERE idAdmine = ?";
    $stmt = $connexion->prepare($query);
    if (!$stmt) {
        die('Erreur lors de la préparation de la requête : ' . $connexion->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Vérifier s'il y a des résultats
    if ($result->num_rows > 0) {
        $ligne = $result->fetch_assoc();
        $imagePath = $ligne['image'];    
        // Vérifier si le chemin de l'image existe et n'est pas le chemin par défaut
        if (is_file($imagePath) && $imagePath != "../candidatPhotoProfil/user-profile-man.jpg") {
            if (unlink($imagePath)) {
                echo "image supprimer";
                
            } else {
                echo "Erreur lors de la suppression du fichier image.";
            }
        }  else {
            echo "Le fichier image n'existe pas ou utilise le chemin par défaut.";
        }
    } else {
        echo "Aucun résultat trouvé pour cet identifiant d'administrateur.";
    }
    
?>
