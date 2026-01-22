<?php
            include('enTete.php') ; 
            include ('bareDeNavigationGauche.html'); 
        ?>
<?php
    include('../ConnexionBD/connexion.php') ;
    if (isset($_GET['id']))
    {
        $idMessage = $_GET['id'];
        $requete = "UPDATE messages SET vu = 1 WHERE idMessages = $idMessage " ;
        mysqli_query($connexion, $requete);
        $requette = "SELECT nomComplet, object, message, dateMessage,adresseEmail, idMessages FROM messages WHERE idMessages = $idMessage";
        if ($resultat = mysqli_query($connexion, $requette))
        {
            $ligne = mysqli_fetch_row($resultat);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Administrateur/afficheMessageCSS.css">
    <title><?php echo $ligne[1] ; ?></title>
</head>
<body>

    <div class="tousElementMessage">
        <div class="Object">
            <?php echo $ligne[1] ; ?>
        </div>
        <div class="informationExpediteur">
            <div class="nomComplet">
                <div class="iconAvecLettre">
                    <?php echo $ligne[0][0] ; ?>
                </div>
                <div class="nomComplet_Email">
                    <div class="nomPrenom"><?php echo $ligne[0] ; ?></div>
                    <div class="email">
                    <?php echo $ligne[4] ; ?>
                    </div>
                </div>
            </div>
            <div class="dateEnvoyeMessage">
            <?php echo $ligne[3] ; ?>
            </div>
        </div>
        <div class="leMessageComplet">
            <p>
            <?php echo $ligne[2] ; ?>
            </p>
        </div>
        <div class="deuxButton">
            <div class="buttonRependre">
                <a href="mailto: <?php echo $ligne[4] ;  ?>">Répendre</a>
            </div>
            <div class="buttonSupprimer">
                <button value="<?php echo $ligne[5] ;?>" id="buttonSupprimerMessage2">Supprimer</button>
            </div>
        </div>
    </div>
    <?php }
    }
    mysqli_close($connexion);?>

    <script>
         document.addEventListener("DOMContentLoaded", function () {
        const button = document.getElementById('buttonSupprimerMessage2');
        button.addEventListener('click', function () {
        if (confirm("Êtes-vous sûr de vouloir supprimer cet message ? ")) {
            const id = this.value;
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            const response = JSON.parse(xhr.responseText);
                            if (response.reponse === "estSupprimer") {
                                alert("Le message a été supprimé avec succès");
                                window.history.replaceState({}, document.title, 'messages.php');
                                window.location.href = 'messages.php';
                            }
                        } else {
                            alert("Le message n'a été pas supprimé à cause de : " + xhr.status);
                            
                        }
                    }
                };

                xhr.open('GET', 'supprimerUnMessage.php?idMessage=' + id, true);
                xhr.send();
        }
    
    });
    
});
    </script>
</body>
</html>