<?php  
include '../ConnexionBD/connexion.php';
    session_start();
    if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $Recuperationemail = "SELECT id_entreprise FROM entreprise WHERE email = ?";
    $stmtRecuperationemail = $connexion->prepare($Recuperationemail);
    $stmtRecuperationemail->bind_param("s", $email);
    $stmtRecuperationemail->execute();
    $resultRecuperationemail = $stmtRecuperationemail->get_result();
    $rowRecuperationemail = $resultRecuperationemail->fetch_assoc();
    $id_entreprise = $rowRecuperationemail['id_entreprise'];
    $_SESSION['id_entreprise'] = $id_entreprise ; 

if(isset($_POST['Poste']) && isset($_POST['description']) && isset($_POST['date_pub']) && isset($_POST['date_limite']) && isset($_POST['competences']) && isset($_POST['typeContrat']) && isset($_POST['experiences'])) {

    $offrePoste = $_POST['Poste'];
    $Description = $_POST['description'];
    $date_pub = $_POST['date_pub'];
    $date_limite = $_POST['date_limite'];
    $competences = $_POST['competences'];
    $experiences = $_POST['experiences'];
    $typeContrat = $_POST["typeContrat"];

    if(empty($experiences)){
        echo $experiences;
    } 
    if (!empty($offrePoste) && !empty($Description) && !empty($date_pub) && !empty($date_limite) && !empty($competences) && !empty($typeContrat)) {
        

        $insertQuery = "INSERT INTO offreemploi (id_entreprise, poste, description, datePublication, dateFinOffre, competences, typeContrat,experiences) VALUES (?, ?, ?, ?, ?, ?, ?,?)";
        $stmt = $connexion->prepare($insertQuery);
        $stmt->bind_param("isssssss", $id_entreprise, $offrePoste, $Description, $date_pub, $date_limite, $competences, $typeContrat,$experiences);

        if ($stmt->execute()) {
            echo "<script>
                    document.querySelector('.notification').style.dislay = 'flex';
                  </script>";
                  header('Location: ./GestionDesOffres.php?action=ajouter_offre'); 

            exit;
        } else {
            echo "Erreur lors de l'insertion de l'offre d'emploi : " . $stmt->error;
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMPNEXUS-Mes offes</title>
    <link rel="icon" href="../SiteImages/administrateur/logoSiteEmploi2.jpg" type="image/jpg">
    <link rel="stylesheet" href="../CSS/Recruteur/GestionOffres.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="GestionDesOffres.js"></script>
    <link href="https://fonts.cdnfonts.com/css/readex-pro" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <header>
        <?php
            include './enTete.php';
        ?>
    </header>




<div class="milieu">


    <div class="mlAdd">
        <div class="notification">
            <p>Votre offre a été ajoutée avec succès. Veuillez patienter...</p>
        </div>
        <form  method="POST" class="AddForm">
            <table>
                <tr>
                    <td><label for="Poste">Poste :</label></td>
                    <td><input type="text" id="Poste" name="Poste" required></td>
                </tr>
                <tr>
                    <td><label for="description" class="txtar">Description du poste :</label></td>
                    <td><textarea id="description" name="description" rows="5" required></textarea></td>
                </tr>
                <tr>
                    <td><label>Date de publication :</label></td>
                    <td><input type="date" id="date_pub" name="date_pub" required></td>
                </tr>
                <tr>
                    <td><label>Date limite de candidature :</label></td>
                    <td><input type="date" id="date_limite" name="date_limite" required></td>
                </tr>
                <tr>
                    <td><label for="competences">Compétences requises :</label></td>
                    <td><input type="text" id="competences" name="competences" required></td>
                </tr>
                <tr>
                    <td><label for="experiences">Expériences :</label></td>
                    <td><input type="text" id="experiences" name="experiences" required></td>
                </tr>
                <tr>
                    <td><label for="typeContrat">Type de contrat  </label></td>
                    <td><input type="text" id="typeContrat" name="typeContrat" required></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit"  class="btnvld" title="Valider"><i class='bx bx-check'></i></button></td>
                    <td colspan="2"><button type="reset"  class="btnAnnul" title="Annuler"><i class='bx bx-x'></i></button></td>
                </tr>
            </table>
        </form>
    </div>
    

    <div class="mloffres">
        <!-- Affichage des offres -->
        <?php
        // Requête pour sélectionner les offres
        $sql_offres = "SELECT id_offre, poste, description, datePublication, dateFinOffre, competences, typeContrat FROM offreemploi WHERE id_entreprise = $id_entreprise";
        $resultat_offres = $connexion->query($sql_offres);

        if ($resultat_offres->num_rows > 0) {
            while ($row_offre = $resultat_offres->fetch_assoc()) {
                $poste = $row_offre["poste"];
                $description = $row_offre["description"];
                $datePublication = $row_offre["datePublication"];
                $dateFinOffre = $row_offre["dateFinOffre"];
                $competences = $row_offre["competences"];
                $typeContrat = $row_offre["typeContrat"];
                $id_offre = $row_offre["id_offre"];
                $sql_Postulation = "SELECT COUNT(*) as NbrPostulation FROM postulation WHERE id_offre = $id_offre";
                $resultat_Postulation = $connexion->query($sql_Postulation);
                $row_Postulation = $resultat_Postulation->fetch_assoc();
                $NbrPostulation = $row_Postulation['NbrPostulation'];
        ?>
                <div class="offre">
                    <div class="titre">
                        <form id="form-offre-<?php echo $id_offre; ?>" method="post" action="./GestionDesOffres.php">
                            <input type="hidden" name="offreID" value="<?php echo $id_offre; ?>">
                            <button type="button" class="edit-btn" style="border:none" title="Modifier l'offre <?php echo $poste  ?>"><i class='bx bxs-edit'></i></button>
                            <button type="button" class="delete-btn" style="border:none" value="supprimeroffre" title="Supprimer l'offre <?php echo $poste  ?>"><i class='bx bxs-trash'></i></button>
                        </form>
                        <p>
                            <?php echo $poste ?>
                            <i class='bx bx-chevron-down'></i>
                        </p>
                    </div>
                    <div class="contenue">
                        <div class="card">
                            <div class="card-head">
                                <p class="typeC">
                                    Type de contrat : <?php echo $typeContrat; ?>
                                </p>
                                <div class="date">
                                    <div class="datePub">
                                        Publié le <?php echo $datePublication; ?>
                                    </div>
                                    <div class="datelimite">
                                        Limite le: <?php echo $dateFinOffre; ?>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: 5px;">
                            <div class="card-body">
                                <p style="font-weight: bold; color: rgb(51, 51, 51);">
                                    Description :
                                </p>
                                <p class="card-text">
                                    <?php echo $description; ?>
                                </p>
                                <p class="card-competence">Compétences requises : <?php echo $competences; ?></p>
                            </div>
                        </div>
                        <div class="candidat">
                            <a href="./recuperer_Candidats.php?id_offre=<?php echo $id_offre; ?>" class="demandes">
                                <?php echo $NbrPostulation . " Demande(s)"; ?>
                            </a>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "Aucune offre trouvée.";
        }
        ?>
    </div>

</div>
<?php?>
  
    
        
    <?php
    include '../footer/footer3.php';

    }
    ?>
    
</body>
    
</html>


