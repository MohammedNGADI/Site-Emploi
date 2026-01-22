<?php
session_start();

include '../connexionBD/connexion.php';

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$object = $_POST['object'];
$message = $_POST['message'];

if (!empty($fullname) && !empty($email) && !empty($object) && !empty($message)) {
    $message = mysqli_real_escape_string($connexion, $message);
    $object = mysqli_real_escape_string($connexion, $object);
    $sql = "INSERT INTO messages (nomComplet, adresseEmail, object, message) VALUES ('$fullname', '$email', '$object', '$message')";
 
    if (mysqli_query($connexion, $sql)) {
        $_SESSION['success_message'] = "Votre message est envoyé  avec succée.";
        header('location: cantactez_nous.php');
        exit; 
    } else {
        $_SESSION['success_message'] = mysqli_error($connexion) ;  
    }
} else {
    $_SESSION['success_message'] = "Veuillez remplir tous les champs du formulaire." ;
}


$connexion->close();
?>
