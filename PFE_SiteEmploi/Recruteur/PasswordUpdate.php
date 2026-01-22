<?php
include '../ConnexionBD/connexion.php';
session_start();

if(isset($_SESSION['id_entreprise'])) {
    $id_entreprise = $_SESSION['id_entreprise'];
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];
        $newPasswordConfirm = $_POST['newPasswordConfirm'];

        // Vérifier l'ancien mot de passe
        $sqlVerifierMotDePasse = "SELECT motDePasse FROM entreprise WHERE id_entreprise = ?";
        $stmtMotDePasse = $connexion->prepare($sqlVerifierMotDePasse);
        $stmtMotDePasse->bind_param("i", $id_entreprise);
        $stmtMotDePasse->execute();
        $resultMotDePasse = $stmtMotDePasse->get_result();
        
        if ($resultMotDePasse->num_rows == 1) {
            $row = $resultMotDePasse->fetch_assoc();
            $motDePasseBDD = $row['motDePasse'];
            
            if (password_verify($oldPassword, $motDePasseBDD)) {
                if ($newPassword === $newPasswordConfirm) {
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    
                    $reqUpdatePassword = "UPDATE entreprise SET motDePasse = ? WHERE id_entreprise = ?";
                    $stmtUpdatePassword = $connexion->prepare($reqUpdatePassword);
                    $stmtUpdatePassword->bind_param("si", $hashedPassword, $id_entreprise);
                    $stmtUpdatePassword->execute();
                    
                    echo "success";
                } else {
                    echo "Les nouveaux mots de passe ne correspondent pas.";
                }
            } else {
                echo "L'ancien mot de passe est incorrect.";
            }
        } else {
            echo "Erreur lors de la vérification de l'ancien mot de passe.";
        }
    }
}

// Fermer la connexion à la base de données
$connexion->close();
?>
