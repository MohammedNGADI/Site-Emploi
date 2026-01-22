<?php
        include('enTete.php') ;
        include ('bareDeNavigationGauche.html'); 
    ?>
<?php
 include('../ConnexionBD/connexion.php') ;  
 $requtte = "SELECT nom, prenom, adresse, idAdmine, email, nTelephone, image FROM administrateurs where idAdmine = $id";
 if ($resultat = mysqli_query($connexion,$requtte))
    {
        $ligne = mysqli_fetch_row($resultat);
        $nom = strtoupper($ligne[0]); // Convertir le nom en majuscules
        $prenom = ucfirst(strtolower($ligne[1]));
        $adresse = $ligne[2];
        $idAdmine = $ligne[3];
        $email = $ligne[4];
        $nTelephone = $ligne[5];
        $image = $ligne[6] ;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link rel="stylesheet" href="../CSS/Administrateur/administrateurProfilCSS.css">
    <link rel="stylesheet" href="../CSS/Administrateur/swiper-bundle.min.css">
    <title>EMPNEXUS-MON Profil</title>
    <style>
        .PhotoP{
            width: 130px;
            height: 130px;
        }
    </style>
</head>
<body>

<div class="profilAdministrateur">
   <div class="couleurArrierePlan">
        <div class="imageArrierePlan">
            <div class="imageProfil">
                <img src="<?php echo $image ?>" alt="" >
                <div class="infoPersonnel">
                    <div class="nomComplet"><?php echo $prenom.' '.$nom ?></div>
                    <div class="adresse"><?php echo $adresse ?></div>
                </div>
            </div>
        </div> 
        <div class="infoAdministrateur">
            <div class ="divButtonModifier">
                <button id="btnAfficherFormulaire">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                </button>
            </div>
            <div id="formulairePopup">
                <h2>Modifié les informations personnels :</h2>
                <span class="fermerFormulaire" onclick="fermerFormulaire()">X</span>
                <div class="form">
                    <h6 class="indicationChamp">* Indique un champ obligatoirei</h6>
                     <div class="imageProfilFormulaire">
                        <img src="<?php echo $image ?>" alt="" id="profile-pic" class="PhotoP">
                        <label for="PhotoP" class="choisiPhoto"><i class='bx bx-upload'></i></label>
                        <input type="file" name="PhotoP" id="PhotoP" class="PhotoPinput" accept="image/jpeg, image/jpg, image/png">
                        <button class="btnChangerImage" id="uploadBtn">Changer l'image</button>
                     </div>  
                    <label for="nom">* Nom:</label>
                    <input type="text" id="nom" value="<?php echo $nom ?>">
                    <label for="prenom" >* Prénom:</label>
                    <input type="text" id="prenom" value="<?php echo $prenom ?>">
                    <label for="adresse">* Adresse:</label>
                    <input type="text" id="adresse" value="<?php echo $adresse ?>">
                    <button value="<?php echo $idAdmine ?>" type="submit" class="BtnFormulaireInfo"  >Enregistrer</button>
                </div>
            </div>
        </div>
    </div>
    





    <div class="couleurArrierePlan">
        <div class="coordonne">
            <h2>Modifiez vos coordonnées</h2>
            <div class="email " id="cliquable"><span class="titreCoordonne">Adresse e-mail </span><span class="value"><?php echo $email ?></span>
                <span class="iconModifier" id="iconModifier">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16" id="icone">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>  
                    </svg>
                </span>
            </div>

            <div class="changerEmail" id="aAficher">
                    <label for="ema">Entrer le nouveau e-email:</label>
                    <input type="text" id="ema" placeholder="Ex:exemple@gmail.com">
                    <button type="submit" value="<?php echo $idAdmine?>" class="enregistrerButton">Enregistrer</button>
            </div>

            <div class="telephone" id="cliquable2"><span  class="titreCoordonne">Téléphone </span><span class="value"><?php echo $nTelephone ?></span>
                <span class="iconModifier" id="iconModifier2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16" id="icone">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"/>  
                    </svg>
                </span>
            </div>

            <div class="changerTelephone" id="aAfficher2">
                    <label for="tel">Entrer le nouveau télephone:</label>
                    <input type="text" id="tel" placeholder="Ex: 06 00 00 00 00">
                    <button type="submit" value="<?php echo $idAdmine ?>" class="enregistrerButton" value="<?php echo $idAdmine?>">Enregistrer</button>               
            </div>
        </div>
    </div>


    <div class="couleurArrierePlan">
        <div class="changerPasswd">
            <h2>Modifiez votre mot de passe</h2>
                <label for="ancienne">Ancienne mot de passe : </label>
                <input type="password" id="ancienne" placeholder="Entrez votre ancien mot de passe">
                <label for="passw">Nouveau mot de passe : </label>
                <input type="password" id="passw" name="nouveauPassword" placeholder="Entrez votre nouveau mot de passe">
                <label for="conf">Confimation de nouveau mot de passe : </label>
                <input type="password" id="conf" name="confirmation" placeholder="Confirmez votre nouveau mot de passe">
                <button class="formulairePassword" value="<?php echo $idAdmine ?>">Enregistrer</button>
        </div>
    </div>

    <!--la carosel-->
    <h1 class="titreAdministrateur">Explorez notre équipe d'administrateurs :</h1>
    <div class="tousLesAdministrateurs">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php 
                    $sql = "SELECT nom, prenom, email, nTelephone, adresse, image FROM administrateurs";
                    if ($resultat = mysqli_query($connexion, $sql))
                    {
                        while($ligne =  mysqli_fetch_assoc($resultat))
                        {   
                            echo 
                            "
                                <div class='swiper-slide'>
                                    <div class='card'>
                                        <div class='image-content'>
                                            <span class='overlay'></span>
                                            <div class='card-image'>
                                                <img src='".$ligne['image']."' alt='' class='card-img'>   
                                            </div>
                                        </div>
                    
                                        <div class='card-content'>
                                            <h2 class='name'>".ucfirst(strtolower($ligne['prenom']))." ".strtoupper($ligne['nom'])."</h2>
                                            <P class='adresse'>
                                                ".$ligne['adresse']."
                                            </P>
                                            <div class='communication'>
                                                <a href='https://wa.me/".$ligne['nTelephone']."' title='".$ligne['nTelephone']."'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-whatsapp' viewBox='0 0 16 16'>
                                                        <path d='M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232'/>
                                                    </svg>
                                                </a>
                                                <a href='mailto:".$ligne['email']."' title='".$ligne['email']."'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-envelope-at-fill' viewBox='0 0 16 16'>
                                                        <path d='M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671'/>
                                                        <path d='M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791'/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ";
                        }
                    }
                    else{
                        echo "erreur : ".mysqli_error($connexion);
                    }
                    mysqli_close($connexion);
                ?>
              
                   
             
              
            </div>
            <div class="swiper-button-next" id="next"></div>
            <div class="swiper-button-prev" id="prev"></div>
            <div class="swiper-pagination"></div>
          </div>
          
    </div>
    
</div>
    

    







<script src="../CSS/Administrateur/swiper-bundle.min.js"></script>
<script>
    // Fonction pour afficher la formulaire
    function afficherFormulaire() {
    // Désactiver le défilement de la page
    document.body.style.overflow = 'hidden';

    var formulaire = document.getElementById('formulairePopup');
    formulaire.style.display = 'block';

    // Centrer le formulaire sur la vue de l'utilisateur
    formulaire.style.top = '50%';
    formulaire.style.left = '50%';
    formulaire.style.transform = 'translate(-50%, -50%)';

    // Écouteur d'événements pour fermer le formulaire si l'utilisateur clique en dehors
    window.addEventListener('mousedown', fermerFormulaireEnDehors);
}

    // Fonction pour fermer la formulaire
    function fermerFormulaire() {
        var formulaire = document.getElementById('formulairePopup');
        formulaire.style.display = 'none';
        document.body.style.overflow = 'auto';
        // Retirer l'écouteur d'événements après la fermeture de la formulaire
        window.removeEventListener('mousedown', fermerFormulaireEnDehors);
    }

    // Fonction pour fermer la formulaire si l'utilisateur clique en dehors
    function fermerFormulaireEnDehors(event) {
    var formulaire = document.getElementById('formulairePopup');

    // Vérifier si l'utilisateur a cliqué en dehors du formulaire
    if (event.target !== formulaire && !formulaire.contains(event.target)) {
        // Réactiver le défilement de la page
        document.body.style.overflow = 'auto';

        // Masquer le formulaire
        formulaire.style.display = 'none';

        // Retirer l'écouteur d'événements pour éviter des problèmes futurs
        window.removeEventListener('mousedown', fermerFormulaireEnDehors);
    }
}

    // Écouteur d'événements pour afficher la formulaire au clic sur le bouton
    document.getElementById('btnAfficherFormulaire').addEventListener('click', afficherFormulaire);

</script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const icone = document.getElementById('iconModifier');
        const divAfficher = document.getElementById('aAficher');
        const cliquable = document.getElementById('cliquable');
        cliquable.addEventListener('click', function () {
            divAfficher.style.display = divAfficher.style.display === 'block' ? 'none' : 'block';
            icone.style.transform = icone.style.transform === 'rotate(-180deg)' ? 'rotate(0deg)' : 'rotate(-180deg)';
        });

        const icone2 = document.getElementById('iconModifier2');
        const divAfficher2 = document.getElementById('aAfficher2');
        const cliquable2 = document.getElementById('cliquable2');
        cliquable2.addEventListener('click', function () {
            divAfficher2.style.display = divAfficher2.style.display === 'block' ? 'none' : 'block';
            icone2.style.transform = icone2.style.transform === 'rotate(-180deg)' ? 'rotate(0deg)' : 'rotate(-180deg)';
        });
    });
