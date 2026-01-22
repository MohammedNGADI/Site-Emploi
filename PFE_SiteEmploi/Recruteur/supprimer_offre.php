<?php
include '../ConnexionBD/connexion.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['offreID']) && !empty($_POST['offreID'])) {
        $offreID = $_POST['offreID'];

        $sql = "DELETE FROM offreemploi WHERE id_offre = $offreID";

        if ($connexion->query($sql) === TRUE) {
            $sql_update = "SET @count = 0";
            $connexion->query($sql_update);
            $sql_update = "UPDATE offreemploi SET id_offre = @count:= @count + 1";
            $connexion->query($sql_update);
            $sql_update = "ALTER TABLE offreemploi AUTO_INCREMENT = 1";
            $connexion->query($sql_update);
            echo "L'offre d'emploi a été supprimée avec succès.";
        } else {
            echo "Erreur lors de la suppression de l'offre d'emploi : " . $connexion->error;
        }
    } else {
        echo "ID de l'offre d'emploi non spécifié.";
    }
} else {
    echo "Méthode non autorisée.";
}

$connexion->close();
?>
