<?php
if (isset($_GET['id']))
{
    session_start();
    $_SESSION['idOffreAfficher'] = $_GET['id'];
    $_SESSION['supprimerSession'] = "no" ;
    header('location:listeOffres2.php');
}
else{
    header('location:listeOffres2.php');
}
?>