</script>

<script src="../CSS/Administrateur/swiper-bundle.min.js"></script>

<!-- js Swiper-->
<script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 3,
      spaceBetween: 25,
      loop: true,
      centerSlide: 'true',
      fade: 'true',
      grabCursor: 'true',
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets:true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>

    <script>
            document.getElementsByClassName("enregistrerButton")[0].addEventListener("click", function(event) {
                var nouvelEmail = document.getElementById("ema").value;
                const id = document.getElementsByClassName("enregistrerButton")[0].value;
                // Vérifier si le champ e-mail est vide ou ne contient pas "@"
                if (nouvelEmail.trim() === "" || !nouvelEmail.includes("@")) {
                    alert("Veuillez entrer un nouvel e-mail valide avant de soumettre le formulaire.");
                    
                }
                else{
                    const xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4) {
                            console.log("Réponse du serveur :", xhr.responseText);
                            if (xhr.status === 200) {
                                const reponse = JSON.parse(xhr.responseText);
                                const reponceDeModification = reponse.modifie;
                                if (reponceDeModification == "oui2") {
                                    alert("le numéro de téléphone  a été modifie.");
                                    window.location.reload()
                                } else {
                                    alert(reponceDeModification);
                                }
                            } else {
                                alert('Erreur de requête: ' + xhr.status);
                            }
                        }
                    };

                    xhr.open('GET', 'recupererMotDepasse.php?id=' + id + '&nouveauEmail=' + encodeURIComponent(nouvelEmail) , true);
                    xhr.send();
                }
            });

        

    </script>

