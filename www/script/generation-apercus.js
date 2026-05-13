

// Génération des aperçus
function apercu_video(obj_article_complet){
    // var videos = document.getElementById("section-meilleures-videos");
    var apercu = "";
    nb_total_articles = articles.length;
    article = obj_article_complet;
    for (var j = 0; j < article["videos"].length; j++) {
        apercu += '<div class="video-box flex-container" onclick="location.href=\''+article["videos"][j]["url"]+'\'">';
        apercu += '<img class="video-miniature" src="'+article["videos"][j]["miniature"]+'" alt="'+article["videos"][j]["nom"]+'">';
        apercu += '<div class="conteneur-description-video" >';
        apercu += '<div class="apercu-video-infos">';
        apercu += '<h3 class="video-title">  '+article["videos"][j]["nom"]+'</h3>';
        // ajouter les 3 premiers tags
        tags = '<div class="tags-container flex-section">';
        for (var k = 0; k < 3; k++) {
            tags += '<p class="tag"> '+article["tags"][k] +'</p>';
            if (k < 2) {
                tags += '<span>&ensp;|&ensp;</span>';
            }
        }
        tags += '</div>';
        apercu += tags;
        apercu += '<p class="accroche computer-only" >'+article["videos"][j]["description"]+'</p>';
        apercu += '</div>';
        apercu += '<div class="icones-container">';
        if (article["video_statement"] == true) {
            apercu += '<div class="icone-video"><i class="fa-solid fa-play"></i></div>';
        }
        // if (article["article_statement"] == true) {
        //     apercu += '<div class="icone-article" onclick="location.href=\"'+ article["url"] +'\"" ><i class="fa-solid fa-newspaper"></i></div>';
        // }
        if (nb_total_articles - article["id"] <= 2){
            apercu += '<div class="icone-recent"></div>';
        }
        apercu += '</div>';
        // apercu += '<p>'+article["videos"][j]["duree"]+'</p>';
        // apercu += '<p>'+article["videos"][j]["date"]+'</p>';
        apercu += '</div></div>';
    }
    // videos.innerHTML += apercu;
    return apercu
}

// generation des aperus pour les articles
function apercu_article(obj_article_complet){
    var zone = document.getElementById("section-meilleurs-articles");
    var apercu = "";
    nb_total_articles = articles.length;
    article = obj_article_complet;
    apercu += '<div class="article-box flex-container"  onclick="location.href=\''+article["url"]+'\'">';
    apercu += '<img class="article-miniature" src="'+article["image"]+'" alt="'+article["nom"]+'">';
    apercu += '<div class="conteneur-description-video">';
    apercu += '<div class="apercu-video-infos">';
    apercu += '<h3 class="video-title">  '+article["nom"]+'</h3>';
    // ajouter les 3 premiers tags
    tags = '<div class="tags-container flex-section">';
    for (var k = 0; k < 3; k++) {
        tags += '<p class="tag"> '+article["tags"][k];
        if (k < 2) {
            tags += '&ensp;|&ensp;</p>';
        } else {
            tags += '</p>';
        }
    }
    tags += '</div>';
    apercu += tags;
    apercu += '<p class="accroche" >'+article["description"]+'</p>';
    apercu += '</div>';
    apercu += '<div class="icones-container">';
    // if (article["video_statement"] == true) {
    //     apercu += '<div class="icone-video"><i class="fa-solid fa-play"></i></div>';
    // }
    if (article["article_statement"] == true) {
        apercu += '<div class="icone-article" onclick="location.href=\"'+ article["url"] +'\"" ><i class="fa-solid fa-newspaper"></i></div>';
    }
    if (nb_total_articles - article["id"] < 2){
        apercu += '<div class="icone-recent"></div>';
    }
    apercu += '</div>';
    // apercu += '<p>'+article["videos"][j]["duree"]+'</p>';
    // apercu += '<p>'+article["videos"][j]["date"]+'</p>';
    apercu += '</div></div>';
    // zone.innerHTML += apercu;
    return apercu
}





function generation_page_accueil(){
    nb_articles = 0;
    id_articles = [];
    nb_videos = 0;
    id_videos = [];
    // on parcourt tous les articles
    for (var i = 0; i < articles.length; i++) {
        // on regarde si l'element contient un article
        if (articles[i]["article_statement"] == true) {
            // on ajoute 1 au nombre d'articles
            nb_articles += 1;
            // on ajoute l'id de l'article dans un tableau
            id_articles.push(articles[i]["id"]);
        }
        // on regarde si l'element contient une video
        if (articles[i]["video_statement"] == true) {
            // on ajoute 1 au nombre de videos
            nb_videos += 1;
            // on ajoute l'id de la video dans un tableau
            id_videos.push(articles[i]["id"]);
        }
    }
    // console.log(nb_articles);
    console.log(id_videos);
    if (nb_videos > 0) {
        code_a_ajouter = ""
        for (var id in id_videos) {
            console.log("id : " + id);
            code_a_ajouter = apercu_video(articles[id_videos[id]]) + code_a_ajouter;
        }
        document.getElementById("videos-container").innerHTML = code_a_ajouter;
    }
    if (nb_articles > 0) {
        code_a_ajouter = ""
        for (var id in id_articles) {
            code_a_ajouter = apercu_article(articles[id_articles[id]]) + code_a_ajouter;
        }
        document.getElementById("articles-container").innerHTML = code_a_ajouter;
    }
}