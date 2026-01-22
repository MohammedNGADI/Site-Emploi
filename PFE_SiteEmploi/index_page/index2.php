<?php

include '../connexionBD/connexion.php';




?>






<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../SiteImages/administrateur/logoSiteEmploi2.jpg" type="image/jpg">
    <link rel="stylesheet" href="../bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href=".././CSS/index_css/offresCSS.css">
    <link rel="stylesheet" href=".././CSS/index_css/CSSEspaceRec.css">
    <link rel="stylesheet" href=".././CSS/index_css/index.css">
    <link rel="stylesheet" href=".././CSS/index_css/style3.css">
    <link rel="stylesheet" href=".././CSS/index_css/CSSfooter.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/css/glide.core.min.css"    />
    <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide@3.4.1/dist/glide.min.js"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css"/>
    <link rel="stylesheet" href=".././CSS/index_css/style2.css">
    <title>EMPNEXUS-Espace recruteur</title>
  </head>


  <style>
  


    
  #lien{
 margin-left : 140px ;
}
#propos{
 margin-left : -90px ;
}


#home{
    background: url("../SiteImages/indeximage/indeximage.jpeg");
}
.titre{
    font-size: 24px;
  text-shadow: -1px -1px #eee, 1px 1px #888, -3px 0 4px #000;
  color:#ccc;
  padding:16px;
 
  text-align:left;
  display:inline;
 
}
.btn{
  background: rgb(25, 25, 116);
}


.text1{
  
  font-size: 16px; 
  line-height: 1.5; 
  font-family: Arial, sans-serif; 
  color: #000000; 
  margin-bottom: 20px; 
  text-align: justify;
}
#parag{

font-size: 16px; 
line-height: 1.5; 
font-family: Arial, sans-serif; 
color: #000000; 
margin-bottom: 20px; 
text-align: justify;
}





h1 {
  color: black; 
  font-size: 32px;
  font-weight: bold; 
}


.about .content p {
    color: #000;
    text-align: justify;
    letter-spacing: 0.5px;
    line-height: 25px;
}











</style>
  
  <body>
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
            <li><a href="../INDEX.php#about_us">À propos</a></li>
            
        </ul>
        <a href="../Login/index.php" class="btn-connexion">Connexion</a>

        <div class="responsive-menu"></div>
    </header>












    <div class="slider-container">
  <div class="glide">
    <div class="glide__track" data-glide-el="track">
      <ul class="glide__slides">
        <?php
        if($connexion === false )
        {
          die("Erreur de connexion à la base de données :".mysqli_connect_error());
        }

        $ma_requete =  "SELECT * FROM entreprise ";
        $ma_resultat = mysqli_query($connexion, $ma_requete);

        if($ma_resultat) {
          while($row = mysqli_fetch_assoc($ma_resultat)) {
            ?>
            <li class="glide__slide">
              <img src="<?php echo $row['logo']; ?>" alt="logo"/> 
              <h4><?php echo $row['nom']; ?></h4> 
            </li>
            <?php
          }
          mysqli_free_result($ma_resultat);
        } else {
             echo "Erreur de requete :" .mysqli_error($connexion);
        }

        mysqli_close($connexion);
        ?>
      </ul>
    </div>

    <div class="glide__arrows" data-glide-el="controls">
      <button class="glide__arrow glide__arrow--left" data-glide-dir="<">
        <i class="las la-arrow-left"></i>
      </button>
      <button class="glide__arrow glide__arrow--right" data-glide-dir=">">
        <i class="las la-arrow-right"></i>
      </button>
    </div>
  </div>
</div>



