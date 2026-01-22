<?php include('../ConnexionBD/connexion.php') ;?>
<?php 
$requetteCondidats = "SELECT count(id_candidat) as nbCondidats FROM candidat";
$requetteRecreteurs = "SELECT count(id_entreprise) as nbRecruteurs FROM entreprise";
$requetteMessages = "SELECT count(idMessages) as nbMessages FROM messages";
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

mysqli_close($connexion);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Administrateur/statistiqueCSS.css">
    <title>Statistiques</title>
</head>
<body>
    <div class="section1">
        <h1 class="titreDuSite">Tableau de Bord de la Plateforme : Découvrez les Performances en Temps Réel</h1>
        <p class="titreDuSite">Analytics Essentiels : Statistiques sur les Offres, Candidats, Recruteurs et Messages</p>
        <div class="section2">
            <div class="ligneStatistique">
                <div class="condidats card">
                    <div class="titre">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                        </svg>
                    </div>
                    <div class="nombre">
                        <p><?php echo $nbCondidats ; ?></p>
                        <h4>
                            Les condidats
                        </h4>
                    </div>
                </div>
                <div class="recreteurs card">
                    <div class="titre">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-buildings-fill" viewBox="0 0 16 16">
                            <path d="M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5zM2 11h1v1H2zm2 0h1v1H4zm-1 2v1H2v-1zm1 0h1v1H4zm9-10v1h-1V3zM8 5h1v1H8zm1 2v1H8V7zM8 9h1v1H8zm2 0h1v1h-1zm-1 2v1H8v-1zm1 0h1v1h-1zm3-2v1h-1V9zm-1 2h1v1h-1zm-2-4h1v1h-1zm3 0v1h-1V7zm-2-2v1h-1V5zm1 0h1v1h-1z"/>
                        </svg>
                    </div>
                    <div class="nombre">
                       <p> <?php echo $nbRecruteurs ; ?></p>
                        <h4 >
                            Les recruteurs
                        </h4>
                    </div>
                </div>
            </div>
            <div class="ligneStatistique">
                <div class="offres card">
                    <div class="nombre">
                        <p><?php echo $nbOffres ; ?></p>
                        <h4 >
                            Les offres d'emploi
                        </h4>
                    </div>
                    <div class="titre">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-briefcase-fill" viewBox="0 0 16 16">
                            <path d="M6.5 1A1.5 1.5 0 0 0 5 2.5V3H1.5A1.5 1.5 0 0 0 0 4.5v1.384l7.614 2.03a1.5 1.5 0 0 0 .772 0L16 5.884V4.5A1.5 1.5 0 0 0 14.5 3H11v-.5A1.5 1.5 0 0 0 9.5 1zm0 1h3a.5.5 0 0 1 .5.5V3H6v-.5a.5.5 0 0 1 .5-.5"/>
                            <path d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85z"/>
                        </svg>
                    </div>
                    
                </div>
                <div class="messages card">
                    
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
</body>
</html>