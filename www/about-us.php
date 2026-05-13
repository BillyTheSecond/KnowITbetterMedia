<!DOCTYPE html>
<?php
include "database.php";

?>
<html lang="fr">

<head>
    <?php include "composants/analytics.php"; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>KnowITbetter - A propos de nous</title>
    <meta name="description" content="Découvrez qui se cache derrière KnowITbetter, le site qui vous aide à mieux comprendre et utiliser les nouvelles technologies">
    <link rel="shortcut icon" href="./images/logo/favicon.ico" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/navigation-bar.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/articles.css">
    <!-- JS -->
    <!-- <script src="./script/implementation-composants.js"></script> -->
    <!-- Kit Fontawesome -->
    <?php include "./composants/fontawesome_kit.php"; ?>

    <meta name="theme-color" content="#F8B432">

    <!-- OpenGraph -->
    <meta property="og:title" content="KnowITbetter - A propos de nous">
    <meta property="og:description" content="Découvrez qui se cache derrière KnowITbetter, le site qui vous aide à mieux comprendre et utiliser les nouvelles technologies">
    <meta property="og:image" content="/images/illustrations/knowitbetter.png">


</head>

<body id="body">
    <style>
        .aboutus-button {
            font-weight: 900;
            color: #F8B432;
            background-color: white;

        }

        section#top-page {
            margin: 0px;
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
            background-color: #F8B432;
            color: white;
        }

        #page-content,
        #redacteurs-section {
            margin: 20px 5vw;
        }


        #reseaux-container {
            justify-content: space-around;
        }

        a.reseau-box {
            flex: 1;
            display: inline-block;
            /* flex-wrap: wrap; */
            text-align: center;
            /* color: white; */
            border-radius: 16px;
            /* min-width: 50px; */
            /* min-height: 50px; */
            padding: 10px;
            margin: 5px;
        }

        a.reseau-box:hover,
        a.reseau-box:focus {
            opacity: 0.7;
        }

        .reseau-illustration {
            font-size: 40px;
        }


        /* mobiles */
        .reseau-nom {
            font-size: 12px;
        }

        a.reseau-box:hover {
            padding: 10px;
        }

        #discord {
            color: #7289da;
        }

        #youtube {
            color: #c4302b;
        }

        #facebook {
            color: #3b5998;
        }

        #instagram {
            color: #C32AA3;
        }

        #email {
            color: black;
        }
    </style>
    <?php
    include './composants/navigation-bar.php';
    echo $navigation_bar;

    ?>
    <!-- <nav id="boite-boutons-navigation">
            <p id="top-left-logo-texte" class="computer-only">KnowITbetter</p>

            <div id="boite-boutons-navigation-droite">
                <li class="nav-item "><a class="nav-item accueil-button nav-button lien-sans-style"  href="../"><img id="top-logo-rond"  style="box-shadow:none" src="../images/logo/logorondhd.png" alt="Logo du site"><p class="computer-only"><i class="fa-solid fa-house text-icon"></i>Accueil</p></a></li>
                <li class="nav-item "><a class="nav-item articles-button nav-button lien-sans-style"  href="../articles"><span class="computer-only"><i class="fa-solid fa-book-open text-icon"></i></span>Articles</a></li>
                <li class="nav-item" ><a class="nav-item videos-button nav-button lien-sans-style" href="../videos"><span class="computer-only"><i class="fa-solid fa-tv text-icon"></i></span>Vidéos</a></li>
                <li class="nav-item" ><a class="nav-item aboutus-button nav-button lien-sans-style" href="../about-us"><span class="computer-only"><i class="fa-solid fa-people-group text-icon"></i>A propos de nous</span> <span class="mobile-only">Et nous ?</span></a></li>
                <li class="nav-item"><a class="nav-item recherche-button nav-button lien-sans-style" href="../recherche"><i class="fa-solid fa-magnifying-glass text-icon"></i></a></li>
            </div>        
        </nav>   -->
    <section id="top-page" class="iphone-padding">
        <!-- <a href="../" class="lien-sans-style"> -->
        <!-- <p id="top-logo-texte" class="computer-only">KnowITbetter</p> -->
        <!-- <img loading="lazy" id="top-logo-texte" class="computer-only" style="box-shadow:none" src="../images/logo/logo-texte-noir.png" alt="Logo du site"> -->

        <!-- </a> -->

        <div class="landing-page">
            <h1 class="big-title" style="color:black;">KnowITbetter, à votre service !</h1>
        </div>


    </section>
    <section id="page-content">
        <div style="display:flex;align-items:center;justify-content:space-around;flex-wrap:wrap;">

            <p style="flex:1; font-size:18px;text-align: justify;line-height:1.5em;font-weight: 400;min-width:min(300px,90vw);margin:0 20px 20px 0;max-width:800px;">Chez <i><b>KnowITbetter</b></i>, nous comprenons l'importance de rester informé et à jour en matière de nouvelles technologies. C'est pourquoi nous avons créé ce site pour vous aider à <b>démêler les mystères de l'informatique</b>, de la téléphonie, et tous les autres domaines liés aux nouvelles technologies. <br><br>Que vous soyez un <b>débutant ou un utilisateur expérimenté</b>, nous avons des articles et des vidéos pour répondre à toutes vos questions. Nous vous garantissons des <b>réponses claires, simples, et à jour</b>. Nous sommes là pour vous aider à mieux comprendre les nouvelles technologies et à <b>en tirer le meilleur parti</b>.</p>
            <figure>
                <img loading="lazy" src="../images/logo/logorondhd.webp" style="max-width:200px;" alt="Schéma branchement HDMI">
                <figcaption>Notre logo, tout beau, tout propre!
                </figcaption>
            </figure>
        </div>

        <h2 class="section-title">Notre mission</h2>
        <p style="flex:1; font-size:18px;text-align: justify;line-height:1.5em;font-weight: 400;min-width:min(300px,90vw);margin:0 20px 20px 0;max-width:800px;">Notre mission est de <b>fournir des conseils pratiques et à jour</b> sur les dernières technologies pour <b>aider les utilisateurs</b> à comprendre et utiliser efficacement leur matériel et leurs logiciels. Nous nous engageons à fournir des informations accessibles et compréhensibles pour vous aider.</p>

        <h2 class="section-title">Notre engagement pour l'accessibilité</h2>
        <p style="flex:1; font-size:18px;text-align: justify;line-height:1.5em;font-weight: 400;min-width:min(300px,90vw);margin:0 20px 20px 0;max-width:800px;">Nous sommes engagés à fournir des informations de qualité supérieure sur les dernières technologies. Nous mettons régulièrement à jour nos articles et vidéos pour offrir des informations pertinentes. Nous croyons fermement que <b>l'accès à l'information ne doit pas être limité</b>. C'est pourquoi nous avons mis en place des mesures pour <b>garantir que notre contenu est accessible à tous</b>, quelles que soient leurs capacités. Toutes nos vidéos sont sous-titrées en français et en anglais, et nos articles sont structurés de manière à respecter les normes d'accessibilité. Nous sommes fiers de pouvoir offrir à tous nos utilisateurs une expérience inclusive.</p>

        <h2 class="section-title">Le modèle économique</h2>
        <p style="flex:1; font-size:18px;text-align: justify;line-height:1.5em;font-weight: 400;min-width:min(300px,90vw);margin:0 20px 20px 0;max-width:800px;">KnowITbetter est un site qui fonctionne grâce à la générosité de ses utilisateurs. Nous sommes convaincus que le partage de connaissances est important pour tous, et nous aimerions continuer à offrir des conseils pratiques et à jour sur les dernières technologies. Si vous avez trouvé notre contenu utile et si vous souhaitez soutenir notre mission, nous vous invitons à faire un don pour nous aider à couvrir les coûts liés au fonctionnement du site. Nous vous remercions pour votre soutien et votre engagement envers notre mission.</p>

    </section>
    <section class="reseaux-sociaux iphone-padding" style="margin: 5vw;">
        <h2 class="section-title">Nos réseaux</h2>
        <div id="reseaux-container" class="flex-container" style="max-width:800px;">
            <a id="email" href="mailto:billy@knowitbetter.fr" class="reseau-box flex-container lien-sans-style">
                <p class="reseau-illustration"><i class="fa-solid fa-envelope"></i></p>
                <p class="reseau-nom">e-mail</p>
            </a>
            <a id="instagram" href="https://www.instagram.com/equipe_knowitbetter/" class="reseau-box flex-container lien-sans-style">
                <p class="reseau-illustration"><i class="fa-brands fa-instagram"></i></p>
                <p class="reseau-nom">Instagram</p>
            </a>
            <a id="facebook" href="https://www.facebook.com/equipe.knowitbetter/" class="reseau-box flex-container lien-sans-style">
                <p class="reseau-illustration"><i class="fa-brands fa-facebook"></i></p>
                <p class="reseau-nom">Facebook</p>
            </a>
            <a id="youtube" href="https://www.youtube.com/channel/UCyyrVGzKZM8aPmug93eynFg" class="reseau-box flex-container lien-sans-style">
                <p class="reseau-illustration"><i class="fa-brands fa-youtube"></i></p>
                <p class="reseau-nom">Youtube</p>
            </a>
            <a id="discord" alt="Venez discuter avec nous sans aucune limite!" href="https://discord.gg/nstN6Yg7CW" class="reseau-box flex-container lien-sans-style">
                <p class="reseau-illustration"><i class="fa-brands fa-discord"></i></p>
                <p class="reseau-nom">Rejoindre notre Discord</p>
            </a>

        </div>
        <?php
        global $db;
        $auteurs = $db->query('SELECT * FROM auteurs ORDER BY date_inscription ASC LIMIT 3');
        $nb_auteurs = $db->query('SELECT COUNT(*) FROM auteurs');
        $nb_auteurs = $nb_auteurs->fetchColumn();


        ?>







    </section>
    <section id="redacteurs-section" class="iphone-padding">
        <h2 class="section-title">Vos rédacteurs-en-chef</h2>
        <p style="flex:1; font-size:18px;text-align: justify;line-height:1.5em;font-weight: 400;min-width:min(300px,90vw);margin:0 20px 20px 0;max-width:800px;">Notre équipe est composée de passionnés de nouvelles technologies, qui s'efforcent de fournir des informations de qualité supérieure et à jour sur les dernières tendances et les meilleures pratiques en matière de technologies. Nous travaillons ensemble pour vous offrir les meilleurs conseils et astuces pour vous aider à tirer mieux comprendre vos technologies.</p>

        <div class="redacteurs-boxes-container" style="max-width:800px;">

            <?php
            while ($auteur = $auteurs->fetch()) {
                $code_auteur = "";
                $code_auteur = $code_auteur . '<div onclick=\'document.location="../membres?id=1"\' class="lien-sans-style auteur-box flex-container">';
                $code_auteur = $code_auteur . '<div class="auteur-photo-box">';
                $code_auteur = $code_auteur . '<img loading="lazy" src="' . $auteur['photo'] . '" alt="photo de profil de ' . $auteur['prenom'] . '" class="auteur-photo">';
                $code_auteur = $code_auteur . '</div><div class="auteur-description-box">';
                $code_auteur = $code_auteur . '<p class="auteur-nom">' . $auteur["pseudo"] . ' - de KnowITbetter</p>';
                $code_auteur = $code_auteur . '<p class="auteur-date">Depuis le ' . dateToFrench($auteur["date_inscription"], 'j F Y') . '</p>';
                $code_auteur = $code_auteur . '<p class="auteur-devise"><span style="font-size:150%">&laquo;</span>' . $auteur['presentation'] . '<span style="font-size:150%">&raquo;</span></p>';
                $code_auteur = $code_auteur . '</div></div>';



                echo $code_auteur;
            }



            ?>
        </div>
    </section>

    <?php
    include './composants/bas-de-page.php';
    echo $foot_page;

    ?>
</body>

</html>