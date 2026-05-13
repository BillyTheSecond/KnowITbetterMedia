<?php
include "database.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "composants/analytics.php";?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>KnowITbetter</title>
    <link rel="shortcut icon" href="./images/logo/favicon.ico" type="image/x-icon">
    <!-- Details site -->
    <meta name="description" content="KnowITbetter est là pour aider à comprendre les dernières tendances en matière de technologies. Que l'on soit débutant ou utilisateur expérimenté, les articles et vidéos disponibles permettent de tirer le meilleur parti de son matériel et de ses logiciels. ">
    <Meta name=" robots" content="index, follow" />
    <meta http-equiv="Cache-Control" content="private, max-age=259200, must-revalidate" />



    <!-- apple -->
    <meta name="format-detection" content="telephone=no">
    <meta name="og:title" content="KnowITbetter, la technologie à la portée de tous.">
    <meta name="og:image" content="../images/logo/logo-texte-noir.png">
    <link rel="apple-touch-icon" href="../images/logo/logocarrehd.webp">


    <!-- CSS -->
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/navigation-bar.css">
    <link rel="stylesheet" href="../css/style-apercu-articles.css">
    <!-- JS -->
    <!-- <script src="./script/implementation-composants.js"></script> -->
    <!-- <script src="./data/donnees.js"></script> -->
    <!-- <script src="./script/fonctionnalites.js"></script> -->
    <!-- <script src="./script/generation-apercus.js"></script> -->
    <!-- Kit Fontawesome et cookies-->
    <?php include "./composants/fontawesome_kit.php";?>
    <!-- google adsense -->
    <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5388627137606435" crossorigin="anonymous"></script> -->

    <!-- apple -->
    <meta name="theme-color" content="#F8B432">


    <style>
        /* GENERAL */
        div#page-content {
            padding: 20px calc(env(safe-area-inset-left) + 4vw);
            overflow-x: hidden;
        }
        h2.section-title {
            margin-top: 30px;
        }

        nav#boite-boutons-navigation {
            /* background-color:#F8B432; */
        }
        /* SECTION ARTICLES */
        section#articles {
            display:flex;
            flex-wrap:nowrap;
            gap: 40px;
            

        }

        a#article-a-la-une {
            flex: 2;
            display:flex;
            min-height:350px;
            border-radius:47px;
            overflow:hidden;
            background-size: cover;
            background-position: center;
            user-select: none;
        }
        a#article-second {
            user-select: none;
        }

        div#black-gradient {
            width: 100%;
            background-blend-mode: darken;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.42) 0%, rgba(0, 0, 0, 0.1974) 26.56%, rgba(0, 0, 0, 0) 70.83%, rgba(0, 0, 0, 0.42) 100%);
            /* background: rgba(234, 234, 234, 1); */
            display:flex;
            flex-direction:column;
            justify-content: space-between;
            padding:16px 32px;

        }
        a#article-a-la-une h3.article-titre, a#article-second h3.article-titre, a.article-tendance-box h3.article-titre {
            margin:0;
            padding:0;
            font-size:26px;
            font-weight:800;
            text-align: left;
            color: white;
        }
        a#article-second h3.article-titre, a.article-tendance-box h3.article-titre {
            color: black;
            padding-bottom: 12px;
        }
        a#article-a-la-une p.article-description, a#article-second p.article-description, a.article-tendance-box p.article-description {
            margin:0;
            padding:0;
            font-size:16px;
            font-weight:500;
            text-align: left;
            color: #EBEBEB;
        }
        a#article-second p.article-description, a.article-tendance-box p.article-description {
            color: #787878;
            padding-bottom: 12px;
        }
        div#element-droite {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 32px;

        }
        a#article-second {
            border-left: solid 8px black;
            padding-left: 12px;

        }


        /* SECTION VIDEOS */
        div#affichage-videos {
            display:flex;
            flex-wrap: wrap;
            justify-content:space-around;
            gap: 40px;

            
            
        }
        div#affichage-videos a{
            flex: 1;
            position: relative;
            max-width: fit-content;
            /* box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.25);
            border: solid 2px #EAEAEA; */
            border-radius: 12px;

        }
        div#affichage-videos a img {
            width: 100%;
            max-width: 380px;
            border: solid 3px #EAEAEA;
            box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.25);
            border-radius: 12px;

        }
        div#affichage-videos a i.float-youtube-icon {
            position: absolute;
            bottom: 12px;
            right: 12px;
            color: #FF1800;
            font-size: 28px;
        }

        /* SECTION TENDANCES */
        a.article-tendance-box {
            display:flex;
            flex-direction:row;
            flex-wrap: nowrap;
            gap: 32px;
            padding-bottom:32px;
            user-select:none;
        }
        a.article-tendance-box div.illustration {
            width: 120px;
            height: 120px;
            aspect-ratio: 1;
            position: relative;
            border-radius: 24px;
            background-size: cover;
            background-position: center;
        }
        a.article-tendance-box div.illustration div.icone-tendance {
            position: absolute;
            bottom: 10px;
            right: 10px;
            border-radius: 100px;
            height: 36px;
            width: 36px;
            display:flex;
            align-items:center;
            justify-content:center;
            text-align:center;
            font-size:24px;
            background-color: #FFFFFF;
            color: #9747FF;
        }

        /* SECTION ALEATOIRE */
        section#selection-aleatoire {
            text-align:center;
            margin-bottom: 84px;
        }


        /* NOTRE HISTOIRE */
        section#notre-histoire {
            text-align:center;

        }
        div#notre-histoire-container {
            position: relative;
            text-align:center;
            display:flex;
            align-items:center;
            justify-content:center;
            
        }
        div#notre-histoire-container a {
            position: absolute;
            bottom: -10px;
            /* left:0; */
            /* right:0; */
            margin:auto;

        }


        div#notre-histoire-container img {
            border: none;
            box-shadow: none;
            max-width: 500px;
            
        }
        /* animations au survol */
        a#article-a-la-une:hover, a#article-second:hover, div#affichage-videos a.miniature-box:hover, a.article-tendance-box:hover {
            transform: scale(1.01);
        }



        /* ordinateurs */
        @media (min-width:1000px) {
            .mobile-only {
                display:none !IMPORTANT;
            }
            section#articles {
                flex-direction:row;
            }
            div#element-droite {
                align-items: flex-start;
                justify-content: center;
            }

        }

        /* si gap n'est pas supporté */



        /* plus petits écrans et tablettes */
        @media (max-width:1000px) {
            .computer-only {
                display:none !IMPORTANT;
            }           section#articles {
                flex-direction:column;
            }
            div#affichage-videos a img {
                min-width: 300px;
            }
            a.article-tendance-box div.illustration {
                width: 80px;
                height: 80px;
            }
            a.article-tendance-box div.illustration div.icone-tendance {
                bottom: 6px;
                right: 6px;
                height: 36px;
                width: 36px;
                font-size:24px;
        
            }

        }
        /* mobiles */
        @media (max-width:750px) {

            div#affichage-videos a img {
                width: -webkit-fill-available;
                min-width: 90vw;
                max-width: 100%;
            }
            a#article-a-la-une h3.article-titre, a#article-second h3.article-titre, a.article-tendance-box h3.article-titre {
            font-size:20px;
            font-weight:800;
        }

        }



    </style>

