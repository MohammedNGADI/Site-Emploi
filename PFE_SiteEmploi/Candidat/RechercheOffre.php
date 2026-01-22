<?php
    session_start();
    include '../ConnexionBD/connexion.php';

// Vérifier si le poste est saisi
if(isset($_POST['poste']) && !empty($_POST['poste'])) {
    $poste = $connexion->real_escape_string($_POST['poste']); // Échapper les caractères spéciaux

    // Requête SQL de base
    $sql = "SELECT * FROM offreemploi o JOIN entreprise e ON o.id_entreprise = e.id_entreprise WHERE o.poste LIKE '%$poste%'";

    // Vérifier si la ville est également saisie
    if(isset($_POST['ville']) && !empty($_POST['ville'])) {
        $ville = $connexion->real_escape_string($_POST['ville']); // Échapper les caractères spéciaux
        $sql .= " AND e.ville LIKE '%$ville%'";
    }

    // Exécuter la requête
    $result = $connexion->query($sql);
}

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
    <title>Page Recherehce</title>
</head>
<body style="background: rgba(132, 212, 239, 0.445);">
        

        <header>
        <?php
            include './enTete.php';
        ?>
        </header>

        <div class="recherchePage" >
            <?php
                // Vérifier s'il y a des résultats
                if ($result->num_rows > 0) {
                    if($result->num_rows == 1){
                        echo "<div class='NbrOffreTouve'> Une offre trouvée </div> ";
                    }elseif($result->num_rows == 2){
                        echo "<div class='NbrOffreTouve'> Deux offres trouvées </div> ";
                    }elseif($result->num_rows == 3){
                        echo "<div class='NbrOffreTouve'> Trois offres trouvées </div> ";
                    }else{
                        echo "<div class='NbrOffreTouve'> $result->num_rows offres trouvées </div> ";
                    }
                    
                    // Afficher les résultats de la recherche
                    while($row_offre = $result->fetch_assoc()) {
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
                        $ville = $row_offre['ville'];
                    ?>
                        <div class="offresRecruteur" data-id_entreprise="<?php echo $id_entreprise ?>" data-id_offre="<?php echo $id_offre ?>">
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
                                    <p class="region">Region de : <?php echo $ville ?> </p>
                                </div>
                            </div>
                        </div>
                        <br> 
                    <?php
                    }
                    
                } else {
                    echo "<div class='PasResultat'>Aucun résultat trouvé.</div>";
                }

            // Fermer la connexion à la base de données
            $connexion->close();
            ?>
            <script>
            $(document).ready(function() {
                $(".recherchePage").on("click", ".offresRecruteur", function() {
                    var id_entreprise = $(this).data('id_entreprise');
                    var id_offre = $(this).data('id_offre');
                    
                    // Redirection vers la page detailOffre.php avec les paramètres id_entreprise et id_offre dans l'URL
                    window.location.href = './detailOffre.php?id_entreprise=' + id_entreprise + '&id_offre=' + id_offre;
                });
            });
        </script>
        </div>
        <?php include '../footer/footer4.php'; ?>        
</body>
</html>
