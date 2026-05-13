<?php 
    session_start();
    include "../database.php";
    global $db;

    $article = $db->query('SELECT * FROM articles WHERE id = 3');
    $article = $article->fetch();

    $auteur = $db->query('SELECT * FROM auteurs WHERE id = '. $article['auteurs']);
    $auteur = $auteur->fetch();
    
    include "../composants/verif-auth-user.php";
    include "../composants/stats.php";



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "../composants/analytics.php";?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>KnowITbetter - Comment convertir un fichier Word en PDF?</title>
    <link rel="shortcut icon" href="../images/logo/favicon.ico" type="image/x-icon">
    <!-- Details site -->
    <meta name="description" content="Vous souhaitez exporter un fichier Word en fichier PDF ? en Fichier ODT ? Et bien, soyez heureux, cette fonction est intégrée à Microsoft Word !">
    <Meta name=" robots" content="index, follow" />

    <!-- apple -->
    <meta name="format-detection" content="telephone=no">
    <meta name="og:title" content="KnowITbetter - Comment convertir un fichier Word en PDF?">
    <meta name="og:image" content="..\article\images\convertir-fichier-docx-en-pdf\fond-convertir-fichier-docx-en-pdf.webp">
    <meta name="og:video" content="https://www.youtube.com/embed/_hgnVDI05QU">
    <link rel="apple-touch-icon" href="../images/logo/logocarrehd.webp">


    <!-- CSS -->
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/navigation-bar.css">
    <link defer rel="stylesheet" href="../css/style-apercu-articles.css">
    <link rel="stylesheet" href="../css/articles.css">

    <!-- JS -->
    <script src="../script/fonctionnalites.js"></script>
    <!-- <script src="./script/implementation-composants.js"></script> -->
    <!-- <script src="../data/donnees.js"></script> -->
    <!-- <script src="./script/generation-apercus.js"></script> -->

    <!-- Kit Fontawesome -->
    <?php include "../composants/fontawesome_kit.php";?>
    <!-- google adsense -->
    <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5388627137606435" crossorigin="anonymous"></script> -->

    <!-- apple -->
    <meta name="theme-color" content="#F8B432">


