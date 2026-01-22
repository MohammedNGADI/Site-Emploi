<?php
    session_start();
    if(isset($_GET['id_candidat'])) {
    $id_candidat =  $_GET['id_candidat'];
    include('../ConnexionBD/connexion.php') ;  
    
    $requtte = "SELECT * FROM candidat where id_candidat = $id_candidat";
    $requtte2 = "SELECT * FROM profil_candidat where id_candidat = $id_candidat";
    $resultatProfil2 =  mysqli_query($connexion,$requtte2);
    $ligne2 = mysqli_fetch_row($resultatProfil2);


    if ($resultatProfil = mysqli_query($connexion,$requtte))
        {
            $ligne = mysqli_fetch_row($resultatProfil);
            $id_candidat = $ligne[0];
            $nom1 = $ligne[1];
            $prenom = $ligne[2];
            $dateNaissnace = $ligne[3];
            $genre = $ligne[4];
            $n_TelephoneC = $ligne[5];
            $ville = $ligne['6'];
            $adresse = $ligne['7'];
            $emailC = $ligne['8'];
            $posteC = $ligne['9'];
            $Password = $ligne['10'];
            $diplomes = $ligne2[2];
            $experiences = $ligne2[3];
            $competences = $ligne2[4];
            $langue1 = $ligne2[5];
            $langue2 = $ligne2[6];
            $langue3 = $ligne2[7];
            $CV = $ligne2[8];
            $_SESSION['CVCandidat'] = $CV ;
            $PhotoProfi = $ligne2[9];
            $PhotoArr = $ligne2[10];
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
    <link rel="icon" href="../SiteImages/administrateur/logoSiteEmploi2.jpg" type="image/jpg">

    <title><?php echo $nom1 . " " . $prenom ?></title>

</head>
<body>  
    <?php
        include 'enTete.php';
    ?>
    

    <div class="profilCadidat">
        <div class="conteneur" style="height: 500px;">
            <div class="imageArrierePlan" style="background-image: url('<?php echo $PhotoArr ?>');">
            </div>

            <div class="imageProfil">
                <form action="" id="profile-form" enctype="multipart/form-data" method="post">
                    <img src="<?php echo $PhotoProfi ?>" id="profile-pic" alt="photoProfil">  
                </form>
                <div class="infoPersonnel">
                    <div class="nomComplet"><?php echo $nom1 ." ".$prenom ?></div>
                    <div class="adresse"><?php echo $emailC ?></div>
                </div>
            </div>
        </div>


        <div class="conteneur coordonnees">
            <h2 class="titreCoordonnees">Coordonnées</h4>
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
                            <input type="text" name="Mn_Telephone" value="<?php  echo $n_TelephoneC ?>" readonly>
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
                            <input type="text" name="Mposte" value="<?php  echo $posteC ?>" readonly>
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
            <h2 class="titreCoordonnees">Données Profesionelles : </h4>
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
            <h2>CV</h2>
            <form class="ModificationCV">
                <table>
                    <tr>
                        <td colaps="2" style="display:flex; justify-content:center; align-items:center; padding:0">
                            <a href="afficherCV.php" class="afficherCV" target="_blank" style="display:flex; justify-content:center; align-items:center; height:60px;width:300px;background-color:lightblue;text-decoration:none;border-radius:5px">
                                Visualiser le CV
                            </a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <?php include '../footer/footer4.php'; 
} else{
    echo "NNoone";
}

?>


</body>
</html>



