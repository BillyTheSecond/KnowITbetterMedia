<?php
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);

// Harmonisation de la gestion des cookies de session
$cookie_lifetime = 30 * 24 * 60 * 60; // 30 jours
$params = [
    'lifetime' => $cookie_lifetime,
    'path' => '/',
    'httponly' => true,
    'samesite' => 'Lax',
];
if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === 'localhost:8081') {
    $params['secure'] = false;
    // Pas de domain en local
} else {
    $params['secure'] = true;
    $params['domain'] = '.knowitbetter.fr';
    $params['samesite'] = 'Strict';
}
if (PHP_VERSION_ID >= 70300) {
    session_set_cookie_params($params);
} else {
    session_set_cookie_params(
        $params['lifetime'],
        $params['path'],
        isset($params['domain']) ? $params['domain'] : '',
        $params['secure'],
        $params['httponly']
    );
}
session_start();
include __DIR__."/database.php";
include __DIR__."/composants/verif-auth-user.php";
include __DIR__."/composants/get_status.php";
include __DIR__."/composants/login.php";
include __DIR__."/composants/signin.php";
include __DIR__."/composants/logout.php";
include __DIR__."/composants/ajax/functions.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include "composants/analytics.php"; ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title><?php if (verif_auth_user()) {
                echo 'Votre compte KnowITbetter';
            } else {
                echo 'Connectez-vous à votre compte KnowITbetter';
            } ?></title>
    <link rel="shortcut icon" href="./images/logo/favicon.ico" type="image/x-icon">
    <!-- Details site -->
    <meta name="description" content="Connectez-vous à votre compte KnowITbetter - Créez un compte - Accédez à vos enregistrements">
    <Meta name="robots" content="index, follow" />
    <meta http-equiv="Cache-Control" content="private, max-age=259200, must-revalidate" />



    <!-- apple -->
    <meta name="format-detection" content="telephone=no">
    <meta name="og:title" content="Accédez à votre compte KnowITbetter">
    <meta name="og:image" content="../images/logo/logo-texte-noir.png">
    <link rel="apple-touch-icon" href="../images/logo/logocarrehd.webp">


    <!-- CSS -->
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/navigation-bar.css">
    <link rel="stylesheet" href="../css/style-apercu-articles.css">

    <!-- Kit Fontawesome et cookies-->
    <?php include "./composants/fontawesome_kit.php"; ?>

    <!-- apple -->
    <meta name="theme-color" content="#F8B432">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- scripts -->
    <script src="script/fonctionnalites.js"></script>

</head>

