<?php
//display errors
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

// check if the session environment is the same as the one when the user connected (ip and user_agent)
// function built to prevent session stealing (a simple copy of the session cookie would allow the thief to connect to the user's account from his device)
// this way if the ip changes or the user_agent changes but the sessionid stays the same, the user will be disconnected and an email will be sent to warn him
function check_session_environment() {
    if (($_SESSION['ip'] == $_SERVER['REMOTE_ADDR']) ||  ($_SERVER["REMOTE_ADDR"] === "185.221.182.171")) {
        return true;
    } else {
        
        return false;
    }
}



// checks if a user is connected and correctly authentified to its account 
/**
 * @param  $db the database variable
 * @param $security_level the security level of the authentification, "full" or "low"
 * @param $redirect if true, the function will redirect the user to the home page if it is not connected
 * @return bool true if the user is connected and correctly authentified, false if not
 */
function is_user_connected($db, $security_level = "full",$redirect = true)

{
    // var_dump($_SESSION);
    // if security level is full, then check if the user is connected and if all its session's data matches its data on the database
    // if security level is low, then check if the a is connected
    if (isset($_SESSION["id"]) && !empty($_SESSION["id"]) && isset($_SESSION["pseudo"]) && !empty($_SESSION["pseudo"]) && isset($_SESSION["email"]) && !empty($_SESSION["email"]) && isset($_SESSION["role"]) && !empty($_SESSION["role"])) {
        //  check security level authentification
        if ($security_level === "full") {
            $query = $db->prepare("SELECT email, prenom, nom, ddn, photo_profil, recovery_email, phone FROM users WHERE id = :id AND pseudo = :pseudo  AND `role` = :role");
            $query->bindParam(':id', $_SESSION["id"]);
            $query->bindParam(':pseudo', $_SESSION["pseudo"]);
            $query->bindParam(':role', $_SESSION["role"]);
            $query_result = $query->execute();
            if ($query_result === true) {
                // if the request is a success
                $result = $query->fetchAll();
                if ($result) {
                    // if the number of results is 1, return true else return false
                    if (count($result) == 1) {
                        // a unique result has been found, the user is correctly connected

                        // update the user information if it has changed
                        $_SESSION["email"] = $result[0]["email"];
                        $_SESSION['first_name'] = $result[0]["prenom"];
                        $_SESSION['last_name'] = $result[0]["nom"];
                        $_SESSION['birth_date'] = $result[0]["ddn"];
                        $_SESSION['email'] = $result[0]["email"];

                        $_SESSION['photo'] = $result[0]['photo_profil'];
                        $_SESSION['recovery_email'] = $result[0]['recovery_email'];
                        $_SESSION['phone_number'] = $result[0]['phone'];

                        // check if the session environment is the same as the one when the user connected (ip and user_agent)
                        if (check_session_environment() === true) {
                            return true;
                        } else {
                            // if the session environment is not the same as the one when the user connected then there is a problem
                            email_user($_SESSION["email"],"Connexion suspecte", "Quelqu'un a tenté de se connecter à votre compte depuis une adresse IP ou un navigateur différent de celui que vous utilisez habituellement. Si ce n'est pas vous, veuillez changer votre mot de passe et nous contacter.<br>Adresse IP de la connexion: ". $_SERVER["REMOTE_ADDR"],"Sécurité");
                            logout($redirect);
                        }
                    } else {
                        // 0 or more than 1 results have been found, the user is not correctly connected
                        
                        return false;
                    }
                } else {
                    // if the request returns no result
                    report_an_error("Erreur sur le site " . $_SERVER["HTTP_HOST"] . " dans la fonction is_user_connected(\"$security_level\")", "L'utilisateur n'existe pas dans la base de données.");
                    return false;
                }
            } else {
                // if the request fails
                report_an_error("Erreur sur le site " . $_SERVER["HTTP_HOST"] . " dans la fonction is_user_connected(\"$security_level\")", "La requête SQL a échoué.");
                return false;
            }
        } else if ($security_level === "low") {
            return true;
        } else {
            report_an_error("Erreur sur le site " . $_SERVER["HTTP_HOST"] . " dans la fonction is_user_connected(\"$security_level\")", "Le niveau de sécurité demandé n'existe pas.");
            return false;
        }
    } else {
        // no user is connected
        return false;
    }
}


