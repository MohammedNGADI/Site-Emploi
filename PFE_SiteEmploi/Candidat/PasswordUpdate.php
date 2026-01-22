<?php
session_start();
include('../ConnexionBD/connexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_candidat = $_SESSION['id_candidat'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    
    // Vérifier si l'ancien mot de passe est correct
    $sqlCheckPassword = "SELECT mot_De_Passe FROM candidat WHERE id_candidat = $id_candidat";
    $resultCheckPassword = $connexion->query($sqlCheckPassword);

    if ($resultCheckPassword->num_rows > 0) {
        $rowCheckPassword = $resultCheckPassword->fetch_assoc();
        $storedPassword = $rowCheckPassword['mot_De_Passe'];
        
        // Vérifier si l'ancien mot de passe correspond au mot de passe stocké
        if (password_verify($oldPassword,$storedPassword)) {
            // Mettre à jour le mot de passe
            $newPassword = password_hash($newPassword,PASSWORD_BCRYPT,array('const'=>11));
            $sqlUpdatePassword = "UPDATE candidat SET mot_De_Passe = '$newPassword' WHERE id_candidat = $id_candidat";

            if ($connexion->query($sqlUpdatePassword) === TRUE) {
                echo "success"; // Succès
            } else {
                echo "Erreur lors de la mise à jour du mot de passe : " . $connexion->error;
            }
        } else {
            echo "old_password_incorrect"; // Ancien mot de passe incorrect
        }
    } else {
        echo "Erreur : Impossible de trouver l'utilisateur";
    }

    $connexion->close();
}
?>
