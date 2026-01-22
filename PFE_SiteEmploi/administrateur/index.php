<?php
            include('enTete.php') ; 
            include ('bareDeNavigationGauche.html'); 
        ?>
<?php include('../ConnexionBD/connexion.php') ;?>
<?php 
$requetteCondidats = "SELECT count(c.id_candidat) as nbCondidats FROM  candidat c INNER JOIN profil_candidat p ON c.id_candidat = p.id_candidat ; ";
$requetteRecreteurs = "SELECT count(id_entreprise) as nbRecruteurs FROM entreprise";
$requetteMessages = "SELECT count(idMessages) as nbMessages FROM messages WHERE vu = 0";
$requetteOffres = "SELECT count(id_offre) as nbOffres FROM offreemploi";
$result = mysqli_query($connexion, $requetteCondidats);
$ligne = mysqli_fetch_row($result);
$nbCondidats = $ligne[0];

$result = mysqli_query($connexion, $requetteRecreteurs);
$ligne = mysqli_fetch_row($result);
$nbRecruteurs = $ligne[0];

$result = mysqli_query($connexion, $requetteMessages);
$ligne = mysqli_fetch_row($result);
$nbMessages = $ligne[0];

$result = mysqli_query($connexion, $requetteOffres);
$ligne = mysqli_fetch_row($result);
$nbOffres = $ligne[0];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../CSS/Administrateur/statistiqueCSS.css">
    <title>EMPNEXUS-Administrateur</title>
