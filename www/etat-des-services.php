
<?php 
session_start();
include "database.php";
global $db;
include "composants/get_status.php";
?>
<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etat des services KnowITbetter</title>
    <meta name="description" content="Consulter l'état des services de KnowITbetter">
    <link rel="shortcut icon" href="./images/logo/favicon.ico" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/navigation-bar.css">
    <link rel="stylesheet" href="../css/general.css">
    <!-- <link rel="stylesheet" href="../css/style-apercu-articles.css"> -->
    <!-- JS -->
    <!-- <script src="./script/implementation-composants.js"></script> -->
    <!-- Kit Fontawesome -->
    <?php include "./composants/fontawesome_kit.php";?>
    <Meta name="robots" content="noindex, nofollow" />
    <meta name="theme-color" content="#F8B432">


</head>
<style>
    section#etat-services-box {
        display:flex;
        flex-direction:column;
        flex-wrap:wrap;
        align-items:center;
        min-height:80vh;
        
    }
    section#etat-services-box div.service {
        display:flex;
        flex-wrap:wrap;
        flex-direction:row;
        justify-content:space-between;
        padding:10px 20px;
        max-width:900px;
        width: -webkit-fill-available;
        align-items:center;
        
    }
    section#etat-services-box div.service p {
        /* flex:1; */
    }
    section#etat-services-box div.service p.nom-du-service {
        font-weight:600;
        text-transform:capitalize;
        width:200px;
    }
    section#etat-services-box div.service div.statut-service p {
        border-radius:8px;
        background-color:grey;
        color:white;
        padding:4px 8px;
        text-align:center;
        user-select: none;

        

    }
    section#etat-services-box div.service p.details-service  {
        flex:1;
        min-width:300px;
    }
    section#etat-services-box div.service div.statut-service p.statut0 {
        background-color:rgb(52,199,89);
    }
    section#etat-services-box div.service div.statut-service p.statut1 {
        background-color:rgb(255,49,48);
    }
    section#etat-services-box div.service div.statut-service p.statut2 {
        background-color:rgb(255,204,0);
    }




</style>
<body>
    <?php        
        include './composants/navigation-bar.php';
        echo $navigation_bar;
        
        // requete statuts
        $query_status = $db->prepare("SELECT * FROM `status`");
        $query_status->execute();
        
        $services_status = $query_status->fetchAll();

    ?>
    <!-- titre de la page -->
    <section id="top-page" class="iphone-padding">
        <div class="landing-page">
            <h1 class="big-title" style="color:black;">Etat des services KnowITbetter</h1>
        </div>
    </section>
    <section id="etat-services-box" class="iphone-padding">
        <?php
            foreach ($services_status as $service) {?>

        <div class="service">
            <p class="nom-du-service"><?=$service["nom-fonction"]?></p>
            <p class="details-service"><?=$service["details-fonction"]?></p>
            <div class="statut-service">
                <p title="<?=$service["details-status"]?>" class='statut-service <?php if($service["status"]==0) {echo " statut0'>Stable";} else if($service["status"]==1) {echo " statut1'>Hors service";} else if($service["status"]==2) {echo " statut2'>Perturbé";} else if($service["status"]==3) {echo "'>BETA";} else {echo "'>Etat du service inconnu";}?></p>

            </div>
        </div>

        <?php 
            }
        ?>
    </section>
    <div class="iphone-padding">
        <?php 
            include './composants/bas-de-page.php';
            echo $foot_page;
            
            ?>
    </div>

</body>
</html>