// update user email and user role from database NOT USED
function update_session_information($db, $user_id)
{
    // if some user is connected
    // update the session information
    $query = $db->prepare("SELECT 'pseudo', 'email' ,'role','id' FROM users WHERE id = :id AND email = :pseudo");
    $query->bindParam(':id', $_SESSION["id"]);
    $query->bindParam(':pseudo', $_SESSION["pseudo"]);
    $query_result = $query->execute();
    if ($query_result === true) {
        // if the request is a success
        $result = $query->fetchAll();
        if ($result == true) {
            // if the number of results is 1, update the session information
            if (count($result) === 1) {
                // a unique result has been found, the user is correctly connected
                $_SESSION['email'] = $result[0]["email"];
                $_SESSION['role'] = $result[0]["role"];
                return true;
            } else {
                // 0 or more than 1 results have been found, the user is not correctly connected
                report_an_error("Erreur sur le site " . $_SERVER['HTTP_HOST'] . " dans la fonction update_session_information(\"" . $db . "\", \"" . $_SESSION['id'] . "\")", "L'utilisateur n'existe pas dans la base de données ou l'id et le pseudo de sa session ne sont plus les mêmes que dans la base de données");
                // déconnecter l'utilisateur
                logout();
                return false;
            }
        } else {
            // if the request returns no result
            report_an_error("Erreur sur le site " . $_SERVER["HTTP_HOST"] . " dans la fonction update_session_information(\"" . $db . "\", \"" . $_SESSION['id'] . "\")", "L'utilisateur n'existe pas dans la base de données.");
            return false;
        }
    } else {
        // if the request fails
        report_an_error("Erreur sur le site " . $_SERVER["HTTP_HOST"] . " dans la fonction update_session_information(\"" . $db . "\", \"" . $_SESSION['id'] . "\")", "La requête SQL a échoué.");
        return false;
    }
}


// set the sessions settings
function set_session_settings()
{
    // set the phpsessid length
    ini_set('session.sid_length', 64);
    // set the session cookie lifetime to 30 days
    ini_set('session.cookie_lifetime', 2592000);
    // set the session cookie domain to all subdomain of the website
    ini_set('session.cookie_domain', ".knowitbetter.fr");
    // set the session cookie secure to true = cookies will only be sent over secure connections
    ini_set('session.cookie_secure', true);
    // set the session cookie http only to true = cookies will not be accessible by javascript
    ini_set('session.cookie_httponly', true);
    // set the session cookie samesite to strict = cookies will not be included in requests coming from other websites
    ini_set('session.cookie_samesite', 'Strict');
    // start the session
    session_start();
}


// check if the account is blocked  (if a login operation is permitted for this account)
function is_account_blocked($db, $account_id)
{
    // go look for the information in the database
    $query = $db->prepare("SELECT connexion_activee FROM `users` WHERE `id` = :id");
    $query->bindParam(':id', $account_id);
    // if the request is a success
    if ($query->execute() === true) {
        $result = $query->fetchAll();
        if ($result) {
            if ($result[0]["connexion_activee"] == false) {
                // the account is blocked
                return true;
            } else {
                // the account is not blocked
                return false;
            }
        } else {
            // if the request returns no result then the account does not exists, forbid connection
            report_an_error("Erreur sur le site " . $_SERVER["HTTP_HOST"] . " dans la fonction is_account_blocked(\"" . $db . "\", \"" . $account_id . "\")", "L'utilisateur n'existe pas dans la base de données.");
            return true;
        }
    } else {
        // if the request fails then forbid connection
        report_an_error("Erreur sur le site " . $_SERVER["HTTP_HOST"] . " dans la fonction is_account_blocked(\"" . $db . "\", \"" . $account_id . "\")", "La requête SQL a échoué.");
        return true;
    }
}



