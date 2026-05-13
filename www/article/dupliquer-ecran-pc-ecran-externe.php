<?php 
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

    session_start();
    include "../database.php";
    global $db;

    $article = $db->query('SELECT * FROM articles WHERE id = 5');
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
    <title>KnowITbetter - <?=$article["nom"]?></title>
    <link rel="shortcut icon" href="../images/logo/favicon.ico" type="image/x-icon">
    <!-- Details site -->
    <meta name="description" content="<?=$article['description']?>">
    <Meta name=" robots" content="index, follow" />

    <!-- apple -->
    <meta name="format-detection" content="telephone=no">
    <meta name="og:title" content="KnowITbetter - <?=$article["nom"]?>">
    <meta name="og:image" content="<?=$article['image_bg']?>">
    <meta name="og:video" content="https://www.youtube.com/embed/7SvaiBBn46U">
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

    <!-- apple -->
    <meta name="theme-color" content="#F8B432">


    <!-- cookies -->
    <script src="../script/cookies.js"></script>


</head>
<body id="body" onscroll="scroll_menu()">



    <style>

        section#top-page {
        /* margin:0px; */
        /* background: url('../article/images/dupliquer-ecran-pc-ecran-externe/fond-dupliquer-ecran-pc-ecran-externe.webp') bottom; */
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
            <p class="amorce">Il n'est pas toujours simple de connecter un ordinateur à un dispositif d'affichage externe comme un vidéoprojecteur ou une TV. Voici plusieurs méthodes pour y parvenir simplement !
            </p>
            
        </div>
        <?php
            include "../composants/bandeau-partage.php";
        ?>
        <div class="video-container">
            <iframe defer loading="lazy" class="video-box-landscape" src="https://www.youtube.com/embed/7SvaiBBn46U" title="<?=$article['nom']?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>


        <!-- sommaire -->
        <div class="sommaire">
            <h2 class="sommaire-title">Sommaire</h2>
            <ul class="sommaire-list">
                <li class="sommaire-item"><a class="sommaire-link" href="#1"><i class="fa-solid fa-circle-chevron-right text-icon"></i>La recopie de l'écran, c'est quoi ?</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#2"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Méthode 1 - Par câble HDMI</a>
                <ul>
                    <li class="sommaire-item"><a href="#3.1"><i class="fa-solid fa-angle-right text-icon"></i>Démarche à suivre</a></li>
                </ul>
                </li>

                <li class="sommaire-item"><a class="sommaire-link" href="#3"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Méthode 2 - Affichage sans fil Microsoft (si disponible)</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#4"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Méthode 2 - Apple AirPlay (si disponible)</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#5"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Résoudre des problèmes liés au son</a></li>



            </ul>
        </div>

        <!-- contenu de l'article -->
        <h2 class="section-title" id="1">La Recopie de l'écran, c'est quoi ?</h2>
        <p class="article-text">
            La recopie de l'écran permet de recopier exactement le contenu de l'écran de notre ordinateur sur un dispositif d'affichage externe. Que ce soit un téléviseur, un vidéo projecteur ou encore un écran géant, cette fonctionnalité est très utilisée. Nous nous en servons pour présenter des diaporamas, diffuser des vidéos, des photos, des documents audios... De nos maisons, où l'on partage photos et vidéos en famille, aux grandes conférences en passant par les salles de classe, nous ne pouvons plus nous passer de cette fonctionnalité !
            <br><br>
            Seulement, il arrive que l'on n'y parvienne pas. Nous allons vous présenter <b>3 méthodes différentes</b> pour connecter votre ordinateur à un écran externe ou vidéoprojecteur.
        </p>


        <!-- emplacement pour pub -->
        <div class="google-ads-article"></div>


        <h2 class="section-title" id="2">Méthode 1 - Connexion par cable HDMI</h2>
        <div class="flex-container flex-lefttext-rightimg">
            <figure>
                <img loading="lazy" src="../article/images/dupliquer-ecran-pc-ecran-externe/schema-hdmi.webp" alt="Schéma branchement HDMI">
                <figcaption>©KnowITbetter
                </figcaption>
            </figure>            
            <div>
                <p class="article-text">
                Cette toute première méthode est la plus fiable : une connexion filaire. Aujourd'hui, le type de câble le plus répandu pour la transmission vidéo (et audio) est le type HDMI. La plupart des ordinateurs, TVs et vidéoprojecteurs en sont munis.
                <br><br>
                Tout d'abord, vous devez vous assurez que votre ordinateur et le projecteur/écran externe possèdent un port HDMI. Il existe <b>2 principaux types : HDMI et Micro HDMI</b> (Sur les ordinateurs plus fins et plus petits). Identifiez-leurs types et munissez-vous du bon câble : <a class="text-blue-link" href="https://www.fnac.com/Cable-HDMI/Connectique-Cable/nsh475089/w-4">HDMI vers HDMI</a> ou <a class="text-blue-link" href="https://www.amazon.fr/cable-micro-hdmi-vers/s?k=cable+micro+hdmi+vers+hdmi">Micro HDMI vers HDMI</a> pour connecter votre ordinateur au vidéoprojecteur.
                <br>
                </p>
                <div class="info-box soussection-text"><h4 class="info-title"><i class="fa-solid fa-circle-info text-icon"></i>A Savoir</h4><p class="info-text">Si votre ordinateur n'a pas de port HDMI, il existe des adaptateurs comme des USB Type-C vers HDMI. Les Mac récents en ont notamment besoin.</p></div>

            </div>
            <figure>
                <img loading="lazy" style="max-width:400px;" src="../article/images/dupliquer-ecran-pc-ecran-externe/deux-types-hdmi.webp" alt="Les deux types de port HDMI mâles">
                <figcaption>En haut: cable HDMI, en bas: cable Micro HDMI
                </figcaption>
            </figure>   
            <figure>
                <img loading="lazy" style="max-width:400px;" src="../article/images/dupliquer-ecran-pc-ecran-externe/hdmi-femelle.webp" alt="Port HDMI femelle">
                <figcaption>Port HDMI femelle
                </figcaption>
            </figure>
            <figure>
                <img loading="lazy" style="max-width:400px;" src="../article/images/dupliquer-ecran-pc-ecran-externe/micro-hdmi-femelle.webp" alt="Port micro HDMI femelle">
                <figcaption>Port Micro HDMI femelle
                </figcaption>
            </figure>          

        </div>
        <h3 class="soussection-title" id="2.1">Démarche à suivre</h3>
        <div class="flex-container flex-lefttext-rightimg soussection-text">
            <div>
                <p class="article-text">
                <i class="fa-solid fa-caret-right text-icon"></i>Tout d'abord, allumez votre ordinateur et le vidéoprojecteur/l'écran.
                </p>
                <figure>
                    <img loading="lazy" src="../article/images/dupliquer-ecran-pc-ecran-externe/power-button.webp" style="max-width: 100px;" alt="Bouton d'allumage">
                    <figcaption>
                    </figcaption>
                </figure>    
                <p class="article-text">
                    <i class="fa-solid fa-caret-right text-icon"></i>Ensuite, reliez les deux appareils via le câble HDMI (et éventuellement d'un adaptateur).
                </p>
                <figure>
                    <img loading="lazy" src="../article/images/dupliquer-ecran-pc-ecran-externe/hdmi-dessin.webp" style="max-width: 250px;" alt="Illustration, câble HDMI">
                    <figcaption>
                    </figcaption>
                </figure>    
                <p class="article-text">
                    <i class="fa-solid fa-caret-right text-icon"></i>Sur votre ordinateur <u><b><a class="text-blue-link" href="https://www.knowitbetter.fr/recherche?tag=windows">Windows</a></b></u>, cliquez sur les touches <b>WINDOWS + P</b> et cliquez sur Dupliquer. Si rien ne se passe sur le vidéoprojecteur, <b>sélectionner une autre source HDMI</b> (s'il ne se passe toujours rien, essayez toutes les sources HDMI).
                </p>
                <div class="warning-box"><h4 class="warning-title"><i class="fa-solid fa-circle-exclamation text-icon"></i>Un écran s'affiche mais n'est pas celui que vous voyez sur votre ordinateur?</h4><p class="info-text">Si l'écran s'affiche sur l'écran externe/le vidéo projecteur mais est différent de ce qui s'affiche sur votre ordinateur, vérifiez que l'option sélectionnée est bien Dupliquer.</p></div>
                <figure>
                    <img loading="lazy" style="max-width:400px;" src="../article/images/dupliquer-ecran-pc-ecran-externe/dupliquer-windows.webp" alt="Différents modes d'utilisation d'un écran externe">
                    <figcaption>Différents modes d'utilisation d'un écran externe (WINDOWS + P) ©KnowITbetter
                    </figcaption>
                </figure>  
                <p class="article-text">
                    <i class="fa-solid fa-caret-right text-icon"></i>Sur votre ordinateur <u><b><a class="text-blue-link" href="https://www.knowitbetter.fr/recherche?tag=Apple">Apple</a></b></u>, si l'écran ne se duplique pas immédiatement, cliquez sur le "menu Pomme", puis sur  "préférences Système". Cliquez ensuite sur "Moniteurs", puis sélectionnez l’onglet "Disposition". Assurez-vous que la case "Recopie vidéo" est cochée.
                </p>
                <div class="warning-box"><h4 class="warning-title"><i class="fa-solid fa-circle-exclamation text-icon"></i>Un écran s'affiche mais n'est pas celui que vous voyez sur votre ordinateur?</h4><p class="info-text">Si l'écran s'affiche sur l'écran externe/le vidéo projecteur mais est différent de ce qui s'affiche sur votre ordinateur, vérifiez l'option "Recopie vidéo" est bien sélectionnée (image ci-dessous).</p></div>
                <figure>
                    <img loading="lazy" src="../article/images/dupliquer-ecran-pc-ecran-externe/dupliquer-macos.webp" alt="Recopie de l'écran macos (screenshot)">
                    <figcaption>Recopie de l'écran Apple, ©Apple
                    </figcaption>
                </figure> 
            </div>

        </div>


        <!-- emplacement pour pub -->
        <div class="google-ads-article"></div>


        <h2 class="section-title" id="3">Méthode 2 - Affichage sans fil Microsoft (Si disponible)</h2>
            <div>
                <p class="article-text">
                Si votre projecteur/écran externe prend en charge l'<b>Affichage sans fil Microsoft</b> ou <b>Miracast</b>, vous pouvez connecter votre ordinateur Windows sans lien matériel entre les deux appareil. Pour cela, votre ordinateur doit être doté du <b>Bluetooth</b>.
                <br><br>
                Pour rendre votre vidéoprojecteur ou TV compatible, vous pouvez acheter l'<a class="text-blue-link" href="https://www.microsoft.com/fr-fr/p/microsoft-wireless-display-adapter/8vwdj9bd9xlz">adaptateur sans fil de Microsoft</a>.
                <br>
                </p>
                <figure>
                    <img loading="lazy" style="max-width:400px;" src="../article/images/dupliquer-ecran-pc-ecran-externe/logo-miracast.webp" alt="Logo de Miracast">
                    <figcaption>Logo de Miracast
                    </figcaption>
                </figure>  
                <p class="article-text">
                Pour projeter votre écran via l'affichage sans fil Microsoft, vous devez tout d'abord cliquer sur les touches <b>Windows + K</b> (ou bien centre de notifications > Connecter). Ici s'affichent tous les appareils audio et d'affichage sans fil disponibles ou enregistrés.
                </p>
                <figure>
                    <img loading="lazy" style="max-width:400px;" src="../article/images/dupliquer-ecran-pc-ecran-externe/dispositifs-sans-fil-windows.webp" alt="connexion miracast sur windows 1">
                    <figcaption>
                    </figcaption>
                </figure>                 
                <p class="article-text">
                <i class="fa-solid fa-caret-right text-icon"></i>Assurez-vous que votre projecteur est bien <b>allumé</b> et <b>prêt à se connecter</b> et cliquez sur son nom pour <b>lancer la connexion</b>. Suivez les instructions sur votre écran externe si nécessaire.
                </p>
                <figure>
                    <img loading="lazy" style="max-width:400px;" src="../article/images/dupliquer-ecran-pc-ecran-externe/dispositifs-sans-fil-windows-2.webp" alt="connexion miracast sur windows 2 - Affichage des appareils audio et d'affichage sans fil via le raccourcis Windows + K.">
                    <figcaption>Affichage des appareils audio et d'affichage sans fil via le raccourcis Windows + K. ©KnowITbetter
                    </figcaption>
                </figure>
                <figure>
                    <img loading="lazy" style="max-width:400px;" src="../article/images/dupliquer-ecran-pc-ecran-externe/dispositifs-sans-fil-windows-3.webp" alt="connexion miracast sur windows 3 - Connexion à un appareil en cours">
                    <figcaption>Connexion à un appareil en cours ©KnowITbetter
                    </figcaption>
                </figure>
                <p class="article-text">
                    <i class="fa-solid fa-caret-right text-icon"></i>Une fois connecté, Vous pouvez modifier le mode d'affichage en cliquant sur <b>"Modifier le mode de projection"</b>. Pour recopier votre écran, sélectionnez <b>"Dupliquer"</b> Et voilà ! Le tour est joué !
                </p>
                <div class="warning-box"><h4 class="warning-title"><i class="fa-solid fa-circle-exclamation text-icon"></i>Un problème de connexion? de stabilité?</h4><p class="info-text">Si la connexion ne se déroule pas correctement, assurez-vous de vous situer à moins de 10 mètres de l'appareil. Ensuite, étant donné que ce mode de connexion est sans fil, ne branchez aucun câble HDMI, cela pourrait causer des problèmes d'affichage.</p></div>
                <figure>
                    <img loading="lazy" style="max-width:400px;" src="../article/images/dupliquer-ecran-pc-ecran-externe/dispositifs-sans-fil-windows-4.webp" alt="connexion miracast sur windows 4 ">
                    <figcaption>
                    </figcaption>
                </figure> 
                <figure>
                    <img loading="lazy" style="max-width:400px;" src="../article/images/dupliquer-ecran-pc-ecran-externe/dispositifs-sans-fil-windows-5.webp" alt="connexion miracast sur windows 5">
                    <figcaption>
                    </figcaption>
                </figure>
                
            </div>
        
            <h3 class="soussection-title" id="3.1" style="color:darkred;">Les moins de miracast</h2>
                <div>
                    <p class="article-text">
                        
                        <i class="fa-solid fa-circle-minus text-icon" style="color:darkred;"></i>La qualité de connexion (de l'image et du son) dépend de la qualité de la connexion bluetooth. Il peut y avoir des interférences avec les autres appareils de la pièce
                        <br><br>
                        <i class="fa-solid fa-circle-minus text-icon" style="color:darkred;"></i>Une connexion sans fil est instable (sa qualité varie continuellement contrairement à une connexion filaire)
                        <br><br>
                        <i class="fa-solid fa-circle-minus text-icon" style="color:darkred;"></i>Vous pouvez rencontrer des problèmes de "déconnexion" si votre ordinateur possède de trop faibles performances
                    </p>
                </div>

        <!-- emplacement pour pub -->
        <div class="google-ads-article"></div>




        <h2 class="section-title" id="4">Méthode 3 : Apple AirPlay (Si disponible)</h2>
            <div>
                <p class="article-text">
                Les Mac sont dotés de la fonctionnalité <a class="text-blue-link" href="https://www.knowitbetter.fr/article/recopie-ecran-airplay.php">AirPlay</a>. Celle-ci permet de diffuser le son et l'image de votre appareil Apple vers un appareil compatible. Cette fonction est généralement limitée à un usage personnel car la connexion ne se fait pas par bluetooth mais par <b>Wi-Fi</b>.
                </p>
                <figure>
                    <img loading="lazy" src="../article/images/dupliquer-ecran-pc-ecran-externe/illustration-macos.webp" alt="Recopie de l'écran d'un Mac book dur une TV via Apple Airplay">
                    <figcaption>Recopie de l'écran d'un MacBook sur une TV via Apple AirPlay.
                    </figcaption>
                </figure>
                <p class="article-text">
                <i class="fa-solid fa-caret-right text-icon"></i>Premièrement, <b>allumez</b> vos deux appareils et assurez-vous qu'ils sont <b>connectés au même réseau Wi-Fi</b>.
                </p>
                <figure>
                    <img loading="lazy" style="max-width:100px;" src="../article/images/dupliquer-ecran-pc-ecran-externe/icon-wifi.webp" alt="icon wifi">
                    <figcaption>
                    </figcaption>
                </figure>
                <p class="article-text">
                <i class="fa-solid fa-caret-right text-icon"></i>Cliquez sur l'icone de <b>recopie de l'écran</b> dans la barre des menus en haut de l'écran.
                </p>
                <div class="info-box soussection-text"><h4 class="info-title"><i class="fa-solid fa-circle-info text-icon"></i>L'icône ne s'affiche pas?</h4><p class="info-text">Si cet icone ne s'affiche pas , aller dans <b>"menu Pomme"</b> puis <b>"Préférences Système"</b> puis <b>"Moniteurs"</b>, puis sélectionnez <b>"Afficher les options de recopie vidéo dans la barre des menus"</b>.</p></div>
                <figure>
                    <img loading="lazy" style="max-width:400px;" src="../article/images/dupliquer-ecran-pc-ecran-externe/menu-superieur-macos.webp" alt="Menu supérieur macos">
                    <figcaption>Crédits : Apple
                    </figcaption>
                </figure>
                <p class="article-text">
                <i class="fa-solid fa-caret-right text-icon"></i>Vérifiez ensuite que l'option AirPlay est activée, sinon, activez la.
                <br>
                <i class="fa-solid fa-caret-right text-icon"></i>Cliquez ensuite sur le nom de votre téléviseur compatible ou de votre boitier Apple TV, qui s'affiche dans la partie "AirPlay :Moniteur AirPlay", pour recopier l'écran dessus.
                </p>
                <div class="info-box soussection-text"><h4 class="info-title"><i class="fa-solid fa-circle-info text-icon"></i>Rentrez le code de connexion</h4><p class="info-text">Lors de la première connexion, un code peut vous être demandé. Saisissez sur votre Mac le code qui s'affiche sur votre écran externe.</p></div>
                <p class="article-text">
                <i class="fa-solid fa-caret-right text-icon"></i>Depuis ce menu, vérifiez que le mode <b>"Recopie"</b> est bien sélectionné, pour recopier l'écran à l'identique. Si l'option <b>"Utiliser en tant que moniteur distinct"</b> est sélectionnée, le dispositif d'affichage sera considéré comme un <b>second écran</b>.
                </p>
                <figure>
                    <img loading="lazy" src="../article/images/dupliquer-ecran-pc-ecran-externe/airplay-macos.webp" alt="Menu airplay macos">
                    <figcaption>Crédits : Apple
                    </figcaption>
                </figure>
            </div>


        <!-- emplacement pour pub -->
        <div class="google-ads-article"></div>




        <h2 class="section-title" id="5">Résoudre des problèmes liés au son</h2>
        <div>
            <p class="article-text">
                <b>Sur Windows</b>
                <br>
                <i class="fa-solid fa-caret-right text-icon"></i>Si le son ne se transmet pas automatiquement sur le vidéo projecteur, cliquez sur <b>l'icone volume de la barre des tâches</b> puis cliquez sur la <b>flèche vers le haut</b>. Tous les dispositifs audio disponibles s'affichent ici. <b>Sélectionnez</b> le vidéoprojecteur.
                <br><br>
                <i class="fa-solid fa-caret-right text-icon"></i>Vérifiez que le volume est à un niveau correct (en non entièrement correct) puis réglez également le son de votre dispositif d'affichage (souvent via une télécommande).
                <figure>
                    <img loading="lazy" src="../article/images/dupliquer-ecran-pc-ecran-externe/probleme-son-windows.webp" alt="Problème son windows (screenshot)">
                    <figcaption>Sélection de la sortie audio sur Windows ©KnowITbetter
                    </figcaption>
                </figure>
                <b>Sur macOS</b>
                <br>
                <i class="fa-solid fa-caret-right text-icon"></i>Si le son ne se transmet pas automatiquement sur le vidéo projecteur,  cliquez sur le <b>"Menu Pomme"</b> puis sur <b>"Préférences système"</b>, sur <b>"Son"</b> et sur <b>"Sortie"</b>.  Ici s'affichent toutes les sorties audio disponibles et connectées à votre Mac. Sélectionnez celle que vous voulez.
                <br><br>
                <i class="fa-solid fa-caret-right text-icon"></i>Vérifiez également que le volume est correctement ajusté et que la touche <b>"Mute"</b> n'est pas activée. Ensuite, ajustez le volume via la télécommande votre dispositif d'affichage externe.
                <figure>
                    <img loading="lazy" src="../article/images/dupliquer-ecran-pc-ecran-externe/sortie_audio_macos.webp" alt="Problème son macos (screenshot)">
                    <figcaption>Paramètres de sortie audio MacOS ©Apple
                    </figcaption>
                </figure>
            </p>
        </div>
        <p class="article-text">
        Et voilà ! Vous savez tout sur les différentes manières de projeter l'écran de votre ordinateur sur un dispositif d'affichage externe. Si vous rencontrez des problèmes, vous pouvez nous contacter en discussion privée sur Messenger, par mail (equipe.knowitbetter@gmail.com) ou sur Instagram .
        </p>


       





        
        
        <div class="article-signature">
            <p class="article-signature-text">Publié le 11 Avril 2021 par <a style="color:darkblue" class="normal-link" href="../membres?id=1"><?php echo $auteur["pseudo"];?> - de KnowITbetter</a></p>
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

</html>

