<?php
session_start();
include '../connexionBD/connexion.php';


if (isset($_POST['recherche']) && $_POST['recherche'] == "✓") {
  
    
    unset($_GET['page']);
    unset($_SESSION['supprimerSession']);
    $poste = $_POST['poste'];
   if(!empty($poste))
   {
        if(isset($GET['verifie']))
        {
            unset($_SESSION['idOffreAfficher']);
        }
            
        $query_recherche = "SELECT * FROM offreemploi WHERE poste LIKE ? LIMIT 1";
        $statement = $connexion->prepare($query_recherche);
        $poste2 = '%' . $poste . '%';
        $statement->bind_param("s", $poste2);
        $statement->execute();
        $result = $statement->get_result();
   }else{
        $query_recherche = "SELECT * FROM offreemploi  LIMIT 1";
        $statement = $connexion->prepare($query_recherche);
        $statement->execute();
        $result = $statement->get_result();
   }
}
else{
    $query_recherche = "SELECT * FROM offreemploi LIMIT 1";
    $statement = $connexion->prepare($query_recherche);
    $statement->execute();
    $result = $statement->get_result();
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>EMPNEXUS-Offres </title>
    <link rel="icon" href="../SiteImages/administrateur/logoSiteEmploi2.jpg" type="image/jpg">
    <link rel="stylesheet" href="../bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/index_css/index.css">
    <link rel="stylesheet" href="../CSS/index_css/CSSfooter.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>    
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen">	
    <link href="../CSS/index_css/offresCSS.css" rel="stylesheet">	
    <link href="../CSS/index_css/cssliste.css" rel="stylesheet">
    <link href="../CSS/index_css/RechrcheOffre.css" rel="stylesheet">


   
   
    <style>

.result-wrapper {
    max-width: 900px; 
    margin: 0 auto; 
}


    
    .pes{
        margin-top: 70px;
     }

     #lien{
            margin-left : 140px ;
           }
           #propos{
            margin-left : -90px ;
           }


           .buttonPosuler {
    background-color: #38b0bb; 
    border: none; 
    color: white; 
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 5px;
}

.buttonPosuler:hover {
    background-color: #38b0bb; 
}
.lien{
    color : black ;
    width:100% !important;
    height:100% !important;
}




        </style>
</head>
<body>
<header>
        <div class="logo">
            <a href="../INDEX.php">
                <img src="../SiteImages/indeximage/logo1.jpg"   class="logo-image" style="width: 70px; height: auto;">
            </a>
        </div>
        <ul class="menu">
            <li><a href="../INDEX.php#home">Acceuil</a></li>
            <li><a href="listeOffres2.php">Offres</a></li>
            <li><a href="index2.php">Espace recruteur</a></li>
            <li><a href="contact1.php">Contactez-nous </a></li>
            <li><a href="../INDEX.php#about_us">À propos</a></li>

            
        </ul>
        <a href="../Login/index.php" class="btn-connexion">Connexion</a>

        <div class="responsive-menu"></div>
</header>

<div class="pes">
    <div class="main-wrapper">
        <div class="second-search-result-wrapper">
            <div class="container" id="affciher">
             
                <form action="" method="POST" autocomplete="off">
                    <div class="second-search-result-inner">
                        
                        <span class="labeling">Rechercher</span>
                        <div class="row">
                            <div class="col-xss-12 col-xs-6 col-sm-6 col-md-10">
                                <div class="form-group form-lg">
                                    <input type="text" class="form-control" name="poste"  <?php if (isset($_POST['poste'])) echo "value='$poste'"; ?> >
                                </div>
                            </div>
                            <div class="col-xss-12 col-xs-6 col-sm-4 col-md-2">
                                <button type="submit" name="recherche" value="✓" class="recherchebtn btnOffre" class="btn btn-block" style="height:40px"><i class='bx bx-search-alt-2' style="height:40px"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

 








<?php if (!empty($poste) || isset($_SESSION['idOffreAfficher'])): ?>  
<div class="job-item-list">
<?php
        if ( isset($_SESSION['idOffreAfficher']) ){
            
            $query_recherche = "SELECT * FROM offreemploi WHERE id_offre LIKE ? LIMIT 1";
            $statement = $connexion->prepare($query_recherche);

            
            $statement->bind_param("i", $_SESSION['idOffreAfficher']);
            $statement->execute();

    
            $result = $statement->get_result();
            unset($_SESSION['idOffreAfficher']);
        } 
        ?> 
    <div class="content">
        <?php if ($result->num_rows > 0): 
             while ($ligne = mysqli_fetch_assoc($result)): ?>
                <div class="job-item-list-info">
                    <div class="row">
                        <div class="col-sm-7 col-md-8">
                            <h3 class="heading"><?php echo $ligne['poste']; ?></h3>
                            <p class="texing character_limit"><?php echo $ligne['description']; ?><br></p>
                            <div class="meta-div clearfix mb-25">
                            </div>
                        </div>
                        <div class="col-sm-5 col-md-4">
                            <ul class="meta-list">
                                <li><span>Date Publication: </span><?php echo $ligne['datePublication']; ?></li>
                                <li><span>Date Fin Offer: </span><?php echo $ligne['dateFinOffre']; ?></li>
                                <li><span>Salaire: </span><?php echo $ligne['dateFinOffre']; ?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="job-item-list-bottom">
                        <div class="row">
                            <div class="col-sm-7 col-md-8">
                                <div class="sub-category">
                                    <ul class="meta-list">
                                        <li><span>Type de contrat : </span><?php echo $ligne['typeContrat']; ?></li>
                                        <li><span>Competences: </span><?php echo $ligne['competences']; ?></li>
                                        <li><span>Experiences: </span><?php echo $ligne['experiences']; ?></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-4">
                                <a target="_blank" href="../Login/index.php" class="btn btn-primary">Postuler</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Aucune poste trouvée</p>
        <?php endif; ?>
        <div class="pager-wrapper">
            <ul class="pager-list">
            </ul>   
        </div>
    </div>
