<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<?php
// Connexion à la base de données
include "database.php";
// include "composants/verif-auth-user.php";
include "composants/enregistrement-articles.php";
// récupérer les articles
$articles = $db->query('SELECT * FROM articles');
// fonctionnement de isset($_GET['nom']) : si la requête par méthode GET contient un tag nommé "nom"
if (isset($_GET['tag']) && $_GET['tag'] != "" && isset($_GET['search']) == false) {
    $tag = $_GET['tag'];
    $derniers_articles = $db->query('SELECT * FROM articles WHERE tags LIKE "%' . $tag . '%" ORDER BY date_publication DESC LIMIT 50');
    // transformer les resultats de la requete en array (tableau)
    $derniers_articles = $derniers_articles->fetchAll();
} else if (isset($_GET['tag']) && isset($_GET['search']) && $_GET['tag'] != "" && $_GET['search'] != "") {
    $tag = $_GET['tag'];
    $recherche = $_GET['search'];
    $derniers_articles = $db->query('SELECT * FROM articles WHERE tags LIKE "%' . $tag . '%" AND (nom LIKE "%' . $recherche . '%" OR description LIKE "%' . $recherche . '%" OR tags LIKE "%' . $recherche . '%")   ORDER BY date_publication DESC LIMIT 50');
    // transformer les resultats de la requete en array (tableau)
    $derniers_articles = $derniers_articles->fetchAll();
} else if (isset($_GET['search']) && $_GET['search'] != "" && isset($_GET['tag']) == false) {
    $recherche = $_GET['search'];
    $derniers_articles = $db->query('SELECT * FROM articles WHERE nom LIKE "%' . $recherche . '%" OR description LIKE "%' . $recherche . '%" OR tags LIKE "%' . $recherche . '%" ORDER BY date_publication DESC LIMIT 50');
    // transformer les resultats de la requete en array (tableau)
    $derniers_articles = $derniers_articles->fetchAll();
} else {
    $derniers_articles = "";
}




?>
<!-- Retrouvez les dernières astuces et tutoriels pour mieux utiliser vos appareils électroniques. -->
<head>
    <?php include "composants/analytics.php"; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>KnowITbetter - <?php if (isset($_GET["tag"])) {
                                echo "#" . $_GET["tag"];
                            } else {
                                echo 'Recherche';
                            } ?></title>
    <meta name="description" content="<?php if (isset($_GET["tag"])) {
                                echo"Retrouvez tous nos articles concernant - ". $_GET["tag"];
                            } else {
                                echo 'Recherchez une astude parmi tous nos articles';
                            } ?>">
    <link rel="shortcut icon" href="./images/logo/favicon.ico" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/navigation-bar.css">
    <link rel="stylesheet" href="../css/general.css">
    <!-- <link rel="stylesheet" href="../css/style-apercu-articles.css"> -->
    <!-- JS -->
    <!-- <script src="./script/implementation-composants.js"></script> -->
    <!-- Kit Fontawesome -->
    <?php include "composants/fontawesome_kit.php"; ?>

    <meta name="theme-color" content="#F8B432">
    <!-- robots -->
    <meta name="robots" content="noindex, follow">


</head>

