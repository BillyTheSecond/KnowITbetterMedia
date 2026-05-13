<?php 
    session_start();
    include "../database.php";
    global $db;

    $article = $db->query('SELECT * FROM articles WHERE id = 1');
    $article = $article->fetch();

    $auteur = $db->query('SELECT * FROM auteurs WHERE id = '. $article['auteurs']);
    $auteur = $auteur->fetch();
    
    include "../composants/verif-auth-user.php";
    include "../composants/stats.php";



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "../composants/analytics.php";?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>KnowITbetter - AirPlay 2 : Comment recopier l'écran de votre iPhone sur votre téléviseur?</title>
    <link rel="shortcut icon" href="../images/logo/favicon.ico" type="image/x-icon">
    <!-- Details site -->
    <meta name="description" content="AirPlay, système de diffusion sonore et vidéo via le Wi-Fi propriétaire à Apple est une fonctionnalité pratique...si on sait s'en servir ! Voici la solution pour l'utiliser avec succès.">
    <Meta name=" robots" content="index, follow" />

    <!-- apple -->
    <meta name="format-detection" content="telephone=no">
    <meta name="og:title" content="KnowITbetter - AirPlay 2 : Comment recopier l'écran de votre iPhone sur votre téléviseur?">
    <meta name="og:image" content="../article/images/recopie-ecran-airplay/fond-airplay.webp">
    <meta name="og:video" content="https://youtube.com/embed/anuHxPZwilM">
    <link rel="apple-touch-icon" href="../images/logo/logocarrehd.webp">


    <!-- CSS -->
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/navigation-bar.css">
    <link rel="stylesheet" href="../css/style-apercu-articles.css">
    <link rel="stylesheet" href="../css/articles.css">

    <!-- JS -->
    <script src="../script/fonctionnalites.js"></script>

    <!-- <script src="./script/implementation-composants.js"></script> -->
    <!-- <script src="../data/donnees.js"></script> -->
    <!-- <script src="./script/generation-apercus.js"></script> -->

    <!-- Kit Fontawesome -->
    <?php include "../composants/fontawesome_kit.php";?>
    <!-- google adsense -->
    <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5388627137606435" crossorigin="anonymous"></script> -->

    <!-- apple -->
    <meta name="theme-color" content="#F8B432">

    <!-- PUB -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5388627137606435"
     crossorigin="anonymous"></script>
    <script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>



</head>
<body id="body" onscroll="scroll_menu()">



    <style>

        section#top-page {
        /* margin:0px; */
        /* background: url('../article/images/recopie-ecran-airplay/fond-airplay.webp') bottom; */
        /* définir l'image comme couverture --> elle ne se répetera pas en fonction de la definition de l'écran */
        background-size: cover;

        }
        /* couleurs menu de navigation */
        .nav-item {
            color: white;
        }
        #top-logo-texte {
            color: white;
        }
            /* survol des boutons */
    nav#boite-boutons-navigation li a:hover {
        background-color: #ffffffd6;
    }


    
    </style>
    <?php  
        include '../composants/navigation-bar.php';
        echo $navigation_bar;
        include "../composants/titre-article.php";

    ?>

