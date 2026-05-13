
// lire un cookie
function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
  }
// creer un cookie
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
  }

// Afficher boite de choix des cookies 
function afficherChoixCookies() {
    if (document.getElementById("cookie-box")== null) {
    var div = document.createElement("div");
    div.innerHTML = '<div id="cookie-box" style="background-color:black;color:white;position:fixed;bottom:20px;right:20px;max-width:min(480px,calc(100vw - 40px));display:flex;flex-direction:column;flex-wrap:nowrap;padding:10px 20px;border-radius:18px;box-shadow: #000000ab 0px 0px 1000px 200px;"><div id="cookies-details-box" style="padding-bottom:12px;"><p id="cookies-titre" class="section-title" style="padding:unset;margin:unset;padding-bottom:4px">Nos cookies sont healthy!</p><p id="cookies-description">Vous voulez savoir pourquoi et comment nous utilisons vos cookies sans en abuser? C\'est par <a class="text-blue-link" href="">ici</a> !</p></div><div id="cookies-buttons-box" style="display:flex;flex-direction:row;flex-wrap:nowrap;align-items:center;text-align:center"><a class="primaire" id="cookies-accept-button" onclick="accepterCookies();" style="background-color:unset;border:solid white 3px;flex:1;justify-content:center;margin-left:unset;display:block;"><i class="fa-solid fa-cookie-bite text-icon" style="color:brown;display: inline;"></i>Miam, comment refuser?</a><a id="cookies-refuse-button" onclick="refuserCookies();" class="normal-destructif" style="color:white;flex:1;"><i class="fa-solid fa-heart-crack text-icon"></i>Je boude. J\'en veux pas!</a></div></div>';
    document.body.appendChild(div);        
    } else {
        document.getElementById("cookie-box").style.display= "flex";
    }


}



// Accepter les cookies
function accepterCookies() {
    setCookie("cookies","true","200");
    if (document.getElementById("cookie-box")!= null) {
        document.getElementById("cookie-box").style.display = "none";
    }
    // charger les pubs
    chargerGoogleAds();
    
}
// Refuser les cookies
function refuserCookies() {
    setCookie("cookies","false","7");
    document.getElementById("cookie-box").style.display = "none";
    // charger les messages de soutien
    chargerIncitationCookies();
    
}


// fonction qui charge les pubs dans les divs dédiées
function chargerGoogleAds() {
    if (getCookie("cookies") == "true") {
        // ajouter les pubs dans toutes les div avec la classe pub (par type de pub)

        // PUBS dans le corps des articles
        divs_pubs_articles = document.getElementsByClassName("google-ads-article")
        // console.log(divs_pubs_articles,divs_pubs_articles.length);
        for (id_div = 0; id_div < divs_pubs_articles.length; id_div++) {
            // console.log(id_div);
            // console.log(divs_pubs_articles[id_div]);
            divs_pubs_articles[id_div].innerHTML = '<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5388627137606435"crossorigin="anonymous"></script><!-- annonces articles --><ins class="adsbygoogle"     style="display:block"     data-ad-client="ca-pub-5388627137606435"     data-ad-slot="8771754344"     data-ad-format="auto"     data-full-width-responsive="true"></ins><script>     (adsbygoogle = window.adsbygoogle || []).push({});</script>';
 };
    } 
}

function chargerIncitationCookies() {
    // si user refuse les cookies, charger des messages demandant le don
    divs_pubs_articles = document.getElementsByClassName("google-ads-article")
        // console.log(divs_pubs_articles,divs_pubs_articles.length);
        for (id_div = 0; id_div < divs_pubs_articles.length; id_div++) {
            // console.log(id_div);
            // console.log(divs_pubs_articles[id_div]);
            divs_pubs_articles[id_div].innerHTML = '<div style="text-align:center;"><img loading="lazy" src="https://i.giphy.com/media/mJONUM663p4OZt3i5J/giphy.webp" style="border-radius:12px 12px 0 0;width:100%;margin-bottom:20px;" frameBorder="0" class="giphy-embed"></img><p>Nous avons besoin de vos cookies pour maintenir ce site</p><a class="primaire" onclick="accepterCookies();">Je change d\'avis!</a></div>';
        }
}









function lancerValidationCookies() {
    // A exécuter lors de l'implémentation du fichier

    // vérifier si les cookie sont été autorisés
    cookies_status = getCookie("cookies")
    if (cookies_status == "true") {
        // Implémenter le code des pubs google Adsense
        chargerGoogleAds();

    } else if (cookies_status == "false"){
        // si les cookies ont été refusés 
        chargerIncitationCookies();
    } else {
        // si les cookies user ne s'est pas décidé sur les cookies,
        afficherChoixCookies();
    }
}


