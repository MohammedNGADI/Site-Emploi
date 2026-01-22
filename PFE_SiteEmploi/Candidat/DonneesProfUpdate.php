<?php
    session_start();
    include('../ConnexionBD/connexion.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['formChoisi']) && $_POST['formChoisi'] === "Professionnelles") {
        $id_candidat = $_SESSION['id_candidat'];

        // Récupérer les données du formulaire
        $diplomes = $_POST['Pdiplomes'];
        $experiences = $_POST['Pexperiences'];
        $competences = $_POST['Pcompetences'];
        $langue1 = $_POST['PL1'];
        $langue2 = $_POST['PL2'];
        $langue3 = $_POST['PL3'];

        // Préparer et exécuter la requête SQL pour mettre à jour les données dans la table
        $sql = "UPDATE profil_candidat 
                SET diplomes = '$diplomes', 
                    experience = '$experiences', 
                    competences = '$competences', 
                    langue_1 = '$langue1', 
                    langue_2 = '$langue2', 
                    langue_3 = '$langue3' 
                WHERE id_candidat = $id_candidat";

        if ($connexion->query($sql) === TRUE) {
            echo "Modification des données professionnelles réussie";
        } else {
            echo "Erreur lors de la mise à jour des données professionnelles : " . $connexion->error;
        }
        
        $connexion->close();
    }
?>
