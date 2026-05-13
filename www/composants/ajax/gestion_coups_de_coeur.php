<?php
// $cookie_lifetime = 7*24*60*60; // 7 jours minutes en secondes
// session_set_cookie_params($cookie_lifetime);

if (session_status() == PHP_SESSION_NONE) {
    // Si aucune session n'est démarrée, alors démarrer une nouvelle session
    session_start();
}

// Récupération des données du formulaire
extract($_POST);
// var_dump($_POST);
// echo "OK1";
// Si la case à cocher "montrer_mail" a été cochée, on peut faire quelque chose de plus
// si la base de données n'est pas connectée alors on la connecte
if (!isset($db)) {
    include $_SERVER['DOCUMENT_ROOT'] . '/database.php';
}
if (!function_exists("get_status")) {
    include $_SERVER['DOCUMENT_ROOT'] . '/composants/get_status.php';
}
if (!function_exists("verif_auth_user")) {
    include $_SERVER['DOCUMENT_ROOT'] . '/composants/verif-auth-user.php';
}


global $db;

// renvoie les coups de coeur sous forme de tableau
function obtenir_coups_de_coeur()
{
    global $db;
    // echo $_SESSION["id"];
    $articles_aimes = $db->query("SELECT loved_articles FROM users WHERE id = " . $_SESSION["id"]);
    // echo "requete effectuee";
    $articles_aimes = $articles_aimes->fetch();
    // echo "fetch effectué";
    $articles_aimes = array_filter(explode(",", $articles_aimes["loved_articles"]));
    return $articles_aimes;
}



function is_article_loved($id)
{
    $articles_aimes = obtenir_coups_de_coeur();
    if (in_array($id, $articles_aimes)) {
        return true;
    } else {
        return false;
    }
}

// ajouter sans vérifier s'il est déjà présent ou non
function ajouter_aux_coups_de_coeur($id)
{
    $loved_articles = obtenir_coups_de_coeur();
    // nb max de coups de coeur atteint?
    if (count(obtenir_coups_de_coeur()) < 2000) {
        // ajouter l'article aux articles aimés
        array_push($loved_articles, $id);
        global $db;
        $edit = $db->prepare("UPDATE users SET loved_articles= :loved_articles WHERE id=" . $_SESSION['id']);
        $edit->bindValue(":loved_articles", implode(",", $loved_articles));

        if ($edit->execute() === false) {
            return false;
        } else {
            return true;
        }
    } else {
        echo "error,Le nombre maximal de coups de coeurs (2000) a été atteint.";
        return false;
    }
}

// supprimer un articlesans vérifier s'il est présent ou non
function supprimer_des_coups_de_coeur($id)
{
    $loved_articles = obtenir_coups_de_coeur();
    // supprimer l'article des articles aimés
    $index = array_search($id, $loved_articles);
    if ($index !== false) {
        unset($loved_articles[$index]);
    }

    global $db;
    $edit = $db->prepare("UPDATE users SET loved_articles= :loved_articles WHERE id=" . $_SESSION['id']);
    $edit->bindValue(":loved_articles", implode(",", $loved_articles));

    if ($edit->execute() === false) {
        return false;
    } else {
        return true;
    }
}








// var_dump($_SESSION);
// echo $_SESSION["id"];


// ajouter un article aux coups de coeur
if (isset($_POST["id_article_aime"])) {
    if (get_status("coups-de-coeur") != 1) {
        if (verif_auth_user()) {
            // user autorisé
            extract($_POST);
            if (!is_article_loved($id_article_aime)) {
                // echo "article non aimé";
                if (ajouter_aux_coups_de_coeur($id_article_aime)) {
                    echo "success,ajout," . $id_article_aime;
                }
            } else {
                // supprimer l'article des coups de coeur
                if (supprimer_des_coups_de_coeur($id_article_aime)) {
                    echo "success,suppression," . $id_article_aime;
                }
            }
        } else {
            echo "error,Votre session a expiré";
        }
    } else {
        echo "error,Cette fonctionnalité n'est pas disponible pour le moment, réessayez plus tard.";
    }
}
