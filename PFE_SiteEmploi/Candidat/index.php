<?php
    session_start();
    include '../ConnexionBD/connexion.php';
    if(isset($_SESSION['email'])) {

        $sqlR = "SELECT * FROM offreemploi ORDER BY id_offre DESC LIMIT 6";
        $result = $connexion->query($sqlR);
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../SiteImages/administrateur/logoSiteEmploi2.jpg" type="image/jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Candidat/Candidat.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="Candidat.js"></script>
    <title>EMPNEXUS-Candidat</title>
</head>
<body>
    <?php include './enTete.php'; ?>

    <!-- Pour recherecher une offre en utilisant le poste et la ville -->
    <div class="imagebg">
        <div class="serviceRechercheCandidat">
            <p class="NbrPoste">Explorez une multitude d'opportunités professionnelles disponibles</p>
            <form action="./RechercheOffre.php" method="post">
                <input class="poste" name="poste" placeholder="Poste">
                <input class="ville" name="ville" placeholder="Ville">
                <button type="submit"><i class='bx bx-search'></i></button>
            </form>
        </div>
    </div>
    <div class="notificationVide">
        Veuillez remplir tous les champs requis.
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var form = document.querySelector("form");
            var notification = document.querySelector(".notificationVide");

            form.addEventListener("submit", function(event) {
                var poste = form.querySelector(".poste").value.trim();
                var ville = form.querySelector(".ville").value.trim();

                if (poste === "" && ville === "") {
                    notification.classList.add("active");
                    setTimeout(function() {
                        notification.classList.remove("active");
                    }, 6000);
                    event.preventDefault();
                }
            });
        });

    </script>

    <div class="DernierOffresEmploi">
        <div class="textDernierOffre">
            <p>Derniers offres d'emploi :</p>
        </div>
        <div class="offres">
            <?php
            while($row_offre = $result->fetch_assoc()) {
                $id_entreprise = $row_offre["id_entreprise"];
                $sql_entreprise = "SELECT nom , logo , ville  FROM entreprise WHERE id_entreprise = $id_entreprise";
                $result_entreprise = $connexion->query($sql_entreprise);
                $row_entreprise = $result_entreprise->fetch_assoc();
                $nom_entreprise = $row_entreprise["nom"];
                $poste = $row_offre["poste"];
                $description = $row_offre["description"];
                $datePublication = $row_offre["datePublication"];
                $dateFinOffre = $row_offre["dateFinOffre"];
                $competences = $row_offre["competences"];
                $typeContrat = $row_offre["typeContrat"];
                $id_offre = $row_offre["id_offre"];
                $logo = $row_entreprise["logo"];
                $ville = $row_entreprise["ville"];
            ?>
            <div class="offresRecruteur">
                <div class="offrecard" data-id_entreprise="<?php echo $id_entreprise; ?>" data-id_offre="<?php echo $id_offre; ?>">
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
                        <p class="region">Region de : <?php echo $ville ?></p>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <?php include '../footer/footer4.php'; ?>

</body>
</html>
<?php
}else{
    header('Location: ../Login');
}
?>
