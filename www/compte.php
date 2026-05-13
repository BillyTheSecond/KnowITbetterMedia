<?php 
session_start();
include "database.php";
global $db;
include "composants/get_status.php";
include "composants/login.php";
include "composants/signin.php";
include "composants/verif-auth-user.php";
include "composants/modif-profil.php";
include "composants/loved-articles.php";
include "composants/enregistrement-articles.php";
// include "composants/download-user-data.php";



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "composants/analytics.php";?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>KnowITbetter - Votre compte</title>
    <link rel="shortcut icon" href="./images/logo/favicon.ico" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/navigation-bar.css">
    <link rel="stylesheet" href="../css/general.css">
    <!-- JS -->
    <!-- <script src="./script/implementation-composants.js"></script> -->
    <!-- Kit Fontawesome -->
    <?php include "./composants/fontawesome_kit.php";?>

    <meta name="theme-color" content="#F8B432">


</head>
<body id="body">
    <style>
        .aboutus-button {
            font-weight: 900;
            color: #F8B432;
            background-color: white;

        }
        section#top-page {
        margin:0px;
        /*pour que le fichier css retrouve une image qui n'est pas dans son dossier, il doir revenir au dossier racine . Pour cela, on met ../ devant l'url 
        Pour le CSS, mettre un point virgule à la fin de chaque action/ligne */
        /* background: url('../images/fonds/fondfloubleu.jpg'); */
        background-color: whitesmoke;
        /* définir l'image comme couverture --> elle ne se répetera pas en fonction de la definition de l'écran */
        background-size: cover;
        /* l'unité vh signifie "hauteur de fenêtre" donc "1vh" correspond à 1% de la hauteur de la fenêtre*/
        /* l'unité vw correspond à la "largeur de la fenêtre donc "1vw" correspond à 1% de la largeur de la fenêtre*/
        /* il existe également "vmin" qui est la valeur la plus petite de vh et vw et "vmax" qui est la plus grande d'entre-elles*/
        /* min-height: 80vh; */
    }
    nav#boite-boutons-navigation {
        background-color:#F8B432;
        color:white;
    }

    #page-content {
        text-align:center;
        min-height:80vh;
    }
    #connexion-boxes{
        justify-content:center;
        text-align:center;
    }
    #inscription-box {
        display:none;
    }
    #connexion-box, #inscription-box {
        flex:1;
        max-width:400px;
    }
    form#user-informations{
        justify-content:left;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .user-info-line {
        display:flex;
        flex-wrap:nowrap;
        font-family:"Open Sans";
        align-items:center;
        text-align: left;
        
        
    }
    .user-info-line p {
        font-family: inherit;
        font-size:inherit;
        /* flex:1; */
    }
    .user-info-type {
        /* flex:1; */
        min-width:150px;
    }


    input.user-info-data {
        min-width:300px;
    }
    input.user-info-data:disabled {
        text-align:left;

        background: unset;
        border:unset;
        color: black;
        -webkit-text-fill-color: grey;
        font-weight: bold;
        
    }
    input.user-info-data:disabled:hover {
        background: unset;
        border:unset;
        color: black;
        -webkit-text-fill-color: grey;
        font-weight: bold;
        
    }
    @media (max-width:650px) {
        .user-info-line {
        flex-wrap:wrap;
        align-items:flex-start;
        margin-bottom:38px;
        }
        input.user-info-data {
        min-width:unset;
        width:-webkit-fill-available;
        margin:5px 0px;
        }
        input.user-info-data:disabled {
        padding:0;
        }

        
    
        .user-info-line p {
        flex:1;
        width:-webkit-fill-available;
    }
    }


    .loved-articles-box, .loved-articles-box-legende {
        display:flex;
        flex-wrap:nowrap;
        padding:10px 20px;
        align-items:center;
        text-align:left;
    }
    .loved-articles-box:hover {
        background-color:#dfdfdf;
    }
    .loved-articles-box p, .loved-articles-box a {
        padding:5px;
    }
    .loved-articles-icon {
        color:rgb(255,45,85);
        padding:6px;
        width: 28px;
        height: 28px;
        display:flex;
        justify-content:center;
        

    }
    .loved-articles-icon:hover {
        cursor: pointer;
        border-radius: 50%;
        background-color:rgb(255,45,85);
        color:white;
        padding:6px;
        text-align:center;
    }
    .loved-articles-open-link {
        color:rgb(0,122,255);
        padding:6px;
        border-radius: 50%;
        width: 28px;
        height: 28px;

    }
    .loved-articles-open-link:hover {
        cursor: pointer;
        border-radius: 50%;
        background-color:rgb(0,122,255);
        color:white;
        padding:6px;
        text-align:center;        
    }
    .loved-articles-box p {
        text-align:center;
        font-size:inherit;
        display: flex;
        justify-content:center;
    }
    p.loved-articles-nom {
        text-align:left;

        font-size:inherit;
    }

    /* enregistrements */
    .suppr-enregistrement-icon {
        color:orange;
        padding:6px;
        width: 28px;
        height: 28px;
        display:flex;
        justify-content:center;

    }
    .suppr-enregistrement-icon:hover {
        cursor: pointer;
        border-radius: 50%;
        background-color:orange;
        color:white;
        padding:6px;

        text-align:center;
    }

    #connexion-box.connexion, #inscription-box.inscription {
        display: inline;
    }
    #inscription-box.connexion, #connexion-box.inscription {
        display:none;
    }



    
    
    </style>




    <script>
        // switcher l'affichage entre la connexion et la création de compte
        // function afficherBoxInscription() {
        //     connexion_box = document.getElementById("connexion-box");
        //     inscription_box = document.getElementById("inscription-box");
        //     btn_to_signin = document.getElementById("btn_afficher_inscription");
        //     btn_to_login = document.getElementById("btn_afficher_connexion");
        //     // console.log(inscription_box.style.display);
        //     if (inscription_box.style.display == "none" || inscription_box.style.display == "") {
        //         inscription_box.style.display = "inline";
        //         connexion_box.style.display = "none";
        //         // btn.innerHTML = btn.innerHTML.replaceAll("right","left");
        //         // console.log("afficher")
        //     }
        //     else {
        //         // console.log("masquer")
        //         inscription_box.style.display = "none";
        //         connexion_box.style.display = "inline";
        //         // btn.innerHTML = btn.innerHTML.replaceAll("left","right");
        //     }
        // }
        function afficherBoxInscription() {
            // if (document.getElementById("connexion-box").classList.contains('connexion'))
            document.getElementById("connexion-box").classList.toggle('connexion')
            document.getElementById("connexion-box").classList.toggle('inscription')
            document.getElementById("inscription-box").classList.toggle('connexion')
            document.getElementById("inscription-box").classList.toggle('inscription')
        }
    </script>
        <?php  


        
        include './composants/navigation-bar.php';
        echo $navigation_bar;
        
    ?>

    <section id="top-page" class="page-padding">
        <div class="landing-page">
            <h1 class="big-title" style="color:black;">
            <?php 
            if (!isset($_SESSION["pseudo"]) || !verif_auth_user()) {?>
                Mon compte KnowITbetter</h1></div></section>
                <section id="page-content" class="page-padding">
                <div id="connexion-boxes" class="flex-container">
                    <div id="connexion-box" class="<?php if($signin_form_sent){echo "inscription";} else {echo "connexion";} ?>">
                    <h2 class="section-title <?php if($signin_form_sent){echo "inscription";} else {echo "connexion";} ?>">Se connecter</h2>
                    <form method="post">
                        <input type="text" name="lpseudo" id="lpseudo" placeholder="Pseudo ou e-mail" required <?php if(get_status('connexion') == 1){echo "style='display:none'";}?>>
                        <input type="password" name="lpassword" id="lpassword" placeholder="Mot de passe" required <?php if(get_status('connexion') == 1){echo "style='display:none'";}?>>
                        <p id="erreur-login" class="erreur-formulaire"><?php if(isset($login_form_sent)) {echo $erreur_login;} else if(get_status('connexion') == 1){echo "Connexion impossible, veuillez réessayer plus tard. Nous tentons de résoudre ce problème rapidemment :(";} ?></p>
                        <p id="btn_afficher_inscription" onclick="afficherBoxInscription();" class="normal" style="cursor:pointer;">Je n'ai pas encore de compte<i class="fa-solid fa-circle-arrow-right text-icon"></i></p>
                        <input type="submit" class="theme" name="formlogin" value="Se connecter" <?php if(get_status('connexion') == 1){echo "style='display:none'";}?>>
                    </form>
                    </div>
                    <div id="inscription-box" class="<?php if($signin_form_sent){echo "inscription";} else {echo "connexion";} ?>">
                    <h2 class="section-title">Créer un compte</h2>
                    <form method="post">
                        <input type="text" name="pseudo" id="pseudo" placeholder="Choisissez un pseudo" required <?php if(isset($signin_form_sent)) {echo "value='".$pseudo."'";} ?> <?php if(get_status('inscription') == 1){echo "style='display:none'";}?>>
                        <p id="erreur-pseudo-signin" class="erreur-formulaire" <?php if(get_status('inscription') == 1){echo "style='display:none'";}?>><?php if(isset($erreur_pseudo_signin)) {echo $erreur_pseudo_signin;} ?></p>
                        <input type="email" name="email" id="email" placeholder="Votre adresse mail" required <?php if(isset($signin_form_sent)) {echo "value='".$email."'";} ?> <?php if(get_status('inscription') == 1){echo "style='display:none'";}?>>
                        <p id="erreur-email-signin" class="erreur-formulaire" <?php if(get_status('inscription') == 1){echo "style='display:none'";}?>><?php if(isset($erreur_email_signin)) {echo $erreur_email_signin;} ?></p>
                        <input type="password" name="password" id="password" placeholder="Mot de passe" required <?php if(get_status('inscription') == 1){echo "style='display:none'";}?>>
                        <input type="password" name="verif_password" id="verif_password" placeholder="Confirmation du mot de passe" required <?php if(get_status('inscription') == 1){echo "style='display:none'";}?>>
                        <p id="erreur-mdp-signin" class="erreur-formulaire"><?php if(isset($erreur_mdp_signin)) {echo $erreur_mdp_signin;} else if(get_status('inscription') == 1){echo "La création de compte a été temporairement désactivée. Nous travaillons le problème. Merci de réessayer ultérieurement :)";} ?></p>
                        <p id="btn_afficher_connexion" onclick="afficherBoxInscription();" class="normal" style="cursor:pointer;">J'ai déjà un compte<i class="fa-solid fa-circle-arrow-right text-icon"></i></p>
                        <input type="submit" class="primaire" name="form_signin" value="Créer un compte" <?php if(get_status('inscription') == 1){echo "style='display:none'";}?>>
                    </form>
                    </div>
                </div></section>
<?php
                }
            else if (verif_auth_user()){
                echo "<i class='fa-solid fa-user text-icon'></i>Bienvenue ".$_SESSION["pseudo"] ."</h1></div></section>";?>
                

                <section id="page-content" class="page-padding">
                <div class="warning-box"><h4 class="warning-title"><i class="fa-solid fa-circle-info text-icon"></i>Cette section du site n'est pas encore opérationnelle</h4><p class="info-text">A utiliser à vos risques et périls</p></div>

                    <h2 class="section-title">Vos informations</h2>
                    <?php
                        $user = $db->query("SELECT pseudo,email,date,role,nom,prenom,ddn FROM users WHERE pseudo = '" . $_SESSION["pseudo"] . "'");
                        $user = $user->fetch();
                        
                    ?>
                    <form method="post" id="user-informations">
                        <div class="user-info-line">
                            <p class="user-info-type">Pseudo :</p>
                            <input type="text" class="user-info-data" placeholder="<?= $user["pseudo"]?>" disabled>
                            <!-- <a class="normal" >Modifier</a> -->

                        </div>                        
                        <div class="user-info-line">
                            <p class="user-info-type">Mail :</p>
                            <input type="email" name="email" class="user-info-data" placeholder="<?= $user["email"]?>" disabled>
                            <!-- bouton de modification qui active l'input et affiche un bouton d'enregistrement qui soumet le formulaire -->
                            <a class="normal" id = "bouton-modifier-mail" onclick="document.getElementsByName('email')[0].disabled=false;document.getElementById('bouton-enregistrer-mail').style.display = 'unset';document.getElementById('bouton-modifier-mail').style.display = 'none'">Modifier</a>
                            <input type="submit" style="display:none" class="normal-destructif" id="bouton-enregistrer-mail" name="form_modif_profil" value="Enregistrer">

                        </div>
                        <div class="user-info-line">
                            <p class="user-info-type">Mot de Passe :</p>
                            <input type="text" class="user-info-data" placeholder="********" disabled>
                            <!-- <a class="normal" >Modifier</a> -->

                        </div> 
                        <div class="user-info-line">
                            <p class="user-info-type">Prénom :</p>
                            <input type="text" name="prenom" class="user-info-data" placeholder="<?= $user["prenom"]?>" disabled>
                            <a class="normal" id = "bouton-modifier-prenom" onclick="document.getElementsByName('prenom')[0].disabled=false;document.getElementById('bouton-enregistrer-prenom').style.display = 'unset';document.getElementById('bouton-modifier-prenom').style.display = 'none'">Modifier</a>
                            <input type="submit" style="display:none" class="normal-destructif" id="bouton-enregistrer-prenom" name="form_modif_profil" value="Enregistrer">
                        </div>
                        <div class="user-info-line">
                            <p class="user-info-type">Nom :</p>
                            <input type="text"  name="nom" class="user-info-data" placeholder="<?= $user["nom"]?>" disabled>
                            <a class="normal" id = "bouton-modifier-nom" onclick="document.getElementsByName('nom')[0].disabled=false;document.getElementById('bouton-enregistrer-nom').style.display = 'unset';document.getElementById('bouton-modifier-nom').style.display = 'none'">Modifier</a>
                            <input type="submit" style="display:none" class="normal-destructif" id="bouton-enregistrer-nom" name="form_modif_profil" value="Enregistrer">

                        </div>

                        <div class="user-info-line">
                            <p class="user-info-type">Date de naissance :</p>
                            <input type="date" name="ddn" class="user-info-data" value="<?= $user["ddn"]?>" placeholder="yyyy-mm-dd" disabled>
                            <a class="normal" id = "bouton-modifier-ddn" onclick="document.getElementsByName('ddn')[0].disabled=false;document.getElementById('bouton-enregistrer-ddn').style.display = 'unset';document.getElementById('bouton-modifier-ddn').style.display = 'none'">Modifier</a>
                            <input type="submit" style="display:none" class="normal-destructif" id="bouton-enregistrer-ddn" name="form_modif_profil" value="Enregistrer">

                        </div>

                        <!-- <input type="submit" name="form_modif_profil" value="Enregitrer les modifications"> -->
                    </form>


                    <h2 class="section-title">Vos enregistrements</h2>

                    <?php 
                        $enregistrements = $db->query("SELECT enregistrements FROM users WHERE id = '".$_SESSION["id"] ."'");
                        $articles = $db->query("SELECT id,nom,image,image_bg,url FROM articles");
                        $articles = $articles->fetchAll();
                        
                        $enregistrements = $enregistrements->fetch();
                        $enregistrements = explode(",",substr($enregistrements["enregistrements"],0,-1));
                        // var_dump($enregistrements);
                        echo '<div style="background:lightgrey;border-radius:18px;margin:20px;padding:20px 0;max-width:800px;margin:auto;">';
                        echo "<div class='loved-articles-box-legende' style='color:grey;font-weight:700;font-size:12px;'><p class='loved-articles-image computer-only' style='flex:2'>IMAGE</p><p class='loved-articles-nom' style='flex:10'>NOM</p><p style='flex:1'>OUVRIR</p><p style='flex:1'>ENREGISTRER</p></div>";
                        if (isset($enregistrements[0]) && $enregistrements[0] != "") {
                        foreach($enregistrements as $enregistrement_id) {
                            echo "<div class='loved-articles-box'><div class='computer-only' style='flex:2;text-align:center;'><img loading='lazy' src='". $articles[$enregistrement_id-1]['image_bg'] ."' alt='' style='max-height:50px;'></div><a href='". $articles[(int) $enregistrement_id-1]["url"] ."' class='loved-articles-nom lien-sans-style' style='flex:10'>". $articles[(int) $enregistrement_id-1]["nom"] . "</a><p style='flex:1'><i onclick=\"document.location.href='". $articles[(int) $enregistrement_id-1]["url"] . "'\" class='fa-solid fa-arrow-up-right-from-square text-icon loved-articles-open-link'></i></p><p style='flex:1'><i onclick=\"change_enregistrement_status(". $enregistrement_id . ");\" class='fa-solid fa-xmark text-icon suppr-enregistrement-icon'></i></p></div>";

                        }                            
                        } 
                        else {
                            echo "<p><i>Enregistrez un article pour qu'il apparaisse dans cette liste !</i></p>";
                        }

                    
                    
                    ?>
                    


                    <script>

                        function change_love_status(id){
                            document.getElementById("id_change_love_status_article").value = id;
                            document.forms["form_change_love_status"].submit();
                        }
                        function change_enregistrement_status(id){
                            document.getElementById("id_change_enregistrement_status_article").value = id;
                            document.forms["form_change_enregistrement_status"].submit();
                        }
                    </script>

                    <form name="form_change_love_status" method="post" style="display:none;">
                        <input type="number" name="id_change_love_status_article" id="id_change_love_status_article" value="">
                        <input type="submit" value="form_change_love_status" name="form_change_love_status">
                    </form>
                    <form name="form_change_enregistrement_status" method="post" style="display:none;">
                        <input type="number" name="id_change_enregistrement_status_article" id="id_change_enregistrement_status_article" value="">
                        <input type="submit" value="form_change_enregistrement_status" name="form_change_enregistrement_status">
                    </form>

                    </div>


                    <h2 class="section-title">Articles que vous aimez</h2>

                    <?php 
                        $loved_articles = $db->query("SELECT loved_articles FROM users WHERE id = '".$_SESSION["id"] ."'");
                        $articles = $db->query("SELECT id,nom,image,image_bg,url FROM articles");
                        $articles = $articles->fetchAll();
                        
                        $loved_articles = $loved_articles->fetch();
                        $loved_articles = explode(",",substr($loved_articles["loved_articles"],0,-1));
                        // var_dump($loved_articles);
                        echo '<div style="background:lightgrey;border-radius:18px;margin:20px;padding:20px 0;max-width:800px;margin:auto;">';
                        echo "<div class='loved-articles-box-legende' style='color:grey;font-weight:700;font-size:12px;'><p class='loved-articles-image computer-only' style='flex:2'>IMAGE</p><p class='loved-articles-nom' style='flex:10'>NOM</p><p style='flex:1'>OUVRIR</p><p style='flex:1'>AIMER</p></div>";
                        if (isset($loved_articles[0]) && $loved_articles[0] != "") {
                        foreach($loved_articles as $loved_article_id) {
                            echo "<div class='loved-articles-box'><div class='computer-only' style='flex:2;text-align:center;'><img loading='lazy' src='". $articles[$loved_article_id-1]['image_bg'] ."' alt='' style='max-height:50px;'></div><a href='". $articles[(int) $loved_article_id-1]["url"] ."' class='loved-articles-nom lien-sans-style' style='flex:10'>". $articles[(int) $loved_article_id-1]["nom"] . "</a><p style='flex:1'><i onclick=\"document.location.href='". $articles[(int) $loved_article_id-1]["url"] . "'\" class='fa-solid fa-arrow-up-right-from-square text-icon loved-articles-open-link'></i></p><p style='flex:1'><i onclick=\"change_love_status(". $loved_article_id . ");\" class='fa-solid fa-xmark text-icon loved-articles-icon'></i></p></div>";

                        }                            
                        } 
                        else {
                            echo "<p><i>Laissez un coeur sur un article pour qu'il apparaisse dans cette liste !</i></p>";
                        }

                    
                    
                    ?>
                    


                    <script>
                        function unlove_article(id) {
                            document.getElementById("id_unlove_article").value = id;
                            document.forms["form_unlove_article"].submit();
                        }
                    </script>
                    <form name="form_unlove_article" method="post" style="display:none;">
                        <input type="number" name="id_unlove_article" id="id_unlove_article" value="">
                        <input type="submit" value="form_unlove_article" name="form_unlove_article">
                    </form>

                    </div>
                    <!-- sous forme de liste (pour afficher + d'éléments) qui contient le nom de l'article et avec un lien, et un bouton 'dislike' (un peu comme dans la page admin)  -->



                
            <?php
            if ($_SESSION["role"] == 'admin') {?>
            <h2 class="section-title">Vos services</h2>
            <a href="../administration.php" class="secondaire"><i class="fa-solid fa-database text-icon"></i>Administration du site</a>




<?php           }?>
            <h2 class="section-title">Vos droits</h2>
            <p><i>Cette fonction n'est pas entièrement opérationnelle.</i></p>
            <form id="download-user-data" action="../composants/download-user-data.php" method="post">
                <input style="display:none" type="" name="download-user-data" value="Télécharger mes données">

            </form>
            <!-- si le formulaire est soumis -->

            <a onclick="submit_data_form()" class="secondaire"><i class='fa-solid fa-circle-down text-icon'></i>Télécharger mes données</a>
            <a href="" class="secondaire-destructif"><i class="fa-solid fa-person-circle-minus text-icon"></i>Supprimer Mon Compte</a>
            <script>
                function submit_data_form() {
                    document.getElementById("download-user-data").submit();
                }
            </script>


            <a href="/composants/logout-page.php" class="secondaire-destructif lien-sans-style">Vous déconnecter<i class="fa-solid fa-arrow-right-from-bracket text-icon"></i></a>
            <?php

            }
                ?>
            </section>
    <div class="iphone-padding">
        <?php 
            include './composants/bas-de-page.php';
            echo $foot_page;
            
            ?>
    </div>
</body>