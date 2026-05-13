<?php
include "database.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include "composants/analytics.php"; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>KnowITbetter - Liens rapides</title>
    <link rel="shortcut icon" href="./images/logo/favicon.ico" type="image/x-icon">
    <!-- Details site -->
    <meta name="description" content="KnowITbetter est là pour aider à comprendre les dernières tendances en matière de technologies. Que l'on soit débutant ou utilisateur expérimenté, les articles et vidéos disponibles permettent de tirer le meilleur parti de son matériel et de ses logiciels. ">
    <Meta name=" robots" content="noindex, nofollow" />
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
    <?php include "./composants/fontawesome_kit.php"; ?>
    <!-- google adsense -->
    <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5388627137606435" crossorigin="anonymous"></script> -->

    <!-- apple -->
    <meta name="theme-color" content="#F8B432">

</head>

<body>
    <?php
    include './composants/navigation-bar.php';
    echo $navigation_bar;

    ?>
    <div id="page-content">
    <h1>Liens rapides</h1>

    </div>

</body>