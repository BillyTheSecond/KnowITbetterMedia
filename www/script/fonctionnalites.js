// MENU DE NAVIGATION

// masquer le menu au scroll down sur mobile


// definir premiere position de scrollTop
previous_scroll_position = window.pageYOffset;
// fonction qui masque le menu de navigation lors du scroll down
function scroll_menu() {
    new_scroll_position = window.pageYOffset;
    // console.log(previous_scroll_position, new_scroll_position);
    // uniquement pour les mobiles
    if (window.innerWidth<=950) {
        // si scroll = vers le bas et que ce n'est pas trop haut dans la page ni tout en bas
        if (new_scroll_position > previous_scroll_position && new_scroll_position > 500 && new_scroll_position < document.body.offsetHeight - (window.innerHeight*2)) {
            // masquer le menu
            document.getElementById("boite-boutons-navigation-art").style.top = "-100px";
            // console.log("down");
        } else {
            // afficher le menu
            document.getElementById("boite-boutons-navigation-art").style.top = "0px";
            // console.log("up");

        }
        // changer le scroll pour l'execution suivante de la fonction
        previous_scroll_position = new_scroll_position;
    } else {
        document.getElementById("boite-boutons-navigation-art").style.top = "0px";
    }

}


document.addEventListener("DOMContentLoaded", function() {
    var alertesContainer = document.createElement("div"); // Création de l'élément div
    alertesContainer.id = "alertes-container"; // Définition de l'ID de l'élément
    
    // Ajout de l'élément au document
    document.body.appendChild(alertesContainer);
  });

// message d'alerte (erreurs, confirmations...)
function afficherAlerte(titre, contenu, tempsApparition, typeAlerte, action = true) {
    var alerteDiv = document.createElement("div");
    alerteDiv.className = "alerte " + typeAlerte;
    
    var titreDiv = document.createElement("div");
    titreDiv.className = "alerte-titre";
    titreDiv.textContent = titre;
    
    var contenuDiv = document.createElement("div");
    contenuDiv.className = "alerte-contenu";
    contenuDiv.innerHTML = contenu;
    
    alerteDiv.appendChild(titreDiv);
    alerteDiv.appendChild(contenuDiv);
    
    var alertesContainer = document.getElementById("alertes-container");
    alertesContainer.appendChild(alerteDiv);
    
    // setTimeout(function() {
    //   alerteDiv.classList.add("visible");
    // }, 10);
    
    if (action) {
      alerteDiv.addEventListener("click", function() {
        if (action === true) {
          // alerteDiv.classList.remove("visible");
          alerteDiv.classList.add("deleted");
          setTimeout(function() {
            if (alerteDiv.parentNode === alertesContainer) {
              alertesContainer.removeChild(alerteDiv);
            }
          }, 5000);
        } else if (typeof action === "string") {
          window.open(action, "_blank");
        }
      });
    }
    
    setTimeout(function() {
      // alerteDiv.classList.remove("visible");
      alerteDiv.classList.add("deleted");
  
      setTimeout(function() {
        if (alerteDiv.parentNode === alertesContainer) {
          alertesContainer.removeChild(alerteDiv);
        }
      }, 5000);
    }, tempsApparition);
  }
  
  