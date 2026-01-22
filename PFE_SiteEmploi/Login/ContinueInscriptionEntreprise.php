<?php
session_start();
include '../ConnexionBD/connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['Nom'];
    $numTete = $_POST['numTete'];
    $dateFondation = $_POST['dateFondation'];
    $ville = $_POST['Ville'];
    $adresse = $_POST['Adresse'];
    $domaine = $_POST['Domaine'];
    $siteWeb = $_POST['siteWeb'];
    $description = $_POST['description'];
    $email = $_SESSION['register'];

    $repertoire = '../EntLogo/' . $nom;
    try {
        if (!file_exists($repertoire)) {
            mkdir($repertoire);
        } else {
            rmdir($repertoire);
            mkdir($repertoire);
        }
        echo "Répertoire créé avec succès : $repertoire";
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
    $cheminPhotoProfil = $repertoire . '/' . $_FILES['PhotoP']['name'];

    if (move_uploaded_file($_FILES['PhotoP']['tmp_name'], $cheminPhotoProfil)) {
        // Requête d'insertion des données dans la table entreprise
        $sql = "UPDATE entreprise 
                SET nom = '$nom', n_telephone = '$numTete', ville = '$ville', adresse = '$adresse', 
                description = '$description', domaine = '$domaine', site_web = '$siteWeb', 
                anneeDeFondation = '$dateFondation', logo = '$cheminPhotoProfil' 
                WHERE email = '$email'";

        if ($connexion->query($sql) === TRUE) {
            $_SESSION['email'] = $email ; 
            header('Location: ../Recruteur/index.php');
            exit();
        } else {
            echo "Erreur lors de la mise à jour des données : " . $connexion->error;
        }
    } else {
        echo "Erreur lors du téléchargement de la photo de profil.";
    }

    // Fermeture de la connexion
    $connexion->close();
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMPNEXUS-Inscription</title>
    <link rel="icon" href="../SiteImages/administrateur/logoSiteEmploi2.jpg" type="image/jpg">
    <link rel="stylesheet" href="../CSS/continueinscription.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        span.erreur{
            position: relative;
            left: 50px;
            color: red;
            font-size: smaller;
            display: none;
        }
    </style>

</head>
<body>
    <header>
        <div class="logo">
            <a href="../INDEX.php">
                <img src="../SiteImages/RecruteurImgs/logo2.jpg"  class="logo-image">
            </a>
        </div>
        <ul class="menu">
            <li><a href="../INDEX.php">Acceuil</a></li>
            <li><a href="../index_page/listeOffres2.php">Offres</a></li>
            <li><a href="../index_page/index2.php">Espace recruteur</a></li>
            <li><a href="../index_page/contact1.php">Contact nous </a></li>
            <li><a href="../INDEX.php#about_us">à propos</a></li>
            
        </ul>
        <div class="responsive-menu"></div>
    </header>
    <div class="titre">
        Continuer Votre inscription 
    </div>
    <div class="conteneur">
        <form action="./ContinueInscriptionEntreprise.php" id="inscriptionForm" class="ContinueInscForm" method="POST" enctype="multipart/form-data">
            <div class="DonneesPersonelles">
                <table>
                    <tr>
                        <td>
                            <label for="Nom"> Nom  : </label>
                        </td>
                        <td>
                            <input type="text" name="Nom" class="Nom" id="Nom" required> <br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="numTete"> Numero du Téléphone  : </label>
                        </td>
                        <td>
                            <input type="text" name="numTete" class="numTete" id="numTete" required> <br>
                            <span class='erreur'>Veuillez entrer un numéro de téléphone valide.</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="dateFondation"> Date de Fondation : </label>
                        </td>
                        <td>
                            <input type="date" name="dateFondation" class="dateFondation" id="dateFondation" required> <br>
                        </td>
                    </tr>
                    
                </table>
            </div>

            <div class="Logo">
                <p>votre Logo :</p>
                <img src="../SiteImages/login/user-profile-man.jpg" alt="" id="profile-pic" class="PhotoP">
                <input type="file" name="PhotoP" id="PhotoP" class="PhotoPinput" accept="image/jpeg, image/jpg, image/png" required> 
                <label for="PhotoP" class="LogoLabel"><i class='bx bx-upload'></i></label>         
            </div>

            <script>
                // Sélection de l'élément avec la classe LogoLabel
                const logoLabel = document.querySelector('.LogoLabel');
                const PhotoP = document.querySelector('.PhotoP');

                // Ajout d'un gestionnaire d'événements pour le survol de l'élément
                PhotoP.addEventListener('mouseover', function() {
                    // Afficher l'élément en changeant la classe
                    logoLabel.classList.add('show');
                });

                // Ajout d'un gestionnaire d'événements pour quitter le survol de l'élément
                logoLabel.addEventListener('mouseout', function() {
                    // Masquer l'élément en retirant la classe
                    logoLabel.classList.remove('show');
                });


            </script>
            
            <script src="./contine.js"></script>

            <div class="Donnees2">
                <table>
                    <tr>
                        <td style="width:200px">
                            <label for="Ville"> Ville  : </label>
                        </td>
                        <td>
                            <input type="text" name="Ville" class="Ville" id="Ville" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Adresse"> Adresse  : </label>
                        </td>
                        <td>
                            <textarea name="Adresse" id="Adresse" cols="30" rows="4" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Domaine">Domaine : </label>
                        </td>
                        <td>
                            <input type="text" id="Domaine" name="Domaine" required> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="siteWeb"> Site Web :  </label>
                        </td>
                            <td>
                                <input type="text" id="siteWeb" class="siteWeb" name="siteWeb" required> 
                            </td>
                        </tr>
                </table>
            </div>

            <div class="decriptionDiv">
                <label for="description">Description :  </label> 
                <textarea name="description" id="description" cols="30" rows="10" required></textarea>
            </div>
            <div class="btnValider">
                <button type="submit" class="valider">Valider</button>
            </div>
        </form>
    </div>
    <?php include '../footer/footer3.php'; ?>
    <script>
        document.getElementsByClassName("valider")[0].addEventListener("click", function(event) {
        var numeroTelephone = document.getElementById("numTete").value.trim();
        var erreur = document.getElementsByClassName("erreur")[0];
        // Vérification du format avec une expression régulière
        var formatTelephone = /^(?:\+212|0)([5-7]\d{8})$/;

        if (!formatTelephone.test(numeroTelephone)) {
            erreur.style.display = "block" ;
            window.scrollTo(0, 0); 
            event.preventDefault(); // Empêche la soumission du formulaire
        } 
    });
    </script>
</body>
</html>
