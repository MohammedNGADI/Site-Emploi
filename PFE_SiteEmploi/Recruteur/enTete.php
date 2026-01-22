<?php
include '../ConnexionBD/connexion.php';

if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $sql = "SELECT id_entreprise , nom , logo FROM entreprise WHERE email = '$email'";


    $result = $connexion->query($sql);


    if($result) {
        $row = $result->fetch_assoc();
        $id_entreprise = $row['id_entreprise'];
        $logo = $row['logo'];
        $nom = $row['nom'];
        $_SESSION['id_entreprise'] = $id_entreprise ;
    } else {
        echo "Erreur lors de l'exécution de la requête : " . $connexion->error;
    }
} else {

}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="../CSS/Recruteur/enTeteCSS.css">
</head>
<body>
    <div class="enTete">
        <div class="logoSite">
            <a href="./index.php"><img src="../SiteImages/RecruteurImgs/logo2.jpg" alt=""></a>
        </div>

        <div class="ServiceRecruteur" style="margin-right : 50px">
            <a href="index.php">Acceuil</a>
            <a href="GestionDesOffres.php?action=voir_offres">Mes Offres</a>
            <a href="GestionDesOffres.php?action=ajouter_offre">Ajouter une offre</a>
        </div>

        <div class="searshOffre">
            <form action="./RechercheOffre.php" method="POST" id="searchForm">
                <input type="text" name="recherche" placeholder="Rechercher une offre" class="BarreRecherche">
                <button type="submit"><i class='bx bx-search'></i></button>
            </form>
        </div>

        <div class="profile">
            <div class="imageProfile">
                <img src="<?php echo $logo; ?>" alt="" style="border:solid black 2px ;">
            </div>
            <div class="nomAdministrateur" style="padding-left:7px">
             <?php if (isset($nom)) {
                echo $nom ;
                } ?> 
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
            <img src="<?php echo $logo; ?>" alt="" style="border:solid black 2px ;">
        </div>
        <div class="nomAdministrateur" style="padding:10px;">
        <?php if (isset($nom)) {
                echo $nom ;
            } ?> 
        </div>

        <div class="lienGererProfile">
           <a href="./modifierProfil.php">Gérer votre profil</a>
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
    
</body>
</html>

