<?php
    session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../SiteImages/administrateur/logoSiteEmploi2.jpg" type="image/jpg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Candidat/RechercheDetaille.css">
    <title>EMPNEXUS-Rechercher une offre</title>
</head>
<body>
    <?php
        include './enTete.php'; ?>

    <div class="conteneur">
        <form method="POST" action="./resultats_recherche.php" class="formulaire-recherche" onsubmit="return validateForm()">
            <div class="champ">
                <label for="poste">Poste : <b style="color:red">*</b> </label>
                <input type="text" id="poste" name="poste" class="poste">
            </div>
            <div class="champ">
                <label for="datedebut">Date de début : </label>
                <input type="date" id="datedebut" name="datedebut" class="datedebut">
            </div>
            <div class="champ">
                <label for="datefin">Date de fin :</label>
                <input type="date" id="datefin" name="datefin" class="datefin">
            </div>
            <div class="champ">
                <label for="typecontrat">Type de contrat : </label>
                <select id="typecontrat" name="typecontrat" class="typecontrat">
                    <option value="">-- Sélectionnez --</option>
                    <option value="CDI">CDI</option>
                    <option value="CDD">CDD</option>
                    <option value="Stage">Stage</option>
                    <option value="Alternance">Alternance</option>
                </select>
            </div>
            <div class="champ">
                <label for="ville">Ville : </label>
                <input type="text" id="ville" name="ville" class="ville">
            </div>
            <div class="champ">
                <label for="competence">Compétences requises: </label>
                <input type="text" id="competence" name="competence" min="0" class="competence">
            </div>
            <div class="champ">
                <label for="experience">Expérience : </label>
                <input type="text" id="experience" name="experience" min="0" class="experience">
            </div>
            <div class="bouton">
                <button type="submit">Rechercher</button>
            </div>
        </form>
    </div>
    <div class="notificationSaisie">
        Veuillez remplir le champs Poste
    </div>
    
    <?php include '../footer/footer4.php'; ?>    

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var form = document.querySelector("form");
            var notification = document.querySelector(".notificationSaisie");

            form.addEventListener("submit", function(event) {
                var poste = form.querySelector(".poste").value.trim();
                var datedebut = form.querySelector(".datedebut").value.trim();
                var typecontrat = form.querySelector(".typecontrat").value.trim();
                var ville = form.querySelector(".ville").value.trim();
                var experience = form.querySelector(".experience").value.trim();
                var competence = form.querySelector(".competence").value.trim();

                if (poste === "") {
                    notification.classList.add("active");
                    setTimeout(function() {
                        notification.classList.remove("active");
                    }, 4000);
                    event.preventDefault();
                }
            });
        });

    </script>
</body>
</html>
