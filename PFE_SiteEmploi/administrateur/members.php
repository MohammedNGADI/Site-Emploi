<?php
        include('enTete.php') ;
        include ('bareDeNavigationGauche.html'); 
    ?>
<?php include('../ConnexionBD/connexion.php') ;?>
<?php 
if (isset($_GET['recruteur']))
    {
        if (isset($_POST['recherche']) && isset($_POST['quiChercher']))
        {
            $motChercher = trim($_POST['recherche']) ;
            $quiChercher = trim($_POST['quiChercher']);
            
            
                if (isset($motChercher) && !empty($motChercher))
                {   
                    $requette2 = "SELECT nom, domaine ,derniereConnexion,description, email,id_entreprise,logo FROM entreprise WHERE nom LIKE '%$motChercher%'" ;
                    
                }
                else{
                    $requette2 = "select nom, domaine ,derniereConnexion ,description, email,id_entreprise, logo FROM entreprise" ;
                }
            if (isset($_GET['page']))
                    {
                        unset($_GET['page']);
                    }
        }
        else{
            $quiChercher = "recreteur";
            $requette2 = "SELECT nom, domaine ,derniereConnexion ,description, email,id_entreprise, logo FROM entreprise" ;

        }
        
    }
else {
        if (isset($_POST['recherche']) && isset($_POST['quiChercher']))
        {
            $motChercher = trim($_POST['recherche']) ;
            $quiChercher = trim($_POST['quiChercher']);
            if ($quiChercher== "condidat")
            {
                if (isset($motChercher) && !empty($motChercher))
                {   
                    $requette2 = "SELECT c.nom,c.prenom,c.poste,c.derniere_Connexion,c.email,c.id_candidat, p.photoProfil FROM `candidat` c NATURAL JOIN profil_candidat p WHERE nom LIKE '%$motChercher%' or prenom LIKE '%$motChercher%'" ;
                }
                else{
                    $requette2 = "SELECT c.nom,c.prenom,c.poste,c.derniere_Connexion,c.email,c.id_candidat, p.photoProfil FROM `candidat` c NATURAL JOIN profil_candidat p" ;
                }
            }
            if (isset($_GET['page']))
            {
                unset($_GET['page']);

            }
        }
        else{

                $quiChercher = "condidat";
                $requette2 = "SELECT c.nom,c.prenom,c.poste,c.derniere_Connexion,c.email,c.id_candidat, p.photoProfil FROM `candidat` c INNER JOIN profil_candidat p ON c.id_candidat = p.id_candidat WHERE 1" ;                
            }
}
$resultatsParPage = 6;

// Page actuelle (par défaut à la première page)
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calcul de l'offset pour la clause LIMIT
$offset = ($page - 1) * $resultatsParPage;

// Ajoutez la clause LIMIT à votre requête existante
$requette3 = $requette2 ;
$requette2 .= " LIMIT $offset, $resultatsParPage";


// Exécutez la requête
$resultats = $connexion->query($requette2);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/Administrateur/indexDesMembres.css">
    <title>EMPNEXUS-Membres</title>
