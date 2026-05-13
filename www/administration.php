<?php session_start(); 
include "composants/verif-auth-user.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>KnowITbetter - Administration</title>
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
    <script src="/script/admin.js"></script>
    <?php include "./composants/fontawesome_kit.php";?>

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
    nav#boite-boutons-navigation-art, #boite-boutons-navigation-droite-art {
        background-color:grey;
        color:white;
    }
    section#footer-section {
            background-color:#FF6B6B;
    }
    input[type="text"],input[type="number"]  {
        text-align:left;
    }
    input#nom {
        border:transparent 3px solid;
        background-color:lightgrey;
        text-align:left;
        font-size:24px;
        font-weight:700;
        
    }
    input#date_publication {
        font-family: monospace;
        text-align: left;
        background: lightgrey;
    }
    input#nom:focus, input#date_publication {
        border-bottom:grey 3px solid;
        
    }
    input#nom:hover, input#date_publication:hover {
        background-color: #dfdfdf ;
    }



    /*suppression d'articles  */
    .article-delete-box, .article-delete-box-legende {
        display:flex;
        flex-wrap:nowrap;
        padding:10px 20px;
        
    }
    .article-delete-box:hover {
        background-color:#dfdfdf;
    }
    .article-delete-box p {
        padding:5px;
    }
    .article-delete-icon {
        color:red;
        padding:6px;

    }
    .article-delete-icon:hover {
        cursor: pointer;
        border-radius: 50%;
        background-color:red;
        color:white;
        padding:6px;
        text-align:center;
    }

  
    </style>
    </script>

        <?php  
        include "database.php";
        global $db;
        include 'composants/login.php';



        include 'composants/navigation-bar.php';
        echo $navigation_bar;
        
    ?>
    <div id="alert-message" style='position:fixed;top:50px;height:100vh;width:100vw;backdrop-filter: blur(10px);-webkit-backdrop-filter: blur(10px);display:none;'></div>
    <h1 class="big-title" style="color:grey;"><i class="fa-solid fa-database text-icon"></i>Administration du site</h1 >

