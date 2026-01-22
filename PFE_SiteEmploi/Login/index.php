<?php
session_start(); 
include '../connexionBD/connexion.php';

if (isset($_SESSION['idOffreAfficher']))
    unset($_SESSION['idOffreAfficher']);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['register_email'];
    $password = $_POST['register_pass'];
    $confirmPassword = $_POST['Confirm_register_pass'];
    $typeDeCandidature = $_POST['TypeCandidature'];



    if ($password !== $confirmPassword) {
        echo "<div class='erreur'>Les mots de passe ne correspondent pas.</div>";
    } else {
        $verification_email_entreprise = $connexion->prepare("SELECT email FROM entreprise WHERE email = ?");
        $verification_email_entreprise->bind_param("s", $email);
        $verification_email_entreprise->execute();
        $verification_email_entreprise->store_result();

        $verification_email_candidat = $connexion->prepare("SELECT email FROM candidat WHERE email = ?");
        $verification_email_candidat->bind_param("s", $email);
        $verification_email_candidat->execute();
        $verification_email_candidat->store_result();

        $verification_email_administrateur = $connexion->prepare("SELECT email FROM administrateurs WHERE email = ?");
        $verification_email_administrateur->bind_param("s", $email);
        $verification_email_administrateur->execute();
        $verification_email_administrateur->store_result();

        if ($verification_email_entreprise->num_rows > 0 || $verification_email_candidat->num_rows > 0|| $verification_email_administrateur->num_rows > 0) {
            echo '
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var notification = document.getElementById("emailUsedNotification");
                    if (notification) {
                        notification.classList.add("show");
                        setTimeout(function() {
                            notification.classList.remove("show");
                        }, 2000);
                    }
                });
            </script>
            ';
        } else {
            if ($typeDeCandidature === "Re") {
                $inscription = $connexion->prepare("INSERT INTO entreprise (email, motDePasse) VALUES (?, ?)");

                if ($inscription) {
                    $hash = password_hash($password,PASSWORD_BCRYPT,array('const'=>11));
                    if (password_verify($password,$hash))
                    {
                        $inscription->bind_param("ss", $email, $hash);
                        $inscription_executed = $inscription->execute();
                        if ($inscription_executed) {
                            session_start();
                            $_SESSION['register'] = $email;
                            header("Location: ../Login/ContinueInscriptionEntreprise.php");
                            exit(); // Terminer le script après la redirection
                        } else {
                            echo "Erreur lors de l'inscription : " . $inscription->error;
                        }
    
                        $inscription->close();
                    }

                    
                } else {
                    echo "Erreur lors de la préparation de la requête : " . $connexion->error;
                }
            } else if ($typeDeCandidature === "Ca") {
                $inscription = $connexion->prepare("INSERT INTO candidat (email, mot_De_Passe) VALUES (?, ?)");

                if ($inscription) {
                    $hash = password_hash($password,PASSWORD_BCRYPT,array('const'=>11));
                    if (password_verify($password,$hash))
                    {
                        $inscription->bind_param("ss", $email, $hash);
                        $inscription_executed = $inscription->execute();

                        if ($inscription_executed) {
                            session_start();
                            $_SESSION['register'] = $email;
                            header("Location: ./ContinueInscriptionProfil.php");
                            exit(); // Terminer le script après la redirection
                        } else {
                            echo "Erreur lors de l'inscription : " . $inscription->error;
                        }

                        $inscription->close();
                    }
                    
                } else {
                    echo "Erreur lors de la préparation de la requête : " . $connexion->error;
                }
            }
        }
    }
    $connexion->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="../SiteImages/administrateur/logoSiteEmploi2.jpg" type="image/jpg">
   <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
   <link rel="stylesheet" href="./LogInUp.css">
   <style>
        footer{
            width : 100%;
            bottom:0;
        }
   </style>
   <title>EMPNEXUS-Se connecter</title>
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
            <li><a href="../index_page/contact1.php">Contactez-nous </a></li>
            <li><a href="../INDEX.php#about_us">à propos</a></li>
            
        </ul>
        <div class="responsive-menu"></div>
    </header>