<script>
    document.getElementsByClassName("enregistrerButton")[1].addEventListener("click", function(event) {
        var numeroTelephone = document.getElementById("tel").value.trim();
        const id = document.getElementsByClassName("enregistrerButton")[1].value ;
        // Vérification du format avec une expression régulière
        var formatTelephone = /^(?:\+212|0)([5-7]\d{8})$/;

        if (!formatTelephone.test(numeroTelephone)) {
            alert("Veuillez entrer un numéro de téléphone valide.");
            event.preventDefault(); // Empêche la soumission du formulaire
        }else{
            //var longueurMinimale = 10; // Par exemple, au moins un chiffre
           // var longueurMaximale = 15; // Vous pouvez ajuster selon vos besoins
            if (numeroTelephone.trim().length < longueurMinimale || numeroTelephone.trim().length > longueurMaximale) {
                alert("Veuillez entrer un numéro de téléphone valide avec la bonne longueur.");
            
            }
            else{
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4) {
                        console.log("Réponse du serveur :", xhr.responseText);
                        if (xhr.status === 200) {
                            const reponse = JSON.parse(xhr.responseText);
                            const reponceDeModification = reponse.modifie;
                            if (reponceDeModification == "oui2") {
                                alert("le numéro de téléphone  a été modifie.");
                                window.location.reload()
                            } else {
                                alert(reponceDeModification);
                            }
                        } else {
                            alert('Erreur de requête: ' + xhr.status);
                        }
                    }
                };

                xhr.open('GET', 'recupererMotDepasse.php?id=' + id + '&nouveauTelephone=' + encodeURIComponent(numeroTelephone) , true);
                xhr.send();
            }
        }  
    });
