<?php
    session_start();
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
        

?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérification des champs
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];

    if (empty($nom) || empty($prenom) || empty($email)) {
        $response = "Veuillez remplir tous les champs";
    } else {
        // Traitement des données personnelles
        session_start();
        $id_candidat = $_SESSION['id_candidat'];
        $_SESSION['email'] = $email;

        $sqlDonneesPersonnelles = "UPDATE candidat SET nom = '$nom', prenom = '$prenom', email = '$email' WHERE id_candidat = $id_candidat";

        if ($connexion->query($sqlDonneesPersonnelles) === TRUE) {
            $response = "Modification réussie";
        } else {
            $response = "Erreur lors de la mise à jour des données personnelles : " . $connexion->error;
        }
    }
    // Envoyer la réponse
    echo $response;
    $connexion->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../SiteImages/administrateur/logoSiteEmploi2.jpg" type="image/jpg">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../CSS/Candidat/CandidatProfil.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>EMPNEXUS-Mon Profil</title>

</head>
<body>  
    <?php
        include 'enTete.php';
    ?>
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
                        <input type="text" id="nom" name="nom" value="<?php echo $nom ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="prenom">Prénom : </label>
                    </td>
                    <td>
                        <input type="text" id="prenom" name="prenom" value="<?php echo $prenom ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email : </label>
                    </td>
                    <td>
                        <input type="text" id="email" name="email" value="<?php echo $email ?>" required>
                    </td>
                </tr>
            </table>
            <button type="submit" class="btnSubmitCoordonnées" id="DPers">Modifier</button>
        </form>
    </div>
    
    <div class="notificationDP">
        <h3>Modification réussie</h3>
        <p>Veuillez patienter...</p>
    </div>
    

    <div class="profilCadidat">
        <div class="conteneur" style="height: 500px;">
            <div class="imageArrierePlan" style="background-image: url('<?php echo $PhotoArr ?>');">
                <form action="" enctype="multipart/form-data" method="post">
                    
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

            <button class="BtnAfficheForm" title="Modifier Vos données personelles">
                <i class='bx bxs-edit' id="edit"></i>
            </button>
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
                            <input type="text" name="Mn_Telephone" value="<?php  echo $n_Telephone ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                                Ville : 
                            </label>
                        </td>
                        <td>
                            <input type="text" name="Mville" value="<?php  echo $ville ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                                adresse : 
                            </label>
                        </td>
                        <td>
                            <textarea  name="Madresse"  cols="30" rows="10" style="width: 80%" required><?php  echo $adresse ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                                Poste : 
                            </label>
                        </td>
                        <td>
                            <input type="text" name="Mposte" value="<?php  echo $poste ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                                Date de naissance
                            </label>    
                        </td>
                        <td>
                            <input type="date" name="MdateNaissnace" value="<?php  echo $dateNaissnace ?>" required>
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btnSubmitCoordonnées">Modifier</button>
            </form>
        </div>
        <div class="notificationC">
            <h3>Modification des coordonnées réussie</h3>
            <p>Veuillez patienter...</p>
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
                            <textarea name="Pdiplomes" id="" cols="30" rows="10" style="width: 80%" required><?php  echo $diplomes ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                                Expériences : 
                            </label>    
                        </td>
                        <td>
                            <input type="text" name="Pexperiences" value="<?php  echo $experiences ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                                Compétences :
                            </label>    
                        </td>
                        <td>
                            <input type="text" name="Pcompetences" value="<?php  echo $competences ?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                                Langue 1 : 
                            </label>    
                        </td>
                        <td>
                            <input type="text" name="PL1" value="<?php  echo $langue1?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                            Langue 2 : 
                            </label>    
                        </td>
                        <td>
                            <input type="text" name="PL2" value="<?php  echo $langue2?>" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                                Langue 3 : 
                            </label>    
                        </td>
                        <td>
                            <input type="text" name="PL3" value="<?php  echo $langue3?>">
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btnSubmitCoordonnées">Modifier</button>
            </form>
        </div>
        <div class="notificationDP">
            <h3>Modification des données Professionnelles réussie</h3>
            <p>Veuillez patienter...</p>
        </div>

        <div class="notificationCV">
            <h3>CV Modifié</h3>
            <p>Veuillez patienter...</p>
        </div>
        <div class="conteneur CV">
            <h2>Votre CV</h2>
            <form class="ModificationCV">
                <table>
                    <tr>
                        <td>
                            <label for="">
                                Vous Choisissez un CV : 
                            </label> 
                        </td>
                        <td>
                            <input type="file" class="CVinput" name="CVFile">
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btnSubmitCoordonnées">Modifier</button>
            </form>
        </div>
        

        <div class="notificationOldPasswordIncorrect">
            <h3>Erreur : Ancien mot de passe incorrect</h3>
            <p>Veuillez vérifier l'exactitude de votre ancien mot de passe et réessayer.</p>
        </div>

        <div class="notificationOldPasswordIncorrect" id="PasswordsNotIdentique" style="width:max-content">
            <h3>Erreur de validation du mot de passe</h3>
            <p>Veuillez vérifier les informations saisies et réessayer.</p>
        </div>

        <div class="conteneur MotDePasse">
            <h2>Modifier Votre Mot de passe</h2>
            <form class="ModificationPassword">
                <table>
                    <tr>
                        <td>
                            <label for="">
                                Votre ancien mot de passe : 
                            </label> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" name="oldPassword">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                                Votre nouveau mot de passe : 
                            </label> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" name="newPassword">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="">
                                Confirmer votre nouveau mot de passe : 
                            </label> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" name="newPasswordConfirm">
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btnSubmitCoordonnées">Modifier</button>
            </form>
        </div>
    </div>
    <div class="notificationPasswordUpdated">
        <h3>Mot de passe Modifié</h3>
        <p>Veuillez patienter...</p>
    </div>

    <?php include '../footer/footer4.php'; ?>


</body>
</html>



