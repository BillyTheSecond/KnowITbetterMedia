<!DOCTYPE html>
<html lang="fr">
<?php
include './database.php';
$user_id = $_GET["id"];
// resoudre le probleme des identifiants étant des lettres (n'existant pas)
if ((int) $user_id != 0) { //si l'id est une lettre, alors (int) $id renvoie 0  --> attribuer false à $users et ne pas effectuer la requete (sinon erreur fatale)
    $users = $db->query('SELECT * FROM users WHERE id = ' . $user_id);
    $user = $users->fetch();
} else {
    $user = false;
}
if ($user && isset($user["profil_partenaire"]) && !empty($user["profil_partenaire"]) && $user["profil_partenaire"] != 0) {
    header("Location: https://" . $_SERVER['HTTP_HOST'] . "/membres?id=" . $user["id"]);
    die();
}

?>

<head>
    <?php include "composants/analytics.php"; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <?php if ($user) {
        echo '<title>KnowITbetter - ' . $user["pseudo"] . '</title> ';
        echo '<meta name="description" content="Page KnowITbetter de ' . $user["pseudo"] . '">';
    } else {
        echo '<title>KnowITbetter - Membre introuvable...</title> ';
    }
    ?>
    <link rel="shortcut icon" href="../images/logo/favicon.ico" type="image/x-icon">
    <!-- Details site -->
    <?php if (isset($user["shared_profile_indexed"]) && $user["shared_profile_indexed"] === 'true') {
        echo '<meta name=" robots" content="index, follow" />';
    } else {
        echo '<meta name=" robots" content="noindex, nofollow" />';
    } ?>


    <!-- apple -->
    <?php echo '<meta name="og:title" content="KnowITbetter - ' . $user["pseudo"] . '"> '; ?>
    <?php
    if (isset($user['photo'])) {
        echo '<meta name="og:image" content="' . $user["photo"] . '">';
    }
    ?>
    <link rel="apple-touch-icon" href="../images/logo/logocarrehd.webp">


    <!-- CSS -->
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/navigation-bar.css">
    <link rel="stylesheet" href="../css/style-apercu-articles.css">

    <!-- JS -->
    <script src="../script/fonctionnalites.js"></script>

    <!-- Kit Fontawesome -->
    <?php include "./composants/fontawesome_kit.php"; ?>
    <!-- google adsense -->
    <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5388627137606435" crossorigin="anonymous"></script> -->

    <!-- apple -->
    <!-- <meta name="theme-color" content="#3b5998"> -->


</head>

