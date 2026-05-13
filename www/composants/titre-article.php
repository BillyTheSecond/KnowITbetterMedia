<?php
echo '
<section id="top-page" class="iphone-padding">
<div class="landing-page">

    <div id="color-band-computer" class="computer-only"></div>
    <div>
    <h1 class="big-title">';
    echo $article["nom"];
    echo '</h1>';


    $code_tags = "";
    $code_tags = $code_tags. '<div class="tags-container ">';
    $tags = explode(",",$article["tags"]);
    $code_tags = $code_tags . '<a class="tag lien-sans-style" href="../recherche?tag=' . $tags[0] .'"><i class="fa-solid fa-hashtag text-icon"></i>' . $tags[0] . '</a><a class="tag lien-sans-style" href="../recherche?tag=' . $tags[1] .'"><i class="fa-solid fa-hashtag text-icon"></i>'. $tags[1] . '</a><a class="tag lien-sans-style"href="../recherche?tag=' . $tags[2] .'"><i class="fa-solid fa-hashtag text-icon"></i>'. $tags[2] . '</a>';
    $code_tags = $code_tags. '</div>';
    echo $code_tags;

echo '</div>
<div id="color-band-mobile" class="mobile-only"></div></div>
</section>';

?>