</head>
<body>
    
    
    <div class="section1">
        <h1 class="titreDuSite">Découvrez les Performances en Temps Réel</h1>
        <p class="titreDuSite">Analytics Essentiels : Statistiques sur les Offres, Candidats, Recruteurs et Messages</p>
        <div class="section2">
            <div class="ligneStatistique">
                <div class="condidats cardS">
                    <div class="titre">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                        </svg>
                    </div>
                    <div class="nombre">
                        <p><?php echo $nbCondidats ; ?></p>
                        <h4>
                            Condidats
                        </h4>
                    </div>
                </div>
                <div class="recreteurs cardS">
                    <div class="titre">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-buildings-fill" viewBox="0 0 16 16">
                            <path d="M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5zM2 11h1v1H2zm2 0h1v1H4zm-1 2v1H2v-1zm1 0h1v1H4zm9-10v1h-1V3zM8 5h1v1H8zm1 2v1H8V7zM8 9h1v1H8zm2 0h1v1h-1zm-1 2v1H8v-1zm1 0h1v1h-1zm3-2v1h-1V9zm-1 2h1v1h-1zm-2-4h1v1h-1zm3 0v1h-1V7zm-2-2v1h-1V5zm1 0h1v1h-1z"/>
                        </svg>
                    </div>
                    <div class="nombre">
                       <p> <?php echo $nbRecruteurs ; ?></p>
                        <h4 >
                            Recruteurs
                        </h4>
                    </div>
                </div>
            </div>
            <div class="ligneStatistique">
                <div class="offres cardS">
                    <div class="nombre">
                        <p><?php echo $nbOffres ; ?></p>
                        <h4 >
                            Offres d'emploi
                        </h4>
                    </div>
                    <div class="titre">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase-fill" viewBox="0 0 16 16">
                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5"/>
                            <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85z"/>
                        </svg>
                    </div>
                    
                </div>
                <div class="messages cardS">
                    
                    <div class="nombre">
                        <p><?php echo $nbMessages ; ?></p>
                        <h4 >
                            Nouveaux messages
                        </h4>
                    </div>
                    <div class="titre">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-messenger" viewBox="0 0 16 16">
                            <path d="M0 7.76C0 3.301 3.493 0 8 0s8 3.301 8 7.76-3.493 7.76-8 7.76c-.81 0-1.586-.107-2.316-.307a.64.64 0 0 0-.427.03l-1.588.702a.64.64 0 0 1-.898-.566l-.044-1.423a.64.64 0 0 0-.215-.456C.956 12.108 0 10.092 0 7.76m5.546-1.459-2.35 3.728c-.225.358.214.761.551.506l2.525-1.916a.48.48 0 0 1 .578-.002l1.869 1.402a1.2 1.2 0 0 0 1.735-.32l2.35-3.728c.226-.358-.214-.761-.551-.506L9.728 7.381a.48.48 0 0 1-.578.002L7.281 5.98a1.2 1.2 0 0 0-1.735.32z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $requette = "SELECT c.nom, c.prenom, c.poste, p.photoProfil FROM candidat c INNER JOIN profil_candidat p  ON c.id_candidat = p.id_candidat LIMIT 10";
    if($result = mysqli_query($connexion, $requette))
    {
    ?>


    <div class="top premier">
        <h1>Derniers candidats inscrits :</h1>
        <div class="container indice1">
            <div class="swiper swiperCarousel">
                <div class="swiper-wrapper">
                    <?php 
                         while($ligne = mysqli_fetch_row($result))
                         {
                            echo "
                            <div class='swiper-slide'>
                            <div class='card'>
                                <img class='avatar' src='$ligne[3]' />
                                <svg class='quote-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 48 48' width='125px' height='125px'>
                                    <path
                                        d='M 16.482422 8.9921875 A 1.50015 1.50015 0 0 0 15.943359 9.1074219 C 15.943359 9.1074219 13.068414 10.279429 10.357422 13.464844 C 7.6464301 16.650259 5 21.927419 5 30 A 1.50015 1.50015 0 0 0 5.015625 30.21875 A 8.5 8.5 0 0 0 13.5 39 A 8.5 8.5 0 0 0 13.5 22 A 8.5 8.5 0 0 0 8.7089844 23.480469 C 9.5777265 19.777157 11.122152 17.196657 12.642578 15.410156 C 14.931586 12.720571 17.056641 11.892578 17.056641 11.892578 A 1.50015 1.50015 0 0 0 16.482422 8.9921875 z M 37.482422 8.9921875 A 1.50015 1.50015 0 0 0 36.943359 9.1074219 C 36.943359 9.1074219 34.068414 10.279429 31.357422 13.464844 C 28.64643 16.650259 26 21.927419 26 30 A 1.50015 1.50015 0 0 0 26.015625 30.21875 A 8.5 8.5 0 0 0 34.5 39 A 8.5 8.5 0 0 0 34.5 22 A 8.5 8.5 0 0 0 29.708984 23.480469 C 30.577727 19.777157 32.122152 17.196657 33.642578 15.410156 C 35.931586 12.720571 38.056641 11.892578 38.056641 11.892578 A 1.50015 1.50015 0 0 0 37.482422 8.9921875 z'
                                    />
                                </svg>
                                <div class='header'>
                                    <h1 class='name'> $ligne[0] $ligne[1]</h1>
                                    <h2 class='title'>$ligne[2]</h2>
                                </div>
                            </div>
                        </div>
                            ";
                         }
                        }
                        else{
                            echo  mysqli_error($connexion);
                        }
                    ?>
                    
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>   
    </div>  


    <?php
    $requette = "SELECT nom, description, logo FROM entreprise LIMIT 10";
    if($result = mysqli_query($connexion, $requette))
    {
    ?>
    <div class="top ">
        <h1>Derniers recruteurs inscrits :</h1>
        <div class="container indice2">
            <div class="swiper swiperCarousel">
                <div class="swiper-wrapper">
                    <?php 
                         while($ligne = mysqli_fetch_row($result))
                         {
                            echo "
                            <div class='swiper-slide'>
                            <div class='card'>
                                <img class='avatar' src='$ligne[2]' style ='background : white ;'/>
                                <svg class='quote-icon' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 48 48' width='125px' height='125px'>
                                    <path
                                        d='M 16.482422 8.9921875 A 1.50015 1.50015 0 0 0 15.943359 9.1074219 C 15.943359 9.1074219 13.068414 10.279429 10.357422 13.464844 C 7.6464301 16.650259 5 21.927419 5 30 A 1.50015 1.50015 0 0 0 5.015625 30.21875 A 8.5 8.5 0 0 0 13.5 39 A 8.5 8.5 0 0 0 13.5 22 A 8.5 8.5 0 0 0 8.7089844 23.480469 C 9.5777265 19.777157 11.122152 17.196657 12.642578 15.410156 C 14.931586 12.720571 17.056641 11.892578 17.056641 11.892578 A 1.50015 1.50015 0 0 0 16.482422 8.9921875 z M 37.482422 8.9921875 A 1.50015 1.50015 0 0 0 36.943359 9.1074219 C 36.943359 9.1074219 34.068414 10.279429 31.357422 13.464844 C 28.64643 16.650259 26 21.927419 26 30 A 1.50015 1.50015 0 0 0 26.015625 30.21875 A 8.5 8.5 0 0 0 34.5 39 A 8.5 8.5 0 0 0 34.5 22 A 8.5 8.5 0 0 0 29.708984 23.480469 C 30.577727 19.777157 32.122152 17.196657 33.642578 15.410156 C 35.931586 12.720571 38.056641 11.892578 38.056641 11.892578 A 1.50015 1.50015 0 0 0 37.482422 8.9921875 z'
                                    />
                                </svg>
                                <div class='header'>
                                    <h1 class='name'> $ligne[0]</h1>
                                    <p class='title'>$ligne[1]</p>
                                </div>
                            </div>
                        </div>
                            ";
                         }
                        }
                        else{
                            echo  mysqli_error($connexion);
                        }
                        
                    ?>
                    
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>   
    </div>  
    
    <?php
    $requette = "SELECT poste, description FROM offreemploi LIMIT 8";
    if($result = mysqli_query($connexion, $requette))
    {
    ?>
    
    <div class="tousCadrOffre">
        <h1>Dernières offres ajoutées :</h1>
        <div class="cardOffre">
            <?php 
                while($ligne = mysqli_fetch_row($result))
                {
                    echo "
                    <p class='paragrapheOffre'><span class='titreDePoste'><b>$ligne[0]</b><br>
                    <b class='description'><br>
                    <b class='titreDescription'>Description d'offre :</b><br>
                    $ligne[1]
                    </b></span>
                </p>
                    ";
                }
            }
            else{
            echo  mysqli_error($connexion);
            }
            mysqli_close($connexion);
            ?>

            <a href="testOffres.php" title="voir tous les offres">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link">
                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                <polyline points="15 3 21 3 21 9"></polyline>
                <line x1="10" y1="14" x2="21" y2="3"></line>
                </svg>
            </a>
        </div>
    </div>


    <script>
    document.addEventListener("DOMContentLoaded", function () {
    const swiper = new Swiper(".swiperCarousel", {
    slidesPerView: 3,
    centeredSlides: true,
    spaceBetween: 10,
    keyboard: {
        enabled: true,
    },
    loop: true,
    pagination: {
        el: ".swiper-pagination",
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    });

    const slides = document.getElementsByClassName("swiper-slide");
    for (const slide of slides) {
    slide.addEventListener("click", () => {
        const { className } = slide;
        if (className.includes("swiper-slide-next")) {
        swiper.slideNext();
        } else if (className.includes("swiper-slide-prev")) {
        swiper.slidePrev();
        }
    });
    }

    function resizeTextToFit() {
    const quoteEls = document.getElementsByClassName('quote');
    for (const el of quoteEls) {
        el.style.width = el.offsetWidth;
        el.style.height = el.offsetHeight;
    }
    }
    resizeTextToFit();
    addEventListener("resize", (event) => {
    resizeTextToFit();
    });
    });

    document.getElementsByClassName('recreteurs')[0].addEventListener('click', function() {
    // Changer l'URL de la page
    window.location.href = 'members.php?recruteur=1';
    });
    document.getElementsByClassName('condidats')[0].addEventListener('click', function() {
    // Changer l'URL de la page
    window.location.href = 'members.php';
    });
    document.getElementsByClassName('messages')[0].addEventListener('click', function() {
    // Changer l'URL de la page
    window.location.href = 'messages.php';
    });
    document.getElementsByClassName('offres')[0].addEventListener('click', function() {
    // Changer l'URL de la page
    window.location.href = 'testOffres.php';
    });
    </script>
    
   
</body>
</html>
<?php
include('../footer/footer.php') ;
?>