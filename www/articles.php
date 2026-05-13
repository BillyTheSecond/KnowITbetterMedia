<!DOCTYPE html>
<html lang="fr">
    <?php 

include "database.php";

?>
<head>
    <?php include "composants/analytics.php";?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>KnowITbetter - Articles</title>
    <meta name="description" content="Retrouvez tous les articles de KnowITbetter, le site qui vous aide à mieux comprendre et utiliser les nouvelles technologies">
    <link rel="shortcut icon" href="./images/logo/favicon.ico" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/navigation-bar.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/style-apercu-articles.css">
    <!-- JS -->
    <!-- <script src="./script/implementation-composants.js"></script> -->
    <!-- Kit Fontawesome -->
    <?php include "./composants/fontawesome_kit.php";?>

    <meta name="theme-color" content="#F8B432">

</head>
<body id="body">
    <style>
        .articles-button {
            /* background-color: rgba(255, 255, 255, 0.774); */
            font-weight: 900;
            /* text-decoration: underline ; */
            /* text-decoration-thickness: 3px; */
            color: #F8B432;
            background-color: white;

        }
        section#top-page {
        margin:0px;
        /*pour que le fichier css retrouve une image qui n'est pas dans son dossier, il doir revenir au dossier racine . Pour cela, on met ../ devant l'url 
        Pour le CSS, mettre un point virgule à la fin de chaque action/ligne */
        /* background: url('../images/fonds/fondfloucolore2.jpg'); */
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


    #articles-container{
        padding-top : 10px;
        display: flex;
        flex-direction:column;
        flex-wrap: nowrap;
        align-items:center;
    }
    .article-miniature {
        display:initial;
    }
    .tags-container {
        display: none;
    }

    /* Grands écrans */
    @media (min-width:700px) {
        #articles-container{
            padding: 15px 10vw;
        }



    }
    </style>
        <?php  
        include 'composants/navigation-bar.php';
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
        </nav>    -->
    <section id="top-page" class="iphone-padding">

    <a href="../" class="lien-sans-style iphone-padding">
            <!-- <img id="top-logo-rond" class="mobile-only computer-only" style="box-shadow:none" src="../images/logo/logorondhd.png" alt="Logo du site"> -->
            <!-- <p id="top-logo-texte" class="computer-only" class="">KnowITbetter</p> -->
            <!-- <img id="top-logo-texte" class="computer-only" style="box-shadow:none" src="../images/logo/logo-texte-noir.png" alt="Logo du site"> -->
        
        </a>
    
          
        <div class="landing-page">
            <h1 class="big-title" style="color:black;">Articles</h1 >
            </div>
        

    </section>
    <section class="iphone-padding">
        <div id="articles-container" class="">

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
                $articles = $db->query('SELECT * FROM articles');
            
                $derniers_articles = $db->query('SELECT * FROM articles ORDER BY date_publication DESC LIMIT 50');
                $nb_total_articles = $db->query('SELECT MAX(id) FROM articles');
                $nb_total_articles = $nb_total_articles->fetchColumn();
                $q_indices_articles_recents = $db->query('SELECT id FROM articles ORDER BY date_publication DESC LIMIT 1');
                $indices_articles_recents = array(); //instancier le tableau contenant les index des videos recentes
                while ($ligne = $q_indices_articles_recents->fetch()) { //a chaque tour de boucle, $ligne prend pour valuer toutes les lignes de $q_indices_videos_recentes
                    array_push($indices_articles_recents,$ligne); //ajoute la 'indice au tableau

                }  
         

                include "./composants/apercu-articles.php";
                affichage_articles_v2($derniers_articles);
    
            ?>
        </div>
        <?php 
        include './composants/bas-de-page.php';
        echo $foot_page;
        
        ?>

    </section>
</body>
</html>