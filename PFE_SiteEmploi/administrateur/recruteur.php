<?php
include 'enTete.php';
include ('bareDeNavigationGauche.html');
include '../ConnexionBD/connexion.php';
if (isset($_SESSION['id_entreprise'])) {
    $id_entreprise = $_SESSION['id_entreprise'];

    $reqModification = "select * from entreprise where id_entreprise = $id_entreprise";
    $resultatMP = $connexion->query($reqModification);
    if ($resultatMP !== FALSE && $resultatMP->num_rows > 0) {
        $rowMP = $resultatMP->fetch_assoc();
        $Nomentre = $rowMP['nom'];
        $n_tele = $rowMP['n_telephone'];
        $ville = $rowMP['ville'];
        $adresseEnt = $rowMP['adresse'];
        $Description = $rowMP['description'];
        $email = $rowMP['email'];
        $domaine = $rowMP["domaine"];
        $siteweb = $rowMP["site_web"];
        $anneeDeFondation = $rowMP["anneeDeFondation"];
        $logoEntre = $rowMP["logo"];
    }
    // la mise à jour de la table :
    
// Initialisation de $FormMotDePasse en fonction de l'action
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../CSS/Recruteur/profilEntreprise.css">
    <link rel="stylesheet" href="../CSS/enTeteCSS.css">
    <title>Profil</title>
</head>

<body>
    <div class="pro">
        <div class="milieuProfil">
            <div class="Entreprise">
                <div class="entrepriseNom">
                    Profil
                </div>
                <div class="InfosEntreprise">
                    <div class="informations">
                        <table>
                            <form action="./modifierProfil.php" method="post" enctype="multipart/form-data">
                                <tr>
                                    <td><b>Logo :</b></td>
                                    <td><img src="<?php echo $logoEntre ?>" alt="Logo de l'entreprise" class="photoEntreprise" style="width: 100px; height: 100px;"></td>
                                </tr>
                                <tr>
                                    <td><b>Entreprise :</b></td>
                                    <td><input type="text" value="<?php echo $Nomentre; ?>" name="entreprise" readonly></td>
                                </tr>
                                <tr>
                                    <td><b>Domaine :</b></td>
                                    <td><input type="text" value="<?php echo $domaine; ?>" name="domaine" readonly></td>
                                </tr>
                                <tr>
                                    <td><b>Téléphone :</b></td>
                                    <td><input type="text" value="<?php echo $n_tele; ?>" name="telephone" readonly></td>
                                </tr>
                                <tr>
                                    <td><b>Ville :</b></td>
                                    <td><input type="text" value="<?php echo $ville; ?>" name="ville" readonly></td>
                                </tr>
                                <tr>
                                    <td><b>Adresse :</b></td>
                                    <td><input type="text" value="<?php echo $adresseEnt; ?>" name="adresse" readonly></td>
                                </tr>
                                <tr>
                                    <td><b>Email :</b></td>
                                    <td><input type="text" value="<?php echo $email; ?>" name="email" readonly></td>
                                </tr>
                                <tr>
                                    <td><b>Site internet :</b></td>
                                    <td><input type="text" value="<?php echo $siteweb; ?>" name="site_internet" readonly></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="description">
                                            <p><b>Description de l'entreprise :</b> <br>
                                                <textarea name="description_entreprise" id="" cols="110" rows="5" readonly><?php echo $Description; ?></textarea>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

   

    <?php include('../footer/footer.php') ;?>
</body>
<?php

?>
</html>
<?php
$connexion->close();
}
?>


