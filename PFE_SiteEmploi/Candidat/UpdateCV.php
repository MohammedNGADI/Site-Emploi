<?php
session_start();
include('../ConnexionBD/connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_candidat = $_SESSION['id_candidat'];
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    // Chemin du répertoire pour les CV
    $repertoireCV = '../candidatCV/' . $nom . '_' . $prenom . '/';
    $query = "SELECT CV FROM profil_candidat WHERE id_Candidat = ?";
        $stmt = $connexion->prepare($query);
        if (!$stmt) {
            die('Erreur lors de la préparation de la requête : ' . $connexion->error);
        }
        $stmt->bind_param("i", $id_candidat);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $ligne = $result->fetch_assoc();
            $CVpath = $ligne['CV'];    
            // Vérifier si le chemin de l'image existe et n'est pas le chemin par défaut
            if (is_file($CVpath)) {
                if (unlink($CVpath)) {
                    $parties = explode('/', $CVpath);

                    // Supprimer la dernière partie
                    array_pop($parties);

                    // Regrouper les parties restantes en une chaîne de caractères
                    $repertoireCV = implode('/', $parties);

                    //inserer la nouvelle image
                    $repertoireCV .= '/';
                } else {
                    echo "Erreur lors de la suppression du fichier image.";
                }
            } 
        } 
    // Vérifier si le répertoire existe, sinon le créer
    if (!file_exists($repertoireCV)) {
        mkdir($repertoireCV);
    }

    // Vérifier si un fichier a été téléchargé
    if (!empty($_FILES['CV']['name'])) {
        // Nom du fichier CV
        $nomCV = $_FILES['CV']['name'];

        // Chemin du fichier CV
        $cheminCV = $repertoireCV . $nomCV;

        // Déplacer le fichier téléchargé vers le répertoire des CV
        if (move_uploaded_file($_FILES['CV']['tmp_name'], $cheminCV)) {
            echo "Fichier téléchargé avec succès. ";
            $cheminCV = mysqli_real_escape_string($connexion, $cheminCV);
            // Mettre à jour le chemin du CV dans la base de données
            $sqlUpdateCV = "UPDATE profil_candidat SET CV = '$cheminCV' WHERE id_candidat = $id_candidat";

            if ($connexion->query($sqlUpdateCV) === TRUE) {
                echo "CV mis à jour dans la base de données.";
                echo "success"; 
            } else {
                echo "Erreur lors de la mise à jour du CV : " . $connexion->error;
            }
        } else {
            echo "Erreur lors du téléchargement du CV.";
        }
    } else {
        echo "Veuillez sélectionner un fichier CV.";
    }

    $connexion->close();
}
?>
