<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="icon" href="../SiteImages/administrateur/logoSiteEmploi2.jpg" type="image/jpg">
    <link rel="stylesheet" href="../CSS/Candidat/CandidatPostulations.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>EMPNEXUS-Mes Postulations</title>
</head>
<body>
    <header>
    <?php
        include './enTete.php';
    ?>
    </header>
    <div class="conteneur">
        <h1>Mes Postulations : </h1>
        <div class="offres">
            <?php
            include '../ConnexionBD/connexion.php';

            // Vérifier si l'utilisateur est connecté
            if (isset($_SESSION['id_candidat'])) {
                $id_candidat = $_SESSION['id_candidat'];

                // Requête pour récupérer les offres postulées par le candidat
                $sql = "SELECT o.*, e.nom AS nom_entreprise, e.logo AS logo_entreprise, e.ville AS ville_entreprise
                        FROM postulation p 
                        INNER JOIN offreemploi o ON p.id_offre = o.id_offre 
                        INNER JOIN entreprise e ON o.id_entreprise = e.id_entreprise
                        WHERE p.id_candidat = $id_candidat";

                // Exécution de la requête
                $result = $connexion->query($sql);

                // Vérifier s'il y a des résultats
                if ($result->num_rows > 0) {
                    // Affichage des offres postulées
                    while ($row_offre = $result->fetch_assoc()) {
                        $id_entreprise = $row_offre["id_entreprise"];
                        $nom_entreprise = $row_offre["nom_entreprise"];
                        $poste = $row_offre["poste"];
                        $description = $row_offre["description"];
                        $datePublication = $row_offre["datePublication"];
                        $ville_entreprise = $row_offre["ville_entreprise"];
                        $logo_entreprise = $row_offre["logo_entreprise"];
                        $id_offre = $row_offre["id_offre"];
            ?>
                        <div class="offresRecruteur">
                            <div class="offrecard" data-id_entreprise="<?php echo $id_entreprise; ?>" data-id_offre="<?php echo $id_offre; ?>">
                                <div class="RecruteurLogo">
                                    <div class="entL">
                                        <a href="#">
                                            <img src="<?php echo $logo_entreprise ?>" alt="" style="width:100px">
                                        </a>
                                    </div>
                                </div>
                                <div class="offredetail">
                                    <b class="poste"><?php echo $poste ?></b><br>
                                    <b class="date" style="float:right; font-weight: 100;"><?php echo $datePublication ?></b><b class="NomEntreprise"><?php echo $nom_entreprise ?></b>
                                    <p class="description"><?php echo $description ?></p>
                                    <p class="region">Region de : <?php echo $ville_entreprise ?></p>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                } else {
                    echo "<p>Aucune postulation trouvée.</p>";
                }
            } else {
                // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
                header("Location: login.php");
                exit();
            }
            ?>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $(".offres").on("click", ".offresRecruteur", function() {
            var id_entreprise = $(this).find('.offrecard').data('id_entreprise');
            var id_offre = $(this).find('.offrecard').data('id_offre');
            
            // Redirection vers la page detailOffre.php avec les paramètres id_entreprise et id_offre dans l'URL
            window.location.href = './detailOffre.php?id_entreprise=' + id_entreprise + '&id_offre=' + id_offre;
        });
    });
    </script>

<?php include '../footer/footer4.php'; ?>

</body>
</html>
