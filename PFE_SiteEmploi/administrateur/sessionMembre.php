<?php
    session_start();
    if(isset($_GET['idCandidat']))
    {
        $id = $_GET['idCandidat'];
        include('../ConnexionBD/connexion.php') ; 
        $sql = "SELECT email FROM candidat WHERE id_candidat = ? ";
        $statement = $connexion->prepare($sql);
        $statement->bind_param("i", $id);
        $statement->execute();
        $result = $statement->get_result();
        $ligne =  $result->fetch_assoc();
        $_SESSION['id_candidat'] = $id ;
        $_SESSION['email'] = $ligne['email'];
        header('Location: ./condidat.php');
    }
    else{
        if(isset($_GET['idRecruteur']))
        {
            $_SESSION['id_entreprise'] = $_GET['idRecruteur'];
            header('Location: ./recruteur.php');
        }
    }
    
?>