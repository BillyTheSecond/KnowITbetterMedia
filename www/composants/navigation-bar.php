<?php
$navigation_bar_accueil = '<nav id="boite-boutons-navigation">
<p id="top-left-logo-texte" class="computer-only">KnowITbetter</p>

<div id="boite-boutons-navigation-droite">
    <li class="nav-item "><a class="nav-item accueil-button nav-button lien-sans-style"  href="/"><img id="top-logo-rond"  style="box-shadow:none" src="../images/logo/logorondhd.webp" alt="Logo du site"><p class="computer-only" style="font-family:inherit">Accueil</p></a></li>
    <li class="nav-item "><a class="nav-item articles-button nav-button lien-sans-style"  href="/articles">Articles</a></li>
    <li class="nav-item" ><a class="nav-item videos-button nav-button lien-sans-style" href="/videos">Vidéos</a></li>
    <li class="nav-item"><a class="nav-item recherche-button nav-button lien-sans-style" href="/recherche"><i class="fa-solid fa-magnifying-glass text-icon"></i></a></li> 
    <li class="nav-item"><a class="nav-item compte-button nav-button lien-sans-style" href="/account"><i class="fa-solid fa-user text-icon"></i></a></li>
</div>

</nav>  ';



$navigation_bar = '<nav id="boite-boutons-navigation-art">
<p id="hamburger-button" class="mobile-menu-nav-button mobile-only" onclick="open_close_menu();"><i class="fa-solid fa-bars text-icon"></i></p>
<a id="top-left-logo-texte-art" class="lien-sans-style" href="../">KnowITbetter</a>
<div id="boite-boutons-navigation-droite-art" class="closed">
    <li class="nav-item "><a class="nav-item articles-button nav-button lien-sans-style"  href="/articles">Articles</a></li>
    <li class="nav-item" ><a class="nav-item videos-button nav-button lien-sans-style" href="/videos">Vidéos</a></li>
    <li class="nav-item computer-only"><a class="nav-item recherche-button nav-button lien-sans-style" href="/recherche"><i class="fa-solid fa-magnifying-glass text-icon"></i>Rechercher</a></li>
    <li class="nav-item"><a class="nav-item compte-button nav-button lien-sans-style" href="../account"><i class="fa-solid fa-user text-icon"></i>Mon Profil</a></li>

</div>  
<a class="mobile-menu-nav-button recherche-button lien-sans-style mobile-only" href="../recherche"><i class="fa-solid fa-magnifying-glass text-icon"></i></a>

</nav>  
<script>
// menu hamburger
        is_open = false;
        menu = document.getElementById("boite-boutons-navigation-droite-art");
        function open_close_menu() {
            if (is_open) {
                menu.classList.add("closed");
                menu.classList.remove("open")
                document.getElementById("hamburger-button").innerHTML = "<i class=\'fa-solid fa-bars text-icon\'></i>"
                is_open = false;

            } else {
                menu.classList.add("open");
                menu.classList.remove("closed");
                document.getElementById("hamburger-button").innerHTML = "<i class=\'fa-solid fa-xmark text-icon\'></i>"

                is_open = true;


            }
        }

</script>
'
?>