<section class="about">
        <div class="image">
            <img src="../SiteImages/indeximage/entreprise.jpg">
        </div>
        <div class="content">
        <h1>Bienvenue aux Recruteurs</h1>
            <p>
            Bienvenue sur notre plateforme dédiée aux recruteurs ! Nous sommes ravis de vous accueillir ici pour découvrir des talents exceptionnels et trouver les candidats parfaits pour vos besoins en recrutement. Que vous recherchiez des profils spécialisés ou des candidats polyvalents, notre plateforme est conçue pour vous aider à trouver les meilleurs talents pour votre entreprise.

            </p>
            </div>
              
    </section>
       
    </section>

    
    <section class="about">
        <div class="image">
            <img src="../SiteImages/indeximage/entreprise.jpg">
        </div>
        <div class="content">
            <h1>Pourquoi Choisir Notre Plateforme?</h1>
            <p>
            Notre plateforme offre une gamme d'outils et de fonctionnalités pour simplifier votre processus de recrutement. 
            De la publication d'offres d'emploi à la gestion des candidatures et à la communication avec les postulants, 
            nous vous offrons tout ce dont vous avez besoin pour recruter efficacement. Notre interface conviviale et nos 
            fonctionnalités avancées vous permettent de gagner du temps et de trouver rapidement les candidats les plus qualifiés.
            </p>
            </div>
              
    </section>
    <script>
      new Glide('.glide', {
        type: 'carousel',
        perView: 5,
        focusAt: 'center',
        autoplay: 3000,
        arrows: {
          prev: '.glide__arrow--left',
          next: '.glide__arrow--right',
        },
      }).mount();
    </script>





<div class="title">
  <H1>
     Vous êtes un cabinet de recrutement ou une société d'intérim ?<br/>EmpNexus est votre partenaire au Maroc.
 </H1>

</div>

<!-- Section de nos Entreprises -->
<section class="home-packages">
 <h1 class="heading-title">nos Entreprises</h1>
 <div class="box-container">
     <div class="box">
         <div class="image">
             <img src="../SiteImages/indeximage/linki.webp" alt="">
         </div>
         <div class="content">
             <h3 >Solinki</h3>
             <p>Bénéficiez de la puissance de CVaden grâce à 100 crédits qui vous permettront de visualiser, télécharger, imprimer des CV et de contacter les candidats qualifiés les plus pertinents pour vous.</p>
         </div>
     </div>
     <div class="box">
         <div class="image">
             <img src="../SiteImages/indeximage/ubiki.png" alt="">
         </div>
         <div class="content">
             <h3>UBIK Ingénierie</h3>
             <p>CVaden est la seule CVthèque multi-bases du marché, alimentée par plus de 11 bases de CV complémentaires (Cadremploi, Le Figaro Emploi et de nombreuses bases partenaires), ce qui vous permettra d’accéder à des profils diversifiés sur tous les secteurs, toutes les fonctions et tous les niveaux.</p>
             
         </div>
     </div>
     <div class="box">
         <div class="image">
             <img src="../SiteImages/indeximage/welovedevs.webp" alt="">
         </div>
         <div class="content">
             <h3>Le Cab by WeLoveDevs</h3>
             <p>Chaque mois, 120 000 CV sont intégrés ou mis à jour dans CVaden dans toutes les fonctions et secteurs. Notre CVthèque est en renouvellement constant. Au total, vous aurez accès à 3 millions de CV qualifiés sur 1 an !</p>
             
         </div>
     </div>
 </div>
</section>




<section class="home-offer" id="offer">
  <div class="content">
      <h3>Notre Engagement à Votre Service</h3>
      <p>
      Bienvenue dans notre espace recruteur ! Nous simplifions votre processus de recrutement en vous offrant un accès rapide et efficace à un vivier de talents exceptionnels. 
      Avec notre engagement envers l'excellence du service et notre vaste réseau de candidats qualifiés, nous sommes votre partenaire idéal pour relever les défis de recrutement d'aujourd'hui.</p>
      <a href="../Login/index.php" class="btn" >Connectez-vous</a>
  </div>
</section>



<?php
    include '../footer/footer2.php';
?>
</html>