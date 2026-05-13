<?php 
// get the status [disabled, beta, stable...] of a function from the database
// return the status number (0: everything is okay; 1: disabled, forbidden...)
function get_status($db_or_nom_fonction, $nom_fonction = null) {
    // Compatibilite avec l'ancien usage get_status("nom_fonction")
    if ($nom_fonction === null) {
        $nom_fonction = $db_or_nom_fonction;
        global $db;
    } else {
        $db = $db_or_nom_fonction;
    }

    if (!isset($db) || !is_object($db) || !method_exists($db, 'prepare')) {
        return 1;
    }

    // echo $nom_fonction;
    $query_status = $db->prepare("SELECT * FROM `status` WHERE `nom-fonction` = :nom_fonction");
    $query_status->execute([
        ':nom_fonction' => $nom_fonction
    ]);
    $status = $query_status->fetchAll();
    
    // if the request fails,there is a problem so the function is disabled
    if ($status) {
        return $status[0]["status"];
    } else {
        report_an_error("Erreur sur le site ". $_SERVER["HTTP_HOST"] . " dans la fonction get_status(\"$nom_fonction\")" ,"Erreur lors de la récupération du statut de la fonction $nom_fonction La requête SQL a échoué.");
        return 1;
    }

}




?>