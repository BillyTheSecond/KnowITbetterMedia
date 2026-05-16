<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "../composants/analytics.php";?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>KnowITbetter - Erreur 404</title>
    <link rel="shortcut icon" href="../images/logo/favicon.ico" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="/css/general.css">
    <link rel="stylesheet" href="/css/navigation-bar.css">
    <link rel="stylesheet" href="/css/style-apercu-articles.css">
    <!-- JS -->
    <!-- <script src="../script/implementation-composants.js"></script> -->
    <!-- <script src="../data/donnees.js"></script> -->
    <!-- <script src="../script/generation-apercus.js"></script> -->
    <!-- Kit Fontawesome -->
    <?php include "../composants/fontawesome_kit.php";?>

</head>
<style>
        section#top-page {
        margin:0px;
        background-color: #ffc107;



    }
    nav#boite-boutons-navigation {
            background-color:#ffc107;
            color:black;
        }
</style>
<body id="body">
    <?php  
    include '../composants/navigation-bar.php';
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
    </nav>        -->
    <section id="top-page" class="iphone-padding">

        <div class="landing-page">
            <h1 class="big-title"><i class="fa-solid fa-face-frown-open"></i> 404 - Page introuvable...</h1>
            <p style="text-align: center;font-size: 18px;">La page que vous recherchez n'existe pas ou a été déplacée</p>
        </div>
        

    </section>
    <section id="actions-disponibles-404">
        <div class="boutons flex-container" style="justify-content: center;padding-top: 10px;">
            <a class="primaire" href="../"><i class="fa-solid fa-house text-icon"></i> Retourner à la maison </a>
            <a class="secondaire-destructif" href="mailto:billy@knowitbetter.fr?subject=Rapport Erreur 404&body=Contact au sujet d'une erreur 404%0D%0A%0D%0AVotre nom :%0D%0APage recherchée:%0D%0A%0D%0AVOTRE MESSAGE ICI:%0D%0A%0D%0A"><i class="fa-solid fa-file-pen text-icon"></i> Nous envoyer un retour </a>
            
        </div>        
    </section>
    <section class="suggestions" style="margin:20px;">
        <h2 class="section-title">Pour nous excuser, nous vous proposons ceci!</h2>
    <div id="videos-container" class="flex-container">

    <?php     
                include "../database.php";
                global $db;
                $dernieres_videos = $db->query('SELECT * FROM videos ORDER BY date_publication DESC LIMIT 1');
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


    </section>
        <?php 
        include '../composants/bas-de-page.php';
        echo $foot_page;
        
        ?></body>
</html>