<body>
    <?php
    include './composants/navigation-bar.php';
    echo $navigation_bar;
    ?>


    <?php
    // ETAPE 1: VERIFIER QUE L'UTILISATEUR SOIT CONNECTE
    // SINON--> afficher le menu de connexion / de création de compte.

    // vérifier que la session existe
    if (isset($_SESSION["id"]) && !empty($_SESSION["pseudo"]) && verif_auth_user()) {
        // echo "La session existe";
        // vérifier que l'utilisateur ne soit pas un imposteur
        // echo "L'utilisateur est correctement authentifié";
        // afficher les paramètres
        // A REFLECHIR /
        //  - mettre à jour l'url sans rafraichir [CANCEL : NE PAS METTRE A JOUR L'URL]
        // - sur ordinateur: garder le menu de gauche et mettre à jour l'iframe de droite
        //   - modifier l'url de l'iframe en javascript 
        //  - 
    ?>
        <!-- les frames -->

        <style>
            div.ligne-parametre {
                display: flex;
                flex-direction: row;
                flex-wrap: nowrap;
                align-items: center;
                /* border-top: solid 1px #E5E5E5; */
                border-bottom: solid 1px #E5E5E5;
                cursor: pointer;
                padding: 10px 15px;
                tabindex: 0;
            }

            div.ligne-parametre i {
                padding-left: 5px;
            }

            div.ligne-parametre p.option-preview {
                color: #808080;
                -webkit-line-clamp: 1;
                text-overflow: ellipsis;
                -webkit-box-orient: vertical;
                display: -webkit-box;
                overflow: hidden;

            }

            div.ligne-parametre.top {
                border-top: solid 1px #E5E5E5;
            }

            div.ligne-parametre.bottom {
                /* border-bottom: solid 2px #E5E5E5; */
            }

            div.ligne-parametre p.ligne-parametre-texte {
                flex: 1;
            }

            div.ligne-parametre p.ligne-parametre-texte.historique {
                -webkit-line-clamp: 1;
                text-overflow: ellipsis;
                -webkit-box-orient: vertical;
                display: -webkit-box;
                overflow: hidden;
                margin-right: 20px;
            }

            /* profil affichage */
            div#details-profil-container {
                display: flex;
                flex-direction: row;
                flex-wrap: nowrap;
                align-items: center;
            }

            div#details-profil-container img#photo-de-profil {
                height: 100px;
                aspect-ratio: 1;
                border-radius: 100px;
                /* width: 100%; */
                margin: 15px;
            }


            /* titres des sections de paramètres */
            h3.section-parametres {
                text-transform: uppercase;
                color: #808080;
                padding: 0 15px;
                font-size: 14px;
                margin-top: 32px;

            }

            .red {
                color: #FF1800;
            }

            p.params-text {
                margin: 6px 15px;
                font-size: 16px;
            }

            div#details-profil {
                overflow: hidden;
            }

            p#details-profil-email,
            #details-profil-nom-compte {
                -webkit-line-clamp: 1;
                text-overflow: ellipsis;
                -webkit-box-orient: vertical;
                display: -webkit-box;
                overflow: hidden;
            }

            /* GESTION DES FRAMES */
            div#frame-container {
                position: relative;
                overflow: hidden;
                min-height: 100%;
            }

            div.frame {
                position: absolute;
                overflow-y: auto;
                overflow-x: hidden;
                transition-duration: 0.2s;
                background-color: white;
                padding-left: env(safe-area-inset-left);
                padding-right: env(safe-area-inset-right);

            }

            div.frame.niveauA {
                z-index: 1;

            }

            div.frame.niveauB {
                z-index: 2
            }

            div.frame.niveauC {
                z-index: 3
            }

            div.frame.niveauD {
                z-index: 4
            }

            div.titre-frame-container {
                display: flex;
                flex-direction: row;
                flex-wrap: nowrap;
                align-items: center;
                font-size: 20px;
                padding-top: 12px;
                padding-bottom: 12px;
                position: sticky;
                top: 0;
                backdrop-filter: blur(40px);
                -webkit-backdrop-filter: blur(40px);
                cursor: pointer;

            }


            div.titre-frame-container i {
                padding: 5px 10px;
                cursor: pointer;
            }

            div.element-aime {
                border: 3px solid #E9E9E9;
                display: flex;
                flex-direction: row;
                flex-wrap: nowrap;
                padding: 9px;
                border-radius: 24px;
                align-items: center;
                margin: 4px 15px;

            }

            .element-aime.deleted,
            .element-enregistre.deleted,
            div.deleted {
                height: 0px;
                padding: 0px;
                margin-top: 0px;
                margin-bottom: 0px;
                overflow: hidden;
                border: none;
                visibility: hidden;
            }

            div.element-aime div.illustration {
                aspect-ratio: 1;
                height: 50px;
                background-position: center;
                background-size: cover;
                border-radius: 14px;
                margin-right: 9px;
                align-self: baseline;

            }

            div.element-aime a.titre-article {
                font-size: 16px;
                text-align: left;
                flex: 1;
                display: block;

            }

            div.element-aime i {
                font-size: 24px;
                color: #CCCCCC;
                margin-right: 9px;
                cursor: pointer;
                transform: scale(0.9);
            }

            div.element-aime i:hover {
                color: #FF1800;
                transform: scale(1);
            }

            div.element-aime i:active {
                color: #FF1800;
                transform: scale(0.95);

            }






            /* ordinateurs et tablettes */
            @media (min-width : 850px) {
                div.frame {
                    width: calc(100% - 400px);
                    height: 100%;

                }

                div.frame.niveauA {
                    position: static;
                    width: 400px;
                    border-right: solid 2px #E5E5E5;
                    height: calc(100vh - 50px);

                }

                div.frame.niveauB,
                div.frame.niveauC,
                div.frame.niveauD {
                    right: calc(-100% + 400px);
                    top: 0;
                }

                div.frame.niveauB.show,
                div.frame.niveauC.show,
                div.frame.niveauD.show {
                    right: 0;
                    top: 0;
                }

            }


            /* mobiles */
            @media (max-width : 850px) {
                div.frame {
                    width: 100%;
                    height: 100%;
                }

                div.frame.niveauA {
                    position: static;
                }

                div.frame.niveauB,
                div.frame.niveauC,
                div.frame.niveauD {
                    right: -100%;
                    top: 0;
                }

                div.frame.niveauB.show,
                div.frame.niveauC.show,
                div.frame.niveauD.show {
                    right: 0;
                    top: 0;
                }

            }
        </style>

        <?php
        // obtenir les informations de l'utilisateur
        $user = $db->query("SELECT pseudo,email,date,role,nom,prenom,ddn,montrer_email,photo_profil,citation FROM users WHERE pseudo = '" . $_SESSION["pseudo"] . "'");
        $user = $user->fetch();

        ?>

        <div id="frame-container">
            <div class="frame niveauA" id="parametres">
                <div id="details-profil-container">
                    <img src="<?php if (!empty($user["photo_profil"])) {
                                    echo $user["photo_profil"];
                                } else {
                                    echo "/images/profil/default.svg";
                                } ?>" alt="" id="photo-de-profil">
                    <div id="details-profil">
                        <h2 id="details-profil-nom-compte" <?php if (!empty($user["prenom"]) && !empty($user["nom"])) {
                                                                echo "class='nom-prenom'";
                                                            } else {
                                                                echo "class='nom-pseudo'";
                                                            } ?>><?php if (!empty($user["prenom"]) && !empty($user["nom"])) {
                                                                        echo $user["prenom"] . " " . $user["nom"];
                                                                    } else {
                                                                        echo $user["pseudo"];
                                                                    } ?></h2>
                        <p id="details-profil-email"><?php if (!empty($user["email"])) {
                                                            echo $user["email"];
                                                        } ?></p>
                    </div>
                </div>
                <h3 class="section-parametres">Paramètres généraux</h3>
                <div class="ligne-parametre top" onclick="ouvrirLaPage('mon-compte')" tabindex=0>
                    <p class="ligne-parametre-texte">Gérer mon compte</p>
                    <i class="fa-solid fa-chevron-right ligne-parametre-icon"></i>
                </div>
                <div class="ligne-parametre bottom" tabindex=0>
                    <p class="ligne-parametre-texte" onclick="ouvrirLaPage('profil-public')">Gérer mon profil public</p>
                    <i class="fa-solid fa-chevron-right ligne-parametre-icon"></i>
                </div>

                <h3 class="section-parametres">Favoris</h3>
                <div class="ligne-parametre top" tabindex=0 onclick="ouvrirLaPage('coups-de-coeur')">
                    <p class="ligne-parametre-texte">Coups de coeur</p>
                    <i class="fa-solid fa-chevron-right ligne-parametre-icon"></i>
                </div>
                <div class="ligne-parametre" tabindex=0 onclick="ouvrirLaPage('enregistrements')">
                    <p class="ligne-parametre-texte">Enregistrements</p>
                    <i class="fa-solid fa-chevron-right ligne-parametre-icon"></i>
                </div>
                <?php
                // si la consultation de l'historique est activée
                if (get_status("historique") != 1) {
                ?>
                    <div class="ligne-parametre bottom" tabindex=0 onclick="ouvrirLaPage('historique')">
                        <p class="ligne-parametre-texte">Historique de navigation</p>
                        <i class="fa-solid fa-chevron-right ligne-parametre-icon"></i>
                    </div>
                <?php
                }
                ?>

                <h3 class="section-parametres">Mes services</h3>
                <div class="ligne-parametre top" tabindex=0 onclick="window.open('https://webdev.knowitbetter.fr','_blank')">
                    <p class="ligne-parametre-texte">KnowITbetter Web Development</p>
                    <i class="fa-solid fa-arrow-up-right-from-square ligne-parametre-icon"></i>
                </div>
                <?php if (verif_auth_admin()) {
                ?>
                    <div class="ligne-parametre top" tabindex=0 onclick="window.open('https://<?= $_SERVER['HTTP_HOST']; ?>/administration.php','_blank')">
                        <p class="ligne-parametre-texte">Administration du site</p>
                        <i class="fa-solid fa-arrow-up-right-from-square ligne-parametre-icon"></i>
                    </div>
                    <!-- <div class="ligne-parametre" tabindex=0>
                    <p class="ligne-parametre-texte">Statistiques</p>
                    <i class="fa-solid fa-arrow-up-right-from-square ligne-parametre-icon"></i>
                </div> -->
                <?php
                }
                ?>
                <div class="ligne-parametre bottom" tabindex=0 onclick="window.open('https://<?= $_SERVER['HTTP_HOST']; ?>/etat-des-services','_blank')">
                    <p class="ligne-parametre-texte">Etat des services</p>
                    <i class="fa-solid fa-arrow-up-right-from-square ligne-parametre-icon"></i>
                </div>

                <h3 class="section-parametres">Autres</h3>
                <div class="ligne-parametre top bottom red" tabindex=0>
                    <p class="ligne-parametre-texte" onclick="document.getElementById('form-deconnexion').submit()">Déconnexion</p>
                    <form method="post" action="" id="form-deconnexion">
                        <input type="hidden" name="deconnexion-button" id="" value=1>
                    </form>
                    <i class="fa-solid fa-arrow-right-from-bracket ligne-parametre-icon"></i>
                </div>

            </div>
            <!-- elements de la section "mon compte" -->
            <div class="frame niveauB" id="mon-compte">
                <div class="titre-frame-container" onclick="ouvrirLaPage('parametres')">
                    <i class="fa-solid fa-chevron-left"></i>
                    <h2 class="titre-frame">Gérer mon compte</h2>
                </div>
                <h3 class="section-parametres">Modifier mes informations</h3>
                <div class="ligne-parametre top" onclick="ouvrirLaPage('modifier-email-1')" tabindex=0>
                    <p class="ligne-parametre-texte">Modifier l'adresse email</p>
                    <i class="fa-solid fa-chevron-right ligne-parametre-icon"></i>
                </div>
                <div class="ligne-parametre " tabindex=0 onclick="ouvrirLaPage('modifier-nom-prenom')">
                    <p class="ligne-parametre-texte">Modifier le Prénom et le Nom</p>
                    <i class="fa-solid fa-chevron-right ligne-parametre-icon"></i>
                </div>
                <div class="ligne-parametre " tabindex=0 onclick="ouvrirLaPage('modifier-ddn')">
                    <p class="ligne-parametre-texte">Modifier la date de naissance</p>
                    <p class="option-preview" id="preview-ddn"><?= str_replace("-", "/", date("d-m-Y", strtotime($user['ddn']))); ?></p>

                    <i class="fa-solid fa-chevron-right ligne-parametre-icon"></i>
                </div>
                <div class="ligne-parametre bottom" tabindex=0 onclick="ouvrirLaPage('modifier-mdp')">
                    <p class="ligne-parametre-texte">Changer le mot de passe</p>
                    <i class="fa-solid fa-chevron-right ligne-parametre-icon"></i>
                </div>

                <h3 class="section-parametres">Gérer mes données</h3>
                <div class="ligne-parametre top" tabindex=0 onclick="ouvrirLaPage('telecharger-mes-donnees')">
                    <p class="ligne-parametre-texte">Télécharger mes données (.zip)</p>
                    <i class="fa-solid fa-chevron-right ligne-parametre-icon"></i>
                </div>
                <div class="ligne-parametre bottom red" tabindex=0 onclick="ouvrirLaPage('suppression-compte-1')">
                    <p class="ligne-parametre-texte">Supprimer mon compte</p>
                    <i class="fa-solid fa-chevron-right ligne-parametre-icon"></i>
                </div>


            </div>

            <div class="frame niveauC" id="modifier-email-1">
                <div class="titre-frame-container" onclick="ouvrirLaPage('mon-compte')">
                    <i class="fa-solid fa-chevron-left"></i>
                    <h2 class="titre-frame">Modifier l'adresse email</h2>
                </div>
                <h3 class="section-parametres">Votre adresse email actuelle</h3>
                <div class="ligne-parametre top">
                    <p id="email-actuel" class="ligne-parametre-texte"><?= $user["email"]; ?></p>
                </div>
                <h3 class="section-parametres">Saisissez une nouvelle adresse email</h3>
                <form id="formulaire-modifier-email" name="formulaire-modifier-email" method="post" action="">
                    <input type="text" name="email" id="modif-email-input1" placeholder="Votre email" required>
                    <input type="text" name="email_confirmation" id="modif-email-input2" placeholder="Confirmez votre email" required>
                    <a onclick="$('#formulaire-modifier-email').submit()" class="theme"><i class="fa-solid fa-arrow-right bouton-icon"></i>Suivant</a>
                </form>

                <script>
                    $('#formulaire-modifier-email').submit(function(e) {
                        e.preventDefault(); // Empêche le comportement par défaut du formulaire (rafraîchissement de la page, envoi...)

                        var email1 = $('#modif-email-input1').val();
                        var email2 = $('#modif-email-input2').val();

                        var formData = {
                            email: email1,
                            email_confirmation: email2
                        };

                        $.ajax({
                            url: 'composants/ajax/modifier_email.php',
                            type: 'POST',
                            data: formData,
                            success: function(data) {
                                // Gérer la réponse du serveur
                                console.log('Réponse du serveur : ' + data);
                                data = data.split(",");
                                console.log(data);

                                if (data[0] == "error") {
                                    // message d'erreur avec data[1]
                                    afficherAlerte("Une erreur est survenue", data[1], 10000, "error");
                                } else if (data[0] == "success") {
                                    afficherAlerte("Un mail vous a été envoyé", data[1], 7000, "info");
                                    // Changer l'email de la page email 2 ('votre nouvel adresse: abb@xyz.com')
                                    document.getElementById("nouvel-email").innerHTML = data[2];

                                    ouvrirLaPage('modifier-email-2');
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                // Gérer l'erreur
                                console.log('Erreur : ' + textStatus + ' - ' + errorThrown);
                            }
                        });
                    });
                </script>
            </div>


            <div class="frame niveauD" id="modifier-email-2">
                <div class="titre-frame-container" onclick="ouvrirLaPage('modifier-email-1')">
                    <i class="fa-solid fa-chevron-left"></i>
                    <h2 class="titre-frame">Confirmez l'adresse email</h2>
                </div>
                <h3 class="section-parametres">Saisissez le code reçu à <span id="nouvel-email"></span></h3>
                <form id="formulaire-modifier-email-2" name="formulaire-modifier-email-2" method="post" action="">
                    <input type="text" name="code" id="code" placeholder="XXXXXX">
                    <a onclick="$('#formulaire-modifier-email-2').submit()" class="theme"><i class="fa-solid fa-arrow-right bouton-icon"></i>Enregistrer</a>

                </form>


                <script>
                    $('#formulaire-modifier-email-2').submit(function(e) {
                        e.preventDefault(); // Empêche le comportement par défaut du formulaire (rafraîchissement de la page, envoi...)

                        var code_verif = $('#code').val();

                        var formData = {
                            code_verif: code_verif
                        };

                        $.ajax({
                            url: 'composants/ajax/modifier_email.php',
                            type: 'POST',
                            data: formData,
                            success: function(data) {
                                // Gérer la réponse du serveur
                                console.log('Réponse du serveur : ' + data);
                                data = data.split(",");
                                console.log(data);

                                if (data[0] == "error") {
                                    // message d'erreur avec data[1]
                                    afficherAlerte("Erreur", data[1], 10000, "error");

                                } else if (data[0] == "success") {
                                    // Afficher le message de succès
                                    afficherAlerte("😎", data[1], 7000, "info");

                                    // Changer l'email de la page email 2 ('votre nouvel adresse: abb@xyz.com')
                                    document.getElementById("email-actuel").innerHTML = data[2];
                                    document.getElementById("modif-email-input1").value = "";
                                    document.getElementById("modif-email-input2").value = "";

                                    ouvrirLaPage('modifier-email-1');
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                // Gérer l'erreur
                                afficherAlerte("Une erreur est survenue de notre coté", "Nous en sommes désolés. Si l'erreur persiste, veuillez nous contacter.", 10000, "error");

                                console.log('Erreur : ' + textStatus + ' - ' + errorThrown);
                            }
                        });
                    });
                </script>


            </div>

            <div class="frame niveauC" id="modifier-ddn">
                <div class="titre-frame-container" onclick="ouvrirLaPage('mon-compte')">
                    <i class="fa-solid fa-chevron-left"></i>
                    <h2 class="titre-frame">Modifier la date de naissance</h2>
                </div>
                <h3 class="section-parametres">Saisissez votre date de naissance</h3>
                <form id="formulaire-modifier-ddn" name="formulaire-modifier-ddn" method="post" action="">
                    <input type="date" name="ddn" id="input-ddn" value="<?= $user['ddn']; ?>">
                    <a onclick="$('#formulaire-modifier-ddn').submit();" class="theme"><i class="fa-solid fa-arrow-right bouton-icon"></i>Enregistrer</a>
                    <input type="submit" value="" style="display:none;">

                </form>
                <script>
                    $(document).ready(function() {
                        $('#formulaire-modifier-ddn').submit(function(e) {
                            e.preventDefault(); // empêche le comportement par défault du formulaire (raifraichissemrnt page, envoi...)
                            var newDate = $('#input-ddn').val();
                            var formData = {
                                ddn: newDate
                            };
                            $.ajax({
                                url: 'composants/ajax/modifier_ddn.php',
                                type: 'POST',
                                data: formData,
                                success: function(data) {
                                    // Handle the server response
                                    console.log('Réponse du serveur : ' + data);
                                    data = data.split(",");
                                    console.log(data);

                                    if (data[0] == "error") {
                                        // Revenir à la date initiale
                                        document.getElementById("input-ddn").value = data[2];
                                        // Show error message
                                        afficherAlerte("Oups, quelque chose ne s'est pas passé comme prévu", data[1], 10000, "error");
                                    } else if (data[0] == "success") {
                                        // Show success message
                                        afficherAlerte("Nouvelle date de naissance enregistrée", data[1], 7000, "info");

                                        // Mettre à jour la date
                                        document.getElementById("input-ddn").value = data[2];

                                        // Mettre à jour la date en la reformatant (elle est recue comme ceci: aaaa-mm-jj et on la veut en jj/mm/aaaa)
                                        tableau_date = data[2].split("-");
                                        french_date = tableau_date[2] + "/" + tableau_date[1] + "/" + tableau_date[0]
                                        $('#preview-ddn').text(french_date);
                                        ouvrirLaPage('mon-compte');
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    // Handle the error
                                    console.log('Erreur : ' + textStatus + ' - ' + errorThrown);
                                }
                            });
                        });
                    });
                </script>


            </div>

            <div class="frame niveauC" id="modifier-nom-prenom">
                <div class="titre-frame-container" onclick="ouvrirLaPage('mon-compte')">
                    <i class="fa-solid fa-chevron-left"></i>
                    <h2 class="titre-frame">Modifier le nom et le prénom</h2>
                </div>
                <form name="formulaire-modifier-nom-prenom" id="formulaire-modifier-nom-prenom" action="" method="post">
                    <h3 class="section-parametres">Saisissez votre prénom</h3>
                    <input type="text" name="modifier_prenom" id="input_modifier_prenom" id="prénom" placeholder="Jean-Marc" value="<?= $user['prenom'] ?>" required>
                    <h3 class="section-parametres">Saisissez votre nom</h3>
                    <input type="text" name="modifier_nom" id="input_modifier_nom" placeholder="Jancovici" value="<?= $user['nom'] ?>" required>

                    <input type="submit" value="Enregistrer" style="display: none;">
                </form>
                <a onclick="$('#formulaire-modifier-nom-prenom').submit();" class="theme"><i class="fa-solid fa-arrow-right bouton-icon"></i>Enregistrer</a>

                <script>
                    $(document).ready(function() {
                        $('#formulaire-modifier-nom-prenom').submit(function(e) {
                            e.preventDefault(); // empêche le rafraîchissement de la page
                            $.ajax({
                                url: 'composants/ajax/modifier_profil.php',
                                type: 'POST',
                                data: $(this).serialize(),
                                success: function(data) {
                                    // gère la réponse du serveur ici
                                    console.log('Réponse du serveur : ' + data);
                                    data = data.split(",");
                                    console.log(data);
                                    if (data[0] == "error") {
                                        // afficher message d'erreur
                                        afficherAlerte("Une erreur est survenue", data[1], 7000, "error");

                                    } else if (data[0] == "success") {
                                        // afficher message de succès
                                        afficherAlerte("On a bien enregistré ce changement!", data[1], 7000, "info");
                                        // mettre à jour les informations de pseudo
                                        ouvrirLaPage("mon-compte");
                                        // document.getElementById("preview-pseudo").innerHTML = data[2]." ".data[3];
                                        document.getElementById("input_modifier_prenom").value = data[2];
                                        document.getElementById("input_modifier_nom").value = data[3];
                                        if (document.getElementById("details-profil-nom-compte").classList.contains("nom-prenom")) {
                                            document.getElementById("details-profil-nom-compte").innerHTML = data[2] + " " + data[3];

                                        }
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    // gère l'erreur ici
                                    console.log('Erreur : ' + textStatus + ' - ' + errorThrown);
                                }
                            });
                        });
                    });
                </script>


            </div>

            <div class="frame niveauC" id="modifier-mdp">
                <div class="titre-frame-container" onclick="ouvrirLaPage('mon-compte')">
                    <i class="fa-solid fa-chevron-left"></i>
                    <h2 class="titre-frame">Modifier le mot de passe</h2>
                </div>
                <form action="">
                    <h3 class="section-parametres">Saisissez votre mot de passe actuel</h3>
                    <input type="password" name="mdp_actuel" id="mdp_actuel" placeholder="Mot de passe actuel">
                    <h3 class="section-parametres">Créez un nouveau mot de passe</h3>
                    <input type="password" name="mdp_nouveau" id="mdp_nouveau" placeholder="Nouveau mot de passe" required>
                    <input type="password" name="mdp_nouveau_confirmation" id="mdp_nouveau_confirmation" placeholder="Confirmation du nouveau mot de passe" required>


                    <a onclick="changeUserPassword();" class="theme"><i class="fa-solid fa-arrow-right bouton-icon"></i>Enregistrer</a>

                </form>
                <script>
                    // function which sends a request to change the user's password
                    function changeUserPassword() {
                        formData = {
                            "user_password": document.getElementById("mdp_actuel").value,
                            "new_password1": document.getElementById("mdp_nouveau").value,
                            "new_password2": document.getElementById("mdp_nouveau_confirmation").value,
                        };

                        $.ajax({
                            url: '/composants/ajax/modifier_mdp.php',
                            type: 'POST',
                            data: formData,
                            success: function(data) {
                                // Gérer la réponse du serveur
                                data = data.split(";");

                                console.log('Réponse du serveur : ' + data);
                                if (data[1] == "success") {
                                    document.getElementById("mdp_actuel").value = "";
                                    document.getElementById("mdp_nouveau").value = "";
                                    document.getElementById("mdp_nouveau_confirmation").value = "";
                                    ouvrirLaPage('mon-compte');

                                } else if (data[1] == "error") {
                                    afficherAlerte("Erreur", data[2], 7000, "error");
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                // Gérer l'erreur
                                afficherAlerte("😕 Oups, quelque chose ne fonctionne plus", "Erreur inconnue, contactez <a href='mailto:webdev@knowitbetter.fr'>webdev@knowitbetter.fr</a> si le problème persiste", 30000, "error", displayAlert);
                                console.log('Erreur : ' + textStatus + ' - ' + errorThrown);
                            }
                        });
                    }
                </script>


            </div>

            <div class="frame niveauC" id="telecharger-mes-donnees">
                <div class="titre-frame-container" onclick="ouvrirLaPage('mon-compte')">
                    <i class="fa-solid fa-chevron-left"></i>
                    <h2 class="titre-frame">Téléchargez-vos données</h2>
                </div>
                <p class="params-text">Conformément à l’article 20 de la RGPD, vous pouvez télécharger une archive contenant toutes vos données personnelles.</p>
                <a href="/composants/download-user-data.php" class="theme"><i class="fa-solid fa-arrow-right bouton-icon"></i>Téléchargez une copie de vos données</a>




            </div>
            <div class="frame niveauC" id="suppression-compte-1">
                <div class="titre-frame-container" onclick="ouvrirLaPage('mon-compte')">
                    <i class="fa-solid fa-chevron-left"></i>
                    <h2 class="titre-frame">Supprimer mon compte</h2>
                </div>
                <p class="params-text">Conformément à l’article 20 de la RGPD, vous pouvez supprimer votre compte et toutes les données personnelles associées.</p>
                <div style="margin:15px;">
                    <h3>Toutes vos données seront supprimées dont les suivantes:</h3>
                    <ul>
                        <li>Vos coordonnées</li>
                        <li>Les articles que vous avez enregistrés</li>
                        <li>Les articles que vous avez enregistrés dans vos favoris</li>
                        <li>Votre historique de lecture</li>
                        <li>Votre profil public KnowITbetter</li>
                        <li>Votre photo de profil (si vous en avez une)</li>
                    </ul>
                    <h3>Vos données de KnowITbetter Web Developement seront également supprimées</h3>
                    <ul>
                        <li>Vos projets brouillons</li>
                        <li>Les documents que vous avez reçus et que vous avez publiés y compris les factures [<?= formatBytes(getFolderSize("/home/knowitc/www/webdev/userfiles/" . $_SESSION["id"] . "/")); ?>]</li>
                        <b>NOTE: Il vous sera impossible de supprimer votre compte si vous avez un en projet en cours</b>
                    </ul>
                </div>
                <a class="theme red" onclick="sendCodeToDeleteAccount()"><i class="fa-solid fa-arrow-right bouton-icon"></i>Supprimez votre compte</a>

                <script>
                    // function used to disconnect a user
                    function sendCodeToDeleteAccount() {
                        formData = {
                            "send-code-delete-account": true,
                        };

                        $.ajax({
                            url: '/composants/ajax/supprimer_compte.php',
                            type: 'POST',
                            data: formData,
                            success: function(data) {
                                // Gérer la réponse du serveur
                                data = data.split(";");

                                console.log('Réponse du serveur : ' + data);
                                if (data[1] == "success") {
                                    ouvrirLaPage('suppression-compte-2');

                                } else if (data[1] == "error") {
                                    afficherAlerte("Erreur", data[2], 7000, "error");
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                // Gérer l'erreur
                                afficherAlerte("😕 Oups, quelque chose ne fonctionne plus", "Erreur inconnue, contactez <a href='mailto:webdev@knowitbetter.fr'>webdev@knowitbetter.fr</a> si le problème persiste", 30000, "error", displayAlert);
                                console.log('Erreur : ' + textStatus + ' - ' + errorThrown);
                            }
                        });
                    }
                </script>



            </div>
            <div class="frame niveauD" id="suppression-compte-2">
                <div class="titre-frame-container" onclick="ouvrirLaPage('suppression-compte-1')">
                    <i class="fa-solid fa-chevron-left"></i>
                    <h2 class="titre-frame">Confirmez la suppression de votre compte</h2>
                </div>
                <p class="params-text">Cette opération est irréversible et immédiate. Aucune donnée ne pourra être récupérée par la suite.</p>
                <form action="">
                    <h3 class="section-parametres">Saisissez le code reçu par mail</h3>
                    <input type="text" name="code-confirmation" id="code-confirmation" placeholder="AA-00-00" required>
                    <a onclick="deleteAccount($('#code-confirmation').val())" class="theme red"><i class="fa-solid fa-arrow-right bouton-icon"></i>Supprimez définitivement votre compte</a>

                </form>
                <script>
                    // function used to disconnect a user
                    function deleteAccount($code) {
                        formData = {
                            "code-delete-account": $code,
                        };

                        $.ajax({
                            url: '/composants/ajax/supprimer_compte.php',
                            type: 'POST',
                            data: formData,
                            success: function(data) {
                                // Gérer la réponse du serveur
                                data = data.split(";");

                                console.log('Réponse du serveur : ' + data);
                                if (data[1] == "success") {
                                    document.location.reload();

                                } else if (data[1] == "error") {
                                    afficherAlerte("Erreur", data[2], 7000, "error");
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                // Gérer l'erreur
                                afficherAlerte("😕 Oups, quelque chose ne fonctionne plus", "Erreur inconnue, contactez <a href='mailto:webdev@knowitbetter.fr'>webdev@knowitbetter.fr</a> si le problème persiste", 30000, "error", displayAlert);
                                console.log('Erreur : ' + textStatus + ' - ' + errorThrown);
                            }
                        });
                    }
                </script>



            </div>





            <!-- elements de la section "profil public" -->
            <div class="frame niveauB" id="profil-public">
                <div class="titre-frame-container" onclick="ouvrirLaPage('parametres')">
                    <i class="fa-solid fa-chevron-left"></i>
                    <h2 class="titre-frame">Mon profil public</h2>
                </div>
                <h3 class="section-parametres">Confidentialité</h3>
                <div class="ligne-parametre top" onclick="ouvrirLaPage('montrer-email')" tabindex=0>
                    <p class="ligne-parametre-texte">Montrer l'email</p>
                    <p class="option-preview" id="montrer-mail-preview"><?php if ($user["montrer_email"] == 0) {
                                                                            echo "Non";
                                                                        } else if ($user["montrer_email"] == 1) {
                                                                            echo "Oui";
                                                                        } else {
                                                                            echo "?";
                                                                        } ?></p>
                    <i class="fa-solid fa-chevron-right ligne-parametre-icon"></i>
                </div>
                <div class="ligne-parametre " tabindex=0 onclick="ouvrirLaPage('modifier-pseudo')">
                    <p class="ligne-parametre-texte">Mon pseudo</p>
                    <p class="option-preview" id="preview-pseudo"><?= $user["pseudo"] ?></p>
                    <i class="fa-solid fa-chevron-right ligne-parametre-icon"></i>
                </div>
                <div class="ligne-parametre " tabindex=0>
                    <p class="ligne-parametre-texte">Photo de profil</p>
                    <p class="option-preview">Bientôt...</p>
                    <i class="fa-solid fa-chevron-right ligne-parametre-icon"></i>
                </div>
                <div class="ligne-parametre bottom" tabindex=0 onclick="ouvrirLaPage('modifier-citation')">
                    <p class="ligne-parametre-texte">Citation</p>
                    <p class="option-preview" id="preview-citation"><?php if (strlen($user["citation"]) == 0) {
                                                                        echo "Non";
                                                                    } else {
                                                                        echo "Oui";
                                                                    } ?></p>
                    <i class="fa-solid fa-chevron-right ligne-parametre-icon"></i>
                </div>

                <h3 class="section-parametres">Mon profil public</h3>
                <div class="ligne-parametre top" tabindex=0>
                    <p class="ligne-parametre-texte" onclick="window.open('https://<?= $_SERVER['HTTP_HOST']; ?>/users?id=<?= $_SESSION["id"]; ?>','_blank')">Voir mon profil public</p>
                    <i class="fa-solid fa-arrow-up-right-from-square ligne-parametre-icon"></i>
                </div>



            </div>

            <div class="frame niveauC" id="montrer-email">
                <div class="titre-frame-container" onclick="ouvrirLaPage('profil-public')">
                    <i class="fa-solid fa-chevron-left"></i>
                    <h2 class="titre-frame">Montrer mon email</h2>
                </div>
                <div class="ligne-parametre bottom" tabindex=0>
                    <p class="ligne-parametre-texte">Montrer mon email sur mon profil public</p>
                    <form id="formulaire-montrer-email" method="post" action="">
                        <input type="checkbox" name="montrer_mail" value="1" onclick="$('#formulaire-montrer-email').submit()" id="input-montrer-email" <?php if ($user["montrer_email"] == 0) {
                                                                                                                                                            echo "";
                                                                                                                                                        } else {
                                                                                                                                                            echo "checked";
                                                                                                                                                        } ?>>
                        <label for="input-montrer-email"></label>
                    </form>
                    <script>
                        $(document).ready(function() {
                            $('#formulaire-montrer-email').submit(function(e) {
                                e.preventDefault(); // empêche le rafraîchissement de la page
                                $.ajax({
                                    url: 'composants/ajax/montrer_email.php',
                                    type: 'POST',
                                    data: $(this).serialize(),
                                    success: function(data) {
                                        // gère la réponse du serveur ici
                                        console.log('Réponse du serveur : ' + data);
                                        if (data == "on") {
                                            document.getElementById('montrer-mail-preview').innerHTML = "Oui";
                                            afficherAlerte("Confidentialité de votre email", "Votre adresse mail est affichée sur votre profil public", 7000, "info");

                                        } else if (data == "off") {
                                            document.getElementById('montrer-mail-preview').innerHTML = "Non";
                                            afficherAlerte("Confidentialité de votre email", "Votre adresse mail est masquée de votre profil public", 7000, "info");
                                        }
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        // gère l'erreur ici
                                        document.getElementById('input-montrer-email').checked = false;
                                        console.log('Erreur : ' + textStatus + ' - ' + errorThrown);
                                    }
                                });
                            });
                        });
                    </script>
                </div>




            </div>

            <div class="frame niveauC" id="modifier-pseudo">
                <div class="titre-frame-container" onclick="ouvrirLaPage('profil-public')">
                    <i class="fa-solid fa-chevron-left"></i>
                    <h2 class="titre-frame">Modifier le pseudo</h2>
                </div>
                <p class="params-text">En enregistrant votre nouveau pseudo, vous confirmez que celui-ci respecte nos conditions d’utilisation et qu’il n’est pas offensant. Toute infraction au règlement entraînera une interdiction d’accès à nos services</p>
                <h3 class="section-parametres">Saisissez votre nouveau pseudo</h3>
                <form id="formulaire-modif-pseudo" method="post">
                    <input type="text" name="nouveau_pseudo" id="input_nouveau_pseudo" placeholder="MarioBross">
                    <a onclick="$('#formulaire-modif-pseudo').submit();" class="theme"><i class="fa-solid fa-arrow-right bouton-icon"></i>Enregistrer</a>
                    <input type="submit" value="Enregistrer" style="display: none;">

                </form>
                <script>
                    $(document).ready(function() {
                        $('#formulaire-modif-pseudo').submit(function(e) {
                            e.preventDefault(); // empêche le rafraîchissement de la page
                            $.ajax({
                                url: 'composants/ajax/modifier_pseudo.php',
                                type: 'POST',
                                data: $(this).serialize(),
                                success: function(data) {
                                    // gère la réponse du serveur ici
                                    // console.log('Réponse du serveur : ' + data);
                                    data = data.split(",");
                                    console.log(data);
                                    if (data[0] == "error") {
                                        // afficher message d'erreur
                                        afficherAlerte("Modification de votre pseudo", data[1], 10000, "error");

                                    } else if (data[0] == "success") {
                                        // afficher message de succès
                                        afficherAlerte("Modification de votre pseudo", data[1], 7000, "info");

                                        // mettre à jour les informations de pseudo
                                        ouvrirLaPage("profil-public");
                                        document.getElementById("preview-pseudo").innerHTML = data[2];
                                        document.getElementById("input_nouveau_pseudo").value = "";
                                        if (document.getElementById("details-profil-nom-compte").classList.contains("nom-pseudo")) {
                                            document.getElementById("details-profil-nom-compte").innerHTML = data[2];

                                        }
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    // gère l'erreur ici
                                    console.log('Erreur : ' + textStatus + ' - ' + errorThrown);
                                }
                            });
                        });
                    });
                </script>






            </div>

            <div class="frame niveauC" id="modifier-citation">
                <div class="titre-frame-container" onclick="ouvrirLaPage('profil-public')">
                    <i class="fa-solid fa-chevron-left"></i>
                    <h2 class="titre-frame">Modifier la citation</h2>
                </div>
                <p class="params-text">En enregistrant votre nouvelle citation, vous confirmez que celle-ci respecte nos conditions d’utilisation et qu’il n’est pas offensante. Toute infraction au règlement entraînera une interdiction d’accès à nos services</p>
                <h3 class="section-parametres">Modifiez votre citation</h3>
                <form id="formulaire-modif-citation" method="post" action="">
                    <textarea name="nouvelle_citation" id="input_nouvelle_citation" placeholder="Je suis une tarte intelligente" style="height:120px;"><?= $user["citation"] ?></textarea>
                    <input type="submit" value="Enregistrer" style="display: none;">
                </form>
                <a onclick="$('#formulaire-modif-citation').submit()" class="theme"><i class="fa-solid fa-arrow-right bouton-icon"></i>Enregistrer</a>
                <script>
                    $(document).ready(function() {
                        $('#formulaire-modif-citation').submit(function(e) {
                            e.preventDefault(); // empêche le rafraîchissement de la page
                            $.ajax({
                                url: 'composants/ajax/modifier_citation.php',
                                type: 'POST',
                                data: $(this).serialize(),
                                success: function(data) {
                                    // gère la réponse du serveur ici
                                    // console.log('Réponse du serveur : ' + data);
                                    data = data.split(",");
                                    console.log(data);
                                    if (data[0] == "error") {
                                        // afficher message d'erreur
                                        afficherAlerte("Citation", data[1], 10000, "error");

                                    } else if (data[0] == "success") {
                                        // afficher message de succès
                                        afficherAlerte("Citation enregistrée 🎨", data[1], 7000, "info");

                                        // mettre à jour les informations de pseudo

                                        if (data[2] == '') {
                                            document.getElementById("preview-citation").innerHTML = "Non";
                                        } else {
                                            document.getElementById("preview-citation").innerHTML = "Oui";
                                        }
                                        document.getElementById("input_nouvelle_citation").value = data[2];
                                    }
                                    ouvrirLaPage("profil-public")
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    // gère l'erreur ici
                                    console.log('Erreur : ' + textStatus + ' - ' + errorThrown);
                                }
                            });
                        });
                    });
                </script>

            </div>





            <!-- elements de la section "coups de coeur" -->
            <?php
            $loved_articles = $db->query("SELECT loved_articles FROM users WHERE id = '" . $_SESSION["id"] . "'");
            $articles = $db->query("SELECT id,nom,image,image_bg,url FROM articles");
            $articles = $articles->fetchAll();

            $loved_articles = $loved_articles->fetch();
            $loved_articles = array_filter(explode(",", $loved_articles["loved_articles"]));



            ?>
            <div class="frame niveauB" id="coups-de-coeur">
                <div class="titre-frame-container" onclick="ouvrirLaPage('parametres')">
                    <i class="fa-solid fa-chevron-left"></i>
                    <h2 class="titre-frame">Vos coups de coeur</h2>
                </div>
                <form id="formulaire-changer-coups-de-coeur" action="" method="post">
                    <input type="hidden" name="id_article_aime" id="id_article_aime">
                </form>
                <!-- <button class="primaire-destructif">Supprimer tout</button> -->

                <?php
                if (isset($loved_articles[0]) && $loved_articles[0] != "") {
                    foreach ($loved_articles as $loved_article_id) {
                ?>
                        <div class="element-aime" id="coeur-<?= $loved_article_id ?>">
                            <div style="background-image: url('<?= $articles[$loved_article_id - 1]['image_bg'] ?>')" class="illustration"></div>
                            <a class="titre-article lien-sans-style" href="<?= $articles[$loved_article_id - 1]['url'] ?>" target="_blank"><?= $articles[$loved_article_id - 1]['nom'] ?></a>
                            <i class="fa-solid fa-heart-circle-minus" onclick="unlove_article(<?= $loved_article_id ?>)"></i>
                        </div>





                <?php
                    }
                }



                ?>
                <script>
                    $(document).ready(function() {
                        $('#formulaire-changer-coups-de-coeur').submit(function(e) {
                            e.preventDefault(); // empêche le rafraîchissement de la page
                            $.ajax({
                                url: 'composants/ajax/gestion_coups_de_coeur.php',
                                type: 'POST',
                                data: $(this).serialize(),
                                success: function(data) {
                                    // gère la réponse du serveur ici
                                    // console.log('Réponse du serveur : ' + data);
                                    data = data.split(",");
                                    console.log(data);
                                    if (data[0] == "error") {
                                        // afficher message d'erreur
                                        afficherAlerte("Erreur", data[1], 10000, "error");

                                    } else if (data[0] == "success") {
                                        // afficher message de succès

                                        // mettre à jour les informations de pseudo

                                        if (data[1] == 'suppression') {
                                            // supprimer l'article de la page des coups de coeur
                                            document.getElementById("coeur-" + data[2]).classList.add("deleted");

                                        } else if (data[1] == 'ajout') {
                                            document.getElementById("coeur-" + data[2]).classList.remove("deleted");
                                            // ne rien faire
                                        }

                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    // gère l'erreur ici
                                    console.log('Erreur : ' + textStatus + ' - ' + errorThrown);
                                }
                            });
                        });
                    });

                    function unlove_article(id) {
                        document.getElementById("id_article_aime").value = id;
                        $('#formulaire-changer-coups-de-coeur').submit();
                    }
                </script>




            </div>

            <!-- elements de la section "enregistrements" -->
            <?php
            $articles_enregistres = $db->query("SELECT enregistrements FROM users WHERE id = '" . $_SESSION["id"] . "'");
            $articles = $db->query("SELECT id,nom,image,image_bg,url FROM articles");
            $articles = $articles->fetchAll();

            $articles_enregistres = $articles_enregistres->fetch();
            $articles_enregistres = array_filter(explode(",", $articles_enregistres["enregistrements"]));



            ?>

            <div class="frame niveauB" id="enregistrements">
                <div class="titre-frame-container" onclick="ouvrirLaPage('parametres')">
                    <i class="fa-solid fa-chevron-left"></i>
                    <h2 class="titre-frame">Vos enregistrements</h2>
                </div>
                <form id="formulaire-changer-enregistrements" action="" method="post">
                    <input type="hidden" name="id_article_enregistre" id="id_article_enregistre">
                </form>
                <!-- <button class="primaire-destructif">Supprimer tout</button> -->

                <?php
                if (isset($articles_enregistres[0]) && $articles_enregistres[0] != "") {
                    foreach ($articles_enregistres as $article_enregistre_id) {
                ?>
                        <div class="element-aime" id="enregistrement-<?= $article_enregistre_id ?>">
                            <div style="background-image: url('<?= $articles[$article_enregistre_id - 1]['image_bg'] ?>')" class="illustration"></div>
                            <a class="titre-article lien-sans-style" href="<?= $articles[$article_enregistre_id - 1]['url'] ?>" target="_blank"><?= $articles[$article_enregistre_id - 1]['nom'] ?></a>
                            <i class="fa-solid fa-trash-can" onclick="unsave_article(<?= $article_enregistre_id ?>)"></i>
                        </div>





                <?php
                    }
                }



                ?>
                <script>
                    $(document).ready(function() {
                        $('#formulaire-changer-enregistrements').submit(function(e) {
                            e.preventDefault(); // empêche le rafraîchissement de la page
                            $.ajax({
                                url: 'composants/ajax/gestion_enregistrements.php',
                                type: 'POST',
                                data: $(this).serialize(),
                                success: function(data) {
                                    // gère la réponse du serveur ici
                                    // console.log('Réponse du serveur : ' + data);
                                    data = data.split(",");
                                    console.log(data);
                                    if (data[0] == "error") {
                                        // afficher message d'erreur
                                        afficherAlerte("Erreur", data[1], 10000, "error");

                                    } else if (data[0] == "success") {
                                        // afficher message de succès

                                        // mettre à jour les informations de pseudo

                                        if (data[1] == 'suppression') {
                                            // supprimer l'article de la page des coups de coeur
                                            document.getElementById("enregistrement-" + data[2]).classList.add("deleted");

                                        } else if (data[1] == 'ajout') {
                                            document.getElementById("enregistrement-" + data[2]).classList.remove("deleted");
                                            // ne rien faire
                                        }

                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    // gère l'erreur ici
                                    console.log('Erreur : ' + textStatus + ' - ' + errorThrown);
                                }
                            });
                        });
                    });

                    function unsave_article(id) {
                        document.getElementById("id_article_enregistre").value = id;
                        $('#formulaire-changer-enregistrements').submit();
                    }
                </script>



            </div>






            <?php
            // si la consultation de l'historique est activée
            if (get_status("historique") != 1) {
            ?>
                <!-- section historique -->

                <div class="frame niveauB" id="historique">
                    <div class="titre-frame-container" onclick="ouvrirLaPage('parametres')">
                        <i class="fa-solid fa-chevron-left"></i>
                        <h2 class="titre-frame">Votre historique</h2>
                    </div>
                    <div id="liste-historique">
                        <?php
                        // aller rechercher l'historique
                        global $db;
                        $requete = $db->prepare("SELECT `id`,`article`,`date` FROM `historique` WHERE `user` = :user_id ORDER BY `date` DESC LIMIT 500");
                        $requete->bindParam(":user_id", $_SESSION["id"]);
                        $requete->execute();
                        $historique = $requete->fetchAll();

                        $i = 0;
                        // echo date_parse($historique[$i]["date"])["year"];
                        // echo getdate()["year"];

                        // Si l'historique est vide
                        if (count($historique) == 0) {
                        ?>
                            <p class="params-text" style="text-align:center;height:calc(100vh - 140px); display:flex; align-items:center; justify-content:center;">Votre historique est vide.</p>

                        <?php
                        } else {
                            // bouton tout supprimer
                        ?>
                            <a class="primaire-destructif" onclick="effacer_tout_historique();">Tout supprimer</a>


                            <?php
                        }

                        // aujourd'hui
                        if (date_parse($historique[$i]["date"])["year"] == getdate()["year"] && date_parse($historique[$i]["date"])["month"] == getdate()["mon"] && date_parse($historique[$i]["date"])["day"] == getdate()["mday"]) {
                            echo '<h3 class="section-parametres">Aujourd\'hui</h3>';

                            while (date_parse($historique[$i]["date"])["year"] == getdate()["year"] && date_parse($historique[$i]["date"])["month"] == getdate()["mon"] && date_parse($historique[$i]["date"])["day"] == getdate()["mday"]) {
                            ?>

                                <div class="ligne-parametre" id="historique-<?= $historique[$i]['id']; ?>">
                                    <p class="ligne-parametre-texte historique"><?= $articles[$historique[$i]["article"] - 1]["nom"]; ?></p>
                                    <p class="option-preview"><?= date_parse($historique[$i]["date"])["hour"]; ?>h<?= date_parse($historique[$i]["date"])["minute"]; ?></p>
                                    <i class="fa-solid fa-trash-can ligne-parametre-icon red" onclick="effacer_historique(<?= $historique[$i]['id']; ?>);"></i>
                                </div>



                            <?php
                                $i = $i + 1;
                            }
                        }
                        // ce mois-ci
                        if (date_parse($historique[$i]["date"])["year"] == getdate()["year"] && date_parse($historique[$i]["date"])["month"] == getdate()["mon"]) {
                            echo '<h3 class="section-parametres">Ce mois-ci</h3>';

                            while (date_parse($historique[$i]["date"])["year"] == getdate()["year"] && date_parse($historique[$i]["date"])["month"] == getdate()["mon"]) {
                            ?>

                                <div class="ligne-parametre" id="historique-<?= $historique[$i]['id']; ?>">
                                    <p class="ligne-parametre-texte historique"><?= $articles[$historique[$i]["article"] - 1]["nom"]; ?></p>
                                    <p class="option-preview"><?= dateToFrench($historique[$i]["date"], 'j F') ?></p>
                                    <i class="fa-solid fa-trash-can ligne-parametre-icon red" onclick="effacer_historique(<?= $historique[$i]['id']; ?>);"></i>
                                </div>



                            <?php
                                $i = $i + 1;
                            }
                        }
                        if (isset($historique[$i])) {
                            echo '<h3 class="section-parametres">Plus tôt</h3>';
                            while (isset($historique[$i])) {
                            ?>

                                <div class="ligne-parametre" id="historique-<?= $historique[$i]['id']; ?>">
                                    <p class="ligne-parametre-texte historique"><?= $articles[$historique[$i]["article"] - 1]["nom"]; ?></p>
                                    <p class="option-preview"><?= dateToFrench($historique[$i]["date"], 'F Y') ?></p>
                                    <i class="fa-solid fa-trash-can ligne-parametre-icon red" onclick="effacer_historique(<?= $historique[$i]['id']; ?>);"></i>
                                </div>



                        <?php
                                $i = $i + 1;
                            }
                        }

                        ?>


                        <form id="formulaire-supprimer-historique" action="" method="post">
                            <input type="hidden" name="id_ligne_historique" id="input_id_ligne_historique">
                            <input type="checkbox" name="historique_supprimer_tout" id="input_historique_supprimer_tout">
                        </form>
                        <script>
                            $(document).ready(function() {
                                $('#formulaire-supprimer-historique').submit(function(e) {
                                    e.preventDefault(); // empêche le rafraîchissement de la page
                                    $.ajax({
                                        url: 'composants/ajax/gestion_historique.php',
                                        type: 'POST',
                                        data: $(this).serialize(),
                                        success: function(data) {
                                            // gère la réponse du serveur ici
                                            // console.log('Réponse du serveur : ' + data);
                                            data = data.split(",");
                                            console.log(data);
                                            if (data[0] == "error") {
                                                // afficher message d'erreur
                                                afficherAlerte("Impossible de supprimer des éléments votre historique", data[1], 10000, "error");

                                            } else if (data[0] == "success") {
                                                // afficher message de succès
                                                afficherAlerte("Historique supprimé", data[1], 10000, "info");

                                                // mettre à jour les informations de pseudo

                                                if (data[1] == 'suppression' && data[2] != "all") {
                                                    // supprimer l'article de la page des coups de coeur
                                                    document.getElementById("historique-" + data[2]).classList.add("deleted");

                                                } else if (data[1] == 'suppression' && data[2] == "all") {
                                                    document.getElementById("liste-historique").innerHTML = '<p class="params-text" style="text-align:center;height:calc(100vh - 140px); display:flex; align-items:center; justify-content:center;">Votre historique est vide.</p>';
                                                    // ne rien faire
                                                }

                                            }
                                        },
                                        error: function(jqXHR, textStatus, errorThrown) {
                                            // gère l'erreur ici
                                            console.log('Erreur : ' + textStatus + ' - ' + errorThrown);
                                        }
                                    });
                                });
                            });








                            function effacer_historique(id) {
                                document.getElementById("input_id_ligne_historique").value = id;
                                document.getElementById("input_historique_supprimer_tout").checked = false;

                                $('#formulaire-supprimer-historique').submit();
                            }

                            function effacer_tout_historique() {
                                document.getElementById("input_id_ligne_historique").value = "";
                                document.getElementById("input_historique_supprimer_tout").checked = true;
                                $('#formulaire-supprimer-historique').submit();
                            }
                        </script>

                    </div>
                </div>

        </div>
    <?php
            }

    ?>


    <script>
        // page initiale
        pageA = "parametres";
        pageB = "";
        pageC = "";
        pageD = "";
        identifiant_page_actuelle = pageA

        function ouvrirLaPage(identifiant_page_nouvelle) {
            page_nouvelle = document.getElementById(identifiant_page_nouvelle);
            page_actuelle = document.getElementById(identifiant_page_actuelle);

            if (identifiant_page_actuelle == pageA && page_nouvelle.classList.contains("niveauB")) {
                page_nouvelle.classList.add("show");
                pageB = identifiant_page_nouvelle;
                identifiant_page_actuelle = identifiant_page_nouvelle;
            }
            // page de départ : B
            else if (identifiant_page_actuelle == pageB && page_nouvelle.classList.contains("niveauA")) {
                page_actuelle.classList.remove('show');
                page_nouvelle.classList.add('show');
                pageB = "";
                pageA = identifiant_page_nouvelle;
                identifiant_page_actuelle = pageA;
            } else if (identifiant_page_actuelle == pageB && page_nouvelle.classList.contains("niveauB") && identifiant_page_actuelle != identifiant_page_nouvelle) {
                page_actuelle.classList.remove('show');
                page_nouvelle.classList.add('show')
                pageB = identifiant_page_nouvelle
                identifiant_page_actuelle = pageB;
            } else if (identifiant_page_actuelle == pageB && page_nouvelle.classList.contains("niveauC")) {
                page_nouvelle.classList.add('show')
                pageC = identifiant_page_nouvelle
                identifiant_page_actuelle = pageC;
            }
            // page de départ: C
            else if (identifiant_page_actuelle == pageC && page_nouvelle.classList.contains("niveauA")) {
                page_actuelle.classList.remove('show');
                document.getElementById(pageB).classList.remove('show');
                // page_nouvelle.classList.add('show');
                pageC = "";
                pageB = "";
                pageA = identifiant_page_nouvelle;
                identifiant_page_actuelle = pageA;
            } else if (identifiant_page_actuelle == pageC && page_nouvelle.classList.contains("niveauB")) {
                page_actuelle.classList.remove('show');
                if (pageB != identifiant_page_nouvelle) {
                    document.getElementById(pageB).classList.remove('show');
                }
                page_nouvelle.classList.add('show')
                pageC = "";
                pageB = identifiant_page_nouvelle
                identifiant_page_actuelle = pageB;
            } else if (identifiant_page_actuelle == pageC && page_nouvelle.classList.contains("niveauC") && identifiant_page_actuelle != identifiant_page_nouvelle) {
                page_actuelle.classList.remove('show');
                page_nouvelle.classList.add('show')
                pageC = identifiant_page_nouvelle
                identifiant_page_actuelle = pageC;
            } else if (identifiant_page_actuelle == pageC && page_nouvelle.classList.contains("niveauD")) {
                page_nouvelle.classList.add('show')
                pageD = identifiant_page_nouvelle
                identifiant_page_actuelle = pageD;
            }
            // page de départ: D
            else if (identifiant_page_actuelle == pageD && page_nouvelle.classList.contains("niveauA")) {
                page_actuelle.classList.remove('show');
                document.getElementById(pageC).classList.remove('show');
                document.getElementById(pageB).classList.remove('show');
                // page_nouvelle.classList.add('show');
                pageD = "";
                pageC = "";
                pageB = "";
                pageA = identifiant_page_nouvelle;
                identifiant_page_actuelle = pageA;
            } else if (identifiant_page_actuelle == pageD && page_nouvelle.classList.contains("niveauB")) {
                page_actuelle.classList.remove('show');
                document.getElementById(pageC).classList.remove('show');
                if (pageB != identifiant_page_nouvelle) {
                    document.getElementById(pageB).classList.remove('show');
                    page_nouvelle.classList.add('show')
                }
                pageC = "";
                pageD = "";
                pageB = identifiant_page_nouvelle
                identifiant_page_actuelle = pageB;
            } else if (identifiant_page_actuelle == pageD && page_nouvelle.classList.contains("niveauC")) {
                page_actuelle.classList.remove('show');
                if (pageC != identifiant_page_nouvelle) {
                    document.getElementById(pageC).classList.remove('show');
                    page_nouvelle.classList.add('show')
                    pageC = identifiant_page_nouvelle
                }
                pageD = "";
                identifiant_page_actuelle = pageC;
            } else if (identifiant_page_actuelle == pageD && page_nouvelle.classList.contains("niveauD") && identifiant_page_actuelle != identifiant_page_nouvelle) {
                page_actuelle.classList.remove('show');
                page_nouvelle.classList.add('show')
                pageD = identifiant_page_nouvelle
                identifiant_page_actuelle = pageD;
            }
            // console.log([pageA,pageB,pageC,pageD]);
        }
    </script>

<?php




    } else {
        // echo "Aucune session en cours";
?>
    <style>
        #connexion-boxes {
            justify-content: center;
            text-align: center;
        }

        #inscription-box {
            display: none;
        }

        #connexion-box,
        #inscription-box {
            flex: 1;
            max-width: 400px;
        }

        #connexion-box.connexion,
        #inscription-box.inscription {
            display: inline;
        }

        #inscription-box.connexion,
        #connexion-box.inscription {
            display: none;
        }
    </style>

    <script>
        function afficherBoxInscription() {
            // if (document.getElementById("connexion-box").classList.contains('connexion'))
            document.getElementById("connexion-box").classList.toggle('connexion')
            document.getElementById("connexion-box").classList.toggle('inscription')
            document.getElementById("inscription-box").classList.toggle('connexion')
            document.getElementById("inscription-box").classList.toggle('inscription')
        }
    </script>
    <div id="connexion-boxes" class="flex-container">
        <div id="connexion-box" class="<?php if ($signin_form_sent) {
                                            echo "inscription";
                                        } else {
                                            echo "connexion";
                                        } ?>">
            <h1 class="section-title <?php if ($signin_form_sent) {
                                            echo "inscription";
                                        } else {
                                            echo "connexion";
                                        } ?>">Se connecter</h1>
            <form method="post">
                <input type="text" name="lpseudo" id="lpseudo" placeholder="Pseudo ou e-mail" required <?php if (get_status('connexion') == 1) {
                                                                                                            echo "style='display:none'";
                                                                                                        } ?>>
                <input type="password" name="lpassword" id="lpassword" placeholder="Mot de passe" required <?php if (get_status('connexion') == 1) {
                                                                                                                echo "style='display:none'";
                                                                                                            } ?>>
                <p id="erreur-login" class="erreur-formulaire">
                <?php 
                if (!isset($erreur_login)) $erreur_login = '';
                if (isset($login_form_sent)) {
                    echo htmlspecialchars($erreur_login);
                } else if (get_status('connexion') == 1) {
                    echo "Connexion impossible, veuillez réessayer plus tard. Nous tentons de résoudre ce problème rapidemment :(";
                }
                ?>
                </p>
                <p id="btn_afficher_inscription" onclick="afficherBoxInscription();" class="normal" style="cursor:pointer;">Je n'ai pas encore de compte<i class="fa-solid fa-circle-arrow-right text-icon"></i></p>
                <input type="submit" class="theme" name="formlogin" value="Se connecter" <?php if (get_status('connexion') == 1) {
                                                                                                echo "style='display:none'";
                                                                                            } ?>>
            </form>
        </div>
        <div id="inscription-box" class="<?php if ($signin_form_sent) {
                                                echo "inscription";
                                            } else {
                                                echo "connexion";
                                            } ?>">
            <h2 class="section-title">Créer un compte</h2>
            <form method="post">
                <input type="text" name="pseudo" id="pseudo" placeholder="Choisissez un pseudo" required <?php if (isset($signin_form_sent)) {
                                                                                                                echo "value='" . $pseudo . "'";
                                                                                                            } ?> <?php if (get_status('inscription') == 1) {
                                                                                                                        echo "style='display:none'";
                                                                                                                    } ?>>
                <p id="erreur-pseudo-signin" class="erreur-formulaire" <?php if (get_status('inscription') == 1) {
                                                                            echo "style='display:none'";
                                                                        } ?>><?php if (isset($erreur_pseudo_signin)) {
                                                                                    echo $erreur_pseudo_signin;
                                                                                } ?></p>
                <input type="email" name="email" id="email" placeholder="Votre adresse mail" required <?php if (isset($signin_form_sent)) {
                                                                                                            echo "value='" . $email . "'";
                                                                                                        } ?> <?php if (get_status('inscription') == 1) {
                                                                                                                    echo "style='display:none'";
                                                                                                                } ?>>
                <p id="erreur-email-signin" class="erreur-formulaire" <?php if (get_status('inscription') == 1) {
                                                                            echo "style='display:none'";
                                                                        } ?>><?php if (isset($erreur_email_signin)) {
                                                                                    echo $erreur_email_signin;
                                                                                } ?></p>
                <input type="password" name="password" id="password" placeholder="Mot de passe" required <?php if (get_status('inscription') == 1) {
                                                                                                                echo "style='display:none'";
                                                                                                            } ?>>
                <input type="password" name="verif_password" id="verif_password" placeholder="Confirmation du mot de passe" required <?php if (get_status('inscription') == 1) {
                                                                                                                                            echo "style='display:none'";
                                                                                                                                        } ?>>
                <p id="erreur-mdp-signin" class="erreur-formulaire"><?php if (isset($erreur_mdp_signin)) {
                                                                        echo $erreur_mdp_signin;
                                                                    } else if (get_status('inscription') == 1) {
                                                                        echo "La création de compte a été temporairement désactivée. Nous travaillons le problème. Merci de réessayer ultérieurement :)";
                                                                    } ?></p>
                <p id="btn_afficher_connexion" onclick="afficherBoxInscription();" class="normal" style="cursor:pointer;">J'ai déjà un compte<i class="fa-solid fa-circle-arrow-right text-icon"></i></p>
                <input type="submit" class="theme" name="form_signin" value="Créer un compte" <?php if (get_status('inscription') == 1) {
                                                                                                    echo "style='display:none'";
                                                                                                } ?>>
            </form>
        </div>
    </div>
<?php
        // Afficher le menu de connexion/ de création de compte
    }

?>








<?php
include './composants/bas-de-page.php';
// echo $foot_page;
?>
</body>

</html>