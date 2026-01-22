<?php
include('../ConnexionBD/connexion.php');

if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données : " . $connexion->connect_error);
}

$id_offre = $_GET['idOffre'];
$query = "SELECT  e.nom , o.poste, e.ville, o.dateFinOffre , o.description
                , o.competences, o.datePublication , o.typeContrat , o.salaire
                , o.experiences , e.logo
                FROM offreemploi o INNER JOIN entreprise e
                ON e.id_entreprise = o.id_entreprise
                WHERE id_offre = ?"
                ;

$stmt = $connexion->prepare($query);
$stmt->bind_param("i", $id_offre);

$stmt->execute();

$stmt->bind_result($nom, $poste, $ville, $dateDeFin, $description, $competences,
$datePubluication, $contrat, $salaire, $experiences,$logo);
$stmt->fetch();

ob_clean();

$response = array(
    "nom" => $nom,
    "ville" => $ville,
    "datePublication" => $datePubluication,
    "poste" => $poste,
    "description" => $description,
    "salaire" => $salaire,
    "competences" => $competences,
    "contrat" => $contrat,
    "experiences" => $experiences,
    "dateDeFin" => $dateDeFin,
    "logo" => $logo
);

echo json_encode($response);

$stmt->close();
$connexion->close();
?>