</head>
<body>
   
    <div class="membre">
        <div class="nav_bar_admine">
            <form class="barsearch" action="" name="bareDeRecherche" method="POST">
                <div class="bareDeRecherche">
                    <div>
                        <input type="text" name="recherche" placeholder="Recherche..." title="chercher" <?php if (isset($motChercher)) {echo 'value = "'; echo $motChercher; echo '"';} ?>  size="40" class="inputRecherche" >
                    </div>
                    <div>
                        <button class="buttonRecherche" type="submit" title="click entrer"><i class='bx bx-search-alt-2'></i></button>
                    </div>
                </div>
               
                <div class="buttonRadio">
                    <input type="radio" name="quiChercher" id="condidat" value="condidat" <?php if($quiChercher == "condidat") echo "checked"; ?> >
                    <label for="condidat"><a href="members.php?page=1">Candidat</label></a>
                    <input type="radio" name="quiChercher" id="recreteur" value="recreteur" <?php if($quiChercher == "recreteur") echo "checked"; ?> >
                    <label for="recreteur"><a href="?recruteur=1&page=1">Recruteur</a></label>
                </div>
                <div id="buttonCacher">
                    <button class="buttonRecherche" type="submit"><i class='bx bx-search-alt-2'></i></button>
                </div>
            </form>
        </div>
        <h1 class="tirtre" <?php 
         if($result = mysqli_query($connexion, $requette3))
         {
                if (mysqli_num_rows($result)==0) 
                    echo "style='text-align: center;'";
        ?>> <?php 
           
                if (mysqli_num_rows($result) > 0)
                {
                    echo mysqli_num_rows($result);
                    if ($quiChercher == "condidat")
                    {
                        echo " candidats" ;
                    }
                    else{
                        echo " recruteurs";
                    }
                    if (isset($_POST['recherche']) && isset($_POST['quiChercher']))
                    {
                        if (!empty($motChercher))
                                echo " trouvées" ;
                    }
                    echo " :";
                }
                else{
                    echo "Aucun résultat<br>
                    <span class = 'acunResultat'>Essayez de raccourcir ou de reformuler votre recherche.</span>
                    ";
                }
               

            ?> 
            </h1>
        <div class="les_membres"> 
               
          <?php 
                
                if($result = mysqli_query($connexion, $requette2))
                {    
                        if ($quiChercher == "condidat")
                        {
                            while($ligne = mysqli_fetch_row($result))
                            {
                                echo "
                                        <div class='row'>
                                                
                                                <div class='cadre'>
                                                    <div class='imge_profile'>
                                                        <img src='$ligne[6]' alt='icone'>
                                                    </div>
                                                    <div class='info'>
                                                        <div><h5>$ligne[0] $ligne[1]</h5></div>
                                                        <div>$ligne[2]</div>
                                                    </div>
                                                    <div class='lien-profile'>
                                                        <a href='sessionMembre.php?idCandidat=$ligne[5]'>Voir profil
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-chevron-right' viewBox='0 0 16 16'>
                                                                <path fill-rule='evenodd' d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708'/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class='last_visit'>
                                                        <div><a href='mailto: $ligne[4]' title='envoyer un email'><img src='../SiteImages/administrateur/envelope-at-fill.svg' alt=''></a></div>
                                                        <div>
                                                        <button title='supprimer' class='suppprimerCondidat' value='$ligne[5]'>
                                                            <img src='../SiteImages/administrateur/basket2.svg' alt=''>
                                                        </button>
                                                    
                                                        </div>
                                                        <div>$ligne[3]</div>
                                                    </div>
                                                </div>
                                            </div>
                                    ";

                            }
                        }
                        else{
                            while($ligne = mysqli_fetch_row($result))
                            {
                                echo "
                                        <div class='row'>
                                            
                                                    <div class='cadre'>
                                                    <div class='imge_profile' style='background : white ;'>
                                                        <img src='$ligne[6]' alt='icone'>
                                                    </div>
                                                    <div class='info'>
                                                        <div><h5>$ligne[0]</h5></div>
                                                        <div>$ligne[1]</div>
                                                        <div><p class='description'>$ligne[3]</p></div>
                                                    </div>
                                                    <div class='lien-profile'>
                                                        <a href='sessionMembre.php?idRecruteur=$ligne[5]'>Voir profil
                                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-chevron-right' viewBox='0 0 16 16'>
                                                                <path fill-rule='evenodd' d='M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708'/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class='last_visit'>
                                                    <div><a href='mailto: $ligne[4]' title='envoyer un email: $ligne[4]'><img src='../SiteImages/administrateur/envelope-at-fill.svg' alt=''></a></div>
                                                    <div>
                                                    <button title='supprimer' class='suppprimerRecreteur' value='$ligne[5]'>
                                                        <img src='../SiteImages/administrateur/basket2.svg' alt=''>
                                                    </button>
                                                    </div>
                                                    <div>$ligne[2]</div>
                                                    </div>
                                                </div>
                                            </div>
                                ";

                            }
                        ?>
                            
        <?php
                        }

                }
                else{
                    echo mysqli_error($connexion);
                }
                    }
                    else{
                        echo mysqli_error($connexion);
                    }
                    
                
                    
                
            ?>
        </div>
        <div class="suivantPrecedant">
            <?php
                $nombreTotalDeResultats = $connexion->query("SELECT COUNT(*) FROM ($requette3) as count")->fetch_row()[0];
                $nombreDePages = ceil($nombreTotalDeResultats / $resultatsParPage);
                
                
                if ($page > 1) {
                    if ($quiChercher=="recreteur")
                    {
                        echo '<a href="?recruteur=1&page=' . ($page - 1) . '" id="pre">Précédent</a> ';
                    }
                    else{
                        echo '<a href="?page=' . ($page - 1) . '" id="pre" >Précédent</a> ';
                    }
                    
                }
                
                for ($i = 1; $i <= $nombreDePages; $i++) {
                    if ($quiChercher=="recreteur")
                    {
                        echo '<a href="?recruteur=1&page=' . $i . '">' . $i . '</a> ';
                    }
                    else{
                        echo '<a href="?page=' . $i . '">' . $i . '</a> ';
                    }
                    
                }
                
                if ($page < $nombreDePages) {
                    if ($quiChercher == "recreteur") {
                        echo '<a href="?recruteur=1&page=' . ($page + 1) . '" id="suiv">Suivant</a>';
                    } else {
                        echo '<a href="?page=' . ($page + 1) . '" id="suiv">Suivant</a>';
                    }
                }
                
                mysqli_close($connexion); 
            ?>

        </div>
        
    
        
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const urlParams = new URLSearchParams(window.location.search);

    // Vérifier si le paramètre "recreteur" est présent et a la valeur "true"
        if (urlParams.has('recreteur') && urlParams.get('recreteur') === 'true') {
        // Cocher la case correspondante
            document.getElementById('recreteur').checked = true;
        }

    const buttons1 = document.querySelectorAll('.suppprimerCondidat');
    const buttons2 = document.querySelectorAll('.suppprimerRecreteur');

    buttons1.forEach(button => {
        button.addEventListener('click', function () {
            if (confirm("Êtes-vous sûr de vouloir supprimer cet élément?")) {
                const id = this.value;

                    const xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                const response = JSON.parse(xhr.responseText);
                                if (response.reponse === "estSupprimer") {
                                    location.reload(true);
                                    alert("Le candidat a été supprimé avec succès");
                                }
                            } else {
                                console.error('Erreur de requête: ' + xhr.status);
                            }
                        }
                    };

                    xhr.open('GET', 'supprimerCondidat.php?idCondidat=' + id, true);
                    xhr.send();
            }
           
        });
    });

    buttons2.forEach(button => {
        button.addEventListener('click', function () {
            if (confirm("Êtes-vous sûr de vouloir supprimer cet élément?")) {
                const id = this.value;

                    const xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                const response = JSON.parse(xhr.responseText);
                                if (response.reponse === "estSupprimer") {
                                    location.reload(true);
                                    alert("Le recreteur a été supprimé avec succès");
                                }
                            } else {
                                console.error('Erreur de requête: ' + xhr.status);
                            }
                        }
                    };
                    xhr.open('GET', 'supprimerRecreteur.php?idRecreteur=' + id, true);
                    xhr.send();
            }
           
        });
    });
    
    });
// Récupérer les paramètres de l'URL



    </script>
    <script>
    const choix1 = document.getElementById('condidat');
    choix1.addEventListener('change', function () {
        // Utilisation de getElementsByClassName pour obtenir une liste d'éléments avec la classe 'buttonRecherche'
        // Supposons que vous souhaitez cliquer sur le premier élément de cette liste
        const boutonsRecherche = document.getElementsByClassName('buttonRecherche');
        if (boutonsRecherche.length > 0) {
            boutonsRecherche[0].click();
        }
    });
    const choix2 = document.getElementById('recreteur');
    choix2.addEventListener('change', function () {
        // Utilisation de getElementsByClassName pour obtenir une liste d'éléments avec la classe 'buttonRecherche'
        // Supposons que vous souhaitez cliquer sur le premier élément de cette liste
        const boutonsRecherche = document.getElementsByClassName('buttonRecherche');
        if (boutonsRecherche.length > 0) {
            boutonsRecherche[0].click();
        }
    });
</script>
</body>
</html>
<?php
include('../footer/footer.php') ;
?>