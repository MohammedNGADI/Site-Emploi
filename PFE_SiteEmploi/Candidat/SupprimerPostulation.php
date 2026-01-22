<?php
include '../ConnexionBD/connexion.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['id_offre']) && isset($_SESSION['id_candidat'])) {
        // Récupérez les données de session
        $id_offre = $_SESSION['id_offre'];
        $id_candidat = $_SESSION['id_candidat'];

        // Vérifiez d'abord si la postulation existe
        $sqlVerification = "SELECT * FROM postulation WHERE id_offre = $id_offre AND id_candidat = $id_candidat";
        $resultVerification = mysqli_query($connexion, $sqlVerification);

        if ($resultVerification && mysqli_num_rows($resultVerification) > 0) {
            // La postulation existe, procédez à la suppression
            $sqlDelete = "DELETE FROM postulation WHERE id_offre = $id_offre AND id_candidat = $id_candidat";

            if ($connexion->query($sqlDelete) === TRUE) {
                echo "success";
            } else {
                // Erreur lors de la suppression de la postulation
                echo "Erreur lors de la suppression de la postulation: " . $connexion->error;
            }
        } else {
            // La postulation n'existe pas, renvoyez un message
            echo "dejaSupprimer";
        }
    } else {
        echo "Données manquantes pour la suppression de la postulation";
    }
} else {
    header('Location: ../Login');
}
?>
