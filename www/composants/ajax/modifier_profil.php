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


global $db;

// prénom
function changer_prenom($input_user) {
    // vérifier les droits
    if (verif_auth_user()) {
        // vérifier que le prénom ne contient que des caractères autorisés et ne dépasse pas la longueur maximale
        if (preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ-]+$/u", $input_user)) {
            // longueur maximale du prénom
            if (strlen($input_user) <= 20) {
                // lancer la requête, tout est OK
                global $db;
                $requete = $db->prepare("UPDATE `users` SET `prenom`= :prenom WHERE `id`= :user_id");
                $requete->bindParam(":prenom", $input_user);
                $requete->bindParam(":user_id", $_SESSION["id"]);
                if ($requete->execute() !== false) {
                    return true;
                } else {
                    echo "error,Une erreur est survenue";
                    return false;
                }
            } else {
                echo "error,Le prénom doit faire moins de 20 caractères.";
            }
        } else {
            echo "error,Le prénom ne doit pas inclure de caractères spéciaux ou de chiffres.";
            return false;
        }
    } else {
        echo "error,Votre session a expiré.";
        return false;
    }
}

// nom
function changer_nom($input_user) {
    // vérifier les droits
    if (verif_auth_user()) {
        // vérifier que le nom ne contient que des caractères autorisés et ne dépasse pas la longueur maximale
        if (preg_match("/^[a-zA-ZÀ-ÖØ-öø-ÿ\s-]+$/u", $input_user)) {
            // longueur maximale du nom
            if (strlen($input_user) <= 20) {
                // lancer la requête, tout est OK
                global $db;
                $requete = $db->prepare("UPDATE `users` SET `nom`= :nom WHERE `id`= :user_id");
                $requete->bindParam(":nom", $input_user);
                $requete->bindParam(":user_id", $_SESSION["id"]);
                if ($requete->execute() !== false) {
                    return true;
                } else {
                    echo "error,Une erreur est survenue";
                    return false;
                }
            } else {
                echo "error,Le nom doit faire moins de 20 caractères.";
            }
        } else {
            echo "error,Le nom ne doit pas inclure de caractères spéciaux ou de chiffres.";
            return false;
        }
    } else {
        echo "error,Votre session a expiré.";
        return false;
    }
}




extract($_POST);
if(isset($_POST["modifier_prenom"]) && (isset($_POST["modifier_nom"]))) {
    if (changer_prenom($modifier_prenom)) {
        if (changer_nom($modifier_nom)) {
            echo "success,Vos informations ont bien été enregistrées,".$modifier_prenom.",".$modifier_nom;
        }
    } 
} else if ($_POST["modifier_prenom"]) {
    if (changer_prenom($modifier_prenom)) {
        echo "success,Votre prénom a bien été enregistré,".$modifier_prenom;
    }
} else if ($_POST["modifier_nom"]) {
    if (changer_nom($modifier_nom)) {
        echo "success,Votre nom a bien été enregistré,".$modifier_nom;
    }
}

