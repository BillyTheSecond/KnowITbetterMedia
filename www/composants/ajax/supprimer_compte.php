<?php
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);

session_start();
extract($_POST);
include '../../database.php';
include '../get_status.php';
include '../verif-auth-user.php';
include '../code_verif.php';
include 'functions.php';


// its working, we'll use it to delete an account
include "/home/knowitc/www/webdev/composants/project_management.php";
// include "../../../webdev - website/composants/project_management.php";

// ETAPE 1 : ENVOYER CODE DE VERIFICATION
// Vérifier si le formulaire a été soumis 
if (isset($_POST["send-code-delete-account"]) && isset($_POST["delete-account-userid"]) && verif_auth_admin()) {
    // if user is an admin that wants to delete some user's account
    sendCodeToDeleteAccount($_POST["delete-account-userid"]);
} else if (isset($_POST["send-code-delete-account"])) {
    // if the user want to delete its own account
    sendCodeToDeleteAccount();
}


function sendCodeToDeleteAccount($user_id = null)
{
    // make sure deleting an account is authorized from the database
    if (get_status("compte-suppression") != 1) {
        if ((verif_auth_user() && !verif_auth_admin()) || (verif_auth_admin() && $user_id == null)) {
            // if user is correctly connected but is not an admin, he can delete his own account

            // make sure no project is ongoing
            if (!areProjectsOngoing()) {
                // send code by email
                $currentdate = new DateTime();
                $currentdate = $currentdate->format('H:i');
                genererCodeVerification($_SESSION["email"], "Confirmez la suppression de votre compte [" . $currentdate . "]");
                response("", "success", "Code envoyé ✅");

                return true;
            } else {
                response("", "error", "Vous avez un projet en cours de développement sur <a href='https://webdev.knowitbetter.fr/compte/moncompte.php'>webdev.knowitbetter.fr</a>. Attendez la fin du projet pour supprimer votre compte.");
                return false;
            }
        } else if (verif_auth_admin()) {
            // if user is an admin, he can delete any account
            // make sure no project is ongoing
            if (!areProjectsOngoing($user_id)) {
                // send code by email
                verifyCodeToDeleteAccount($user_id);
            } else {
                response("", "error", "Vous avez un projet en cours de développement sur <a href='https://webdev.knowitbetter.fr/compte/moncompte.php'>webdev.knowitbetter.fr</a>. Attendez la fin du projet pour supprimer votre compte.");
                return false;
            }
        } else {
            // user is not authorized / correctly connected

        }
    } else {
        // not allowed, function disabled from the database
    }
}








// ETAPE 2 : VERIFIER LE CODE DE VERIFICATION
// Vérifier si le formulaire a été soumis 
if (isset($_POST["code-delete-account"]) && isset($_POST["delete-account-userid"])&& !empty($_POST["delete-account-userid"]) && verif_auth_admin()) {
    // if user is an admin that wants to delete some user's account
    verifyCodeToDeleteAccount($_POST["code-delete-account"], $_POST["delete-account-userid"]);
} else if (isset($_POST["code-delete-account"])) {
    // if the user want to delete its own account
    verifyCodeToDeleteAccount($_POST["code-delete-account"]);
}


function verifyCodeToDeleteAccount($code = null, $user_id = null)
{
    if ($code != null && verif_auth_user() && !verif_auth_admin() || (verif_auth_admin() && $user_id == null)) {
        // if user is correctly connected but is not an admin
        if (verifierValiditeCodeSecurite($code)) {
            // check if user has files in ktb webdev
            $project_ids = getAllUserProjectsIds($_SESSION['id']);
            // delete all the projects, their messages and their files on webdev.ktb.fr
            if ($project_ids !== false) {
                foreach ($project_ids as $project_id) {
                    deleteProject($project_id["id"]);
                }
            }
            // delete the user's personal directory on webdev.ktb.fr
            if (doesUserHaveFiles($_SESSION["id"])) {
                deleteUserFolder();
            }
            // delete user history
            delete_entire_historique();
            // envoyer un mail
            envoyer_email($_SESSION["email"], "Votre compte KnowITbetter a été supprimé définitivement", "Nous n'avons plus aucune de vos données en notre possession. <br>Vous avez supprimé votre compte définitivement.<br><br>Envoyez-nous votre avis à <a href='mailto:contact@knowitbetter.fr'>contact@knowitbetter.fr</a>.<br><br>La team KnowITbetter.", "");

            // delete account 
            deleteUserAccount();
            response("", "success", "Compte supprimé.");
        }
    } else if (verif_auth_admin() && $user_id != null) {
        // if user is an admin, delete the account without any code



    } else if ($code == null && verif_auth_user()) {
        response("", "error", "Vous n'avez pas rentré de code");

        // user is not authorized / correctly connected

    }
}


// if (areProjectsOngoing()) {
//     echo "NOT POSSIBLE";
// } else {
//     echo "POSSIBLE";
//     verifyCodeToDeleteAccount(2);
// }
