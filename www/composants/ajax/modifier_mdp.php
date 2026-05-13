<?php

session_start();
// extract($_POST);
include '../../database.php';
include '../get_status.php';
include '../verif-auth-user.php';
include '../code_verif.php';
include 'functions.php';
include '../mail.php';


// its working, we'll use it to change the password
// include "/home/knowitc/www/webdev/composants/project_management.php";
// include "../../../webdev - website/composants/project_management.php";

// ETAPE 1 : ENVOYER CODE DE VERIFICATION
// Vérifier si le formulaire a été soumis 
if (isset($_POST["user_password"]) && isset($_POST["new_password1"]) && isset($_POST["new_password2"])) {
    // if user is an admin that wants to delete some user's account
    changePassword($_POST["user_password"], $_POST["new_password1"], $_POST["new_password2"]);
} 

function changePassword($password, $new_password1, $new_password2)
{
    // verify user's authentification
    if (verif_auth_user()) {
        // verify that the status database allows the change at the moment
        if (get_status("compte-modif-mdp") != 1) {

        // echo "hello";

        // verify the password
        global $db;
        $q0 = $db->prepare("SELECT * FROM users WHERE id = :id");
        $q0->bindParam(':id', $_SESSION["id"]);
        $q0->execute();
        $result_q0 = $q0->fetch();

        if ($result_q0 == true) {
            // if the account exists
            $hashpassword = $result_q0["password"];
            if (password_verify($password, $hashpassword)) {
                // if the password is correct
                if ($new_password1 == $new_password2) {
                    // if the new password is equals to its confirmation
                    if (preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/', $new_password1)) {
                        // if the new code is safe enough to be set as new password
                        // prepare request to change it
                        // hashage
                        $options = [
                            'cost' => 12,
                        ];
                        $motdepasse_hash = password_hash($new_password1, PASSWORD_BCRYPT, $options);
                        global $db;
                        $requete = $db->prepare("UPDATE `users` SET `password`= :password_hash WHERE `id`= :user_id");
                        $requete->bindParam(":password_hash", $motdepasse_hash);
                        $requete->bindParam(":user_id", $_SESSION["id"]);
                        if ($requete->execute()) {
                            // send a mail to warn the user its password has changed

                            $mail_content = "Bonjour ". $_SESSION["pseudo"] . ",<br><b>Le mot de passe de votre compte a été modifié.</b> Si vous n'avez pas effectué cette opération, signalez le à <a href='mailto:administrateur@knowitbetter.fr'>administrateur@knowitbetter.fr</a>'>";
                            envoyer_email($_SESSION["email"],"Votre mot de passe à été modifié",$mail_content,"Sécurité");
                            response("", "success", "Votre nouveau mot de passe a bien été enregistré");
                        } else {
                            response("", "error", "Impossible d'enregistrer le nouveau mot de passe, ");
                        }
                    } else {
                        response("", "error", "Le mot de passe de faire au moins 8 caractères dont des majuscules, chiffres et minuscules");
                    }
                } else {
                    response("", "error", "Le nouveau mot de passe et sa confirmation ne sont pas identiques");
                }
            } else {
                response("", "error", "Votre mot de passe est incorrect");
            }
        } else {
            response("", "error", "Une erreur inconnue s'est produite. Votre compte est introuvable. Si l'erreur persiste, contactez <a href='administrateur@knowitbetter.fr'>administrateur@knowitbetter.fr'</a>.");
        }
    }
} else {
    response("", "error", "La modification de votre mot de passe est désactivée pour le moment, veuillez réessayer plsu tard");

}
}