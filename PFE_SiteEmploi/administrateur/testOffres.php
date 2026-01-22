<?php 
        include('enTete.php') ;
        include ('bareDeNavigationGauche.html'); 
    ?>
<?php include('../ConnexionBD/connexion.php') ;?>
<?php


 if ((isset($_POST['recherche']) && isset($_POST['valuerSelectionner'])))
 {
    
        unset($_GET['page']);
        $entrepriseChercher = trim($_POST['valuerSelectionner']);
        $motCle = trim($_POST['recherche']);
    
    if (!empty($motCle))
    {
        if ($entrepriseChercher == "Tous les entreprises")
        {
            $sql = "SELECT  e.nom , o.poste, e.ville, o.dateFinOffre , o.id_offre, e.logo
                    FROM offreemploi o INNER JOIN entreprise e
                    ON e.id_entreprise = o.id_entreprise
                    WHERE o.poste LIKE '%$motCle%'";
            $condition = "WHERE o.poste LIKE '%$motCle%'";
        }
        else{
            $sql = "SELECT  e.nom , o.poste, e.ville, o.dateFinOffre , o.id_offre , e.logo
                    FROM offreemploi o INNER JOIN entreprise e
                    ON e.id_entreprise = o.id_entreprise
                    WHERE o.poste LIKE '%$motCle%' AND e.nom = '$entrepriseChercher'";
            $condition = "WHERE o.poste LIKE '%$motCle%' AND e.nom = '$entrepriseChercher'";
        }
        
    }
    else
    {
        
        if ($entrepriseChercher == "Tous les entreprises")
        {
           $sql = "SELECT  e.nom , o.poste, e.ville, o.dateFinOffre , o.id_offre, e.logo
                    FROM offreemploi o INNER JOIN entreprise e
                    ON e.id_entreprise = o.id_entreprise";
        }
        else{
            $sql = "SELECT  e.nom , o.poste, e.ville, o.dateFinOffre , o.id_offre, e.logo
                    FROM offreemploi o INNER JOIN entreprise e
                    ON e.id_entreprise = o.id_entreprise
                    WHERE e.nom = '$entrepriseChercher'"; 
            $condition = "WHERE e.nom = '$entrepriseChercher'";
        }
    }
   
}

 else{
    if((isset($_GET['motCle']) && isset($_GET['selection'])))
    {
        $entrepriseChercher = trim($_GET['selection']);
        $motCle = trim($_GET['motCle']);
        if (!empty($motCle))
        {
            if ($entrepriseChercher == "Tous les entreprises")
            {
                $sql = "SELECT  e.nom , o.poste, e.ville, o.dateFinOffre , o.id_offre , e.logo
                        FROM offreemploi o INNER JOIN entreprise e
                        ON e.id_entreprise = o.id_entreprise
                        WHERE o.poste LIKE '%$motCle%'";
                $condition = "WHERE o.poste LIKE '%$motCle%'";
            }
            else{
                $sql = "SELECT  e.nom , o.poste, e.ville, o.dateFinOffre , o.id_offre, e.logo
                        FROM offreemploi o INNER JOIN entreprise e
                        ON e.id_entreprise = o.id_entreprise
                        WHERE o.poste LIKE '%$motCle%' AND e.nom = '$entrepriseChercher'";
                $condition = "WHERE o.poste LIKE '%$motCle%' AND e.nom = '$entrepriseChercher'";
            }
        }
   }
   else{
    $sql = "SELECT  e.nom , o.poste, e.ville, o.dateFinOffre , o.id_offre, e.logo
    FROM offreemploi o INNER JOIN entreprise e
    ON e.id_entreprise = o.id_entreprise"; 
   }
   
 }

 $resultatsParPage = 6;

// Page actuelle (par défaut à la première page)
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calcul de l'offset pour la clause LIMIT
$offset = ($page - 1) * $resultatsParPage;

// Ajoutez la clause LIMIT à votre requête existante
$requette3 = $sql ;
$sql .= " LIMIT $offset, $resultatsParPage";


// Exécutez la requête
$resultats = $connexion->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Administrateur/testOffresCSS.css">

    <title>EMPNEXUS-Offres</title>
    <style>
        #supprimerOffre button{
            background: red;
            border: none; 
        }
    </style>
