<?php
session_start();
include '../../database.php';
include 'functions.php';
include '../get_status.php';
include '../verif-auth-user.php';
include "../code_verif.php";
include "../mail.php";

// CHANGER D EMAIL ETAPE 1 (EMAIL TEMPORAIRE, ENVOI CODE VERIFICATION)
// Vérifier si le formulaire a été soumis 
if (isset($_POST["email"]) && isset($_POST["email_confirmation"])) {
    if (!empty($_POST["email"]) && !empty($_POST["email_confirmation"])) {

        extract($_POST);
        sendCodeToChangeEmail($email, $email_confirmation);
    } else {
        echo ("error,Veuillez remplir tous les champs.");
    }
}

// ETAPE 2 VERIFICATION CODE VERIF ENREGISTREMENT EMAIL
// Vérifier si le formulaire a été soumis
if (isset($_POST["code_verif"])) {
    if (!empty($_POST["code_verif"])) {

        extract($_POST);
        verifyCodeAndChangeEmail($code_verif);
    } else {
        echo ("error,Vous n'avez renseigné aucun code.");
    }
}

