<?php
include '../ConnexionBD/connexion.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['id_offre']) && isset($_SESSION['id_candidat'])) {
        // Récupérez les données de session
        $id_offre = $_SESSION['id_offre'];
        $id_candidat = $_SESSION['id_candidat'];

        $sqlVerification = "SELECT * FROM postulation WHERE id_offre = $id_offre AND id_candidat = $id_candidat";
        $resultVerification = mysqli_query($connexion, $sqlVerification);
        if ($resultVerification && mysqli_num_rows($resultVerification) > 0) {
            echo "dejaPostule";
        } else {
            // Sinon, procédez à l'insertion de la postulation
            $sql = "INSERT INTO postulation (id_offre, id_candidat, date_postulation) 
                    VALUES ('$id_offre', '$id_candidat', NOW())";

            // Exécutez la requête d'insertion
            if ($connexion->query($sql) === TRUE) {
                echo "success";
            } else {
                // Sinon, retournez un message d'erreur
                echo "Erreur lors de l'enregistrement de la postulation: " . $connexion->error;
            }
        }
    } else {
        echo "Données manquantes pour l'insertion de la postulation";
    }
} else {
    echo "Méthode non autorisée";
}
?>
