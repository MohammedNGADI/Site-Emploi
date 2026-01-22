<?php
    session_start();
    if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $Recuperationemail = "SELECT * FROM entreprise WHERE email = ?";
    $stmtRecuperationemail = $connexion->prepare($Recuperationemail);
    $stmtRecuperationemail->bind_param("s", $email);
    $stmtRecuperationemail->execute();
    $resultRecuperationemail = $stmtRecuperationemail->get_result();
    $rowRecuperationemail = $resultRecuperationemail->fetch_assoc();
    $NomEntreprise = $rowRecuperationemail['id_entreprise'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Recruteur/profilEntreprise.css">
    <link rel="stylesheet" href="../CSS/enTeteCSS.css">
    <link rel="icon" href="../SiteImages/administrateur/logoSiteEmploi2.jpg" type="image/jpg">
    <title>EMPNEXUS-Mon Profil</title>
</head>
<body>
    <?php
        include './enTete.php';
    ?>

    
    <div class="pro">
        <div class="milieuProfil">
            <div class="Entreprise">
                <div class="entrepriseNom">
                    Profil de l'entreprise
                </div>
                <div class="InfosEntreprise">
                    <div class="logoEntreprise">
                        <img src="../SiteImages/logo.jpg" alt="">
                    </div>
                    <div class="informations">
                        <table>
                            <tr>
                                <td><b>Entreprise :</b></td>
                                <td>Entreprise A</td>
                            </tr>
                            <tr>
                                <td><b>Téléphone :</b></td>
                                <td>0677882261</td>
                            </tr>
                            <tr>
                                <td><b>Ville :</b></td>
                                <td>Oujda</td>
                            </tr>
                            <tr>
                                <td><b>Adresse :</b></td>
                                <td>Andalous, Rue Fès 121</td>
                            </tr>
                            <tr>
                                <td><b>Email :</b></td>
                                <td>entreprise@gmail.com</td>
                            </tr>
                            <tr>
                                <td><b>Site internet :</b></td>
                                <td><b><a href="http://www.2a-assurances.fr" style="text-decoration:none; color: rgb(65, 148, 175);">http://www.2a-assurances.fr</a></b></td>
                        </tr>
                        
                        </table>
                        <div class="description">
                        <p><b>Déscription de l'entreprise :</b> <br> 
                            <p style="padding-left:10px" class="textdesc">Une entreprise de marketing digital est une agence spécialisée dans la promotion en ligne des produits et services. </p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <?php
            include '../footer/footer3.php';
}
        ?>
    </div>
    
</body>

</html>