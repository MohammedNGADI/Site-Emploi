<?php
    include '../ConnexionBD/connexion.php';
    session_start();
    if(isset($_GET['offre'])) {
    if (isset($_GET['offre'])) {
        $idOffre =  $_GET['offre'];


            // Requête pour récupérer l'id_candidat en fonction de l'email
            $candidat = "SELECT id_entreprise FROM offreemploi WHERE id_offre = '$idOffre'";
            $candidat_result = mysqli_query($connexion, $candidat);
            $rowC = mysqli_fetch_assoc($candidat_result);
            $id_entreprise = $rowC['id_entreprise'];

        $detailoffreEntreprise = "SELECT * FROM entreprise WHERE id_entreprise = '{$id_entreprise}'";
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

        $detailoffre = "SELECT * FROM offreemploi WHERE  id_offre = '{$_GET['offre']}'";
        if ($result = mysqli_query($connexion, $detailoffre)) {
            $rowOffre = mysqli_fetch_assoc($result);
            // Extraction des données de l'offre

            $poste = $rowOffre['poste'];
            $descriptionoffre = $rowOffre['description'];
            $comptences = $rowOffre['competences'];
            $typeContrat = $rowOffre['typeContrat'];
            $experience = $rowOffre['experiences']; 
            $dateDebut = $rowOffre['datePublication']; 
            $dateFin = $rowOffre['dateFinOffre']; 
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/index_css/detailOffre.css">
    <link rel="stylesheet" href="../CSS/index_css/index.css">

    
    <title><?php echo $poste ?></title>
</head>


<header>
        <div class="logo">
            <a href="../INDEX.php">
                <img src="../SiteImages/indeximage/logo1.jpg"   class="logo-image" style="width: 70px; height: auto;">
            </a>
        </div>
        <ul class="menu">
            <li><a href="../INDEX.php">Acceuil</a></li>
            <li><a href="listeOffres2.php">Offres</a></li>
            <li><a href="index2.php">Espace recruteur</a></li>
            <li><a href="contact1.php">Contacter-nous </a></li>
            <li><a href="../INDEX.php#about_us">à propos</a></li>
            
        </ul>
        <a href="../Login/index.php" class="btn-connexion">Connexion</a>

        <div class="responsive-menu"></div>
    </header>









<body style="background-color:#eee">






















    <div class="milieu">
        <div class="Entreprise">
            <div class="entrepriseNom">
                <?php echo $Nomentreprise; ?>
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
                    Ville : <?php echo $ville; ?>
                </div>
                <div class="NiveauExperience">
                    Niveau d'expérience : <?php echo $experience; ?>
                </div>
                
            </div>
        </div>
    </div>
    
    <div class="Postulation">
        <button class="btnPostulation" >Postuler</button>
    </div>
    <div class="ConfirmationEtMessage">
        <div class="ConfirmerPostulation">
            <p>Vous êtes sûr pour postuler cette offre</p>
            <br>
            <button class="Oui" id="Oui">Oui</button>
            <button class="Non" id="Non">Non</button>
        </div>
        
    </div>
    <div class="MessagePostulation">
            Votre postulation a été réalisée avec succès.
    </div>::::::::::::::::


    <?php 
    }
    ?>
<script src="./Detail.js"></script>
</body>
</html>
