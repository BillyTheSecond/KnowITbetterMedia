<?php
session_start();
include '../../database.php';
include '../get_status.php';
include '../verif-auth-user.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $newDate = $_POST['ddn'];
    // récupérer l'ancienne date de naissance
    $q0 = $db->prepare("SELECT ddn FROM users WHERE id = :id");
    $q0->bindParam(":id", $_SESSION["id"]);
    $q0->execute();
    $user_ddn = $q0->fetch();
    $user_ddn = $user_ddn["ddn"];


    // Vérifier si la date est valide
    if (validateDate($newDate)) {
        // Vérifier si la date est antérieure à la date actuelle
        if (strtotime($newDate) <= time()) {
            // Vérifier si l'âge est inférieur à 200 ans
            $currentDate = date('Y-m-d');
            $diff = date_diff(date_create($newDate), date_create($currentDate));
            $age = $diff->format('%y');
            if ($age < 200) {
                // Effectuer les opérations de mise à jour dans la base de données

                // Vérifier l'authentification de l'utilisateur
                if (verif_auth_user()) {
                    global $db;

                    // Effectuer les opérations de mise à jour dans la base de données
                    $requete = $db->prepare("UPDATE `users` SET `ddn`= :ddn WHERE `id`= :id");
                    $requete->bindParam(":id", $_SESSION['id']);
                    $requete->bindParam(":ddn", $newDate);
                    $result = $requete->execute();

                    if ($result === false) {
                        // La requête a échoué, afficher l'erreur
                        echo "error,Impossible de mettre à jour votre date de naissance. Contactez-nous si le problème persiste à administrateur@knowitbetter.fr";
                    } else {
                        // La requête a réussi
                        echo "success,Votre date de naissance a bien été mise à jour!," . $newDate;
                    }
                } else {
                    echo "error,Authentification invalide,". $user_ddn;
                }
            } else {
                echo "error,Vous ne pouvez pas avoir plus de 200 ans,". $user_ddn;
            }
        } else {
            echo "error,Votre date de naissance ne peut pas être dans le futur,". $user_ddn;
        }
    } else {
        echo "error,La date de naissance n'est pas valide,". $user_ddn;
    }
} else {
    echo "error,Aucune donnée de date de naissance reçue,". $user_ddn;
}

// Fonction pour valider la date
function validateDate($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}