<section class="page-content page-padding">
    <?php
    if (isset($_SESSION["pseudo"]) && isset($_SESSION["email"]) && isset($_SESSION["role"])) {
        // mettre à jour le role si il y a eu des changements
        $verif = $db->prepare("SELECT `role` FROM users WHERE pseudo = :pseudo");
        $verif->execute([
            'pseudo' => $_SESSION["pseudo"]
        ]);
        $result_verif = $verif->fetch();
        // make sure, the user is still an admin, check that admin is in its roles and in its roles in the database
        if (in_array("admin", explode(",", $result_verif["role"])) && in_array("admin", $_SESSION["role"])) {
            // echo "La connexion en tant qu'administrateur est acceptée";?>

<h2 class="section-title">Ajouter un nouvel article</h2>
<?php 
    if (verif_auth_admin() == true) {

?>
<div style="background:lightgrey;border-radius:18px;margin:20px;padding:20px;max-width:800px;margin:auto;">
    <form method="post">
    <input type="text" name="nom" id="nom" placeholder="Nom de l'article" required><br>
    <input type="date" name="date_publication" id="date_publication" placeholder="Date de publication" required><br>
    <input type="text" name="image_bg" id="image_bg" placeholder="chemin d'accès de l'image de fond" required><br>
    <input type="text" name="description" id="description" placeholder="Description courte" required><br>
    <input type="text" name="tags" id="tags" placeholder="Tags séparés par des virgules" required><br>
    <input type="text" name="url" id="url" placeholder="URL de l'article" required><br>
    <input type="number" name="videos" id="videos" placeholder="ID de la video"><br>
    <input type="number" name="auteurs" id="auteurs" placeholder="identifiant de l'auteur" required><br>
    <!-- <input type="checkbox" name="article_statement" id="article_statement" selected><br> -->
    <!-- <input type="checkbox" name="video_statement" id="video_statement" placeholder="L'article est-il accompagné d'une vidéo ?"><br> -->
    <input type="submit" name="formaddarticle" value="Ajouter l'article">

</form>
</div>
<div class="warning-box"><h4 class="warning-title"><i class="fa-solid fa-code text-icon"></i>Debug: Ajout d'articles à la Db</h4><p class="info-text">

<?php 
include "composants/ajouter-article.php";
?>
</p></div>
<?php 
    } else {
        echo "<p><i>Vous n'êtes pas authorisé(e) à effectuer cette action.<br>Si vous pensez qu'il s'agit d'une erreur, déconnectez-vous puis tentez de vous reconnecter.</i></p>";
    }

?>





<h2 class="section-title">Modifier un élément de la Database</h2>
<?php 
    if (verif_auth_admin() == true) {

?>
<p><i>Cette fonction n'est pas encore disponible.</i></p>
<?php 
    } else {
        echo "<p><i>Vous n'êtes pas authorisé(e) à effectuer cette action.<br>Si vous pensez qu'il s'agit d'une erreur, déconnectez-vous puis tentez de vous reconnecter.</i></p>";
    }

?>


<h2 class="section-title">Supprimer un article de la Database</h2>
<?php 
    if (verif_auth_admin() == true) {

?>
<div class="warning-box"><h4 class="warning-title"><i class="fa-solid fa-code text-icon"></i>Debug: Suppression d'articles de la Db</h4><p class="info-text">
<?php include "composants/supprimer-article.php";?>
</p></div>
<div style="background:lightgrey;border-radius:18px;margin:20px;padding:20px 0;max-width:800px;margin:auto;">
<?php 
        $articles = $db->query("SELECT id,nom,date_publication,auteurs FROM articles");
        $auteurs = $db->query("SELECT id,pseudo FROM auteurs");
        $auteurs = $auteurs->fetchAll();
        $nb_articles = 0;
        echo "<div class='article-delete-box-legende' style='color:grey;font-weight:700;font-size:12px;'><p class='article-delete-id'style='flex:1'>ID</p><p class='article-delete-nom' style='flex:10'>NOM</p><p class='article-delete-auteur' style='flex:2'>AUTEUR</p><p style='flex:1'>SUPPRIMER</p></div>";
        while ($article = $articles->fetch()) {
            $nb_articles = $nb_articles + 1;
            echo "<div class='article-delete-box'><p class='article-delete-id' style='flex:1'>" . $article["id"] . ".</p><p class='article-delete-nom' style='flex:10'>". $article["nom"] . "</p><p class='article-delete-auteur'style='flex:2'>" . $auteurs[(int) $article["auteurs"]-1]["pseudo"] . "</p><p style='flex:1'><i onclick=\"supprimer_article(". $article["id"] . ",'". addslashes($article["nom"]) . "');\" class='fa-solid fa-trash-can text-icon article-delete-icon'></i></p></div>";
        }
        if ($nb_articles == 0) {
            echo "<p style='text-align:center'>Aucun article n'est enregistré dans la base de données...</p>";
        }
    } else {
        echo "<p><i>Vous n'êtes pas authorisé(e) à effectuer cette action.<br>Si vous pensez qu'il s'agit d'une erreur, déconnectez-vous puis tentez de vous reconnecter.</i></p>";
    }
    
    
?>

</div>


<!-- formulaire invisible publié via le javascript pour suprimer un article -->
<form name="form_suppression" method="post" style="display:none;">
    <input type="number" name="id_article_suppr" id="id_suppr" value="">
    <input type="submit" value="form_suppr_article" name="form_suppr_article">
</form>





<?php
        } else {
            echo "Vous n'avez pas les droits nécessaires pour accéder à cette page. Vous avez été déconnecté(e)";
            session_destroy();
        }


        ?>
        <h3 class="soussection-title">Informations de session</h3>
        <p>Votre pseudo : <?= $_SESSION["pseudo"]; ?></p>
        <p>Votre email : <?= $_SESSION["email"]; ?></p>
        <p>Votre rôles : <?= var_dump($_SESSION["role"]); ?></p>
        <p>Votre Identifiant : <?= $_SESSION["id"]; ?></p>
        <a href="/composants/logout.php" class="red-button lien-sans-style">Vous déconnecter<i class="fa-solid fa-arrow-right-from-bracket text-icon"></i></a>

    <?php
    }
    else {
        echo "Veuillez vous connecter à votre compte";
        ?>
            <h2>Se connecter</h2>
    <form method="post">
        <input type="text" name="lpseudo" id="lpseudo" placeholder="Choisissez un pseudo" required>
        <input type="password" name="lpassword" id="lpassword" placeholder="Mot de passe" required><br>
        <input type="submit" name="formlogin" value="Se connecter">
    </form>
<?php
    }

    ?>

</section>



</body>
</html>