</head>
 

<body id="body" onscroll="">

    <?php 
        include './composants/navigation-bar.php';
        echo $navigation_bar;
    ?>



<?php
// Aller chercher les 2 derniers articles
global $db;
$query1 = $db->query('SELECT `id`,`nom`,`image_bg`,`description`,`url` FROM `articles` ORDER BY `date_publication` DESC LIMIT 2');
$articles = $query1->fetchAll();

// Aller chercher les 3 dernières vidéos
$query2 = $db->query('SELECT `id`,`nom`,`miniature`,`description`,`url` FROM `videos` ORDER BY `date_publication` DESC LIMIT 3');
$videos = $query2->fetchAll();

// Aller chercher les 2 dernières tendances
$query3 = $db->query('SELECT `article` FROM `tendances` ORDER BY `id` LIMIT 2');
$id = $query3->fetchAll();
$tendances = [];
for($i = 0; $i <2; $i++) {
    $query4 = $db->query("SELECT `id`,`nom`,`image_bg`,`description`,`url` FROM `articles` WHERE `id` = '{$id[$i]["article"]}'");
    array_push($tendances, $query4->fetch());

}

// Article aléatoire
$query5 = $db->query("SELECT `url` FROM `articles`");
$url_articles = $query5->fetchAll();
$random_id = mt_rand(0,count($url_articles));