<body id="body" onscroll="scroll_menu()">
    <style>
        /* menu de navigation */
        nav#boite-boutons-navigation-art,
        #boite-boutons-navigation-droite-art {
            background-color: #3b5998;
            color: white;
        }


        #user-description {
            display: flex;
            align-items: center;
        }

        #top-page,
        section#footer-section {
            background-color: #3b5998;
        }

        #top-page {
            padding-top: 40px;
        }

        p.user-role {
            text-transform: uppercase;
            color: #dbe2f0;
            text-align: center;
        }

        #user-description {
            margin-top: 20px;
        }

        .user-description-presentation {
            flex: 1;
        }

        .user-description-photo {
            margin-right: 40px;
        }

        .user-description-photo img {
            max-width: 250px;
            border-radius: 50%;
            margin: 5px;
            background-color: white;

        }

        .user-date {
            font-family: 'Lato';
            font-weight: 300;
            padding-bottom: 5px;
            font-size: 18px;
        }

        .user-presentation {
            font-weight: 400;
            line-height: 1.31em;
            font-size: 18px;
            font-style: italic;
            color: #3b5998;
        }

        .user-liens-box {
            display: flex;
            height: 30px;
            align-content: center;
            padding: 10px 0
        }

        .lien-icon {
            font-size: 18px;
            color: lightgrey;
            padding: 10px unset;
            padding-left: 0px;
            padding-right: 20px;
        }

        .lien-icon:hover {
            color: grey;
        }

        .tags-container {
            display: none;
        }

        @media (max-width:750px) {
            #user-description {
                flex-direction: column;
            }

            .user-description-photo img {
                max-width: min(200px, 80vw);
            }

            .user-description-photo {
                margin: 5px;
                flex: 1;
                text-align: center;
            }

            .user-date,
            .user-presentation {
                text-align: center;
            }

            .user-liens-box {
                justify-content: center;
                /*pour les mobiles seulement*/
            }

            .lien-icon {
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
            <h1 class="big-title" style="color:#dbe2f0;text-shadow: #000000bd 0px 0px 20px;padding-bottom:5px;">
                <?php
                if ($user) {
                    echo $user["pseudo"];
                } else {
                    echo 'Nous ne parvenons pas à identifier cette personne...';
                } ?></h1>
            <p class="user-role" style="padding-bottom:50px;">
                <?php
                if ($user) {
                    echo $user["role"];
                } ?></p>
        </div>


    </section>
    <section id="page-content" class="page-padding" style="min-height:60vh;">
        <div id="user-description" class="flex-container">
            <div class="user-description-photo">
                <?php if (!empty($user["photo_profil"])) {
                    echo '<img src="' . $user["photo_profil"] . '" alt="photo de profil de ' . $user["pseudo"] . '" loading="lazy">';
                } ?>
            </div>
            <div class="user-description-presentation">
                <?php if ($user) {
                    echo '<p class="user-date">Depuis le ' . dateToFrench($user["date"], "j F Y") . '</p>';
                } ?>
                <?php if (!empty($user["citation"])) {

                    echo '<p class="user-presentation">&laquo;' . $user["citation"] . '&raquo;</p>';
                } ?>
                <div class="user-liens-box">
                    <?php if (isset($user["linkedin"])) {
                        echo '<a href="' . $user["linkedin"] . '" title="Voir le profil Linkedin" class="lien-icon" ><i class="fa-brands fa-linkedin text-icon"></i></a>';
                    } ?>
                    <?php if (isset($user["discord"])) {
                        echo '<a href="' . $user["discord"] . '" title="Accéder au profil Discord" class="lien-icon"><i class="fa-brands fa-discord text-icon"></i></a>';
                    } ?>
                    <?php if (isset($user["site_web"])) {
                        echo '<a href="' . $user["site_web"] . '" title="Ouvrir le site web personnel" class="lien-icon"><i class="fa-solid fa-globe text-icon"></i></a>';
                    } ?>
                    <?php if (!empty($user["email"]) && $user["montrer_email"] != 0) {
                        echo '<a href="mailto:' . $user["email"] . '" title="Envoyer un mail" class="lien-icon"><i class="fa-solid fa-envelope text-icon"></i></a>';
                    } ?>
                    <?php if (isset($user["twitter"])) {
                        echo '<a href="' . $user["twitter"] . '" title="Suivre sur Instagram" class="lien-icon"><i class="fa-brands fa-twitter text-icon"></i></a>';
                    } ?>
                    <?php if (isset($user["instagram"])) {
                        echo '<a href="' . $user["instagram"] . '" title="Suivre sur Instagram" class="lien-icon"><i class="fa-brands fa-instagram text-icon"></i></a>';
                    } ?>
                    <?php if (isset($user["facebook"])) {
                        echo '<a href="' . $user["facebook"] . '" title="Voir le compte Facebook" class="lien-icon"><i class="fa-brands fa-facebook text-icon"></i></a>';
                    } ?>
                </div>
            </div>
        </div>
        <?php if ($user) {
            echo '<h2 class="section-title">Les contributions de ' . $user["pseudo"] . '</h2>';
        } ?>

        <div class="video-container" style="align-items:stretch;display:flex;flex-direction:row;flex-wrap:wrap;justify-content:center;">
            <?php
            // echo mysqli_num_rows($users);
            if ($user) {
                $articles = $db->query('SELECT * FROM articles');

                $derniers_articles = $db->query('SELECT * FROM articles WHERE auteurs = ' . $user_id . ' ORDER BY date_publication DESC LIMIT 50');
                $nb_total_articles = $db->query('SELECT MAX(id) FROM articles');
                $nb_total_articles = $nb_total_articles->fetchColumn();
                $q_indices_articles_recents = $db->query('SELECT id FROM articles ORDER BY date_publication DESC LIMIT 1');
                $indices_articles_recents = array(); //instancier le tableau contenant les index des videos recentes
                while ($ligne = $q_indices_articles_recents->fetch()) { //a chaque tour de boucle, $ligne prend pour valuer toutes les lignes de $q_indices_videos_recentes
                    array_push($indices_articles_recents, $ligne); //ajoute la 'indice au tableau

                }

                if ($derniers_articles) {

                    include "./composants/apercu-articles.php";
                    affichage_articles_v2($derniers_articles);
                } else {
                    echo '<p>Aucun article n\'a été publié par ' . $user["pseudo"] . '</p>';
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