</head>
<body>

            <div class="menuDeroulant">
                <div class="offreBareDeRecherche">
                    <form action="" class="offreBareDeRechercheForm" method="post">
                        <div class="bareDeRechercheOffre">
                            <div>
                                <input type="text" placeholder="Recherche..." title="chercher"  size="40" class="inputRecherche" name="recherche" <?php if (isset($motCle)) echo "value='$motCle'";?>>
                            </div>
                            <div>
                                <button class="buttonRecherche" type="submit" title="click entrer"><i class='bx bx-search-alt-2'></i></button>
                            </div>
                        </div>
                        <div class="divOptionSelectionneeOffre">
                            <?php 
                                $requette = "SELECT nom FROM entreprise";
                                if (!$result = mysqli_query($connexion , $requette)){
                                echo mysqli_error() ;
                                }
                                else{
                                    if ($ligne = mysqli_fetch_row($result))
                                    {
                                ?>
                            <input type="text" class="optionSelectionnee" value="<?php if (isset($entrepriseChercher)) echo $entrepriseChercher; else echo 'Tous les entreprises';?>" id="hiddenInput" name="valuerSelectionner" readonly>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16" id="icone">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>  
                            </svg>
                        </div>
                        <div class="divOptions" id="customDropdown">
                            <ul class="options" id="options">
                                <li data-value= "Tous les entreprises" >Tous les entreprises</li>
                                <?php
                                echo "<li data-value= '".$ligne[0]."' >".$ligne[0]."</li>";
                                while ($ligne = mysqli_fetch_row($result))
                                {
                                    echo "<li data-value= '".$ligne[0]."' >".$ligne[0]."</li>";
                                }
                                    }
                                else
                                {
                                    echo mysqli_error();
                                } 
                                 }
                                ?>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
    <div class="lesDeuxPages">
        <div class="offres">
            <?php 
                 if ($result = mysqli_query($connexion, $requette3)) {
                    if (mysqli_num_rows($result)==0) 
                    {
                        echo "<h4 style='text-align: center;'>Aucun résultat<br>
                        <span class = 'acunResultat'>Essayez de raccourcir ou de reformuler votre recherche.</span></h4>";
                    }
                    else{
                        echo "<h1 class = 'nombreOffre'>" . mysqli_num_rows($result) . " offres ";
                        if (!empty($motCle))
                        {
                            echo " trouvées " ;
                        }
                        echo ":</h1>";
                        echo "<div class='pageOffres'>";
                        $result = mysqli_query($connexion, $sql);
                        while ($ligne = mysqli_fetch_assoc($result)) {
                            echo "
                            <div class='uneOffre'>
                            <div class='profileOffre'>
                                <div class='imageProfileOffre'>
                                    <img src='".$ligne['logo']."' alt='' style='background:white;'>
                                </div>
                                <div class='nomAdministrateurOffre'>"
                                    .$ligne['nom']."
                                </div>
                                <div class='supprimerOffre'>
                                    <button title='supprimer cet offre' class='buttonSupprimerOffre' value='".$ligne['id_offre']."'>
                                        <img src='../SiteImages/administrateur/basket2.svg' alt=''>
                                    </button>
                                </div>
                                <hr>
                            </div>
                            <div class ='poste'>" . $ligne['poste']  . "</div>
                            <div class = 'ville'>" . $ligne['ville'] . " - Maroc</div>
                            <div class ='dateFinOffre'>Publié le " . $ligne['dateFinOffre'] . "</div>
                            <div class ='idOffre'> " . $ligne['id_offre'] . "</div>
    
                        </div>
                            ";
                        }
                    } 
                    }else {
                        echo "Erreur d'exécution de la requête : " . mysqli_error($connexion);
                    }
            ?>
            </div>
                <div class="suivantPrecedant">
                <?php
                    $nombreTotalDeResultats = $connexion->query("SELECT COUNT(*) FROM ($requette3) as count")->fetch_row()[0];
                    $nombreDePages = ceil($nombreTotalDeResultats / $resultatsParPage);
                        if ((isset($_POST['recherche']) && isset($_POST['valuerSelectionner'])) || (isset($_GET['motCle']) && isset($_GET['selection'])))
                        {
                            if(isset($_GET['motCle']) && isset($_GET['selection']))
                            {
                                for ($i = 1; $i <= $nombreDePages; $i++) {
                                    if ($i == 1)
                                    {
                                        echo '<div><a href="?motCle='.$_GET['motCle'].'&selection='.$_GET['selection'].'&page=' . $i . '">' . $i . '</a></div> ';
                                    }
                                    else{
                                        echo '<div class = "none" ><a href="?motCle='.$_GET['motCle'].'&selection='.$_GET['selection'].'&page=' . $i . '"  >' . $i . '</a></div> ';
                                    }
                                }
                            }
                            else{
                                for ($i = 1; $i <= $nombreDePages; $i++) {
                                    if ($i == 1)
                                        echo '<div><a href="?motCle='.$_POST['recherche'].'&selection='.$_POST['valuerSelectionner'].'&page=' . $i . '">' . $i . '</a></div> ';
                                    else
                                        echo '<div class = "none" ><a href="?motCle='.$_POST['recherche'].'&selection='.$_POST['valuerSelectionner'].'&page=' . $i . '" >' . $i . '</a></div> ';

                                }
                            }
                            
                        }
                        else{
                            for ($i = 1; $i <= $nombreDePages; $i++) {
                                if ($i == $page)
                                {
                                    echo '<div ><a href="?page=' . $i . '">' . $i . '</a></div> ';
                                }
                                else{
                                    echo '<div class = "none" ><a href="?page=' . $i . '">' . $i . '</a></div> ';
                                }
                                
                            }
                        }

                    
                ?>

            </div>
        </div>
        <?php 
        if (isset($condition))
        {
            $sql = "SELECT  e.nom , o.poste, e.ville, o.dateFinOffre , o.description
                    , o.competences, o.datePublication , o.typeContrat , o.salaire
                    , o.experiences, e.logo
                    FROM offreemploi o INNER JOIN entreprise e
                    ON e.id_entreprise = o.id_entreprise ".$condition." LIMIT ".$offset.", ". $offset+1 ." ";
        }
        else{
            $sql = "SELECT  e.nom , o.poste, e.ville, o.dateFinOffre , o.description
                    , o.competences, o.datePublication , o.typeContrat , o.salaire
                    , o.experiences, o.id_offre, e.logo 
                    FROM offreemploi o INNER JOIN entreprise e
                    ON e.id_entreprise = o.id_entreprise LIMIT $offset,". $offset+1 ." ";
        }
            

            if ($result = mysqli_query($connexion, $sql)) {
                $ligne = mysqli_fetch_row($result) ?>
                
        <div class="offreAffiche">
                 <div class='profileOffre'>
                    <div class='imageProfileOffre' >
                        <img src='<?php echo $ligne[11] ;?>' alt='' style='background:white;' id="imageRecruteur">
                    </div>
                    <div class='nomAdministrateurOffre' id="nom">
                        <?php echo $ligne[0] ;?>
                    </div>
                    <div class='supprimerOffre'>
                        <button title='supprimer cet offre' class= 'buttonSupprimerOffre' id='btnSupprimerOffre' value="<?php echo $ligne[10] ;?>">
                            <img src='../SiteImages/administrateur/basket2.svg' alt=''>
                        </button>
                    </div>
                </div>
                <h1 id="titreOffre"><?php echo $ligne[1] ;?></h1>
                <div id="villeEtDatePublication"><?php echo $ligne[2]." publié le ".$ligne[6] ;?></div>
               
                <h5>Description de poste:</h5>
                <div id="description">
                    <?php echo $ligne[4] ;?>
                </div>
                <h5>Compétences demandées : </h5>
                <div id="competences">
                    <?php echo $ligne[5] ;?>
                </div>
                <h5>Experiences demandées : </h5>
                <div id="experiences">
                    <?php echo $ligne[9] ;?>
                </div>
                <div id="salaire">
                    <b>Salaire :</b> <?php echo $ligne[8]."$" ;?> 
                </div>
                <div id="contrat">
                    <b>Contrat de l'offre :</b> <?php echo $ligne[7] ;?>
                </div>
                <div id="dateDeFin">
                    Fin de poste : <?php echo $ligne[3] ;?>
                </div>
                <?php
                }
            else{
                echo "erreur Mysql : ".mysqli_error($connexion);
            }
            mysqli_close($connexion);
        ?>
                
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const icone = document.getElementById('icone');
        const optionsList = document.getElementById('options');
        const hiddenInput = document.getElementById('hiddenInput');
        const formulaire = document.querySelector('.offreBareDeRechercheForm'); // Sélectionnez le formulaire

        icone.addEventListener('click', function () {
            optionsList.style.display = optionsList.style.display === 'block' ? 'none' : 'block';
            icone.style.transform = icone.style.transform === 'rotate(-180deg)' ? 'rotate(0deg)' : 'rotate(-180deg)';
        });

        optionsList.addEventListener('click', function (event) {
            const selectedValue = event.target.dataset.value;
            hiddenInput.value = selectedValue;
            optionsList.style.display = 'none';
            icone.style.transform = 'rotate(0deg)';

            formulaire.submit();
        });
    });
