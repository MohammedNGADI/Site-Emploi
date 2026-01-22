<?php
    session_start();
    include '../connexionBD/connexion.php';
    if (isset($_SESSION['idAdmine']))
    {
        $id = $_SESSION['idAdmine'] ;
        $requette = "SELECT nom, prenom, image FROM administrateurs WHERE idAdmine = ". $id ;
        $resultat = mysqli_query($connexion,$requette);
        $ligne = mysqli_fetch_row($resultat) ;
        $nom = strtoupper($ligne[0]); // Convertir le nom en majuscules
        $prenom = ucfirst(strtolower($ligne[1]));  
        $nomComplet = $prenom." ".$nom ; 
        $imageProfilEnTete = $ligne[2] ;
        unset($ligne);
        unset($resultat);
        unset($requette);
    }
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    // Le reste de votre code PHP va ici...

    // Par exemple, si vous voulez rediriger vers la page de connexion si l'utilisateur est déconnecté, vous pouvez ajouter :
    if (!isset($_SESSION['idAdmine'])) {
        header('location: ../Login/');
        exit();
    }
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../CSS/Administrateur/enTeteCSS.css">
    <link rel="icon" href="../SiteImages/administrateur/logoSiteEmploi2.jpg" type="image/jpg">
</head>
<body>
    
    
    <div class="enTete">
        <div class="logoSite">
            <a href="index.php" title="page d'acceuille"><img src="../SiteImages/administrateur/logoSiteEmploi2.jpg" alt=""></a>
        </div>
        <div class="profile" title="profile">
            <div class="imageProfile">
                <img src="<?php echo $imageProfilEnTete ?>" alt="">
            </div>
            <div class="nomAdministrateur">
                <?php echo $nomComplet ?>
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
            <img src="<?php echo $imageProfilEnTete ?>" alt="" >
        </div>
        <div class="nomAdministrateur">
            <?php echo $nomComplet ?>
        </div>
        <div class="lienGererProfile">
           <a href="administrateurProfil.php">Gérer votre profil</a>
        </div>
        <div class="lienDeconnexion">
            <a href="deconnexion.php">
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

</body>
</html>