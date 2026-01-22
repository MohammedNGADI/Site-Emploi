<?php  
include '../ConnexionBD/connexion.php';
session_start();

// Vérification de l'existence de la session et de l'ID de l'offre
if(isset($_SESSION['id_entreprise']) && isset($_GET['id'])) {
    $id_entreprise = $_SESSION['id_entreprise'];
    $offreID = $_GET['id'];
    $RecuperationDonneOffre = "SELECT * FROM offreemploi WHERE id_entreprise = $id_entreprise and id_offre = $offreID";
    $resultRecuperationDonneOffre = mysqli_query($connexion, $RecuperationDonneOffre);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des données envoyées par le formulaire
        $poste = $_POST['poste'];
        $dateDebut = $_POST['dateDebut'];
        $dateFin = $_POST['dateFin'];
        $description = $_POST['description'];
        $competences = $_POST['competences'];
        $typeContrat = $_POST['typeContrat'];

        $updateOffre = "UPDATE offreemploi SET poste = ?, datePublication = ?, dateFinOffre = ?, description = ?, competences = ?, typeContrat = ? WHERE id_offre = ? AND id_entreprise = ?";

        $stmt = mysqli_prepare($connexion, $updateOffre);

        mysqli_stmt_bind_param($stmt, 'ssssssii', $poste, $dateDebut, $dateFin, $description, $competences, $typeContrat, $offreID, $id_entreprise);

        // Exécution de la requête préparée
        if(mysqli_stmt_execute($stmt)) {
            header("location: ./GestionDesOffres.php?action=voir_offres");
            exit;
        } else {
            echo "Erreur lors de la mise à jour de l'offre d'emploi : " . mysqli_error($connexion);
        }

        // Fermeture de la requête préparée
        mysqli_stmt_close($stmt);
    }
    
    // Affichage du formulaire si la méthode de requête n'est pas POST
    if (!$resultRecuperationDonneOffre) {
        echo "Erreur: " . mysqli_error($connexion);
    } else {
        // Récupération des données et stockage dans des variables
        $rowresultRecuperationDonneOffre = mysqli_fetch_assoc($resultRecuperationDonneOffre);
        $poste = $rowresultRecuperationDonneOffre['poste'];
        $dateDebut = $rowresultRecuperationDonneOffre['datePublication'];
        $dateFin = $rowresultRecuperationDonneOffre['dateFinOffre'];
        $description = $rowresultRecuperationDonneOffre['description'];
        $competences = $rowresultRecuperationDonneOffre['competences'];

        // Libération du résultat
        mysqli_free_result($resultRecuperationDonneOffre);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'offre professionnelle</title>
    <link rel="stylesheet" href="../CSS/Recruteur/ModifierOffre.css">
</head>
<body>
    <?php
        include './enTete.php';
    ?>
    <div class="divGlobal"> 
        <div class="ModificationOffre">
            <form action="./ModifierOffre.php?id=<?php echo $offreID; ?>" method="post"> <!-- Correction de la méthode POST et ajout de l'ID de l'offre -->
                <table>
                    <tr>
                        <td class="tdGauche">
                            <label for="poste">Poste :</label>
                        </td>
                        <td class="tdDroit">
                            <input type="text" id="poste" name="poste" value="<?php echo $poste; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="tdGauche">
                            <label for="dateDebut">Date de début :</label>
                        </td>
                        <td class="tdDroit">
                            <input type="date" id="dateDebut" name="dateDebut" value="<?php echo $dateDebut; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="tdGauche">
                            <label for="dateFin">Date de fin :</label>
                        </td>
                        <td class="tdDroit">
                            <input type="date" id="dateFin" name="dateFin" value="<?php echo $dateFin; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="tdGauche">
                            <label for="description">Description :</label>
                        </td>
                        <td class="tdDroit">
                            <textarea id="description" name="description" rows="4" cols="50"><?php echo $description; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdGauche">
                            <label for="competences">Compétences :</label>
                        </td>
                        <td class="tdDroit">
                            <textarea id="competences" name="competences" rows="4" cols="50"><?php echo $competences; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdGauche">
                            <label for="typeContrat">Type de contrat :</label>
                        </td>
                        <td class="tdDroit">
                            <select id="typeContrat" name="typeContrat">
                                <option value="CDI">CDI</option>
                                <option value="CDD">CDD</option>
                                <option value="Stage">Stage</option>
                                <!-- Ajoutez d'autres options selon vos besoins -->
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Enregistrer les modifications">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <?php include '../footer/footer3.php'; ?>

</body>
</html>