</script>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const divs = document.querySelectorAll('.uneOffre');

        divs.forEach(function (maClasse) {
        maClasse.addEventListener('click', function () {
            const sousDivValue = maClasse.querySelector('.idOffre').textContent;
            var image = document.getElementById("imageRecruteur");
            const id = sousDivValue ;

            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        const reponse = JSON.parse(xhr.responseText);
                        document.getElementById('btnSupprimerOffre').value = id ;
                        document.getElementById('nom').innerHTML =  reponse.nom;
                        document.getElementById('villeEtDatePublication').innerHTML =  reponse.ville + " publié le " + reponse.datePublication;
                        document.getElementById('titreOffre').innerHTML =  reponse.poste;
                        document.getElementById('description').innerHTML =  reponse.description ;
                        document.getElementById('salaire').innerHTML = "<b>Salaire : </b>" + reponse.salaire + "$";
                        document.getElementById('competences').innerHTML =  reponse.competences;
                        document.getElementById('contrat').innerHTML =  "<b>Contrat de l'offre : </b>" + reponse.contrat;
                        document.getElementById('experiences').innerHTML =  reponse.experiences;
                        document.getElementById('dateDeFin').innerHTML = "Fin de poste : " + reponse.dateDeFin ;
                        image.setAttribute("src", reponse.logo);


                    } else {
                        console.error('Erreur de requête: ' + xhr.status);
                    }
                }
            };
            xhr.open('GET', 'selectionnerUneOffre.php?idOffre=' + sousDivValue, true);
            xhr.send();
        });
    });
});
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const hiddenInput = document.getElementById('hiddenInput');
    const boutonRecherche = document.querySelector('.buttonRecherche');

    hiddenInput.addEventListener('input', function () {
        // Si vous souhaitez déclencher le clic du bouton lorsqu'une modification est apportée à hiddenInput
        if (boutonRecherche) {
            boutonRecherche.click();
        }
    });
});

    </script>
    <script>
          document.addEventListener("DOMContentLoaded", function () {
            const buttons1 = document.querySelectorAll('.buttonSupprimerOffre');

            buttons1.forEach(button => {
                button.addEventListener('click', function () {
                    
                    if (confirm("Êtes-vous sûr de vouloir supprimer cet offre ? ")) {
                        const id = this.value;
                            const xhr = new XMLHttpRequest();
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === 4) {
                                    if (xhr.status === 200) {
                                        const response = JSON.parse(xhr.responseText);
                                        if (response.reponse === "estSupprimer") {
                                            location.reload(true);
                                            alert("L'offre a été supprimé avec succès");
                                        }
                                    } else {
                                        console.error('Erreur de requête: ' + xhr.status);
                                    }
                                }
                            };

                            xhr.open('GET', 'supprimerOffre.php?idOffre=' + id, true);
                            xhr.send();
                    }
                
                });
            });
        });

    </script>
    
</body>
</html>
<?php
include('../footer/footer.php') ;
?>