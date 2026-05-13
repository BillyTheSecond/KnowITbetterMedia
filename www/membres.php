<!DOCTYPE html>
<html lang="fr">
    <?php 
        include './database.php';
        $membre_id = $_GET["id"];
        // resoudre le probleme des identifiants étant des lettres (n'existant pas)
        if ((int) $membre_id != 0) { //si l'id est une lettre, alors (int) $id renvoie 0  --> attribuer false à $membres et ne pas effectuer la requete (sinon erreur fatale)
        $membres = $db->query('SELECT * FROM auteurs WHERE id = '.$membre_id);
        $membre = $membres->fetch();
        } else {
            $membre = false;
        }

    ?>
<head>
    <?php include "composants/analytics.php";?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <?php if ($membre){
        echo '<title>KnowITbetter - ' . $membre["pseudo"] . '</title> ' ;
    } else {
        echo '<title>KnowITbetter - Membre introuvable...</title> ' ;
    }
        ?>
    <link rel="shortcut icon" href="../images/logo/favicon.ico" type="image/x-icon">
    <!-- Details site -->
    <?php if ($membre) {
        echo '<meta name="description" content="'. $membre["presentation"] .'">';
     } else {
        echo '<meta name="description" content="Nous n\'avons pas trouvé ce membre...">';
     } ?>
    <meta name=" robots" content="index, follow" />

    <!-- apple -->
    <?php echo '<meta name="og:title" content="KnowITbetter - ' . $membre["pseudo"] . '"> ' ;?>
    <?php echo '<meta name="og:image" content="' . $membre["photo"] .'">';?>
    <link rel="apple-touch-icon" href="../images/logo/logocarrehd.webp">


    <!-- CSS -->
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/navigation-bar.css">
    <link rel="stylesheet" href="../css/style-apercu-articles.css">

    <!-- JS -->
    <script src="../script/fonctionnalites.js"></script>

    <!-- Kit Fontawesome -->
    <?php include "./composants/fontawesome_kit.php";?>
    <!-- google adsense -->
    <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5388627137606435" crossorigin="anonymous"></script> -->

    <!-- apple -->
    <!-- <meta name="theme-color" content="#3b5998"> -->


