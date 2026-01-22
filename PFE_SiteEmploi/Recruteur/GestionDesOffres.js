
document.addEventListener('DOMContentLoaded', function() {
    const arrows = document.querySelectorAll('.offre .titre .bx-chevron-down');

    arrows.forEach(function(arrow) {
        arrow.addEventListener('click', function() {
            arrow.classList.toggle('rotate');
        });
    });
});


document.addEventListener('DOMContentLoaded', function() {
  const titles = document.querySelectorAll('.offre .titre');

  titles.forEach(function(title) {
      const arrowIcon = title.querySelector('.bx-chevron-down');
      const content = title.nextElementSibling;
      const corbeille = title.querySelector('.bxs-trash');
      const Modi = title.querySelector('.bxs-edit');

      arrowIcon.addEventListener('click', function() {
          const isActive = title.classList.contains('active');

          titles.forEach(function(otherTitle) {
              if (otherTitle !== title) {
                  otherTitle.classList.remove('active');
                  otherTitle.nextElementSibling.style.maxHeight = '0';
                  otherTitle.querySelector('.bxs-trash').style.display = 'none';
                  otherTitle.querySelector('.bxs-edit').style.display = 'none';
                  otherTitle.querySelector('.bx-chevron-down').classList.remove('rotate');
              }
          });

          title.classList.toggle('active');
          if (isActive) {
              content.style.maxHeight = '0';
              corbeille.style.display = 'none';
              Modi.style.display = 'none';
              arrowIcon.classList.remove('rotate');
          } else {
              content.style.maxHeight = content.scrollHeight + 'px';
              corbeille.style.display = 'block';
              Modi.style.display = 'block';
              arrowIcon.classList.add('rotate'); 
          }
      });
  });
});




document.addEventListener("DOMContentLoaded", function() {
    const ajouter = document.querySelector('.Ajouter');
    const MyOffres = document.querySelector('.MyOffres');
    const ModifierProfil =  document.querySelector('.ModifierProfil');
  

    const mlAdd = document.querySelector('.mlAdd'); 
    const mloffres = document.querySelector('.mloffres');
    const mlProfil = document.querySelector('.mlProfil');

    ajouter.addEventListener('click', function() {
        mlAdd.style.display = 'flex'; 
        ajouter.style.background = 'white'; 
        mloffres.style.display = 'none';
        MyOffres.style.background = '#eee'; 
        mlCandidat.style.display = 'none';
        ModifierProfil.style.background='#eee';
        mlProfil.style.display = 'none';
    });


    MyOffres.addEventListener('click' , function() {
        mloffres.style.display= "flex";
        MyOffres.style.background = 'white';
        mlAdd.style.display = 'none';
        ajouter.style.background = '#eee'; 
        mlCandidat.style.display = 'none';
        ModifierProfil.style.background='#eee';
        mlProfil.style.display = 'none';
    });

    ModifierProfil.addEventListener('click', function() {
        window.location.href = './modifierProfil.php';
    });

    const elementAcceuil = document.querySelector('.Acceuil');
        
    elementAcceuil.addEventListener('click', function() {
        window.location.href = './index.php';
    });
    
    
});




document.addEventListener("DOMContentLoaded", function() {
  const urlParams = new URLSearchParams(window.location.search);
  const action = urlParams.get('action');
  const ajouter = document.querySelector('.Ajouter');
  const MyOffres = document.querySelector('.MyOffres');
  const ModifierProfil =  document.querySelector('.ModifierProfil');
  
  const mlAdd = document.querySelector('.mlAdd'); 
  const mloffres = document.querySelector('.mloffres');
  const mlProfil = document.querySelector('.mlProfil');


  switch(action) {
      case 'voir_offres':
          mloffres.style.display= "block";
          MyOffres.style.background = 'white';
          mlAdd.style.display = 'none';
          ajouter.style.background = '#eee'; 
          ModifierProfil.style.background = '#eee'; 
          break;
      case 'Modifier_profil':
            window.location.href = './modifierProfil.php';
          break;
      case 'ajouter_offre':
          mlAdd.style.display = 'flex'; 
          ajouter.style.background = 'white'; 
          mloffres.style.display = 'none';
          MyOffres.style.background = '#eee'; 
          mlProfil.style.display = 'none';
          ModifierProfil.style.background = '#eee'; 
          break;
      default:
          break;
  }
});





$(document).ready(function() {
    // Utilisez un élément parent statique pour la délégation d'événements
    $(".mloffres").on("click", ".delete-btn", function() {
        var offreID = $(this).closest('form').find('input[name="offreID"]').val();
        if (confirm("Êtes-vous sûr de vouloir supprimer cette offre d'emploi")) {
            $.ajax({
                url: './supprimer_offre.php',
                type: 'POST',
                data: { offreID: offreID },
                success: function(response) {
                    // alert(response); // Affiche le message de succès ou d'erreur renvoyé par le script PHP
                    location.reload(); // Recharge la page pour mettre à jour la liste d'offres
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Erreur lors de la suppression de l\'offre d\'emploi.');
                }
            });
            
        }
    });
});




$(document).ready(function() {
    // Utilisez un élément parent statique pour la délégation d'événements
    $(".mloffres").on("click", ".edit-btn", function() {
        // Récupérez l'ID de l'offre en utilisant les sélecteurs jQuery
        var offreID = $(this).closest('form').find('input[name="offreID"]').val();
        
        window.location.href = './ModifierOffre.php?id=' + offreID;
        
    });
});
