<?php
session_start();
// Récupération des données du formulaire
extract($_POST);
// var_dump($_POST);
// echo "OK1";
// Si la case à cocher "montrer_mail" a été cochée, on peut faire quelque chose de plus
include '../../database.php';
include '../verif-auth-user.php';

// echo "OKA";

global $db;
// var_dump($_SESSION);
// echo $_SESSION["id"];
if (verif_auth_user() == 1) {
    if (isset($montrer_mail)) {
        //  montrer_mail si la variable est définie (donc cochée)
        $requete = $db->prepare("UPDATE `users` SET `montrer_email`= 1 WHERE `id`= :id");
        // echo "ok1";
        $requete->bindParam(':id', $_SESSION['id']);
        // echo "ok2";
        $requete->execute();
        echo 'on';

    } else {
        // cacher mail sinon
        // echo "ok4";
        $requete = $db->prepare("UPDATE `users` SET `montrer_email`= 0 WHERE `id`= :id");
        // echo "ok5";
        $requete->bindParam(':id', $_SESSION['id']);
        // echo "ok6";
        $requete->execute();
        echo "off";
        // var_dump( $_POST);

    }
}