<div id="boite-division-affichage" style="display:flex;flex-direction:row;flex-wrap:nowrap;">
    <div id="article-content" style="flex:1;">
    
        <div class="introduction-box">
            <p class="amorce">Vous avez remarqué que votre télévision est compatible Apple AirPlay 2?  Vous souhaitez diffuser du l'écran de votre iPhone, iPad, iPod Touch ou Mac sur votre téléviseur? Voici la méthode à suivre!</p>
        </div>
        <?php
            include "../composants/bandeau-partage.php";
        ?>
        <div class="video-container">
            <iframe class="video-box-landscape"  src="https://www.youtube.com/embed/2yxMHZQn7Ms" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>


        <!-- sommaire -->
        <div class="sommaire">
            <h2 class="sommaire-title">Sommaire</h2>
            <ul class="sommaire-list">
                <li class="sommaire-item"><a class="sommaire-link" href="#1"><i class="fa-solid fa-circle-chevron-right text-icon"></i>AirPlay, qu'est-ce que c'est ?</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#2"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Votre télévision est-elle compatible ?</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#3"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Les prérequis d'AirPlay</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#4"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Diffuser l'écran de votre appareil sur votre TV</a>
                <ul>
                    <li class="sommaire-item"><a href="#4.1"><i class="fa-solid fa-angle-right text-icon"></i>Depuis un iPhone, iPad ou iPod Touch</a></li>
                    <li class="sommaire-item"><a href="#4.2"><i class="fa-solid fa-angle-right text-icon"></i>Depuis un Mac</a></li>
                </ul>
                </li>

            </ul>
        </div>


        <!-- contenu de l'article -->
        <h2 class="section-title" id="1">AirPlay, qu'est-ce que c'est ?</h2>
        <p class="article-text">AirPlay est un <b>système de diffusion audio et/ou vidéo</b> depuis un appareil Apple vers un autre appareil compatible connecté à votre réseau, comme par exemple, une Smart TV. C'est un <b>système propriétaire à Apple</b> qui voit le jour en <b>2010</b> avec la sortie d'iOS 4.2.1. La deuxième version d'AirPlay, sortie en <b>2018</b>, ajoute la fonctionnalité <b>multi-room</b>, qui permet de diffuser de la musique sur plusieurs enceintes en simultané. Même si, avec cette fonction, Apple nous incite à rentrer dans leur écosystème, cette fonctionnalité s'avère pratique au quotidien.</p>
        <h2 class="section-title" id="2">Votre télévision est-elle compatible ?</h2>
        <p class="article-text">AirPlay est inclus dans les boitiers <b>Apple TV</b> à partir de la 2ème génération. Aujourd'hui, <b>de plus en plus de téléviseurs sont compatibles</b> nativement avec Apple AirPlay 2. C'est notamment le cas de certains téléviseurs Samsung (depuis 2018), LG (depuis 2019-2020), Sony (depuis 2018-2019) ou encore VIZIO et une multitude d'autres marques. Voici la <a class="text-blue-link" href="https://www.apple.com/fr/ios/home/accessories/#section-tv" target="_blank">liste des téléviseurs compatibles</a>. Pour savoir si votre télévision est compatible, il suffit de <b>repérer ce symbole sur la boite de votre télévision</b> :</p>
        <div class="image-container">
            <img loading="lazy" src="../article/images/recopie-ecran-airplay/logo-work-with-apple-airplay.webp" alt="" style="max-height: 80px;max-width: 70vw;">
            <p class="image-legende">Logo certifiant la compatibilité d'un appareil avec AirPlay</p>
        </div>

        <!-- emplacement pour pub -->
        <div class="google-ads-article"></div>


        <h2 class="section-title" id="3">Les prérequis d'AirPlay</h2>
        <p class="article-text"><i class="fa-solid fa-diamond text-icon"></i>Pour utiliser AirPlay 2, vous devez posséder un <b>iPhone, iPad ou iPod Touch</b> doté au minimum d'iOS 12.3 ou un <b>Mac</b> doté de macOS Mojave 10.14.5 ou version ultérieure. AirPlay <b>ne fonctionnera pas</b> sur les appareils qui tournent <b>sous Android, Windows</b> ou n'importe quel autre système d'exploitation .<br><br><i class="fa-solid fa-diamond text-icon"></i>Votre téléviseur <b>doit être connecté au même réseau Wi-Fi que votre appareil</b>. (Si ce n'est pas le cas, vous pouvez trouver son mode d'emploi sur internet)</p>
        <h2 class="section-title" id="4">Diffuser l'écran de votre appareil sur votre TV</h2>
        <p class="article-text">Une fois votre TV compatible <b>allumée</b> et <b>connectée</b> au même réseau que votre appareil Apple, voici la démarche à suivre pour partager votre écran avec celle-ci.</p>
        <h3 class="soussection-title" id="4.1">Depuis un iPhone, iPad ou iPod Touch</h3>
        <div class="video-container">
            <iframe class="video-box-portrait" width="151" height="270" src="https://www.youtube.com/embed/anuHxPZwilM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>        
        <p class="article-text soussection-text"><i class="fa-solid fa-asterisk text-icon"></i>Depuis votre iPhone, iPod Touch ou iPad, <b>ouvrez le centre de contrôle</b>.

            <br><br>&emsp;&emsp;- Sur un iPhone possédant un bouton principal et iPod Touch, <b>balayez l'écran de bas en haut</b>.
            <br><br>&emsp;&emsp;- Sur un iPhone ne possédant pas de bouton principal, <b>balayez l'écran de haut en bas depuis le coin supérieur droit de l'écran</b>.
            <br><br>&emsp;&emsp;- Sur un iPad, <b>balayez l'écran de haut en bas depuis le bord supérieur droit de l'écran</b>.</p><br>

            <div class="flex-container images-container">
                <figure>
                <img loading="lazy" src="../article/images/recopie-ecran-airplay/buttoned-iphone-control-center.webp" alt="iPhone avec bouton principal">
                    <figcaption>iPhone à bouton central, source : Apple</figcaption>
                </figure>
                <figure>
                    <img loading="lazy" src="../article/images/recopie-ecran-airplay/iphone-x-control-center.webp" alt="iPhone sans bouton principal">
                    <figcaption>iPhone à encoche, source : consomac.fr</figcaption>
                </figure>
                <figure>
                    <img loading="lazy" src="../article/images/recopie-ecran-airplay/ipad-control-center.webp" alt="iPad">
                    <figcaption>iPad, source: Apple</figcaption>
                </figure>
            </div>

        <div class="info-box soussection-text"><h4 class="info-title"><i class="fa-solid fa-circle-info text-icon"></i>A Savoir</h4><p class="info-text">Ce menu permet de gérer rapidement certains paramètres de votre appareil comme notamment, le Bluetooth, le Wi-Fi, le mode avion, les données mobiles. Il permet également de modifier le volume sonore, la luminosité de l'écran, d'activer la lampe torche et une multitude d'autres fonctions comprenant la recopie d'écran.<br><br>Le centre de contrôle est personnalisable depuis: Paramètres<i class="fa-solid fa-angle-right text-icon"></i>Centre de contrôle</p></div>
        <p class="article-text soussection-text"><i class="fa-solid fa-asterisk text-icon"></i>Touchez <b>"Recopie de l´écran"</b> pour afficher la liste des appareils compatibles avec la recopie d´écran AirPlay 2 connectés à votre réseau.</p><br>
        <div class="flex-container images-container">
            <figure>
                <img loading="lazy" src="../article/images/recopie-ecran-airplay/bouton-recopie-ecran.webp" alt="Bouton recopie de l'écran dans le centre de controle">
                <figcaption>Bouton "Recopie de l'écran" depuis le centre de contrôle, source : KnowITbetter</figcaption>
            </figure>
            <figure>
                <img loading="lazy" src="../article/images/recopie-ecran-airplay/televiseurs-disponibles.webp" alt="Affichage des téléviseurs Apple AirPlay disponibles">
                <figcaption>Affichage des téléviseurs Apple AirPlay disponibles, source : KnowITbetter</figcaption>
            </figure>
        </div><br>
        <p class="article-text soussection-text"><i class="fa-solid fa-asterisk text-icon"></i><b>Cliquez ensuite sur votre téléviseur</b> et laissez la magie opérer, votre écran va s'afficher sur votre TV !</p>
        <p class="article-text soussection-text">Il se peut qu'un <b>code</b> vous soit demandé lors de a première connexion. Il faut entrer le <b>code à 4 chiffres</b> qui s'affiche en même temps <b>sur votre téléviseur</b>.</p><br>
        <p class="article-text soussection-text">Vous pouvez maintenant diffuser des films, photos, vidéos, passer des appels vidéos et visioconférences sur votre grand écran !</p><br>
        
        <!-- emplacement pour pub -->
        <div class="google-ads-article"></div>
        
        
        <h3 class="soussection-title" id="4.2">Depuis un Mac</h3>
        <div class="flex-container flex-lefttext-rightimg soussection-text">
            <div>
                <p class="article-text">
                    <i class="fa-solid fa-asterisk text-icon"></i>Sur votre Mac, cliquez sur l'<b>icone de recopie de l'écran</b> dans la barre des menus en haut de l'écran.
                </p>
            <div class="info-box soussection-text"><h4 class="info-title"><i class="fa-solid fa-circle-info text-icon"></i>Si vous ne voyez pas cette icone</h4><p class="info-text">Aller dans <b>"Menu Pomme"</b><i class="fa-solid fa-angle-right text-icon"></i> <b>"Préférences Système"</b> <i class="fa-solid fa-angle-right text-icon"></i> <b>"Moniteurs"</b>, puis sélectionnez <b>"Afficher les options de recopie vidéo dans la barre des menus"</b> le cas échéant.</p></div>
            </div>
            <figure>
                <img loading="lazy" src="../article/images/recopie-ecran-airplay/bouton-airplay-mac.webp" alt="Icone airplay sur macos">
                <figcaption>Icone AirPlay sur mac (en bleu), source: Apple</figcaption>
            </figure>
        </div>

        <div class="flex-container flex-lefttext-rightimg soussection-text">
            <div>
                <p class="article-text"><i class="fa-solid fa-asterisk text-icon"></i>Vérifiez ensuite que <b>l'option AirPlay est activée</b>, sinon, activez la.
                    <br><br><i class="fa-solid fa-asterisk text-icon"></i>Cliquez ensuite <b>sur le nom de votre téléviseur</b> compatible ou de votre boitier Apple TV, qui s'affiche dans la partie <i>"AirPlay :Moniteur AirPlay"</i>, pour recopier l'écran dessus.</p><br>
                    <p class="article-text">Lors de la première connexion, un code peut vous être demandé. Saisissez sur votre Mac le code qui s'affiche sur votre téléviseur.</p>
                    <div class="info-box soussection-text"><h4 class="info-title"><i class="fa-solid fa-circle-info text-icon"></i>Différents modes de projection</h4><p class="info-text">Depuis ce menu, vous pouvez également choisir le mode de recopie de l'écran entre <b>"Recopie"</b>, pour recopier l'écran à l'identique ou <b>"Utiliser en tant que moniteur distinct"</b> pour utiliser votre Télévision comme second écran.</p></div>

            </div>
            <figure>
                <img loading="lazy" src="../article/images/recopie-ecran-airplay/menu-airplay-mac.webp" alt="Menu airplay sur macos">
                <figcaption>Menu AirPlay sur mac, source: Apple</figcaption>
            </figure>
        </div><br><br>


        <p class="article-text" style="text-align:center;">Vous n'aurez plus aucun problème pour diffuser un film ou n'importe quel contenu de votre Mac vers votre TV ou encore l'utiliser comme second moniteur!</p>
        <div class="article-signature">
            <p class="article-signature-text">Publié le 16 Janvier 2021 par <a style="color:darkblue" class="normal-link" href="../membres?id=1"><?php echo $auteur["pseudo"];?> - de KnowITbetter</a></p>
        </div>
        <h2 class="section-title">Ils ont rédigé cet article</h2>
        <?php 
            $code_auteur = "";
            $code_auteur = $code_auteur . '<div onclick=\'document.location="../membres?id=1"\' class="lien-sans-style auteur-box flex-container">';
            $code_auteur = $code_auteur . '<div class="auteur-photo-box">';
            $code_auteur = $code_auteur . '<img loading="lazy" src="' . $auteur['photo'] . '" alt="photo de profil de ' . $auteur['prenom']. '" class="auteur-photo">';
            $code_auteur = $code_auteur . '</div><div class="auteur-description-box">';
            $code_auteur = $code_auteur . '<p class="auteur-nom">' . $auteur["pseudo"] .' - de KnowITbetter</p>';
            $code_auteur = $code_auteur . '<P class="auteur-date">Depuis le ' . dateToFrench($auteur["date_inscription"],'j F Y') . '</p>';
            $code_auteur = $code_auteur . '<p class="auteur-devise"><span style="font-size:150%">&laquo;</span>' . $auteur['presentation'] . '<span style="font-size:150%">&raquo;</span></p>';
            $code_auteur = $code_auteur . '</div></div>';
            echo $code_auteur;
        
        ?>

        <h2 class="section-title">Dans le même thème</h2>
        <div id="articles-container" class="flex-container">

        <?php 
            $articles_en_lien = $db->query('SELECT * FROM articles WHERE (tags LIKE "%' . $tags[0] . '%" OR tags LIKE "%' . $tags[1] . '%" OR tags LIKE "%' . $tags[2] . '%" OR tags LIKE "%' . $tags[4] . '%") AND id NOT LIKE '. $article["id"] .' ORDER BY date_publication DESC LIMIT 2');
            include "../composants/apercu-articles.php";
            affichage_articles_v2($articles_en_lien);

        
        
        
        ?>
        </div>



            </div>
            <div id="affichage-bandeau-droite" class="computer-only">

            <!-- articles phares -->
            <div class="articles-container">
            <h2 class="section-title" style="font-size:24px;">A la une</h2>
            <?php 
            $derniers_articles = $db->query('SELECT * FROM articles ORDER BY date_publication DESC LIMIT 4');
            affichage_articles_v2($derniers_articles);

            ?>
            </div>

            <!-- Publicité -->

            <?php include "../composants/pubs.php";?>

            </div>


            </div>
        <?php 
        include '../composants/bas-de-page.php';
        echo $foot_page;
        
        ?>


</body>
