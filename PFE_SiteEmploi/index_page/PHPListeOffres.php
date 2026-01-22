<?php
include '../connexionBD/connexion.php';


$query_postes = "SELECT DISTINCT poste FROM offreemploi";
$result_postes = $connexion->query($query_postes);

if ($result_postes) {
    $postes = array();
    while ($row = $result_postes->fetch_assoc()) {
        $postes[] = $row['poste'];
    }
}


$resultats = array();
if (isset($_GET['recherche']) && $_GET['recherche'] == "✓") {
    
    $poste = $_GET['poste'];
   
 
    $query_recherche = "SELECT * FROM offreemploi WHERE poste LIKE ?";
    $statement = $connexion->prepare($query_recherche);

    $poste = '%' . $poste . '%';

    
    $statement->bind_param("s", $poste);
    $statement->execute();

   
    $result = $statement->get_result();
    
 
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $resultats[] = $row;
        }
    }
}
?>