</head>
<body id="body" onscroll="scroll_menu()">
    <style>
        /* menu de navigation */
        nav#boite-boutons-navigation-art, #boite-boutons-navigation-droite-art {
        background-color:#3b5998;
        color:white;
    }


        #membre-description {
            display: flex;
            align-items:center;
        }
        #top-page, section#footer-section {
            background-color: #3b5998;
        }
        #top-page {
            padding-top:40px;
        }
        p.membre-role {
            text-transform: uppercase;
            color: #dbe2f0;
            text-align: center;
        }
        #membre-description {
            margin-top:20px;
        }
        .membre-description-presentation {
            flex:1;
        }
        .membre-description-photo {
            margin-right:40px;
        }
        .membre-description-photo img {
            max-width: 250px;
            border-radius: 50%;
            margin:5px;
            background-color:white;

        }

        .membre-date {
            font-family: 'Lato';
            font-weight: 300;
            padding-bottom: 5px;
            font-size: 18px;
        }
        .membre-presentation {
            font-weight: 400;
            line-height: 1.31em;
            font-size:18px;
            font-style: italic;
            color: #3b5998;
        }

        .membre-liens-box {
            display:flex;
            height:30px;
            align-content:center;
            padding:10px 0
        }
        .lien-icon {
            font-size:18px;
            color: lightgrey;
            padding: 10px unset;
            padding-left:0px;
            padding-right:20px;
        }
        .lien-icon:hover {
            color: grey;
        }
        .tags-container {
            display: none;
        }

        @media (max-width:750px) {
            #membre-description {
                flex-direction: column;
            }
            .membre-description-photo img {
                max-width: min(200px,80vw);
            }
            .membre-description-photo {
                margin: 5px;
                flex:1;
                text-align: center;
            }
            .membre-date, .membre-presentation {
                text-align: center;
            }
            .membre-liens-box {
                justify-content: center; /*pour les mobiles seulement*/
            }
            .lien-icon{
                padding: 10px;
            }

        }
        
    </style>
    <?php 
        include './composants/navigation-bar.php';
        echo $navigation_bar;
        

    ?>
    <section id="top-page" class="iphone-padding">
        <div class="landing-page">
            <h1 class="big-title" style="color:#dbe2f0;text-shadow: #000000bd 0px 0px 20px;padding-bottom:5px;"><?php 
                        if ($membre) {
                            echo $membre["pseudo"]. ' - de KnowITbetter';
                        } else {
                            echo 'Nous ne parvenons pas à identifier cette personne...';
                        } ?></h1 >
            <p class="membre-role" style="padding-bottom:50px;"><?php 
            if ($membre) {
                echo $membre["role"]; 
            } ?></p>
        </div>
        

    </section>
    <section id="page-content" class="page-padding" style="min-height:60vh;">
        <div id="membre-description" class="flex-container">
            <div class="membre-description-photo">
                <?php if ($membre) {
                    echo '<img src="' .$membre["photo"] .'" alt="photo de profil de '. $membre["pseudo"].'" loading="lazy">'; 
                } ?>
            </div>
            <div class="membre-description-presentation">
                <?php if ($membre) {
                    echo '<p class="membre-date">Depuis le '. dateToFrench($membre["date_inscription"],"j F Y") .'</p>';
                } ?>
                <?php if ($membre) {

                 echo '<p class="membre-presentation">&laquo;'. $membre["presentation"]. '&raquo;</p>';
                } ?>
                <div class="membre-liens-box">
                    <?php if ($membre["linkedin"]) {
                        echo '<a href="'. $membre["linkedin"] . '" target="_blank" title="Voir le profil Linkedin" class="lien-icon" ><i class="fa-brands fa-linkedin text-icon"></i></a>';
                    } ?>
                    <?php if ($membre["discord"]) {
                        echo '<a href="'. $membre["discord"] . '" target="_blank" title="Accéder au profil Discord" class="lien-icon"><i class="fa-brands fa-discord text-icon"></i></a>';
                    } ?>
                    <?php if ($membre["site_web"]) {
                        echo '<a href="'. $membre["site_web"] . '" target="_blank" title="Ouvrir le site web personnel" class="lien-icon"><i class="fa-solid fa-globe text-icon"></i></a>';
                    } ?>
                    <?php if ($membre["email"]) {
                        echo '<a href="mailto:'. $membre["email"] . '" title="Envoyer un mail" class="lien-icon"><i class="fa-solid fa-envelope text-icon"></i></a>';
                    } ?>
                    <?php if ($membre["twitter"]) {
                        echo '<a href="'. $membre["twitter"] . '" target="_blank" title="Suivre sur Instagram" class="lien-icon"><i class="fa-brands fa-twitter text-icon"></i></a>';
                    } ?>
                    <?php if ($membre["instagram"]) {
                        echo '<a href="'. $membre["instagram"] . '" target="_blank" title="Suivre sur Instagram" class="lien-icon"><i class="fa-brands fa-instagram text-icon"></i></a>';
                    } ?>
                    <?php if ($membre["facebook"]) {
                        echo '<a href="'. $membre["facebook"] . '" target="_blank" title="Voir le compte Facebook" class="lien-icon"><i class="fa-brands fa-facebook text-icon"></i></a>';
                    } ?>
                </div>
            </div>
        </div>
        <?php if ($membre) {
            echo '<h2 class="section-title">Les contributions de '. $membre["pseudo"]. '</h2>';
        } ?>

        <div class="video-container" style="align-items:stretch;display:flex;flex-direction:row;flex-wrap:wrap;justify-content:center;">
        <?php    
        // echo mysqli_num_rows($membres);
            if ($membre) {
                $articles = $db->query('SELECT * FROM articles');
            
                $derniers_articles = $db->query('SELECT * FROM articles WHERE auteurs = '. $membre_id .' ORDER BY date_publication DESC LIMIT 50');
                $nb_total_articles = $db->query('SELECT MAX(id) FROM articles');
                $nb_total_articles = $nb_total_articles->fetchColumn();
                $q_indices_articles_recents = $db->query('SELECT id FROM articles ORDER BY date_publication DESC LIMIT 1');
                $indices_articles_recents = array(); //instancier le tableau contenant les index des videos recentes
                while ($ligne = $q_indices_articles_recents->fetch()) { //a chaque tour de boucle, $ligne prend pour valuer toutes les lignes de $q_indices_videos_recentes
                    array_push($indices_articles_recents,$ligne); //ajoute la 'indice au tableau

                }  

                if ($derniers_articles) {
                    
                    include "./composants/apercu-articles.php";
                    affichage_articles_v2($derniers_articles);
         
                    // while ($article = $derniers_articles->fetch()) {
                    //     $code_article = "";
                    //     $code_article = $code_article. '<a class="article-box flex-container lien-sans-style"  href="'. $article["url"].'" style="max-width: min(90vw,350px);">';
                    //     $code_article = $code_article. '<img class="article-miniature" src="'. $article["image_bg"].'" alt="'.$article["nom"].'" style="">';
                    //     if ($article['id'] == $indices_articles_recents[0]['id'] || $article['id'] == $indices_articles_recents[1]['id']) {
                    //         $code_article .= '<p class="icone-recent">NEW</p>';
                    //     }
                    //     $code_article = $code_article. '<div class="conteneur-description-article">';
                    //     $code_article = $code_article. '<div class="apercu-article-infos">';
                    //     $code_article = $code_article. '<h3 class="article-title">' . $article["nom"].'</h3>';
                    //     // gestion des tags à rajouter
                    //     // $code_article = $code_article. '<div class="tags-container ">';
                    //     // $tags_article = explode(",",$article["tags"]);
                    //     // $code_article = $code_article . '<p class="tag">' . $tags_article[0] . '</p><p class="tag">'. $tags_article[1] . '</p><p class="tag">'. $tags_article[2] . '</p>';
                    //     // $code_article = $code_article. '</div>';
    
    
                    //     // $code_article = $code_article.'<p class="accroche">'.$article["description"].'</p>';
                    //     $code_article = $code_article. '</div>';
                    //     // Affichage date
                    //     $date_article = date_create($article['date_publication']);
                    //     if (date_format($date_article,"Y") == date('Y')){
                    //         $date_article = date_format($date_article, 'j F');
                    //         $code_article = $code_article . '<p class="date-article computer-only">'. dateToFrench($date_article, 'j F').'</p>';
    
                    //     } else {
                    //         $date_article = date_format($date_article, 'j F Y');
                    //         $code_article = $code_article . '<p class="date-article computer-only">'. dateToFrench($date_article, 'j F Y').'</p>';
    
                    //     }
    
    
                    //     $code_article = $code_article. '</div></a>';
                    //     echo $code_article;
                    // }
    
                } else {
                    echo '<p>Aucun article n\'a été publié par '. $membre["pseudo"] .'</p>';
                }
            } else {
                echo '<p style="font-size:120px;text-align:center;color:#3b5998;margin-top:50px;"><i class="fa-solid fa-ghost text-icon"></i></p>';
            }
            ?>

        </div>
    </section>
<div class="iphone-padding">
        <?php 
            include "./composants/bas-de-page.php";
            echo $foot_page;
        ?>    
</div>






</body>
</html>