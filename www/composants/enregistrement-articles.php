<!-- Ce fichier requiert les fichiers suivants :
    database.php

-->


<?php

// echo 'ficher enregistrement-articles.php chargé';

function is_article_enregistre($id) {
    // echo "fonction lancee";
    global $db;
    // echo $_SESSION["id"];
    $articles_enregistres = $db->query("SELECT enregistrements FROM users WHERE id = ".$_SESSION["id"]);
    // echo "requete effectuee";
    $articles_enregistres = $articles_enregistres->fetch();
    // echo "fetch effectué";
    $articles_enregistres = $articles_enregistres["enregistrements"];
    // echo $articles_enregistres;
    if (strpos($articles_enregistres, ",". $id . ",") !== false) {
        // echo "true";
        return true;
    }
    elseif (strpos($articles_enregistres, $id . ",") !== false && strpos($articles_enregistres, $id . ",") == 0) {
        // echo "true";
        return true;
    } else {
        // echo "false";
        return false;
    }



}






// ajouter un article aux enregistrements
if(isset($_POST["id_change_enregistrement_status_article"])) {
    // echo "formulaire soumis<br>";
    if (verif_auth_user()) {
        // user autorisé
        // echo "Vous êtes correctement authentifié(e)<br>";
        extract($_POST);
        // echo "POST extrait";
        // récupérer les articles enregistres
        $articles_enregistres = $db->query("SELECT enregistrements FROM users WHERE id = '".$_SESSION["id"] ."'");
        $articles_enregistres = $articles_enregistres->fetch();
        // var_dump($articles_enregistres);
        // echo  $articles_enregistres["enregistrements"];
        $articles_enregistres = $articles_enregistres["enregistrements"];

        if(!is_article_enregistre($id_change_enregistrement_status_article)) {
            // echo "article non enregistré";
            if (substr_count($articles_enregistres,",") <=1000){
                // L'article n'est pas présent dans les coups de coeurs, il faut donc l'ajouter
                $articles_enregistres = $articles_enregistres. $id_change_enregistrement_status_article . ",";
                $edit = $db->query("UPDATE users SET enregistrements='". $articles_enregistres ."' WHERE id=". $_SESSION['id']);
            } else {
                echo "La limite d'enregistrements a été atteinte (1000)";
            }
            // echo 'Location: https://knowitbetter.fr'.$_SERVER["PHP_SELF"];

            header('Location: https://knowitbetter.fr'.$_SERVER["PHP_SELF"]);
            // echo "post détruite ?";


        } 
        else {
            // supprimer l'article des enregistrements
            if (strpos($articles_enregistres, ",". $id_change_enregistrement_status_article . ",") !== false) {
                // echo "ID trouvé au milieu<br>";
                $articles_enregistres = str_replace(",". $id_change_enregistrement_status_article . ",",",",$articles_enregistres);
                // echo "chaine de caractères modifiéée avant envoi de la requete<br>";
                // echo "Initi";
    
                $edit = $db->query("UPDATE users SET enregistrements='". $articles_enregistres ."' WHERE id=". $_SESSION['id']);
                // echo "requete de suppression envoyée";
    
            } 
            // si li'ID est en début de str
            elseif (strpos($articles_enregistres, $id_change_enregistrement_status_article . ",") !== false && strpos($articles_enregistres, $id_change_enregistrement_status_article . ",") == 0) {
                // echo "ID trouvé au début";
    
                $articles_enregistres = str_replace($id_change_enregistrement_status_article . ",","", $articles_enregistres);
                $edit = $db->query("UPDATE users SET enregistrements='". $articles_enregistres ."' WHERE id=". $_SESSION['id']);
                // echo "requete de suppression envoyée";
    
    
            }
            // echo 'Location: https://knowitbetter.fr'.$_SERVER["PHP_SELF"];

            header('Location: https://knowitbetter.fr'.$_SERVER["PHP_SELF"]);
            // echo "post détruite ?";
        }




    } else {
        echo "Erreur d'authentification";
    }

    // echo ('Location: https://knowitbetter.fr/'.$_SERVER["HTTPS"]. '.php');
    
}









?>