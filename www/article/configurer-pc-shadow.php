<?php 
    session_start();
    include "../database.php";
    global $db;

    $article = $db->query('SELECT * FROM articles WHERE id = 2');
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
    <title>KnowITbetter - SHADOW : Qu'est-ce que c'est et comment le configurer?</title>
    <link rel="shortcut icon" href="../images/logo/favicon.ico" type="image/x-icon">
    <!-- Details site -->
    <meta name="description" content="Shadow, est une entreprise française qui offre un système de cloud-gaming français qui donne accès à un ordinateur performant à distance. Cet article explique comment installer et configurer un ordinateur Shadow.">
    <Meta name=" robots" content="index, follow" />

    <!-- apple -->
    <meta name="format-detection" content="telephone=no">
    <meta name="og:title" content="KnowITbetter - SHADOW : Qu'est-ce que c'est et comment le configurer?">
    <meta name="og:image" content="../article/images/configurer-pc-shadow/fond-shadow.webp">
    <meta name="og:video" content="https://www.youtube.com/embed/btVUBJ-EkEs">
    <link rel="apple-touch-icon" href="../images/logo/logocarrehd.webp">


    <!-- CSS -->
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/navigation-bar.css">
    <link defer rel="stylesheet" href="../css/style-apercu-articles.css">
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
        /* background: url('../article/images/configurer-pc-shadow/fond-shadow.webp') bottom; */
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


    
    </style>
    <?php  
        include '../composants/navigation-bar.php';
        echo $navigation_bar;
        include "../composants/titre-article.php";

    ?>


