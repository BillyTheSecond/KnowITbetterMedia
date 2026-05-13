<?php
// LORS DE L'EXECUTION DE CE FICHIER: Une nouvelle ligne de 'log' est créée dans la table "historique" indiquant qu'un article a été consulté
// et indiquant par qui si l'utilisateur est connecté.
global $db;


if ($_SERVER['HTTP_HOST'] != "beta.knowitbetter.fr") {
    // ne pas prendre en compte les accès depuis le site "BETA"
    if (isset($_SESSION["id"]) && verif_auth_user()) {
        // Si la session est définie
        $user = $_SESSION["id"];
        // echo $user;
    } else {
        $user = 0;//utilisateur anonmye/ non-connecté = 0
        $continuer = true;
    }
    // vérifier que cet article n'a pas déjà été enregistré dans la journée pour le compte connecté
    if ($user != 0) {
        $query1 = $db->prepare("SELECT `id`,`article`,`date` FROM `historique` WHERE `user` = :user_id ORDER BY `date` DESC LIMIT 1");
        $query1->bindParam(":user_id",$_SESSION["id"]);
        $query1->execute();
        $dernier_historique = $query1->fetch();
        if ($dernier_historique["article"] == $article['id'] && date_parse($dernier_historique["date"])["year"] == getdate()["year"] && date_parse($dernier_historique["date"])["month"] == getdate()["mon"] && date_parse($dernier_historique["date"])["day"] == getdate()["mday"]) {

            $continuer = false;
        } else {
            $continuer = true;
        }
    }

    if ($user == 0 || $continuer == true) {
        $requete = $db->query("INSERT INTO `historique`(`user`, `article`) VALUES ('$user', '{$article['id']}')");

    }

}
