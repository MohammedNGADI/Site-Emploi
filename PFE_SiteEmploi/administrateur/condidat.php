<?php
        include 'enTete.php';
        include ('bareDeNavigationGauche.html');
    ?>
<?php
    $id_candidat = $_SESSION['id_candidat'];
    $email = $_SESSION['email'];
    include('../ConnexionBD/connexion.php') ;  
    
    $requtte = "SELECT * FROM candidat where id_candidat = $id_candidat";
    $requtte2 = "SELECT * FROM profil_candidat where id_candidat = $id_candidat";
    $resultatProfil2 =  mysqli_query($connexion,$requtte2);
    $ligne2 = mysqli_fetch_row($resultatProfil2);

    $formChoisi = "";

    if ($resultatProfil = mysqli_query($connexion,$requtte))
        {
            $ligne = mysqli_fetch_row($resultatProfil);
            $id_candidat = $ligne[0];
            $nom = $ligne[1];
            $prenom = $ligne[2];
            $dateNaissnace = $ligne[3];
            $genre = $ligne[4];
            $n_Telephone = $ligne[5];
            $ville = $ligne['6'];
            $adresse = $ligne['7'];
            $email = $ligne['8'];
            $poste = $ligne['9'];
            $Password = $ligne['10'];
            $diplomes = $ligne2[2];
            $experiences = $ligne2[3];
            $competences = $ligne2[4];
            $langue1 = $ligne2[5];
            $langue2 = $ligne2[6];
            $langue3 = $ligne2[7];
            $CV = $ligne2[8];
            $PhotoProfi = $ligne2[9];
            $PhotoArr = $ligne2[10];
        }
        $_SESSION['nom'] = $nom ;
        $_SESSION['prenom'] = $prenom ;
        $_SESSION['id_candidat'] = $id_candidat ;
        $_SESSION['CVAdministrateur'] = $CV ;
        

?>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
            // Traitement des données personnelles
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $_SESSION['email'] = $email;
            $sqlDonneesPersonnelles = "UPDATE candidat SET nom = '$nom', prenom = '$prenom', email = '$email' WHERE id_candidat = $id_candidat";
                    
            if ($connexion->query($sqlDonneesPersonnelles) === TRUE) {
                echo "Modification réussie";
            } else {
                echo "Erreur lors de la mise à jour des données personnelles : " . $connexion->error;
            }
        $connexion->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../CSS/Candidat/CandidatProfil.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title><?php echo $nom." ".$prenom ?></title>
    <style>
        .afficherCV{
            padding: 15px;
            color: black;
            text-decoration: none;
            background: #00caff91;
            border-radius: 15px;
            font-weight: 600;
        }
        .afficherCV:hover{
            text-decoration: none;
            color: black;
        }
        .arr-2{
            width: 30px;
        }
    </style>