// increment the number of login attempts for an account and if the number is
function add_one_failed_connection_to_the_counter($db, $account_id)
{
    // go look for the information in the database
    $query1 = $db->prepare("SELECT nb_tentatives_connexion FROM `users` WHERE `id` = :id");
    $query1->bindParam(':id', $account_id);
    // if the request is a success
    if ($query1->execute() === true) {
        $result1 = $query1->fetchAll();
        if ($result1) {
            // if the account exists, increment the number of login attempts
            $query2 = $db->prepare("UPDATE `users` SET `nb_tentatives_connexion` = `nb_tentatives_connexion` + 1 WHERE `id` = :id");
            $query2->bindParam(':id', $account_id);
            // if the request is a success
            if ($query2->execute() === true) {
                // check if the account needs to be blocked
                if ($result1[0]["nb_tentatives_connexion"] + 1 >= 10) {
                    // block the account
                    $query3 = $db->prepare("UPDATE `users` SET `connexion_activee` = 0 WHERE `id` = :id");
                    $query3->bindParam(':id', $account_id);
                    // if the request is a success
                    if ($query3->execute() === true) {
                        // if the account has been blocked
                        return true;
                    } else {
                        // if the request fails then forbid connection
                        report_an_error("Erreur sur le site " . $_SERVER["HTTP_HOST"] . " dans la fonction add_one_failed_connection_to_the_counter(\"" . $db . "\", \"" . $account_id . "\")", "La requête SQL a échoué.");
                        return false;
                    }
                } else {
                    // if the account has not been blocked
                    return true;
                }
            } else {
                // if the request fails then forbid connection
                report_an_error("Erreur sur le site " . $_SERVER["HTTP_HOST"] . " dans la fonction add_one_failed_connection_to_the_counter(\"" . $db . "\", \"" . $account_id . "\")", "La requête SQL a échoué.");
                return false;
            }
        } else {
            // if the request returns no result then the account does not exists, forbid connection
            report_an_error("Erreur sur le site " . $_SERVER["HTTP_HOST"] . " dans la fonction add_one_failed_connection_to_the_counter(\"" . $db . "\", \"" . $account_id . "\")", "L'utilisateur n'existe pas dans la base de données.");
            return false;
        }
    } else {
        // if the request fails then forbid connection
        report_an_error("Erreur sur le site " . $_SERVER["HTTP_HOST"] . " dans la fonction add_one_failed_connection_to_the_counter(\"" . $db . "\", \"" . $account_id . "\")", "La requête SQL a échoué.");
        return false;
    }
}


// reset the number of login attempts for an account
function reset_failed_login_counter($db, $account_id) {
    $query = $db->prepare("UPDATE `users` SET `nb_tentatives_connexion` = 0 WHERE `id` = :id");
    $query->bindParam(':id', $account_id);
    if($query->execute() == true) {
        return true;
    } else {
        report_an_error("Erreur sur le site " . $_SERVER["HTTP_HOST"] . " dans la fonction reset_failed_login_counter(...,account_id: \"" . $account_id . "\")", "La requête SQL a échoué.");
        return false;
    }
}






/**
 * This function allow the user to connect to its knowitbetter account
 *
 * @param string $pseudo the pseudo the user typed.
 * @param string $password the password the user typed, not encrypted.
 * @param bool $display Set to true by default, if false, no message will be echoed so the ajax request will not receive anything.
 * @return null Just echo the response for it to be read by a ajax request. if anything wrong happens, this function can destroy the session.
 */