<div class="conteneur">
   <div class="forms">
     
     <div class="login" style="color: black;">
        
        <form action="connexion.php" class="login__form"  method="POST">
            <h1 class="login__title">Connexion</h1>
            <?php 
               
               if (isset($_SESSION['email']) && isset($_SESSION['motDePasse']))                
                {
                    echo '<span calss="messageERROR" >Mot de passe ou e-mail incorrect.</span>' ;
                    

                }
               ?>
            <div class="login__content">
               <div class="login__box">
                  <i class="ri-user-3-line login__icon"></i>

                  <div class="login__box-input">
                    <!-- ajouter par ZOUINA -->
                     <input type="email" required class="login__input" id="login-email" name="login-email" placeholder=" " <?php if (isset($_SESSION['email']) && isset($_SESSION['motDePasse'])) echo "value = '".$_SESSION['email']."'" ;?>>
                     <label for="login-email" class="login__label">Email</label>
                  </div>
                  
               </div>
               <!-- ajouter par ZOUINA -->
              

               <div class="login__box">
                  <i class="ri-lock-2-line login__icon"></i>

                  <div class="login__box-input">
                    <!-- ajouter par ZOUINA -->
                     <input type="password" required class="login__input" id="login-pass" name="login-pass" placeholder=" " <?php if (isset($_SESSION['email']) && isset($_SESSION['motDePasse'])) echo "value = '".$_SESSION['motDePasse']."'" ;?>>
                     <label for="login-pass" class="login__label">Mot de passe</label>
                  </div>
               </div>
               <!-- ajouter par ZOUINA -->
               
               
            </div>


            <button type="submit" class="login__button">S'identifier</button>

            <p class="login__register">
                Je n'ai pas un compte? <a href="#" onclick="moveLoginNoneleft()">S'inscrire</a>
            </p>
            
         </form>
      </div>
      
      <div class="register" style="color: black;">
      <div class="login_none"> </div>
      <form action="./index.php" class="register__form" method="POST" onsubmit="return validateForm()">
            <h1 class="register__title">Inscription</h1>
            
            <div class="register__content">
                <div class="register__box">
                    <i class="ri-mail-line register__icon"></i>
                    <div class="register__box-input">
                        <input type="email" class="register__input" id="register_email" name="register_email" placeholder=" ">
                        <label for="register_email" class="register__label">Email</label>
                        <label id="emailError" class="error">Veuillez remplir ce champ</label>
                    </div>
                </div>

                <div class="register__box">
                    <i class="ri-lock-2-line register__icon"></i>
                    <div class="register__box-input">
                        <input type="password" class="register__input" id="register_pass" name="register_pass" placeholder=" ">
                        <label for="register_pass" class="register__label">Mot de passe</label>
                        <label class="incorrectVerifivcation">Veuillez saisir le même mot de passe</label>
                        <label id="passwordError" class="error">Veuillez remplir ce champ</label>
                    </div>
                </div>

                <div class="register__box">
                    <i class="ri-lock-2-line register__icon"></i>
                    <div class="register__box-input">
                        <input type="password" class="register__input" id="Conf_register_pass" name="Confirm_register_pass" placeholder=" ">
                        <label for="register_pass" class="register__label">Confirmer mot de passe</label>
                        <label class="incorrectVerifivcation">Veuillez saisir le même mot de passe</label>
                        <label id="confirmPasswordError" class="error">Veuillez remplir ce champ</label>
                    </div>
                </div>
            </div>

            <div class="verification">
                <div>
                    <input type="radio" name="TypeCandidature" id="Ca" value="Ca" checked><label for="Ca">Candidat</label>
                </div>
                <div>
                    <input type="radio" name="TypeCandidature" id="Re" value="Re"><label for="Re">Recruteur</label>
                </div>
            </div>

            <button type="submit" class="register__button">S'inscrire</button>
            <p class="register__register">J'ai déjà un compte? <a href="#" onclick="moveLoginNoneRight()">Se connecter</a></p>
        </form>

    </div>  
   </div>
   
   <div class="background"> </div>
   <div class="notification" id="emailUsedNotification">
        <p>Cet email est déjà utilisé</p>
    </div>
</div>
<?php
if (isset($_SESSION['email']) && isset($_SESSION['motDePasse'])) 
{
    unset($_SESSION['email']);
    unset($_SESSION['motDePasse']);
}
?>
</body>
    <script src="LogInUp.js"></script>
    <script>
        if (password.length < 8 && confirmPassword.length < 8) {
        alert("Le nouveau mot de passe doit contenir au moins 8 caractères.");
        emailError.innerHTML = "Le nouveau mot de passe doit contenir au moins 8 caractères." ;
        emailError.style.display = "block";
        return false;
        }
        else {
            emailError.style.display = "none";
        }
    </script>
</html>

