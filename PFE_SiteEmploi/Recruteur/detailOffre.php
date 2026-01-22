<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Recruteur/detailOffre.css">
    <link rel="stylesheet" href="../CSS/Recruteur/enTeteCSS.css">
    <title>detailOffre</title>
</head>
<body style="background-color:#eee">
    <div class="header">
    <?php
        include './enTete.php';
    ?>
    </div>
    
    <?php
        include '../ConnexionBD/connexion.php';

        $detailoffreEntreprise = "SELECT * FROM entreprise where id_entreprise = 8";
        if ($result = mysqli_query($connexion, $detailoffreEntreprise)) {
            $row = mysqli_fetch_assoc($result);

            // Extraction des données de l'entreprise
            $Nomentreprise = $row['nom'];
            $siteInternet = $row['site_web'];
            $email = $row['email'];
            $telephone = $row['n_telephone'];
            $ville = $row['ville'];
            $adresse = $row['adresse'];
            $description = $row['description']; 
        }

        
    ?>
    
    <div class="milieu">
        <div class="Entreprise">
            <div class="entrepriseNom">
                <?php echo " $Nomentreprise "?>
            </div>
            <div class="InfosEntreprise">
                <div class="logoEntreprise">
                    <img src="../SiteImages/logo.jpg" alt="">
                </div>
                <div class="informations">
                    <p>Site internet : <b><?php echo $siteInternet; ?></b></p>
                    <p>email : <?php echo $email; ?></p>
                    <p>Téléphone : <?php echo $telephone; ?></p>
                    <p>Ville : <?php echo $ville; ?></p>
                    <p>Adresse : <?php echo $adresse; ?></p>
                    <p>Déscription de l'entreprise : <br> 
                        <p style="padding-left:10px"><?php echo $description; ?></p>
                </div>
            </div>
        </div>
        <?php
        $detailoffre = "SELECT * FROM offreemploi where id_entreprise = 9";
        if ($result = mysqli_query($connexion, $detailoffre)) {
            $rowOffre = mysqli_fetch_assoc($result);

            // Extraction des données de l'entreprise
            $poste = $rowOffre['poste'];
            $descriptionoffre = $rowOffre['description'];
            $comptences = $rowOffre['competences'];
            $typeContrat = $rowOffre['typeContrat'];
            $salaire = $rowOffre['salaire']; 
            $experience = $rowOffre['experiences']; 
            $dateDebut = $rowOffre['datePublication']; 
            $dateFin = $rowOffre['dateFinOffre']; 

            

        }

        ?>
        <div class="Annance">
            <div class="AnnanceDetail">
                Détail Annance
            </div>
            <div class="InfosAnnance">
            <div class="Poste">
                <b>Poste : <?php echo $poste; ?> </b>
            </div>
            <div class="informationsA">
                <p>Déscription :</p>
                <p style="padding-left:10px;"><?php echo $descriptionoffre; ?></p> 
            </div>
            <div class="competences">
                Compétences requise : <?php echo $comptences; ?>
            </div>
            <div class="typeContrat">
                Type de Contrat : <?php echo $typeContrat; ?>
            </div>
            <div class="ville">
                Ville : Oujda <!-- Vous pouvez remplacer "Oujda" par la variable correspondante si nécessaire -->
            </div>
            <div class="NiveauExperience">
                Niveau d'expérience : <?php echo $experience; ?>
            </div>
            <div class="NiveauEtude">
                Niveau d'étude : bac+2 <!-- Vous pouvez remplacer "bac+2" par la variable correspondante si nécessaire -->
            </div>
            <div class="langues">
                Langues exigées : Anglais , Français
            </div>

            </div>
        </div>
    </div>
    
    <?php include '../footer/footer3.php'; ?>

</body>
</html>
