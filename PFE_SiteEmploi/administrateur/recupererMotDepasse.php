<?php
include('../ConnexionBD/connexion.php');

// Vérifier la connexion à la base de données
if ($connexion->connect_error) {
    $response = array("error" => "Échec de la connexion à la base de données : " . $connexion->connect_error);
    echo json_encode($response);
    die();
}

if (isset($_GET['id']) && isset($_GET['anciennePassword']) && isset($_GET['nouveauPassword']))
{
    // Valider l'id
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $ancienneMotDePasseSaisie = $_GET['anciennePassword'];
    $nouveauPassword = $_GET['nouveauPassword'];
    if ($id <= 0) {
        $response = array("error" => "L'identifiant n'est pas valide.");
        echo json_encode($response);
        die();
    }

    // Préparer et exécuter la requête SQL pour récupérer l'ancien mot de passe
    $querySelect = "SELECT motDePasse FROM administrateurs WHERE idAdmine = ?";
    $stmtSelect = $connexion->prepare($querySelect);

    if (!$stmtSelect) {
        $response = array("error" => "Erreur dans la préparation de la requête : " . $connexion->error);
        echo json_encode($response);
        die();
    }

    $stmtSelect->bind_param("i", $id);
    $stmtSelect->execute();
    $stmtSelect->bind_result($ancienneMotDePasse);
    $stmtSelect->fetch();
    $stmtSelect->close(); // Fermez le jeu de résultats

    // Vérifiez l'ancien mot de passe
    if (password_verify($ancienneMotDePasseSaisie,$ancienneMotDePasse)) {

        // Préparer et exécuter la requête SQL pour mettre à jour le mot de passe
        $queryUpdate = "UPDATE administrateurs SET motDePasse = ? WHERE idAdmine = ?";
        $stmtUpdate = $connexion->prepare($queryUpdate);
        
        if (!$stmtUpdate) {
            $response = array("error" => "Erreur dans la préparation de la requête : " . $connexion->error);
            echo json_encode($response);
            die();
        }
        $nouveauPassword = password_hash($nouveauPassword,PASSWORD_BCRYPT,array('const'=>11));
        $stmtUpdate->bind_param("si", $nouveauPassword, $id);
        $stmtUpdate->execute();
        $stmtUpdate->close();
        $connexion->close();
        $response = array("modifie" => "oui");
        echo json_encode($response);

    } else {
        $response = array("modifie" => "non");
        $connexion->close();
        echo json_encode($response);
    }
}
else{
    if (isset($_GET['nouveauTelephone']) && isset($_GET['id']) && !empty($_GET['nouveauTelephone']) && !empty($_GET['id'])) {
        $queryUpdate = "UPDATE administrateurs SET nTelephone = ? WHERE idAdmine = ?";
        $stmtUpdate = $connexion->prepare($queryUpdate);
    
        if (!$stmtUpdate) {
            $response = array("modifie" => "Erreur dans la préparation de la requête : " . $connexion->error);
            echo json_encode($response);
            die();
        }
    
        $stmtUpdate->bind_param("si", $_GET['nouveauTelephone'], $_GET['id']);
        $stmtUpdate->execute();
        $affectedRows = $stmtUpdate->affected_rows; // Obtenez le nombre de lignes affectées
        $stmtUpdate->close();
    
        $connexion->close();
    
        if ($affectedRows > 0) {
            $response = array("modifie" => "oui2");
        } else {
            $response = array("modifie" => "aucun changement");
        }
    
        echo json_encode($response);
    } else {
                if (isset($_GET['nouveauEmail']) && isset($_GET['id']) && !empty($_GET['nouveauEmail']) && !empty($_GET['id'])) {
                    $email = $_GET['nouveauEmail'];
                    //tester l'existance de l'email dans la table candidat 
                    $checkCandidat = "SELECT count(*) AS nombreEmail FROM candidat WHERE email = ?";
                    $resultatCandidat = $connexion->prepare($checkCandidat);
                    $resultatCandidat->bind_param("s", $email);
                    $resultatCandidat->execute();
                    $resultatCandidat->bind_result($nombreEmailCandidat);
                    $resultatCandidat->fetch();
                    $resultatCandidat->close();
                    if($nombreEmailCandidat > 0)
                    {
                        $response = array("modifie" => "Cette email est déja utilisé.");
                        echo json_encode($response);
                        die();
                    }

                    //testet l'existance de l'email dans la table entreprise 
                    $checkEntreprise = "SELECT count(*) AS nombreEmail FROM entreprise WHERE email = ?";
                    $resultatEntreprise = $connexion->prepare($checkEntreprise);
                    $resultatEntreprise->bind_param("s", $email);
                    $resultatEntreprise->execute();
                    $resultatEntreprise->bind_result($nombreEmailEntreprise);
                    $resultatEntreprise->fetch();
                    $resultatEntreprise->close();
                    if($nombreEmailEntreprise > 0)
                    {
                        $response = array("modifie" => "Cette email est déja utilisé.");
                        echo json_encode($response);
                        die();
                    }

                    //testet l'existance de l'email dans la table administrateur 
                    $checkAdministrateur = "SELECT count(*) AS nombreEmail FROM administrateurs WHERE email = ?";
                    $resultatAdministrateur = $connexion->prepare($checkAdministrateur);
                    $resultatAdministrateur->bind_param("s", $email);
                    $resultatAdministrateur->execute();
                    $resultatAdministrateur->bind_result($nombreEmailAdministrateur);
                    $resultatAdministrateur->fetch();
                    $resultatAdministrateur->close();
                    if($nombreEmailAdministrateur > 0)
                    {
                        $response = array("modifie" => "Cette email est déja utilisé.");
                        echo json_encode($response);
                        die();
                    }


                    $queryUpdate = "UPDATE administrateurs SET email = ? WHERE idAdmine = ?";
                    $stmtUpdate = $connexion->prepare($queryUpdate);
                
                    if (!$stmtUpdate) {
                        $response = array("modifie" => "Erreur dans la préparation de la requête : " . $connexion->error);
                        echo json_encode($response);
                        die();
                    }
                
                    $stmtUpdate->bind_param("si", $_GET['nouveauEmail'], $_GET['id']);
                    $stmtUpdate->execute();
                    $affectedRows = $stmtUpdate->affected_rows; // Obtenez le nombre de lignes affectées
                    $stmtUpdate->close();
                
                    $connexion->close();
                
                    if ($affectedRows > 0) {
                        $response = array("modifie" => "oui2");
                    } else {
                        $response = array("modifie" => "aucun changement");
                    }
                
                    echo json_encode($response);
                }
                else{
                    $response = array("error" => "Paramètres manquants ou invalides.");
                    echo json_encode($response);
                    die();
                }  
        }
    }

?>
