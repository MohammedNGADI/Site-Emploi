// ------------------ Photo Profil ------------------ //

let profilPic = document.getElementById("profile-pic");
let inputfile = document.getElementById("photoProfil");
// Gestion de l'événement onchange de l'input file
inputfile.onchange = function(event) {
    event.preventDefault(); // Empêche le rechargement de la page

    // Création d'un objet FormData pour envoyer les données du formulaire
    let formData = new FormData();
    formData.append('photo', inputfile.files[0]);

    // Envoi de la requête fetch pour enregistrer la photo
    fetch('./changerImage.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Une erreur s\'est produite lors de l\'enregistrement de la photo.');
        }
        return response.text();
    })
    .then(data => {
        console.log('Photo enregistrée avec succès:', data);
        // Met à jour l'aperçu de la photo
        profilPic.src = URL.createObjectURL(inputfile.files[0]);
        Window.location.href = "./CandidatProfil.php";
    })
    .catch(error => {
        console.error('Erreur lors de l\'enregistrement de la photo:', error);
    });
};



// ------------------ Affichage de form PopUp ------------------ //


document.addEventListener('DOMContentLoaded', function() {
    const cross = document.querySelector('.cross');
    const FormPopUP = document.querySelector('.FormPopUP');
    const edit = document.querySelector('.bxs-edit');

    cross.addEventListener('click', function() {
        FormPopUP.style.display = 'none'; 
    });

    edit.addEventListener('click', function() {
        FormPopUP.style.display = 'flex'; 
    });
});

// ------------------ Données Personelles ------------------ //
document.addEventListener('DOMContentLoaded', function() {
    const DPers = document.getElementById("DPers");
    const FormDonneesPersonnelles = document.querySelector('.fromDonneesPersonel');
    const notificationDP = document.querySelector('.notificationDP');
    const FormPopUP = document.querySelector('.FormPopUP');

    DPers.addEventListener('click', function(event) {
        event.preventDefault(); // Empêcher le comportement par défaut du formulaire

        // Récupérer les données du formulaire
        const formData = new FormData(FormDonneesPersonnelles);

        // Envoyer les données du formulaire via fetch
        fetch('./CandidatProfil.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Une erreur s\'est produite.');
            }
            return response.text();
        })
        .then(data => {
            if (data.trim() === 'Veuillez remplir tous les champs') {
                alert('Veuillez remplir tous les champs');
            } else {
                // Afficher la notification après avoir reçu la réponse
                FormPopUP.style.display = 'none'; 
                notificationDP.classList.add('show');
                setTimeout(function() {
                    notificationDP.classList.remove('show');
                    window.location.reload(); 
                }, 3000);
            }
        })
        
        
        
        .catch(error => {
            console.error('Erreur:', error);
        });
    });
});

// ------------------ Coordonées ------------------ //


document.addEventListener('DOMContentLoaded', function() {
    const formCoordonnees = document.getElementById("formCoordonnees");
    const notificationC = document.querySelector('.notificationC');

    formCoordonnees.addEventListener('submit', function(event) {
        event.preventDefault(); // Empêcher le comportement par défaut du formulaire

        // Récupérer les données du formulaire
        const formData = new FormData(formCoordonnees);

        // Envoyer les données du formulaire via fetch
        fetch('./CoordonneesUpdate.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Une erreur s\'est produite.');
            }
            return response.text();
        })
        .then(data => {
            // Afficher la notification après avoir reçu la réponse
            notificationC.classList.add('show');
            setTimeout(function() {
                notificationC.classList.remove('show');
                window.location.reload(); // Recharger la page après l'affichage de la notification
            }, 3000);
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
    });
});

// ------------------ Données Profesionelles ------------------ //


document.addEventListener('DOMContentLoaded', function() {
    const formDonneesProfessionnelles = document.getElementById("formDonneesProfessionnelles");
    const notificationDP = document.querySelector('.notificationDP');

    formDonneesProfessionnelles.addEventListener('submit', function(event) {
        event.preventDefault(); // Empêcher le comportement par défaut du formulaire

        // Récupérer les données du formulaire
        const formData = new FormData(formDonneesProfessionnelles);

        // Envoyer les données du formulaire via fetch
        fetch('./DonneesProfUpdate.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Une erreur s\'est produite.');
            }
            return response.text();
        })
        .then(data => {
            // Afficher la notification après avoir reçu la réponse
            notificationDP.classList.add('show');
            setTimeout(function() {
                notificationDP.classList.remove('show');
                window.location.reload(); // Recharger la page après l'affichage de la notification
            }, 3000);
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
    });
});



