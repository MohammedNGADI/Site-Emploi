<?php
include '../ConnexionBD/connexion.php';
session_start();
if (isset($_SESSION['id_entreprise'])) {
    $id_entreprise = $_SESSION['id_entreprise'];

    $reqModification = "select * from entreprise where id_entreprise = $id_entreprise";
    $resultatMP = $connexion->query($reqModification);
    if ($resultatMP !== FALSE && $resultatMP->num_rows > 0) {
        $rowMP = $resultatMP->fetch_assoc();
        $Nomentre = $rowMP['nom'];
        $n_tele = $rowMP['n_telephone'];
        $ville = $rowMP['ville'];
        $adresseEnt = $rowMP['adresse'];
        $Description = $rowMP['description'];
        $email = $rowMP['email'];
        $domaine = $rowMP["domaine"];
        $siteweb = $rowMP["site_web"];
        $anneeDeFondation = $rowMP["anneeDeFondation"];
        $logoEntre = $rowMP["logo"];
    }
    // la mise à jour de la table :
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST['entreprise'];
        $n_telephone = $_POST['telephone'];
        $ville = $_POST['ville'];
        $adresse = $_POST['adresse'];
        $email = $_POST['email'];
        $description = $_POST['description_entreprise'];
        $do = $_POST['domaine'];
        $site_web = $_POST['site_internet'];

        

        if($_FILES['logo']['name']){
            $repertoire = '../EntLogo/' . $nom;
            if (is_file($logoEntre)) {
                if (unlink($logoEntre)) {
                    $parties = explode('/', $logoEntre);

                    // Supprimer la dernière partie
                    array_pop($parties);

                    // Regrouper les parties restantes en une chaîne de caractères
                    $repertoire = implode('/', $parties);

                    //inserer la nouvelle image
                } else {
                    echo "Erreur lors de la suppression du fichier image.";
                }
            } 
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
            $cheminlogo = $repertoire . '/' . $_FILES['logo']['name'];
            move_uploaded_file($_FILES['logo']['tmp_name'], $cheminlogo);
            $req = "UPDATE entreprise SET 
                    nom = ?,
                    n_telephone = ?,
                    ville = ?,
                    adresse = ?,
                    description = ?,
                    domaine = ?,
                    site_web = ?,
                    logo = ?,
                    email = ?
                    WHERE id_entreprise = ?";
        $stmt = $connexion->prepare($req);
        $stmt->bind_param("ssssssssss", $nom, $n_telephone, $ville, $adresse, $description, $do, $site_web, $cheminlogo , $email, $id_entreprise);

        $resultupdate = $stmt->execute();

        if ($resultupdate) {
            header("Location: ./modifierProfil.php");
            exit();
        } else {
            echo "Erreur lors de la mise à jour des données de l'entreprise : " . $connexion->error;
        }
        }else{
        $req = "UPDATE entreprise SET 
                    nom = ?,
                    n_telephone = ?,
                    ville = ?,
                    adresse = ?,
                    description = ?,
                    domaine = ?,
                    site_web = ?,
                    email = ?
                    WHERE id_entreprise = ?";
        
        $stmt = $connexion->prepare($req);
        $stmt->bind_param("sssssssss", $nom, $n_telephone, $ville, $adresse, $description, $do, $site_web, $email, $id_entreprise);

        // Exécutez la requête préparée
        $resultupdate = $stmt->execute();

        if ($resultupdate) {
            echo 'success';
            exit();
        } else {
            echo "Erreur lors de la mise à jour des données de l'entreprise : " . $connexion->error;
        }
        
           
    }
}

    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../CSS/Recruteur/profilEntreprise.css">
    <link rel="stylesheet" href="../CSS/enTeteCSS.css">
    <link rel="icon" href="../SiteImages/administrateur/logoSiteEmploi2.jpg" type="image/jpg">
    <title>EMPNEXUS-Mon Profil</title>
</head>

