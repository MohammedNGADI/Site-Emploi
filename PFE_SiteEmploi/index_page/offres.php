<?php include 'connexionBD/connexion.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="offresCSS.css">
   
</head>
<body>
    <?php 
        
        
    ?>
    <div class="body">
            
            
                <?php 
                $requette = "SELECT  e.nom , o.poste, o.description, o.dateFinOffre, 
                o.competences, o.typeContrat, o.salaire, o.experiences 
                FROM offreemploi o INNER JOIN entreprise e
                ON e.id_entreprise = o.id_entreprise";
                if ($result = mysqli_query($connexion, $requette)) {
                    echo "<h1>" . mysqli_num_rows($result) . " offres trouvées :</h1>";
                    echo "<div class='pageOffres'>";
                    while ($ligne = mysqli_fetch_assoc($result)) {
                        echo "
                        <div class='uneOffre'>
                            <div class='profileOffre'>
                                <div class='imageProfileOffre'>
                                    <img src='../SiteImages/administrateurIMG/entreprise.jpeg' alt=''>
                                </div>
                                <div class='nomAdministrateurOffre'>"
                                    .$ligne['nom']."
                                </div>
                                <div class='supprimerOffre'>
                                    <button title='supprimer l\'offre'>
                                        <img src='../images/basket2.svg' alt=''>
                                    </button>
                                </div>
                                <hr>
                            </div>
                            <h4>" . $ligne['poste']  . "</h4>
                            <p>" . $ligne['description'] . "</p>
                            <p>" . $ligne['salaire'] . " $</p>
                            <p>" . $ligne['typeContrat'] . "</p>
                            <p>Finir le " . $ligne['dateFinOffre'] . "</p>
                        </div>
                        ";
                    }
                } else {
                    echo "Erreur d'exécution de la requête : " . mysqli_error($connexion);
                }
                ?>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const icone = document.getElementById('icone');
            const optionsList = document.getElementById('options');
            const hiddenInput = document.getElementById('hiddenInput');

            icone.addEventListener('click', function () {
                optionsList.style.display = optionsList.style.display === 'block' ? 'none' : 'block';
                icone.style.transform = icone.style.transform === 'rotate(-180deg)' ? 'rotate(0deg)' : 'rotate(-180deg)';
            });

            optionsList.addEventListener('click', function (event) {
                const selectedValue = event.target.dataset.value;
                hiddenInput.value = selectedValue;
                optionsList.style.display = 'none';
                icone.style.transform = 'rotate(0deg)';
            });
        });
    </script>
</body>
</html>