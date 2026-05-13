<?php
$cookie_lifetime = 7*24*60*60; // 7 jours minutes en secondes
session_set_cookie_params($cookie_lifetime);

session_start();
// Récupération des données du formulaire
extract($_POST);
// var_dump($_POST);
// echo "OK1";
// Si la case à cocher "montrer_mail" a été cochée, on peut faire quelque chose de plus
include '../../database.php';
include '../get_status.php';
include '../verif-auth-user.php';

// echo "OKA";

global $db;
// var_dump($_SESSION);
// echo $_SESSION["id"];

// si la session est valide:
if (verif_auth_user()) {
    // vérifier longueur du pseudo >= caractères
    if (strlen($nouvelle_citation) <= 100) {
        // véridier que la fonction n'est pas désactivée
        if (get_status("compte-modif-citation") == 0 || get_status("compte-modif-citation") == 3) {
            $requete = $db->prepare("UPDATE `users` SET `citation`= :citation WHERE `id`= :id");
            $requete->bindParam(":citation", $nouvelle_citation);
            $requete->bindParam(":id", $_SESSION['id']);
            $result = $requete->execute();
            if ($result === false) {
                // La requête a échoué, afficher l'erreur
                echo "error,Impossible de mettre à jour votre citation. Contactez-nous si le problème persiste à administrateur@knowitbetter.fr";
            } else {
                // La requête a réussi
                echo "success,Votre citation a bien été mise à jour!,". $nouvelle_citation;
            }

            
        } else {
            echo "error,Il est impossible de modifier votre citation pour le moment, reessayez plus tard";
        }
    } else {
        echo "error,La citation est trop longue";
    }


 
} else {
    echo "error,Votre session a expiré";
}