<body>
    <?php include './enTete.php'; ?>


    <div class="BienModifier"><h2>Modification réussie</h2><p>Veuillez patienter..</p></div>


    <div class="pro">
        <div class="milieuProfil">
            <div class="Entreprise">
                <div class="entrepriseNom">
                    Profil
                </div>
                <div class="InfosEntreprise">
                    <div class="informations">
                        <table>
                            <form action="./modifierProfil.php"  id="Donnees" method="post" enctype="multipart/form-data">
                                <tr>
                                    <td><b>Logo :</b></td>
                                    <td>
                                        <img src="<?php echo $logoEntre ?>" alt="Logo de l'entreprise" class="photoEntreprise" style="width: 100px; height: 100px;">
                                        <input type="file" value="choisir un autre logo" name="logo">
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Entreprise :</b></td>
                                    <td><input type="text" value="<?php echo $Nomentre; ?>" name="entreprise" required></td>
                                </tr>
                                <tr>
                                    <td><b>Domaine :</b></td>
                                    <td><input type="text" value="<?php echo $domaine; ?>" name="domaine" required></td>
                                </tr>
                                <tr>
                                    <td><b>Téléphone :</b></td>
                                    <td><input type="text" value="<?php echo $n_tele; ?>" name="telephone" required></td>
                                </tr>
                                <tr>
                                    <td><b>Ville :</b></td>
                                    <td><input type="text" value="<?php echo $ville; ?>" name="ville" required></td>
                                </tr>
                                <tr>
                                    <td><b>Adresse :</b></td>
                                    <td><input type="text" value="<?php echo $adresseEnt; ?>" name="adresse" required></td>
                                </tr>
                                <tr>
                                    <td><b>Email :</b></td>
                                    <td><input type="text" value="<?php echo $email; ?>" name="email" required></td>
                                </tr>
                                <tr>
                                    <td><b>Site internet :</b></td>
                                    <td><input type="text" value="<?php echo $siteweb; ?>" name="site_internet" required></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="description">
                                            <p><b>Description de l'entreprise :</b> <br>
                                                <textarea name="description_entreprise" id="" cols="110" rows="5" required><?php echo $Description; ?></textarea>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><button type="submit" class="btnmodifier">Modifier</button></td>
                                </tr>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        

        $(document).ready(function() {
            $('#Donnees').submit(function(event) {
                event.preventDefault(); 
                var formData = new FormData($(this)[0]); 

                // Effectuer une requête AJAX
                $.ajax({
                    type: 'POST',
                    url: './modifierProfil.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.trim() === 'success') {
                            $('.BienModifier').show(); 
                            setTimeout(function() {
                                $('.BienModifier').hide(); 
                                window.location.href = './modifierProfil.php'; 
                            }, 4000);
                        } else {
                            alert('Êtes vous sûr de changer votre Logo ?'); 
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Erreur lors de la requête AJAX : ' + status + ' - ' + error); 
                    }
                });
            });
        });
    </script>

    <div class="ModificationMotDePasse">

        <form action="./PasswordUpdate.php" method="post"  id="PasswordForm">
            <input type="hidden" name="modifierMotDePasse" value="true">
            <p class="titreMP">Modifier votre mot de passe</p>
            <table>
                <tr>
                    <td>
                        Ancien mot de passe :
                    </td>
                    <td>
                        <input type="password" class="oldPassword" name="oldPassword">
                    </td>
                </tr>
                <tr>
                    <td>
                        Nouveau mot de passe :
                        <div class="PasswordNotCorespondent">
                            Les mots de passe ne correspondent pas.
                        </div>
                    </td>
                    <td>
                        <input type="password" class="newPassword" name="newPassword">
                    </td>
                </tr>
                <tr>
                <tr>
                    <td>
                        Confirmer le nouveau mot de passe :
                        <div class="PasswordNotCorespondent">
                            Les mots de passe ne correspondent pas.
                        </div>
                    </td>
                    <td>
                        <input type="password" class="newPasswordConfirm" name="newPasswordConfirm">
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit" class="btnmodifier" id="btnmodifierPassword">Modifier</button></td>
                </tr>
            </table>

        </form>
    </div>
    <div class="BienModifier">
        <h2>Modification réussie</h2>
        <p>Veuillez patienter..</p>
    </div>
    <div class="AnPsIn">
        <h2>Ancien mot de passe incorrect</h2>
    </div>
    <div class="PasswordsNotCorre">
        <h2>Les nouveaux mots de passe ne correspondent pas.</h2>
    </div>
    <script>
    $(document).ready(function() {
        $('#PasswordForm').submit(function(event) {
            event.preventDefault(); 
            var formData = new FormData($(this)[0]);
            var password = document.getElementsByClassName("newPassword")[0].value ;
            var confirm = document.getElementsByClassName("newPasswordConfirm")[0].value ;
            if(password.trim() === "" || confirm.trim() === "") {
                $('.PasswordsNotCorre').html("<h2>Tous les champs sont obligatoires.</h2><p>Veuillez patienter...</p>").show(); 
                setTimeout(function() {
                    $('.PasswordsNotCorre').hide();
                    window.location.href = './modifierProfil.php'; // Rediriger vers la page de profil
                }, 4000);
            } else if (password.length < 8 || confirm.length < 8) {
                $('.PasswordsNotCorre').html("<h2>Le nouveau mot de passe doit contenir au moins 8 caractères.</h2><p>Veuillez patienter...</p>").show(); 
                setTimeout(function() {
                    $('.PasswordsNotCorre').hide();
                    window.location.href = './modifierProfil.php'; // Rediriger vers la page de profil
                }, 4000);
            } else {
                $.ajax({
                    type: 'POST',
                    url: './PasswordUpdate.php',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.trim() === 'success') {
                            $('.BienModifier').show(); 
                            setTimeout(function() {
                                $('.BienModifier').hide();
                                window.location.href = './modifierProfil.php'; // Rediriger vers la page de profil
                            }, 4000);
                        } else if(response.trim() === 'Les nouveaux mots de passe ne correspondent pas.') {
                            $('.PasswordsNotCorre').html("<h2>Les nouveaux mots de passe ne correspondent pas.</h2>").show(); 
                            setTimeout(function() {
                                $('.PasswordsNotCorre').hide();
                            }, 4000);
                        } else if(response.trim() === 'L\'ancien mot de passe est incorrect.') {
                            $('.AnPsIn').show(); 
                            setTimeout(function() {
                                $('.AnPsIn').hide();
                            }, 4000);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Erreur lors de la requête AJAX : ' + status + ' - ' + error); // Afficher une alerte en cas d'erreur AJAX
                    }
                });
            }
        });
    });
</script>



    <?php include '../footer/footer3.php'; ?>
</body>
<?php

?>
</html>
<?php
$connexion->close();
} else {
    header('Location: ../Login');
}
?>


