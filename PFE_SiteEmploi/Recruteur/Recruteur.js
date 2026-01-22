
document.body.onload = function(){
    var nbr = 3 ;
    var p = 0 ;
    var container = document.getElementById("container");
    var g = document.getElementById("g");
    var d = document.getElementById("d");
    var imageWidth = 900; 

    container.style.width = (imageWidth * nbr) + "px" ;
    for(var i = 1 ; i <= nbr; i++){
        var div = document.createElement("div");
        div.className = "photo"; 
        div.style.backgroundImage = "url('../SiteImages/RecruteurImgs/im"+ i +".jpg')";

        var actionDiv = document.createElement("div");
        actionDiv.className = "gestionDesOffres";
        actionDiv.style.display = "flex";
        actionDiv.style.justifyContent = "center";
        actionDiv.style.alignItems = "end";
        
        var paragraph = document.createElement("p"); 
        paragraph.className = "GoPara";
        switch(i) {
            case 1:
                paragraph.textContent = "Voir Mes offres d'emploi";
                paragraph.addEventListener("click", function() {
                    window.location.href = "./GestionDesOffres.php?action=voir_offres";
                });
                break;
            case 2:
                paragraph.textContent = "Modifier Mon Profil";
                paragraph.addEventListener("click", function() {
                    window.location.href = "./GestionDesOffres.php?action=Modifier_profil";
                });
                break;
            case 3:
                paragraph.textContent = "Ajouter une offre d'emploi";
                paragraph.addEventListener("click", function() {
                    window.location.href = "./GestionDesOffres.php?action=ajouter_offre";
                });
                break;
            default:
                break;
        }
        

        
        

        actionDiv.appendChild(paragraph); 
        div.appendChild(actionDiv);
        container.appendChild(div);
    }

    d.onclick = function(){
        if(p < nbr - 1){
            p++;
        } else {
            p = 0; 
        }
        container.style.transform = "translate(-"+ p * imageWidth +"px)";
        container.style.transition = "all 0.5s ease";
    };

    g.onclick = function(){
        if(p > 0){
            p--;
        } else {
            p = nbr - 1;
        }
        container.style.transform = "translate(-"+ p * imageWidth +"px)";
        container.style.transition = "all 0.5s ease";
    };
};




