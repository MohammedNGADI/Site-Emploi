<?php 
    include('../ConnexionBD/connexion.php') ;
    if (isset($_GET['affiche_tous']))
    {
        $requette = "SELECT nomComplet, object, message, dateMessage, idMessages,vu FROM messages ORDER BY dateMessage DESC ";
    }
    else{
        $requette = "SELECT nomComplet, object, message, dateMessage, idMessages,vu FROM messages ORDER BY dateMessage DESC LIMIT 3";
    }
    if ($resultat = mysqli_query($connexion, $requette))
    {
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Administrateur/boiteDesMessagesCSS.css">
    <title>EMPNEXUS-Boîte des Messages</title>
</head>
<body>

    <div class="tousLesMessages">
        <h1>Boite des messages : </h1>
        <form action="">
            <div class="divControle">
                <div class="checkbox">
                    <input type="checkbox" id="tous" >
                    <label for="tous">Sélectioner tous</label>
                </div>
                <div class="buttonSupprimerMessage" id="buttonSupprimerMessage">
                    <button title="supprimer" id="tousSupprimer" >
                        <img src='../SiteImages/administrateur/basket2.svg' alt=''>
                    </button>
                </div>
            </div>
            <?php
                    while ($ligne = mysqli_fetch_row($resultat))
                    {
                        if ($ligne[5] == 0)
                        {
                            $style = "style = 'background: rgba(155, 201, 234, 0.787)'" ;
                        }
                        else{
                            $style = "style = 'background: rgba(192, 214, 229, 0.787)'" ;
                        }
                        echo "
                        <div class='tousLeMessage' onclick='redirectToMessagePage($ligne[4])' $style >
                            <div class='divCheckBox'>
                                <input type='checkbox' class='selctionneMessage inputDeMessage' value='".$ligne[4]."' onclick='handleCheckboxClick(event)'>
                            </div>
                            <div class='nomExpediteur'>
                                ".$ligne[0]."
                            </div>
                            <div class='boiteMessage'>
                                <div class='Message'>
                                    <b>-$ligne[1] -</b> $ligne[2]
                                </div>
                                <div class='button'>
                                    <button title='supprimer ".$ligne[4]."' class='buttonSupprimerUneMessage' value='".$ligne[4]."'>
                                        <img src='../SiteImages/administrateur/basket2.svg' alt=''>
                                    </button>
                                </div>
                            <div class='date'>
                                $ligne[3]
                            </div>
                            </div>
                        </div>
                            ";
                    }
                }
                else{
                    echo mysqli_error($connexion);
                } 
                mysqli_close($connexion);
            ?>
        </form>
        <div class="voirTous">
            <?php
                if (!isset($_GET['affiche_tous']))
                {
                    echo "<a href='?affiche_tous=1'>Voir tous les messages</a>" ;
                }
                else{
                    echo "<a href='?'>Voir moins</a>" ;
                }
            ?>
        </div>
    </div>
    
    <script>
       document.addEventListener("DOMContentLoaded", function () {
    const selectAllCheckbox = document.getElementById("tous");
    const checkboxes = document.querySelectorAll(".selctionneMessage");
    const monBouton = document.getElementById("buttonSupprimerMessage");

    // Gestionnaire d'événements pour la case à cocher "Sélectionner tout"
    selectAllCheckbox.addEventListener("change", function () {
        var nbChecked = 0;
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = selectAllCheckbox.checked;
            if (checkbox.checked)
            {
                nbChecked++;
            }
        });
        if (nbChecked > 0)
                monBouton.style.display = selectAllCheckbox.checked ? "block" : "none";
        
        if(!selectAllCheckbox.checked)
        {
            monBouton.style.display = selectAllCheckbox.checked ? "block" : "none";
        }
    });

    // Gestionnaire d'événements pour chaque checkbox individuelle
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
            const auMoinsUneSelectionnee = Array.from(checkboxes).some(function (checkbox) {
                return checkbox.checked;
            });
               monBouton.style.display = auMoinsUneSelectionnee ? "block" : "none";

               var tousCoches = Array.from(checkboxes).every(function (checkbox) {
                return checkbox.checked;
            });

        // Cochez automatiquement le checkbox global si tous les autres sont cochés
            selectAllCheckbox.checked = tousCoches;
        });
    });

   

    // Gestionnaire d'événements pour le bouton de suppression
    const checkboxes2 = document.querySelectorAll(".inputDeMessage");
    const tousSupprimer = document.getElementById("tousSupprimer");

    tousSupprimer.addEventListener('click', function () {
        if (confirm("Êtes-vous sûr de vouloir supprimer ces offres ? ")) {
            var condition = "";
            checkboxes2.forEach(function (checkbox, index) {
                if (checkbox.checked) {
                    condition += (index > 0 ? " OR " : "WHERE ") + "idMessages = " + checkbox.value;
                }
            });

            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        
                        if (response.reponse === "estSupprimer") {
                            location.reload(true);
                            alert(response.nbSupprimer + " offres ont été supprimées avec succès");
                        }

                    } else {
                        alert('Erreur de requête: ' + xhr.status);
                    }
                }
            };

            xhr.open('GET', 'supprimerMessage.php?Condition=' + condition, true);
            xhr.send();
        }
    });
});


const buttons1 = document.querySelectorAll('.buttonSupprimerUneMessage');

buttons1.forEach(button => {
    button.addEventListener('click', function () {
        if (confirm("Êtes-vous sûr de vouloir supprimer cet message ? ")) {
            const id = this.value;
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            const response = JSON.parse(xhr.responseText);
                            if (response.reponse === "estSupprimer") {
                                location.reload(true);
                                alert("Le message a été supprimé avec succès");
                            }
                        } else {
                            console.error('Erreur de requête: ' + xhr.status);
                        }
                    }
                };

                xhr.open('GET', 'supprimerUnMessage.php?idMessage=' + id, true);
                xhr.send();
        }
    
    });
    
});
    </script>

    <script>
        function redirectToMessagePage(messageId) {
            window.location.href = 'afficheMessage.php?id=' + messageId;
        }
        function handleCheckboxClick(event) {
        // Empêcher la propagation de l'événement au parent
        event.stopPropagation();
    }
    </script>
</body>
</html>
