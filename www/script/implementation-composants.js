
// OBTENIR LE CODE HTML D'UNE PAGE (CODE COPIE COLLE SUR STACKOVERFLOW)
function makeHttpObject() {
    try {return new XMLHttpRequest();}// code for IE7+, Firefox, Chrome, Opera, Safari
    catch (error) {}
    try {return new ActiveXObject("Msxml2.XMLHTTP");}// code for IE6, IE5
    catch (error) {}
    try {return new ActiveXObject("Microsoft.XMLHTTP");}// code for IE5
    catch (error) {}
  
    throw new Error("Could not create HTTP request object.");

  }

//   va chercher le contenu HTML de l'url renseignée, puis envoie les résultats, une fois trouvés, à la fonction renseignée.
function getHTMLCodeFromUrl(url,fonction,id_balise){
    var request = makeHttpObject();
    request.open("GET", url, true);// methode GET, url, true (asynchrone)
    request.send(null);
    request.onreadystatechange = function() {//
        // console.log(request.readyState)
      if (request.readyState == 4)
        // codeHTML = request.responseText;
        // console.log(request.responseText)
        if (request.responseText.length > 0){
            console.log("REPONSE OK",id_balise)
            fonction(request.responseText,id_balise) // on envoie le code HTML à la fonction
            
        }
    }
}



// fonction qui affiche les éléments HTML demandés
function addPageToHTMLBalise(codeHTML,id_balise) {
    if (codeHTML) {
        if (codeHTML.indexOf("<title>Error</title>") == -1 && codeHTML.indexOf("<title>Not Found</title>") == -1){
            if (codeHTML.indexOf('page-content') != -1){
                console.log("CONTENU A INSERER TROUVE")
                // console.log(codeHTML)
                code_a_ajouter = codeHTML
                code_a_ajouter = code_a_ajouter.substring(code_a_ajouter.indexOf("<section class=\"page-content\">")+30,code_a_ajouter.indexOf("</section>"))
                // console.log(code_a_ajouter)
                // si id_balise == true alors retourner le code à ajouter
                if (id_balise==true) {
                    return code_a_ajouter
                    // sinon, ajouter le code au bon endroit
                } else if (typeof(id_balise) == "string"){
                    if (document.getElementById("body")){
                        if (document.getElementsByTagName("body")[0].innerHTML.indexOf(id_balise) != -1){
                            console.log("EMPLACEMENT D'INSERTION TROUVE");
                            document.getElementById(id_balise).innerHTML = code_a_ajouter
                        } else {
                            console.log("EMPLACEMENT D'INSERTION INTROUVABLE");
                        }


                    } else {
                        console.log("PAS DE BODY")
                        // attendre 1/2 secondes puis réessayer
                        console.log("NOUVELLE TENTATIVE D'INSERTION DANS 1 SECONDES")
                        setTimeout(function(){
                            addPageToHTMLBalise(codeHTML,id_balise)
                        },200)
                    }
                } else {
                    console.log("id_balise != string")
                    document.getElementById("top-page").innerHTML = code_a_ajouter
                }
            }
        

        } else {
            codeHTML = "<h1 class='page-title'>Erreur</h1><p class='error-message'>Une erreur s'est produite. La page n'a pas été trouvée.</p>"
            document.getElementsByTagName("body")[0].innerHTML = codeHTML

        }
    } else {
        // getHTMLCodeFromUrl("/Views/"+ page_name +".html", addPageToHTMLBody,id_balise)
    }
}





// implementation composants

// Barre de navigation
getHTMLCodeFromUrl("../composants/navigation-bar.html",addPageToHTMLBalise,"menu")// ajoute le code HTML de la page à la balise menu