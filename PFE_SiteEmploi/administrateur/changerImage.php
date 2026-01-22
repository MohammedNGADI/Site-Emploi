                                                                                                 <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    include('../ConnexionBD/connexion.php');

    $id = mysqli_real_escape_string($connexion, $_POST['id']);
    $nom = mysqli_real_escape_string($connexion, $_POST['nom']);
    $prenom = mysqli_real_escape_string($connexion, $_POST['prenom']);

    //suppression de l'ancienne image 
    $query = "SELECT image FROM administrateurs WHERE idAdmine = ?";
    $stmt = $connexion->prepare($query);
    if (!$stmt) {
        die('Erreur lors de la préparation de la requête : ' . $connexion->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Vérifier s'il y a des résultats
    if ($result->num_rows > 0) {
        $ligne = $result->fetch_assoc();
        $imagePath = $ligne['image'];    
        // Vérifier si le chemin de l'image existe et n'est pas le chemin par défaut
        if (is_file($imagePath) && $imagePath != "../candidatPhotoProfil/user-profile-man.jpg") {
            if (unlink($imagePath)) {
                
            } else {
                echo "Erreur lors de la suppression du fichier image.";
            }
        } 
    } 

    $parties = explode('/', $imagePath);

    // Supprimer la dernière partie
    array_pop($parties);

    // Regrouper les parties restantes en une chaîne de caractères
    $uploadDir = implode('/', $parties);

    //inserer la nouvelle image
    $uploadDir .= '/';

    // Vérifier si le répertoire existe, sinon le créer
    if (!is_dir($uploadDir)) {
        // Créer le répertoire avec les permissions appropriées (par exemple, 0777)
        mkdir($uploadDir, 0777, true);
    }

    $uploadFile = $uploadDir . basename($_FILES['file']['name']);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
        // Utiliser une requête préparée pour éviter les attaques par injection
        $requete = "UPDATE administrateurs SET image = ? WHERE idAdmine = ?";
        $stmt = mysqli_prepare($connexion, $requete);
        mysqli_stmt_bind_param($stmt, "si", $uploadFile, $id);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($connexion);

            echo json_encode(['success' => 'Image téléchargée avec succès', 'imageUrl' => $uploadFile]);
        } else {
            echo json_encode(['error' => 'Erreur lors de la mise à jour de l\'image dans la base de données']);
            // Ajouter un message de débogage
            error_log('Erreur lors de la mise à jour de l\'image dans la base de données: '.mysqli_error($connexion));
        }
    } else {
        echo json_encode(['error' => 'Erreur lors du téléchargement de l\'image']);
        // Ajouter un message de débogage
        error_log('Erreur lors du déplacement du fichier temporaire');
    }
} else {
    echo json_encode(['error' => 'Requête invalide']);
    // Ajouter un message de débogage
    error_log('Requête invalide');
}
?>
