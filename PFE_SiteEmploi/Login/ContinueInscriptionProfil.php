<?php
session_start();
include '../ConnexionBD/connexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = mysqli_real_escape_string($connexion,$_POST['Nom']);
    $prenom = mysqli_real_escape_string($connexion,$_POST['Prenom']);
    $age = $_POST['Age'];
    $genre = $_POST['Genre'];
    $numeroTelephone = $_POST['NumeroTelephone'];
    $ville = mysqli_real_escape_string($connexion,$_POST['Ville']);
    $adresse = mysqli_real_escape_string($connexion,$_POST['Adresse']);
    $poste = mysqli_real_escape_string($connexion,$_POST['Poste']);

    $email = $_SESSION['register'];

    // Exécuter d'abord la requête pour mettre à jour les données du candidat
    $candidat = "UPDATE candidat SET 
            nom = '$nom', 
            prenom = '$prenom', 
            dateNaissance = '$age', 
            genre = '$genre', 
            n_telephone = '$numeroTelephone', 
            ville = '$ville', 
            adresse = '$adresse', 
            poste = '$poste' 
            WHERE email = '$email'";

    if ($connexion->query($candidat) === TRUE) {

        // Récupérer l'ID du candidat à partir de l'e-mail
        $query_id_candidat = "SELECT id_candidat FROM candidat WHERE email = '$email'";
        $result_id_candidat = $connexion->query($query_id_candidat);

        if ($result_id_candidat->num_rows > 0) {
            $row = $result_id_candidat->fetch_assoc();
            $id_Candidat = $row['id_candidat'];

            // Chemin du répertoire pour les CV
            $repertoireCV = '../candidatCV/' . $nom . '_' . $prenom;

            if (!file_exists($repertoireCV)) {
                mkdir($repertoireCV);
            }

            // Chemin du fichier CV
            $cheminCV = $repertoireCV . '/' . $_FILES['CV']['name'];

            // Déplacement du fichier CV vers le répertoire
            if (move_uploaded_file($_FILES['CV']['tmp_name'], $cheminCV)) {

                // Chemin du répertoire pour les photos de profil
                $repertoire = '../candidatPhotoProfil/' . $nom . '_' . $prenom;

                if (!file_exists($repertoire)) {
                    mkdir($repertoire);
                }

                // Chemin du fichier photo de profil
                $cheminPhotoProfil = '';

                // Vérifier si une photo de profil a été téléchargée
                if ($_FILES['PhotoP']['name']) {
                    $cheminPhotoProfil = $repertoire . '/' . $_FILES['PhotoP']['name'];

                    // Déplacement du fichier photo de profil vers le répertoire
                    if (move_uploaded_file($_FILES['PhotoP']['tmp_name'], $cheminPhotoProfil)) {
                        // Tout s'est bien passé, la photo de profil a été téléchargée
                    } else {
                        echo "Erreur lors du téléchargement de la photo de profil.";
                    }
                } else {
                    // Utilisation de l'image par défaut
                    $cheminPhotoProfil = "../candidatPhotoProfil/user-profile-man.jpg";
                }

                $diplomes_value = mysqli_real_escape_string($connexion,$_POST['diplomaInput']);
                $experience_value = mysqli_real_escape_string($connexion,$_POST['experience']);
                $competences_value = mysqli_real_escape_string($connexion,$_POST['competences']);
                $langue_1_value = mysqli_real_escape_string($connexion,$_POST['L1']);
                $langue_2_value = mysqli_real_escape_string($connexion,$_POST['L2']);
                $langue_3_value = mysqli_real_escape_string($connexion,$_POST['L3']);

                // Insertion des données dans la table ProfilCandidat
                $candidatProfil = "INSERT INTO profil_candidat 
                    (id_Candidat, diplomes, experience, competences, langue_1, langue_2, langue_3, photoProfil, cv)
                    VALUES ('$id_Candidat', '$diplomes_value', '$experience_value', '$competences_value', '$langue_1_value', '$langue_2_value', '$langue_3_value', '$cheminPhotoProfil', '$cheminCV')";

                if ($connexion->query($candidatProfil) === TRUE) {
                    session_start();
                    $_SESSION['email'] = $email;
                    header('Location: ../Candidat/index.php');
                    exit();
                } else {
                    echo "Erreur lors de l'insertion dans ProfilCandidat : " . $connexion->error;
                }
            } else {
                echo "Erreur lors du téléchargement du CV.";
            }
        } else {
            echo "Aucun candidat trouvé avec cet e-mail.";
        }
    } else {
        echo "Erreur lors de la mise à jour des données du candidat : " . $connexion->error;
    }

    $connexion->close();
}
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>EMPNEXUS-Inscription</title>
    <link rel="stylesheet" href="../CSS/continueinscription.css">
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
        <form action="ContinueInscriptionProfil.php" id="inscriptionForm" class="ContinueInscForm" method="POST" enctype="multipart/form-data">
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
                        <td style="width:200px">
                            <label for="Prenom"> Prenom  : </label>
                        </td>
                        <td>
                            <input type="text" name="Prenom" class="Prenom" id="Prenom" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Age"> Date de naissance  : </label>
                        </td>
                        <td>
                            <input type="date" name="Age" class="Age" id="Age" required><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="Genre"> Genre  : </label>
                        </td>
                        <td class="radios">
                            <input type="radio" name="Genre" value="H" class="Genre" id="GenreH"><label for="GenreH" required>homme</label>
                            <input type="radio" name="Genre" value="F" class="Genre" id="GenreF"><label for="GenreF" required>femme</label>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="CVPhotoProfil">
                <table>
                    <tr>
                        <td>
                            <label for="CV">Votre CV : </label>
                        </td>
                        <td>
                            <input type="file" name="CV" id="CV" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="PhotoP">Votre photo profil :</label>
                        </td>
                        <td>
                            <img src="../SiteImages/login/user-profile-man.jpg" alt="" id="profile-pic" class="PhotoP">
                            <label for="PhotoP" class="choisiPhoto"><i class='bx bx-upload'></i></label>
                            
                            <input type="file" name="PhotoP" id="PhotoP" class="PhotoPinput" accept="image/jpeg, image/jpg, image/png">
                        </td>
                    </tr>
                </table>
            </div>
            
            <script src="./contine.js"></script>

            <div class="Donnees">
                <table>
                    <tr>
                        

                        <td>
                            
                            <label for="NumeroTelephone"> Numéro Téléphone : </label>
                        </td>
                        <td>
                            <input type="text" name="NumeroTelephone" class="NumeroTelephone" id="NumeroTelephone" required> <br>
                            <span class='erreur'>Veuillez entrer un numéro de téléphone valide.</span>
                        </td>
                    </tr>
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
                            <label for="Poste">Poste : </label>
                        </td>
                        <td>
                            <input type="text" id="Poste" name="Poste" required> 
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="diplom"> Diplômes :  </label>
                        </td>
                        <td class="classDiplom">
                            <div class="affichediploms">
                                <textarea id="diplomaInput" name="diplomaInput" readonly></textarea>
                            </div>
                            <div id="addDiplomaButton">
                                <input name="diplom" id="diplom" required>
                                <div id="addButton">+</div>
                                <div id="updateButton" style="display:none">Modifier</div>
                            </div>
                        </td>
                        </tr>
                        <script>
                            const diplomaInput = document.getElementById('diplomaInput');
                            const addButton = document.getElementById('addButton');
                            const updateButton = document.getElementById('updateButton');
                            const inputField = document.getElementById('diplom');

                            // Fonction pour ajuster la hauteur du textarea en fonction de son contenu
                            function adjustTextareaHeight() {
                                diplomaInput.style.height = 'auto'; // Réinitialiser la hauteur du textarea
                                diplomaInput.style.height = diplomaInput.scrollHeight + 'px'; // Ajuster la hauteur du textarea
                            }

                            // Écoute de l'événement "keydown" sur le champ de texte "inputField"
                            inputField.addEventListener('keydown', function(event) {
                                if (event.key === 'Enter') {
                                    diplomaInput.style.display = 'block'; 
                                    event.preventDefault(); // Empêcher le comportement par défaut de la touche "Enter"
                                    const newDiploma = inputField.value.trim();
                                    if (newDiploma) {
                                        addDiplomaToList(newDiploma);
                                        inputField.value = ''; // Réinitialiser le champ de texte
                                        inputField.readOnly = true; // Définir le champ de texte en mode lecture seule
                                    }
                                }
                                adjustTextareaHeight();
                            });

                            diplomaInput.addEventListener('input', function() {
                                adjustTextareaHeight(); 
                            });

                            // Écoute de l'événement "click" sur le bouton "+"
                            addButton.addEventListener('click', function() {
                                inputField.readOnly = false; // Définir le champ de texte en mode readonly
                                inputField.focus(); // Mettre le focus sur le champ de texte
                            });

                            // Fonction pour ajouter le diplôme au champ de texte
                            function addDiplomaToList(diplomaText) {
                                // Ajouter le diplôme avec un saut de ligne
                                diplomaInput.value += diplomaText + '\n';
                                adjustTextareaHeight(); // Ajuster la hauteur du textarea
                            }
                        </script>
                    <tr>
                        <td>
                            <label for="experience">Expériences :  </label>
                        </td>
                        <td>
                            <input type="text" name="experience" id="experience" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="competences">Compétences : </label>
                        </td>
                        <td>
                            <input type="text" name="competences" id="competences" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="L1">Langue 1 : </label>
                        </td>
                        <td>
                            <input type="text" name="L1" id="L1" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="L2">Langue 2 : </label>
                        </td>
                        <td>
                            <input type="text" name="L2" id="L2" requiredd>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="L3">Langue 3 : </label>
                        </td>
                        <td>
                            <input type="text" name="L3" id="L3" requiredd>
                        </td>
                    </tr>
                    
                </table>
            </div>
            <div class="btnValider">
                <button type="submit" class="valider">Valider</button>
            </div>
        </form>
    </div>
    
    <?php include '../footer/footer3.php'; ?>
    <script>
        document.getElementsByClassName("valider")[0].addEventListener("click", function(event) {
        var numeroTelephone = document.getElementById("NumeroTelephone").value.trim();
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
