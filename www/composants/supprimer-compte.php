<?php 
session_start();
include "../database.php";
global $db;

include "../composants/get_status.php";
include "../composants/verif-auth-user.php";
// include "composants/download-user-data.php";



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Supprimer votre compte KnowITbetter</title>
    <link rel="shortcut icon" href="./images/logo/favicon.ico" type="image/x-icon">
    
    <!-- CSS -->
    <link rel="stylesheet" href="../css/navigation-bar.css">
    <link rel="stylesheet" href="../css/general.css">
    <!-- pas d'indexage -->
    <Meta name=" robots" content="noindex, nofollow" />
    <!-- Kit Fontawesome -->
    <?php include "../composants/fontawesome_kit.php";?>

    <meta name="theme-color" content="grey">


</head>
<body id="body">
    <?php   
    include '../composants/navigation-bar.php';
    echo $navigation_bar;

    if (isset($_POST["supprimer-compte"])) {
        echo "SUPPRESSION COMPTE DEMANDEE";
        } else if (count($recherche_compte) == 1) {
            




            if (verif_auth_user() == true) {
                echo "fonction lancée";
                $query_data =$db->prepare("DELETE FROM users WHERE id= :id");
                echo "requete preparee";
                $query_data->execute([
                    'id' => $_SESSION["id"],
                ]);
                // requete exécutée
                session_destroy();
                session_unset();
                header('Location: https://knowitbetter.fr/compte');
                
            }
        }
    
    ?>


    <section id="top-page" class="page-padding">
        <div class="landing-page">
            <h1 class="big-title" style="color:black;">Supprimer mon compte KnowITbetter (DEFINITIF)</h1>
            <a onclick="submit_form();" class="secondaire-destructif"><i class="fa-solid fa-person-circle-minus text-icon"></i>Supprimer Définitivement Mon Compte</a>
            <p>Cette action est irréversible.</p>
            <form id="supprimer-compte" action="" method="post">
                <input style="display:none" type="" name="supprimer-compte" value="Supprimer définitivement mon compte">

            </form>
            <script>
                function submit_form() {
                    document.getElementById("supprimer-compte").submit();
                }
            </script>

        </div>
    </section>




</body>
</html>