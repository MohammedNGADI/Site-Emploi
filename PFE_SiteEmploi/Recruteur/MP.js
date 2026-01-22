$(document).ready(function() {
    $('#Donnees').submit(function(event) {
        // Empêcher le formulaire de se soumettre normalement
        event.preventDefault();

        // Récupérer les données du formulaire
        var formData = new FormData($(this)[0]);

        // Effectuer une requête AJAX
        $.ajax({
            type: 'POST',
            url: './modifierProfil.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response === 'success') {
                    $('.BienModifier').style.display = 'block';
                    // Masquer la notification après quelques secondes
                    setTimeout(function() {
                        $('.BienModifier').style.display = 'none';;
                    }, 4000);
                } else {
                    // Afficher une notification d'erreur
                    alert('Erreur lors de la mise à jour des données de l\'entreprise : ' + response);
                }
            },
            error: function(xhr, status, error) {
                // Afficher une notification d'erreur en cas de problème avec la requête
                alert('Erreur lors de la requête AJAX : ' + status + ' - ' + error);
            }
        });
    });
});
