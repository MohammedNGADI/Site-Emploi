<?php
include ('../ConnexionBD/connexion.php');
if (isset($_POST['id']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['adresse']))
{
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];

    $requete = "UPDATE administrateurs SET nom = ? , prenom = ? , adresse = ? WHERE idAdmine = ?";
    if($result = $connexion->prepare($requete))
    {
        $result->bind_param("sssi", $nom, $prenom, $adresse, $id);
        $result->execute();
        $result->close();
        $connexion->close();
        $reponse = array("modifie" => "oui");
        echo json_encode($reponse);
    }
    else{
        $connexion->close();
        $reponse = array("modifie" => $connexion->error);
        echo json_encode($reponse);
    }
}
?>
