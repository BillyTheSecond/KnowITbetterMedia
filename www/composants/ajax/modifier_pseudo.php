<?php
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
if (isset($nouveau_pseudo) && !empty($nouveau_pseudo) && verif_auth_user()) {
    // verifier qu'il n'y a pas de caracères interdits
    if (preg_match('/^[a-zA-Z0-9._-]+$/', $nouveau_pseudo)) {
        // vérifier longueur du pseudo >= caractères
        if (strlen($nouveau_pseudo) >= 5) {
            // véridier que la fonction n'est pas désactivée
            if (get_status("compte-modif-pseudo") == 0 || get_status("compte-modif-pseudo") == 3) {
            // echo "verification de l'unicité du pseudo";
            $q0 = $db->prepare("SELECT pseudo FROM users WHERE pseudo = :pseudo");
            $q0->execute([
                'pseudo' => $nouveau_pseudo
            ]);
            // compter le nombre de résultats
            $result_q0 = $q0->rowCount();
            // s'il n'y a aucun résultat, c'est OK, on poursuit.
            if ($result_q0 == 0) {
                $requete = $db->prepare("UPDATE `users` SET `pseudo`= :pseudo WHERE `id`= :id");
                $requete->bindParam(":id", $_SESSION['id']);
                $requete->bindParam(":pseudo", $nouveau_pseudo);
                $result = $requete->execute();
                if ($result === false) {
                    // La requête a échoué, afficher l'erreur
                    echo "error,Impossible de mettre à jour votre pseudo. Contactez-nous si le problème persiste à administrateur@knowitbetter.fr";
                } else {
                    // La requête a réussi
                    $_SESSION["pseudo"] = $nouveau_pseudo;
                    echo "success,Votre pseudo a bien été mis à jour!,". $nouveau_pseudo;
                }


            } else {
                echo "error,Ce pseudo est déjà pris";
            }
                
            } else {
                echo "error,Il est impossible de modifier votre pseudo pour le moment, reessayez plus tard";
            }
        } else {
            echo "error,Le pseudo doit contenir au moins 5 caractères";
        }
    } else {
        echo "error,Le pseudo ne doit pas contenir de caractères spéciaux, d'espaces ni de lettres accentuées.";
    }







} else {
    echo "error,Veuillez renseignez un nouveau pseudo avant de valider";

}