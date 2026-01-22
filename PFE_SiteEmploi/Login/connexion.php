<?php
    include '../connexionBD/connexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['login-email'];
        $password = $_POST['login-pass'];
        $verifierEmailFromCandidat = "SELECT email FROM candidat WHERE email = '$email'";
        $resultatCandidat = mysqli_query($connexion, $verifierEmailFromCandidat);

        $verifierEmailFromEntreprise = "SELECT email FROM entreprise WHERE email = '$email'";
        $resultatEntreprise = mysqli_query($connexion, $verifierEmailFromEntreprise);

        $verifierEmailFromAdmine = "SELECT email FROM administrateurs WHERE email = '$email'";
        $resultatAdmine = mysqli_query($connexion, $verifierEmailFromAdmine);
        
        if (mysqli_num_rows($resultatCandidat) > 0 || mysqli_num_rows($resultatEntreprise) > 0 || mysqli_num_rows($resultatAdmine) > 0) {
            if (mysqli_num_rows($resultatCandidat) > 0) {
                $verifierMotDePasseCandidat = "SELECT mot_De_Passe, nom FROM candidat WHERE email = '$email'";
                $resultatCandidatPassword = mysqli_query($connexion, $verifierMotDePasseCandidat);
                if (mysqli_num_rows($resultatCandidatPassword) > 0) {
                    // <!-- ajouter par ZOUINA -->
                    $ligne = mysqli_fetch_row($resultatCandidatPassword);
                    if(password_verify($password,$ligne[0]))
                    {
                        if (empty($ligne[1]))
                        {
                            session_start();
                            $_SESSION['register'] = $email ;
                            header('location: ./ContinueInscriptionProfil.php'); 
                        }
                        else{
                            session_start();
                            $_SESSION['email'] = $email ;
                            header('location: ../Candidat/index.php'); 
                        }
                    }
                    else{
                        // <!-- ajouter par ZOUINA -->
                        session_start();
                        $_SESSION['email'] =  $email; 
                        $_SESSION['motDePasse'] = $password;
                        header('location: ./index.php') ;
                    }
                        
                } else {
                     //<!-- ajouter par ZOUINA -->
                    session_start();
                    $_SESSION['email'] =  $email; 
                    $_SESSION['motDePasse'] = $password;
                    header('location: ./index.php') ;
                }
            } 
            elseif (mysqli_num_rows($resultatEntreprise) > 0) {
                $verifierMotDePasseEntreprise = "SELECT motDePasse, nom FROM entreprise WHERE email = '$email'";
                $resultatEntreprisePassword = mysqli_query($connexion, $verifierMotDePasseEntreprise);
                if (mysqli_num_rows($resultatEntreprisePassword) > 0 ) {
                    // <!-- ajouter par ZOUINA -->
                    $ligne = mysqli_fetch_row($resultatEntreprisePassword) ;
                    if(password_verify($password,$ligne[0]))
                    {
                        if (empty($ligne[1]))
                        {
                            session_start();
                            $_SESSION['register'] = $email ;
                            header('location: ./ContinueInscriptionEntreprise.php'); 
                        }
                        else{
                            session_start();
                            $_SESSION['email'] = $email ;
                            header('location: ../Recruteur/index.php'); 
                            exit(); 
                        }
                    }
                    else{
                            // <!-- ajouter par ZOUINA -->
                        session_start();
                        $_SESSION['email'] =  $email; 
                        $_SESSION['motDePasse'] = $password;
                        header('location: ./index.php') ;
                    }
                } else {
                    // <!-- ajouter par ZOUINA -->
                    session_start();
                    $_SESSION['email'] =  $email; 
                    $_SESSION['motDePasse'] = $password;
                    header('location: ./index.php') ;
                }
            } elseif (mysqli_num_rows($resultatAdmine) > 0) {
                $verifierMotDePasseAdmine = "SELECT idAdmine, motDePasse FROM administrateurs WHERE email = '$email' ";
                $resultatAdminePassword = mysqli_query($connexion, $verifierMotDePasseAdmine);
                if (mysqli_num_rows($resultatAdminePassword) > 0 ) {
                    $ligne = mysqli_fetch_row($resultatAdminePassword) ;
                    if(password_verify($password,$ligne[1]))
                    {
                        session_start();
                        $_SESSION['idAdmine'] = $ligne[0] ;
                        header('location: ../administrateur/'); 
                        exit();
                    }else {
                        session_start();
                        $_SESSION['email'] =  $email; 
                        $_SESSION['motDePasse'] = $password;
                        echo $password;
                        header('location: ./index.php') ;
                    }
                } else {
                    session_start();
                    $_SESSION['email'] =  $email; 
                    $_SESSION['motDePasse'] = $password;
                   
                    header('location: ./index.php') ;
                }
            } else {
                echo "<script>alert('L\'email n'existe pas.')</script>";
            }
        } else {
            // <!-- ajouter par ZOUINA -->
            session_start();
            $_SESSION['email'] =  $email; 
            $_SESSION['motDePasse'] = $password;
            header('location: ./index.php') ;
        }
    }

    mysqli_close($connexion);
?>