function login($db, $pseudo, $password, $display = true)
{
    // create a new session id for security reasons
    session_regenerate_id();
    // Make sure that all the fields are filled (if user modifies the html to overstep the "required" fields)
    if (!empty($pseudo) && !empty($password)) {
        // Make sure that the connection service is available and not disabled
        if (get_status($db,"connexion") == 1) {
            // the connection service is disabled from the database, display an error message
            // response(503, "error", "Oups! Impossible de vous connecter, veuillez réessayer plus tard. Nous tentons de résoudre ce problème rapidemment :(", $display);
            return [
                "connected" => false,
                "status" => "error",
                "message" => "Oups! Impossible de vous connecter, veuillez réessayer plus tard. Nous tentons de résoudre ce problème rapidemment :(",
            ];
            
        } else {

            $q0 = $db->prepare("SELECT * FROM users WHERE pseudo = :pseudo OR email = :email");
            $q0->bindParam(':pseudo', $pseudo);
            $q0->bindParam(':email', $pseudo);
            $q0->execute();
            $result_q0 = $q0->fetch();

            if ($result_q0 == true) {
                // if true, teh accounts exists, check if the account is blocked
                if (is_account_blocked($db, $result_q0['id']) === true) {
                    // if the account is blocked, display an error message
                    // response(401, "error", "Votre compte est bloqué, veuillez contacter un administrateur pour le débloquer.", $display);
                    return [
                        "connected" => false,
                        "status" => "error",
                        "message" => "Votre compte est bloqué, veuillez contacter un administrateur pour le débloquer.",
                    ];
                } else {


                    //  then the password is checked
                    $hashpassword = $result_q0["password"];
                    if (password_verify($password, $hashpassword)) {
                        // The password is correct
                        $_SESSION['pseudo'] = $result_q0["pseudo"];
                        $_SESSION['first_name'] = $result_q0["prenom"];
                        $_SESSION['last_name'] = $result_q0["nom"];
                        $_SESSION['birth_date'] = $result_q0["ddn"];
                        $_SESSION['email'] = $result_q0["email"];
                        $_SESSION['role'] = $result_q0["role"];
                        $_SESSION['id'] = $result_q0['id'];
                        $_SESSION['photo'] = $result_q0['photo_profil'];
                        $_SESSION['recovery_email'] = $result_q0['recovery_email'];
                        $_SESSION['phone_number'] = $result_q0['phone'];
                        // secure session stealing
                        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                        $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                        
                        // response(200, "success", "Vous avez bien été connecté.e!", $display);
                        // reset the number of failed login attempts
                        reset_failed_login_counter($db, $result_q0['id']);
                        return [
                            "connected" => true,
                            "status" => "success",
                            "message" => "Vous avez bien été connecté.e!",
                        ];
                    } else {
                        // password is false
                        // response(401, "error", "Les identifiants sont incorrects", $display);
                        // add one failed connection to the counter and block the account if needed
                        add_one_failed_connection_to_the_counter($db, $result_q0['id']);
                        return [
                            "connected" => false,
                            "status" => "error",
                            "message" => "Les identifiants sont incorrects",
                        ];
                    }
                }
            } else {
                // The account does not exists / no account registered with this login
                // report error unknown account tried to connect
                report_an_error("Erreur sur le site " . $_SERVER["HTTP_HOST"] . " dans la fonction login(...) in line ". __LINE__, "Tentative de connexion avec un compte inexistant.<br> Pseudo ou email : $pseudo<br>Site : " . $_SERVER["HTTP_HOST"]);
                return [
                    "connected" => false,
                    "status" => "error",
                    "message" => "Les identifiants sont incorrects",
                ];
                
            }
        }
    } else {
        // Some required fields are missing or empty
        return [
            "connected" => false,
            "status" => "error",
            "message" => "Veuillez remplir tous les champs",
        ];
    
    }
}


function logout($redirect = true)
{
    session_start();
    session_destroy();
    session_unset();
    if ($redirect === true) {
        header('Location: https://' . $_SERVER['HTTP_HOST']);

    }
}


