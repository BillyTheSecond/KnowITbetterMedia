<?php
// Lorsque ce fichier est execute, la table "tendances" de la base de données est mise à jour
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);

try {
    // Votre code ici

include "/home/pfuzxbqz/www/database.php";
global $db;
$requete = $db->query("SELECT * FROM `historique` ORDER BY `date` DESC LIMIT 100");
$logs = $requete->fetchAll();

// var_dump($logs);
// articles présents dans la liste
$liste_articles = [];
// nombre de fois où ils ont été cités dasn les 100 derniers articles consultés (par tous, sur le site)
$scores = [];


for ($i=0; $i < count($logs); $i++) {
    // si l'id de l'article étudié n'est pas déjà dans la liste_articles, l'y ajouter
    if (!in_array($logs[$i]["article"], $liste_articles)) {
        array_push($liste_articles, $logs[$i]["article"]);
        $scores[array_search($logs[$i]["article"], $liste_articles)] = 1;
    }
    else {
        // si l'article a déjà été étudié, ajouter 1 au score (=nb de fois où est retrouvé l'article étudié dans la liste)
        $scores[array_search($logs[$i]["article"], $liste_articles)]++;
    }
}

// trier les articles selon leur score

// Tri des scores par ordre décroissant
array_multisort($scores, SORT_DESC, $liste_articles);
for ($i = 0; $i < 10 && $i < sizeof($liste_articles); $i++) {
    $requete2 = $db->query("UPDATE `tendances` SET `article`= '$liste_articles[$i]' WHERE `id`= " . ($i+1));
}

} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
    // errorlog($e);
}
// errorlog("Tout s'est bien passé"); 
