<?php
// session_start();
// echo $_SESSION["id"];
// include "../database.php";
// global $db;
// include "mail.php";

function generateRandomCode()
{
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';
    for ($i = 0; $i < 6; $i++) {
        $randomIndex = mt_rand(0, strlen($characters) - 1);
        $code .= $characters[$randomIndex];
    }
    return $code;
}

function calculateExpirationDate()
{
    $currentDate = new DateTime();
    $expirationDate = $currentDate->add(new DateInterval('PT20M'));
    return $expirationDate->format('Y-m-d H:i:s');
}

function genererCodeVerification($to, $objet)
{
    $code = generateRandomCode();
    $date_expiration = calculateExpirationDate();
    // enregistrer ces données dans la DB
    global $db;
    $maj = $db->prepare("UPDATE `users` SET `code_secu`=:code_secu,`validite_code_secu`=:date_expiration WHERE `id`=:id");
    $maj->bindParam(":code_secu", $code);
    $maj->bindParam(":date_expiration", $date_expiration);
    $maj->bindParam(":id", $_SESSION["id"]);
    if ($maj->execute()) {
        ajouterUneTentative(true); //réinitialiser le nombre de tentatives déjà effectuées
        // envoyer un mail avec la fonction envoyer_email() en incluant le fichier mail.php
        $email_contenu = "Bonjour " . $_SESSION["pseudo"] . ",<br><br>Votre code de vérification est : <b>" . $code . "</b>.<br><br>Ce code est valide pendant 20 minutes.<br>Ce mail est un message automatique. Merci de ne pas y répondre.<br><br>La team KnowITbetter.";
        envoyer_email($to, $objet, $email_contenu, "Authentification");
    }
}


function verifierValiditeCodeSecurite($code)
{
    if (!empty($code)) {
        // aller chercher le code
        global $db;
        $requete = $db->prepare("SELECT `code_secu`, `validite_code_secu` FROM `users` WHERE  `id`= :id");
        $requete->bindParam(":id", $_SESSION['id']);
        $requete->execute();
        $user_info = $requete->fetch();
        $date_expiration = new DateTime($user_info["validite_code_secu"]);
        $date_actuelle = new DateTime();
        // verifier que le code n'est pas expiré
        if ($date_expiration > $date_actuelle) {
            // vérifier que le nombre de tentatives maximal n'ait pas été atteint
            if (getNombreTentatives() < 3) {
                // vérifier que le code est le même
                if ($code == $user_info["code_secu"]) {
                    // le code est bon
                    response("", "success", "Le code est bon");
                    return true;
                } else {
                    // le code est faux
                    if (!ajouterUneTentative()) {
                        envoyer_email("administrateur@knowitbetter.fr", "Une erreur est survenue dans la fonction 'ajouterUneTentative()'", "La valeur renvoyée est false<br>UserID=" . $_SESSION["id"], "Error report");
                    }
                    response("", "error", "Le code est faux");
                    return false;
                }
            } else {
                response("", "error", "Trop de tentatives ont échoué.");
                return false;
            }
        } else {
            // le code a expiré
            response("", "error", "Le code a expiré.");
            return false;
        }
    } else {
        response("", "error", "Vous n'avez pas rentré de code");
    }
}

// Ajouter 1 au nombre de tentatives de saisie du code de vérification réalisées ou réinitialiser le compteur
function ajouterUneTentative($reset = false)
{
    if ($reset) {
        $nb_tentatives = 0;
    } else {

        $nb_tentatives = getNombreTentatives() + 1;
    }
    global $db;
    $maj = $db->prepare("UPDATE `users` SET `nb_tentatives`=:nb_tentatives WHERE `id`=:id");
    $maj->bindParam(":nb_tentatives", $nb_tentatives);
    $maj->bindParam(":id", $_SESSION["id"]);
    if ($maj->execute()) {
        return true;
    } else {
        return false;
    }
}
// Obtenir le nombre de tentatives de saisie du code qui ont déjà été réalisées
function getNombreTentatives()
{
    global $db;
    $requete = $db->prepare("SELECT `nb_tentatives` FROM `users` WHERE  `id`= :id");
    $requete->bindParam(":id", $_SESSION['id']);
    $requete->execute();
    $user_info = $requete->fetch();
    return intval($user_info["nb_tentatives"]);
}

function getCode()
{
    // récupérer l'adresse email associée au compte
    global $db;
    $q0 = $db->prepare("SELECT `code_verif` FROM users WHERE id = :id");
    $q0->bindParam(":id", $_SESSION["id"]);
    $q0->execute();
    $code = $q0->fetch();
    $code = $code["code_verif"];
    return $code;
}




$currentdate = new DateTime();
$currentdate = $currentdate->format('H:i');

// genererCodeVerification("louison.bed@outlook.fr","Votre code de confirmation [". $currentdate . "]");