</div>
<?php endif; ?>







    







<div class="recherchePage">
    <?php
    // Vérifier si la connexion est établie
    if (isset($connexion)) {
        $resultatsParPage = 6;

            $page = isset($_GET['page']) ? $_GET['page'] : 1;

            $offset = ($page - 1) * $resultatsParPage;
        if(isset($poste)) {
            $query_recherche = "SELECT * FROM offreemploi WHERE poste LIKE ";
            $poste2 = '%' . $poste . '%';
            $requette3 = $query_recherche."'$poste2'";
            $query_recherche .= "? LIMIT $offset, $resultatsParPage";
            $statement = $connexion->prepare($query_recherche);
            
            $statement->bind_param("s", $poste2); // Lier le paramètre à la valeur
            $statement->execute();
            $result_Rechrche = $statement->get_result();
            }else{
                $sql_recherche = "SELECT * FROM offreemploi";
                $requette3 = $sql_recherche;
                $sql_recherche .= " LIMIT $offset, $resultatsParPage";
                $result_Rechrche = $connexion->query($sql_recherche);
            }
            
        // Vérifier s'il y a des résultats
        if ($result_Rechrche && $result_Rechrche->num_rows > 0) {
            if(!isset($poste) || empty($poste))
            {
                echo "<div class='NbrOffreTouve'>Offres d'emploi :</div>";
                
            }
            else{
                echo "<div class='NbrOffreTouve'>Résultats trouvés :</div>";
            }
            

            // Afficher les résultats de la recherche
            while ($row_offre = $result_Rechrche->fetch_assoc()) {
                // Récupération id_entreprise
                $id_entreprise = $row_offre["id_entreprise"];
                // Nouvelle requête pour récupérer le nom de l'entreprise
                $sql_nom_entreprise = "SELECT nom, logo FROM entreprise WHERE id_entreprise = $id_entreprise";
                $result_nom_entreprise = $connexion->query($sql_nom_entreprise);
                $row_nom_entreprise = $result_nom_entreprise->fetch_assoc();
                $nom_entreprise = $row_nom_entreprise["nom"];
                $logo = $row_nom_entreprise["logo"];

                // Affichage des détails de l'offre
                $poste = $row_offre["poste"];
                $description = $row_offre["description"];
                $datePublication = $row_offre["datePublication"];
                $dateFinOffre = $row_offre["dateFinOffre"];
                $competences = $row_offre["competences"];
                $typeContrat = $row_offre["typeContrat"];
                $id_offre = $row_offre["id_offre"];
                ?>
                <div class="offresRecruteur" data-id-offre="<?php echo $id_offre ?>">
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
                            <p class="date"><?php echo $datePublication ?><b class="NomEntreprise"><?php echo $nom_entreprise ?></b></p>
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
    
    ?>
<script>
        document.addEventListener("DOMContentLoaded", function () {
        var offresRecruteur = document.querySelectorAll('.offresRecruteur');         
        offresRecruteur.forEach(function(offresRecruteur) {
            offresRecruteur.addEventListener('click', function() {
                // Récupérer l'ID de l'offre
                var idOffre = this.getAttribute('data-id-offre');

                // Utilisez AJAX pour envoyer les données au serveur et créer une session
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            const response = JSON.parse(xhr.responseText);
                            if (response.reponse === "estSupprimer") {
                                window.location.reload(true);
                            }

                        } else {
                            
                        }
                    }
                };
                xhr.open('POST', 'create_session.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('id=' + idOffre);
            });
            window.scrollTo(0, 0);                
 
        });
    });
</script>
</div>


<div class="suivantPrecedant">
            <?php
                $nombreTotalDeResultats = $connexion->query("SELECT COUNT(*) FROM ($requette3) as count")->fetch_row()[0];
                $nombreDePages = ceil($nombreTotalDeResultats / $resultatsParPage);
                
                if ($page > 1) {
                        echo '<a href="?recruteur=1&page=' . ($page - 1) . '" id="pre">Précédent</a> ';             
                }
                for ($i = 1; $i <= $nombreDePages; $i++) {
                        echo '<a href="?page=' . $i . '">' . $i . '</a> ';
                }
                if($page<$nombreDePages)
                {
                    echo '<a href="?page=' . ($page + 1) . '" id="suiv" >Suivant</a> '; 
                }
                mysqli_close($connexion); 
            ?>

        </div>












  
   
<?php
    include '../footer/footer2.php';
?>
                    



</body>
</html>