<?php 
    session_start();
    include "../database.php";
    global $db;

    $article = $db->query('SELECT * FROM articles WHERE id = 4');
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
    <title>KnowITbetter - iPhone : Comment sauvegarder vos photos sur un ordinateur Windows?</title>
    <link rel="shortcut icon" href="../images/logo/favicon.ico" type="image/x-icon">
    <!-- Details site -->
    <meta name="description" content="Fini la galère des sauvegardes photos et vidéos d'un iPhone sur un PC ! Nous vous expliquons en détail comment y parvenir grâce à l'installation d'un seul logiciel.">
    <Meta name=" robots" content="index, follow" />

    <!-- apple -->
    <meta name="format-detection" content="telephone=no">
    <meta name="og:title" content="KnowITbetter - iPhone : Comment sauvegarder vos photos sur un ordinateur Windows?">
    <meta name="og:image" content="../article/images/sauvegarder-photos-iphone-sous-windows/fond-sauvegarder-photos-iphone-sous-windows.webp">
    <meta name="og:video" content="https://www.youtube.com/embed/wNuAk6G5T7w">
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
        /* background: url('../article/images/sauvegarder-photos-iphone-sous-windows/fond-sauvegarder-photos-iphone-sous-windows.webp') bottom; */
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
            <p class="amorce">Vous avez acheté un iPhone pour sa bonne qualité de photo mais vous ne possédez pas d'ordinateur de la marque à la pomme? Vous rencontrez surement des problèmes pour sauvegarder vos photos sur votre ordinateur Windows... Voici la solution pour ne plus avoir de problèmes!
            </p>
            
        </div>
        <?php
            include "../composants/bandeau-partage.php";
        ?>
        <div class="video-container">
            <iframe defer loading="lazy" class="video-box-landscape" src="https://www.youtube.com/embed/wNuAk6G5T7w" title="Comment sauvegarder les photos et vidéos d’un iPhone sur un ordinateur Windows" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>


        <!-- sommaire -->
        <div class="sommaire">
            <h2 class="sommaire-title">Sommaire</h2>
            <ul class="sommaire-list">
                <li class="sommaire-item"><a class="sommaire-link" href="#1"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Pourquoi sauvegarder vos photos ?</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#2"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Pourquoi des problèmes surviennent avec Windows ?</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#3"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Une solution pour pallier ce problème</a>
                <ul>
                    <li class="sommaire-item"><a href="#3.1"><i class="fa-solid fa-angle-right text-icon"></i>Installez le logiciel Syncios</a></li>
                    <li class="sommaire-item"><a href="#3.2"><i class="fa-solid fa-angle-right text-icon"></i>Exportez vos photos vers votre ordinateur ou clef USB</a></li>
                </ul>
                </li>


            </ul>
        </div>


        <!-- contenu de l'article -->
        <h2 class="section-title" id="1">Pourquoi sauvegarder vos photos ?</h2>
        <p class="article-text">
            Dans la vie de tous les jours, les <b>appareils photos</b> ont été remplacés par les <b>smartphones</b>, qui ont des résultats en photographie de plus en plus bons. Les appareils photos ne sont cependant pas abandonnés et se réservent aux <b>photographes</b>. Cette migration s'explique par la volonté de capturer <b>chaque moment de la vie</b>, de le <b>partager rapidement</b>, la <b>facilité d'utilisation</b> , et la <b>portabilité</b> de ces appareils sans oublier les grandes évolutions technologiques dans le domaine ces dernières années.
            <br><br>
            Seulement, il est toujours utile <b>sauvegarder ses photos sur un ordinateur</b> ou "en lieu sûr" sur un disque dur. Cela permet de créer un point de sauvegarde qui recense toutes vos photos et vidéos et qui peut vous permettre de <b>libérer de l'espace de stockage</b> sur votre appareil, de retoucher certaines photos sur un ordinateur. Faire une sauvegarde permet principalement de créer une <b>sécurité contre un vol</b> éventuel, une <b>panne</b> imprévisible ou tout autre problème qui pourrait vous faire <b>perdre définitivement l'accès à vos photos</b>.
        </p>
        
        
        <h2 class="section-title" id="2">Pourquoi des problèmes surviennent avec Windows ?</h2>
        <div class="flex-container flex-lefttext-rightimg">
            <figure>
                <img loading="lazy" src="../article/images/sauvegarder-photos-iphone-sous-windows/1.webp" alt="Capture d'écran de l'application photos de Windows 10">
                <figcaption>Capture d'écran de l'application photos de Windows 10
                </figcaption>
            </figure>            
            <div>
                <p class="article-text">
                Apple n'a jamais souhaité arranger les problèmes de compatibilité de ses appareils avec les appareils qui ne sont pas les leurs. Il n'est donc pas rare d'être bloqué, si l'on ne dispose pas un entier écosystème de la marque à la pomme... 🙁
                <br><br>
                De nombreux utilisateurs font remonter un problème : Il est impossible de transférer ses photos sur un ordinateur Windows.
                <br><br>
                Il existe donc de nombreux logiciels qui promettent de combler ce problème, mais la plupart d'entre eux sont payants. Nous en avons trouvé un pour vous, dont l'offre gratuite inclus le transfert de photos !
                </p>
            </div>

        </div>

        <!-- emplacement pour pub -->
        <div class="google-ads-article"></div>



        <h2 class="section-title" id="3">Une solution pour pallier ce problème</h2>
        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                Le logiciel en question s'appelle <a class="text-blue-link" href="https://syncios.fr">Syncios</a>, Sa version gratuite permet de transférer des photos et des vidéo de votre iPhone vers votre ordinateur (ou autre support externe que vous souhaitez) mais également de sauvegarder l'intégralité de votre iPhone ainsi que de restaurer une sauvegarde.
                </p>
            </div>
            <figure>
                <img loading="lazy" src="../article/images/sauvegarder-photos-iphone-sous-windows/2.webp" alt="Illustration de SyncIOS" style="max-width:300px;">
                <figcaption>
                </figcaption>
            </figure>
        </div>
        <figure>
            <img loading="lazy" src="../article/images/sauvegarder-photos-iphone-sous-windows/3.webp" alt="Aperçu des principales fonctionnalités du logiciel Syncios en version gratuite et payante">
            <figcaption>Aperçu des principales fonctionnalités du logiciel Syncios en version gratuite et payante
            </figcaption>
        </figure>




        <h3 class="soussection-title" id="3.1">Installez le logiciel Syncios</h3>
        <div class="flex-container flex-lefttext-rightimg soussection-text">
            <div>
                <p class="article-text">
                <i class="fa-solid fa-caret-right text-icon"></i>Sur votre ordinateur, <b>téléchargez le logiciel Syncios</b> en cliquant sur ce lien: <a class="text-blue-link" href="https://www.syncios.com/setup_syncios.exe">https://www.syncios.com/setup_syncios.exe</a> , puis installez le en ouvrant le fichier téléchargé (généralement sous le nom de "setup_syncios.exe" dans vos téléchargements).
                <br><br>
                <i class="fa-solid fa-caret-right text-icon"></i>Ensuite, <b>lancez l'application</b> et cliquez sur "<b>installer</b>" sur la case "<b>Gestionnaire de téléphone</b>".
                </p>
            </div>
            <figure>
                <img loading="lazy" src="../article/images/sauvegarder-photos-iphone-sous-windows/4.webp" alt="Capture d'écran de la page de démarrage du logiciel Syncios">
                <figcaption>Capture d'écran de la page de démarrage du logiciel Syncios
                </figcaption>
            </figure>
        </div>


        <!-- emplacement pour pub -->
        <div class="google-ads-article"></div>

        <h3 class="soussection-title" id="3.2">Exportez vos photos vers votre ordinateur ou clef USB</h3>
        <div class="flex-container flex-lefttext-rightimg soussection-text">
            <div>
                <p class="article-text">
                Une fois le téléchargement terminé, cliquez sur la case "<b>Gestionnaire de téléphone</b>". Si un message vous demande de vous abonner à l'offre payante, ignorez le.
                </p>
            </div>
            <figure>
                <img loading="lazy" src="../article/images/sauvegarder-photos-iphone-sous-windows/5.webp" alt="Capture d'écran de la fenêtre qui s'ouvre après avoir cliqué sur 'Gestionnaire de téléphone'">
                <figcaption>Capture d'écran de la fenêtre qui s'ouvre après avoir cliqué sur "Gestionnaire de téléphone"
                </figcaption>
            </figure>
        </div>
        <div class="flex-container flex-lefttext-rightimg soussection-text">
            <div>
                <p class="article-text">
                <i class="fa-solid fa-caret-right text-icon"></i>Vous pouvez maintenant <b>brancher votre iPhone</b> à votre ordinateur.
                <br><br>
                <i class="fa-solid fa-caret-right text-icon"></i>Il est possible que vous deviez préalablement <b>taper votre code sur votre iPhone</b>, et cliquer sur "<b>Faire confiance à cet ordinateur</b>".
                <br><br>
                <i class="fa-solid fa-caret-right text-icon"></i>Cliquez maintenant sur l'onglet "<b>Photos</b>" dans la barre supérieure.
                </p>
            </div>
            <figure>
                <img loading="lazy" src="../article/images/sauvegarder-photos-iphone-sous-windows/6.webp" alt="Aperçu de la page qui s'affiche après que vous avez branché votre iPhone">
                <figcaption>Aperçu de la page qui s'affiche après que vous avez branché votre iPhone
                </figcaption>
            </figure>
        </div>
        <div class="flex-container flex-lefttext-rightimg soussection-text">
            <div>
                <p class="article-text">
                    Le chargement peut prendre quelques minutes mais tous <b>vos albums photos et vidéos vont s'afficher</b> ! Ne vous inquiétez pas, c'est bientôt fini 😅!    
                </p>
            </div>
            <figure>
                <img loading="lazy" src="../article/images/sauvegarder-photos-iphone-sous-windows/7.webp" alt="Affichage de vos albums photos dans le logiciel Syncios">
                <figcaption>Affichage de vos albums photos dans le logiciel Syncios
                </figcaption>
            </figure>
        </div>
        <div class="flex-container flex-lefttext-rightimg soussection-text">
            <div>
                <p class="article-text">
                <b>Sélectionnez maintenant un album</b>, que vous souhaitez sauvegarder, puis cliquez sur "<b>Exporter</b>".
                </p>
            </div>
            <figure>
                <img loading="lazy" src="../article/images/sauvegarder-photos-iphone-sous-windows/8.webp" alt="Capture d'écran du logiciel Syncios">
                <figcaption>Capture d'écran du logiciel Syncios
                </figcaption>
            </figure>
        </div>
        <div class="flex-container flex-lefttext-rightimg soussection-text">
            <div>
                <p class="article-text">
                <i class="fa-solid fa-caret-right text-icon"></i>Il vous est alors demandé où vous souhaitez sauvegarder l'album. <b>Sélectionnez l'emplacement de votre choix</b> (qui peut bien sûr être un disque dur ou une clef USB), et cliquez sur "<b>sélectionner un dossier</b>".
                <br><br>
                <i class="fa-solid fa-caret-right text-icon"></i>Le chargement commence et sera <b>plus ou moins long</b>, en fonction de la quantité de données à sauvegarder.
                <br><br>
                <i class="fa-solid fa-caret-right text-icon"></i>Vous pouvez ensuite convertir les photos qui sont au format HEIC en JPG afin d'assurer leur compatibilité avec Windows, grâce à un message qui s'affiche ensuite.                </p>
            </div>
            <figure>
                <img loading="lazy" src="../article/images/sauvegarder-photos-iphone-sous-windows/9.webp" alt="Capture d'écran du logiciel Syncios">
                <figcaption>Capture d'écran du logiciel Syncios
                </figcaption>
            </figure>
        </div>

        <!-- emplacement pour pub -->
        <div class="google-ads-article"></div>


        <h2 class="section-title" id="4" style="color:darkred;">Les désavantages de cette méthode</h2>

        <p class="article-text">
            
            <i class="fa-solid fa-circle-minus text-icon" style="color:darkred;"></i>Ce logiciel ne permet pas d'importer plusieurs album en même temps, vous devrez les importer les uns après les autres.
            <br><br>
            <i class="fa-solid fa-circle-minus text-icon" style="color:darkred;"></i>Ne propose pas l'importation de toutes les photos dans un seul dossier, vous serez obligés de les importer par albums
        </p>
        <br><br><br>
        <p class="article-text">
            Maintenant, vous pourrez prendre des photos librement, sans vous soucier de l'espace restant de votre iPhone !
        </p>

        


        
        
        <div class="article-signature">
            <p class="article-signature-text">Publié le 13 Mars 2021 par <a style="color:darkblue" class="normal-link" href="../membres?id=1"><?php echo $auteur["pseudo"];?> - de KnowITbetter</a></p>
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
            if ($articles_en_lien) {
                affichage_articles_v2($articles_en_lien);
            }

            

        
        
        
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
