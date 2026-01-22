$(document).ready(function() {
    $(".offres").on("click", ".offresRecruteur", function() {
        var id_entreprise = $(this).find('.offrecard').data('id_entreprise');
        var id_offre = $(this).find('.offrecard').data('id_offre');
        
        // Redirection vers la page detailOffre.php avec les paramètres id_entreprise et id_offre dans l'URL
        window.location.href = './detailOffre.php?id_entreprise=' + id_entreprise + '&id_offre=' + id_offre;
    });
});

