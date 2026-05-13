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

// renvoie les enregistrements sous forme de tableau
function obtenir_enregistrements() {
    global $db;
    // echo $_SESSION["id"];
    $articles_enregistres = $db->query("SELECT enregistrements FROM users WHERE id = ".$_SESSION["id"]);
    // echo "requete effectuee";
    $articles_enregistres = $articles_enregistres->fetch();
    // echo "fetch effectué";
    $articles_enregistres = array_filter(explode(",",$articles_enregistres["enregistrements"]));
    return $articles_enregistres;

}



function is_article_enregistre($id) {
    $articles_enregistres = obtenir_enregistrements();
    if (in_array($id, $articles_enregistres)) {
        return true;
    } else {
        return false;
    }

}

// ajouter sans vérifier s'il est déjà présent ou non
function ajouter_aux_enregistrements($id) {
    if (get_status("enregistrement") != 1) {

        $articles_enregistres = obtenir_enregistrements();
        // nb max de enregistrements atteint?
        if (count($articles_enregistres) < 2000) {
            // ajouter l'article aux articles aimés
            array_push($articles_enregistres, $id);
            global $db;
            $edit = $db->prepare("UPDATE users SET enregistrements= :enregistrements WHERE id=". $_SESSION['id']);
            $edit->bindValue(":enregistrements", implode(",",$articles_enregistres));
            
            if ($edit->execute() === false) {
                return false;
            } else {
                return true;
            }
            
        } else {
            echo "error,Le nombre maximal d'enregistrements (2000) a été atteint.";
            return false;
        }
    } else {
        return false;
    }
}

// supprimer un articlesans vérifier s'il est présent ou non
function supprimer_des_enregistrements($id) {
    if (get_status("enregistrement") != 1) {
        $articles_enregistres = obtenir_enregistrements();
        // supprimer l'article des articles aimés
        $index = array_search($id, $articles_enregistres);
        if ($index !== false)  {
            unset($articles_enregistres[$index]);
        }
        
        global $db;
        $edit = $db->prepare("UPDATE users SET enregistrements= :enregistrements WHERE id=". $_SESSION['id']);
        $edit->bindValue(":enregistrements", implode(",",$articles_enregistres));
        
        if ($edit->execute() === false) {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }

        
    
}








// var_dump($_SESSION);
// echo $_SESSION["id"];


// ajouter un article aux enregistrements
if(isset($_POST["id_article_enregistre"])) {
    if (get_status("enregistrement") != 1) {
        if (verif_auth_user()) {
            // user autorisé
            extract($_POST);
            if(!is_article_enregistre($id_article_enregistre)) {
                // echo "article non aimé";
                if(ajouter_aux_enregistrements($id_article_enregistre)) {
                    echo "success,ajout,".$id_article_enregistre;

                }            
                



            } 
            else {
                // supprimer l'article des enregistrements
                if(supprimer_des_enregistrements($id_article_enregistre)) {
                    echo "success,suppression,".$id_article_enregistre;
                }
            }




        } else {
            echo "error,Votre session a expiré";
        }
    } else {
        echo "error,Cette fonctionnalité n'est pas disponible pour le moment, réessayez plus tard.";
    }


    
}




