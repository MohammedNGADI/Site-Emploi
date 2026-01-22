<?php
include('../ConnexionBD/connexion.php') ;  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $id_candidat = $_SESSION['id_candidat'];
    
    // Traitement des coordonnées
    $Mn_Telephone = $_POST['Mn_Telephone'];
    $Mville = $_POST['Mville'];
    $Madresse = $_POST['Madresse'];
    $Mposte = $_POST['Mposte'];
    $MdateNaissnace = $_POST['MdateNaissnace'];
    $sqlCoordonnees = "UPDATE candidat SET dateNaissance = '$MdateNaissnace',
                             n_Telephone = '$Mn_Telephone', ville = '$Mville', adresse = '$Madresse', poste = '$Mposte' WHERE id_candidat = $id_candidat";
            
    if ($connexion->query($sqlCoordonnees) === TRUE) {
        // Redirection vers la page CandidatProfil.php
        header('Location: ./CandidatProfil.php');
    } else {
        echo "Erreur lors de la mise à jour des coordonnées : " . $connexion->error;
    }
}
?>
