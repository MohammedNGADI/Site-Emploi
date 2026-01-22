<?php
if(isset($_SESSION['email'])){
    include '../ConnexionBD/connexion.php';
    $email = $_SESSION['email'];

    $sql = "SELECT id_candidat , nom , prenom FROM candidat WHERE email = '$email'";


   

    $result1 = $connexion->query($sql);



    if($result1) {
        $row = $result1->fetch_assoc();
        
        $prenom = $row['prenom'];
        $nom = $row['nom'];
        $_SESSION['nomETprenom'] = $prenom.' '.$nom ;
        $id_candidat = $row['id_candidat'];
        $_SESSION['id_candidat'] = $id_candidat;

        $sql2 = "SELECT photoProfil FROM profil_candidat WHERE id_candidat = '$id_candidat'";
        $result2 = $connexion->query($sql2);
        $row2 = $result2->fetch_assoc();
        $phtoProfil = $row2['photoProfil'];
 
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $connexion->error;
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../SiteImages/administrateur/logoSiteEmploi2.jpg" type="image/jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../CSS/Recruteur/enTeteCSS.CSS">
</head>
<body>
    <div class="enTete">
        <div class="logoSite">
            <a href="./index.php"><img src="../SiteImages/RecruteurImgs/logo2.jpg" alt=""></a>
        </div>
        <div class="sevicesCandidat">
            <a href="./index.php">Accueil</a>
            <a href="./RechercheDetaille.php">Rechrcher Un Emploi</a>
            <a href="./CandidatPostulations.php">Mes Postulations</a>
            <a href="./cantactez_nous.php">contactez-nous</a>
        </div>

        <div class="profile">

        <div class="imageProfile">
            <img src="<?php echo $phtoProfil; ?>" alt="" style="border:solid black 2px ;">
        </div>
        <div class="nomAdministrateur"  style="padding:10px;">
        <?php if (isset($nom)) {
                echo $nom . " " . $prenom ;
            }else{
                echo "pas de sresourse";
            }
             ?> 
        </div>
        </div>
    </div>
    <div class="formulaireDeconexion">
        <div class="iconX">
            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
            </svg>
        </div>
        <div class="imageProfileDecon">
            <img src="<?php echo $phtoProfil; ?>" alt="" >
        </div>
        <div class="nomAdministrateur">
        <?php if (isset($nom)) {
                echo $nom . " " . $prenom ;
            } ?> 
        </div>

        <div class="lienGererProfile">
           <a href="./CandidatProfil.php">Gérer votre profil</a>
        </div>
        <div class="lienDeconnexion">
        <a href="./Deconnexion.php?logout=true">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8m-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5"/>
            </svg>
            <span>Se déconnecter</span>
        </a>

        </div>
    </div>
    <script>
        const formulaireDeconexion = document.querySelector('.formulaireDeconexion');
        const iconX = document.querySelector('.iconX');
        const profile = document.querySelector('.profile');

        profile.onclick = () => 
        {
            formulaireDeconexion.style.display = 'block';
        }
        iconX.onclick = () => 
        {
            formulaireDeconexion.style.display = 'none';
        }
    </script>
    <?php
        }
    ?>
</body>
</html>

