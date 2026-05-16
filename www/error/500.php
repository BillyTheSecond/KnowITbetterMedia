<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include "../composants/analytics.php";?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>KnowITbetter - Erreur 500</title>
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
            <h1 class="big-title"><i class="fa-solid fa-face-frown-open"></i> 500 - Erreur interne</h1>
            <p style="text-align: center;font-size: 18px;">Un problème à eu lieu de notre côté. Nous en sommes désolés et essayons tout remettre en erdre le plus rapidemment possible.</p>
        </div>
        

    </section>
    <section id="actions-disponibles-404">
        <div class="boutons flex-container" style="justify-content: center;padding-top: 10px;">
            <a class="button lien-sans-style" href="../"><i class="fa-solid fa-house text-icon"></i> Retourner à la maison </a>
            <a class="button lien-sans-style" href="mailto:billy@knowitbetter.fr?subject=Rapport Erreur 404&body=Contact au sujet d'une erreur 404%0D%0A%0D%0AVotre nom :%0D%0APage recherchée:%0D%0A%0D%0AVOTRE MESSAGE ICI:%0D%0A%0D%0A"><i class="fa-solid fa-file-pen text-icon"></i> Nous envoyer un retour </a>
            
        </div>        
    </section>
</body>
</html>