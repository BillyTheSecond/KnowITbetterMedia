<?php 


function deconnexion() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_unset();
    session_destroy();
    header('Location: ' . $_SERVER["PHP_SELF"]);
    exit;
}


if (isset($_POST["form-deconnexion"]) || isset($_POST["deconnexion-button"])) {
    deconnexion();
}?>