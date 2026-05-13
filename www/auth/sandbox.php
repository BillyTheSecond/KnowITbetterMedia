<?php
//set encodage to utf-8
header('Content-Type: application/json; charset=utf-8');
// header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
// fake json output
// echo '{
//     "status": 0,
//     "message": "Everything is okay"
// }';





ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

include "/home/pfuzxbqz/subdomains/connexion/safefolder/settings.php";
include "/home/pfuzxbqz/subdomains/connexion/safefolder/databaseauth.php";
include "/home/pfuzxbqz/subdomains/connexion/auth/database.php";
$db = getDatabase($login_database);
include "/home/pfuzxbqz/subdomains/connexion/auth/session.php";
// set the session cookies parameters
set_session_settings();
include "/home/pfuzxbqz/subdomains/connexion/auth/mail.php";
include "/home/pfuzxbqz/subdomains/connexion/auth/status.php";
include "/home/pfuzxbqz/subdomains/connexion/myaccount/functions/generation_functions.php";
include "/home/pfuzxbqz/subdomains/connexion/myaccount/functions/general_web_components.php";
include "/home/pfuzxbqz/subdomains/connexion/api/api_files/useful_tools.php";
//si l'utilisateur n'est pas connecté, on affiche la page de connexion


// requete sql pour creer littéralement un utilisateur de la db (un compte pour se connecter à la sb)  avec create user


// Nom d'utilisateur et mot de passe à créer
$nouvel_utilisateur = "nouvel_utilisateur";
$mot_de_passe_nouvel_utilisateur = "mot_de_passe_nouvel_utilisateur";

// Requête SQL pour créer un nouvel utilisateur
$requete  =$db->prepare("CREATE USER '$nouvel_utilisateur'@'localhost' IDENTIFIED BY '$mot_de_passe_nouvel_utilisateur'");
$requete->execute();

// afficher la session actuelle
$requete2 = $db->prepare("SELECT CURRENT_SESSION();");
$requete2->execute();
var_dump($requete2);