</script>
<script>
   
   document.getElementsByClassName("formulairePassword")[0].addEventListener("click", function (event) {
    var ancienMotDePasse = document.getElementById("ancienne").value;
    const id = document.getElementsByClassName("formulairePassword")[0].value;
    const nouveauPassword = document.getElementById("passw").value ;
    var confirmationMotDePasse = document.getElementById("conf").value;


    if (ancienMotDePasse.trim() === "" || nouveauPassword.trim()==="" || confirmationMotDePasse.trim() === "") {
            alert("Veuillez remplir tous les champs.");
        }else{
            if (nouveauPassword.length < 8 && confirmationMotDePasse.length < 8) {
    alert("Le nouveau mot de passe doit contenir au moins 8 caractères.");
}

            else{
                if ( nouveauPassword == confirmationMotDePasse)
                {
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            console.log("Réponse du serveur :", xhr.responseText);
            if (xhr.status === 200) {
                const reponse = JSON.parse(xhr.responseText);
                const reponceDeModification = reponse.modifie;
                if (reponceDeModification == "oui") {
                    alert("Mot de passe est modifié");
                    window.location.reload();
                } else {
                    alert("Ancien mot de passe incorrect");
                }
            } else {
                alert('Erreur de requête: ' + xhr.status);
            }
        }
    };

    xhr.open('GET', 'recupererMotDepasse.php?id=' + id + '&anciennePassword=' + encodeURIComponent(ancienMotDePasse) + '&nouveauPassword=' + encodeURIComponent(nouveauPassword), true);
    xhr.send();
            }
            else{
            alert("le nouveau mot de passe et sa confirmation ne sont pas identique.");
        }
        }
        
        }
    
});
</script>

<!-- la formulaire de information -->
<script>
    document.getElementsByClassName('BtnFormulaireInfo')[0].addEventListener("click", function (event) {
        const nom = document.getElementById('nom').value;
        const prenom = document.getElementById('prenom').value;
        const adresse = document.getElementById('adresse').value;
        const id = document.getElementsByClassName('BtnFormulaireInfo')[0].value;

        if (nom.trim() === "" || prenom.trim() === "" || adresse.trim() === "") {
            alert("Veuillez remplir tous les champs !");
        } else {
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    console.log("Réponse du serveur :", xhr.responseText);
                    if (xhr.status === 200) {
                        const reponse = JSON.parse(xhr.responseText);
                        const reponseDeModification = reponse.modifie;
                        if (reponseDeModification === "oui") {
                            alert("Les informations ont été modifiées avec succès.");
                            window.location.reload();
                        } else {
                            alert(reponseDeModification);
                        }
                    } else {
                        alert('Erreur de requête: ' + xhr.status);
                    }
                }
            };

            xhr.open('POST', 'modifierInfoPersonnel.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('id=' + id + '&nom=' + encodeURIComponent(nom) + '&prenom=' + encodeURIComponent(prenom) + '&adresse=' + encodeURIComponent(adresse));
        }
    });
</script>

<script>
        let profilPic = document.getElementById("profile-pic");
        let inputfile = document.getElementById("PhotoP");

        inputfile.onchange = function() {
            profilPic.src = URL.createObjectURL(inputfile.files[0]);
        };

    $(document).ready(function () {
        $("#uploadBtn").on("click", function () {
            var fileInput = document.getElementById('PhotoP');
            var file = fileInput.files[0];
            var id = document.getElementsByClassName('BtnFormulaireInfo')[0].value; // Remplacez ceci par l'ID réel
            var nom = document.getElementById('nom').value ; // Remplacez ceci par le nom réel
            var prenom = document.getElementById('prenom').value ; // Remplacez ceci par le prénom réel

            if (file) {
                var formData = new FormData();
                formData.append('file', file);
                formData.append('id', id);
                formData.append('nom', nom);
                formData.append('prenom', prenom);

                $.ajax({
                    url: 'changerImage.php', // Chemin vers le script PHP côté serveur
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        console.log('Réponse du serveur :', data);
                        // Traiter la réponse ici
                        alert("Image téléchargée avec succès!");
                        window.location.reload();
                    },
                    error: function (xhr, status, error) {
                        console.log('Erreur lors de la requête AJAX :', xhr, status, error);
                        alert("Erreur lors du téléchargement de l'image.");
                    }
                });
            } else {
                alert("Veuillez sélectionner une image.");
            }
        });
    });

    </script>
</body>
</html>
<?php
include('../footer/footer.php') ;
?>
