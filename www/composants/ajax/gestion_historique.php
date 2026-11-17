<?php
$cookie_lifetime = 7*24*60*60; // 7 jours minutes en secondes
session_set_cookie_params($cookie_lifetime);

session_start();
// Récupération des données du formulaire
// var_dump($_POST);
// echo "OK1";
// Si la case à cocher "montrer_mail" a été cochée, on peut faire quelque chose de plus
include '../../database.php';
include '../get_status.php';
include '../verif-auth-user.php';
include 'functions.php';





// var_dump($_SESSION);
// echo $_SESSION["id"];


// ajouter un article à l'historique
if(isset($_POST["id_ligne_historique"]) && !empty($_POST["id_ligne_historique"])) {
    if (get_status("historique") != 1) {
        $id_ligne_historique = filter_input(
            INPUT_POST,
            'id_ligne_historique',
            FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]
        );
        if ($id_ligne_historique === false || $id_ligne_historique === null) {
            http_response_code(400);
            exit('error,Identifiant invalide');
        }
        // anonymiser la ligne corresondante  à l'historique
        if(delete_from_historique($id_ligne_historique)) {
            echo "success,suppression,".$id_ligne_historique;
        } else {
            echo "error,Une erreur est survenue";

        }
        

    } else {
        echo "error,Cette fonctionnalité n'est pas disponible pour le moment. Réessayez plus tard.";
    }


    
} else if (isset($_POST["historique_supprimer_tout"])) {
    if (get_status("historique") != 1) {
        // anonymiser la ligne corresondant à l'historique
        if(delete_entire_historique()) {
            echo "success,suppression,all";
        } else {
            echo "error,Une erreur est survenue";

        }
        

    } else {
        echo "error,Cette fonctionnalité n'est pas disponible pour le moment. Réessayez plus tard.";
    }

}




