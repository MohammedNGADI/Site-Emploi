<?php
    session_start();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Recruteur/RecuperationCandidat.css">
    <title>Mes Candidats</title>
</head>
<body>
    <header>
        <?php
            include './enTete.php';
        ?>
    </header>
    
    <div class="conteuneur">
        <?php
            include '../ConnexionBD/connexion.php';

            $sql_postulation = "SELECT id_candidat FROM postulation WHERE id_offre = " . $_GET['id_offre'];
            $resultat_postulation = $connexion->query($sql_postulation);

            if ($resultat_postulation->num_rows > 0) {
                while ($postulation = $resultat_postulation->fetch_assoc()) {
                    $id_candidat = $postulation['id_candidat'];

                    $sql_candidat = "SELECT * FROM candidat WHERE id_candidat = $id_candidat";
                    $resultat_candidat = $connexion->query($sql_candidat);

                    $sql_profil_candidat = "SELECT * FROM profil_candidat WHERE id_candidat = $id_candidat";
                    $resultat_profil_candidat = $connexion->query($sql_profil_candidat);

                    if ($resultat_candidat->num_rows > 0 || $resultat_profil_candidat->num_rows > 0) {
                        while (($candidat = $resultat_candidat->fetch_assoc()) && ($profil_candidat = $resultat_profil_candidat->fetch_assoc())) {
                            ?>
                            <div class="candidatcard">
                                <div class="photoProfil">
                                    <img src="<?php echo $profil_candidat['photoProfil']; ?>" alt="Photo de profil" class="PP">
                                </div>
                                <div class="donneesPersonels">
                                    <div class="NomEtPrenom">
                                        <p class="Nom"><?php echo $candidat['nom']; ?></p>
                                        <p class="Prenom"><?php echo $candidat['prenom']; ?></p>
                                    </div>
                                    <p>Compétences : <?php echo $profil_candidat['competences']; ?></p>
                                    <p>Experience : <?php echo $profil_candidat['experience']; ?></p>
                                </div>
                                <div class="donneesContact">
                                    <p>Téléphone : <?php echo $candidat['n_Telephone']; ?></p>
                                    <p>Email : <?php echo $candidat['email']; ?></p>
                                </div>
                                <div class="lienVersProfil">
                                    <a href="./CandidatProfil.php?id_candidat=<?php echo $id_candidat; ?>">Voir Profil <i class="bx bx-right-arrow-alt"></i></a>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p>Aucun candidat trouvé.</p>";
                    }

                    $resultat_candidat->close();
                    $resultat_profil_candidat->close();
                }
            } else {
                echo "<p>Aucune postulation trouvée.</p>";
            }

            $resultat_postulation->close();
        ?>
    </div>
    <?php include '../footer/footer3.php'; ?>

</body>
</html>