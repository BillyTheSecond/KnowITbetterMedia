<?php

// Cette fonction n'est plus utilisée, à supprimer dans les porchaines versions
function affichage_articles($liste_articles){
        $count = 0;
        while ($article = $liste_articles->fetch()) {
                    $count = $count+1;
                    $code_article = "";
                    $code_article = $code_article. '<a class="article-box flex-container lien-sans-style"  href="'. $article["url"].'">';
                    $code_article .= '<div style="height:200px;overflow:hidden;">';
                    $code_article = $code_article. '<img class="article-miniature" src="'. $article["image_bg"].'" alt="'.$article["nom"].'" style="display:unset;">';
                    $code_article .= '</div>';
                    if ($article['id'] == $indices_articles_recents[0]['id'] || $article['id'] == $indices_articles_recents[1]['id']) {
                        $code_article .= '<p class="icone-recent">NEW</p>';
                    }
                    $code_article = $code_article. '<div class="conteneur-description-article">';
                    $code_article = $code_article. '<div class="apercu-article-infos">';
                    $code_article = $code_article. '<h3 class="article-title">' . $article["nom"].'</h3>';
                    // gestion des tags à rajouter
                    $code_article = $code_article. '<div class="tags-container ">';
                    $tags_article = explode(",",$article["tags"]);
                    $code_article = $code_article . '<p class="tag">' . $tags_article[0] . '</p><p class="tag">'. $tags_article[1] . '</p><p class="tag">'. $tags_article[2] . '</p>';
                    $code_article = $code_article. '</div>';


                    // $code_article = $code_article.'<p class="accroche">'.$article["description"].'</p>';
                    $code_article = $code_article. '</div>';
                    // Affichage date
                    $date_article = date_create($article['date_publication']);
                    if (date_format($date_article,"Y") == date('Y')){
                        $date_article = date_format($date_article, 'j F');
                        $code_article = $code_article . '<p class="date-article computer-only">'. dateToFrench($date_article, 'j F').'</p>';

                    } else {
                        $date_article = date_format($date_article, 'j F Y');
                        $code_article = $code_article . '<p class="date-article computer-only">'. dateToFrench($date_article, 'j F Y').'</p>';

                    }


                    $code_article = $code_article. '</div></a>';
                    echo $code_article;
        }
        if ($count == 0) {
            echo 'Aucun autre article n\'a été trouvé dans cette catégorie';

        }

    
}

function affichage_articles_v2($liste_articles){
    $count = 0;
    while ($article = $liste_articles->fetch()) {
                $count = $count+1;
                // si l'id de l'article correspond au dernier ou avant dernier publié, ajouter une classe au conteneur pour changer son apparence
                if (isset($indices_articles_recents) && $article['id'] == $indices_articles_recents[0]['id'] || isset($indices_articles_recents) && $article['id'] == $indices_articles_recents[1]['id']) {
                    $article_recent_class = 'recent';
                }
                if ($count == 1 || $count == 5) {
                    $article_recent_class = 'surbrillance';
                } else {
                    $article_recent_class = '';

                }      
                $code_article = "";
                $code_article = $code_article. '<a class="boite-apercu-article lien-sans-style '. $article_recent_class .'"  href="'. addslashes($article["url"]) .'">';
                // image
                $code_article .= '<div class="boite-apercu-article-image" style="background:radial-gradient(127% 127% at 0% 100%, rgba(248, 180, 50, 0.2) 0%, rgba(248, 180, 50, 0) 100%),url(\''. $article["image_bg"].'\');background-position:center;background-size:cover;" alt="'.$article["nom"].'">';
                $code_article .= '</div>';
                // titre de l'article
                $code_article = $code_article. '<div class="boite-apercu-article-titre">';
                $code_article = $code_article. '<p class="apercu-article-titre">' . $article["nom"].'</p>';
                // bande colorée
                $code_article = $code_article. '<div class="apercu-article-bande-coloree '. $article_recent_class .'"></div>';
                $code_article = $code_article. '</div>';


                $code_article = $code_article. '</a>';
                echo $code_article;
    }
    if ($count == 0) {
        echo 'Aucun autre article à afficher pour cette catégorie';

    }


}



?>