</head>
<body>  
    
    <div class="FormPopUP">
        <div class="Quitter">
            <span style='font-size:40px;' class="cross">&#10006;</span>
        </div>
        <form class="fromDonneesPersonel">
            <h2 class="titreCoordonnees">Vos Coordonnées</h2>
            <table>
            <input type="hidden" name="formChoisi" value="DonneesPersonelles">
                <tr>
                    <td>
                        <label for="nom">Nom : </label>
                    </td>
                    <td>
                        <input type="text" id="nom" name="nom" value="<?php echo $nom ?>" >
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="prenom">Prénom : </label>
                    </td>
                    <td>
                        <input type="text" id="prenom" name="prenom" value="<?php echo $prenom ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email : </label>
                    </td>
                    <td>
                        <input type="text" id="email" name="email" value="<?php echo $email ?>">
                    </td>
                </tr>
            </table>
        </form>
    </div>  
    

    <div class="profilCadidat">
        <div class="conteneur" style="height: 500px;">
            <div class="imageArrierePlan" style="background-image: url('<?php echo $PhotoArr ?>');">
                <form action="" enctype="multipart/form-data" method="post">
                    <div class="uploadIcon">
                        <label for="photoArrierePlan" title="Modifier Votre Photo ArrièrePlan">
                            <i class='bx bx-upload'></i>
                        </label>
                    </div>    
                    <input type="file" class="photoArrierePlan" id="photoArrierePlan" style="display:none">
                </form>
            </div>

            <div class="imageProfil">
                <form action="" id="profile-form" enctype="multipart/form-data" method="post">
                    <img src="<?php echo $PhotoProfi ?>" id="profile-pic" alt="photoProfil">
                    <div class="uploadIconProfile">
                        <label for="photoProfil" title="Modifier Votre photo Profil">
                            <i class='bx bx-camera'></i>
                        </label>
                    </div>    
                    <input type="file" class="photoProfil" id="photoProfil" style="display:none">
                </form>
                <div class="infoPersonnel">
                    <div class="nomComplet"><?php echo $nom ." ".$prenom ?></div>
                    <div class="adresse"><?php echo $email ?></div>
                </div>
            </div>
            <script src="./ProfilCandidat.js"></script>
        </div>


        <div class="conteneur coordonnees">
            <h2 class="titreCoordonnees">Vos Coordonnées</h4>
            <form id="formCoordonnees" class="CoordonneesCandidat">
                <input type="hidden" name="formChoisi" value="Coordonnes">
                <table>
                    <tr>
                        <td>
                            <label for="">
                                Numéro de téléphone : 
                            </label>
                        </td>
                        <td>
                            <input type="text" name="Mn_Telephone" value="<?php  echo $n_Telephone ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                                Ville : 
                            </label>
                        </td>
                        <td>
                            <input type="text" name="Mville" value="<?php  echo $ville ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                                adresse : 
                            </label>
                        </td>
                        <td>
                            <textarea id="" name="Madresse"  cols="30" rows="10" style="width: 80%" readonly><?php  echo $adresse ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                                Poste : 
                            </label>
                        </td>
                        <td>
                            <input type="text" name="Mposte" value="<?php  echo $poste ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                                Date de naissance
                            </label>    
                        </td>
                        <td>
                            <input type="date" name="MdateNaissnace" value="<?php  echo $dateNaissnace ?>" readonly>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        <div class="conteneur doneesProfesionelles">
            <h2 class="titreCoordonnees">Vos Données Profesionelles : </h4>
            <form id="formDonneesProfessionnelles" class="CoordonneesCandidatProfessionnelles">
                <input type="hidden" name="formChoisi" value="Professionnelles">
                <table>
                    <tr>
                        <td>
                            <label for="">Diplômes : </label>
                        </td>
                        <td>
                            <textarea name="Pdiplomes" id="" cols="30" rows="10" style="width: 80%" readonly><?php  echo $diplomes ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                                Expériences : 
                            </label>    
                        </td>
                        <td>
                            <input type="text" name="Pexperiences" value="<?php  echo $experiences ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                                Compétences :
                            </label>    
                        </td>
                        <td>
                            <input type="text" name="Pcompetences" value="<?php  echo $competences ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                                Langue 1 : 
                            </label>    
                        </td>
                        <td>
                            <input type="text" name="PL1" value="<?php  echo $langue1?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                            Langue 2 : 
                            </label>    
                        </td>
                        <td>
                            <input type="text" name="PL2" value="<?php  echo $langue2?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                                Langue 3 : 
                            </label>    
                        </td>
                        <td>
                            <input type="text" name="PL3" value="<?php  echo $langue3?>" readonly>
                        </td>
                    </tr>
                </table>
            </form>
        </div>

        
        <div class="conteneur CV">
            <h2>Aperçu du CV</h2>
            <form class="ModificationCV">
                <table>
                    <tr>
                        <td>
                            <label for="">
                                 Accéder au CV en ligne : 
                            </label> 
                        </td>
                        <td>
                            <a href="afficherCV.php" class="afficherCV" target="_blank">
                                Visualiser le CV
                                <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                                </svg> 
                            </a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        

        
    </div>

    <?php include('../footer/footer.php') ;?>


</body>
</html>



