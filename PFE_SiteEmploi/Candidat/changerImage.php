<?php
    
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $id_candidat = $_SESSION['id_candidat'];
    $prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];
    include('../ConnexionBD/connexion.php');

    // Vérifie si un fichier a été téléchargé
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
        // Chemin où stocker les images téléchargées
        
        $uploadDirectory = "../candidatPhotoProfil/" . $nom . '_' . $prenom . "/";

        $query = "SELECT photoProfil FROM profil_candidat WHERE id_Candidat = ?";
        $stmt = $connexion->prepare($query);
        if (!$stmt) {
            die('Erreur lors de la préparation de la requête : ' . $connexion->error);
        }
        $stmt->bind_param("i", $id_candidat);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $ligne = $result->fetch_assoc();
            $imagePath = $ligne['photoProfil'];    
            // Vérifier si le chemin de l'image existe et n'est pas le chemin par défaut
            if (is_file($imagePath) && $imagePath != "../candidatPhotoProfil/user-profile-man.jpg") {
                if (unlink($imagePath)) {
                    $parties = explode('/', $imagePath);

                    // Supprimer la dernière partie
                    array_pop($parties);

                    // Regrouper les parties restantes en une chaîne de caractères
                    $uploadDirectory = implode('/', $parties);

                    //inserer la nouvelle image
                    $uploadDirectory .= '/';
                } else {
                    echo "Erreur lors de la suppression du fichier image.";
                }
            } 
        } 
        // Nom du fichier téléchargé
        $fileName = basename($_FILES["photo"]["name"]);
        
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory);
        }

        // Chemin complet pour le fichier téléchargé
        $targetFilePath = $uploadDirectory . $fileName;
        
        // Déplace le fichier téléchargé vers le répertoire d'upload
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath)) {
            // Le fichier a été téléchargé avec succès, vous pouvez insérer son chemin dans la base de données maintenant
            
            // Exemple de connexion à la base de données (veuillez remplacer les paramètres par les vôtres)
            
            
            // Requête d'insertion pour insérer le chemin de l'image dans la base de données
            $sqlProfile = "UPDATE profil_candidat SET photoProfil = '$targetFilePath' WHERE id_candidat = $id_candidat";
            
            if ($connexion->query($sqlProfile) === TRUE) {
                header('Location : ./CandidatProfil.php');
                echo "Image enregistrée dans la base de données avec succès.";
                
            } else {
                echo "Erreur lors de l'insertion dans la base de données: " . $conn->error;
            }
            
            // Ferme la connexion à la base de données
            $connexion->close();
        } else {
            echo "Erreur lors du téléchargement du fichier.";
        }
    } else {
        echo "Aucun fichier téléchargé ou une erreur s'est produite lors du téléchargement.";
    }
} else {
    echo "Erreur: Requête non autorisée.";
}
?>
