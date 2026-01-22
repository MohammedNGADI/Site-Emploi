<?php
    include '../ConnexionBD/connexion.php';
    session_start();
    if(isset($_SESSION['email'])) {
    if(isset($_POST['recherche']) && !empty($_POST['recherche'])) {
        // Récupérer les données de recherche
        $recherche = $_POST['recherche'];
        $id_entreprise = $_SESSION['id_entreprise'];
        // Échapper les caractères spéciaux pour éviter les injections SQL
        $recherche = $connexion->real_escape_string($recherche);

        // Requête SQL pour rechercher dans la base de données
        $sql_Rechrche = "SELECT * FROM offreemploi WHERE poste LIKE '%$recherche%' and id_entreprise= $id_entreprise";

        // Exécution de la requête
        $result_Rechrche = $connexion->query($sql_Rechrche);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Recruteur/RechrcheOffre.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://fonts.cdnfonts.com/css/readex-pro" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="Recherche.js"></script>
    <title>Page Recherehce</title>
</head>
<body style="background-color : rgba(132, 212, 239, 0.445)">
    
    <header>
    <?php
        include './enTete.php';
    ?>
    </header>
        <div class="recherchePage">
            <?php
                // Vérifier s'il y a des résultats
                if ($result_Rechrche->num_rows > 0) {
                    if($result_Rechrche->num_rows == 1){
                        echo "<div class='NbrOffreTouve'> Une offre trouvée </div> ";
                    }elseif($result_Rechrche->num_rows == 2){
                        echo "<div class='NbrOffreTouve'> Deux offres trouvées </div> ";
                    }elseif($result_Rechrche->num_rows == 3){
                        echo "<div class='NbrOffreTouve'> Trois offres trouvées </div> ";
                    }else{
                        echo "<div class='NbrOffreTouve'> $result_Rechrche->num_rows offres trouvées </div> ";
                    }
                    
                    // Afficher les résultats de la recherche
                    while($row_offre = $result_Rechrche->fetch_assoc()) {
                        // Recuperation id_entreprise
                        $id_entreprise = $row_offre["id_entreprise"];

                        // Nouvelle requête pour récupérer le nom de l'entreprise
                        $sql_nom_entreprise = "SELECT nom , logo FROM entreprise WHERE id_entreprise = $id_entreprise";
                        $result_nom_entreprise = $connexion->query($sql_nom_entreprise);
                        $row_nom_entreprise = $result_nom_entreprise->fetch_assoc();
                        $nom_entreprise = $row_nom_entreprise["nom"];
                        $logo = $row_nom_entreprise["logo"];

                        $poste = $row_offre["poste"];
                        $description = $row_offre["description"];
                        $datePublication = $row_offre["datePublication"];
                        $dateFinOffre = $row_offre["dateFinOffre"];
                        $competences = $row_offre["competences"];
                        $typeContrat = $row_offre["typeContrat"];
                        $id_offre = $row_offre["id_offre"];
                    ?>
                        <div class="offresRecruteur" >
                            <div class="offrecard">
                                <div class="RecruteurLogo">
                                    <div class="entL">
                                        <a href="#">
                                            <img src="<?php echo $logo ?>" alt="" style="width:100px">
                                        </a>
                                    </div>
                                </div>
                                <div class="offredetail">
                                    <b class="poste"><?php echo $poste ?></b><br>
                                    <b class="date" style="float:right; font-weight: 100;"><?php echo $datePublication ?></b><b class="NomEntreprise"><?php echo $nom_entreprise ?></b>
                                    <p class="description"><?php echo $description ?></p>
                                    <p class="region">Compétence : <br><?php echo $competences ?></p>
                                </div>
                            </div>
                        </div>
                        <br> 
                    <?php
                    }
                    
                } else {
                    echo "<div class='PasResultat'>Aucun résultat trouvé.</div>";
                }
            } else {
                echo "<script>alert('Veuillez saisir le nom de l\\'offre à rechercher'); window.location.href = './index.php';</script>";

            }

            // Fermer la connexion à la base de données
            $connexion->close();
            ?>
        </div>
        <?php include '../footer/footer3.php';
 
        }else{
            header('Location: ../Login');
        }
        
        ?>

</body>
</html>