document.addEventListener('DOMContentLoaded', function() {
    const btnPostulation = document.querySelector('.btnPostulation');
    const ConfirmationEtMessage = document.querySelector('.ConfirmationEtMessage');
    const MessagePostulation = document.querySelector('.MessagePostulation');
    const MessageSuppression = document.querySelector('.MessageSuppression');
    const MessageDejaPostulation = document.querySelector('.MessageDejaPostulation');
    const MessageDejaSupprimee = document.querySelector('.MessageDejaSupprimee');

    const Oui = document.getElementById('Oui');
    const Non = document.getElementById('Non');

    const ConfirmationEtMessageSupp = document.querySelector('.ConfirmationEtMessageSupp');
    const btnSupprimerPostulation = document.querySelector('.btnSupprimerPostulation');

    const NonS = document.getElementById('NonS');
    const OuiS = document.getElementById('OuiS');

    if (btnPostulation) {
        btnPostulation.addEventListener('click', function() {
            ConfirmationEtMessage.style.display = "flex";
        });
    }

    if (btnSupprimerPostulation) {
        btnSupprimerPostulation.addEventListener('click', function() {
            ConfirmationEtMessageSupp.style.display = "flex";
        });
    }

    if (Oui) {
        Oui.addEventListener('click', function() {
            // Créez une instance de l'objet XMLHttpRequest
            const xhr = new XMLHttpRequest();

            // Configurez la requête AJAX
            xhr.open("POST", "./postulation.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Définissez la fonction de rappel lorsque la requête est terminée
            
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Traitez la réponse du serveur
                        if (xhr.responseText === "success") {
                            MessagePostulation.classList.add('hidden');
                            setTimeout(function() {
                                MessagePostulation.classList.remove('hidden');
                                window.location.reload();
                            }, 6000);
                        } else if (xhr.responseText === "dejaPostule") {
                            console.log('faild');
                            MessageDejaPostulation.classList.add('hidden');
                            setTimeout(function() {
                                MessageDejaPostulation.classList.remove('hidden');
                                window.location.reload();
                            }, 6000);
                        } else {
                            console.error("Une erreur s'est produite lors de l'insertion de la postulation");
                        }
                    } else {
                        // Affichez un message d'erreur si la requête a échoué
                        console.error("Une erreur s'est produite lors de l'insertion de la postulation");
                    }
                }
            };

            // Envoyez les données au serveur
            xhr.send();
            
            ConfirmationEtMessage.style.display = "none";
        });
    }

    if (OuiS) {
        OuiS.addEventListener('click', function() {
            const xhr = new XMLHttpRequest();
            ConfirmationEtMessageSupp.style.display = "none";
            // Configurez la requête AJAX
            xhr.open("POST", "./SupprimerPostulation.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
            // Définissez la fonction de rappel lorsque la requête est terminée
            
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        if (xhr.responseText === "success") {
                            MessageSuppression.classList.add('hidden');
                            setTimeout(function() {
                                MessageSuppression.classList.remove('hidden');
                                window.location.reload();
                            }, 6000);
                        } else if (xhr.responseText === "dejaSupprimer") {
                            MessageDejaSupprimee.classList.add('hidden');
                            setTimeout(function() {
                                MessageDejaSupprimee.classList.remove('hidden');
                                window.location.reload();
                            }, 6000);
                        } else {
                            console.error("Une erreur s'est produite lors de la suppression de la postulation");
                        }
                    } else {
                        // Affichez un message d'erreur si la requête a échoué
                        console.error("Une erreur s'est produite lors de la suppression de la postulation");
                    }
                }
            };
    
            // Envoyez les données au serveur
            xhr.send();
            
            ConfirmationEtMessage.style.display = "none";
        });
    }
    

    if (Non) {
        Non.addEventListener('click', function() {
            ConfirmationEtMessage.style.display = "none";
        });
    }

    if (NonS) {
        NonS.addEventListener('click', function() {
            ConfirmationEtMessageSupp.style.display = "none";
        });
    }
});