?>



<div id="page-content">
    <section id="articles">
        <a id="article-a-la-une" class="lien-sans-style" href="<?=$articles[0]["url"]?>" style="background-image: url('<?=$articles[0]["image_bg"]?>');">
            <div id="black-gradient">
                <h3 class="article-titre"><?=$articles[0]["nom"]?></h3>
                <p class="article-description"><?=$articles[0]["description"]?></p>
            </div>
        </a>
        <div id="element-droite">
            <a id="article-second" href="<?=$articles[1]["url"]?>" class="lien-sans-style">
                <h3 class="article-titre"><?=$articles[1]["nom"]?></h3>
                <p class="article-description"><?=$articles[1]["description"]?></p>
            </a>
            <a href="../articles" class="theme"><i class="fa-solid fa-arrow-right bouton-icon"></i>Voir plus d'articles</a>

        </div>
    </section>

    <section id="videos">
        <h2 class="section-title">Nos articles en vidéo <a href="../videos" class="theme computer-only"><i class="fa-solid fa-arrow-right bouton-icon"></i>Plus de vidéos</a></h2>
        <div id="affichage-videos">
            <a href="<?=$videos[0]["url"]?>" class="miniature-box lien-sans-style">
                <img loading="lazy" src="<?=$videos[0]["miniature"]?>" alt="<?=$videos[0]["nom"]?>">
                <i class="fa-brands fa-youtube float-youtube-icon"></i>
            </a>
            <a href="<?=$videos[1]["url"]?>" class="miniature-box lien-sans-style">
                <img loading="lazy" src="<?=$videos[1]["miniature"]?>" alt="<?=$videos[1]["nom"]?>">
                <i class="fa-brands fa-youtube float-youtube-icon"></i>
            </a>
            <a href="<?=$videos[2]["url"]?>" class="miniature-box lien-sans-style">
                <img loading="lazy" src="<?=$videos[2]["miniature"]?>" alt="<?=$videos[2]["nom"]?>">
                <i class="fa-brands fa-youtube float-youtube-icon"></i>
            </a>
        </div>

        <a href="../videos" class="theme mobile-only"><i class="fa-solid fa-arrow-right bouton-icon "></i>Plus de vidéos</a>
    </section>
    
    <section id="tendances">
        <h2 class="section-title">En tendance sur KnowITbetter</h2>
        <a class="article-tendance-box lien-sans-style" href="<?=$tendances[0]["url"]?>">
            <div class="illustration" style="background-image: url('<?=$tendances[0]["image_bg"]?>');">
                <div class="icone-tendance"><i class="fa-solid fa-arrow-trend-up text-icon"></i></div>
            </div>
            <div class="contenu">
                <h3 class="article-titre"><?=$tendances[0]["nom"]?></h3>
                <p class="article-description computer-only"><?=$tendances[0]["description"]?></p>
            </div>
        </a>
        <a class="article-tendance-box lien-sans-style" href="<?=$tendances[1]["url"]?>">
            <div class="illustration" style="background-image: url('<?=$tendances[1]["image_bg"]?>');">
                <div class="icone-tendance"><i class="fa-solid fa-arrow-trend-up text-icon"></i></div>
            </div>
            <div class="contenu">
                <h3 class="article-titre"><?=$tendances[1]["nom"]?></h3>
                <p class="article-description computer-only"><?=$tendances[1]["description"]?></p>
            </div>
        </a>
    </section>

    <section id="selection-aleatoire">
        <h2 class="section-title">Pas d'inspi? Laissez-nous choisir!</h2>
        <a href="<?=$url_articles[$random_id]["url"]?>" class="theme "><i class="fa-solid fa-arrow-right bouton-icon "></i>Apprenez quelque chose de nouveau!</a>

    </section>

    <section id="notre-histoire">
        <div id="notre-histoire-container">
            <img loading="lazy" src="../images/illustrations/knowitbetter.png" alt="Illustration KnowITbetter">
            <a href="../about-us" class="theme violet"><i class="fa-solid fa-arrow-right bouton-icon "></i>Découvrez notre histoire</a>

        </div>
    </section>
</div>














    <?php 
        include './composants/bas-de-page.php';
        echo $foot_page;
    
    ?>    
</body>

</html>

