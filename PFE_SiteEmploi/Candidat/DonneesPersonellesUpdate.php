<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        session_start();
        $id_candidat = $_SESSION['id_candidat'];

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];

        if(empty($nom) || empty($prenom) || empty($email)){
            echo "Veuillez remplir les champs";
        } else {
            $sqlDonneesPersonnelles = "UPDATE candidat SET nom = '$nom', prenom = '$prenom', email = '$email' WHERE id_candidat = $id_candidat";
                
            if ($connexion->query($sqlDonneesPersonnelles) === TRUE) {
                echo "Modification réussie";
            } else {
                echo "Erreur lors de la mise à jour des données personnelles : " . $connexion->error;
            }
        }
        
        $connexion->close();
    }
?>