<body id="body">
    <style>
        .recherche-button {
            font-weight: 900;
            color: #F8B432;
            background-color: white;
        }

        section#top-page {
            margin: 0px;
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
            background-color: #F8B432;
            color: white;
        }

        #articles-container {
            min-height: 60vh;
        }

        .article-miniature {
            display: unset;
        }

        /* Grands écrans */
        @media (min-width:700px) {
            #articles-container {
                margin: 15px 10vw;
            }



        }
    </style>

    <?php
    include './composants/navigation-bar.php';
    echo $navigation_bar;

    ?>


    <section id="top-page" class="iphone-padding">
        <a href="../" class="lien-sans-style">
            <!-- <p id="top-logo-texte" class="computer-only">KnowITbetter</p> -->
            <!-- <img id="top-logo-texte" class="computer-only" style="box-shadow:none" src="../images/logo/logo-texte-noir.png" alt="Logo du site"> -->

        </a>

        <div class="landing-page">
            <h1 class="big-title" style="color:black;">
                <?php
                // si recherche = tag 
                if (isset($_GET['tag']) && $_GET['tag'] != "" && isset($_GET['search']) == false) {
                    echo '<a class="tag lien-sans-style"><i class="fa-solid fa-hashtag text-icon"></i>' . $tag . '</a>';
                }
                // si recherche = tag + mot clef 
                else if (isset($_GET['tag']) && isset($_GET['search']) && $_GET['tag'] != "" && $_GET['search'] != "") {
                    echo '<p class="tag lien-sans-style" style="margin: 10px;line-height: unset;padding: 5px 10px;display: inline-block;background-color: #e8e8e87a;border-radius: 8px;text-shadow:none;font-size:40px;"><i class="fa-solid fa-hashtag text-icon" style="font-size:40px;"></i>' . $tag . '</p><p class="tag lien-sans-style" style="margin: 10px;line-height: unset;padding: 5px 10px;display: inline-block;background-color: #e8e8e87a;border-radius: 8px;text-shadow:none;font-size:40px;"><i class="fa-solid fa-magnifying-glass text-icon" style="font-size:40px;"></i>' . $recherche . '</p>';
                }
                // si recherche = mot clef
                else if (isset($_GET['search']) && $_GET['search'] != "" && isset($_GET['tag']) == false) {
                    echo '<p class="tag lien-sans-style" style="margin: 10px;line-height: unset;padding: 5px 10px;display: inline-block;background-color: #e8e8e87a;border-radius: 8px;text-shadow:none;font-size:40px;"><i class="fa-solid fa-magnifying-glass text-icon" style="font-size:40px;"></i>' . $recherche . '</p>';
                }
                // si pas de recherche ou recherche vide
                else {
                    echo 'Recherchez une astuce, une video';
                }

                ?>
            </h1>
        </div>


    </section>
    <section class="iphone-padding">
        <div class="boite-recherche" style="position:sticky;top:50px;z-index:2;">
            <form cible="../recherche.php" method="get" style="width:100%;text-align:center;display: flex;align-items: center;flex-wrap: nowrap;justify-content: center;background-color:whitesmoke;">
                <input type="text" name="search" placeholder="Rechercher un article" class="recherche-input" style="flex:1;max-width:600px;min-width:unset;">
                <button type="submit" class=" primaire" style="height:100%"><i class="fa-solid fa-search"></i></button>
            </form>
        </div>
        <div id="articles-container" class="flex-container">


            <?php
            // var_dump($derniers_articles);
            // si nombre de résultats >0                
            if (!isset($derniers_articles) && (isset($_GET['search']) || isset($_GET['search'])) || (isset($derniers_articles) && empty($derniers_articles))) {
                $liste_tags_connus = ["Apple", "Windows", "Android", "Recopie de l'écran", "TV", "iPhone", "Google", "Microsoft", "PC", "Mac", "Shadow", "Photos", "Graphisme", "Sauvegarde"];
                $numeros_aleatoires = [rand(0, 13), rand(0, 13), rand(0, 13)];
                echo '<div class="tags-container" style="flex:unset;justify-content:center;align-items:flex-start;flex-direction:nowrap;"><p class="tag "  onclick="window.location.href=\'https://' . $_SERVER["HTTP_HOST"] . '/recherche?tag=' . urlencode($liste_tags_connus[$numeros_aleatoires[0]]) . '\'" style="cursor:pointer">' . $liste_tags_connus[$numeros_aleatoires[0]] . '</p><p class="tag "  onclick="window.location.href=\'https://'. $_SERVER["HTTP_HOST"].'/recherche?tag=' . urlencode($liste_tags_connus[$numeros_aleatoires[1]]) . '\'" style="cursor:pointer">' . $liste_tags_connus[$numeros_aleatoires[1]] . '</p><p class="tag "  onclick="window.location.href=\'https://'. $_SERVER["HTTP_HOST"].'/recherche?tag=' . urlencode($liste_tags_connus[$numeros_aleatoires[2]]) . '\'" style="cursor:pointer">' . $liste_tags_connus[$numeros_aleatoires[2]] . '</p></div>';
                // echo '<p style="font-size:18px;text-align:center;width:100%"><i class="fa-solid fa-ghost text-icon"></i>Nous n\'avons rien qui correspond à votre recherche...</p>';
            } else {


                // echo "<h3>Voici ce que nous vous avons trouvé</h3>";


                foreach ($derniers_articles as $article) {


                    $code_article = "";
                    $code_article = $code_article . '<a class="article-box flex-container lien-sans-style"  href="' . $article["url"] . '">';
                    // image de l'article
                    $code_article = $code_article . '<div class="article-miniature-box computer-only" style="background-image: url(\'' . $article["image_bg"] . '\');background-size:cover;background-repeat:no-repeat;background-position:center;"></div>';
                    // Icône indiquant que l'article est récent
                    // if ($article['id'] == $indices_articles_recents[0]['id'] || $article['id'] == $indices_articles_recents[1]['id']) {
                    //     $code_article .= '<p class="icone-recent">NEW</p>';
                    // }
                    $code_article = $code_article . '<h3 class="article-title">' . $article["nom"] . '</h3>';
                    // gestion des tags à rajouter
                    $code_article = $code_article . '<div class="tags-container ">';
                    $tags_article = explode(",", $article["tags"]);
                    $code_article = $code_article . '<p class="tag">' . $tags_article[0] . '</p><p class="tag">' . $tags_article[1] . '</p><p class="tag computer-only">' . $tags_article[2] . '</p>';
                    $code_article = $code_article . '</div>';
                    // echo $article["id"];
                    // echo (string) is_article_enregistre((int) $article['id']);
                    if (isset($_SESSION['id']) && isset($_SESSION["pseudo"])) {
                        if (is_article_enregistre((int) $article['id'])) {
                            $code_article = $code_article . '<p class="enregistrer-button"><i class="fa-solid fa-bookmark text-icon enregistrement-icon" style="color:lightgrey;" title="Enregistré"></i></p>';
                        } else {
                            $code_article .= '<p class="enregistrer-button" title="Article non enregistré"></p>';
                        }
                    }



                    // $code_article = $code_article.'<p class="accroche">'.$article["description"].'</p>';
                    // Affichage date
                    // $date_article = date_create($article['date_publication']);
                    // if (date_format($date_article,"Y") == date('Y')){
                    //     $date_article = date_format($date_article, 'j F');
                    //     $code_article = $code_article . '<p class="date-article computer-only">'. dateToFrench($date_article, 'j F').'</p>';

                    // } else {
                    //     $date_article = date_format($date_article, 'j F Y');
                    //     $code_article = $code_article . '<p class="date-article computer-only">'. dateToFrench($date_article, 'j F Y').'</p>';

                    // }


                    $code_article = $code_article . '</a>';
                    echo $code_article;
                }
            }
            ?>
        </div>



    </section>
    <div class="iphone-padding">
        <?php
        include './composants/bas-de-page.php';
        echo $foot_page;

        ?>
    </div>



    <style>
        /* affichage des résultats */
        div#articles-container {
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            /* border-radius:12px; */
            overflow: hidden;


        }

        a.article-box {
            /* flex:1; */
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            align-items: center;
            border-bottom: solid 2px lightgrey;
            padding: 0 30px;
        }

        a.article-box:hover,
        a.article-box:focus {
            background-color: #E5E5E5;
        }

        a.article-box div img {
            min-height: webkit-fill-available;
            min-width: -webkit-fill-available;

        }

        a.article-box div.article-miniature-box {
            flex: 2;
            min-width: 100px;
            justify-content: center;

            margin: 8px;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            height: 60px;


        }

        a.article-box h3.article-title {
            flex: 10;
            font-size: 18px;
            /* font-weight:unset; */
            padding: 8px;
            /* text-decoration:underline; */
        }

        /* tags */
        div.tags-container {
            flex: 5;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: end;
            gap: 8px;
            padding: 8px;
        }

        div.tags-container p.tag {
            font-size: 12px;
            text-transform: uppercase;
            display: block;
            padding: 2px 4px;
            line-height: unset;
            background-color: lightgrey;
            color: grey;
            font-weight: 600;
            text-align: center;
            /* box-shadow: 0px 1px 5px #B5B5B5; */


        }

        p.enregistrer-button {
            flex: 1;
            text-align: center;
            width: 100%;
            min-height: 40px;
            align-content: center;
            align-items: center;
            justify-content: center;
            display: flex;
        }


        @media (max-width:750px) {
            a.article-box h3.article-title {
                font-size: 16px;
            }

            div.tags-container p.tag.computer-only {
                display: none;
            }

            a.article-box div.article-miniature-box {
                /* display:none; */
                height: 60px;
                min-width: unset;
            }

            div.tags-container {
                display: none;
            }

            div#articles-container {
                border-radius: unset;
            }

            a.article-box {
                padding: 20px 10px;
                border: none;
            }

        }
    </style>
</body>

</html>