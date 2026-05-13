function supprimer_article(id, nom) {
    document.getElementById("id_suppr").value = id;
    document.getElementById("alert-message").innerHTML = `<div id="alert-message-box-2" style='font-size: 12pt;font-family: "Open Sans", sans-serif;scroll-behavior: smooth;width: 45vw;min-width: 300px;max-width: 450px;margin: 200px auto;position: relative;z-index: 1;border-radius: 20px;box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.5);background-color: #222831;color: lightgrey;'><div id="alert-title-box" style="padding: 15px;color: lightgrey;margin: 0px;font-size: 12pt;font-family: 'Open Sans', sans-serif;scroll-behavior: smooth;padding: 15px;"><h2 class="title" style="font-size:18pt;overflow:hidden;color: lightgrey;margin: 0px;font-family: 'Open Sans', sans-serif;scroll-behavior: smooth;font-size: 18pt;overflow: hidden;">Êtes-vous sûr(e) de vouloir supprimer cet article ?</h2></div><div id="alert-description-box" style="padding: 15px; padding-top:0px;"><p style="font-weight: 300;text-align:justify;">Nom de l'article: `+ nom + `<br>ID: `+ id  +`</p></div><div id="alert-button-box" style=" text-align:center;width:100%;display:flex;color: lightgrey;margin: 0px;font-size: 12pt;font-family: "Open Sans", sans-serif;scroll-behavior: smooth;bottom: 0px;text-align: center;width: 100%;display: flex;"><button class="red-button" style="flex:1;" onclick="closeAlert();envoyer_formulaire_suppression(`+id +`);">Supprimer</button><button style="flex:1" onclick="closeAlert();">Annuler</button></div></div>`;
    document.getElementById("alert-message").style.display = "unset";
    console.log("okkk");
}

function closeAlert() {
    document.getElementById("alert-message").style.display = "none";

}

function envoyer_formulaire_suppression(id) {
    document.getElementById("id_suppr").value = id;
    document.forms["form_suppression"].submit();


}

/* <div id="alert-message-box-2" style='font-size: 12pt;font-family: "Open Sans", sans-serif;scroll-behavior: smooth;width: 45vw;min-width: 300px;max-width: 450px;margin: 200px auto;position: relative;z-index: 1;border-radius: 20px;box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.5);background-color: #222831;color: lightgrey;'><div id="alert-title-box" style="padding: 15px;    color: lightgrey;margin: 0px;font-size: 12pt;font-family: 'Open Sans', sans-serif;scroll-behavior: smooth;padding: 15px;"><h2 class="title" style="font-size:18pt;overflow:hidden;color: lightgrey;margin: 0px;font-family: 'Open Sans', sans-serif;scroll-behavior: smooth;font-size: 18pt;overflow: hidden;">Nous revoilà, nous sommes les cookies !</h2></div><div id="alert-description-box" style="padding: 15px; padding-top:0px;"><p style="font-weight: 300;text-align:justify;">Veuillez accepter nos cookies pour naviguer sur notre site web</p></div><div id="alert-button-box" style=" text-align:center;width:100%;display:flex"><button class="red-button" style="flex:1;" onclick="closeAlertMessage2();deleteCookie('cookies')">Annuler</button><button style="flex:1" onclick="closeAlertMessage2();createCookie('cookies','allowed',30);        setTimeout(function() {homeSuggestions()}, 500);">Valider</button></div></div> */