<?php
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);

// MANAGING HISTORY
// renvoie les coups de coeur sous forme de tableau
function delete_from_historique($ligne_id)
{
    // echo $_SESSION["id"];
    if (verif_auth_user()) {
        global $db;
        $historique1 = $db->prepare("UPDATE `historique` SET `user`= 0 WHERE `id`= :ligne_id");
        $historique1->bindParam(":ligne_id", $ligne_id);
        if ($historique1->execute() === true) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}


function delete_entire_historique()
{
    global $db;
    // echo $_SESSION["id"];
    if (verif_auth_user()) {
        $historique = $db->prepare("UPDATE `historique` SET `user`= 0 WHERE `user`= :user_id");
        $historique->bindParam(":user_id", $_SESSION["id"]);

        if ($historique->execute() === true) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

// CHANGING EMAIL

function sendCodeToChangeEmail($email, $email_confirmation)
{
    // vérifier que la modification du mail est autorisée
    if (get_status("compte-modif-mail") != 1) {
        // vérifier que user est bien connecté
        if (verif_auth_user()) {

            // vérifier que les 2 emails sont les mêmes
            if ($email === $email_confirmation) {
                // vérifier que l'email correspond bien au format email
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // vérifier que l'email n'est pas déjà utilisé par un autre compte
                    global $db;
                    $query = $db->prepare("SELECT `pseudo` FROM users WHERE `email`=:email");
                    $query->bindParam(":email", $email);
                    $query->execute();
                    $resultats = $query->fetchAll();
                    if (count($resultats) == 0) {
                        // enregistrer la nouvelle adresse dans la balise temporaire de la db en attendant la confirmation avec le code de validation
                        if (enregistrerNouvelEmailTemporaire($email)) {
                            // envoyer le code
                            $currentdate = new DateTime();
                            $currentdate = $currentdate->format('H:i');
                            genererCodeVerification($email, "Vérifiez votre nouvelle adresse mail [" . $currentdate . "]");
                            echo ("success,La nouvelle adresse mail est valide. En attente du code recu par mail.," . $email);
                        } else {
                            echo ("error,Une erreur est survenue");
                        }
                    } else {
                        echo ("error,Cette adresse mail est déjà utilisée par un compte KnowITbetter, veuillez en choisir un autre.," . getProfilEmail());
                    }
                } else {
                    echo ("error,Le format de l'adresse email n'est pas valide");
                }
            } else {
                echo ("error,Les deux adresses saisies ne sont pas identiques");
            }
        } else {
            echo ("error,Votre session n'est plus valide, vous avez été déconnecté");
        }
    } else {
        echo ("error,La modification de votre adresse email est impossible pour le moment, réessayez plus tard.," . getProfilEmail());
    }
}

function verifyCodeAndChangeEmail($code_verif)
{
    // vérifier que la modification du mail est autorisée
    if (get_status("compte-modif-mail") != 1) {
        // vérifier que user est bien connecté
        if (verif_auth_user()) {
            // aller chercher le code sur la db
            $verif = verifierValiditeCodeSecurite($code_verif);
            if ($verif === true) {
                // changer l'adresse mail
                $ancien_email = getProfilEmail();
                global $db;
                $q = $db->prepare("UPDATE users SET `email`=:nouvel_email, `temp_nouvel_email`=:email_temp WHERE `id`=:id");
                $nouvel_email = getProfilTempEmail();
                $q->bindParam(":nouvel_email", $nouvel_email);
                $q->bindValue(":email_temp", "");
                $q->bindParam(":id", $_SESSION["id"]);
                if ($q->execute()) {
                    // mettre à jour les paramètres de session pour éviter toute déconnexion
                    $_SESSION['email'] = getProfilEmail();
                    $contenu_mail = "Bonjour " . $_SESSION["pseudo"] . ",<br><br>Vous avez changé l'adresse mail associée à votre compte KnowITbetter. Dorénavant, vous devrez utiliser l'adresse suivante pour vous accéder à votre compte: <b>" . $_SESSION["email"] . "</b><br><br>Si vous n'êtes pas à l'origine de cette manipulation, veuillez nous en informer à administrateur@knowitbetter.fr le plus rapidemment possible pour que vous puissions sécuriser votre compte.<br><br>La team KnowITbetter.";
                    envoyer_email($ancien_email, "Changement de l'adresse mail associée à votre compte KnowITbetter", $contenu_mail, "Sécurité");
                    envoyer_email($nouvel_email, "Changement de l'adresse mail associée à votre compte KnowITbetter", $contenu_mail, "Sécurité");
                    echo "success,Votre nouvelle adresse mail a bien été enregistrée.," . getProfilEmail();
                } else {
                    echo "error,Un problème est survenu dans l'enregistrement de votre nouvelle adresse mail.";
                }
            } else {
                // les erreurs sont gérées directement dans la fonction verifierValiditeCodeSecurite();
            }
        } else {
            echo ("error,Votre session n'est plus valide, vous avez été déconnecté");
        }
    } else {
        echo ("error,La modification de votre adresse mail est impossible pour le moment, réessayez plus tard.," . getProfilEmail());
    }
}


function getProfilEmail()
{
    // récupérer l'adresse email associée au compte
    global $db;
    $q0 = $db->prepare("SELECT `email` FROM users WHERE id = :id");
    $q0->bindParam(":id", $_SESSION["id"]);
    $q0->execute();
    $user_email = $q0->fetch();
    $user_email = $user_email["email"];
    return $user_email;
}
function getProfilTempEmail()
{
    // récupérer l'adresse email associée au compte
    global $db;
    $q0 = $db->prepare("SELECT `temp_nouvel_email` FROM users WHERE id = :id");
    $q0->bindParam(":id", $_SESSION["id"]);
    $q0->execute();
    $user_temp_email = $q0->fetch();
    $user_temp_email = $user_temp_email["temp_nouvel_email"];
    return $user_temp_email;
}

function enregistrerNouvelEmailTemporaire($temp_email)
{
    global $db;
    $q0 = $db->prepare("UPDATE users SET `temp_nouvel_email`=:temp_email  WHERE id = :id");
    $q0->bindParam(":temp_email", $temp_email);
    $q0->bindParam(":id", $_SESSION["id"]);
    if ($q0->execute()) {
        return true;
    } else {
        return false;
    }
}



// DELETING ACCOUNT

// check if user has files
function doesUserHaveFiles($user_id)
{
    if (is_dir("/home/knowitc/www/webdev/userfiles/" . $user_id . "/")) {
        return true;
    } else {
        return false;
    }
}

// make sure no project is ongiong for a user 
function areProjectsOngoing($user_id = null)
{
    if (verif_auth_user() && !verif_auth_admin() || (verif_auth_admin() && $user_id == null)) {
        // if user is correctly connected but is not an admin
        global $db;
        $query = $db->prepare("SELECT `id` FROM `dev-projets` WHERE `user-id`=:user_id");
        $query->bindParam(":user_id", $_SESSION["id"]);
        if ($query->execute()) {
            // count not scratch results
            $query = $query->fetchAll();
            // number of ongoing projects
            $count = 0;
            foreach ($query as $projet) {
                if (!isProjectBrouillon($projet["id"])) {
                    // if a broject is not a draft, $count != 0
                    $count += 1;
                }
            }
            if ($count == 0) {
                return false;
            } else {
                return true;
            }
        } else {
            // error
        }
    } else if (verif_auth_admin() && $user_id != null) {
        // if user is an admin, get any data
        global $db;
        $query = $db->prepare("SELECT `id` FROM `dev-projets` WHERE `user-id`=:user_id");
        $query->bindParam(":user_id", $user_id);
        if ($query->execute()) {
            // count not scratch results
            $query = $query->fetchAll();
            // number of ongoing projects
            $count = 0;
            foreach ($query as $projet) {
                if (!isProjectBrouillon($projet["id"])) {
                    // if a broject is not a draft, $count != 0
                    $count += 1;
                }
            }
            if ($count == 0) {
                return false;
            } else {
                return true;
            }
        } else {
            // error
        }
    } else {
        // user is not authorized / correctly connected

    }
}

// delete files if no projects are ongoing. Make sure théfolder exists before running the function
function deleteUserFolder($user_id = null)
{
    if (get_status("compte-suppression") != 1) {
        if (verif_auth_user() || (verif_auth_admin() && !isset($user_id))) {
            // check if user has ongoing projects
            if (!areProjectsOngoing()) {
                // user can delete his folder
                // echo formatBytes(getFolderSize("/home/knowitc/www/webdev/userfiles/". $_SESSION["id"]."/"));
                // delete the folder
                deleteFolderAndContents("/home/knowitc/www/webdev/userfiles/" . $_SESSION["id"] . "/");
            } else {
                response("", "error", "Vous avez un projet en cours de développement sur <a href='https://webdev.knowitbetter.fr/compte/moncompte.php'>webdev.knowitbetter.fr</a>. Attendez la fin du projet pour supprimer votre compte.");
            }
        } else if (verif_auth_admin() && isset($user_id)) {
        }
    }
}



function deleteFolderAndContents($folderPath)
{
    // Make sure the path is a valid directory
    if (is_dir($folderPath)) {


        // Open the directory and read its contents
        $directory = opendir($folderPath);
        if (!$directory) {
            throw new RuntimeException("Failed to open directory: $folderPath");
        }

        // Loop through each item in the directory
        while (($item = readdir($directory)) !== false) {
            // Skip current and parent directory entries
            if ($item === '.' || $item === '..') {
                continue;
            }

            // Build the full path to the item
            $itemPath = $folderPath . DIRECTORY_SEPARATOR . $item;

            // Recursively delete the item if it's a directory
            if (is_dir($itemPath)) {
                deleteFolderAndContents($itemPath);
            } else {
                // Delete the file
                if (!unlink($itemPath)) {
                    closedir($directory);
                    throw new RuntimeException("Failed to delete file: $itemPath");
                }
            }
        }

        // Close the directory handle
        closedir($directory);

        // Delete the main folder
        if (!rmdir($folderPath)) {
            throw new RuntimeException("Failed to delete folder: $folderPath");
        }
    }
}

function getFolderSize($folderPath)
{
    $totalSize = 0;

    // Make sure the path is a valid directory
    if (is_dir($folderPath)) {



        // Open the directory and read its contents
        $directory = opendir($folderPath);
        if (!$directory) {
            throw new RuntimeException("Failed to open directory: $folderPath");
        }

        // Loop through each item in the directory
        while (($item = readdir($directory)) !== false) {
            // Skip current and parent directory entries
            if ($item === '.' || $item === '..') {
                continue;
            }

            // Build the full path to the item
            $itemPath = $folderPath . DIRECTORY_SEPARATOR . $item;

            // If the item is a directory, recursively calculate its size
            if (is_dir($itemPath)) {
                $totalSize += getFolderSize($itemPath);
            } else {
                // If the item is a file, add its size to the total
                $totalSize += filesize($itemPath);
            }
        }

        // Close the directory handle
        closedir($directory);

        return $totalSize;
    } else {
        // is not a floder or the folder doesn't exist
        return false;
    }
}


function formatBytes($bytes, $precision = 2)
{
    $units = ['o', 'ko', 'Mo', 'Go', 'To'];

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    // Uncomment the line below if you prefer decimal separator (e.g., 1.23 MB)
    // return round($bytes / (1024 ** $pow), $precision) . ' ' . $units[$pow];

    // Uncomment the line below if you prefer a thousands separator (e.g., 1,234.56 MB)
    return number_format($bytes / (1024 ** $pow), $precision) . ' ' . $units[$pow];
}

function deleteUserAccount($user_id = null)
{
    // si user is correctly connected 
    // AN ADMIN CANNOT DELETE HIS ACCOUNT (ITS A SECURITY MESURE)
    if (verif_auth_user() && !verif_auth_admin() || (verif_auth_admin() && $user_id == null)) {
        // send mail
        global $db;
        $query = $db->prepare("DELETE FROM `users` WHERE `id`= :user_id");
        $query->bindParam(":user_id", $_SESSION["id"]);
        if ($query->execute()) {
            response("", "success", "Votre compte a bien été supprimé");
        }
    } else if ($user_id !== null && verif_auth_admin()) {
        global $db;
        $query = $db->prepare("DELETE FROM `users` WHERE `id`= :user_id");
        $query->bindParam(":user_id", $user_id);
        if ($query->execute()) {
            response("", "success", "Votre compte a bien été supprimé");
        }
    }
}
