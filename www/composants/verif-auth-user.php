<?php
// $cookie_lifetime = 7*24*60*60; // 7 jours minutes en secondes
// session_set_cookie_params($cookie_lifetime);
// session_start();
// Ce fichier requiert : database.php
// echo "fichier auth chargé";
// Vérifier que les données de l'utilisateur sont toujours correctes et que ses droits n'ont pas étés révoqués
function verif_auth_admin()
{
    // echo "Nous préparons une requête pour vérifier votre identité<br>";
    if (isset($_SESSION['id']) && isset($_SESSION['pseudo']) && isset($_SESSION['email']) && isset($_SESSION['role'])) {
        global $db;
        $verif = $db->prepare("SELECT * FROM users WHERE (id = :id AND pseudo = :pseudo AND  email = :email AND role = :role)");

        // echo "Nous exécutons la requête<br>";
        $role = $_SESSION["role"];
        if (is_array($role)) {
            $role_str = implode(",", $role);
        } else {
            $role_str = (string)$role;
        }
        $verif->execute([
            'id' => $_SESSION["id"],
            'pseudo' => $_SESSION["pseudo"],
            'email' => $_SESSION["email"],
            "role" => $role_str
        ]);
        // echo "requete exécutée<br>";
        $result_verif = $verif->rowCount();
        $role_check = $_SESSION['role'];
        if (!is_array($role_check)) {
            $role_check = [$role_check];
        }
        if ($result_verif == 1 && in_array("admin", $role_check)) {
            return true;
        } else {
            return false;
        }
    } else return false;
}

function verif_auth_user()
{
    // echo "Nous préparons une requête pour vérifier votre identité<br>";
    if (isset($_SESSION["id"])) {


        global $db;
        $verif = $db->prepare("SELECT * FROM users WHERE (id = :id AND pseudo = :pseudo AND  email = :email AND role = :role)");

        // echo "Nous exécutons la requête<br>";
        $role = $_SESSION["role"];
        if (is_array($role)) {
            $role_str = implode(",", $role);
        } else {
            $role_str = (string)$role;
        }
        $verif->execute([
            'id' => $_SESSION["id"],
            'pseudo' => $_SESSION["pseudo"],
            'email' => $_SESSION["email"],
            "role" => $role_str
        ]);
        // echo "requete exécutée<br>";
        $result_verif = $verif->rowCount();
        if ($result_verif == 1) {
            // echo "verif finie OK";
            return true;
        } else {
            // echo "verif finie BAD";
            session_destroy();
            session_unset();
            return false;
        }
    } else {
        return false;
    }
}
