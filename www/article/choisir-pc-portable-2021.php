<?php 
    session_start();
    include "../database.php";
    global $db;

    $article = $db->query('SELECT * FROM articles WHERE id = 6');
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
    <title>KnowITbetter - Comment choisir un ordinateur portable en 2021?</title>
    <link rel="shortcut icon" href="../images/logo/favicon.ico" type="image/x-icon">
    <!-- Details site -->
    <meta name="description" content="Choisir un nouvel ordinateur peut être une tâche difficile : des caractéristiques techniques, du vocabulaire inconnu... Nous expliquons ici tous les points importants dans la sélection d'un nouvel ordinateur portable.">
    <Meta name=" robots" content="index, follow" />

    <!-- apple -->
    <meta name="format-detection" content="telephone=no">
    <meta name="og:title" content="KnowITbetter - Comment choisir un ordinateur portable en 2021?">
    <meta name="og:image" content="../article/images/choisir-pc-portable-2021/fond-choisir-pc-portable-2021.webp">
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




</head>
<body id="body" onscroll="scroll_menu()">



    <style>

        section#top-page {
        /* margin:0px; */
        /* background: url('../article/images/choisir-pc-portable-2021/fond-choisir-pc-portable-2021.webp') bottom; */
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
            <p class="amorce">Vous voulez changer d'ordinateur portable, votre vielle machine devient de moins en moins utilisable, mais vous ne savez pas comment choisir le bon ordinateur sans vouloir acheter une machine de guerre. Cet article est pour vous !
            </p>
            
        </div>



        <?php 
            include "../composants/bandeau-partage.php";
        ?>

        <!-- sommaire -->
        <div class="sommaire">
            <h2 class="sommaire-title">Cet article en bref</h2>
            <ul class="sommaire-list">
                <li class="sommaire-item"><a class="sommaire-link" href="#1"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Le système d'exploitation (OS)</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#2"><i class="fa-solid fa-circle-chevron-right text-icon"></i>La taille de l'écran</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#3"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Disque Dur (HDD) VS Solid State Drive (SSD)</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#4"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Le stockage (ROM)</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#5"><i class="fa-solid fa-circle-chevron-right text-icon"></i>La mémoire vive (RAM)</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#6"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Les connectiques</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#7"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Nos recommendations</a></li>

            </ul>
        </div>



        <!-- contenu de l'article -->
        <h2 class="section-title" id="1">Le système d'exploitation (OS)</h2>
        <figure>
            <img loading="lazy" src="../article/images/choisir-pc-portable-2021/1.webp" alt="Logos de différents systèmes d'exploitation">
            <figcaption></figcaption>
        </figure>
        <p class="article-text">
            Pour choisir un nouvel ordinateur portable, une des erreurs récurrentes est de se dire "Je vais prendre la même marque parce que ça fonctionnait bien". En réalité, la première question que l'on doit se poser est celle du <b>système d'exploitation</b>: préférez-vous Windows? masOS? ou encore des systèmes Linux?
            <br><br>
            Nous vous conseillons de rester sur le <b>même système que votre ancien ordinateur</b> car tout diffère d'un système à l'autre.
            <br><br>
            <i class="fa-solid fa-caret-right text-icon"></i>Si vous n'avez jamais eu d'ordinateur, <b><i class="fa-brands fa-windows text-icon"></i>Windows</b> est le système d'exploitation de Microsoft, c'est <b>le plus répandu</b> de nos jours et sa dernière version est assez <b>simple d'utilisation</b>.
            <br><br>
            <i class="fa-solid fa-caret-right text-icon"></i><b><i class="fa-brands fa-apple text-icon"></i>MacOS</b> est le système d'exploitation d'Apple, il peut offrir plus de fonctions si vous êtes dans un écosystème Apple (Comme par exemple <a class="text-blue-link" href="../article/recopie-ecran-airplay.php">AirPlay</a>). Il est en revanche réputé pour être bien <b>plus sécurisé</b> et vous n'aurez pas l'obligation d'installer un antivirus.
            <br><br>
            <i class="fa-solid fa-caret-right text-icon"></i>Les systèmes "<b><i class="fa-brands fa-linux text-icon"></i>Linux</b>", sont des systèmes d'exploitation qui ont la même base que macOS, mais contrairement à celui-ci ils sont "<b>open-source</b>", c'est à dire qu'ils sont libres, vous pouvez les installer <b>gratuitement</b>. Nous les conseillons vivement à ceux qui aiment <b>bidouiller</b> et qui aimeraient commencer à <b>programmer</b>.
            <br><br>
            <i class="fa-solid fa-caret-right text-icon"></i>Il existe également d'autres systèmes d'exploitation pour ordinateurs, comme <b><i class="fa-brands fa-chrome text-icon"></i>chromeOS</b>, développé par google qui est plus récent, et qui a donc encore du chemin à faire. Le système étant <b>basé sur Android</b>, il sera bien <b>plus simple d'utilisation</b> pour les personnes ayant déjà un appareil du même genre.
        </p>

        <h2 class="section-title" id="2">La taille de l'écran</h2>
        <figure>
            <img loading="lazy" src="../article/images/choisir-pc-portable-2021/2.webp" alt="Illustration des différenets tailles d'écrans">
            <figcaption>source: Apple</figcaption>
        </figure>
        <p class="article-text">
            Lors de l'achat d'un ordinateur portable, il faut choisir une <b>taille d'écran qui correspond à nos besoins ou à nos habitudes</b>. Il faut que l'écran soit <b>confortable</b> , ni trop petit ni trop grand. Une mauvaise taille peut fatiguer énormément les yeux. La taille de l'écran se mesure sur la diagonale en pouces (se note " , 1"=2,54 cm).
            
            Si vous <b>transportez votre ordinateur</b> souvent, pour aller travailler, par exemple, choisissez un ordinateur <b>léger</b> avec un petit format (conseil : <b>13-14 pouces max</b>). Il doit pouvoir être glissé facilement dans un sac .
            
            En revanche, si votre ordinateur <b>reste souvent à la maison</b> et est transporté occasionnellement, l'écran peut être <b>plus grand</b>. On peut alors se permettre un meilleur confort visuel. Attention tout de même à ne pas choisir trop grand.
            <br><br>
            Nous vous conseillons dans tous les cas d'<b>aller en magasin</b> et <b>comparer les différentes tailles d'écran</b>, ne vous fiez pas aux images sur les sites web !
            Notez que les tailles d'écran générales pour les pc portables sont : 14" et 15". <b>Les ordinateurs 17" sont de plus en plus rares</b> (ils ne sont pas "portables"). On se retrouve alors dans les PC Gamers, largement plus chers et dont les performances sont plus élevées, ce qui n'est pas forcément ce que vous recherchez.
            <br><br>
            Un autre facteur est à prendre en compte pour l'écran est son <b>ratio</b> : Il existe des écrans 3:2, 16:9 ou encore 16:10. Le ratio le plus courant est 16:9. (voir schéma ci-dessous)
            
            Enfin, la résolution et la qualité des écrans de la majorité des ordinateurs récents sont plus que correctes.
        </p>
        <figure>
            <img loading="lazy" src="../article/images/choisir-pc-portable-2021/3.webp" alt="Comparaisons des différentes tailles d'écran et ratios, source : TechGuide">
            <figcaption>
                Comparaisons des différentes tailles d'écran et ratios, source : TechGuide
            </figcaption>
        </figure>
        
        <!-- emplacement pour pub -->
        <div class="google-ads-article"></div>



        <h2 class="section-title" id="3">Disque dur (HDD) VS Solid State Drive (SSD)</h2>
        <figure>
            <img loading="lazy" src="../article/images/choisir-pc-portable-2021/4.webp" alt="Photo d'un SSD et d'un HDD">
            <figcaption>
                Photo d'un SSD (à gauche) et d'un HDD (à droite)
            </figcaption>
        </figure>

        <p class="article-text">Vous avez dû en entendre parler, mais qu’est-ce que c’est ?
            <br><br>
            <i class="fa-solid fa-caret-right text-icon"></i>Les <b>disques HDD</b> (de l'anglais Hard Disk Drive) sont un moyen de <b>stockage de données mécanique</b>. A l’intérieur, se trouvent des <b>disques</b> ainsi qu’une <b>tête de lecture</b>. Cela <b>limite la vitesse d’écriture et de lecture</b> des données (tour/minute du disque). Cela le rend aussi <b>très fragile</b>, il n’est pas rare qu'il cassent. Les <b>prix</b> des HDD <b>sont donc moindres</b>. Ils sont de moins en moins utilisés dans les ordinateurs portables car trop fragiles et moins rapides.
            <br><br>
            <i class="fa-solid fa-caret-right text-icon"></i>Les <b>« disques » SSD</b> (de l'anglais Solid-State Drive) permettent également de stocker des données mais ce <b>ne sont pas des disques</b>. Ils fonctionnent plutôt comme une carte SD la <b>vitesse de lecture et d’écriture est donc plus élevée</b>. Ils sont aussi bien <b>plus résistants</b> à la poussière et aux chocs , <b>ne sont pas bruyant</b>, et <b>chauffent moins</b> (il n'y a pas de mouvements à l'intérieur) ! Leur<b> prix</b> est par contre <b>plus élevé</b> (mais les SSD commencent à être abordables, leur prix est en constante baisse).
        </p><br>
        <p class="article-text soussection-text">
            Il présentent en revanche <b>un désavantage</b> : <b>leur durée de vie est limitée</b>. En effet, il possèdent un nombre de <b>térabytes écrits maximum</b> (TBW): Durant leur vie, on ne pourra pas écrire plus de tant de terabytes de données dessus. Ces limites sont tout de même <b>conséquentes</b>. D'après <a class="text-blue-link" href="https://www.ontrack.com/fr-fr/blog/quelle-est-la-duree-de-vie-reelle-des-ssd#:~:text=Cette%20technique%20indique%20combien%20de,par%20jour%20en%201%20an.">ontrack.com</a> ,un SSD de 250 Go possède entre 60 et 150 TBW "Ainsi, pour garantir un TBW de 70 Go, un utilisateur devrait écrire 190 Go par jour en 1 an ", ce qui est improbable. 150 TBW correspondent à une écriture de 40 Go sur un période de 10 ans. Certains SSD vont même jusqu'à 600 TBW.
            <br><br>
            La plupart des SSD, durent généralement bien au delà de leurs TBW et peu de gens arrivent à atteindre cette limite. Dans tous les cas, il est <b>important de faire des sauvegardes régulières</b> des données importantes.
        </p>
        <br>
        <p class="article-text">Il est donc <b>très fortement conseillé</b> (voir impératif) de prendre un ordinateur avec un <b>SSD</b> intégré à moins que vous n'utilisiez peu votre ordinateur, que vous ne ne transportiez peu et que vous avez le temps de patienter s'il met du temps à démarrer.</p>
        
        <!-- partie 4 -->
        <h2 class="section-title" id="4">Le stockage (ROM)</h2>
        <figure>
            <img loading="lazy" src="../article/images/choisir-pc-portable-2021/5.webp" alt="Voir l'espace de stockage occupé sur un ordinateur windows">
            <figcaption>
            Source: KnowITbetter
            </figcaption>
        </figure>
        <div class="info-box"><h4 class="info-title"><i class="fa-solid fa-circle-info text-icon"></i>Voir ce qui occupe le plus de stockage</h4><p class="info-text">Vous pouvez consulter l'analyse détaillée de l'espace occupé de votre disque dans Windows<i class="fa-solid fa-angle-right text-icon"></i>Paramètres<i class="fa-solid fa-angle-right text-icon"></i>Système<i class="fa-solid fa-angle-right text-icon"></i>Stockage</p></div>
        <p class="article-text">
            Le choix de la capacité de stockage (=mémoire ROM: mémoire morte) de votre futur ordinateur est important. C'est dans cette mémoire que toutes les données de votre ordinateur seront stockées (vos fichiers, vos téléchargements, vos photos, vos logiciels…). La plupart des constructeurs proposent des ordinateurs portables allant <b>de 256 Go à 1To de stockage</b>. Il est déconseillé d'acheter un ordinateur avec moins de 256 Go de stockage car <b>vous ne pourrez presque rien faire dessus</b>, mis à part aller sur internet).
            
        </p>
        <div class="warning-box"><h4 class="info-title"><i class="fa-solid fa-circle-info text-icon"></i>Attention</h4><p class="info-text">Le stockage indiqué est toujours inférieur à la capacité de stockage réelle de l'appareil. Le système d'exploitation et les logiciels préinstallés prennent déjà de la place. Par exemple, Windows peut prendre utiliser <b>entre 20 Go et 40 Go</b>.</p></div>

        <p class="article-text soussection-text">
            <i class="fa-solid fa-caret-right text-icon"></i><b>256 Go</b> est <b>très peu</b> pour une utilisation régulière ou si vous souhaitez installer des logiciels lourds. Votre stockage sera vite saturé. Cependant, si vous possédez une connection internet, Il est possible de vous tourner vers le <b>Cloud</b>. Ce sont des services de <b>stockage en ligne</b> qui vous permettent d'<b>accéder à vos fichiers depuis n'importe quel appareil connecté à internet</b>. Il existe notamment OneDrive, Google Drive, iCloud ou encore Dropbox […]. Sinon, vous aurez vite besoin d'appareils de stockage externe (clefs USB, disques dur externes…), qui peuvent vite devenir encombrants.
            <br><br>
            Si vous vous utilisez principalement votre ordinateur pour aller sur <b>internet</b>, faire du <b>traitement de texte sans trop installer de logiciels ou de jeux</b>, 256 Go vous suffirons amplement!
            <br><br>
            <i class="fa-solid fa-caret-right text-icon"></i><b>500 Go</b> est une <b>capacité très correcte</b> si vous ne téléchargez pas une grande quantité de gros logiciels, de jeux lourds ou si vous ne sauvegardez pas de grandes quantités de fichiers sur votre ordinateur. Vous aurez une <b>grande marge de manœuvre</b> et les <b>prix</b> des SSD et HDD de 500 Go sont bien <b>moins élevés</b> que ceux de 1To. Si vous utilisez votre ordinateur pour faire du <b>traitement de texte</b>, <b>des diaporamas</b>, d'installer <b>plus de logiciels ou de jeux</b> ou encore, dans un <b>cadre scolaire</b>, cette capacité est faite pour vous!
            <br><br>
            <i class="fa-solid fa-caret-right text-icon"></i><b>1To</b> et plus (soit 1000 Go) est la <b>capacité parfaite</b> si vous utilisez votre ordinateur pour effectuer des sauvegardes de photos, vidéos [...] pour jouer à de nombreux jeux ou utiliser une grande quantité de fichiers lourds… <b>Vous ne tomberez pas à cours de stockage </b> avant plusieurs années !
        </p>

        <!-- emplacement pour pub -->
        <div class="google-ads-article"></div>


        <h2 class="section-title" id="5">La mémoire vive (RAM)</h2>
        <p class="article-text">
            La <b>Mémoire RAM</b> (mémoire vive) permet d’accélérer le PC, de <b>rendre la navigation plus fluide</b>, sans ralentissements. Elle stocke des données temporairement et <b>soulage le processeur</b>. Voici les critères pour bien choisir votre mémoire RAM :
            <br><br>
        </p>
        <p class="article-text soussection-text">
            <b>4 Go de RAM</b> <i class="fa-solid fa-right-long text-icon"></i> 1 seule chose simple à la fois (Naviguer sur le web avec peu d’onglets; word; excel; solitaire…). Le PC <b>mettra du temps</b> à effectuer ce qui lui est demandé, avoir des <b>ralentissements</b>, des "lags".
            <br><br>
            <b>8 Go</b> <i class="fa-solid fa-right-long text-icon"></i> Possibilité de faire plusieurs choses en même temps, (plus d’onglets sur internet, <b>navigation fluide, ralentissements presque invisibles</b>, jeux qui demandent plus de puissance (mais pas trop non plus !)…
            <br><br>
            <b>16 Go et 32 Go</b> <i class="fa-solid fa-right-long text-icon"></i> <b>Jeux vidéo</b> conséquents, <b>montage</b> vidéo/photo, <b>diffusion de contenu en direct</b>…
        </p>
        <figure>
            <img loading="lazy" src="../article/images/choisir-pc-portable-2021/6.webp" alt="Capture d'écran du gestionnaire des tâches Windows : Utilisation de la mémoire RAM en temps réel. Source : KnowITbetter">
            <figcaption>
            Capture d'écran du gestionnaire des tâches Windows : Utilisation de la mémoire RAM en temps réel. Source : KnowITbetter
            </figcaption>
        </figure>

        



        <h2 class="section-title" id="6">Les connectiques</h2>
        <figure>
            <img loading="lazy" src="../article/images/choisir-pc-portable-2021/7.webp" alt="Illustration: les différentes connectiques d'un ordinateur">
            <figcaption>
            </figcaption>
        </figure>
        <p class="article-text">
        Les ordinateurs récents disposent <b>de moins en moins de connectiques</b>, notamment en USB-A. Aujourd'hui, certains ordinateurs haut de gamme ne possèdent plus que des ports USB Type-C. Il faut donc <b>être plus vigilent</b>. Prenons l'exemple d'un ordinateur avec 2 ports USB. Une fois une souris branchée, nous n'en as plus qu'un seul d'utilisable. Si l'on branche une imprimante filaire, il n'y a plus de ports disponibles pour un clef USB. Il faudra alors revenir à la solution du HUB. Il est donc important d'analyser ses besoins et de se renseigner sur le nombre de ports.
        <br><br>
        Voici quelques détails sur différents types de connectiques:
        </p>
        <div class="flex-container">
        <div class="info-box" style="background-color: #2e8b571f;color: seagreen;border: solid 3px seagreen;flex:1;min-width:150px;"><h4 class="info-title"><i class="fa-brands fa-usb text-icon"></i>L'USB Type-A</h4><img loading="lazy" src="../article/images/choisir-pc-portable-2021/8.webp" alt="USB Type-A" style="width:100%;"><p class="info-text">C'est le port <b>le plus répandu</b> aujourd'hui, utilisé pour brancher tous types d'appareils (Appareil photos, clefs USB, disques dur externes…) Il est en déclin mais reste tout de même <b>indispensable</b> de nos jours.</p></div>
        <div class="info-box" style="background-color: #2e8b571f;color: seagreen;border: solid 3px seagreen;flex:1;min-width:150px;"><h4 class="info-title"><i class="fa-brands fa-usb text-icon"></i>L'USB Type-C</h4><img loading="lazy" src="../article/images/choisir-pc-portable-2021/9.webp" alt="USB Type-C" style="width:100%;"><p class="info-text">C'est un type de connectique qui apparait de plus en plus sur le marché des ordinateurs ainsi que sur celui des smartphones. C'est une nouvelle connectique qui va s'implanter encore et encore sur tous types d'appareils jusqu'à sûrement remplacer l'USB-A. Pourquoi ? C'est une <b>connectique multi-usage</b>! Elle peut <b>faire passer du courant</b> (recharge plus puissante), des <b>données</b> (plus rapidement), de la <b>vidéo</b> (HDMI), du <b>son</b> (écouteurs USB Type-C), <b>internet</b> (Ethernet)… [Sous condition d'être de génération 3.0] Certains ordinateurs récents disposent uniquement de ports USB Type-C, il faut alors se tourner vers des Hubs.</p></div>
        <div class="info-box" style="background-color: #2e8b571f;color: seagreen;border: solid 3px seagreen;flex:1;min-width:150px;"><h4 class="info-title"><i class="fa-solid fa-film text-icon"></i>HDMI</h4><img loading="lazy" src="../article/images/choisir-pc-portable-2021/10.webp" alt="HDMI" style="width:100%;"><p class="info-text">Permet de recopier l'écran d'un ordinateur vers une TV, un écran, un vidéoprojecteur… Permet également d'utiliser un second moniteur. Il existe aussi les ports Micro-HDMI, moins encombrants sur les ordinateurs portables, qui ont la même fonction</p></div>
        <div class="info-box" style="background-color: #2e8b571f;color: seagreen;border: solid 3px seagreen;flex:1;min-width:150px;"><h4 class="info-title"><i class="fa-solid fa-headphones text-icon"></i>Le Port Jack (prise casque)</h4><img loading="lazy" src="../article/images/choisir-pc-portable-2021/11.webp" alt="Port Jack 3.5 mm" style="width:100%;"><p class="info-text">Connectique qui s'occupe de la diffusion sonore. Nous pouvons y brancher des écouteurs, une enceinte (avec un cable jack)…</p></div>

        </div>

        <!-- emplacement pour pub -->
        <div class="google-ads-article"></div>


        <h2 class="section-title" id="7">Nos recommendations</h2>
        <p class="article-text">Une fois que vous avez conscience de tous ces critères, vous n'avez peut être toujours pas d'idée ni de pistes pour savoir quel ordinateur choisir… C'est pour cela que nous avons élaboré une liste d'ordinateurs que nous vous conseillons!</p>
        <br>
        <div class="flex-container flex-lefttext-rightimg soussection-text">
            <p class="article-text">
                <i class="fa-solid fa-diamond text-icon"></i><b>Le Huawei MateBook D14 2020 (SSD, 512 Go)</b> : Malgré l'embargo Américain, Huawei peut toujours produire des ordinateurs qui fonctionnent parfaitement avec Windows.
                <br><br>
                Avec son design sobre et épuré et sa finition de qualité, il se glisse très facilement dans un sac et est plutôt léger (1,38 kg). Son autonomie est également bonne , il tient facilement plusieurs heures! Il possède un écran de <b>14 pouces, un SSD de 512 Go et 8go de RAM</b>.
                <br><br>
                Il existe aussi en version <b>15 pouces</b>, où certaines caractéristiques diffèrent.
            </p>
            <figure style="max-width: 350px;">
                <img loading="lazy" src="../article/images/choisir-pc-portable-2021/12.webp" alt="Huawei MateBook D14 2020" style="max-width:300px;">
                <figcaption>Huawei MateBook D14 2020</figcaption>
            </figure>
        </div>


        
        
        <div class="article-signature">
            <p class="article-signature-text">Publié le 30 Janvier 2021 par <a style="color:darkblue" class="normal-link" href="../membres?id=1"><?php echo $auteur["pseudo"];?> - de KnowITbetter</a></p>
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
        <amp-ad width="100vw" height="320"
            type="adsense"
            data-ad-client="ca-pub-5388627137606435"
            data-ad-slot="9314954521"
            data-auto-format="rspv"
            data-full-width="">
        <div overflow=""></div>
        </amp-ad>
        <?php include "../composants/pubs.php";?>
        

        </div>

        </div>

      <?php 
        include '../composants/bas-de-page.php';
        echo $foot_page;
        
        ?>


</body>
