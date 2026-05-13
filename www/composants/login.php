<?php
// S'assurer que la fonction login() est disponible
if (!function_exists('login')) {
    include_once __DIR__ . '/../auth/session.php';
}
// Ce fichier a besoin de get_status.php; database.php

// LA CONNEXION UTILISERA DORENAVENT L'API DE CONNEXION.KNOWITBETTER.FR


// Connexion locale (remplace l'API externe)
function connexion_using_local($lpseudo, $lpassword)
{
    global $db;
    global $login_form_sent, $erreur_login;
    $login_form_sent = false;
    $erreur_login = '';
    if (!empty($lpseudo) && !empty($lpassword)) {
        $login_form_sent = true;
        $result = login($db, $lpseudo, $lpassword, false);
        if (!is_array($result)) {
            $result = ["connected" => false, "message" => "Erreur inconnue lors de la connexion."];
        }
        if ($result["connected"] === true) {
            // Connexion réussie, la session est déjà initialisée
            // Redirection ou message de succès si besoin
        } else {
            $erreur_login = $result["message"];
        }
    }
}



// set the sessions settings

if (isset($_POST["formlogin"])) {
    // extraire les valeurs de la requete
    extract($_POST);
    connexion_using_local($lpseudo, $lpassword);
}
