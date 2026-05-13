<?php 
session_start();
session_destroy();
session_unset();


?>
<?php session_start(); 
// header('Location: https://knowitbetter.fr'.$_SERVER["PHP_SELF"]);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>KnowITbetter - Déconnexion</title>
    <link rel="shortcut icon" href="../images/logo/favicon.ico" type="image/x-icon">

    <!-- robots -->
    <meta name="robots" content="noindex" />

    <!-- CSS -->
    <link rel="stylesheet" href="../css/navigation-bar.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/articles.css">

    <!-- JS -->
    <!-- <script src="./script/implementation-composants.js"></script> -->
    <!-- Kit Fontawesome -->
    <!-- <script src="/script/admin.js"></script> -->
    <script src="https://kit.fontawesome.com/02cace8fd8.js" crossorigin="anonymous"></script>

    <!-- couleur -->
    <meta name="theme-color" content="grey">


</head>
<body id="body">
    <style>
        section#top-page {
        margin:0px;
        /*pour que le fichier css retrouve une image qui n'est pas dans son dossier, il doir revenir au dossier racine . Pour cela, on met ../ devant l'url 
        Pour le CSS, mettre un point virgule à la fin de chaque action/ligne */
        /* background: url('../images/fonds/fondflourougeorange.jpg'); */
        background-color:grey;
        /* définir l'image comme couverture --> elle ne se répetera pas en fonction de la definition de l'écran */
        background-size: cover;
        /* l'unité vh signifie "hauteur de fenêtre" donc "1vh" correspond à 1% de la hauteur de la fenêtre*/
        /* l'unité vw correspond à la "largeur de la fenêtre donc "1vw" correspond à 1% de la largeur de la fenêtre*/
        /* il existe également "vmin" qui est la valeur la plus petite de vh et vw et "vmax" qui est la plus grande d'entre-elles*/
        /* min-height: 80vh; */
    }
    nav#boite-boutons-navigation {
        background-color:grey;
        color:white;
    }
    section#footer-section {
            background-color:#FF6B6B;
    }


  
    </style>
    </script>

        <?php  
        include '../composants/navigation-bar.php';
        echo $navigation_bar_accueil;
        
    ?>
    <div id="alert-message" style='position:fixed;top:>50px;height:100vh;width:100vw;backdrop-filter: blur(10px);-webkit-backdrop-filter: blur(10px);display:none;'></div>
    <h1 class="big-title" style="color:grey;">Vous avez été déconnecté(e)</h1 >

<section class="page-content page-padding"></section>
</body>
</html>