// ------------------ Modification Du CV ------------------ //

document.addEventListener('DOMContentLoaded', function() {
    const formCV = document.querySelector('.ModificationCV');
    const notificationCVUpdated = document.querySelector('.notificationCV');

    formCV.addEventListener('submit', function(event) {
        event.preventDefault(); // Empêcher le comportement par défaut du formulaire

        // Récupérer le fichier CV
        const CVFile = document.querySelector('.CVinput').files[0];
        const notificationPasswordsNotIdentical = document.getElementById('PasswordsNotIdentique');

        // Vérifier si un fichier CV a été sélectionné
        if (CVFile) {
            // Envoyer les données du formulaire via AJAX
            const formData = new FormData(formCV);
            formData.append('CV', CVFile);

            fetch('./UpdateCV.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Une erreur s\'est produite.');
                }
                return response.text();
            })
            .then(data => {
                if (data === "Fichier téléchargé avec succès. CV mis à jour dans la base de données.success") {
                    notificationCVUpdated.classList.add('show');
                    setTimeout(function() {
                        notificationCVUpdated.classList.remove('show');
                        window.location.reload(); // Recharger la page après l'affichage de la notification
                    }, 3000);
                } else {
                    console.error('Erreur:', data);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
            });
        } else {
            notificationPasswordsNotIdentical.innerHTML = "<h3>Veuillez sélectionner un fichier CV.</h3>";
            notificationPasswordsNotIdentical.classList.add('show');
            setTimeout(function() {
                notificationPasswordsNotIdentical.classList.remove('show');
            }, 8000);
            return;
        }
    });
});




// ------------------ Mot de Passe ------------------ //

document.addEventListener('DOMContentLoaded', function() {
    const formPassword = document.querySelector('.ModificationPassword');
    const notificationOldPasswordIncorrect = document.querySelector('.notificationOldPasswordIncorrect');
    const notificationPasswordUpdated = document.querySelector('.notificationPasswordUpdated');
    const notificationPasswordsNotIdentical = document.getElementById('PasswordsNotIdentique');

    formPassword.addEventListener('submit', function(event) {
        event.preventDefault(); // Empêcher le comportement par défaut du formulaire

        // Récupérer les données du formulaire
        const oldPassword = document.querySelector('input[name="oldPassword"]').value;
        const newPassword = document.querySelector('input[name="newPassword"]').value;
        const newPasswordConfirm = document.querySelector('input[name="newPasswordConfirm"]').value;

        if (newPassword.trim() == "" || newPasswordConfirm.trim() =="") {
            notificationPasswordsNotIdentical.innerHTML = "<h3>Tous les champs sont obligatoires.</h3><p>Veuillez remplir tous les informations.</p>";
            notificationPasswordsNotIdentical.classList.add('show');
            setTimeout(function() {
                notificationPasswordsNotIdentical.classList.remove('show');
            }, 8000);
            return;
        }

        if (newPassword.trim().length < 8 || newPasswordConfirm.trim().length < 8) {
            notificationPasswordsNotIdentical.innerHTML = "<h3>Le nouveau mot de passe doit contenir au moins 8 caractères.</h3><p>Veuillez résillez.</p>";
            notificationPasswordsNotIdentical.classList.add('show');
            setTimeout(function() {
                notificationPasswordsNotIdentical.classList.remove('show');
            }, 8000);
            return;
        }

        // Vérifier si les nouveaux mots de passe correspondent
        if (newPassword !== newPasswordConfirm) {
            notificationPasswordsNotIdentical.classList.add('show');
            setTimeout(function() {
                notificationPasswordsNotIdentical.classList.remove('show');
            }, 8000);
            return;
        }

        // Envoyer les données du formulaire via AJAX
        const formData = new FormData();
        formData.append('oldPassword', oldPassword);
        formData.append('newPassword', newPassword);

        fetch('./PasswordUpdate.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Une erreur s\'est produite.');
            }
            return response.text();
        })
        .then(data => {
            if (data === "success") {
                notificationPasswordUpdated.classList.add('show');
                setTimeout(function() {
                    notificationPasswordUpdated.classList.remove('show');
                    window.location.reload(); // Recharger la page après l'affichage de la notification
                }, 5000);
            } else if (data === "old_password_incorrect") {
                notificationOldPasswordIncorrect.classList.add('show');
                setTimeout(function() {
                    notificationOldPasswordIncorrect.classList.remove('show');
                }, 8000);
            } else {
                console.error('Erreur:', data);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
    }); 
});

