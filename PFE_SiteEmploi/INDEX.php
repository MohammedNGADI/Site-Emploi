<?php
include './connexionBD/connexion.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="SiteImages/administrateur/logoSiteEmploi2.jpg" type="image/jpg">    
    <link rel="stylesheet" href="./bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./CSS/index_css/offresCSS.css">   
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen">	
    <link href="./CSS/index_css/offresCSS.css" rel="stylesheet">	
    <link rel="stylesheet" href="./CSS/index_css/index.css">
    <link rel="stylesheet" href="./CSS/index_css/CSSfooter.css">
    <title>EMPNEXUS</title>
    <style>

#home{
    background: url("./SiteImages/indeximage/indeximage.jpeg");
}
.titre{
   font-size: 30px;
  color:black;
  padding:16px;
  text-align:left;
  display:inline;
  width : 55%;
 
}
</style>
</head>
<body>


    <header>
        <div class="logo">
            <a href="./INDEX.php">
                <img src="./SiteImages/indeximage/logo1.jpg"   class="logo-image" style="width: 70px; height: auto;">
            </a>
        </div>
        <ul class="menu">
            <li><a href="#">Acceuil</a></li>
            <li><a href="./index_page/listeOffres2.php">Offres</a></li>
            <li><a href="./index_page/index2.php">Espace recruteur</a></li>
            <li><a href="./index_page/contact1.php">Contactez-nous </a></li>
            <li><a href="#about_us">À propos</a></li>           
            
        </ul>
        <a href="./Login/index.php" class="btn-connexion">Connexion</a>

        <div class="responsive-menu"></div>
    </header>
    <!--Section  home -->
    <section id="home">
        
        <h2>Ayez l'ambition d'être heureux.</h2>

        <div >
        <form method="POST" class="barsearch" action="./index_page/listeOffres2.php">
    <input type="text" name="poste" placeholder="Rechercher une offre" size="40" class="recherchebar">



    <button type="submit" name="recherche" value="✓" class="recherchebtn" ><i class='bx bx-search-alt-2'></i></button>
</form>
</section>


                     </div>
    </section>
  

    <section id="offres-disponible">
    <div class="titre"><h1>Dernières Offres Emploi :</h1></div>

    <div class="content">
        <?php 
        
        $requette2 = "SELECT DISTINCT poste, id_offre, id_entreprise FROM offreemploi LIMIT 6";
        $resultat_offres = mysqli_query($connexion, $requette2);
        if ($resultat_offres) {
            while ($ligne_offre = mysqli_fetch_assoc($resultat_offres)) {
                $id_entreprise = $ligne_offre['id_entreprise'];
                $requette = "SELECT  nom, logo FROM entreprise WHERE id_entreprise = $id_entreprise";               
                $ligne_entreprise = mysqli_query($connexion, $requette);
                if ($ligne_entreprise->num_rows > 0) {
                    $ligne_entreprise = mysqli_fetch_assoc($ligne_entreprise)
                        ?>
                        <!-- box -->
                        <div class="offre">
                            <img src="<?php echo 'Login/' . $ligne_entreprise['logo']; ?>" alt="logo">
                            <div class="content">
                                <div>
                                    <h4><?php echo $ligne_offre['poste']?></h4>
                                    <a <?php echo 'href="index_page/indexSession.php?id='.$ligne_offre['id_offre'].'"'; ?>>Lire Plus</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    
                } 
            }
            mysqli_free_result($resultat_offres);
        } else {
            echo "Erreur d'exécution de la requête : " . mysqli_error($connexion);
        }
        ?>
    </div>
</section>
    
           





















   
    <!-- section  Apropre de  de site -->

    <section id="about_us">
        <h4 class="mini_title">Qui sommes-nous   </h4>
        <h2 class="title">Pourquoi nous choisir ?</h2>
        <div class="about">
            <div class="left">
                <img src="./SiteImages/indeximage/job.jpg">
            </div>
            <div class="right">
                <h3>Meilleure  Emploi  dans le monde  </h3>
                <p>La page “qui sommes-nous” d’un site d'emploi est absolument essentielle, mais elle est souvent ratée. 
                    Certains ne veulent pas prendre de temps pour ce qu’ils considèrent comme étant superflu.
                     D’autres vont y passer des heures sans savoir où ils vont.
                      Or, aujourd'hui les consommateurs sont en quête d'informations sur ce qui votre différence, 
                      sur l'équipe qui se cache derrière votre business, et sur vos valeurs et engagements.</p>
               
            </div>
        </div>
   </section>
</body>







<?php
    include './footer/footer.php';
?>




</html>