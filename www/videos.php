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
    <meta name='description' content='Retrouvez tous nos conseils en vidéo sur KnowITbetter'>
    <title>KnowITbetter - Vidéos</title>
    
    <link rel="shortcut icon" href="../images/logo/favicon.ico" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/navigation-bar.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/style-apercu-articles.css">

    <!-- JS -->
    <!-- <script src="./script/implementation-composants.js"></script> -->
    <!-- Kit Fontawesome -->
    <?php include "./composants/fontawesome_kit.php";?>

    <!-- couleur -->
    <meta name="theme-color" content="#F8B432">

    <!-- OpenGraph -->
    <meta property="og:title" content="KnowITbetter - Vidéos">
    <meta property="og:description" content="Retrouvez tous nos conseils en vidéo sur KnowITbetter">


</head>
<body id="body">
    <style>
        .videos-button {
            font-weight: 900;
            color: #F8B432;
            background-color: white;
        }
        section#top-page {
        margin:0px;
        /*pour que le fichier css retrouve une image qui n'est pas dans son dossier, il doir revenir au dossier racine . Pour cela, on met ../ devant l'url 
        Pour le CSS, mettre un point virgule à la fin de chaque action/ligne */
        /* background: url('../images/fonds/fondflourougeorange.jpg'); */
        background-color:whitesmoke;
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

    /* #videos-container {
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding-top : 10px;

    } */
    a.video-box {
        flex:1
    }
    @media (min-width:900px) {
        #videos-container {
            max-width:800px;
        }
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
        </nav>      -->
    <section id="top-page" class="iphone-padding" >
        <a href="../" class="lien-sans-style">
            <!-- <p id="top-logo-texte" class="computer-only">KnowITbetter</p> -->
            <!-- <img id="top-logo-texte" class="computer-only" style="box-shadow:none" src="../images/logo/logo-texte-noir.png" alt="Logo du site"> -->
        
        </a>
    

        <div class="landing-page">
            <h1 class="big-title" style="color:black;">Nos vidéos</h1 >
            </div>
        

    </section>
    <section class="iphone-padding" style="display:flex;flex-direction:column; align-items:center;">
        <div id="videos-container" class="flex-container">

            <!-- <div class="video-box flex-container" > -->
                <!-- <img class="video-miniature" src="./images/miniatures/shadow.JPG" alt=""> -->
                <!--<div class="conteneur-description-video">
                    <h3 class="video-title">Un problème est survenu</h3>
                    <div class="tags-container flex-section">
                        <p class="tag">ERREUR</p>

                    </div>
                    <p class="accroche">Nous ne sommes pas parvenu à charger l'intégralité du site. Assurez-vous que votre navigateur soit à jour et que Javascript soit bien activé</p>

                </div>
                <div class="icones-container">                      
                    <div class="icone-article">
                        <i class="fa-solid fa-warning"></i>
                    </div>
                    <div >ERREUR</div>


                </div>
                    
            </div> -->


            <?php     
                global $db;
                $dernieres_videos = $db->query('SELECT * FROM videos ORDER BY date_publication DESC LIMIT 50');
                // $nb_total_videos = $db->query('SELECT MAX(id) FROM videos');
                // $nb_total_videos = $nb_total_videos->fetchColumn();
                $nb_total_videos = $db->query('SELECT COUNT(*) FROM videos');
                $q_indices_videos_recentes = $db->query('SELECT id FROM videos ORDER BY date_publication DESC LIMIT 2');
                $indices_videos_recentes = array(); //instancier le tableau contenant les index des videos recentes
                while ($ligne = $q_indices_videos_recentes->fetch()) { //a chaque tour de boucle, $ligne prend pour valuer toutes les lignes de $q_indices_videos_recentes
                    array_push($indices_videos_recentes,$ligne); //ajoute la 'indice au tableau

                }
            ?>



            <?php
                while ($video = $dernieres_videos->fetch()) {
                    $code_video = '<a href="'. $video["url"] .'" class="video-box flex-fontainer lien-sans-style">';
                    $code_video .= '<div class="image-fond" style="background: url('. $video["miniature"] .');background-size: cover;background-position:center;">';
                    $code_video .= '<div class="linear-gradient">';
                    $code_video .= '<div class="video-title-box">';
                    $code_video .= '<h3 class="video-title">'. $video["nom"] .'</h3>';
                    $code_video .= '<div class="type-icons-box">';
                    // if($video["article_statement"] == 1) {
                    //     $code_video .= '<i class="fa-solid fa-bars text-icon"></i>';
                    // }
                    // if($video["video_statement"] == 1) {
                        $code_video .= '<i class="fa-solid fa-circle-play text-icon"></i>';
                    // }
                    $code_video .= '</div></div>';
                    if ($video['id'] == $indices_videos_recentes[0]['id'] || $video['id'] == $indices_videos_recentes[1]['id']) {
                        $code_video .= '<p class="icone-recent">NEW</p>';
                    }
                    $code_video .= '</div></div>';
                    $code_video .= '<div class="video-box-description computer-only" style="display:none">';
                    // $code_video .= '<div class="tags-container">';
                    // $tags = explode(",",$video["tags"]);
                    // $code_video .= '<p class="tag">' . $tags[0] . '</p><p class="tag">'. $tags[1] . '</p><p class="tag">'. $tags[2] . '</p>';
                    // $code_video .= '</div>';
                    $code_video .= '<p class="accroche computer-only">'. $video["description"] .'</p>';
                    $date_video = date_create($video['date_publication']);
                    if (date_format($date_video,"Y") == date('Y')){
                        $date_video = date_format($date_video, 'j F');
                        $code_video = $code_video . '<p class="date-video computer-only">'. dateToFrench($date_video, 'j F').'</p>';
                    } else {
                        $date_video = date_format($date_video, 'j F Y');
                        $code_video = $code_video . '<p class="date-video computer-only">'. dateToFrench($date_video, 'j F Y').'</p>';
                    }
                    $code_video .= '</div></a>';

                    echo $code_video;

                }


                while ($video = $dernieres_videos->fetch()) {
                    $code_video = "";
                    $code_video = $code_video . '<a href="'. $video["url"].'" class="video-box flex-container lien-sans-style" style="flex:1;max-width:800px;width:-webkit-fill-available">';
                    $code_video = $code_video . '<img loading="lazy" class="video-miniature" src="'. $video["miniature"].'" alt="'. $video["nom"].'">';
                    $code_video = $code_video . '<div class="conteneur-description-video">';
                    $code_video = $code_video . '<div class="apercu-video-infos">';
                    $code_video = $code_video . '<h3 class="video-title">'. $video["nom"].'</h3>';
                    // gestion des tags à implémenter
                    $code_video = $code_video. '<div class="tags-container ">';
                    $tags = explode(",",$video["tags"]);
                    $code_video = $code_video . '<p class="tag">' . $tags[0] . '</p><p>&ensp;|&ensp;</p><p class="tag">'. $tags[1] . '</p><p>&ensp;|&ensp;</p><p class="tag">'. $tags[2] . '</p>';
                    $code_video = $code_video. '</div>';


                    $code_video = $code_video . '<p class="accroche computer-only" >'. $video["description"] . '</p>';
                    $code_video = $code_video . '</div>';
                    // Affichage date
                    $date_video = date_create($video['date_publication']);
                    if (date_format($date_video,"Y") == date('Y')){
                        $date_video = date_format($date_video, 'j F');
                        $code_video = $code_video . '<p class="date-video computer-only">'. dateToFrench($date_video, 'j F').'</p>';
                    } else {
                        $date_video = date_format($date_video, 'j F Y');
                        $code_video = $code_video . '<p class="date-video computer-only">'. dateToFrench($date_video, 'j F Y').'</p>';
                    }

                    $code_video = $code_video . '<div class="icones-container">';
                    // if($video["article_statement"] == 1) {
                    //     $code_video = $code_video.'<div class="icone-article" onclick="location.href=\"'. $article["url"] .'\"" ><i class="fa-solid fa-newspaper"></i></div>';
                    // }
                    $code_video = $code_video.'<div class="icone-video"><i class="fa-solid fa-play"></i></div>';
                    if ($video['id'] == $indices_videos_recentes[0]['id'] || $video['id'] == $indices_videos_recentes[1]['id']) {
                        $code_video = $code_video.'<div class="icone-recent"></div>';
                    }
                    $code_video = $code_video. '</div>';
                    $code_video = $code_video. '</div></a>';

                    


                    // echo $code_video;
                }

            ?>
        </div>
        <?php 
        include './composants/bas-de-page.php';
        echo $foot_page;
        
        ?>

    </section>
</body>
</html>