<div id="boite-division-affichage" style="display:flex;flex-direction:row;flex-wrap:nowrap;">
    <div id="article-content" style="flex:1;">

        <div class="introduction-box">
            <p class="amorce">Vous avez souscrit à un abonnement pour un ordinateur Shadow et vous souhaitez savoir comment le configurer ? Voici la méthode!
            </p>
            
        </div>
        <?php
            include "../composants/bandeau-partage.php";
        ?>
        <div class="video-container">
            <iframe defer loading="lazy" class="video-box-landscape"  src="https://www.youtube.com/embed/btVUBJ-EkEs" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>


        <!-- sommaire -->
        <div class="sommaire">
            <h2 class="sommaire-title">Sommaire</h2>
            <ul class="sommaire-list">
                <li class="sommaire-item"><a class="sommaire-link" href="#1"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Le point culture: SHADOW</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#2"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Installer le logiciel SHADOW</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#3"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Configurer le logiciel</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#4"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Installation de votre PC SHADOW</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#5"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Installation de logiciels</a>
                <ul>
                    <li class="sommaire-item"><a href="#5.1"><i class="fa-solid fa-angle-right text-icon"></i>Antivirus</a></li>
                    <li class="sommaire-item"><a href="#5.2"><i class="fa-solid fa-angle-right text-icon"></i>Les indispensables</a></li>
                </ul>
                </li>
                <li class="sommaire-item"><a class="sommaire-link" href="#6"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Le devenir de SHADOW</a></li>


            </ul>
        </div>


        <!-- contenu de l'article -->
        <h2 class="section-title" id="1">Le point culture: SHADOW</h2>
        <p class="article-text"><a class="text-blue-link"href="http://www.shadow.tech" target="_blank">Shadow</a> est une <b>entreprise française</b> et <b>leader Européen</b> spécialisé dans le cloud gaming. Le système de "jeu à distance" est récent et se développe à une allure considérable. Le principe du cloud gaming est simple : Nous avons accès à un catalogue de jeux en ligne auxquels nous pouvons jouer sans les télécharger. Le jeu s'exécute sur des <b>ordinateurs puissants</b> situés <b>dans des serveurs distants</b> et <b>la vidéo ainsi que le son du jeu sont retransmis sur notre appareil via internet</b>. Grâce aux vitesses folles d'internet avec l'arrivée de la fibre et de la 5G cette année, il devient de plus en plus simple d'accès. <br><br><br>
            L'entreprise se démarque en proposant <b>un service bien plus complet que la concurrence</b> en ne proposant pas un catalogue de jeux mais <b>l'accès à tout un ordinateur sous Windows 10</b>. Son utilisation n'est donc pas limitée à des jeux mais s'ouvre à tous les domaines : montage vidéo, retouche photo, production musicale… Et tout ceci à partir de 12,99€/mois pendant 1 an, ou14,99€ sans engagement !</p>
        <figure>
            <img loading="lazy" src="../article/images/configurer-pc-shadow/schema-shadow.webp" alt="">
            <figcaption>Fonctionnement du PC Shadow, "l'ordinateur dans le cloud", source : KnowITbetter</figcaption>
        </figure>
        <p class="article-text">Les machines Shadow avec le plus petit abonnement (<a class="text-blue-link" href="https://shop.shadow.tech/plans">Shadow Boost</a>) sont équipées de <b>processeurs 3,4 GHz</b> ou équivalent (4 cœurs / 8 Threads), de cartes graphiques <b>GeForce GTX 1080</b> (ou équivalent), de <b>12 Go de mémoire vive</b> et enfin d'un <b>SSD de 256 Go</b> de stockage. Les Shadow possèdent une connexion de type fibre, il est donc possible de télécharger des gros jeux en peu de temps ou streamer en excellente résolution. Des forfaits proposant des ordinateurs encore plus puissants sont entrain d'être mis en place. <br><br><br>
            Shadow à été victime de son succès depuis la pandémie et a eut trop de demandes. Les délais sont actuellement (à la date de l'article) de <b>9 mois pour obtenir un ordinateur</b>.</p>
        <figure>
            <img loading="lazy" src="../article/images/configurer-pc-shadow/offre-shadow-boost.webp" alt="Offre SHADOW Boost">
            <figcaption>Les différentes options de payement de Shadow Boost</figcaption>
        </figure>
        <div class="warning-box"><h4 class="warning-title"><i class="fa-solid fa-circle-exclamation text-icon"></i></i>Mise à jour</h4><p class="info-text">Certaines options de SHADOW ne sont plus disponibles et les prix ont varié depuis la publication de l'article. L'entreprise a été rachetée par OVH (Octave Klaba) et relance son activité. <br>De même, les délais d'atente sont maintenant quasiment inexistants.</p></div>
        <h2 class="section-title" id="2">Installer le logiciel SHADOW</h2>
        <figure>
            <img loading="lazy" src="../article/images/configurer-pc-shadow/logo-shadow.webp" alt="Logo de SHADOW" style="max-width:200px">
            <figcaption>Logo de SHADOW</figcaption>
        </figure>
        <div class="flex-container flex-lefttext-rightimg">
                <p class="article-text">
                    Tout d'abord, sur votre ordinateur, vous devez installer le logiciel <a class="text-blue-link" href="https://update.shadow.tech/launcher/prod/win/x64/ShadowSetup.exe"> Shadow pour Windows (64bits)</a> (autres versions: <a class="text-blue-link" href="https://shadow.tech/fr/shadow-apps/">ici</a>).</p>
            <figure style="max_width:400px;">
                <img loading="lazy" src="../article/images/configurer-pc-shadow/telechargement-shadow.webp" alt="Installation du logiciel SHADOW" >
                <figcaption>Installation du logiciel SHADOW</figcaption>
            </figure>
        </div>
        <div class="flex-container images-container">
            <figure>
                <img loading="lazy" src="../article/images/configurer-pc-shadow/installation-1.webp" alt="Capture d'écran, première page de Shadow">
                <figcaption>Première page de Shadow</figcaption>
            </figure>
            <figure>
                <img loading="lazy" src="../article/images/configurer-pc-shadow/installation-2.webp" alt="Capture d'écran, écran de connexion Shadow">
                <figcaption>Capture d'écran, écran de connexion Shadow</figcaption>
            </figure>
        </div><br>

        <p class="article-text">Ensuite, lancez le logiciel et rentrez vos identifiants Shadow. Vous serez parfois invités a entrer un code reçu par e-mail.</p>
        <div class="info-box"><h4 class="info-title"><i class="fa-solid fa-circle-info text-icon"></i>Vous n'avez pas encore de compte ?</h4><p class="info-text">Vous ne vous êtes pas encore abonnés? Tout se passe sur le site <a class="normal-link" href="https://www.shadow.tech">www.shadow.tech</a> .</p></div>
        
        <!-- emplacement pour pub -->
        <div class="google-ads-article"></div>


        <h2 class="section-title" id="3">Configurer le logiciel</h2>
        <div class="flex-container flex-lefttext-rightimg ">
            <div>
            <p class="article-text">
                Une fois que vous êtes connecté à votre compte Shadow, vous devez configurer le logiciel : la bande passante allouée correspond au débit maximum que pourra prendre votre Shadow sur votre réseau internet. Plus vous inscrivez un débit important, plus votre réseau sera ralenti. Il est conseillé de laisser le débit indiqué par défaut, qui est calculé automatiquement en fonction de votre vitesse de connexion.</p>            
                <div class="warning-box"><h4 class="warning-title"><i class="fa-solid fa-circle-exclamation text-icon"></i>Débit alloué</h4><p class="info-text">Augmenter le débit alloué peut rendre votre expérience moins agréable et plus saccadée.</p></div>
            </div>
            <figure >
                <img loading="lazy" src="../article/images/configurer-pc-shadow/config-logiciel-1.webp" alt="Configuration de la bande passante Shadow" >
                <figcaption>Configuration de la bande passante Shadow, source : MrAlexTech, YouTube</figcaption>
            </figure>
        </div>
        <figure >
            <img loading="lazy" src="../article/images/configurer-pc-shadow/config-logiciel-2.webp" alt="Configuration de la bande passante Shadow" >
            <figcaption>Bande passante conseillée en fonction de votre vitesse de téléchargement, si vous souhaitez la configurer manuellement </figcaption>
        </figure>
        <div class="info-box"><h4 class="info-title"><i class="fa-solid fa-circle-info text-icon"></i>A quoi sert votre connexion internet ?</h4><p class="info-text">Votre connexion internet locale permet uniquement à votre ordinateur d'afficher l'écran du PC Shadow à distance. <b>Le PC Shadow, lui, possède une connexion de type fibre très rapide</b>. Vous pourrez donc télécharger des jeux et logiciels lourds très rapidement!</p></div>
        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                    Il faut aussi vérifier que l'option des <b>périphériques USB</b> est bien <b>activée</b>. Elle vous permettra d'accéder aux périphériques USB branchés à votre ordinateur directement dans votre Shadow.
                    L'option "Plein écran" est aussi conseillée.</p>            
            </div>
            <figure >
                <img loading="lazy" src="../article/images/configurer-pc-shadow/config-logiciel-3.webp" alt="Configuration de la bande passante Shadow" >
                <figcaption>Option d'activation des périphériques USB, Crédits : Shadow</figcaption>
            </figure>
        </div>
        <p class="article-text">Vous pouvez maintenant cliquer sur "Commencer" pour démarrer votre Shadow pour la première fois.</p>
        
        <!-- emplacement pour pub -->
        <div class="google-ads-article"></div>


        <!-- partie 4 -->
        <h2 class="section-title" id="4">Installation de votre PC SHADOW (Windows)</h2>
        
        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                    Une fois l'ordinateur lancé, vous avez sur votre écran, un ordinateur neuf, <b>à configurer</b>. L'écran de configuration bleu s'affiche et Cortana (Assistante vocale virtuelle de Microsoft) se met à parler. <b>Vous pouvez la rendre muette</b> en appuyant sur le bouton "son", à droite de la barre en bas de l'écran (en jaune ci-contre).</p>
                <div class="info-box"><h4 class="info-title"><i class="fa-solid fa-circle-info text-icon"></i>Partage de données avec Microsoft</h4><p class="info-text">Vous ne vous êtes pas encore abonnés? Tout se passe sur le site <a class="normal-link" href="https://www.shadow.tech">www.shadow.tech</a> .</p></div>
            </div>
            <figure >
                <img loading="lazy" src="../article/images/configurer-pc-shadow/instal-win-1.webp" alt="Ecran de configuration Windows, crédits : SebY1 Tuto PC" >
                <figcaption>Ecran de configuration Windows, crédits : SebY1 Tuto PC 
                </figcaption>
            </figure>
        </div>

        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                    Choississez votre pays</p>
            </div>
            <figure >
                <img loading="lazy" src="../article/images/configurer-pc-shadow/instal-win-2.webp" alt="Ecran de configuration Windows, crédits : SebY1 Tuto PC" >
                <figcaption>Ecran de configuration Windows, crédits : SebY1 Tuto PC 
                </figcaption>
            </figure>
        </div>

        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                    Sélectionnez la bonne disposition de votre clavier (Français = AZERTY).</p>
            </div>
            <figure >
                <img loading="lazy" src="../article/images/configurer-pc-shadow/instal-win-3.webp" alt="Ecran de configuration Windows, crédits : SebY1 Tuto PC" >
                <figcaption>Ecran de configuration Windows, crédits : SebY1 Tuto PC 
                </figcaption>
            </figure>
        </div>
        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                    <b>Ignorez cette étape</b>. Elle est utile aux personnes qui ont besoin d'écrire du contenu en différentes langues. Cette fonctionnalité permet de passer d'une disposition de clavier à une autre rapidement.</p>
            </div>
            <figure >
                <img loading="lazy" src="../article/images/configurer-pc-shadow/instal-win-4.webp" alt="Ecran de configuration Windows, crédits : SebY1 Tuto PC" >
                <figcaption>Ecran de configuration Windows, crédits : SebY1 Tuto PC 
                </figcaption>
            </figure>
        </div>

        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                    Windows va maintenant rechercher des mises à jour.</p>
            </div>
            <figure >
                <img loading="lazy" src="../article/images/configurer-pc-shadow/instal-win-5.webp" alt="Ecran de configuration Windows, crédits : SebY1 Tuto PC" >
                <figcaption>Ecran de configuration Windows, crédits : SebY1 Tuto PC 
                </figcaption>
            </figure>
        </div>

        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                    Il vous faut maintenant "lire" le contrat de licence mais surtout, l'accepter.</p>
            </div>
            <figure >
                <img loading="lazy" src="../article/images/configurer-pc-shadow/instal-win-6.webp" alt="Ecran de configuration Windows, crédits : SebY1 Tuto PC" >
                <figcaption>Ecran de configuration Windows, crédits : SebY1 Tuto PC 
                </figcaption>
            </figure>
        </div>

        <!-- emplacement pour pub -->
        <div class="google-ads-article"></div>


        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                Vous devez maintenant vous connecter à <b>votre compte Microsoft</b>. Ce sont généralement des comptes en @hotmail.fr , @outlook.fr , @outlook.com.</p>
                <div class="info-box"><h4 class="info-title"><i class="fa-solid fa-circle-info text-icon"></i>Utiliser Windows 10 sans compte Microsoft</h4><p class="info-text">Si vous ne souhaitez pas vous connecter, c'est possible mais un grand nombre de fonctionnalités ne seront plus disponibles, comme par exemple le téléchargement de logiciels via le Microsoft Store. Microsoft a dissimulé le bouton <b>"Compte hors connexion"</b> en bas à gauche, qui permet de ne pas ce connecter. Sachez que vous pourrez toujours vous connecter ultérieurement.<br>Sur les nouvelles versions de Windows, il n'est <b>plus possible d'utiliser Windows sans compte</b></p></div>

            </div>
            <figure >
                <img loading="lazy" src="../article/images/configurer-pc-shadow/instal-win-7.webp" alt="Ecran de configuration Windows, crédits : SebY1 Tuto PC" >
                <figcaption>Ecran de configuration Windows, crédits : SebY1 Tuto PC 
                </figcaption>
            </figure>
        </div>

        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                Ensuite, vous pouvez créer un code pin pour déverrouiller l'appareil. Si vous ne le faites pas, <b>le code de l'ordinateur sera celui du compte Microsoft qu vous venez de renseigner</b>. Ne l'oubliez pas ! :)</p>
            </div>
            <figure >
                <img loading="lazy" src="../article/images/configurer-pc-shadow/instal-win-8.webp" alt="Ecran de configuration Windows, crédits : SebY1 Tuto PC" >
                <figcaption>Ecran de configuration Windows, crédits : SebY1 Tuto PC 
                </figcaption>
            </figure>
        </div>

        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                Il vous est proposé de lier votre téléphone et votre ordinateur, cous pouvez passer cette option en cliquant sur <b>"plus tard"</b> .</p>
                <div class="info-box"><h4 class="info-title"><i class="fa-solid fa-circle-info text-icon"></i>A quoi sert "Lier votre téléphone" ?</h4><p class="info-text">Cette fonction permet d'ouvrir certaines applications de votre téléphone sur votre ordinateur et d'envoyer des SMS depuis l'ordinateur.</p></div>

            </div>
            <figure >
                <img loading="lazy" src="../article/images/configurer-pc-shadow/instal-win-9.webp" alt="Ecran de configuration Windows, crédits : SebY1 Tuto PC" >
                <figcaption>Ecran de configuration Windows, crédits : SebY1 Tuto PC 
                </figcaption>
            </figure>
        </div>

        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                Vous pouvez activer OneDrive sur ce PC mais <b>nous vous le déconseillons</b>, C'est une offre de stockage en ligne proposée par Microsoft. Elle n'est en aucun point liée avec Shadow. Avec l'offre gratuite de OneDrive, vous avez peu de stockage et vous serez rapidemment sollités à passer à un abonnement payant.<br>Vous pouvez cliquer sur <b>"Uniquement enregistrer les fichiers sur ce PC"</b>.</p>
            </div>
            <figure >
                <img loading="lazy" src="../article/images/configurer-pc-shadow/instal-win-10.webp" alt="Ecran de configuration Windows, crédits : SebY1 Tuto PC" >
                <figcaption>Ecran de configuration Windows, crédits : SebY1 Tuto PC 
                </figcaption>
            </figure>
        </div>
        
        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                Vous n'êtes pas obligé d'activer Cortana, nous doutons qu'elle vous soit utile .</p>
            </div>
            <figure >
                <img loading="lazy" src="../article/images/configurer-pc-shadow/instal-win-11.webp" alt="Ecran de configuration Windows, crédits : SebY1 Tuto PC" >
                <figcaption>Ecran de configuration Windows, crédits : SebY1 Tuto PC 
                </figcaption>
            </figure>
        </div>

        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                Vous devez cocher les paramètres de confidentialité. Lisez les bien !<br>Nous vous conseillons de désactiver :</p>
                <ul class="article-text">
                    <li><i class="fa-solid fa-caret-right text-icon"></i>Diagnostiques</li>
                    <li><i class="fa-solid fa-caret-right text-icon"></i>Publicités pertinentes</li>
                    <li><i class="fa-solid fa-caret-right text-icon"></i>Reconnaissance vocale</li>
                    <li><i class="fa-solid fa-caret-right text-icon"></i>Usage des données de diagnostique pour une expérience sur mesure</li>
                </ul>
                <p class="article-text"><br>Enfin, cliquez sur <b>"Accepter"</b>.<br><br>Ne vous inquiétez pas, c'est bientôt fini ! 😉
                </p>
            </div>
            <figure >
                <img loading="lazy" src="../article/images/configurer-pc-shadow/instal-win-12.webp" alt="Ecran de configuration Windows, crédits : SebY1 Tuto PC" >
                <figcaption>Ecran de configuration Windows, crédits : SebY1 Tuto PC 
                </figcaption>
            </figure>
        </div>

        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                <b>Et voila !</b> Vous n'avez plus qu'à attendre que Windows termine de se configurer et l'écran d'accueil va s'afficher!</p>
            </div>
            <figure >
                <img loading="lazy" src="../article/images/configurer-pc-shadow/instal-win-13.webp" alt="Ecran de configuration Windows, crédits : SebY1 Tuto PC" >
                <figcaption>Ecran de configuration Windows, crédits : SebY1 Tuto PC 
                </figcaption>
            </figure>
        </div>

        <!-- emplacement pour pub -->
        <div class="google-ads-article"></div>


        <h2 class="section-title" id="5">Installation de logiciels</h2>
        <p class="article-text">Une fois que le PC Shadow est accessible, Le navigateur Edge s'ouvre en affichant des conseils. Vous pouvez ouvrir un nouvel onglet et taper cet URL : <a href="https://www.knowitbetter.fr/article/configurer-pc-shadow.php" class="text-blue-link">www.knowitbetter.fr/article/configurer-pc-shadow.php</a> pour ouvrir ce site sur votre PC Shadow et continuer sa configuration.</p>

        <h3 class="soussection-title" id="5.1">Antivirus</h3>
        <p class=" article-text soussection-text">Sur un ordinateur Windows, il est toujours <b>important</b> d'installer un antivirus avant de commencer à s'en servir. Voici des liens permettant de télécharger directement <b>des antivirus dans leurs versions gratuites</b> (Vous pouvez bien entendu en télécharger d'autres et/ou acheter leur version complète) <br><br>
        <b>Avast</b>: <a href="https://www.avast.com/fr-fr/download-thank-you.php?product=FAV-2532-A&locale=fr-fr" class="text-blue-link">https://www.avast.com/fr-fr/download-thank-you.php?product=FAV-2532-A&locale=fr-fr</a><br><br>
        <b>Avira</b> : <a href="https://www.avira.com/fr/start-download/product/2262/-I12e2mvtstLKUkGnG-U3eKJ0uoWK80lDY0eCg2ZeeRMAXyeS4YYmsvxtf-rJOk" class="text-blue-link">https://www.avira.com/fr/start-download/product/2262/-I12e2mvtstLKUkGnG-U3eKJ0uoWK80lDY0eCg2ZeeRMAXyeS4YYmsvxtf-rJOk</a><br><br>
        <b>Kaspersky</b> : <a href="https://www.kaspersky.fr/free-antivirus" class="text-blue-link">https://www.kaspersky.fr/free-antivirus</a><br><br>
        <b>Bitdefender</b> : <a href="https://www.bitdefender.com/solutions/free/thank-you.html" class="text-blue-link">https://www.bitdefender.com/solutions/free/thank-you.html</a><br><br>
        Maintenant, votre ordinateur est entièrement configuré! Vous pouvez dès maintenant vous amuser, installer des jeux, des logiciels de montage vidéo, de retouche photo, de streaming… Tout est prêt ! 
        </p>

        <h3 class="soussection-title" id="5.2">Logiciels indispensables</h3>
        <p class=" article-text soussection-text">Nous vous avons dressé une liste de logiciels indispensables pour vous faciliter la tâche d'installation ! (Les liens sont fiables) <br><br>
        <b>VLC media player</b> : <a href="https://get.videolan.org/vlc/3.0.11/win64/vlc-3.0.11-win64.exe" class="text-blue-link">https://get.videolan.org/vlc/3.0.11/win64/vlc-3.0.11-win64.exe</a><br><br>
        <b>Google Chrome</b> : <a href="https://www.google.com/intl/fr/chrome/" class="text-blue-link">https://www.google.com/intl/fr/chrome/</a><br><br>
        <b>Mozilla Firefox</b> : <a href="https://www.mozilla.org/fr/firefox/download/thanks/" class="text-blue-link">https://www.mozilla.org/fr/firefox/download/thanks/</a><br><br>
        <b>Adobe Acrobat Reader</b> : <a class="text-blue-link" href="https://get.adobe.com/fr/reader/">https://get.adobe.com/fr/reader/</a><br><br>
        <b>7-Zip</b> : <a href="https://www.7-zip.org/a/7z2107-x64.exe" class="text-blue-link">https://www.7-zip.org/a/7z2107-x64.exe</a><br><br>
        <b>Steam</b> : <a href="https://cdn.cloudflare.steamstatic.com/client/installer/SteamSetup.exe" class="text-blue-link">https://cdn.cloudflare.steamstatic.com/client/installer/SteamSetup.exe</a><br><br>
        <b>Discord</b> : <a href="https://discord.com/api/download?platform=win" class="text-blue-link">https://discord.com/api/download?platform=win</a><br><br>
        </p>
        <a href="" class="blue-link">Notre sélection de logiciels indispensables</a>
        

        <h2 class="section-title" id="6">L'avenir de votre SHADOW</h2>
        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                Si vous n'avez besoin d'utiliser votre Shadow que quelques mois ou durant une période prédéfinie, <b>vous pouvez annuler votre abonnement</b> (immédiatement pour le formait mensuel et à la fin de l'année pour le forfait annuel). <br>
                Cependant, <b>il n'est pas possible de mettre en pause l'abonnement et de le réactiver plus tard</b>, lorsque vous en aurez besoin. Une fois que vous annulez l'abonnement, votre PC Shadow sera <b>réinitialisé</b>, et <b>donné à un autre utilisateur</b>. Toutes <b>vos données seront effacées</b>. <br>
                Si vous souhaitez utiliser un PC Shadow plus tard, vous devrez <b>souscrire à nouvel abonnement</b> et <b>attendre à nouveau que votre ordinateur soit prêt</b>. Il vous sera alors livré, comme neuf et vous devrez le configurer et retélécharger vos logiciels.</p>
            </div>
            <figure style="max-width: 300px;min-width:100px">
                <img loading="lazy" src="../article/images/configurer-pc-shadow/corbeille.webp" alt="Ecran de configuration Windows, crédits : SebY1 Tuto PC" >
                <figcaption>Une fois votre abonnement résilié, vos données seront effacées 
                </figcaption>
            </figure>
        </div><p class="article-text ">Et voilà, votre ordinateur Shadow est entièrement installé et configuré! N'oubliez pas que vous avez uniquement 256 Go de stockage, (dont environ 40-50 Go max. sont occupés par Windows) donc n'installez pas tout et n'importe quoi ! Profitez-en bien !</p>

        
        
        
        
        <div class="article-signature">
            <p class="article-signature-text">Publié le 16 Janvier 2021 par <a style="color:darkblue" class="normal-link" href="../membres?id=1"><?php echo $auteur["pseudo"];?> - de KnowITbetter</a></p>
        </div>
        <h2 class="section-title">Ils ont rédigé cet article</h2>
        <?php 
            $code_auteur = "";
            $code_auteur = $code_auteur . '<div onclick=\'document.location="../membres?id=1"\' class="lien-sans-style auteur-box flex-container">';
            $code_auteur = $code_auteur . '<div class="auteur-photo-box">';
            $code_auteur = $code_auteur . '<img loading="lazy" src="' . $auteur['photo'] . '" alt="photo de profil de ' . $auteur['pseudo']. '" class="auteur-photo">';
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
