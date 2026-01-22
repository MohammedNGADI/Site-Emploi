<?php
    include '../ConnexionBD/connexion.php';
    session_start();
    if(isset($_SESSION['email'])) {
    if (isset($_GET['id_entreprise']) && isset($_GET['id_offre'])) {
        $_SESSION['id_entreprise'] = $_GET['id_entreprise'];
            $_SESSION['id_offre'] = $_GET['id_offre'];
            $id_offre = $_SESSION['id_offre'] ; 
            // Récupérer l'email de la session
            $email = $_SESSION['email'];

            // Requête pour récupérer l'id_candidat en fonction de l'email
            $candidat = "SELECT id_candidat FROM candidat WHERE email = '$email'";
            $candidat_result = mysqli_query($connexion, $candidat);
            $rowC = mysqli_fetch_assoc($candidat_result);
            $id_candidat = $rowC['id_candidat'];
            $_SESSION['id_candidat'] = $id_candidat;

        $detailoffreEntreprise = "SELECT * FROM entreprise WHERE id_entreprise = '{$_SESSION['id_entreprise']}'";
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

        $detailoffre = "SELECT * FROM offreemploi WHERE id_entreprise = '{$_SESSION['id_entreprise']}' AND id_offre = '{$_SESSION['id_offre']}'";
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
    <link rel="stylesheet" href="../CSS/Recruteur/detailOffre.css">
    <link rel="stylesheet" href="../CSS/Recruteur/enTeteCSS.css">
    
    <title><?php echo $poste ?></title>
</head>
<body style="background-color:#eee">

    <div class="header">
        <?php include './enTete.php'; ?>
    </div>
    
    <div class="milieu">
        <div class="Entreprise">
            <div class="entrepriseNom">
                <?php echo $Nomentreprise ?>
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

    
    
    <?php
        $sqlCheckPostulation = "SELECT COUNT(*) AS num_postulations FROM postulation WHERE id_offre = '{$_SESSION['id_offre']}' AND id_candidat = '{$_SESSION['id_candidat']}'";
        $resultCheckPostulation = $connexion->query($sqlCheckPostulation);
        $rowCheckPostulation = $resultCheckPostulation->fetch_assoc();
        $numPostulations = $rowCheckPostulation['num_postulations'];

        if ($numPostulations > 0) {
            echo '<div class="SupprimerPostulation">
                    <button class="btnSupprimerPostulation">Supprimer Postulation</button>
                </div>';
        } else {
            echo '<div class="Postulation">
                    <button class="btnPostulation">Postuler</button>
                  </div>';
        }
    ?>

    <div class="ConfirmationEtMessageSupp">
        <div class="ConfirmerSuppressionPostulation">
            <p>Confirmez-vous la suppression de votre candidature pour cette offre ?</p>
            <br>
            <button class="OuiS" id="OuiS">Oui</button>
            <button class="NonS" id="NonS">Non</button>
        </div>
    </div>


    <div class="ConfirmationEtMessage">
        <div class="ConfirmerPostulation">
            <p>Vous êtes sûr pour postuler cette offre ?</p>
            <br>
            <button class="Oui" id="Oui">Oui</button>
            <button class="Non" id="Non">Non</button>
        </div>
    </div>
    
    
    <div class="MessagePostulation">
        Votre postulation a été réalisée avec succès.
    </div>
    <div class="MessageDejaPostulation">
        Vous avez déjà postulé à cette offre.
    </div>
    <div class="MessageSuppression">
        Votre postulation supprimée avec succès.
    </div>
    <div class="MessageDejaSupprimee">
        Vous avez déjà supprimer cette postulation.
    </div>



    <?php include '../footer/footer4.php'; 

    }
    ?>
<script src="./Detail.js"></script>
</body>
</html>
