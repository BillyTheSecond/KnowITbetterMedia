<?php 
// obtenir les status d'une fonction particulière
// echo "ficher chargé";
function get_status($db_or_nom_fonction, $maybe_nom_fonction = null) {
    // Permet d'appeler get_status($db, $nom_fonction) ou get_status($nom_fonction) (compatibilité)
    if ($maybe_nom_fonction !== null) {
        $db = $db_or_nom_fonction;
        $nom_fonction = $maybe_nom_fonction;
    } else {
        global $db;
        $nom_fonction = $db_or_nom_fonction;
    }
    $query_status = $db->prepare("SELECT * FROM `status` WHERE `nom-fonction` = :nom_fonction");
    $query_status->execute([
        ':nom_fonction' => $nom_fonction
    ]);
    $status = $query_status->fetchAll();
    return $status[0]["status"];
}




?>