</head>
<body id="body" onscroll="scroll_menu()">



    <style>

        section#top-page {
        /* margin:0px; */
        /* background: url('../article/images/convertir-fichier-docx-en-pdf/fond-convertir-fichier-docx-en-pdf.webp') bottom; */
        /* définir l'image comme couverture --> elle ne se répetera pas en fonction de la definition de l'écran */
        background-size: cover;

        }
        /* couleurs menu de navigation */
        .nav-item {
            color: white;
        }
        #top-logo-texte {
            color: white;
        }


    
    </style>
    <?php  
        include '../composants/navigation-bar.php';
        echo $navigation_bar;
        include "../composants/titre-article.php";

    ?>

    <div id="boite-division-affichage" style="display:flex;flex-direction:row;flex-wrap:nowrap;">
    <div id="article-content" style="flex:1;">

        <div class="introduction-box">
            <p class="amorce">Vous souhaitez exporter un fichier Word en fichier PDF ? en Fichier ODT ? Et bien, soyez heureux, cette fonction est intégrée à Microsoft Word !
            </p>
            
        </div>
        <?php
            include "../composants/bandeau-partage.php";
        ?>
        <div class="video-container">
            <iframe defer loading="lazy" class="video-box-landscape"  src="https://www.youtube.com/embed/_hgnVDI05QU" title="Word : Comment convertir un fichier .docx en .pdf ?" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>


        <!-- sommaire -->
        <div class="sommaire">
            <h2 class="sommaire-title">Sommaire</h2>
            <ul class="sommaire-list">
                <li class="sommaire-item"><a class="sommaire-link" href="#1"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Le point culture: Vous avez dit « PDF » ?</a></li>
                <li class="sommaire-item"><a class="sommaire-link" href="#2"><i class="fa-solid fa-circle-chevron-right text-icon"></i>Convertir un fichier .docx (Word) en .pdf</a></li>


            </ul>
        </div>


        <!-- contenu de l'article -->
        <h2 class="section-title" id="1">Le point culture: Vous avez dit « PDF » ?</h2>
        <p class="article-text">
            <b>PDF</b> , de "Portable Document Format" en anglais (Format de document portable), est un des formats de fichier les plus utilisés. C'est un <b>format multi-plateformes</b> : il est supporté par la quasi majorité des appareils sur le marché aujourd'hui. Il est lisible sur smartphone, ordinateur, tablettes... Contrairement aux fichiers Word, uniquement supportés sur Windows, masOS, iOS et Android par l'intermédiaire des logiciels officiels de Microsoft, vous pouvez envoyer un fichier PDF à n'importe qui sans vous soucier de sa lisibilité. Le destinataire parviendra à l'ouvrir à coup sûr même si l'installation d'un logiciel est parfois nécessaire (exemple : <a class="text-blue-link" href="https://get.adobe.com/fr/reader/?loc=fr">Adobe Reader DC</a>).
            <br><br>
            Les fichiers de ce type portent l'extension "<span class="courier-new">.pdf</span>" . (exemple de nom de fichier : "<span class="courier-new">fichier.pdf</span>") et ne peut pas être modifié sans passer par des logiciels spécialisés
            <br><br>
            Word est le logiciel de traitement de texte le plus utilisé mais il est parfois demandé ou nécessaire de convertir un fichier Word (qui porte l'extension <span class="courier-new">.docx</span>) en fichier PDF. C'est notamment demandé pour les <b>rapports de stage</b>, les <b>comptes-rendus</b>, ou encore toutes les <b>lettres formelles, qui ne doivent plus être modifiées</b>.
        </p>

        <!-- emplacement pour pub -->
        <div class="google-ads-article"></div>


        <h2 class="section-title" id="2">Convertir un fichier .docx (Word) en .pdf</h2>
        <p class="article-text">Il est possible d'exporter un fichier Word en fichier pdf directement dans le logiciel Word! Voici la démarche à suivre pour y parvenir:</p>
        <br>
        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                Ouvrez le fichier Word que vous souhaitez convertir.</p>
            </div>
            <figure>
                <img loading="lazy" src="../article/images/convertir-fichier-docx-en-pdf/1.webp" alt="">
                <figcaption>Capture d'écran de Word, source: KnowITbetter
                </figcaption>
            </figure>
        </div>
        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                Allez dans "Fichier" , dans la barre en haut à gauche
                </p>
            </div>
            <figure>
                <img loading="lazy" src="../article/images/convertir-fichier-docx-en-pdf/2.webp" alt="">
                <figcaption>Capture d'écran de Word, source: KnowITbetter
                </figcaption>
            </figure>
        </div>
        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                Ensuite, cliquez sur "Exporter"
                </p>
            </div>
            <figure>
                <img loading="lazy" src="../article/images/convertir-fichier-docx-en-pdf/3.webp" alt="">
                <figcaption>Capture d'écran de Word, source: KnowITbetter
                </figcaption>
            </figure>
        </div>
        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                Appuyez alors sur le bouton "Créer un PDF/XPS"
                </p>
            </div>
            <figure>
                <img loading="lazy" src="../article/images/convertir-fichier-docx-en-pdf/4.webp" alt="">
                <figcaption>Capture d'écran de Word, source: KnowITbetter
                </figcaption>
            </figure>
        </div>
        <div class="flex-container flex-lefttext-rightimg">
            <div>
                <p class="article-text">
                Une fenêtre de l'explorateur de fichiers s'ouvre alors. Vous devez choisir l'emplacement dans lequel vous voulez sauvegarder votre nouveau fichier PDF et enfin, cliquer sur "publier", pour enregistrer le nouveau fichier.
                </p>
            </div>
            <figure>
                <img loading="lazy" src="../article/images/convertir-fichier-docx-en-pdf/5.webp" alt="">
                <figcaption>Capture d'écran de Word, source: KnowITbetter
                </figcaption>
            </figure>
        </div>
        <p class="article-text">Vous pouvez maintenant partager une version PDF de votre fichier Word !</p>



        
        
        <div class="article-signature">
            <p class="article-signature-text">Publié le 12 Février 2021 par <a style="color:darkblue" class="normal-link" href="../membres?id=1"><?php echo $auteur["pseudo"];?> - de KnowITbetter</a></p>
        </div>
        <h2 class="section-title">Ils ont rédigé cet article</h2>
        <?php 
            $code_auteur = "";
            $code_auteur = $code_auteur . '<div onclick=\'document.location="../membres?id=1"\' class="lien-sans-style auteur-box flex-container">';
            $code_auteur = $code_auteur . '<div class="auteur-photo-box">';
            $code_auteur = $code_auteur . '<img loading="lazy" src="' . $auteur['photo'] . '" alt="photo de profil de ' . $auteur['pseudo']. '" class="auteur-photo">';
            $code_auteur = $code_auteur . '</div><div class="auteur-description-box">';
            $code_auteur = $code_auteur . '<p class="auteur-nom">' . $auteur["pseudo"] .' - de KnowITbetter</p>';
            $code_auteur = $code_auteur . '<P class="auteur-date">Depuis le ' . dateToFrench($auteur["date_inscription"],'j F Y') . '</p>';
            $code_auteur = $code_auteur . '<p class="auteur-devise"><span style="font-size:150%">&laquo;</span>' . $auteur['presentation'] . '<span style="font-size:150%">&raquo;</span></p>';
            $code_auteur = $code_auteur . '</div></div>';
            echo $code_auteur;
        
        ?>

<h2 class="section-title">Dans le même thème</h2>
        <div id="articles-container" class="flex-container">

        <?php 
            $articles_en_lien = $db->query('SELECT * FROM articles WHERE (tags LIKE "%' . $tags[0] . '%" OR tags LIKE "%' . $tags[1] . '%" OR tags LIKE "%' . $tags[2] . '%" OR tags LIKE "%' . $tags[4] . '%") AND id NOT LIKE '. $article["id"] .' ORDER BY date_publication DESC LIMIT 2');
            include "../composants/apercu-articles.php";
            if ($articles_en_lien) {
                affichage_articles_v2($articles_en_lien);
            }

            

        
        
        
        ?>
        </div>

  
        </div>
        <div id="affichage-bandeau-droite" class="computer-only">

            <!-- articles phares -->
            <div class="articles-container">
            <h2 class="section-title" style="font-size:24px;">A la une</h2>
            <?php 
            $derniers_articles = $db->query('SELECT * FROM articles ORDER BY date_publication DESC LIMIT 4');
            affichage_articles_v2($derniers_articles);

            ?>
            </div>

            <!-- Publicité -->

            <?php include "../composants/pubs.php";?>

            </div>

        </div>
      <?php 
        include '../composants/bas-de-page.php';
        echo $foot_page;
        
        ?>


</body>
